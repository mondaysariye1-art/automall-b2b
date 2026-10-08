@php
    $dealer = \App\Models\Dealer::where('user_id', Auth::id())->first();
@endphp

<style>
    .automall-sidebar {
        position: fixed;
        top: 0;
        left: 0;
        bottom: 0;
        width: 260px;
        z-index: 1000;
        background: #111111;
        color: #ffffff;
        display: flex;
        flex-direction: column;
        border-right: 1px solid #292929;
        transition: width 0.25s ease;
    }

    .automall-sidebar.collapsed {
        width: 76px;
    }

    .automall-sidebar-header {
        height: 76px;
        min-height: 76px;
        padding: 0 18px;
        display: flex;
        align-items: center;
        justify-content: space-between;
        border-bottom: 1px solid #292929;
        position: relative;
    }

    .automall-logo {
        display: flex;
        align-items: center;
        gap: 10px;
        text-decoration: none;
        color: #ffffff;
        font-size: 22px;
        font-weight: 900;
        white-space: nowrap;
    }

    .automall-logo-mark {
        width: 38px;
        height: 38px;
        min-width: 38px;
        background: #d60000;
        border-radius: 9px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: 900;
    }

    .sidebar-toggle {
        width: 34px;
        height: 34px;
        min-width: 34px;
        border: 1px solid #333333;
        border-radius: 8px;
        background: #1d1d1d;
        color: #ffffff;
        cursor: pointer;
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 0;
    }

    .sidebar-toggle:hover {
        background: #d60000;
        border-color: #d60000;
    }

    .sidebar-toggle svg {
        width: 18px;
        height: 18px;
        transition: transform 0.25s ease;
    }

    .automall-sidebar.collapsed .sidebar-toggle {
        position: absolute;
        top: 21px;
        right: -17px;
        background: #d60000;
        border-color: #d60000;
    }

    .automall-sidebar.collapsed .sidebar-toggle svg {
        transform: rotate(180deg);
    }

    .automall-sidebar.collapsed .automall-logo-text {
        display: none;
    }

    .automall-sidebar.collapsed .automall-sidebar-header {
        justify-content: center;
        padding: 0;
    }

    .automall-sidebar-nav {
        flex: 1;
        padding: 20px 12px;
        overflow-y: auto;
    }

    .sidebar-heading {
        color: #777777;
        font-size: 10px;
        font-weight: 800;
        letter-spacing: 1px;
        text-transform: uppercase;
        padding: 0 12px 10px;
        white-space: nowrap;
    }

    .automall-sidebar.collapsed .sidebar-heading {
        visibility: hidden;
    }

    .sidebar-item {
        display: flex;
        align-items: center;
        gap: 13px;
        width: 100%;
        min-height: 46px;
        padding: 10px 12px;
        margin-bottom: 4px;
        border-radius: 9px;
        box-sizing: border-box;
        color: #bdbdbd;
        text-decoration: none;
        font-size: 14px;
        font-weight: 600;
        transition: background 0.15s ease, color 0.15s ease;
        white-space: nowrap;
    }

    .sidebar-item:hover {
        background: #202020;
        color: #ffffff;
    }

    .sidebar-item.active {
        background: #d60000;
        color: #ffffff;
    }

    .sidebar-item svg {
        width: 20px;
        height: 20px;
        min-width: 20px;
    }

    .sidebar-item-text {
        overflow: hidden;
    }

    .automall-sidebar.collapsed .sidebar-item {
        justify-content: center;
        padding: 10px;
    }

    .automall-sidebar.collapsed .sidebar-item-text {
        display: none;
    }

    .sidebar-user-area {
        border-top: 1px solid #292929;
        padding: 12px;
    }

    .sidebar-user {
        display: flex;
        align-items: center;
        gap: 10px;
        padding: 8px;
        margin-bottom: 5px;
    }

    .sidebar-avatar {
        width: 36px;
        height: 36px;
        min-width: 36px;
        border-radius: 50%;
        background: #d60000;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 14px;
        font-weight: 800;
    }

    .sidebar-user-details {
        min-width: 0;
    }

    .sidebar-user-name {
        color: #ffffff;
        font-size: 13px;
        font-weight: 700;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
    }

    .sidebar-dealer-name {
        color: #777777;
        font-size: 11px;
        margin-top: 2px;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
    }

    .automall-sidebar.collapsed .sidebar-user {
        justify-content: center;
    }

    .automall-sidebar.collapsed .sidebar-user-details {
        display: none;
    }

    .sidebar-logout {
        width: 100%;
        border: 0;
        background: transparent;
        cursor: pointer;
        text-align: left;
        font-family: inherit;
    }

    .automall-sidebar.collapsed .sidebar-logout {
        text-align: center;
    }

    .automall-main-content {
        margin-left: 260px;
        min-height: 100vh;
        transition: margin-left 0.25s ease;
    }

    body.sidebar-is-collapsed .automall-main-content {
        margin-left: 76px;
    }

    body.sidebar-is-expanded .automall-main-content {
        margin-left: 260px;
    }

    @media (max-width: 900px) {
        .automall-sidebar {
            width: 76px;
        }

        .automall-sidebar .automall-logo-text,
        .automall-sidebar .sidebar-item-text,
        .automall-sidebar .sidebar-user-details {
            display: none;
        }

        .automall-sidebar .sidebar-item {
            justify-content: center;
        }

        .automall-sidebar .sidebar-heading {
            visibility: hidden;
        }

        .automall-main-content {
            margin-left: 76px;
        }

        .automall-sidebar.mobile-expanded {
            width: 260px;
        }

        .automall-sidebar.mobile-expanded .automall-logo-text,
        .automall-sidebar.mobile-expanded .sidebar-item-text,
        .automall-sidebar.mobile-expanded .sidebar-user-details {
            display: block;
        }

        .automall-sidebar.mobile-expanded .sidebar-item {
            justify-content: flex-start;
        }

        .automall-sidebar.mobile-expanded .sidebar-heading {
            visibility: visible;
        }

        body.sidebar-is-expanded .automall-main-content {
            margin-left: 260px;
        }
    }
