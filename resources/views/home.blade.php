@extends('layouts.app')

@section('content')
    <div class="container">
        <div id="snippetContent">
            <main class="content">
                <div class="container p-0">
                    <div class="card" style="border-width: 2px;">
                        <div class="row g-0">
                            <div class="col-12 col-lg-5 col-xl-3 border-right" style="padding: 30px;">
                                @foreach ($friends as $friend)
                                    <a href="{{ route('home', $friend->id) }}"
                                        class="list-group-item list-group-item-action border-0" style="margin-bottom: 20px;">
                                        
                                        <div class="d-flex align-items-start"
                                            style="background-color: #acd2f7; border-radius: 20px;">
                                            <img src="https://ui-avatars.com/api/?name={{ $friend->name }}"
                                                class="rounded-circle mr-1" alt="{{ $friend->name }}" width="40"
                                                height="40" style="border: 2px solid #020202;" />
                                            <div class="flex-grow-1 ml-3" style="color: #000000; font-weight: 900;">
                                                {{ $friend->name }}
                                                <div class="small" id="status_{{ $friend->id }}">
                                                    @if ($friend->is_online == 1)
                                                        <span class="fa fa-circle chat-online"></span> Online
                                                    @else
                                                        <span class="fa fa-circle chat-offline"></span> Offline
                                                    @endif
                                                </div>
                                                
                                            </div>
                                            @if($friend['unread_message']>0)
                                            <div class="badge bg-success float-right">{{ $friend['unread_message'] }}</div>
                                        @endif
                                        </div>
                                    </a>
                                @endforeach

                                <hr class="d-block d-lg-none mt-1 mb-0" />
                            </div>

                            <div class="col-12 col-lg-7 col-xl-9 d-flex flex-column" style="height: 600px;">
                                @if ($id)
                                    <!-- Chat header -->
                                    <div class="py-2 px-4 border-bottom d-none d-lg-block flex-shrink-0">
                                        <div class="d-flex align-items-center py-1">
                                            <div class="position-relative">
                                                <img src="https://ui-avatars.com/api/?name={{ $otherUser->name }}"
                                                    class="rounded-circle mr-1" alt="{{ $otherUser->name }}" width="40"
                                                    height="40" />
                                            </div>
                                            <div class="flex-grow-1 pl-3">
                                                <strong>{{ $otherUser->name }}</strong>
                                                <div class="text-muted small"><em>Typing...</em></div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Messages area -->
                                    
                                        <div class="chat-messages p-4" style="overflow-y: auto; max-height: 500px;">
                                            @foreach ($messages as $message)
                                                @if ($message['user_id'] == auth()->id())
                                                    <div class="chat-message-right pb-4">
                                                        <div>
                                                            <img src="https://ui-avatars.com/api/?name={{ auth()->user()->name }}"
                                                                class="rounded-circle mr-1" alt="{{ auth()->user()->name }}"
                                                                width="40" height="40" />
                                                            <div class="text-muted small text-nowrap mt-2">
                                                                {{ date('h:i A', strtotime($message['created_at'])) }}
                                                            </div>
                                                        </div>
                                                        <div class="flex-shrink-1 rounded py-2 px-3 mr-3"
                                                            style="background-color: rgb(232, 227, 227);">
                                                            <div class="font-weight-bold mb-1"
                                                                style="color: #000000; font-weight: 900;">You</div>
                                                            {{ $message['message'] }}
                                                        </div>
                                                    </div>
                                                @else
                                                    <div class="chat-message-left pb-4">
                                                        <div>
                                                            <img src="https://ui-avatars.com/api/?name={{ $otherUser->name }}"
                                                                class="rounded-circle mr-1" alt="{{ $otherUser->name }}"
                                                                width="40" height="40" />
                                                            <div class="text-muted small text-nowrap mt-2">
                                                                {{ date('h:i A', strtotime($message['created_at'])) }}
                                                            </div>
                                                        </div>
                                                        <div class="flex-shrink-1 rounded py-2 px-3 ml-3" style="background-color: rgb(136, 214, 240);">
                                                            <div class="font-weight-bold mb-1">{{ $otherUser->name }}</div>
                                                            {{ $message['message'] }}
                                                        </div>
                                                    </div>
                                                @endif
                                            @endforeach
                                        </div>
                                    
                                @else
                                    <!-- Empty state -->
                                    <div class="flex-grow-1 d-flex align-items-center justify-content-center">
                                        <div class="text-muted">Select a friend to start chatting</div>
                                    </div>
                                @endif

                                <!-- Message input - always at bottom -->
                                <div class="border-top bg-light p-3 flex-shrink-0">
                                    <form id="chat-form">
                                        <div class="input-group"
                                            style="border-width: 1.6px; border-color: rgb(149, 149, 149); border-radius: 8px;">
                                            <input type="text" id="message-input" class="form-control"
                                                placeholder="Type your message" autocomplete="off" />
                                            <button class="btn btn-primary" type="submit">Send</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </main>
        </div>
    </div>
