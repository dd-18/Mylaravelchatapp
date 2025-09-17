const express = require("express");
const app = express();
const http = require("http").Server(app);
const io = require("socket.io")(http, {
    cors: {
        origin: "http://127.0.0.1:8000",
        methods: ["GET", "POST"],
    },
});

const mysql = require("mysql");
const moment = require("moment");

const sockets = {};
const typingUsers = {};
const onlineUsers = new Set();

// MySQL Connection
let con = mysql.createConnection({
    host: "localhost",
    user: "root",
    password: "",
    database: "laravel_chatappfinal",
    charset: "utf8mb4", // for emoji support
});

con.connect(function (err) {
    if (err) throw err;
    console.log("Connected to database!");
});

con.on("error", function (err) {
    if (err.code === "PROTOCOL_CONNECTION_LOST") {
        console.log("Database connection lost. Attempting to reconnect...");
        handleDisconnect();
    } else {
        throw err;
    }
});

function handleDisconnect() {
    con = mysql.createConnection({
        host: "localhost",
        user: "root",
        password: "",
        database: "laravel_chatappfinal",
        charset: "utf8mb4",
    });

    con.connect(function (err) {
        if (err) {
            console.log("Error reconnecting: ", err);
            setTimeout(handleDisconnect, 2000);
        }
    });
}

// Helper function to detect image URLs
function isImageUrl(message) {
    if (!message) return false;
    const imageExtensions = ["jpg", "jpeg", "png", "gif", "svg", "webp"];
    const lowerMessage = message.toLowerCase();

    // Check if it's a chat image from storage
    if (lowerMessage.includes("storage/chat_images")) return true;

    // Check file extensions
    for (let ext of imageExtensions) {
        if (lowerMessage.endsWith("." + ext)) return true;
    }

    // Check for base64 images
    if (lowerMessage.startsWith("data:image/")) return true;

    return false;
}

