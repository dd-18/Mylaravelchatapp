@extends('layouts.app')

<style>
    .container {
        max-width: 100vw;
        padding: 0.5rem;
    }

    .card {
        flex-direction: column !important;
        min-height: 60vh;
        box-shadow: 0 4px 24px rgba(0, 0, 0, 0.05);
        border-radius: 16px;
        overflow: hidden;
    }

    @media (min-width: 992px) {
        .card {
            flex-direction: row !important;
            min-height: 80vh;
        }
    }

    .friend-item {
        display: flex;
        align-items: center;
        gap: 0.75rem;
        padding: 0.5rem 1.2rem;
        border-radius: 8px;
        background: none;
        transition: background 0.2s;
    }

    .friend-item:hover {
        background: #e6f4ff;
    }

    @media (max-width: 768px) {
        .card {
            flex-direction: column !important;
            height: auto !important;
            min-height: unset;
            margin-bottom: 1.5rem;
        }

        .col-lg-4 {
            max-height: 300px !important;
            overflow-y: auto;
        }

        .col-lg-8 {
            min-height: 400px;
        }

        .friend-item {
            padding: 0.4rem 0.5rem;
        }

        .friend-name {
            font-size: 1rem !important;
        }

        .friend-status {
            font-size: 0.8rem !important;
        }
    }

    @media (max-width: 480px) {
        .container {
            padding: 0.2rem;
        }

        .friend-item {
            padding: 0.2rem 0.25rem;
            gap: 0.4rem;
        }

        .friend-name {
            font-size: 0.92rem !important;
        }

        .friend-status {
            font-size: 0.7rem !important;
        }
    }
