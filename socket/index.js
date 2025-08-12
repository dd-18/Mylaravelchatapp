const express = require('express');
const app = express();
const http = require('http').Server(app);
const io = require('socket.io')(http, {
    cors: {
        origin: 'http://127.0.0.1:8000',
        methods: ["GET", "POST"]
    }
});

const mysql = require('mysql');
const moment = require('moment');

const sockets = {};
const typingUsers = {}; // Track typing users
const onlineUsers = new Set(); // Track online users

let con = mysql.createConnection({
    host: 'localhost',
    user: 'root',
    password: '',
    database: 'laravel_chatappfinal'
});

con.connect(function (err) {
    if (err) throw err;
    console.log('Connected to database!');
});

// Database disconnection
con.on('error', function(err) {
    if(err.code === 'PROTOCOL_CONNECTION_LOST') {
        console.log('Database connection lost. Attempting to reconnect...');
        handleDisconnect();
    } else {
        throw err;
    }
});

function handleDisconnect() {
    con = mysql.createConnection({
        host: 'localhost',
        user: 'root',
        password: '',
        database: 'laravel_chatappfinal'
    });

    con.connect(function(err) {
        if(err) {
            console.log('Error reconnecting: ', err);
            setTimeout(handleDisconnect, 2000);
        }
    });
}