@endsection

@section('scripts')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.socket.io/4.6.1/socket.io.min.js"></script>


    <script>
        $(function() {
            var user_id = "{{ auth()->id() }}";
            var other_user_id = "{{ $otherUser ? $otherUser->id : '' }}";
            var otherUserName = "{{ $otherUser ? $otherUser->name : '' }}";

            var socket = io('http://localhost:3000', {
                query: {
                    user_id: user_id
                }
            });

            // Scroll to bottom on page load to show existing messages
            var chatMessages = $(".chat-messages");
            chatMessages.scrollTop(chatMessages[0].scrollHeight);

            // Send message on form submit
            $("#chat-form").on('submit', function(e) {
                e.preventDefault();
                var message = $("#message-input").val();
                if (message.trim().length === 0) {
                    $("#message-input").focus();
                    return;
                }

                var data = {
                    user_id: user_id,
                    other_user_id: other_user_id,
                    message: message,
                    otherUserName: otherUserName
                };
                socket.emit('send_message', data);
                $("#message-input").val('');
            });

            // Listen for incoming messages and append them dynamically
            socket.on('receive_message', function(data) {
                // console.log('Message received:', data);
                const time = data.time ? data.time.trim() : '';
                let messageHtml = '';

                if (data.user_id == user_id) {
                    // Message on right (You)
                    messageHtml = `
                <div class="chat-message-right pb-4">
                    <div>
                        <img src="https://ui-avatars.com/api/?name={{ auth()->user()->name }}" class="rounded-circle mr-1" width="40" height="40" />
                        <div class="text-muted small text-nowrap mt-2">${time}</div>
                    </div>
                    <div class="flex-shrink-1 bg-light rounded py-2 px-3 mr-3">
                        <div class="font-weight-bold mb-1">You</div>
                        ${data.message}
                    </div>
                </div>`;
                } else {
                    // Message on left (Other user)
                    const senderName = data.otherUserName || 'Friend';
                    messageHtml = `
                <div class="chat-message-left pb-4">
                    <div>
                        <img src="https://ui-avatars.com/api/?name=${encodeURIComponent(senderName)}" class="rounded-circle mr-1" width="40" height="40" />
                        <div class="text-muted small text-nowrap mt-2">${time}</div>
                    </div>
                    <div class="flex-shrink-1 bg-light rounded py-2 px-3 ml-3">
                        <div class="font-weight-bold mb-1">${senderName}</div>
                        ${data.message}
                    </div>
                </div>`;
                }

                $(".chat-messages").append(messageHtml);
                socket.emit('read_message', data.id);

                // Scroll down to show new message
                chatMessages.scrollTop(chatMessages[0].scrollHeight);
            });

            // Update user online status
            socket.on('user_connected', function(data) {
                $("#status_" + data).html('<span class="fa fa-circle chat-online"></span> Online');
            });

            socket.on('user_disconnected', function(data) {
                $("#status_" + data).html('<span class="fa fa-circle chat-offline"></span> Offline');
            });
        });
    </script>
@endsection