</style>
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
                                alt="{{ $friend->name }}" width="40" height="40"
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
                            <div class="ms-auto position-relative" id="unread_count_{{ $friend->id }}">
                                @if ($friend['unread_message'] > 0)
                                    <span class="badge bg-success rounded-pill animate-bounce">
                                        {{ $friend['unread_message'] > 99 ? '99+' : $friend['unread_message'] }}
                                    </span>
                                @endif
                            </div>

                        </div>
                    </a>
                @endforeach
                <hr>
            </div>

            <!-- Main Chat Area -->
            <div class="col-12 col-lg-8 d-flex flex-column" style="background: #fff;">
                @if ($id)
                    <!-- Chat Header -->
                    <div class="chat-header">
                        <img src="{{ $otherUser->user_image ? asset('storage/users/' . $otherUser->user_image) : 'https://ui-avatars.com/api/?name=' . urlencode($otherUser->name) }}"
                            alt="{{ $otherUser->name }}" width="40" height="40"
                            style="border-radius: 50%; object-fit: cover;">
                        <div>
                            <strong style="text-transform: capitalize;">{{ $otherUser->name }}</strong>
                            <div class="text-muted small" id="typing-in"></div> <!-- Already exists, will use this -->
                        </div>
                    </div>


                    <!-- Typing Indicator -->
                    <div id="typing-indicator"
                        style="display:none; font-size:0.85rem; color:#64748b; padding: 0.25rem 1rem;">
                        Typing...
                    </div>

                    <!-- Chat Messages -->
                    <div class="chat-messages flex-grow-1" id="chat-messages-container">
                        <div class="text-center text-muted p-3" id="loading-messages">
                            <i class="fa fa-spinner fa-spin"></i> Loading messages...
                        </div>
                    </div>

                    <!-- Chat Input -->
                    <div class="chat-input" style="position: relative; ">
                        <!-- Emoji -->
                        <div id="emoji-picker"
                            style="display: none; position: absolute; bottom: 60px; left: 10px; background: white; border: 1px solid #ddd; border-radius: 10px; padding: 15px; box-shadow: 0 4px 12px rgba(0,0,0,0.15); z-index: 1000; max-width: 300px; max-height: 200px; overflow-y: auto;">
                            <div style="display: grid; grid-template-columns: repeat(8, 1fr); gap: 5px;">
                                <!-- Common emojis -->
                                <span class="emoji-item"
                                    style="cursor: pointer; padding: 5px; text-align: center; border-radius: 5px; font-size: 20px;">😀</span>
                                <span class="emoji-item"
                                    style="cursor: pointer; padding: 5px; text-align: center; border-radius: 5px; font-size: 20px;">😂</span>
                                <span class="emoji-item"
                                    style="cursor: pointer; padding: 5px; text-align: center; border-radius: 5px; font-size: 20px;">🤣</span>
                                <span class="emoji-item"
                                    style="cursor: pointer; padding: 5px; text-align: center; border-radius: 5px; font-size: 20px;">😊</span>
                                <span class="emoji-item"
                                    style="cursor: pointer; padding: 5px; text-align: center; border-radius: 5px; font-size: 20px;">😍</span>
                                <span class="emoji-item"
                                    style="cursor: pointer; padding: 5px; text-align: center; border-radius: 5px; font-size: 20px;">🥰</span>
                                <span class="emoji-item"
                                    style="cursor: pointer; padding: 5px; text-align: center; border-radius: 5px; font-size: 20px;">😘</span>
                                <span class="emoji-item"
                                    style="cursor: pointer; padding: 5px; text-align: center; border-radius: 5px; font-size: 20px;">😎</span>
                                <span class="emoji-item"
                                    style="cursor: pointer; padding: 5px; text-align: center; border-radius: 5px; font-size: 20px;">😢</span>
                                <span class="emoji-item"
                                    style="cursor: pointer; padding: 5px; text-align: center; border-radius: 5px; font-size: 20px;">😭</span>
                                <span class="emoji-item"
                                    style="cursor: pointer; padding: 5px; text-align: center; border-radius: 5px; font-size: 20px;">😡</span>
                                <span class="emoji-item"
                                    style="cursor: pointer; padding: 5px; text-align: center; border-radius: 5px; font-size: 20px;">🤔</span>
                                <span class="emoji-item"
                                    style="cursor: pointer; padding: 5px; text-align: center; border-radius: 5px; font-size: 20px;">🙄</span>
                                <span class="emoji-item"
                                    style="cursor: pointer; padding: 5px; text-align: center; border-radius: 5px; font-size: 20px;">😴</span>
                                <span class="emoji-item"
                                    style="cursor: pointer; padding: 5px; text-align: center; border-radius: 5px; font-size: 20px;">🤗</span>
                                <span class="emoji-item"
                                    style="cursor: pointer; padding: 5px; text-align: center; border-radius: 5px; font-size: 20px;">🤩</span>
                                <span class="emoji-item"
                                    style="cursor: pointer; padding: 5px; text-align: center; border-radius: 5px; font-size: 20px;">👍</span>
                                <span class="emoji-item"
                                    style="cursor: pointer; padding: 5px; text-align: center; border-radius: 5px; font-size: 20px;">👎</span>
                                <span class="emoji-item"
                                    style="cursor: pointer; padding: 5px; text-align: center; border-radius: 5px; font-size: 20px;">👏</span>
                                <span class="emoji-item"
                                    style="cursor: pointer; padding: 5px; text-align: center; border-radius: 5px; font-size: 20px;">🙏</span>
                                <span class="emoji-item"
                                    style="cursor: pointer; padding: 5px; text-align: center; border-radius: 5px; font-size: 20px;">❤️</span>
                                <span class="emoji-item"
                                    style="cursor: pointer; padding: 5px; text-align: center; border-radius: 5px; font-size: 20px;">💕</span>
                                <span class="emoji-item"
                                    style="cursor: pointer; padding: 5px; text-align: center; border-radius: 5px; font-size: 20px;">💖</span>
                                <span class="emoji-item"
                                    style="cursor: pointer; padding: 5px; text-align: center; border-radius: 5px; font-size: 20px;">🔥</span>
                                <span class="emoji-item"
                                    style="cursor: pointer; padding: 5px; text-align: center; border-radius: 5px; font-size: 20px;">✨</span>
                                <span class="emoji-item"
                                    style="cursor: pointer; padding: 5px; text-align: center; border-radius: 5px; font-size: 20px;">💯</span>
                                <span class="emoji-item"
                                    style="cursor: pointer; padding: 5px; text-align: center; border-radius: 5px; font-size: 20px;">🎉</span>
                                <span class="emoji-item"
                                    style="cursor: pointer; padding: 5px; text-align: center; border-radius: 5px; font-size: 20px;">🎊</span>
                                <span class="emoji-item"
                                    style="cursor: pointer; padding: 5px; text-align: center; border-radius: 5px; font-size: 20px;">🌟</span>
                                <span class="emoji-item"
                                    style="cursor: pointer; padding: 5px; text-align: center; border-radius: 5px; font-size: 20px;">🌈</span>
                                <span class="emoji-item"
                                    style="cursor: pointer; padding: 5px; text-align: center; border-radius: 5px; font-size: 20px;">🌹</span>
                                <span class="emoji-item"
                                    style="cursor: pointer; padding: 5px; text-align: center; border-radius: 5px; font-size: 20px;">🎂</span>
                            </div>
                        </div>

                        <!-- Main input row -->
                        <div style="display: flex; align-items: center; gap: 8px;">
                            <!-- Image upload button -->
                            <button type="button" id="image-upload-btn"
                                style="background: none; border: none; color: #666; font-size: 18px; cursor: pointer; padding: 8px;">
                                <i class="fa-solid fa-image"></i>
                            </button>

                            <!-- Hidden file input -->
                            <input type="file" id="image-upload-input" accept="image/*" style="display: none;">

                            <!-- Emoji button -->
                            <button type="button" id="emoji-btn"
                                style="background: none; border: none; color: #666; font-size: 18px; cursor: pointer; padding: 8px;">
                                <i class="fa-solid fa-smile"></i>
                            </button>

                            <!-- Message input -->
                            <input type="text" id="message-input" placeholder="Type a message" autocomplete="on"
                                style="flex: 1;">

                            <!-- Send button -->
                            <button class="btn btn-primary" id="send-message-btn"><i
                                    class="fa-solid fa-paper-plane"></i></button>
                        </div>

                        <!-- Image preview area (Hidden by default) -->
                        <div id="image-preview-container" style="display: none; margin-top: 10px; position: relative;">
                            <div style="position: relative; display: inline-block;">
                                <img id="image-preview" src="" alt="Preview"
                                    style="max-width: 200px; max-height: 200px; border-radius: 10px; border: 1px solid #ddd;">
                                <button type="button" id="remove-image-btn"
                                    style="position: absolute; top: -8px; right: -8px; background: #ff4444; color: white; border: none; border-radius: 50%; width: 24px; height: 24px; cursor: pointer; font-size: 12px;">✕</button>
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
        var typingTimeout;

        $(function() {
            var user_id = "{{ auth()->id() }}";
            var currentChatId = "{{ $otherUser ? $otherUser->id : '' }}";
            var otherUserName = "{{ $otherUser ? $otherUser->name : '' }}";

            // Helper to generate same group_id as backend
            function getGroupId(u1, u2) {
                return [String(u1), String(u2)]
                    .sort((a, b) => Number(a) - Number(b))
                    .join("");
            }

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
                    other_user_id: currentChatId,
                    group_id: getGroupId(user_id, currentChatId)
                });
            @endif

            // Handle chat history when received
            socket.on('chat_history', function(data) {
                chatMessages.empty();
                currentChatLoaded = true;

                if (data.messages.length === 0) {
                    chatMessages.append(
                        '<div class="text-center text-muted p-3">No messages yet. Start the conversation!</div>'
                    );
                } else {
                    data.messages.forEach(function(message) {
                        appendMessage(message);
                    });
                }

                scrollToBottom();

                // Mark all messages as read
                socket.emit('read_message', {
                    from_user_id: currentChatId,
                    to_user_id: user_id
                });
            });

            function appendMessage(data) {
                const time = data.time || formatTime(data.created_at);
                let messageContent = '';

                if (data.message_type === 'image' || isImageUrl(data.message)) {
                    messageContent =
                        `<img src="${escapeHtml(data.message)}" alt="Image" style="max-width: 200px; max-height: 200px; border-radius: 10px; cursor: pointer;" onclick="showImageModal('${escapeHtml(data.message)}')">`;
                } else {
                    messageContent = formatTextMessage(data.message);
                }

                let html;
                if (String(data.user_id) === String(user_id)) {
                    // Own messages - show action buttons
                    html = `<div class="chat-message-right" data-message-id="${data.id}">
            <div class="message-content" style="position: relative;">
                <div class="message-actions" style="position: absolute; top: -8px; right: -8px; display: none;">
                    <div class="btn-group btn-group-sm">
                        <button class="btn btn-outline-secondary btn-sm message-info-btn" title="Message Info">
                            <i class="fa-solid fa-info-circle"></i>
                        </button>
                        ${data.message_type !== 'image' ? `
                                            <button class="btn btn-outline-primary btn-sm message-edit-btn" title="Edit Message">
                                                <i class="fa-solid fa-edit"></i>
                                            </button>` : ''}
                        <button class="btn btn-outline-danger btn-sm message-delete-btn" title="Delete Message">
                            <i class="fa-solid fa-trash"></i>
                        </button>
                    </div>
                </div>
                <div class="message-text">${messageContent}</div>
                <div class="timestamp">${time}</div>
            </div>
        </div>`;
                } else {
                    // Other user's messages - show only info button
                    html = `<div class="chat-message-left" data-message-id="${data.id}">
            <div class="message-content" style="position: relative;">
                <div class="message-actions" style="position: absolute; top: -8px; right: -8px; display: none;">
                    <button class="btn btn-outline-secondary btn-sm message-info-btn" title="Message Info">
                        <i class="fa-solid fa-info-circle"></i>
                    </button>
                </div>
                <div class="message-text">${messageContent}</div>
                <div class="timestamp">${time}</div>
            </div>
        </div>`;
                }

                chatMessages.append(html);
            }

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

            function formatTextMessage(message) {
                let formatted = escapeHtml(message);
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

            $(document).on('click', function(e) {
                if (!$(e.target).closest('#emoji-btn, #emoji-picker').length) {
                    $("#emoji-picker").hide();
                }
            });

            $(".emoji-item").on('click', function() {
                const emoji = $(this).text();
                const input = $("#message-input");
                const currentValue = input.val();
                input.val(currentValue + emoji);
                $("#emoji-picker").hide();
                input.focus();
            });

            // Send message (with group_id)
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
                    sendImageMessage(selectedImage);
                } else if (textMessage) {
                    socket.emit('send_message', {
                        user_id: user_id,
                        other_user_id: currentChatId,
                        group_id: getGroupId(user_id, currentChatId),
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
                        $("#uploading-message").remove();

                        socket.emit('send_message', {
                            user_id: user_id,
                            other_user_id: currentChatId,
                            group_id: getGroupId(user_id, currentChatId),
                            message: response.image_url,
                            message_type: 'image',
                            otherUserName: otherUserName
                        });

                        selectedImage = null;
                        $("#image-preview-container").hide();
                        $("#image-upload-input").val('');
                    },
                    error: function(xhr, status, error) {
                        $("#uploading-message").remove();
                        alert('Failed to upload image. Please try again.');
                        console.error('Image upload error:', error);
                    }
                });
            }

            // Receive message
            socket.on('receive_message', function(data) {
                if (String(data.user_id) === String(user_id) || String(data.user_id) === String(
                        currentChatId)) {
                    if (currentChatLoaded) {
                        chatMessages.find('.text-center.text-muted').remove();
                        appendMessage(data);
                        scrollToBottom();

                        if (String(data.user_id) === String(currentChatId)) {
                            socket.emit('read_message', {
                                from_user_id: data.user_id,
                                to_user_id: user_id
                            });
                        }
                    }
                } else {
                    var badgeContainer = $("#unread_count_" + data.user_id);
                    var currentUnreadBadge = badgeContainer.find('.badge');
                    var currentCount = currentUnreadBadge.length ? parseInt(currentUnreadBadge.text()) ||
                        0 : 0;
                    var newCount = currentCount + 1;
                    var displayCount = newCount > 99 ? '99+' : newCount;

                    if (currentUnreadBadge.length) {
                        currentUnreadBadge.text(displayCount).addClass("flash-badge");
                    } else {
                        badgeContainer.html('<span class="badge bg-success rounded-pill flash-badge">' +
                            displayCount + '</span>');
                    }
                    setTimeout(() => badgeContainer.find('.badge').removeClass("flash-badge"), 500);
                }
            });

            // Rest of socket events unchanged...
            socket.on('update_unread', function(data) {
                const unreadCount = data.unread_message || 0;
                const displayCount = unreadCount > 99 ? '99+' : unreadCount;
                const badgeContainer = $("#unread_count_" + data.from_user_id);
                if (unreadCount > 0) {
                    if (badgeContainer.find('.badge').length) {
                        const badge = badgeContainer.find('.badge');
                        badge.text(displayCount).addClass("scale-up");
                        setTimeout(() => badge.removeClass("scale-up"), 300);
                    } else {
                        badgeContainer.html('<span class="badge bg-success rounded-pill animate-bounce">' +
                            displayCount + '</span>');
                    }
                } else {
                    badgeContainer.html('');
                }
            });

            socket.on('user_connected', function(data) {
                var userId = data.id || data;
                $("#status_" + userId).html('<span class="fa fa-circle chat-online"></span> Online');
            });

            socket.on('user_disconnected', function(data) {
                var userId = data.id || data;
                $("#status_" + userId).html('<span class="fa fa-circle chat-offline"></span> Offline');
            });

            function escapeHtml(text) {
                return $('<div>').text(text).html();
            }

            $("#message-input").on("keyup", function() {
                socket.emit("user_typing", {
                    user_id,
                    other_user_id: currentChatId
                });

                clearTimeout(typingTimeout);
                typingTimeout = setTimeout(() => {
                    socket.emit("user_stopped_typing", {
                        user_id,
                        other_user_id: currentChatId
                    });
                }, 2000);
            });

            socket.on("user_typing", function(data) {
                if (parseInt(data.user_id) === parseInt(currentChatId)) {
                    $("#typing-in").html('<em>Typing...</em>');
                }
            });

            socket.on("user_stopped_typing", function(data) {
                if (parseInt(data.user_id) === parseInt(currentChatId)) {
                    $("#typing-in").html('');
                }
            });

            socket.on('connect_error', function(error) {
                console.error('Connection failed:', error);
            });

            socket.on('disconnect', function() {
                console.log('Disconnected from server');
                currentChatLoaded = false;
            });

            socket.on('connect', function() {
                console.log('Connected to socket server');
            });

            $(window).on('beforeunload', function() {
                if (currentChatId) {
                    socket.emit('leave_chat', {
                        user_id: user_id,
                        other_user_id: currentChatId,
                        group_id: getGroupId(user_id, currentChatId)
                    });
                }
            });

            window.showImageModal = function(imageUrl) {
                $("#modal-image").attr('src', imageUrl);
                $("#imageModal").modal('show');
            };
            // Message Action Handlers
            $(document).on('click', '.message-edit-btn', function(e) {
                e.stopPropagation();
                const messageDiv = $(this).closest('[data-message-id]');
                const messageId = messageDiv.data('message-id');
                const messageTextDiv = messageDiv.find('.message-text');
                const currentText = messageTextDiv.text().trim();

                // Create edit input
                const editInput =
                    `<input type="text" class="edit-input" value="${escapeHtml(currentText)}" data-original="${escapeHtml(currentText)}">`;
                messageTextDiv.html(editInput);
                messageDiv.addClass('message-edit-mode');

                // Focus on input
                const input = messageDiv.find('.edit-input');
                input.focus().select();

                // Handle save/cancel
                input.on('keypress', function(e) {
                    if (e.which === 13) { // Enter key
                        saveEditedMessage(messageId, $(this).val(), messageDiv);
                    } else if (e.which === 27) { // Escape key
                        cancelEdit(messageDiv, $(this).data('original'));
                    }
                });

                input.on('blur', function() {
                    const newText = $(this).val().trim();
                    const originalText = $(this).data('original');
                    if (newText !== originalText && newText !== '') {
                        saveEditedMessage(messageId, newText, messageDiv);
                    } else {
                        cancelEdit(messageDiv, originalText);
                    }
                });
            });

            $(document).on('click', '.message-delete-btn', function(e) {
                e.stopPropagation();
                const messageDiv = $(this).closest('[data-message-id]');
                const messageId = messageDiv.data('message-id');

                if (confirm('Are you sure you want to delete this message?')) {
                    deleteMessage(messageId, messageDiv);
                }
            });

            $(document).on('click', '.message-info-btn', function(e) {
                e.stopPropagation();
                const messageDiv = $(this).closest('[data-message-id]');
                const messageId = messageDiv.data('message-id');
                showMessageInfo(messageId);
            });

            function saveEditedMessage(messageId, newText, messageDiv) {
                if (!newText.trim()) return;

                socket.emit('edit_message', {
                    message_id: messageId,
                    new_message: newText.trim(),
                    user_id: user_id,
                    other_user_id: currentChatId
                });

                // Show loading state
                messageDiv.find('.message-text').html('<i class="fa fa-spinner fa-spin"></i> Updating...');
            }

            function cancelEdit(messageDiv, originalText) {
                messageDiv.removeClass('message-edit-mode');
                messageDiv.find('.message-text').text(originalText);
            }

            function deleteMessage(messageId, messageDiv) {
                socket.emit('delete_message', {
                    message_id: messageId,
                    user_id: user_id,
                    other_user_id: currentChatId
                });

                // Show loading state
                messageDiv.find('.message-text').html('<i class="fa fa-spinner fa-spin"></i> Deleting...');
            }

            function showMessageInfo(messageId) {
                socket.emit('get_message_info', {
                    message_id: messageId,
                    user_id: user_id
                });
            }

            // Socket event handlers for message actions
            socket.on('message_edited', function(data) {
                const messageDiv = $(`[data-message-id="${data.message_id}"]`);
                messageDiv.removeClass('message-edit-mode');
                messageDiv.find('.message-text').html(formatTextMessage(data.new_message));

                // Show edited indicator
                const timestamp = messageDiv.find('.timestamp');
                if (!timestamp.find('.edited-indicator').length) {
                    timestamp.append(' <span class="edited-indicator text-muted">(edited)</span>');
                }
            });

            socket.on('message_deleted', function(data) {
                const messageDiv = $(`[data-message-id="${data.message_id}"]`);
                messageDiv.find('.message-text').html(
                    '<em class="text-muted">This message was deleted</em>');
                messageDiv.find('.message-actions').remove();
                messageDiv.addClass('message-deleted');
            });

            socket.on('message_info', function(data) {
                const modalHtml = `
        <div class="modal fade" id="messageInfoModal" tabindex="-1">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Message Info</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        <p><strong>Sent:</strong> ${formatTime(data.created_at)}</p>
                        <p><strong>Status:</strong> ${data.is_read ? 'Read' : 'Delivered'}</p>
                        ${data.updated_at && data.updated_at !== data.created_at ? 
                            `<p><strong>Last edited:</strong> ${formatTime(data.updated_at)}</p>` : ''}
                        <p><strong>Message Type:</strong> ${data.message_type}</p>
                    </div>
                </div>
            </div>
        </div>
    `;
                // Remove existing modal and add new one
                $('#messageInfoModal').remove();
                $('body').append(modalHtml);
                $('#messageInfoModal').modal('show');
            });

        });
    </script>
@endsection
