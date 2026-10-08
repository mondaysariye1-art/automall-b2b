<x-app-layout>

<style>
    .notification-detail-page {
        min-height: calc(100vh - 64px);
        background: #f4f5f7;
        color: #111827;
        padding: 35px 42px 70px;
    }

    .notification-detail-container {
        width: 100%;
        max-width: 900px;
        margin: 0 auto;
    }

    .notification-detail-topbar {
        display: flex;
        align-items: center;
        justify-content: space-between;
        margin-bottom: 22px;
    }

    .notification-back {
        height: 40px;
        padding: 0 15px;

        border: 1px solid #d7dce3;
        border-radius: 8px;

        background: #fff;
        color: #344054;

        display: inline-flex;
        align-items: center;

        gap: 8px;

        text-decoration: none;

        font-size: 11px;
        font-weight: 700;
    }

    .notification-back:hover {
        border-color: #c4cad3;
    }

    .notification-detail-card {
        background: #fff;
        border: 1px solid #e0e4e9;
        border-radius: 12px;
        overflow: hidden;
    }

    .notification-detail-header {
        padding: 28px 30px;
        border-bottom: 1px solid #e9ecf0;
        background: #fff8f9;
    }

    .notification-detail-heading {
        display: flex;
        align-items: flex-start;
        gap: 15px;
    }

    .notification-detail-icon {
        width: 48px;
        height: 48px;
        min-width: 48px;

        border-radius: 10px;

        background: #ed1b2f;
        color: #fff;

        display: flex;
        align-items: center;
        justify-content: center;
    }

    .notification-detail-icon svg {
        width: 22px;
        height: 22px;
        stroke: currentColor;
    }

    .notification-detail-type {
        color: #ed1b2f;

        font-size: 9px;
        font-weight: 800;

        letter-spacing: 1.2px;
        text-transform: uppercase;
    }

    .notification-detail-title {
        margin: 5px 0 0;

        color: #101828;

        font-size: 24px;
        line-height: 1.2;

        font-weight: 800;
        letter-spacing: -.4px;
    }

    .notification-detail-time {
        margin-top: 7px;

        color: #98a2b3;

        font-size: 10px;
    }

    .notification-detail-body {
        padding: 30px;
    }

    .notification-detail-label {
        margin-bottom: 9px;

        color: #667085;

        font-size: 9px;
        font-weight: 800;

        letter-spacing: 1px;
        text-transform: uppercase;
    }

    .notification-detail-message {
        color: #344054;

        font-size: 13px;
        line-height: 1.7;
    }

    .notification-info-grid {
        margin-top: 28px;

        display: grid;

        grid-template-columns: repeat(2, minmax(0, 1fr));

        gap: 12px;
    }

    .notification-info-item {
        padding: 14px;

        border: 1px solid #e4e7ec;
        border-radius: 9px;

        background: #fafbfc;
    }

    .notification-info-item-label {
        color: #98a2b3;

        font-size: 8px;
        font-weight: 800;

        letter-spacing: .9px;
        text-transform: uppercase;
    }

    .notification-info-item-value {
        margin-top: 6px;

        color: #101828;

        font-size: 11px;
        font-weight: 700;

        word-break: break-word;
    }

    .notification-extra {
        margin-top: 28px;
    }

    .notification-extra-list {
        display: grid;
        gap: 9px;
    }

    .notification-extra-row {
        padding: 13px 14px;

        border: 1px solid #e4e7ec;
        border-radius: 9px;

        background: #fff;

        display: grid;

        grid-template-columns: 150px minmax(0, 1fr);

        gap: 15px;
    }

    .notification-extra-key {
        color: #667085;

        font-size: 10px;
        font-weight: 700;
    }

    .notification-extra-value {
        color: #101828;

        font-size: 10px;

        line-height: 1.5;

        word-break: break-word;
    }

    .notification-support {
        margin-top: 28px;

        padding: 22px;

        border-radius: 10px;

        background: #080d15;
        color: #fff;
    }

    .notification-support-label {
        color: #8390a2;

        font-size: 8px;
        font-weight: 800;

        letter-spacing: 1px;
        text-transform: uppercase;
    }

    .notification-support h3 {
        margin: 8px 0 0;

        color: #fff;

        font-size: 18px;
        font-weight: 800;
    }

    .notification-support p {
        margin: 8px 0 0;

        color: #9ca7b8;

        font-size: 10px;
        line-height: 1.6;
    }

    .notification-support-email {
        display: inline-block;

        margin-top: 13px;

        color: #fff;

        font-size: 11px;
        font-weight: 800;

        text-decoration: none;
    }

    .notification-support-email:hover {
        color: #fff;
        text-decoration: underline;
    }

    @media (max-width: 760px) {

        .notification-detail-page {
            padding: 25px 18px 90px;
        }

        .notification-detail-header,
        .notification-detail-body {
            padding: 22px;
        }

        .notification-detail-title {
            font-size: 20px;
        }

        .notification-info-grid {
            grid-template-columns: 1fr;
        }

        .notification-extra-row {
            grid-template-columns: 1fr;
            gap: 5px;
        }
    }
