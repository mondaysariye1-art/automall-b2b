<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Messages - AutoMall</title>

    <style>
        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            background: #f5f6f8;
            color: #101828;
            font-family: Arial, Helvetica, sans-serif;
        }

        a {
            text-decoration: none;
        }

        .page {
            min-height: 100vh;
            padding: 24px 16px 50px;
        }

        .wrap {
            max-width: 900px;
            margin: auto;
        }

        .top {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 20px;
        }

        .brand {
            display: flex;
            align-items: center;
            gap: 9px;
            color: #111;
            font-weight: 900;
        }

        .logo {
            width: 36px;
            height: 36px;
            display: flex;
            align-items: center;
            justify-content: center;
            background: #ed1b2f;
            color: white;
            border-radius: 9px;
            font-weight: 900;
        }

        .back {
            color: #667085;
            font-size: 12px;
            font-weight: 800;
        }

        .header {
            margin-bottom: 18px;
        }

        .eyebrow {
            color: #ed1b2f;
            font-size: 9px;
            font-weight: 900;
            letter-spacing: 1.5px;
            text-transform: uppercase;
        }

        h1 {
            margin: 5px 0 0;
            font-size: 28px;
        }

        .subtitle {
            margin: 7px 0 0;
            color: #667085;
            font-size: 12px;
        }

        .card {
            background: white;
            border: 1px solid #e2e5e9;
            border-radius: 14px;
            overflow: hidden;
        }

        .empty {
            padding: 55px 25px;
            text-align: center;
        }

        .empty-icon {
            width: 58px;
            height: 58px;
            margin: 0 auto 15px;
            border-radius: 50%;
            background: #f1f2f4;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 24px;
        }

        .empty h2 {
            margin: 0;
            font-size: 17px;
        }

        .empty p {
            color: #98a2b3;
            font-size: 12px;
        }

        .conversation {
            display: flex;
            gap: 14px;
            padding: 17px;
            border-bottom: 1px solid #eef0f2;
            color: inherit;
            transition: background .15s ease;
        }

        .conversation:last-child {
            border-bottom: 0;
        }

        .conversation:hover {
            background: #fafafa;
        }

        .avatar {
            width: 48px;
            height: 48px;
            flex: 0 0 48px;
            border-radius: 12px;
            background: #111;
            color: white;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 900;
        }

        .conversation-content {
            min-width: 0;
            flex: 1;
        }

        .conversation-top {
            display: flex;
            justify-content: space-between;
            gap: 10px;
        }

        .name {
            font-size: 13px;
            font-weight: 900;
        }

        .time {
            color: #98a2b3;
            font-size: 9px;
            white-space: nowrap;
        }

        .vehicle {
            margin-top: 3px;
            color: #ed1b2f;
            font-size: 10px;
            font-weight: 800;
        }

        .preview {
            margin-top: 5px;
            color: #667085;
            font-size: 11px;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        @media(max-width:600px) {
            .page {
                padding: 17px 11px 40px;
            }

            h1 {
                font-size: 24px;
            }
        }
    </style>
</head>

<body>

<div class="page">

    <div class="wrap">

        <div class="top">

            <a href="{{ route('dashboard') }}" class="brand">
                <span class="logo">A</span>
                <span>AutoMall</span>
            </a>

            <a href="{{ route('dashboard') }}" class="back">
                Dashboard
            </a>

        </div>

        <div class="header">

            <div class="eyebrow">
                Communication
            </div>

            <h1>
                Messages
            </h1>

            <p class="subtitle">
                Chat directly with dealers and buyers.
            </p>

        </div>

        <div class="card">

            @if($conversations->isEmpty())

                <div class="empty">

                    <div class="empty-icon">
                        ✉
                    </div>

                    <h2>
                        No conversations yet
                    </h2>

                    <p>
                        When you message a dealer about a vehicle,
                        your conversation will appear here.
                    </p>

                </div>

            @else

                @foreach($conversations as $conversation)

                    @php

                        $isBuyer = auth()->id() === $conversation->buyer_id;

                        if ($isBuyer) {
                            $personName = $conversation->dealer->business_name
                                ?? 'Dealer';

                            $initial = strtoupper(
                                substr($personName, 0, 1)
                            );
                        } else {
                            $personName = $conversation->buyer->name
                                ?? 'Buyer';

                            $initial = strtoupper(
                                substr($personName, 0, 1)
                            );
                        }

                        $vehicleName = $conversation->vehicle
                            ? trim(collect([
                                $conversation->vehicle->year,
                                $conversation->vehicle->make,
                                $conversation->vehicle->model
                            ])->filter()->implode(' '))
                            : 'Vehicle inquiry';

                        $latest = $conversation->latestMessage;

                    @endphp

                    <a
                        href="{{ route('messages.show', $conversation) }}"
                        class="conversation"
                    >

                        <div class="avatar">
                            {{ $initial }}
                        </div>

                        <div class="conversation-content">

                            <div class="conversation-top">

                                <div class="name">
                                    {{ $personName }}
                                </div>

                                @if($latest)
                                    <div class="time">
                                        {{ $latest->created_at->diffForHumans() }}
                                    </div>
                                @endif

                            </div>

                            <div class="vehicle">
                                {{ $vehicleName }}
                            </div>

                            <div class="preview">

                                @if($latest)

                                    @if($latest->sender_id === auth()->id())
                                        You:
                                    @endif

                                    {{ $latest->message }}

                                @else

                                    No messages yet.

                                @endif

                            </div>

                        </div>

                    </a>

                @endforeach

            @endif

        </div>

    </div>

</div>

</body>
</html>