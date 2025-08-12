@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="card" style="height: 80vh; display: flex; flex-direction: row; overflow: hidden;">
            <!-- Sidebar (Friend List) -->
            <div class="col-12 col-lg-4 border-end p-3" style="overflow-y: auto; background: #f7faff;">
                <div class="d-flex align-items-center mb-3">
                    <h5 class="mb-0" style="font-size: x-large; font-weight: 800;">
                         Chats <i class="fa-brands fa-rocketchat" style="margin-left: 285px"></i>
                    </h5>
                </div>

                @if ($friends->isEmpty())
                    <div class="text-muted">No friends found. Start adding friends to chat!</div>
                @endif
                <hr>
                @foreach ($friends as $friend)
                    <a href="{{ route('home', $friend->id) }}" class="text-decoration-none">
                        <div class="friend-item mb-2" id="friend_{{ $friend->id }}">
                            <img src="https://ui-avatars.com/api/?name={{ $friend->name }}" alt="{{ $friend->name }}">
                            <div>
                                <div class="friend-name">{{ $friend->name }}</div>
                                <div class="friend-status" id="status_{{ $friend->id }}">
                                    @if ($friend->is_online)
                                        <span class="fa fa-circle chat-online"></span> Online
                                    @else
                                        <span class="fa fa-circle chat-offline"></span> Offline
                                    @endif
                                </div>
                            </div>
                            <div class="ms-auto" id="unread_count_{{ $friend->id }}">
                                @if ($friend['unread_message'] > 0)
                                    <span class="badge bg-success">{{ $friend['unread_message'] }}</span>
                                @endif
                            </div>
                        </div>
                    </a>
                @endforeach
                <hr>
                <div class="d-flex align-items-center mb-3">
                    {{-- <div class="mb-0" style="font-size: x-large; font-weight: 800;">
                         Group Chats
                    </div> --}}
                </div>
            </div>

            <!-- Main Chat Area -->
            <div class="col-12 col-lg-8 d-flex flex-column" style="background: #fff;">
                @if ($id)
                    <!-- Chat Header -->
                    <div class="chat-header">
                        <img src="https://ui-avatars.com/api/?name={{ $otherUser->name }}" alt="{{ $otherUser->name }}"
                            width="40" height="40">
                        <div>
                            <strong>{{ $otherUser->name }}</strong>
                            <div class="text-muted small" id="typing-in"></div>
                        </div>
                    </div>

                    <!-- Chat Messages -->
                    <div class="chat-messages flex-grow-1" id="chat-messages-container">
                        <div class="text-center text-muted p-3" id="loading-messages">
                            <i class="fa fa-spinner fa-spin"></i> Loading messages...
                        </div>
                        <!-- Messages will be loaded here dynamically -->
                    </div>

                    <!-- Chat Input -->
                    <div class="chat-input">
                        <input type="text" id="message-input" placeholder="Type a message" autocomplete="on">
                        <button class="btn btn-primary" id="send-message-btn">Send <i class="fa-solid fa-paper-plane"></i></button>
                    </div>
                @else
                    <!-- Empty state -->
                    <div class="flex-grow-1 d-flex align-items-center justify-content-center">
                        <div class="text-muted">Select a friend to start chatting</div>
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <!-- Include Socket.io & Chat JS -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.socket.io/4.6.1/socket.io.min.js"></script>
    <script>
        var tout;
        var currentChatLoaded = false;
        
        $(function() {
            var user_id = "{{ auth()->id() }}";
            var currentChatId = "{{ $otherUser ? $otherUser->id : '' }}";
            var otherUserName = "{{ $otherUser ? $otherUser->name : '' }}";

            var socket = io('http://localhost:3000', {
                query: {
                    user_id: user_id
                }
            });

            var chatMessages = $("#chat-messages-container");

            // Join chat room when opening a conversation
            @if ($otherUser)
                socket.emit('join_chat', {
                    user_id: user_id,
                    other_user_id: currentChatId
                });
            @endif

            // Handle chat history when received
            socket.on('chat_history', function(data) {
                console.log('Received chat history:', data);
                
                // Clear loading message and existing messages
                chatMessages.empty();
                currentChatLoaded = true;

                if (data.messages.length === 0) {
                    chatMessages.append('<div class="text-center text-muted p-3">No messages yet. Start the conversation!</div>');
                } else {
                    // Display chat history
                    data.messages.forEach(function(message) {
                        appendMessage(message);
                    });
                }

                // Scroll to bottom
                scrollToBottom();

                // Mark messages as read
                socket.emit('read_message', {
                    from_user_id: currentChatId,
                    to_user_id: user_id
                });
            });

            function appendMessage(data) {
                const time = data.time || formatTime(data.created_at);
                let html;
                
                if (String(data.user_id) === String(user_id)) {
                    html = `<div class="chat-message-right">
                        <div class="message-content">
                            ${escapeHtml(data.message)}
                            <div class="timestamp">${time}</div>
                        </div>
                    </div>`;
                } else {
                    html = `<div class="chat-message-left">
                        <div class="message-content">
                            ${escapeHtml(data.message)}
                            <div class="timestamp">${time}</div>
                        </div>
                    </div>`;
                }
                
                chatMessages.append(html);
            }

            function formatTime(dateString) {
                const date = new Date(dateString);
                return date.toLocaleTimeString('en-US', { 
                    hour: 'numeric', 
                    minute: '2-digit', 
                    hour12: true 
                });
            }

            function scrollToBottom() {
                if (chatMessages.length) {
                    chatMessages.scrollTop(chatMessages[0].scrollHeight);
                }
            }

            // Send message
            $("#send-message-btn").on('click', function() {
                sendMessage();
            });

            $("#message-input").keypress(function(e) {
                if (e.which === 13) sendMessage();
            });

            function sendMessage() {
                var message = $("#message-input").val();
                if (!message.trim() || !currentChatLoaded) return;
                
                socket.emit('send_message', {
                    user_id: user_id,
                    other_user_id: currentChatId,
                    message: message,
                    otherUserName: otherUserName
                });
                $("#message-input").val('');
            }

            // Receive message
            socket.on('receive_message', function(data) {
                if (String(data.user_id) === String(user_id) || String(data.user_id) === String(currentChatId)) {
                    // Only append if in current chat
                    if (currentChatLoaded) {
                        // Remove "no messages" placeholder if exists
                        chatMessages.find('.text-center.text-muted').remove();
                        
                        appendMessage(data);
                        scrollToBottom();

                        // Mark as read if from other user and we're in the chat
                        if (String(data.user_id) === String(currentChatId)) {
                            socket.emit('read_message', {
                                from_user_id: data.user_id,
                                to_user_id: user_id
                            });
                        }
                    }
                } else {
                    // Handle unread message from other users (not in current chat)
                    var currentUnreadBadge = $("#unread_count_" + data.user_id + " .badge");
                    var currentCount = currentUnreadBadge.length ? parseInt(currentUnreadBadge.text()) || 0 : 0;
                    $("#unread_count_" + data.user_id).html('<span class="badge bg-success">' + (currentCount + 1) + '</span>');

                    // Show push notification for messages from other users
                    if (typeof Push !== 'undefined' && Push.Permission.has()) {
                        Push.create("New Message", {
                            body: (data.otherUserName || 'Someone') + ": " + data.message.substring(0, 50) + (data.message.length > 50 ? '...' : ''),
                            icon: "https://ui-avatars.com/api/?name=" + encodeURIComponent(data.otherUserName || 'User'),
                            timeout: 5000,
                            onClick: function() {
                                window.focus();
                                this.close();
                            }
                        });
                    }
                }
            });

            socket.on('update_unread', function(data) {
                if (data.unread_message > 0) {
                    $("#unread_count_" + data.from_user_id).html('<span class="badge bg-success">' + data.unread_message + '</span>');
                } else {
                    $("#unread_count_" + data.from_user_id).html('');
                }
            });

            // User connection handling with push notifications
            socket.on('user_connected', function(data) {
                console.log('User connected:', data);
                var userId = data.id || data;
                
                // Update status for the connected user
                $("#status_" + userId).html('<span class="fa fa-circle chat-online"></span> Online');
                
                // Don't show notification for your own connection
                if (String(userId) === String(user_id)) {
                    return;
                }
                
                // Show notification if Push is available and user has a name
                if (typeof Push !== 'undefined' && data.name && Push.Permission.has()) {
                    Push.create("User Online", {
                        body: data.name + " is now online",
                        icon: "https://ui-avatars.com/api/?name=" + encodeURIComponent(data.name),
                        timeout: 4000,
                        onClick: function() {
                            window.focus();
                            this.close();
                        }
                    });
                }
            });

            // User disconnection handling
            socket.on('user_disconnected', function(data) {
                console.log('User disconnected:', data);
                var userId = data.id || data;
                $("#status_" + userId).html('<span class="fa fa-circle chat-offline"></span> Offline');
            });

            function escapeHtml(text) {
                return $('<div>').text(text).html();
            }

            // Typing indicators
            socket.on('user_typing', function(data) {
                if (String(data.user_id) === String(currentChatId)) {
                    $("#typing-in").html('<em>Typing...</em>');
                    clearTyping();
                }
            });

            socket.on('user_stopped_typing', function(data) {
                if (String(data.user_id) === String(currentChatId)) {
                    $("#typing-in").html('');
                }
            });

            $("#message-input").on('keyup', function() {
                if (currentChatId && currentChatLoaded) {
                    socket.emit('user_typing', {
                        user_id: user_id,
                        other_user_id: currentChatId
                    });
                }
            });

            function clearTyping() {
                clearTimeout(tout);
                tout = setTimeout(function() {
                    $("#typing-in").html('');
                }, 3000);
            }

            // Connection error handling
            socket.on('connect_error', function(error) {
                console.error('Connection failed:', error);
            });

            socket.on('disconnect', function() {
                console.log('Disconnected from server');
                currentChatLoaded = false;
            });

            // Handle successful connection
            socket.on('connect', function() {
                console.log('Connected to socket server');
                
                // Request notification permission
                if (typeof Push !== 'undefined' && Push.Permission.get() === Push.Permission.DEFAULT) {
                    Push.Permission.request();
                }
            });

            // Handle receiving user data
            socket.on('user_data', function(userData) {
                console.log('Received user data:', userData);
            });

            // Handle page unload - leave chat room
            $(window).on('beforeunload', function() {
                if (currentChatId) {
                    socket.emit('leave_chat', {
                        user_id: user_id,
                        other_user_id: currentChatId
                    });
                }
            });
        });
    </script>
@endsection