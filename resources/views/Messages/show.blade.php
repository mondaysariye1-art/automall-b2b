<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>

    <meta charset="utf-8">

    <meta name="viewport"
          content="width=device-width, initial-scale=1">

    <title>Conversation - AutoMall</title>

    <style>

        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            background: #f4f5f7;
            color: #101828;
            font-family: Arial, Helvetica, sans-serif;
        }

        .page {
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }

        .top {
            height: 66px;
            background: white;
            border-bottom: 1px solid #e3e6ea;
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 0 22px;
        }

        .brand {
            display: flex;
            align-items: center;
            gap: 9px;
            color: #111;
            text-decoration: none;
            font-weight: 900;
        }

        .logo {
            width: 35px;
            height: 35px;
            border-radius: 9px;
            background: #ed1b2f;
            color: white;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 900;
        }

        .back {
            color: #667085;
            font-size: 11px;
            font-weight: 800;
            text-decoration: none;
        }

        .chat {
            width: min(900px, 100%);
            margin: 20px auto;
            flex: 1;
            display: flex;
            flex-direction: column;
            background: white;
            border: 1px solid #e1e4e8;
            border-radius: 15px;
            overflow: hidden;
            min-height: calc(100vh - 110px);
        }

        .chat-header {
            padding: 16px 18px;
            border-bottom: 1px solid #eef0f2;
        }

        .person {
            font-size: 14px;
            font-weight: 900;
        }

        .vehicle {
            margin-top: 4px;
            color: #ed1b2f;
            font-size: 10px;
            font-weight: 800;
        }

        .messages {
            flex: 1;
            padding: 22px;
            overflow-y: auto;
            background: #fafafa;
        }

        .message-row {
            display: flex;
            margin-bottom: 12px;
        }

        .message-row.mine {
            justify-content: flex-end;
        }

        .bubble {
            max-width: 72%;
            padding: 11px 14px;
            border-radius: 14px;
            background: white;
            border: 1px solid #e1e4e8;
        }

        .mine .bubble {
            background: #111;
            color: white;
            border-color: #111;
            border-bottom-right-radius: 4px;
        }

        .message-row:not(.mine) .bubble {
            border-bottom-left-radius: 4px;
        }

        .text {
            font-size: 12px;
            line-height: 1.55;
            white-space: pre-wrap;
            word-break: break-word;
        }

        .time {
            margin-top: 5px;
            font-size: 8px;
            opacity: .55;
        }

        .composer {
            padding: 13px;
            border-top: 1px solid #e7e9ec;
            background: white;
        }

        .composer form {
            display: flex;
            gap: 9px;
        }

        textarea {
            flex: 1;
            min-height: 44px;
            max-height: 120px;
            resize: vertical;
            border: 1px solid #d9dde2;
            border-radius: 10px;
            padding: 12px;
            font-family: inherit;
            font-size: 12px;
            outline: none;
        }

        textarea:focus {
            border-color: #ed1b2f;
        }

        .send {
            width: 80px;
            border: 0;
            border-radius: 10px;
            background: #ed1b2f;
            color: white;
            font-size: 10px;
            font-weight: 900;
            cursor: pointer;
        }

        .send:hover {
            background: #c91224;
        }

        .vehicle-card {
            margin-top: 10px;
            padding: 9px 11px;
            border: 1px solid #e5e7eb;
            border-radius: 9px;
            background: white;
        }

        .vehicle-card a {
            color: #111;
            font-size: 10px;
            font-weight: 900;
            text-decoration: none;
        }

        @media(max-width:600px) {

            .top {
                padding: 0 13px;
            }

            .chat {
                margin: 0;
                border-radius: 0;
                border-left: 0;
                border-right: 0;
                min-height: calc(100vh - 66px);
            }

            .messages {
                padding: 15px;
            }

            .bubble {
                max-width: 85%;
            }

            .send {
                width: 60px;
            }

        }

    </style>

</head>

<body>

<div class="page">

    <header class="top">

        <a href="{{ route('dashboard') }}" class="brand">
            <span class="logo">A</span>
            <span>AutoMall</span>
        </a>

        <a
            href="{{ route('messages.index') }}"
            class="back"
        >
            All Messages
        </a>

    </header>

    <main class="chat">

        @php

            $isBuyer =
                auth()->id() === $conversation->buyer_id;

            $personName = $isBuyer
                ? ($conversation->dealer->business_name ?? 'Dealer')
                : ($conversation->buyer->name ?? 'Buyer');

            $vehicleName = $conversation->vehicle
                ? trim(collect([
                    $conversation->vehicle->year,
                    $conversation->vehicle->make,
                    $conversation->vehicle->model
                ])->filter()->implode(' '))
                : 'Vehicle inquiry';

        @endphp

        <div class="chat-header">

            <div class="person">
                {{ $personName }}
            </div>

            <div class="vehicle">
                {{ $vehicleName }}
            </div>

            @if($conversation->vehicle)

                <div class="vehicle-card">

                    <a
                        href="{{ route('public.vehicles.show', $conversation->vehicle) }}"
                    >
                        View vehicle listing →
                    </a>

                </div>

            @endif

        </div>

        <div class="messages" id="messages">

            @forelse($conversation->messages as $message)

                <div
                    class="message-row {{ $message->sender_id === auth()->id() ? 'mine' : '' }}"
                >

                    <div class="bubble">

                        <div class="text">
                            {{ $message->message }}
                        </div>

                        <div class="time">
                            {{ $message->created_at->format('M j, g:i A') }}
                        </div>

                    </div>

                </div>

            @empty

                <div style="
                    text-align:center;
                    color:#98a2b3;
                    font-size:11px;
                    padding:40px 15px;
                ">
                    Start the conversation.
                </div>

            @endforelse

            <div id="latest"></div>

        </div>

        <div class="composer">

            <form
                method="POST"
                action="{{ route('messages.store', $conversation) }}"
            >

                @csrf

                <textarea
                    name="message"
                    placeholder="Write a message..."
                    required
                    maxlength="5000"
                ></textarea>

                <button
                    type="submit"
                    class="send"
                >
                    Send
                </button>

            </form>

        </div>

    </main>

</div>

<script>

    const messages = document.getElementById('messages');

    if (messages) {
        messages.scrollTop = messages.scrollHeight;
    }

</script>

</body>
</html>