// Socket.IO Logic
io.on("connection", function (socket) {
    const userId = socket.handshake.query.user_id;
    if (!userId) {
        console.error("Connection rejected - no user_id provided");
        socket.disconnect(true);
        return;
    }

    // Blocked user check
    con.query(
        "SELECT is_blocked FROM users WHERE id = ?",
        [userId],
        function (err, results) {
            if (err) {
                console.error("Error checking blocked status:", err);
                socket.disconnect(true);
                return;
            }
            if (results.length === 0 || results[0].is_blocked === 1) {
                console.log(`Blocked user (${userId}) attempted to connect.`);
                socket.emit("blocked", {
                    message: "Your account is blocked by admin.",
                });
                socket.disconnect(true);
                return;
            }

            // Normal connection logic
            if (!sockets[userId]) sockets[userId] = [];
            sockets[userId].push(socket);

            const wasOffline = !onlineUsers.has(userId);
            onlineUsers.add(userId);

            if (wasOffline) {
                con.query(
                    "UPDATE users SET is_online = 1 WHERE id = ?",
                    [userId],
                    function (err) {
                        if (err)
                            console.error(
                                "Error updating user online status:",
                                err
                            );
                        else console.log("User Connected: " + userId);
                    }
                );
            }

            // Send user data
            con.query(
                "SELECT * FROM users WHERE id = ?",
                [userId],
                function (err, results) {
                    if (err) {
                        console.error("Error fetching user data:", err);
                        return;
                    }
                    const userData = results[0];
                    socket.emit("user_data", userData);

                    if (wasOffline && userData) {
                        socket.broadcast.emit("user_connected", {
                            id: parseInt(userId),
                            name: userData.name,
                            email: userData.email,
                            is_online: 1,
                        });
                    }
                }
            );

            // Notify about already online users
            if (onlineUsers.size > 1) {
                const otherOnlineUsers = Array.from(onlineUsers).filter(
                    (id) => id !== userId
                );
                if (otherOnlineUsers.length > 0) {
                    const placeholders = otherOnlineUsers
                        .map(() => "?")
                        .join(",");
                    con.query(
                        `SELECT id, name, email FROM users WHERE id IN (${placeholders})`,
                        otherOnlineUsers,
                        function (err, onlineUsersData) {
                            if (err)
                                console.error(
                                    "Error fetching online users data:",
                                    err
                                );
                            else {
                                onlineUsersData.forEach((user) => {
                                    socket.emit("user_connected", {
                                        id: parseInt(user.id),
                                        name: user.name,
                                        email: user.email,
                                        is_online: 1,
                                    });
                                });
                            }
                        }
                    );
                }
            }

            // ---- Socket Events ---- //

            socket.on("join_chat", function (data) {
                if (!data.user_id || !data.other_user_id) return;

                const group_id = [data.user_id, data.other_user_id]
                    .map(String)
                    .sort((a, b) => Number(a) - Number(b))
                    .join("");

                socket.join(group_id);

                // Fetch last 50 messages
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
                        console.error("Error fetching chat history:", err);
                        return;
                    }

                    const processedMessages = messages.map((message) => {
                        if (!message.message_type) {
                            message.message_type = isImageUrl(message.message)
                                ? "image"
                                : "text";
                        }
                        return message;
                    });

                    socket.emit("chat_history", {
                        messages: processedMessages,
                        group_id: group_id,
                    });
                });

                // Mark messages as read
                con.query(
                    "UPDATE chats SET is_read = 1 WHERE user_id = ? AND other_user_id = ? AND is_read = 0",
                    [data.other_user_id, data.user_id],
                    function (err) {
                        if (err)
                            console.error(
                                "Error marking messages as read on join:",
                                err
                            );
                    }
                );
            });

            socket.on("leave_chat", function (data) {
                if (!data.user_id || !data.other_user_id) return;

                const group_id = [data.user_id, data.other_user_id]
                    .map(String)
                    .sort((a, b) => Number(a) - Number(b))
                    .join("");

                socket.leave(group_id);

                // 🔹 FIX: stop typing when leaving chat
                if (typingUsers[data.user_id]) {
                    clearTimeout(typingUsers[data.user_id]);
                    delete typingUsers[data.user_id];

                    if (sockets[data.other_user_id]) {
                        sockets[data.other_user_id].forEach((sock) =>
                            sock.emit("user_stopped_typing", data)
                        );
                    }
                }
            });

            socket.on("send_message", function (data) {
                if (!data.user_id || !data.other_user_id || !data.message)
                    return;

                const group_id = [data.user_id, data.other_user_id]
                    .map(String)
                    .sort((a, b) => Number(a) - Number(b))
                    .join("");

                const messageType = data.message_type || "text";
                const time = moment().format("h:mm A");
                data.time = time;

                // Insert into DB first
                const insertQuery =
                    "INSERT INTO chats (user_id, other_user_id, message, message_type, group_id, is_read, created_at) VALUES (?, ?, ?, ?, ?, 0, NOW())";
                con.query(
                    insertQuery,
                    [
                        data.user_id,
                        data.other_user_id,
                        data.message,
                        messageType,
                        group_id,
                    ],
                    function (err, res) {
                        if (err)
                            return console.error(
                                "Error inserting message:",
                                err
                            );

                        data.id = res.insertId;
                        data.group_id = group_id;
                        data.message_type = messageType;
                        data.created_at = new Date();

                        // Emit to current chat room
                        io.to(group_id).emit("receive_message", data);

                        // Update unread count for the other user
                        const unreadQuery = `
                SELECT COUNT(id) AS unread_message 
                FROM chats 
                WHERE user_id = ? AND other_user_id = ? AND is_read = 0
            `;
                        con.query(
                            unreadQuery,
                            [data.user_id, data.other_user_id],
                            function (err, results) {
                                if (!err && sockets[data.other_user_id]) {
                                    const unreadCount =
                                        results[0].unread_message || 0;
                                    sockets[data.other_user_id].forEach(
                                        (sock) => {
                                            sock.emit("update_unread", {
                                                from_user_id: data.user_id,
                                                unread_message: unreadCount,
                                            });
                                        }
                                    );
                                }
                            }
                        );
                    }
                );
            });

            socket.on("read_message", function (payload) {
                if (!payload) return;

                if (payload.from_user_id && payload.to_user_id) {
                    const from = payload.from_user_id;
                    const to = payload.to_user_id;

                    con.query(
                        "UPDATE chats SET is_read = 1 WHERE user_id = ? AND other_user_id = ? AND is_read = 0",
                        [from, to],
                        function (err) {
                            if (err)
                                return console.error(
                                    "Error marking messages as read:",
                                    err
                                );

                            // Update unread badge for receiver
                            const unreadQuery = `SELECT COUNT(id) AS unread_message FROM chats WHERE user_id = ? AND other_user_id = ? AND is_read = 0`;
                            con.query(
                                unreadQuery,
                                [from, to],
                                function (err, results) {
                                    const unreadCount =
                                        results[0].unread_message || 0;

                                    if (sockets[to]) {
                                        sockets[to].forEach((sock) => {
                                            sock.emit("update_unread", {
                                                from_user_id: from,
                                                unread_message: unreadCount,
                                            });
                                        });
                                    }

                                    // Notify sender that messages were read
                                    if (sockets[from]) {
                                        sockets[from].forEach((sock) => {
                                            sock.emit("messages_read", {
                                                by_user_id: to,
                                            });
                                        });
                                    }
                                }
                            );
                        }
                    );
                }
            });

            socket.on("user_typing", function (data) {
                if (!data.user_id || !data.other_user_id) return;

                // Clear any existing timeout for this user
                if (typingUsers[data.user_id])
                    clearTimeout(typingUsers[data.user_id]);

                // Broadcast typing to the other user
                if (sockets[data.other_user_id]) {
                    sockets[data.other_user_id].forEach((sock) =>
                        sock.emit("user_typing", data)
                    );
                }

                // Set a new timeout to stop typing after 2s of inactivity
                typingUsers[data.user_id] = setTimeout(() => {
                    if (sockets[data.other_user_id]) {
                        sockets[data.other_user_id].forEach((sock) =>
                            sock.emit("user_stopped_typing", data)
                        );
                    }
                    delete typingUsers[data.user_id];
                }, 2000); // 2 seconds for smoother experience
            });

            socket.on("disconnect", function () {
                if (sockets[userId]) {
                    sockets[userId] = sockets[userId].filter(
                        (s) => s.id !== socket.id
                    );

                    if (sockets[userId].length === 0) {
                        delete sockets[userId];
                        onlineUsers.delete(userId);

                        // 🔹 FIX: if user was typing, notify others they stopped
                        if (typingUsers[userId]) {
                            clearTimeout(typingUsers[userId]);
                            delete typingUsers[userId];

                            // let everyone know this user stopped typing
                            socket.broadcast.emit("user_stopped_typing", {
                                user_id: userId,
                            });
                        }

                        con.query(
                            "UPDATE users SET is_online = 0 WHERE id = ?",
                            [userId],
                            function (err) {
                                if (!err) {
                                    con.query(
                                        "SELECT name, email FROM users WHERE id = ?",
                                        [userId],
                                        function (err, results) {
                                            if (!err) {
                                                const userData = results[0];
                                                socket.broadcast.emit(
                                                    "user_disconnected",
                                                    {
                                                        id: userId,
                                                        name: userData
                                                            ? userData.name
                                                            : "",
                                                        email: userData
                                                            ? userData.email
                                                            : "",
                                                    }
                                                );
                                            }
                                        }
                                    );
                                }
                            }
                        );
                    }
                }
            });

            socket.on("error", function (error) {
                console.error("Socket error for user", userId, ":", error);
            });

            socket.on("edit_message", function (data) {
                if (!data.message_id || !data.new_message || !data.user_id)
                    return;

                // Verify the message belongs to the user
                con.query(
                    "SELECT * FROM chats WHERE id = ? AND user_id = ?",
                    [data.message_id, data.user_id],
                    function (err, results) {
                        if (err || results.length === 0) {
                            socket.emit("error", {
                                message: "Cannot edit this message",
                            });
                            return;
                        }

                        // Update the message
                        con.query(
                            "UPDATE chats SET message = ?, updated_at = NOW() WHERE id = ? AND user_id = ?",
                            [data.new_message, data.message_id, data.user_id],
                            function (err) {
                                if (err) {
                                    console.error(
                                        "Error updating message:",
                                        err
                                    );
                                    socket.emit("error", {
                                        message: "Failed to update message",
                                    });
                                    return;
                                }

                                const group_id = [
                                    data.user_id,
                                    data.other_user_id,
                                ]
                                    .map(String)
                                    .sort((a, b) => Number(a) - Number(b))
                                    .join("");

                                // Broadcast the edit to all users in the chat
                                io.to(group_id).emit("message_edited", {
                                    message_id: data.message_id,
                                    new_message: data.new_message,
                                    user_id: data.user_id,
                                });
                            }
                        );
                    }
                );
            });

            socket.on("delete_message", function (data) {
                if (!data.message_id || !data.user_id) return;

                // Verify the message belongs to the user
                con.query(
                    "SELECT * FROM chats WHERE id = ? AND user_id = ?",
                    [data.message_id, data.user_id],
                    function (err, results) {
                        if (err || results.length === 0) {
                            socket.emit("error", {
                                message: "Cannot delete this message",
                            });
                            return;
                        }

                        // Mark as deleted instead of actually deleting
                        con.query(
                            "UPDATE chats SET message = 'Message deleted', message_type = 'deleted', updated_at = NOW() WHERE id = ? AND user_id = ?",
                            [data.message_id, data.user_id],
                            function (err) {
                                if (err) {
                                    console.error(
                                        "Error deleting message:",
                                        err
                                    );
                                    socket.emit("error", {
                                        message: "Failed to delete message",
                                    });
                                    return;
                                }

                                const group_id = [
                                    data.user_id,
                                    data.other_user_id,
                                ]
                                    .map(String)
                                    .sort((a, b) => Number(a) - Number(b))
                                    .join("");

                                // Broadcast the deletion to all users in the chat
                                io.to(group_id).emit("message_deleted", {
                                    message_id: data.message_id,
                                    user_id: data.user_id,
                                });
                            }
                        );
                    }
                );
            });

            socket.on("get_message_info", function (data) {
                if (!data.message_id || !data.user_id) return;

                con.query(
                    "SELECT *, DATE_FORMAT(created_at, '%W, %M %e, %Y at %l:%i %p') as formatted_created_at, DATE_FORMAT(updated_at, '%W, %M %e, %Y at %l:%i %p') as formatted_updated_at FROM chats WHERE id = ?",
                    [data.message_id],
                    function (err, results) {
                        if (err || results.length === 0) {
                            socket.emit("error", {
                                message: "Message not found",
                            });
                            return;
                        }

                        const messageInfo = results[0];

                        // Check if message was actually edited (updated_at is different from created_at)
                        if (
                            messageInfo.updated_at &&
                            new Date(messageInfo.updated_at).getTime() !==
                                new Date(messageInfo.created_at).getTime()
                        ) {
                            messageInfo.last_edited =
                                messageInfo.formatted_updated_at;
                            messageInfo.was_edited = true;
                        } else {
                            messageInfo.last_edited = null;
                            messageInfo.was_edited = false;
                        }

                        // Format the original creation time
                        messageInfo.formatted_time =
                            messageInfo.formatted_created_at;

                        socket.emit("message_info", messageInfo);
                    }
                );
            });
        }
    );
});

const PORT = process.env.PORT || 3000;
http.listen(PORT, () => {
    console.log(`Socket server running on port ${PORT}`);
});
