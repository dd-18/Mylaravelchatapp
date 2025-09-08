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
                            <img src="{{ $friend->user_image ? asset('storage/users/' . $friend->user_image) : 'https://ui-avatars.com/api/?name=' . urlencode($friend->name) }}"
                                 alt="{{ $friend->name }}"
                                 width="40" height="40"
                                 style="border-radius: 50%; object-fit: cover;">
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
                        <img src="{{ $otherUser->user_image ? asset('storage/users/' . $otherUser->user_image) : 'https://ui-avatars.com/api/?name=' . urlencode($otherUser->name) }}"
                             alt="{{ $otherUser->name }}"
                             width="40" height="40"
                             style="border-radius: 50%; object-fit: cover;">
                        <div>
                            <strong style="text-transform: capitalize;">{{ $otherUser->name }}</strong>
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
                    <div class="chat-input" style="position: relative; ">
                        <!-- Emoji -->
                        <div id="emoji-picker" style="display: none; position: absolute; bottom: 60px; left: 10px; background: white; border: 1px solid #ddd; border-radius: 10px; padding: 15px; box-shadow: 0 4px 12px rgba(0,0,0,0.15); z-index: 1000; max-width: 300px; max-height: 200px; overflow-y: auto;">
                            <div style="display: grid; grid-template-columns: repeat(8, 1fr); gap: 5px;">
                                <!-- Common emojis -->
                                <span class="emoji-item" style="cursor: pointer; padding: 5px; text-align: center; border-radius: 5px; font-size: 20px;">😀</span>
                                <span class="emoji-item" style="cursor: pointer; padding: 5px; text-align: center; border-radius: 5px; font-size: 20px;">😂</span>
                                <span class="emoji-item" style="cursor: pointer; padding: 5px; text-align: center; border-radius: 5px; font-size: 20px;">🤣</span>
                                <span class="emoji-item" style="cursor: pointer; padding: 5px; text-align: center; border-radius: 5px; font-size: 20px;">😊</span>
                                <span class="emoji-item" style="cursor: pointer; padding: 5px; text-align: center; border-radius: 5px; font-size: 20px;">😍</span>
                                <span class="emoji-item" style="cursor: pointer; padding: 5px; text-align: center; border-radius: 5px; font-size: 20px;">🥰</span>
                                <span class="emoji-item" style="cursor: pointer; padding: 5px; text-align: center; border-radius: 5px; font-size: 20px;">😘</span>
                                <span class="emoji-item" style="cursor: pointer; padding: 5px; text-align: center; border-radius: 5px; font-size: 20px;">😎</span>
                                <span class="emoji-item" style="cursor: pointer; padding: 5px; text-align: center; border-radius: 5px; font-size: 20px;">😢</span>
                                <span class="emoji-item" style="cursor: pointer; padding: 5px; text-align: center; border-radius: 5px; font-size: 20px;">😭</span>
                                <span class="emoji-item" style="cursor: pointer; padding: 5px; text-align: center; border-radius: 5px; font-size: 20px;">😡</span>
                                <span class="emoji-item" style="cursor: pointer; padding: 5px; text-align: center; border-radius: 5px; font-size: 20px;">🤔</span>
                                <span class="emoji-item" style="cursor: pointer; padding: 5px; text-align: center; border-radius: 5px; font-size: 20px;">🙄</span>
                                <span class="emoji-item" style="cursor: pointer; padding: 5px; text-align: center; border-radius: 5px; font-size: 20px;">😴</span>
                                <span class="emoji-item" style="cursor: pointer; padding: 5px; text-align: center; border-radius: 5px; font-size: 20px;">🤗</span>
                                <span class="emoji-item" style="cursor: pointer; padding: 5px; text-align: center; border-radius: 5px; font-size: 20px;">🤩</span>
                                <span class="emoji-item" style="cursor: pointer; padding: 5px; text-align: center; border-radius: 5px; font-size: 20px;">👍</span>
                                <span class="emoji-item" style="cursor: pointer; padding: 5px; text-align: center; border-radius: 5px; font-size: 20px;">👎</span>
                                <span class="emoji-item" style="cursor: pointer; padding: 5px; text-align: center; border-radius: 5px; font-size: 20px;">👏</span>
                                <span class="emoji-item" style="cursor: pointer; padding: 5px; text-align: center; border-radius: 5px; font-size: 20px;">🙏</span>
                                <span class="emoji-item" style="cursor: pointer; padding: 5px; text-align: center; border-radius: 5px; font-size: 20px;">❤️</span>
                                <span class="emoji-item" style="cursor: pointer; padding: 5px; text-align: center; border-radius: 5px; font-size: 20px;">💕</span>
                                <span class="emoji-item" style="cursor: pointer; padding: 5px; text-align: center; border-radius: 5px; font-size: 20px;">💖</span>
                                <span class="emoji-item" style="cursor: pointer; padding: 5px; text-align: center; border-radius: 5px; font-size: 20px;">🔥</span>
                                <span class="emoji-item" style="cursor: pointer; padding: 5px; text-align: center; border-radius: 5px; font-size: 20px;">✨</span>
                                <span class="emoji-item" style="cursor: pointer; padding: 5px; text-align: center; border-radius: 5px; font-size: 20px;">💯</span>
                                <span class="emoji-item" style="cursor: pointer; padding: 5px; text-align: center; border-radius: 5px; font-size: 20px;">🎉</span>
                                <span class="emoji-item" style="cursor: pointer; padding: 5px; text-align: center; border-radius: 5px; font-size: 20px;">🎊</span>
                                <span class="emoji-item" style="cursor: pointer; padding: 5px; text-align: center; border-radius: 5px; font-size: 20px;">🌟</span>
                                <span class="emoji-item" style="cursor: pointer; padding: 5px; text-align: center; border-radius: 5px; font-size: 20px;">🌈</span>
                                <span class="emoji-item" style="cursor: pointer; padding: 5px; text-align: center; border-radius: 5px; font-size: 20px;">🌹</span>
                                <span class="emoji-item" style="cursor: pointer; padding: 5px; text-align: center; border-radius: 5px; font-size: 20px;">🎂</span>
                            </div>
                        </div>

                        <!-- Main input row -->
                        <div style="display: flex; align-items: center; gap: 8px;">
                            <!-- Image upload button -->
                            <button type="button" id="image-upload-btn" style="background: none; border: none; color: #666; font-size: 18px; cursor: pointer; padding: 8px;">
                                <i class="fa-solid fa-image"></i>
                            </button>
                            
                            <!-- Hidden file input -->
                            <input type="file" id="image-upload-input" accept="image/*" style="display: none;">
                            
                            <!-- Emoji button -->
                            <button type="button" id="emoji-btn" style="background: none; border: none; color: #666; font-size: 18px; cursor: pointer; padding: 8px;">
                                <i class="fa-solid fa-smile"></i>
                            </button>
                            
                            <!-- Message input -->
                            <input type="text" id="message-input" placeholder="Type a message" autocomplete="on" style="flex: 1;">
                            
                            <!-- Send button -->
                            <button class="btn btn-primary" id="send-message-btn">Send <i class="fa-solid fa-paper-plane"></i></button>
                        </div>
                        
                        <!-- Image preview area (Hidden by default) -->
                        <div id="image-preview-container" style="display: none; margin-top: 10px; position: relative;">
                            <div style="position: relative; display: inline-block;">
                                <img id="image-preview" src="" alt="Preview" style="max-width: 200px; max-height: 200px; border-radius: 10px; border: 1px solid #ddd;">
                                <button type="button" id="remove-image-btn" style="position: absolute; top: -8px; right: -8px; background: #ff4444; color: white; border: none; border-radius: 50%; width: 24px; height: 24px; cursor: pointer; font-size: 12px;">✕</button>
                            </div>
                        </div>
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

    <!-- Image Modal for full view -->
    <div class="modal fade" id="imageModal" tabindex="-1" aria-labelledby="imageModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="imageModalLabel">Image</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body text-center">
                    <img id="modal-image" src="" alt="Full size image" style="max-width: 100%; height: auto;">
                </div>
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
        var selectedImage = null;

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
                    chatMessages.append(
                        '<div class="text-center text-muted p-3">No messages yet. Start the conversation!</div>'
                    );
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
                let messageContent = '';

                // Check if message is an image - handle both explicit type and URL detection
                if (data.message_type === 'image' || isImageUrl(data.message)) {
                    messageContent =
                        `<img src="${escapeHtml(data.message)}" alt="Image" style="max-width: 200px; max-height: 200px; border-radius: 10px; cursor: pointer;" onclick="showImageModal('${escapeHtml(data.message)}')">`;
                } else {
                    // For text messages, also convert URLs to clickable links and handle emojis
                    messageContent = formatTextMessage(data.message);
                }

                let html;
                if (String(data.user_id) === String(user_id)) {
                    html = `<div class="chat-message-right">
                        <div class="message-content">
                            ${messageContent}
                            <div class="timestamp">${time}</div>
                        </div>
                    </div>`;
                } else {
                    html = `<div class="chat-message-left">
                        <div class="message-content">
                            ${messageContent}
                            <div class="timestamp">${time}</div>
                        </div>
                    </div>`;
                }

                chatMessages.append(html);
            }

            // Helper function to detect if a message is an image URL
            function isImageUrl(message) {
                if (!message) return false;
                const imageExtensions = ['jpg', 'jpeg', 'png', 'gif', 'svg', 'webp'];
                const lowerMessage = message.toLowerCase();

                // Check if it contains storage/chat_images (our upload path)
                if (lowerMessage.includes('storage/chat_images')) {
                    return true;
                }

                // Check if it ends with image extension
                for (let ext of imageExtensions) {
                    if (lowerMessage.endsWith('.' + ext)) {
                        return true;
                    }
                }

                // Check if it's a data URL (base64 image)
                if (lowerMessage.startsWith('data:image/')) {
                    return true;
                }

                return false;
            }

            // Helper function to format text messages (handle links, etc.)
            function formatTextMessage(message) {
                let formatted = escapeHtml(message);

                // Convert URLs to clickable links
                const urlRegex = /(https?:\/\/[^\s]+)/g;
                formatted = formatted.replace(urlRegex,
                    '<a href="$1" target="_blank" rel="noopener noreferrer">$1</a>');

                return formatted;
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

            // Image upload functionality
            $("#image-upload-btn").on('click', function() {
                $("#image-upload-input").click();
            });

            $("#image-upload-input").on('change', function(e) {
                const file = e.target.files[0];
                if (file && file.type.startsWith('image/')) {
                    selectedImage = file;

                    // Show preview
                    const reader = new FileReader();
                    reader.onload = function(e) {
                        $("#image-preview").attr('src', e.target.result);
                        $("#image-preview-container").show();
                    };
                    reader.readAsDataURL(file);
                }
            });

            $("#remove-image-btn").on('click', function() {
                selectedImage = null;
                $("#image-preview-container").hide();
                $("#image-upload-input").val('');
            });

            // Emoji functionality
            $("#emoji-btn").on('click', function() {
                $("#emoji-picker").toggle();
            });

            // Hide emoji picker when clicking outside
            $(document).on('click', function(e) {
                if (!$(e.target).closest('#emoji-btn, #emoji-picker').length) {
                    $("#emoji-picker").hide();
                }
            });

            // Add emoji to input
            $(".emoji-item").on('click', function() {
                const emoji = $(this).text();
                const input = $("#message-input");
                const currentValue = input.val();
                input.val(currentValue + emoji);
                $("#emoji-picker").hide();
                input.focus();
            });

            // Send message (modified to handle images)
            $("#send-message-btn").on('click', function() {
                sendMessage();
            });

            $("#message-input").keypress(function(e) {
                if (e.which === 13) sendMessage();
            });

            function sendMessage() {
                var textMessage = $("#message-input").val().trim();

                if (!currentChatLoaded) return;

                if (selectedImage) {
                    // Send image
                    sendImageMessage(selectedImage);
                } else if (textMessage) {
                    // Send text message
                    socket.emit('send_message', {
                        user_id: user_id,
                        other_user_id: currentChatId,
                        message: textMessage,
                        message_type: 'text',
                        otherUserName: otherUserName
                    });
                    $("#message-input").val('');
                }
            }

            function sendImageMessage(imageFile) {
                const formData = new FormData();
                formData.append('image', imageFile);
                formData.append('user_id', user_id);
                formData.append('other_user_id', currentChatId);
                formData.append('_token', '{{ csrf_token() }}');

                // Show uploading indicator
                const uploadingHtml = `<div class="chat-message-right" id="uploading-message">
                    <div class="message-content">
                        <div class="text-center">
                            <i class="fa fa-spinner fa-spin"></i> Uploading image...
                        </div>
                        <div class="timestamp">${formatTime(new Date())}</div>
                    </div>
                </div>`;
                chatMessages.append(uploadingHtml);
                scrollToBottom();

                $.ajax({
                    url: '/upload-image',
                    type: 'POST',
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function(response) {
                        // Remove uploading indicator
                        $("#uploading-message").remove();

                        // Send image message via socket
                        socket.emit('send_message', {
                            user_id: user_id,
                            other_user_id: currentChatId,
                            message: response.image_url,
                            message_type: 'image',
                            otherUserName: otherUserName
                        });

                        // Clear image preview
                        selectedImage = null;
                        $("#image-preview-container").hide();
                        $("#image-upload-input").val('');
                    },
                    error: function(xhr, status, error) {
                        // Remove uploading indicator
                        $("#uploading-message").remove();
                        alert('Failed to upload image. Please try again.');
                        console.error('Image upload error:', error);
                    }
                });
            }

            // Receive message (modified to handle images)
            socket.on('receive_message', function(data) {
                if (String(data.user_id) === String(user_id) || String(data.user_id) === String(
                        currentChatId)) {
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
                    var currentCount = currentUnreadBadge.length ? parseInt(currentUnreadBadge.text()) ||
                        0 : 0;
                    $("#unread_count_" + data.user_id).html('<span class="badge bg-success">' + (
                        currentCount + 1) + '</span>');

                    // Show push notification for messages from other users
                    if (typeof Push !== 'undefined' && Push.Permission.has()) {
                        const notificationBody = data.message_type === 'image' ?
                            (data.otherUserName || 'Someone') + " sent an image" :
                            (data.otherUserName || 'Someone') + ": " + data.message.substring(0, 50) + (data
                                .message.length > 50 ? '...' : '');

                        Push.create("New Message", {
                            body: notificationBody,
                            icon: "https://ui-avatars.com/api/?name=" + encodeURIComponent(data
                                .otherUserName || 'User'),
                            timeout: 5000,
                            onClick: function() {
                                window.focus();
                                this.close();
                            }
                        });
                    }
                }
            });

            // Rest of the socket event handlers remain the same
            socket.on('update_unread', function(data) {
                if (data.unread_message > 0) {
                    $("#unread_count_" + data.from_user_id).html('<span class="badge bg-success">' + data
                        .unread_message + '</span>');
                } else {
                    $("#unread_count_" + data.from_user_id).html('');
                }
            });

            socket.on('user_connected', function(data) {
                console.log('User connected:', data);
                var userId = data.id || data;

                $("#status_" + userId).html('<span class="fa fa-circle chat-online"></span> Online');

                if (String(userId) === String(user_id)) {
                    return;
                }

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

            socket.on('user_disconnected', function(data) {
                console.log('User disconnected:', data);
                var userId = data.id || data;
                $("#status_" + userId).html('<span class="fa fa-circle chat-offline"></span> Offline');
            });

            function escapeHtml(text) {
                return $('<div>').text(text).html();
            }

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

            socket.on('connect_error', function(error) {
                console.error('Connection failed:', error);
            });

            socket.on('disconnect', function() {
                console.log('Disconnected from server');
                currentChatLoaded = false;
            });

            socket.on('connect', function() {
                console.log('Connected to socket server');

                if (typeof Push !== 'undefined' && Push.Permission.get() === Push.Permission.DEFAULT) {
                    Push.Permission.request();
                }
            });

            socket.on('user_data', function(userData) {
                console.log('Received user data:', userData);
            });

            $(window).on('beforeunload', function() {
                if (currentChatId) {
                    socket.emit('leave_chat', {
                        user_id: user_id,
                        other_user_id: currentChatId
                    });
                }
            });

            // Global function to show image modal
            window.showImageModal = function(imageUrl) {
                $("#modal-image").attr('src', imageUrl);
                $("#imageModal").modal('show');
            };

            // Add hover effects for emoji items
            $(".emoji-item").hover(
                function() {
                    $(this).css('background-color', '#f0f0f0');
                },
                function() {
                    $(this).css('background-color', 'transparent');
                }
            );
        });
    </script>
@endsection