</style>

<nav id="automallSidebar" class="automall-sidebar">

    <div class="automall-sidebar-header">

        <a
            href="{{ route('dashboard') }}"
            class="automall-logo"
        >
            <span class="automall-logo-mark">A</span>
            <span class="automall-logo-text">AutoMall</span>
        </a>

        <button
            type="button"
            id="sidebarToggle"
            class="sidebar-toggle"
            aria-label="Collapse sidebar"
            title="Collapse sidebar"
        >
            <svg
                viewBox="0 0 24 24"
                fill="none"
                stroke="currentColor"
                stroke-width="2"
            >
                <path d="M15 18l-6-6 6-6"></path>
            </svg>
        </button>

    </div>


    <div class="automall-sidebar-nav">

        <div class="sidebar-heading">
            Marketplace
        </div>


        <a
            href="{{ route('dashboard') }}"
            class="sidebar-item {{ request()->routeIs('dashboard') ? 'active' : '' }}"
        >
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <rect x="3" y="3" width="7" height="7"></rect>
                <rect x="14" y="3" width="7" height="7"></rect>
                <rect x="3" y="14" width="7" height="7"></rect>
                <rect x="14" y="14" width="7" height="7"></rect>
            </svg>

            <span class="sidebar-item-text">Dashboard</span>
        </a>


        <a
            href="{{ route('vehicles.index') }}"
            class="sidebar-item {{ request()->routeIs('vehicles.*') ? 'active' : '' }}"
        >
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <path d="M5 17h14"></path>
                <path d="M6 17l1-5 2-4h6l2 4 1 5"></path>
                <circle cx="8" cy="17" r="2"></circle>
                <circle cx="16" cy="17" r="2"></circle>
            </svg>

            <span class="sidebar-item-text">My Vehicles</span>
        </a>


        <a
            href="{{ route('vehicles.create') }}"
            class="sidebar-item"
        >
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <path d="M12 5v14"></path>
                <path d="M5 12h14"></path>
            </svg>

            <span class="sidebar-item-text">Add Vehicle</span>
        </a>


        <a
            href="{{ route('communication') }}"
            class="sidebar-item {{ request()->routeIs('communication', 'messages.*') ? 'active' : '' }}"
        >
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <path d="M21 11.5a8.4 8.4 0 0 1-9 8.3 8.5 8.5 0 0 1-3.8-.9L3 21l1.5-4.7A8.5 8.5 0 0 1 3 11.5 8.5 8.5 0 0 1 12 3a8.5 8.5 0 0 1 9 8.5z"></path>
            </svg>

            <span class="sidebar-item-text">Messages & Requests</span>
        </a>


        <a
            href="{{ route('vin.check') }}"
            class="sidebar-item {{ request()->routeIs('vin.*') ? 'active' : '' }}"
        >
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <rect x="4" y="4" width="16" height="16" rx="2"></rect>
                <path d="M8 9h8"></path>
                <path d="M8 13h5"></path>
                <path d="M8 17h3"></path>
            </svg>

            <span class="sidebar-item-text">VIN Check</span>
        </a>


        <div class="sidebar-heading" style="margin-top:18px;">
            Account
        </div>


        <a
            href="{{ route('profile.edit') }}"
            class="sidebar-item {{ request()->routeIs('profile.*') ? 'active' : '' }}"
        >
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <circle cx="12" cy="8" r="4"></circle>
                <path d="M4 21a8 8 0 0 1 16 0"></path>
            </svg>

            <span class="sidebar-item-text">Profile</span>
        </a>


        <a
            href="{{ route('settings') }}"
            class="sidebar-item {{ request()->routeIs('settings') ? 'active' : '' }}"
        >
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <circle cx="12" cy="12" r="3"></circle>
                <path d="M19.4 15a1.7 1.7 0 0 0 .3 1.9l.1.1-1.8 1.8-.1-.1a1.7 1.7 0 0 0-1.9-.3 1.7 1.7 0 0 0-1 1.6v.2h-2.6V20a1.7 1.7 0 0 0-1-1.6 1.7 1.7 0 0 0-1.9.3l-.1.1-1.8-1.8.1-.1a1.7 1.7 0 0 0 .3-1.9 1.7 1.7 0 0 0-1.6-1H4v-2.6h.2a1.7 1.7 0 0 0 1.6-1 1.7 1.7 0 0 0-.3-1.9l-.1-.1 1.8-1.8.1.1a1.7 1.7 0 0 0 1.9.3 1.7 1.7 0 0 0 1-1.6V5h2.6v.2a1.7 1.7 0 0 0 1 1.6 1.7 1.7 0 0 0 1.9-.3l.1-.1 1.8 1.8-.1.1a1.7 1.7 0 0 0-.3 1.9 1.7 1.7 0 0 0 1.6 1h.2v2.6H21a1.7 1.7 0 0 0-1.6 1z"></path>
            </svg>

            <span class="sidebar-item-text">Settings</span>
        </a>

    </div>


    <div class="sidebar-user-area">

        <div class="sidebar-user">

            <div class="sidebar-avatar">
                {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
            </div>

            <div class="sidebar-user-details">

                <div class="sidebar-user-name">
                    {{ Auth::user()->name }}
                </div>

                <div class="sidebar-dealer-name">
                    {{ $dealer?->business_name ?? 'AutoMall Dealer' }}
                </div>

            </div>

        </div>


        <form
            method="POST"
            action="{{ route('logout') }}"
        >
            @csrf

            <button
                type="submit"
                class="sidebar-item sidebar-logout"
            >
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <path d="M10 17l5-5-5-5"></path>
                    <path d="M15 12H3"></path>
                    <path d="M21 19V5a2 2 0 0 0-2-2h-6"></path>
                </svg>

                <span class="sidebar-item-text">Logout</span>
            </button>
        </form>

    </div>

</nav>


<script>
(function () {

    function setupSidebar() {

        const sidebar = document.getElementById('automallSidebar');
        const toggle = document.getElementById('sidebarToggle');

        if (!sidebar || !toggle) {
            return;
        }

        /*
         * Restore saved state
         */
        const savedState = localStorage.getItem('automall-sidebar-state');

        if (savedState === 'collapsed') {

            sidebar.classList.add('collapsed');

            document.body.classList.add('sidebar-is-collapsed');
            document.body.classList.remove('sidebar-is-expanded');

        } else {

            sidebar.classList.remove('collapsed');

            document.body.classList.add('sidebar-is-expanded');
            document.body.classList.remove('sidebar-is-collapsed');
        }


        /*
         * Collapse / Expand
         */
        toggle.addEventListener('click', function (event) {

            event.preventDefault();
            event.stopPropagation();

            const collapsed = sidebar.classList.toggle('collapsed');

            if (collapsed) {

                localStorage.setItem(
                    'automall-sidebar-state',
                    'collapsed'
                );

                document.body.classList.add('sidebar-is-collapsed');
                document.body.classList.remove('sidebar-is-expanded');

                toggle.setAttribute(
                    'aria-label',
                    'Expand sidebar'
                );

                toggle.setAttribute(
                    'title',
                    'Expand sidebar'
                );

            } else {

                localStorage.setItem(
                    'automall-sidebar-state',
                    'expanded'
                );

                document.body.classList.add('sidebar-is-expanded');
                document.body.classList.remove('sidebar-is-collapsed');

                toggle.setAttribute(
                    'aria-label',
                    'Collapse sidebar'
                );

                toggle.setAttribute(
                    'title',
                    'Collapse sidebar'
                );
            }

        });

    }


    /*
     * Works whether the script loads before or after DOM.
     */
    if (document.readyState === 'loading') {

        document.addEventListener(
            'DOMContentLoaded',
            setupSidebar
        );

    } else {

        setupSidebar();

    }

})();
</script>