<x-app-layout>

<style>
    .notifications-page {
        min-height: calc(100vh - 64px);
        background: #f4f5f7;
        color: #111827;
        padding: 35px 42px 70px;
    }

    .notifications-container {
        width: 100%;
        max-width: 1100px;
        margin: 0 auto;
    }

    .notifications-header {
        display: flex;
        align-items: flex-end;
        justify-content: space-between;
        gap: 20px;
        margin-bottom: 25px;
    }

    .notifications-eyebrow {
        margin-bottom: 8px;
        color: #ed1b2f;
        font-size: 10px;
        font-weight: 800;
        letter-spacing: 1.4px;
        text-transform: uppercase;
    }

    .notifications-header h1 {
        margin: 0;
        color: #101828;
        font-size: 30px;
        line-height: 1.05;
        font-weight: 800;
        letter-spacing: -.8px;
    }

    .notifications-header p {
        margin: 8px 0 0;
        color: #667085;
        font-size: 12px;
    }

    .notifications-actions {
        display: flex;
        align-items: center;
        gap: 9px;
    }

    .notification-action {
        min-height: 40px;
        padding: 0 16px;
        border: 1px solid #d7dce3;
        border-radius: 8px;
        background: #fff;
        color: #344054;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        text-decoration: none;
        font-size: 11px;
        font-weight: 700;
        cursor: pointer;
    }

    .notification-action:hover {
        border-color: #c4cad3;
    }

    .notification-action-red {
        background: #ed1b2f;
        border-color: #ed1b2f;
        color: #fff;
    }

    .notification-action-red:hover {
        background: #d91528;
        border-color: #d91528;
        color: #fff;
    }

    .notifications-card {
        background: #fff;
        border: 1px solid #e0e4e9;
        border-radius: 10px;
        overflow: hidden;
    }

    .notifications-card-header {
        min-height: 62px;
        padding: 0 20px;
        border-bottom: 1px solid #e9ecf0;
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 15px;
    }

    .notifications-card-title {
        color: #101828;
        font-size: 14px;
        font-weight: 800;
    }

    .notifications-count {
        padding: 5px 9px;
        border-radius: 20px;
        background: #ffeaed;
        color: #ed1b2f;
        font-size: 9px;
        font-weight: 800;
        white-space: nowrap;
    }

    .notification-highlight {
        display: flex;
        align-items: flex-start;
        gap: 14px;

        padding: 18px 20px;

        border-bottom: 1px solid #eef0f3;

        background: #fff;
        color: inherit;

        text-decoration: none;

        transition:
            background .15s ease,
            border-color .15s ease;
    }

    .notification-highlight:last-child {
        border-bottom: 0;
    }

    .notification-highlight:hover {
        background: #fafbfc;
    }

    .notification-highlight.unread {
        background: #fff8f9;
    }

    .notification-highlight-icon {
        width: 42px;
        height: 42px;
        min-width: 42px;

        border-radius: 9px;

        background: #ffeaed;
        color: #ed1b2f;

        display: flex;
        align-items: center;
        justify-content: center;
    }

    .notification-highlight-icon svg {
        width: 19px;
        height: 19px;
        stroke: currentColor;
    }

    .notification-highlight-content {
        flex: 1;
        min-width: 0;
    }

    .notification-highlight-top {
        display: flex;
        align-items: center;
        gap: 8px;
        flex-wrap: wrap;
    }

    .notification-highlight-type {
        color: #ed1b2f;
        font-size: 8px;
        font-weight: 800;
        letter-spacing: 1px;
        text-transform: uppercase;
    }

    .notification-highlight-status {
        padding: 3px 6px;
        border-radius: 20px;
        background: #eef2f6;
        color: #667085;
        font-size: 8px;
        font-weight: 700;
    }

    .notification-highlight-status.unread {
        background: #ffeaed;
        color: #ed1b2f;
    }

    .notification-highlight-title {
        margin-top: 6px;
        color: #101828;
        font-size: 13px;
        font-weight: 800;
    }

    .notification-highlight-message {
        margin-top: 5px;
        color: #667085;
        font-size: 11px;
        line-height: 1.5;

        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;

        overflow: hidden;
    }

    .notification-highlight-time {
        margin-top: 8px;
        color: #98a2b3;
        font-size: 9px;
    }

    .notification-highlight-arrow {
        width: 30px;
        height: 30px;

        margin-top: 5px;

        border: 1px solid #e1e5ea;
        border-radius: 7px;

        background: #fff;
        color: #667085;

        display: flex;
        align-items: center;
        justify-content: center;

        flex-shrink: 0;

        font-size: 17px;
    }

    .notification-highlight.unread .notification-highlight-arrow {
        border-color: #f4c8ce;
    }

    .notifications-empty {
        padding: 90px 30px;
        text-align: center;
    }

    .notifications-empty-icon {
        width: 54px;
        height: 54px;
        margin: 0 auto 16px;

        border-radius: 50%;

        background: #ffeaed;
        color: #ed1b2f;

        display: flex;
        align-items: center;
        justify-content: center;
    }

    .notifications-empty-icon svg {
        width: 24px;
        height: 24px;
        stroke: currentColor;
    }

    .notifications-empty h3 {
        margin: 0;
        color: #101828;
        font-size: 16px;
        font-weight: 800;
    }

    .notifications-empty p {
        margin: 8px 0 0;
        color: #98a2b3;
        font-size: 11px;
    }

    .notifications-pagination {
        padding: 18px 20px;
        border-top: 1px solid #eef0f3;
    }

    @media (max-width: 760px) {

        .notifications-page {
            padding: 25px 18px 90px;
        }

        .notifications-header {
            align-items: flex-start;
            flex-direction: column;
        }

        .notifications-actions {
            width: 100%;
        }

        .notification-action {
            flex: 1;
        }

        .notification-highlight {
            padding: 16px;
        }

        .notification-highlight-arrow {
            display: none;
        }
    }
