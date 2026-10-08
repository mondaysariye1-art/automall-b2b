<x-app-layout>

    <style>
        * {
            box-sizing: border-box;
        }

        .chat-page {
            min-height: calc(100vh - 65px);
            background: #f5f5f5;
            padding: 20px;
        }

        .chat-container {
            width: 100%;
            max-width: 1050px;
            height: calc(100vh - 105px);
            min-height: 600px;
            margin: 0 auto;
            display: flex;
            flex-direction: column;
            overflow: hidden;
            background: #fff;
            border: 1px solid #e5e5e5;
            border-radius: 16px;
            box-shadow: 0 8px 30px rgba(0, 0, 0, .06);
        }

        /* HEADER */

        .chat-header {
            height: 74px;
            flex-shrink: 0;
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 15px;
            padding: 12px 18px;
            border-bottom: 1px solid #e9e9e9;
            background: #fff;
        }

        .chat-header-left {
            min-width: 0;
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .chat-back {
            width: 38px;
            height: 38px;
            flex-shrink: 0;
            display: flex;
            align-items: center;
            justify-content: center;
            border: 1px solid #e1e1e1;
            border-radius: 9px;
            background: #fff;
            color: #222;
            text-decoration: none;
            transition: .2s ease;
        }

        .chat-back:hover {
            background: #111;
            border-color: #111;
            color: #fff;
        }

        .dealer-avatar {
            width: 44px;
            height: 44px;
            flex-shrink: 0;
            overflow: hidden;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 50%;
            background: #111;
            color: #fff;
            font-size: 15px;
            font-weight: 800;
        }

        .dealer-avatar img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .dealer-details {
            min-width: 0;
        }

        .dealer-name {
            margin: 0;
            overflow: hidden;
            color: #111;
            font-size: 14px;
            font-weight: 800;
            white-space: nowrap;
            text-overflow: ellipsis;
        }

        .dealer-status {
            margin-top: 3px;
            display: flex;
            align-items: center;
            gap: 5px;
            color: #888;
            font-size: 11px;
        }

        .status-dot {
            width: 7px;
            height: 7px;
            display: inline-block;
            border-radius: 50%;
            background: #aaa;
        }

        .status-dot.online {
            background: #20a457;
        }

        .chat-header-actions {
            display: flex;
            align-items: center;
            gap: 7px;
        }

        .header-action {
            width: 38px;
            height: 38px;
            display: flex;
            align-items: center;
            justify-content: center;
            border: 1px solid #e2e2e2;
            border-radius: 9px;
            background: #fff;
            color: #333;
            cursor: pointer;
        }

        .header-action:hover {
            background: #f5f5f5;
        }

        /* VEHICLE */

        .vehicle-context {
            flex-shrink: 0;
            padding: 12px 18px;
            border-bottom: 1px solid #eee;
            background: #fafafa;
        }

        .vehicle-card {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 10px;
            border: 1px solid #e7e7e7;
            border-radius: 10px;
            background: #fff;
        }

        .vehicle-image {
            width: 65px;
            height: 52px;
            flex-shrink: 0;
            overflow: hidden;
            border-radius: 7px;
            background: #eee;
        }

        .vehicle-image img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .vehicle-info {
            min-width: 0;
            flex: 1;
        }

        .vehicle-title {
            margin: 0 0 4px;
            overflow: hidden;
            color: #222;
            font-size: 12px;
            font-weight: 800;
            white-space: nowrap;
            text-overflow: ellipsis;
        }

        .vehicle-price {
            margin: 0;
            color: #c90000;
            font-size: 13px;
            font-weight: 900;
        }

        .vehicle-link {
            flex-shrink: 0;
            padding: 8px 11px;
            border-radius: 7px;
            background: #111;
            color: #fff;
            text-decoration: none;
            font-size: 10px;
            font-weight: 800;
        }

        .vehicle-link:hover {
            background: #c90000;
        }

        /* MESSAGES */

        .messages-area {
            flex: 1;
            min-height: 0;
            overflow-y: auto;
            padding: 25px 20px;
            background:
                radial-gradient(
                    circle at top,
                    rgba(201, 0, 0, .025),
                    transparent 45%
                ),
                #f8f8f8;
        }

        .messages-inner {
            max-width: 820px;
            margin: 0 auto;
        }

        .date-divider {
            display: flex;
            align-items: center;
            gap: 12px;
            margin: 5px 0 22px;
            color: #999;
            font-size: 10px;
            font-weight: 700;
            text-transform: uppercase;
        }

        .date-divider::before,
        .date-divider::after {
            content: "";
            height: 1px;
            flex: 1;
            background: #e4e4e4;
        }

        .message-row {
            position: relative;
            display: flex;
            margin-bottom: 10px;
        }

        .message-row.mine {
            justify-content: flex-end;
        }

        .message-row.theirs {
            justify-content: flex-start;
        }

        .message-bubble {
            position: relative;
            max-width: min(70%, 560px);
            padding: 10px 13px 7px;
            border-radius: 14px;
            word-wrap: break-word;
            overflow-wrap: anywhere;
        }

        .message-row.theirs .message-bubble {
            border-bottom-left-radius: 4px;
            background: #fff;
            border: 1px solid #e5e5e5;
            color: #222;
        }

        .message-row.mine .message-bubble {
            border-bottom-right-radius: 4px;
            background: #c90000;
            color: #fff;
        }

        .message-text {
            margin: 0;
            font-size: 13px;
            line-height: 1.55;
            white-space: pre-wrap;
        }

        .message-meta {
            display: flex;
            align-items: center;
            justify-content: flex-end;
            gap: 5px;
            margin-top: 4px;
            font-size: 9px;
        }

        .message-row.theirs .message-meta {
            color: #999;
        }

        .message-row.mine .message-meta {
            color: rgba(255,255,255,.75);
        }

        .message-edited {
            font-style: italic;
        }

        .message-check {
            font-size: 10px;
            font-weight: 800;
        }

        .deleted-message {
            font-style: italic;
            opacity: .65;
        }

        /* MESSAGE MENU */

        .message-actions {
            position: absolute;
            top: -5px;
            right: 5px;
            display: none;
            z-index: 20;
        }

        .message-row.mine:hover .message-actions {
            display: block;
        }

        .message-menu-button {
            width: 27px;
            height: 27px;
            display: flex;
            align-items: center;
            justify-content: center;
            border: 1px solid #ddd;
            border-radius: 50%;
            background: #fff;
            color: #333;
            cursor: pointer;
            box-shadow: 0 2px 8px rgba(0,0,0,.1);
        }

        .message-menu {
            position: absolute;
            right: 0;
            top: 32px;
            width: 125px;
            padding: 5px;
            display: none;
            border: 1px solid #ddd;
            border-radius: 9px;
            background: #fff;
            box-shadow: 0 8px 25px rgba(0,0,0,.12);
        }

        .message-menu.open {
            display: block;
        }

        .message-menu button {
            width: 100%;
            padding: 8px 9px;
            border: 0;
            border-radius: 6px;
            background: transparent;
            color: #222;
            text-align: left;
            font-size: 11px;
            font-weight: 700;
            cursor: pointer;
        }

        .message-menu button:hover {
            background: #f4f4f4;
        }

        .message-menu .delete-action {
            color: #c90000;
        }

        /* EMPTY */

        .empty-chat {
            min-height: 300px;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            text-align: center;
            color: #999;
        }

        .empty-chat-icon {
            width: 58px;
            height: 58px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 12px;
            border-radius: 50%;
            background: #111;
            color: #fff;
        }

        .empty-chat h3 {
            margin: 0 0 5px;
            color: #222;
            font-size: 15px;
        }

        .empty-chat p {
            margin: 0;
            font-size: 11px;
        }

        /* COMPOSER */

        .composer {
            flex-shrink: 0;
            padding: 12px 18px 15px;
            border-top: 1px solid #e6e6e6;
            background: #fff;
        }

        .composer-inner {
            max-width: 820px;
            margin: 0 auto;
            display: flex;
            align-items: flex-end;
            gap: 8px;
        }

        .composer-button {
            width: 40px;
            height: 40px;
            flex-shrink: 0;
            display: flex;
            align-items: center;
            justify-content: center;
            border: 1px solid #ddd;
            border-radius: 10px;
            background: #fff;
            color: #444;
            cursor: pointer;
        }

        .composer-button:hover {
            background: #f5f5f5;
        }

        .message-input-wrap {
            flex: 1;
            min-width: 0;
            position: relative;
        }

        .message-input {
            width: 100%;
            min-height: 42px;
            max-height: 130px;
            padding: 12px 45px 12px 13px;
            resize: none;
            border: 1px solid #dcdcdc;
            border-radius: 11px;
            outline: none;
            background: #fafafa;
            color: #222;
            font-family: inherit;
            font-size: 13px;
            line-height: 1.4;
        }

        .message-input:focus {
            border-color: #c90000;
            background: #fff;
        }

        .send-button {
            width: 42px;
            height: 42px;
            flex-shrink: 0;
            display: flex;
            align-items: center;
            justify-content: center;
            border: 0;
            border-radius: 11px;
            background: #c90000;
            color: #fff;
            cursor: pointer;
            transition: .2s ease;
        }

        .send-button:hover {
            background: #a90000;
        }

        .send-button:disabled {
            opacity: .55;
            cursor: not-allowed;
        }

        .composer-help {
            max-width: 820px;
            margin: 6px auto 0;
            color: #aaa;
            font-size: 9px;
        }

        /* MODALS */

        .chat-modal {
            position: fixed;
            inset: 0;
            z-index: 1000;
            display: none;
            align-items: center;
            justify-content: center;
            padding: 20px;
            background: rgba(0,0,0,.5);
        }

        .chat-modal.show {
            display: flex;
        }

        .modal-box {
            width: 100%;
            max-width: 420px;
            padding: 24px;
            border-radius: 14px;
            background: #fff;
            box-shadow: 0 20px 60px rgba(0,0,0,.25);
        }

        .modal-box h3 {
            margin: 0 0 7px;
            color: #111;
            font-size: 17px;
        }

        .modal-box p {
            margin: 0 0 18px;
            color: #777;
            font-size: 12px;
            line-height: 1.5;
        }

        .edit-input {
            width: 100%;
            min-height: 100px;
            padding: 12px;
            resize: vertical;
            border: 1px solid #ddd;
            border-radius: 9px;
            outline: none;
            font-family: inherit;
            font-size: 13px;
        }

        .edit-input:focus {
            border-color: #c90000;
        }

        .modal-actions {
            display: flex;
            justify-content: flex-end;
            gap: 8px;
            margin-top: 15px;
        }

        .modal-button {
            min-width: 85px;
            height: 38px;
            padding: 0 14px;
            border: 1px solid #ddd;
            border-radius: 8px;
            background: #fff;
            color: #222;
            font-size: 11px;
            font-weight: 800;
            cursor: pointer;
        }

        .modal-button.primary {
            border-color: #c90000;
            background: #c90000;
            color: #fff;
        }

        .modal-button.danger {
            border-color: #c90000;
            background: #c90000;
            color: #fff;
        }

        /* MOBILE */

        @media (max-width: 700px) {

            .chat-page {
                padding: 0;
                min-height: calc(100vh - 65px);
            }

            .chat-container {
                height: calc(100vh - 65px);
                min-height: 0;
                border: 0;
                border-radius: 0;
            }

            .chat-header {
                padding: 10px 12px;
            }

            .chat-header-actions {
                display: none;
            }

            .vehicle-context {
                padding: 9px 12px;
            }

            .vehicle-image {
                width: 58px;
                height: 46px;
            }

            .messages-area {
                padding: 18px 12px;
            }

            .message-bubble {
                max-width: 82%;
            }

            .composer {
                padding: 9px 10px 11px;
            }

            .composer-help {
                display: none;
            }

            .composer-button {
                display: none;
            }

            .send-button {
                width: 40px;
                height: 40px;
            }
        }
    </style>


    @php

        $otherDealer =
            $otherDealer ??
            (
                (int) $conversation->buyer_id === (int) $currentDealer->id
                    ? $conversation->dealer
                    : $conversation->buyer
            );

        $otherUser = $otherDealer?->user;

        $businessName =
            $otherDealer?->business_name
            ?? $otherUser?->name
            ?? 'Dealer';

        $avatarLetter =
            strtoupper(
                substr(
                    trim($businessName),
                    0,
                    1
                )
            );

        $vehicle =
            $conversation->vehicle;

        $vehicleImage = null;

        if ($vehicle && $vehicle->relationLoaded('media')) {

            $firstMedia =
                $vehicle->media->first();

            if ($firstMedia) {

                $vehicleImage =
                    $firstMedia->url
                    ?? (
                        $firstMedia->path
                            ? asset('storage/' . ltrim($firstMedia->path, '/'))
                            : null
                    );
            }
        }

        $vehicleTitle = $vehicle
            ? trim(
                implode(
                    ' ',
                    array_filter([
                        $vehicle->year ?? null,
                        $vehicle->make ?? null,
                        $vehicle->model ?? null
                    ])
                )
            )
            : null;

    @endphp


    <div class="chat-page">

        <div class="chat-container">


            {{-- HEADER --}}

            <header class="chat-header">

                <div class="chat-header-left">

                    <a
                        href="{{ route('communication') }}"
                        class="chat-back"
                        aria-label="Back to messages"
                    >
                        ←
                    </a>

                    <div class="dealer-avatar">

                        @if($otherDealer?->logo)

                            <img
                                src="{{ asset('storage/' . ltrim($otherDealer->logo, '/')) }}"
                                alt="{{ $businessName }}"
                            >

                        @else

                            {{ $avatarLetter }}

                        @endif

                    </div>

                    <div class="dealer-details">

                        <p class="dealer-name">
                            {{ $businessName }}
                        </p>

                        <div class="dealer-status">

                            <span
                                id="statusDot"
                                class="status-dot {{ $otherIsOnline ? 'online' : '' }}"
                            ></span>

                            <span id="statusText">

                                @if($onlineStatusVisible)

                                    @if($otherIsOnline)
                                        Online
                                    @elseif($otherLastSeen)
                                        Last seen {{ $otherLastSeen->diffForHumans() }}
                                    @else
                                        Offline
                                    @endif

                                @else

                                    Offline

                                @endif

                            </span>

                        </div>

                    </div>

                </div>

                <div class="chat-header-actions">

                    <button
                        type="button"
                        class="header-action"
                        title="Search messages"
                        onclick="alert('Message search will be added next.')"
                    >
                        ⌕
                    </button>

                </div>

            </header>


            {{-- VEHICLE CONTEXT --}}

            @if($vehicle)

                <div class="vehicle-context">

                    <div class="vehicle-card">

                        <!-- <div class="vehicle-image">

                            @if($vehicleImage)

                                <img
                                    src="{{ $vehicleImage }}"
                                    alt="{{ $vehicleTitle }}"
                                >

                            @else

                                <div
                                    style="
                                        width:100%;
                                        height:100%;
                                        display:flex;
                                        align-items:center;
                                        justify-content:center;
                                        color:#aaa;
                                        font-size:10px;
                                    "
                                >
                                    No image
                                </div>

                            @endif

                        </div> -->

                        <div class="vehicle-info">

                            <p class="vehicle-title">
                                {{ $vehicleTitle ?: 'Vehicle' }}
                            </p>

                            <p class="vehicle-price">

                                @if(isset($vehicle->price))
                                    ₦{{ number_format($vehicle->price) }}
                                @else
                                    Contact dealer
                                @endif

                            </p>

                        </div>

                        <a
                            href="{{ route('public.vehicles.show', $vehicle) }}"
                            class="vehicle-link"
                        >
                            View
                        </a>

                    </div>

                </div>

            @endif


            {{-- MESSAGES --}}

            <div
                class="messages-area"
                id="messagesArea"
            >

                <div class="messages-inner">

                    @if($conversation->messages->count())

                        <div class="date-divider">
                            Conversation
                        </div>

                        @foreach($conversation->messages as $message)

                            @php
                                $isMine =
                                    (int) $message->sender_id ===
                                    (int) $currentDealer->id;
                            @endphp

                            <div
                                class="message-row {{ $isMine ? 'mine' : 'theirs' }}"
                                data-message-id="{{ $message->id }}"
                            >

                                <div class="message-bubble">

                                    @if($isMine && !$message->deleted_at)

                                        <div class="message-actions">

                                            <button
                                                type="button"
                                                class="message-menu-button"
                                                onclick="toggleMessageMenu(this)"
                                            >
                                                ⋮
                                            </button>

                                            <div class="message-menu">

                                                <button
                                                    type="button"
                                                    onclick="openEditMessage({{ $message->id }})"
                                                >
                                                    Edit
                                                </button>

                                                <button
                                                    type="button"
                                                    class="delete-action"
                                                    onclick="openDeleteMessage({{ $message->id }})"
                                                >
                                                    Delete
                                                </button>

                                            </div>

                                        </div>

                                    @endif


                                    @if($message->deleted_at)

                                        <p class="message-text deleted-message">
                                            This message was deleted
                                        </p>

                                    @else

                                        <p
                                            class="message-text"
                                            id="message-text-{{ $message->id }}"
                                        >{{ $message->message }}</p>

                                    @endif


                                    <div class="message-meta">

                                        <span>
                                            {{ $message->created_at->format('g:i A') }}
                                        </span>

                                        @if($message->edited_at && !$message->deleted_at)

                                            <span class="message-edited">
                                                edited
                                            </span>

                                        @endif

                                        @if($isMine && !$message->deleted_at)

                                            <span class="message-check">
                                                {{ $message->read_at ? '✓✓' : '✓' }}
                                            </span>

                                        @endif

                                    </div>

                                </div>

                            </div>

                        @endforeach

                    @else

                        <div class="empty-chat">

                            <div class="empty-chat-icon">
                                💬
                            </div>

                            <h3>
                                Start the conversation
                            </h3>

                            <p>
                                Send a message to {{ $businessName }}.
                            </p>

                        </div>

                    @endif

                </div>

            </div>


            {{-- COMPOSER --}}

            <div class="composer">

                <form
                    id="messageForm"
                    autocomplete="off"
                >

                    @csrf

                    <div class="composer-inner">

                        <button
                            type="button"
                            class="composer-button"
                            title="Attachments"
                            onclick="alert('Attachments will be added next.')"
                        >
                            +
                        </button>

                        <div class="message-input-wrap">

                            <textarea
                                id="messageInput"
                                class="message-input"
                                rows="1"
                                maxlength="5000"
                                placeholder="Write a message..."
                            ></textarea>

                        </div>

                        <button
                            type="submit"
                            class="send-button"
                            id="sendButton"
                            aria-label="Send message"
                        >
                            ↑
                        </button>

                    </div>

                    <div class="composer-help">
                        Enter to send · Shift + Enter for a new line
                    </div>

                </form>

            </div>

        </div>

    </div>


    {{-- EDIT MODAL --}}

    <div
        class="chat-modal"
        id="editModal"
    >

        <div class="modal-box">

            <h3>
                Edit message
            </h3>

            <p>
                Make your changes and save the message.
            </p>

            <textarea
                id="editMessageInput"
                class="edit-input"
                maxlength="5000"
            ></textarea>

            <div class="modal-actions">

                <button
                    type="button"
                    class="modal-button"
                    onclick="closeEditModal()"
                >
                    Cancel
                </button>

                <button
                    type="button"
                    class="modal-button primary"
                    onclick="saveEditedMessage()"
                >
                    Save
                </button>

            </div>

        </div>

    </div>


    {{-- DELETE MODAL --}}

    <div
        class="chat-modal"
        id="deleteModal"
    >

        <div class="modal-box">

            <h3>
                Delete message?
            </h3>

            <p>
                This message will be marked as deleted for the conversation.
            </p>

            <div class="modal-actions">

                <button
                    type="button"
                    class="modal-button"
                    onclick="closeDeleteModal()"
                >
                    Cancel
                </button>

                <button
                    type="button"
                    class="modal-button danger"
                    onclick="deleteMessage()"
                >
                    Delete
                </button>

            </div>

        </div>

    </div>


    <script>

        const messageForm =
            document.getElementById('messageForm');

        const messageInput =
            document.getElementById('messageInput');

        const sendButton =
            document.getElementById('sendButton');

        const messagesArea =
            document.getElementById('messagesArea');

        const csrfToken =
            document
                .querySelector('meta[name="csrf-token"]')
                ?.getAttribute('content');

        const conversationId =
            @json($conversation->id);


        /* --------------------------------
           SCROLL TO BOTTOM
        -------------------------------- */

        function scrollMessagesToBottom() {

            if (!messagesArea) {
                return;
            }

            messagesArea.scrollTop =
                messagesArea.scrollHeight;
        }

        scrollMessagesToBottom();


        /* --------------------------------
           AUTO RESIZE
        -------------------------------- */

        function resizeMessageInput() {

            messageInput.style.height = 'auto';

            messageInput.style.height =
                Math.min(
                    messageInput.scrollHeight,
                    130
                ) + 'px';
        }

        messageInput.addEventListener(
            'input',
            resizeMessageInput
        );


        /* --------------------------------
           ENTER TO SEND
        -------------------------------- */

        messageInput.addEventListener(
            'keydown',
            function(event) {

                if (
                    event.key === 'Enter' &&
                    !event.shiftKey
                ) {

                    event.preventDefault();

                    messageForm.requestSubmit();

                }

            }
        );


        /* --------------------------------
           SEND MESSAGE
        -------------------------------- */

        messageForm.addEventListener(
            'submit',
            async function(event) {

                event.preventDefault();

                const text =
                    messageInput.value.trim();

                if (!text) {
                    return;
                }

                sendButton.disabled = true;

                try {

                    const response =
                        await fetch(
                            "{{ route('messages.store', $conversation) }}",
                            {
                                method: 'POST',

                                headers: {
                                    'Content-Type':
                                        'application/json',

                                    'Accept':
                                        'application/json',

                                    'X-CSRF-TOKEN':
                                        csrfToken
                                },

                                body: JSON.stringify({
                                    message: text
                                })
                            }
                        );

                    const data =
                        await response.json();

                    if (
                        !response.ok ||
                        !data.success
                    ) {

                        throw new Error(
                            data.message ||
                            'Unable to send message.'
                        );

                    }

                    addMessageToChat(
                        data.message
                    );

                    messageInput.value = '';

                    resizeMessageInput();

                    scrollMessagesToBottom();

                } catch (error) {

                    console.error(error);

                    alert(
                        'Unable to send your message. Please try again.'
                    );

                } finally {

                    sendButton.disabled = false;

                    messageInput.focus();

                }

            }
        );


        /* --------------------------------
           ADD MESSAGE
        -------------------------------- */

        function addMessageToChat(message) {

            const empty =
                document.querySelector('.empty-chat');

            if (empty) {
                empty.remove();
            }

            const row =
                document.createElement('div');

            row.className =
                'message-row mine';

            row.dataset.messageId =
                message.id;

            row.innerHTML = `

                <div class="message-bubble">

                    <div class="message-actions">

                        <button
                            type="button"
                            class="message-menu-button"
                            onclick="toggleMessageMenu(this)"
                        >
                            ⋮
                        </button>

                        <div class="message-menu">

                            <button
                                type="button"
                                onclick="openEditMessage(${message.id})"
                            >
                                Edit
                            </button>

                            <button
                                type="button"
                                class="delete-action"
                                onclick="openDeleteMessage(${message.id})"
                            >
                                Delete
                            </button>

                        </div>

                    </div>

                    <p
                        class="message-text"
                        id="message-text-${message.id}"
                    >${escapeHtml(message.text)}</p>

                    <div class="message-meta">

                        <span>
                            ${message.time}
                        </span>

                        <span class="message-check">
                            ✓
                        </span>

                    </div>

                </div>
            `;

            document
                .querySelector('.messages-inner')
                .appendChild(row);
        }


        /* --------------------------------
           ESCAPE HTML
        -------------------------------- */

        function escapeHtml(value) {

            const div =
                document.createElement('div');

            div.textContent = value;

            return div.innerHTML;
        }


        /* --------------------------------
           MESSAGE MENU
        -------------------------------- */

        function toggleMessageMenu(button) {

            document
                .querySelectorAll('.message-menu.open')
                .forEach(function(menu) {

                    if (
                        menu !==
                        button.nextElementSibling
                    ) {
                        menu.classList.remove('open');
                    }

                });

            button
                .nextElementSibling
                .classList.toggle('open');
        }

        document.addEventListener(
            'click',
            function(event) {

                if (
                    !event.target.closest(
                        '.message-actions'
                    )
                ) {

                    document
                        .querySelectorAll(
                            '.message-menu.open'
                        )
                        .forEach(function(menu) {

                            menu.classList.remove(
                                'open'
                            );

                        });

                }

            }
        );


        /* --------------------------------
           EDIT
        -------------------------------- */

        let editingMessageId = null;

        function openEditMessage(messageId) {

            const textElement =
                document.getElementById(
                    `message-text-${messageId}`
                );

            if (!textElement) {
                return;
            }

            editingMessageId =
                messageId;

            document.getElementById(
                'editMessageInput'
            ).value =
                textElement.textContent;

            document
                .getElementById('editModal')
                .classList.add('show');

            document
                .getElementById('editMessageInput')
                .focus();

            closeAllMessageMenus();
        }

        function closeEditModal() {

            editingMessageId = null;

            document
                .getElementById('editModal')
                .classList.remove('show');

        }

        async function saveEditedMessage() {

            if (!editingMessageId) {
                return;
            }

            const input =
                document.getElementById(
                    'editMessageInput'
                );

            const text =
                input.value.trim();

            if (!text) {
                return;
            }

            try {

                const response =
                    await fetch(
                        `/messages/${editingMessageId}`,
                        {
                            method: 'PATCH',

                            headers: {
                                'Content-Type':
                                    'application/json',

                                'Accept':
                                    'application/json',

                                'X-CSRF-TOKEN':
                                    csrfToken
                            },

                            body: JSON.stringify({
                                message: text
                            })
                        }
                    );

                const data =
                    await response.json();

                if (
                    !response.ok ||
                    !data.success
                ) {

                    throw new Error(
                        data.message ||
                        'Unable to edit message.'
                    );

                }

                const textElement =
                    document.getElementById(
                        `message-text-${editingMessageId}`
                    );

                if (textElement) {

                    textElement.textContent =
                        data.message.text;

                }

                const row =
                    document.querySelector(
                        `[data-message-id="${editingMessageId}"]`
                    );

                if (row) {

                    const meta =
                        row.querySelector(
                            '.message-meta'
                        );

                    if (
                        meta &&
                        !meta.querySelector(
                            '.message-edited'
                        )
                    ) {

                        const edited =
                            document.createElement(
                                'span'
                            );

                        edited.className =
                            'message-edited';

                        edited.textContent =
                            'edited';

                        meta.insertBefore(
                            edited,
                            meta.children[1]
                        );

                    }

                }

                closeEditModal();

            } catch (error) {

                console.error(error);

                alert(
                    'Unable to edit the message.'
                );

            }

        }


        /* --------------------------------
           DELETE
        -------------------------------- */

        let deletingMessageId = null;

        function openDeleteMessage(messageId) {

            deletingMessageId =
                messageId;

            document
                .getElementById('deleteModal')
                .classList.add('show');

            closeAllMessageMenus();
        }

        function closeDeleteModal() {

            deletingMessageId = null;

            document
                .getElementById('deleteModal')
                .classList.remove('show');

        }

        async function deleteMessage() {

            if (!deletingMessageId) {
                return;
            }

            try {

                const response =
                    await fetch(
                        `/messages/${deletingMessageId}`,
                        {
                            method: 'DELETE',

                            headers: {
                                'Accept':
                                    'application/json',

                                'X-CSRF-TOKEN':
                                    csrfToken
                            }
                        }
                    );

                const data =
                    await response.json();

                if (
                    !response.ok ||
                    !data.success
                ) {

                    throw new Error(
                        data.message ||
                        'Unable to delete message.'
                    );

                }

                const row =
                    document.querySelector(
                        `[data-message-id="${deletingMessageId}"]`
                    );

                if (row) {

                    const bubble =
                        row.querySelector(
                            '.message-bubble'
                        );

                    const text =
                        row.querySelector(
                            '.message-text'
                        );

                    const actions =
                        row.querySelector(
                            '.message-actions'
                        );

                    if (actions) {
                        actions.remove();
                    }

                    if (text) {

                        text.textContent =
                            'This message was deleted';

                        text.classList.add(
                            'deleted-message'
                        );

                    }

                    const edited =
                        row.querySelector(
                            '.message-edited'
                        );

                    if (edited) {
                        edited.remove();
                    }

                }

                closeDeleteModal();

            } catch (error) {

                console.error(error);

                alert(
                    'Unable to delete the message.'
                );

            }

        }


        function closeAllMessageMenus() {

            document
                .querySelectorAll(
                    '.message-menu.open'
                )
                .forEach(function(menu) {

                    menu.classList.remove(
                        'open'
                    );

                });

        }


        /* --------------------------------
           HEARTBEAT
        -------------------------------- */

        async function sendHeartbeat() {

            try {

                await fetch(
                    "{{ route('messages.heartbeat') }}",
                    {
                        method: 'POST',

                        headers: {
                            'Accept':
                                'application/json',

                            'X-CSRF-TOKEN':
                                csrfToken
                        }
                    }
                );

            } catch (error) {

                console.warn(
                    'Heartbeat failed.',
                    error
                );

            }

        }

        sendHeartbeat();

        setInterval(
            sendHeartbeat,
            30000
        );


        /* --------------------------------
           CLOSE MODALS
        -------------------------------- */

        document
            .getElementById('editModal')
            .addEventListener(
                'click',
                function(event) {

                    if (
                        event.target === this
                    ) {

                        closeEditModal();

                    }

                }
            );

        document
            .getElementById('deleteModal')
            .addEventListener(
                'click',
                function(event) {

                    if (
                        event.target === this
                    ) {

                        closeDeleteModal();

                    }

                }
            );

    </script>

</x-app-layout>