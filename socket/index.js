const express = require('express');
const app = express();
const http = require('http').Server(app);
const io = require('socket.io')(http, {
    cors: {
        origin: 'http://127.0.0.1:8000',
    }
});

const mysql = require('mysql');
const moment = require('moment');

const sockets = {};

const con = mysql.createConnection({
    host: 'localhost',
    user: 'root',
    password: '',
    database: 'laravel_chatappfinal'
});

con.connect(function (err) {
    if (err) throw err;
    console.log('Connected to MySQL database!');
});

io.on('connection', function (socket) {
    const userId = socket.handshake.query.user_id;

    if (!userId) {
        console.error('Connection rejected: Missing user_id in handshake.');
        socket.disconnect(true);
        return;
    }

    if (!sockets[userId]) {
        sockets[userId] = [];
    }

    sockets[userId].push(socket);

    socket.broadcast.emit('user_connected', userId);

    con.query('UPDATE users SET is_online = 1 WHERE id = ?', [userId], function (err) {
        if (err) throw err;
        console.log('User Connected: ' + userId);
    });

    socket.on('send_message', function (data) {
        var group_id = (data.user_id > data.other_user_id)
            ? data.user_id + data.other_user_id
            : data.other_user_id + data.user_id;

        var time = moment().format(' h:mm a');
        data.time = time;

        // Send message to both users



        // ✅ Safe parameterized SQL query
        const query = 'INSERT INTO chats (user_id, other_user_id, message, group_id) VALUES (?, ?, ?, ?)';
        con.query(query, [data.user_id, data.other_user_id, data.message, group_id], function (err, res) {
            if (err) throw err;
            data.id = res.insertId;
            for (var index in sockets[data.user_id]) {
                sockets[data.user_id][index].emit('receive_message', data);
            }
            for (var index in sockets[data.other_user_id]) {
                sockets[data.other_user_id][index].emit('receive_message', data);
            }
        });
    });

    socket.on('read_message', function (data) {
    const { from_user_id, to_user_id } = data;

    con.query(
        'UPDATE chats SET is_read = 1 WHERE from_user_id = ? AND to_user_id = ?',
        [from_user_id, to_user_id],
        function (err, res) {
            if (err) throw err;
            console.log(`Messages marked as read from ${from_user_id} to ${to_user_id}`);
        }
    );
});



    socket.on('disconnect', function () {
        socket.broadcast.emit('user_disconnected', userId);

        if (sockets[userId]) {
            sockets[userId] = sockets[userId].filter(s => s.id !== socket.id);
            if (sockets[userId].length === 0) {
                delete sockets[userId];
            }
        }

        con.query('UPDATE users SET is_online = 0 WHERE id = ?', [userId], function (err) {
            if (err) throw err;
            console.log('User Disconnected: ' + userId);
        });
    });
});

// ✅ Moved outside the io.on(...) block
http.listen(3000, () => {
    console.log('Socket server running on port 3000');
});