</style>

<div class="notifications-page">

    <div class="notifications-container">

        <div class="notifications-header">

            <div>

                <div class="notifications-eyebrow">
                    AutoMall
                </div>

                <h1>
                    Notifications
                </h1>

                <p>
                    See the latest activity on your AutoMall dealership account.
                </p>

            </div>

            <div class="notifications-actions">

                <a
                    href="{{ route('dashboard') }}"
                    class="notification-action"
                >
                    Back to Dashboard
                </a>

                @if($unreadCount > 0)

                    <form
                        method="POST"
                        action="{{ route('notifications.readAll') }}"
                    >

                        @csrf

                        <button
                            type="submit"
                            class="notification-action notification-action-red"
                        >
                            Mark All as Read
                        </button>

                    </form>

                @endif

            </div>

        </div>


        <div class="notifications-card">

            <div class="notifications-card-header">

                <div class="notifications-card-title">
                    Notification Highlights
                </div>

                @if($unreadCount > 0)

                    <div class="notifications-count">
                        {{ $unreadCount }} unread
                    </div>

                @else

                    <div class="notifications-count">
                        All caught up
                    </div>

                @endif

            </div>


            @forelse($notifications as $notification)

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

                    $isUnread = is_null(
                        $notification->read_at
                    );

                @endphp


                <a
                    href="{{ route('notifications.show', $notification->id) }}"
                    class="notification-highlight {{ $isUnread ? 'unread' : '' }}"
                >

                    <div class="notification-highlight-icon">

                        <svg
                            viewBox="0 0 24 24"
                            fill="none"
                            stroke-width="1.7"
                        >
                            <path d="M18 8a6 6 0 0 0-12 0c0 7-3 7-3 9h18c0-2-3-2-3-9"/>
                            <path d="M10 21h4"/>
                        </svg>

                    </div>


                    <div class="notification-highlight-content">

                        <div class="notification-highlight-top">

                            <span class="notification-highlight-type">
                                {{ str_replace('_', ' ', $type) }}
                            </span>

                            <span class="notification-highlight-status {{ $isUnread ? 'unread' : '' }}">
                                {{ $isUnread ? 'Unread' : 'Read' }}
                            </span>

                        </div>


                        <div class="notification-highlight-title">
                            {{ $title }}
                        </div>


                        <div class="notification-highlight-message">
                            {{ $message }}
                        </div>


                        <div class="notification-highlight-time">
                            {{ $notification->created_at->diffForHumans() }}
                        </div>

                    </div>


                    <div class="notification-highlight-arrow">
                        ›
                    </div>

                </a>

            @empty

                <div class="notifications-empty">

                    <div class="notifications-empty-icon">

                        <svg
                            viewBox="0 0 24 24"
                            fill="none"
                            stroke-width="1.7"
                        >
                            <path d="M18 8a6 6 0 0 0-12 0c0 7-3 7-3 9h18c0-2-3-2-3-9"/>
                            <path d="M10 21h4"/>
                        </svg>

                    </div>

                    <h3>
                        No notifications yet
                    </h3>

                    <p>
                        When something happens on AutoMall, your notification highlights will appear here.
                    </p>

                </div>

            @endforelse


            @if($notifications->hasPages())

                <div class="notifications-pagination">
                    {{ $notifications->links() }}
                </div>

            @endif

        </div>

    </div>

</div>

</x-app-layout>