io.on('connection', function (socket) {
    const userId = socket.handshake.query.user_id;
    if (!userId) {
        console.error('Connection rejected - no user_id provided');
        socket.disconnect(true);
        return;
    }

    console.log('User attempting connection:', userId);

    // Initialize user socket array if not exists
    if (!sockets[userId]) sockets[userId] = [];
    sockets[userId].push(socket);

    // Add user to online users set
    const wasOffline = !onlineUsers.has(userId);
    onlineUsers.add(userId);

    // Update user online status in database only if user was offline
    if (wasOffline) {
        con.query('UPDATE users SET is_online = 1 WHERE id = ?', [userId], function (err) {
            if (err) console.error('Error updating user online status:', err);
            else console.log('User Connected: ' + userId);
        });
    }

    // Send user data to the connecting socket and handle broadcasting
    con.query('SELECT * FROM users WHERE id = ?', [userId], function (err, results) {
        if (err) console.error('Error fetching user data:', err);
        else {
            const userData = results[0];
            socket.emit('user_data', userData);
            
            // If this user just came online, broadcast to others with user data
            if (wasOffline && userData) {
                socket.broadcast.emit('user_connected', {
                    id: parseInt(userId),
                    name: userData.name,
                    email: userData.email,
                    is_online: 1
                });
            }
        }
    });

    // Send current online users to the newly connected user with their data
    if (onlineUsers.size > 1) {
        const otherOnlineUsers = Array.from(onlineUsers).filter(id => id !== userId);
        
        // Get user data for all online users
        if (otherOnlineUsers.length > 0) {
            const placeholders = otherOnlineUsers.map(() => '?').join(',');
            con.query(`SELECT id, name, email FROM users WHERE id IN (${placeholders})`, otherOnlineUsers, function (err, onlineUsersData) {
                if (err) console.error('Error fetching online users data:', err);
                else {
                    onlineUsersData.forEach(user => {
                        socket.emit('user_connected', {
                            id: parseInt(user.id),
                            name: user.name,
                            email: user.email,
                            is_online: 1
                        });
                    });
                }
            });
        }
    }

    // Handle joining a chat room (when user opens a conversation)
    socket.on('join_chat', function(data) {
        if (!data.user_id || !data.other_user_id) {
            console.error('Invalid join_chat data');
            return;
        }

        console.log(`User ${data.user_id} joining chat with ${data.other_user_id}`);

        // Create group_id for the conversation
        const group_id = (String(data.user_id) > String(data.other_user_id))
            ? String(data.user_id) + String(data.other_user_id)
            : String(data.other_user_id) + String(data.user_id);

        // Join the socket room for this conversation
        socket.join(group_id);

        // Fetch chat history for this conversation
        const historyQuery = `
            SELECT c.*, u.name as sender_name 
            FROM chats c 
            JOIN users u ON c.user_id = u.id 
            WHERE c.group_id = ? 
            ORDER BY c.created_at ASC 
            LIMIT 50
        `;
        
        con.query(historyQuery, [group_id], function(err, messages) {
            if (err) {
                console.error('Error fetching chat history:', err);
                return;
            }

            // Send chat history to the user
            socket.emit('chat_history', {
                messages: messages,
                group_id: group_id
            });

            console.log(`Sent ${messages.length} messages to user ${data.user_id} for chat ${group_id}`);
        });

        // Mark messages as read when joining chat
        con.query(
            'UPDATE chats SET is_read = 1 WHERE user_id = ? AND other_user_id = ? AND is_read = 0',
            [data.other_user_id, data.user_id],
            function(err) {
                if (err) console.error('Error marking messages as read on join:', err);
            }
        );
    });

    // Handle leaving a chat room
    socket.on('leave_chat', function(data) {
        if (!data.user_id || !data.other_user_id) return;

        const group_id = (String(data.user_id) > String(data.other_user_id))
            ? String(data.user_id) + String(data.other_user_id)
            : String(data.other_user_id) + String(data.user_id);

        socket.leave(group_id);
        console.log(`User ${data.user_id} left chat room ${group_id}`);
    });

    //send_message
    socket.on('send_message', function (data) {
        if (!data.user_id || !data.other_user_id || !data.message) {
            console.error('Invalid message data received');
            return;
        }

        // Create group_id for the conversation
        var group_id = (String(data.user_id) > String(data.other_user_id))
            ? String(data.user_id) + String(data.other_user_id)
            : String(data.other_user_id) + String(data.user_id);

        var time = moment().format('h:mm A');
        data.time = time;

        const insertQuery = 'INSERT INTO chats (user_id, other_user_id, message, group_id, is_read, created_at) VALUES (?, ?, ?, ?, 0, NOW())';
        con.query(insertQuery, [data.user_id, data.other_user_id, data.message, group_id], function (err, res) {
            if (err) {
                console.error('Error inserting message:', err);
                return;
            }
            
            data.id = res.insertId;
            data.group_id = group_id;
            data.created_at = new Date();

            // Send message to all sockets in the chat room
            io.to(group_id).emit('receive_message', data);

            // Also send to user's other sockets (different tabs/devices)
            if (sockets[data.user_id]) {
                sockets[data.user_id].forEach(sock => {
                    if (!sock.rooms.has(group_id)) {
                        sock.emit('receive_message', data);
                    }
                });
            }

            // Get unread count for the recipient (messages from sender to recipient)
            const unreadQuery = `
                SELECT COUNT(id) AS unread_message
                FROM chats
                WHERE user_id = ? AND other_user_id = ? AND is_read = 0
            `;
            con.query(unreadQuery, [data.user_id, data.other_user_id], function (err, results) {
                if (err) {
                    console.error('Error getting unread count:', err);
                    return;
                }
                
                const unreadCount = results[0].unread_message || 0;

                // Send message to recipient's sockets with unread count
                if (sockets[data.other_user_id]) {
                    sockets[data.other_user_id].forEach(sock => {
                        const payload = Object.assign({}, data, { unread_message: unreadCount });
                        if (!sock.rooms.has(group_id)) {
                            sock.emit('receive_message', payload);
                        }
                        sock.emit('update_unread', {
                            from_user_id: data.user_id,
                            unread_message: unreadCount
                        });
                    });
                }
            });
        });
    });

    // Handle read_message
    socket.on('read_message', function (payload) {
        if (!payload) return;

        if (payload.id) {
            // Mark specific message as read
            con.query('UPDATE chats SET is_read = 1 WHERE id = ?', [payload.id], function (err) {
                if (err) console.error('Error marking message as read:', err);
            });
            return;
        }

        if (payload.from_user_id && payload.to_user_id) {
            // Mark all messages from sender to recipient as read
            con.query(
                'UPDATE chats SET is_read = 1 WHERE user_id = ? AND other_user_id = ? AND is_read = 0',
                [payload.from_user_id, payload.to_user_id],
                function (err) {
                    if (err) {
                        console.error('Error marking messages as read:', err);
                        return;
                    }

                    // Get updated unread count
                    const unreadQuery = `
                        SELECT COUNT(id) AS unread_message
                        FROM chats
                        WHERE user_id = ? AND other_user_id = ? AND is_read = 0
                    `;
                    con.query(unreadQuery, [payload.from_user_id, payload.to_user_id], function (err, results) {
                        if (err) {
                            console.error('Error getting updated unread count:', err);
                            return;
                        }
                        
                        const unreadCount = results[0].unread_message || 0;

                        // Notify recipient to update unread count
                        if (sockets[payload.to_user_id]) {
                            sockets[payload.to_user_id].forEach(sock => {
                                sock.emit('update_unread', {
                                    from_user_id: payload.from_user_id,
                                    unread_message: unreadCount
                                });
                            });
                        }

                        // Notify sender that messages were read
                        if (sockets[payload.from_user_id]) {
                            sockets[payload.from_user_id].forEach(sock => {
                                sock.emit('messages_read', {
                                    by_user_id: payload.to_user_id
                                });
                            });
                        }
                    });
                }
            );
        }
    });

    // Handle user_typing with improved logic
    socket.on('user_typing', function (data) {
        if (!data.user_id || !data.other_user_id) return;

        // Clear existing typing timeout for this user
        if (typingUsers[data.user_id]) {
            clearTimeout(typingUsers[data.user_id]);
        }

        // Emit typing event to recipient
        if (sockets[data.other_user_id]) {
            sockets[data.other_user_id].forEach(sock => {
                sock.emit('user_typing', data);
            });
        }

        // Set timeout to clear typing indicator
        typingUsers[data.user_id] = setTimeout(() => {
            if (sockets[data.other_user_id]) {
                sockets[data.other_user_id].forEach(sock => {
                    sock.emit('user_stopped_typing', data);
                });
            }
            delete typingUsers[data.user_id];
        }, 3000);
    });

    // Handle disconnect
    socket.on('disconnect', function () {
        console.log('User disconnecting:', userId);

        // Remove socket from user's socket array
        if (sockets[userId]) {
            sockets[userId] = sockets[userId].filter(s => s.id !== socket.id);
            
            // If no more sockets for this user, mark as offline
            if (sockets[userId].length === 0) {
                delete sockets[userId];
                
                // Remove user from online users set
                onlineUsers.delete(userId);
                
                // Clear any typing indicators for this user
                if (typingUsers[userId]) {
                    clearTimeout(typingUsers[userId]);
                    delete typingUsers[userId];
                }

                // Update user offline status in database
                con.query('UPDATE users SET is_online = 0 WHERE id = ?', [userId], function (err) {
                    if (err) console.error('Error updating user offline status:', err);
                    else {
                        console.log('User Disconnected: ' + userId);
                        
                        // Get user data for proper disconnection broadcast
                        con.query('SELECT name, email FROM users WHERE id = ?', [userId], function (err, results) {
                            if (err) console.error('Error fetching user data for disconnection:', err);
                            else {
                                const userData = results[0];
                                // Broadcast user disconnection to ALL other connected users
                                socket.broadcast.emit('user_disconnected', {
                                    id: userId,
                                    name: userData ? userData.name : '',
                                    email: userData ? userData.email : ''
                                });
                            }
                        });
                    }
                });
            }
        }
    });

    // Handle socket errors
    socket.on('error', function(error) {
        console.error('Socket error for user', userId, ':', error);
    });
});

const PORT = process.env.PORT || 3000;
http.listen(PORT, () => {
    console.log(`Socket server running on port ${PORT}`);
});