</style>


@php

    $data = is_array($notification->data)
        ? $notification->data
        : [];

    $title = $data['title']
        ?? 'AutoMall Notification';

    $message = $data['message']
        ?? 'You have a new notification.';

    $type = $data['type']
        ?? 'general';

    $extraData = collect($data)->except([
        'title',
        'message',
        'type',
    ]);

@endphp


<div class="notification-detail-page">

    <div class="notification-detail-container">


        <div class="notification-detail-topbar">

            <a
                href="{{ route('notifications.index') }}"
                class="notification-back"
            >
                <span>←</span>

                <span>
                    Back to Notifications
                </span>
            </a>

        </div>


        <div class="notification-detail-card">


            {{-- HEADER --}}

            <div class="notification-detail-header">

                <div class="notification-detail-heading">


                    <div class="notification-detail-icon">

                        <svg
                            viewBox="0 0 24 24"
                            fill="none"
                            stroke-width="1.7"
                        >
                            <path d="M18 8a6 6 0 0 0-12 0c0 7-3 7-3 9h18c0-2-3-2-3-9"/>
                            <path d="M10 21h4"/>
                        </svg>

                    </div>


                    <div>

                        <div class="notification-detail-type">
                            {{ str_replace('_', ' ', $type) }}
                        </div>


                        <h1 class="notification-detail-title">
                            {{ $title }}
                        </h1>


                        <div class="notification-detail-time">
                            Received
                            {{ $notification->created_at->format('M j, Y \a\t g:i A') }}
                        </div>

                    </div>

                </div>

            </div>


            {{-- BODY --}}

            <div class="notification-detail-body">


                <div class="notification-detail-label">
                    Full Notification
                </div>


                <div class="notification-detail-message">
                    {{ $message }}
                </div>


                <div class="notification-info-grid">


                    <div class="notification-info-item">

                        <div class="notification-info-item-label">
                            Status
                        </div>

                        <div class="notification-info-item-value">
                            Read
                        </div>

                    </div>


                    <div class="notification-info-item">

                        <div class="notification-info-item-label">
                            Notification Type
                        </div>

                        <div class="notification-info-item-value">
                            {{ str_replace('_', ' ', $type) }}
                        </div>

                    </div>


                    <div class="notification-info-item">

                        <div class="notification-info-item-label">
                            Received
                        </div>

                        <div class="notification-info-item-value">
                            {{ $notification->created_at->format('M j, Y \a\t g:i A') }}
                        </div>

                    </div>


                    <div class="notification-info-item">

                        <div class="notification-info-item-label">
                            Notification ID
                        </div>

                        <div class="notification-info-item-value">
                            {{ $notification->id }}
                        </div>

                    </div>

                </div>


                @if($extraData->isNotEmpty())

                    <div class="notification-extra">

                        <div class="notification-detail-label">
                            Additional Information
                        </div>


                        <div class="notification-extra-list">

                            @foreach($extraData as $key => $value)

                                <div class="notification-extra-row">

                                    <div class="notification-extra-key">
                                        {{ ucwords(str_replace(['_', '-'], ' ', $key)) }}
                                    </div>


                                    <div class="notification-extra-value">

                                        @if(is_array($value))

                                            {{ json_encode(
                                                $value,
                                                JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES
                                            ) }}

                                        @else

                                            {{ $value }}

                                        @endif

                                    </div>

                                </div>

                            @endforeach

                        </div>

                    </div>

                @endif


                {{-- CUSTOMER CARE --}}

                <div class="notification-support">

                    <div class="notification-support-label">
                        AutoMall Customer Care
                    </div>


                    <h3>
                        Need help with this notification?
                    </h3>


                    <p>
                        Contact AutoMall Customer Care for questions about
                        your account, vehicles, requests, VIN checks,
                        messages, or other AutoMall activity.
                    </p>


                    <a
                        href="mailto:info@automallcardelearship.com"
                        class="notification-support-email"
                    >
                        info@automallcardelearship.com
                    </a>

                </div>

            </div>

        </div>

    </div>

</div>

</x-app-layout>