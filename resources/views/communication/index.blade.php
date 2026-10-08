<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1, viewport-fit=cover"
    >

    <meta
        name="csrf-token"
        content="{{ csrf_token() }}"
    >

    <title>Messages - AutoMall</title>

    <style>
        * {
            box-sizing: border-box;
        }

        html,
        body {
            margin: 0;
            min-height: 100%;
        }

        body {
            background: #f5f6f8;
            color: #101828;
            font-family:
                Inter,
                -apple-system,
                BlinkMacSystemFont,
                "Segoe UI",
                Arial,
                sans-serif;
        }

        a {
            color: inherit;
            text-decoration: none;
        }

        button {
            font: inherit;
        }

        .page {
            min-height: 100vh;
            padding: 20px 16px 80px;
        }

        @media (min-width: 901px) {
            .page.automall-main-content {
                min-height: 100vh;
            }
        }

        @media (max-width: 900px) {
            .automall-sidebar {
                display: none !important;
            }

            .automall-main-content {
                margin-left: 0 !important;
            }
        }

        .search-wrap {
            margin-bottom: 16px;
        }

        .search-input {
            width: 100%;
            height: 46px;
            padding: 0 14px;
            border: 1px solid #e4e7ec;
            border-radius: 12px;
            background: #fff;
            color: #101828;
            font-size: 13px;
            outline: none;
        }

        .search-input:focus {
            border-color: #ed1b2f;
        }

        .search-empty {
            display: none;
            padding: 28px 18px;
            color: #98a2b3;
            font-size: 12px;
            text-align: center;
        }

        .wrap {
            width: 100%;
            max-width: 980px;
            margin: 0 auto;
        }

        /*
        |--------------------------------------------------------------------------
        | TOP BAR
        |--------------------------------------------------------------------------
        */

        .top {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 15px;
            margin-bottom: 18px;
        }

        .brand {
            display: inline-flex;
            align-items: center;
            gap: 10px;
            font-weight: 900;
        }

        .logo {
            width: 38px;
            height: 38px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            border-radius: 11px;
            background: #ed1b2f;
            color: #fff;
            font-size: 15px;
            font-weight: 900;
        }

        .brand-text {
            font-size: 14px;
            letter-spacing: -.2px;
        }

        .dashboard-link {
            display: inline-flex;
            align-items: center;
            gap: 7px;
            padding: 9px 13px;
            border: 1px solid #e4e7ec;
            border-radius: 10px;
            background: #fff;
            color: #344054;
            font-size: 12px;
            font-weight: 800;
        }

        .dashboard-link:hover {
            border-color: #d0d5dd;
            background: #fafafa;
        }

        /*
        |--------------------------------------------------------------------------
        | HEADER
        |--------------------------------------------------------------------------
        */

        .header {
            margin-bottom: 18px;
        }

        .eyebrow {
            margin-bottom: 5px;
            color: #ed1b2f;
            font-size: 10px;
            font-weight: 900;
            letter-spacing: 1.5px;
            text-transform: uppercase;
        }

        h1 {
            margin: 0;
            color: #101828;
            font-size: 30px;
            line-height: 1.15;
            letter-spacing: -.8px;
        }

        .subtitle {
            margin: 7px 0 0;
            color: #667085;
            font-size: 13px;
            line-height: 1.5;
        }

        /*
        |--------------------------------------------------------------------------
        | CHAT CARD
        |--------------------------------------------------------------------------
        */

        .card {
            overflow: hidden;
            border: 1px solid #e4e7ec;
            border-radius: 16px;
            background: #fff;
            box-shadow: 0 8px 30px rgba(16, 24, 40, .04);
        }

        /*
        |--------------------------------------------------------------------------
        | EMPTY STATE
        |--------------------------------------------------------------------------
        */

        .empty {
            padding: 75px 25px;
            text-align: center;
        }

        .empty-icon {
            width: 66px;
            height: 66px;
            margin: 0 auto 17px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 50%;
            background: #fef0f1;
            color: #ed1b2f;
            font-size: 27px;
        }

        .empty h2 {
            margin: 0;
            font-size: 19px;
            font-weight: 900;
        }

        .empty p {
            max-width: 430px;
            margin: 8px auto 0;
            color: #98a2b3;
            font-size: 12px;
            line-height: 1.6;
        }

        /*
        |--------------------------------------------------------------------------
        | CONVERSATION
        |--------------------------------------------------------------------------
        */

        .conversation {
            position: relative;
            display: flex;
            align-items: center;
            gap: 13px;
            min-width: 0;
            padding: 15px 17px;
            border-bottom: 1px solid #f0f1f3;
            background: #fff;
            transition:
                background .15s ease,
                transform .15s ease;
        }

        .conversation:last-child {
            border-bottom: 0;
        }

        .conversation:hover {
            background: #fafafa;
        }

        .conversation:active {
            background: #f5f5f5;
        }

        /*
        |--------------------------------------------------------------------------
        | AVATAR
        |--------------------------------------------------------------------------
        */

        .avatar-wrap {
            position: relative;
            flex: 0 0 52px;
        }

        .avatar {
            width: 52px;
            height: 52px;
            display: flex;
            align-items: center;
            justify-content: center;
            overflow: hidden;
            border-radius: 50%;
            background: #111;
            color: #fff;
            font-size: 17px;
            font-weight: 900;
        }

        .avatar img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .online-dot {
            position: absolute;
            right: 1px;
            bottom: 1px;
            width: 13px;
            height: 13px;
            border: 3px solid #fff;
            border-radius: 50%;
            background: #16a34a;
        }

        /*
        |--------------------------------------------------------------------------
        | CONVERSATION CONTENT
        |--------------------------------------------------------------------------
        */

        .conversation-content {
            min-width: 0;
            flex: 1;
        }

        .conversation-top {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 10px;
        }

        .name {
            min-width: 0;
            overflow: hidden;
            color: #101828;
            font-size: 14px;
            font-weight: 900;
            white-space: nowrap;
            text-overflow: ellipsis;
        }

        .time {
            flex: 0 0 auto;
            color: #98a2b3;
            font-size: 10px;
            white-space: nowrap;
        }

        .preview-row {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 10px;
            margin-top: 5px;
        }

        .preview {
            min-width: 0;
            overflow: hidden;
            color: #667085;
            font-size: 11px;
            line-height: 1.4;
            white-space: nowrap;
            text-overflow: ellipsis;
        }

        .you {
            color: #344054;
            font-weight: 700;
        }

        /*
        |--------------------------------------------------------------------------
        | UNREAD
        |--------------------------------------------------------------------------
        */

        .unread .name {
            font-weight: 950;
        }

        .unread .preview {
            color: #344054;
            font-weight: 700;
        }

        .unread-badge {
            min-width: 20px;
            height: 20px;
            padding: 0 6px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            border-radius: 999px;
            background: #ed1b2f;
            color: #fff;
            font-size: 9px;
            font-weight: 900;
        }

        /*
        |--------------------------------------------------------------------------
        | MOBILE BOTTOM NAVIGATION
        |--------------------------------------------------------------------------
        */

        .mobile-nav {
            position: fixed;
            right: 0;
            bottom: 0;
            left: 0;
            z-index: 50;
            display: none;
            height: 64px;
            padding:
                7px
                10px
                calc(7px + env(safe-area-inset-bottom));
            border-top: 1px solid #e4e7ec;
            background: rgba(255, 255, 255, .97);
            backdrop-filter: blur(12px);
        }

        .mobile-nav-inner {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 5px;
            width: 100%;
            max-width: 500px;
            margin: auto;
        }

        .nav-item {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            gap: 3px;
            border-radius: 9px;
            color: #667085;
            font-size: 9px;
            font-weight: 800;
        }

        .nav-item.active {
            color: #ed1b2f;
        }

        .nav-icon {
            font-size: 17px;
            line-height: 1;
        }

        /*
        |--------------------------------------------------------------------------
        | RESPONSIVE
        |--------------------------------------------------------------------------
        */

        @media (max-width: 700px) {
            .page {
                padding: 14px 9px 80px;
            }

            .wrap {
                max-width: none;
            }

            .top {
                margin-bottom: 15px;
            }

            .dashboard-link {
                padding: 8px 10px;
            }

            h1 {
                font-size: 25px;
            }

            .subtitle {
                font-size: 12px;
            }

            .card {
                border-radius: 13px;
            }

            .conversation {
                padding: 14px 12px;
            }

            .mobile-nav {
                display: block;
            }
        }

        @media (max-width: 420px) {
            .brand-text {
                display: none;
            }

            .dashboard-link {
                font-size: 11px;
            }

            .avatar-wrap,
            .avatar {
                width: 48px;
                height: 48px;
            }

            .avatar-wrap {
                flex-basis: 48px;
            }

            .name {
                font-size: 13px;
            }

            .preview {
                font-size: 10px;
            }
        }
    </style>
