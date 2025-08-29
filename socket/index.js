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
const typingUsers = {}; 
const onlineUsers = new Set(); 

//  MySQL Connection 
let con = mysql.createConnection({
    host: 'localhost',
    user: 'root',
    password: '',
    database: 'laravel_chatappfinal',
    charset: "utf8mb4" //for emoji support
});

con.connect(function (err) {
    if (err) throw err;
    console.log('Connected to database!');
});

// Handle DB disconnection
con.on('error', function (err) {
    if (err.code === 'PROTOCOL_CONNECTION_LOST') {
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

    con.connect(function (err) {
        if (err) {
            console.log('Error reconnecting: ', err);
            setTimeout(handleDisconnect, 2000);
        }
    });
}

// Socket.IO Logic
io.on('connection', function (socket) {
    const userId = socket.handshake.query.user_id;
    if (!userId) {
        console.error('Connection rejected - no user_id provided');
        socket.disconnect(true);
        return;
    }

    // Blocked user check before continuing
    con.query('SELECT is_blocked FROM users WHERE id = ?', [userId], function (err, results) {
        if (err) {
            console.error('Error checking blocked status:', err);
            socket.disconnect(true);
            return;
        }
        if (results.length === 0 || results[0].is_blocked === 1) {
            console.log(`Blocked user (${userId}) attempted to connect.`);
            socket.emit('blocked', { message: 'Your account is blocked by admin.' });
            socket.disconnect(true);
            return;
        }

        // Normal connection logic continues here
        console.log('User attempting connection:', userId);

        if (!sockets[userId]) sockets[userId] = [];
        sockets[userId].push(socket);

        const wasOffline = !onlineUsers.has(userId);
        onlineUsers.add(userId);

        if (wasOffline) {
            con.query('UPDATE users SET is_online = 1 WHERE id = ?', [userId], function (err) {
                if (err) console.error('Error updating user online status:', err);
                else console.log('User Connected: ' + userId);
            });
        }

        // Send user data back
        con.query('SELECT * FROM users WHERE id = ?', [userId], function (err, results) {
            if (err) {
                console.error('Error fetching user data:', err);
                return;
            }
            const userData = results[0];
            socket.emit('user_data', userData);

            if (wasOffline && userData) {
                socket.broadcast.emit('user_connected', {
                    id: parseInt(userId),
                    name: userData.name,
                    email: userData.email,
                    is_online: 1
                });
            }
        });

        // Notify about already online users
        if (onlineUsers.size > 1) {
            const otherOnlineUsers = Array.from(onlineUsers).filter(id => id !== userId);
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

        // Socket Events 
        socket.on('join_chat', function (data) {
            if (!data.user_id || !data.other_user_id) {
                console.error('Invalid join_chat data');
                return;
            }

            console.log(`User ${data.user_id} joining chat with ${data.other_user_id}`);

            const group_id = (String(data.user_id) > String(data.other_user_id))
                ? String(data.user_id) + String(data.other_user_id)
                : String(data.other_user_id) + String(data.user_id);

            socket.join(group_id);

            const historyQuery = `
                SELECT c.*, u.name as sender_name 
                FROM chats c 
                JOIN users u ON c.user_id = u.id 
                WHERE c.group_id = ? 
                ORDER BY c.created_at ASC 
                LIMIT 50
            `;

            con.query(historyQuery, [group_id], function (err, messages) {
                if (err) {
                    console.error('Error fetching chat history:', err);
                    return;
                }

                const processedMessages = messages.map(message => {
                    if (!message.message_type) {
                        message.message_type = isImageUrl(message.message) ? 'image' : 'text';
                    }
                    return message;
                });

                socket.emit('chat_history', {
                    messages: processedMessages,
                    group_id: group_id
                });

                console.log(`Sent ${processedMessages.length} messages to user ${data.user_id} for chat ${group_id}`);
            });

            function isImageUrl(message) {
                if (!message) return false;
                const imageExtensions = ['jpg', 'jpeg', 'png', 'gif', 'svg', 'webp'];
                const lowerMessage = message.toLowerCase();
                if (lowerMessage.includes('storage/chat_images')) return true;
                for (let ext of imageExtensions) {
                    if (lowerMessage.endsWith('.' + ext)) return true;
                }
                if (lowerMessage.startsWith('data:image/')) return true;
                return false;
            }

            con.query(
                'UPDATE chats SET is_read = 1 WHERE user_id = ? AND other_user_id = ? AND is_read = 0',
                [data.other_user_id, data.user_id],
                function (err) {
                    if (err) console.error('Error marking messages as read on join:', err);
                }
            );
        });

        socket.on('leave_chat', function (data) {
            if (!data.user_id || !data.other_user_id) return;

            const group_id = (String(data.user_id) > String(data.other_user_id))
                ? String(data.user_id) + String(data.other_user_id)
                : String(data.other_user_id) + String(data.user_id);

            socket.leave(group_id);
            console.log(`User ${data.user_id} left chat room ${group_id}`);
        });

        socket.on('send_message', function (data) {
            if (!data.user_id || !data.other_user_id || !data.message) {
                console.error('Invalid message data received');
                return;
            }

            // Blocked user check before sending
            con.query('SELECT is_blocked FROM users WHERE id = ?', [data.user_id], function (err, results) {
                if (err || results.length === 0 || results[0].is_blocked === 1) {
                    console.log(`Blocked user (${data.user_id}) tried to send a message.`);
                    socket.emit('blocked', { message: 'You cannot send messages, your account is blocked.' });
                    return;
                }

                const group_id = (String(data.user_id) > String(data.other_user_id))
                    ? String(data.user_id) + String(data.other_user_id)
                    : String(data.other_user_id) + String(data.user_id);

                const time = moment().format('h:mm A');
                data.time = time;

                const messageType = data.message_type || 'text';

                const insertQuery = 'INSERT INTO chats (user_id, other_user_id, message, message_type, group_id, is_read, created_at) VALUES (?, ?, ?, ?, ?, 0, NOW())';
                con.query(insertQuery, [data.user_id, data.other_user_id, data.message, messageType, group_id], function (err, res) {
                    if (err) {
                        console.error('Error inserting message:', err);
                        return;
                    }

                    data.id = res.insertId;
                    data.group_id = group_id;
                    data.message_type = messageType;
                    data.created_at = new Date();

                    io.to(group_id).emit('receive_message', data);

                    if (sockets[data.user_id]) {
                        sockets[data.user_id].forEach(sock => {
                            if (!sock.rooms.has(group_id)) {
                                sock.emit('receive_message', data);
                            }
                        });
                    }

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
        });

        // Handle read_message
        socket.on('read_message', function (payload) {
            if (!payload) return;

            if (payload.id) {
                con.query('UPDATE chats SET is_read = 1 WHERE id = ?', [payload.id], function (err) {
                    if (err) console.error('Error marking message as read:', err);
                });
                return;
            }

            if (payload.from_user_id && payload.to_user_id) {
                con.query(
                    'UPDATE chats SET is_read = 1 WHERE user_id = ? AND other_user_id = ? AND is_read = 0',
                    [payload.from_user_id, payload.to_user_id],
                    function (err) {
                        if (err) {
                            console.error('Error marking messages as read:', err);
                            return;
                        }

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

                            if (sockets[payload.to_user_id]) {
                                sockets[payload.to_user_id].forEach(sock => {
                                    sock.emit('update_unread', {
                                        from_user_id: payload.from_user_id,
                                        unread_message: unreadCount
                                    });
                                });
                            }

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

        // Handle user_typing
        socket.on('user_typing', function (data) {
            if (!data.user_id || !data.other_user_id) return;

            if (typingUsers[data.user_id]) {
                clearTimeout(typingUsers[data.user_id]);
            }

            if (sockets[data.other_user_id]) {
                sockets[data.other_user_id].forEach(sock => {
                    sock.emit('user_typing', data);
                });
            }

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

            if (sockets[userId]) {
                sockets[userId] = sockets[userId].filter(s => s.id !== socket.id);

                if (sockets[userId].length === 0) {
                    delete sockets[userId];
                    onlineUsers.delete(userId);

                    if (typingUsers[userId]) {
                        clearTimeout(typingUsers[userId]);
                        delete typingUsers[userId];
                    }

                    con.query('UPDATE users SET is_online = 0 WHERE id = ?', [userId], function (err) {
                        if (err) console.error('Error updating user offline status:', err);
                        else {
                            console.log('User Disconnected: ' + userId);

                            con.query('SELECT name, email FROM users WHERE id = ?', [userId], function (err, results) {
                                if (err) console.error('Error fetching user data for disconnection:', err);
                                else {
                                    const userData = results[0];
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
        socket.on('error', function (error) {
            console.error('Socket error for user', userId, ':', error);
        });
    });
});


const PORT = process.env.PORT || 3000;
http.listen(PORT, () => {
    console.log(`Socket server running on port ${PORT}`);
});