</head>

<body>

@include('layouts.navigation')

<div class="page automall-main-content">

    <div class="wrap">

        {{-- TOP BAR --}}
        <div class="top">

            <a
                href="{{ route('dashboard') }}"
                class="brand"
            >
                <span class="logo">A</span>
                <span class="brand-text">AutoMall</span>
            </a>

            <a
                href="{{ route('dashboard') }}"
                class="dashboard-link"
            >
                ← Dashboard
            </a>

        </div>


        {{-- HEADER --}}
        <div class="header">

            <div class="eyebrow">
                Communication
            </div>

            <h1>
                Messages
            </h1>

            <p class="subtitle">
                Chat with dealers, discuss vehicles, share information
                and continue your conversations in one place.
            </p>

        </div>


        {{-- CONVERSATIONS --}}
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
                        When you message another dealer about a vehicle,
                        your conversation will appear here.
                    </p>

                </div>

            @else

                @foreach($conversations as $conversation)

                    @php

                        /*
                         * Determine who the current user is talking to.
                         */

                        $isBuyer =
                            (int) $conversation->buyer_id ===
                            (int) $dealer->id;

                        $otherDealer = $isBuyer
                            ? $conversation->dealer
                            : $conversation->buyer;

                        /*
                         * Dealer/business name.
                         */

                        $personName =
                            $otherDealer?->business_name
                            ?? $otherDealer?->user?->name
                            ?? 'Dealer';

                        /*
                         * Avatar initial.
                         */

                        $initial = strtoupper(
                            substr(trim($personName), 0, 1)
                        );

                        /*
                         * Vehicle context.
                         */

                        $vehicleName = 'General conversation';

                        if ($conversation->vehicle) {

                            $vehicleName = trim(
                                collect([
                                    $conversation->vehicle->year,
                                    $conversation->vehicle->make,
                                    $conversation->vehicle->model,
                                ])
                                ->filter()
                                ->implode(' ')
                            );

                            if ($vehicleName === '') {
                                $vehicleName = 'Vehicle discussion';
                            }
                        }

                        /*
                         * Latest message.
                         */

                        $latest = $conversation->latestMessage;

                        /*
                         * Unread messages.
                         */

                        $unreadCount =
                            (int) ($conversation->unread_count ?? 0);

                        /*
                         * Online status.
                         */

                        $otherIsOnline = false;

                        if ($otherDealer?->user) {

                            $lastSeen =
                                $otherDealer->user->last_seen_at;

                            $otherIsOnline =
                                $lastSeen &&
                                $lastSeen->greaterThanOrEqualTo(
                                    now()->subMinutes(2)
                                );
                        }

                    @endphp


                    <a
                        href="{{ route('messages.show', $conversation) }}"
                        class="conversation {{ $unreadCount > 0 ? 'unread' : '' }}"
                    >

                        {{-- AVATAR --}}
                        <div class="avatar-wrap">

                            <div class="avatar">

                                @if(!empty($otherDealer?->logo))

                                    <img
                                        src="{{ asset('storage/' . $otherDealer->logo) }}"
                                        alt="{{ $personName }}"
                                    >

                                @else

                                    {{ $initial }}

                                @endif

                            </div>

                            @if($otherIsOnline)

                                <span class="online-dot"></span>

                            @endif

                        </div>


                        {{-- CONTENT --}}
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

                                🚗

                                <span>
                                    {{ $vehicleName }}
                                </span>

                            </div>


                            <div class="preview-row">

                                <div class="preview">

                                    @if($latest)

                                        @if(
                                            (int) $latest->sender_id ===
                                            (int) $dealer->id
                                        )

                                            <span class="you">
                                                You:
                                            </span>

                                        @endif

                                        {{ $latest->message }}

                                    @else

                                        Start chatting

                                    @endif

                                </div>


                                @if($unreadCount > 0)

                                    <span class="unread-badge">
                                        {{ $unreadCount > 99 ? '99+' : $unreadCount }}
                                    </span>

                                @endif

                            </div>

                        </div>

                    </a>

                @endforeach

            @endif

        </div>

    </div>

</div>


{{-- MOBILE NAVIGATION --}}
<nav class="mobile-nav">

    <div class="mobile-nav-inner">

        <a
            href="{{ route('dashboard') }}"
            class="nav-item"
        >
            <span class="nav-icon">⌂</span>
            <span>Dashboard</span>
        </a>

        <a
            href="{{ route('communication') }}"
            class="nav-item active"
        >
            <span class="nav-icon">✉</span>
            <span>Messages</span>
        </a>

        <a
            href="{{ route('vehicles.index') }}"
            class="nav-item"
        >
            <span class="nav-icon">🚗</span>
            <span>Vehicles</span>
        </a>

    </div>

</nav>

</body>
</html>