<x-app-layout>

    <style>
        .settings-page {
            min-height: calc(100vh - 65px);
            background: #f5f5f5;
            padding: 35px;
        }

        .settings-container {
            max-width: 1100px;
            margin: 0 auto;
        }

        .settings-header {
            margin-bottom: 30px;
        }

        .settings-header h1 {
            margin: 0 0 7px;
            color: #111;
            font-size: 32px;
            font-weight: 800;
        }

        .settings-header p {
            margin: 0;
            color: #777;
            font-size: 15px;
        }

        .settings-layout {
            display: grid;
            grid-template-columns: 230px 1fr;
            gap: 25px;
        }

        .settings-menu,
        .settings-card {
            background: #fff;
            border: 1px solid #e5e5e5;
            border-radius: 12px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, .04);
        }

        .settings-menu {
            height: fit-content;
            padding: 10px;
            position: sticky;
            top: 85px;
        }

        .settings-menu-item {
            display: block;
            width: 100%;
            box-sizing: border-box;
            padding: 12px 14px;
            margin-bottom: 4px;
            border-radius: 7px;
            color: #555;
            background: transparent;
            text-decoration: none;
            font-size: 13px;
            font-weight: 700;
            transition: .2s ease;
        }

        .settings-menu-item:last-child {
            margin-bottom: 0;
        }

        .settings-menu-item.active {
            background: #111;
            color: #fff;
        }

        .settings-menu-item:hover:not(.active) {
            background: #f4f4f4;
            color: #111;
        }

        .settings-card {
            padding: 30px;
            margin-bottom: 20px;
            scroll-margin-top: 90px;
        }

        .settings-card:last-child {
            margin-bottom: 0;
        }

        .settings-card-header {
            padding-bottom: 18px;
            border-bottom: 1px solid #e8e8e8;
            margin-bottom: 5px;
        }

        .settings-card-header h2 {
            margin: 0 0 5px;
            color: #111;
            font-size: 19px;
            font-weight: 800;
        }

        .settings-card-header p {
            margin: 0;
            color: #888;
            font-size: 13px;
            line-height: 1.5;
        }

        .setting-row {
            min-height: 72px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 25px;
            border-bottom: 1px solid #eee;
        }

        .setting-row:last-child {
            border-bottom: 0;
        }

        .setting-info {
            flex: 1;
        }

        .setting-title {
            margin: 0 0 4px;
            color: #222;
            font-size: 14px;
            font-weight: 800;
        }

        .setting-description {
            margin: 0;
            color: #888;
            font-size: 12px;
            line-height: 1.5;
        }

        .setting-control {
            flex-shrink: 0;
        }

        .toggle {
            position: relative;
            width: 48px;
            height: 26px;
            display: inline-block;
        }

        .toggle input {
            opacity: 0;
            width: 0;
            height: 0;
        }

        .toggle-slider {
            position: absolute;
            inset: 0;
            border-radius: 30px;
            background: #ccc;
            cursor: pointer;
            transition: .2s ease;
        }

        .toggle-slider::before {
            content: "";
            position: absolute;
            width: 20px;
            height: 20px;
            left: 3px;
            top: 3px;
            border-radius: 50%;
            background: #fff;
            transition: .2s ease;
        }

        .toggle input:checked + .toggle-slider {
            background: #c90000;
        }

        .toggle input:checked + .toggle-slider::before {
            transform: translateX(22px);
        }

        .select-control {
            min-width: 150px;
            height: 42px;
            padding: 0 12px;
            border: 1px solid #d8d8d8;
            border-radius: 7px;
            background: #fff;
            color: #222;
            font-size: 13px;
            outline: none;
        }

        .select-control:focus {
            border-color: #c90000;
        }

        .security-link {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            min-width: 125px;
            height: 40px;
            padding: 0 16px;
            border: 1px solid #d5d5d5;
            border-radius: 7px;
            background: #fff;
            color: #222;
            text-decoration: none;
            font-size: 12px;
            font-weight: 800;
            transition: .2s ease;
        }

        .security-link:hover {
            border-color: #c90000;
            color: #c90000;
        }

        .danger-card {
            border-color: #eadada;
        }

        .danger-card .settings-card-header h2 {
            color: #b00000;
        }

        .logout-button {
            border: 0;
            padding: 0;
            background: transparent;
            color: #c90000;
            font-size: 13px;
            font-weight: 800;
            cursor: pointer;
        }

        .logout-button:hover {
            text-decoration: underline;
        }

        .setting-status {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            margin-top: 7px;
            font-size: 11px;
            font-weight: 700;
            color: #777;
            opacity: 0;
            transition: opacity .2s ease;
        }

        .setting-status.show {
            opacity: 1;
        }

        .setting-status.success {
            color: #16803c;
        }

        .setting-status.error {
            color: #b00000;
        }

        @media (max-width: 800px) {
            .settings-layout {
                grid-template-columns: 1fr;
            }

            .settings-menu {
                position: static;
                display: flex;
                overflow-x: auto;
                gap: 5px;
            }

            .settings-menu-item {
                white-space: nowrap;
                width: auto;
                margin-bottom: 0;
            }
        }

        @media (max-width: 600px) {
            .settings-page {
                padding: 22px 15px;
            }

            .settings-header h1 {
                font-size: 27px;
            }

            .settings-card {
                padding: 22px;
            }

            .setting-row {
                align-items: flex-start;
                padding: 18px 0;
            }

            .select-control {
                min-width: 120px;
            }

            .security-link {
                min-width: 110px;
            }
        }

        /* DARK MODE */

        html.automall-dark body {
            background: #101010;
        }

        html.automall-dark .settings-page {
            background: #101010;
        }

        html.automall-dark .settings-card,
        html.automall-dark .settings-menu {
            background: #181818;
            border-color: #2d2d2d;
        }

        html.automall-dark .settings-header h1,
        html.automall-dark .settings-card-header h2,
        html.automall-dark .setting-title {
            color: #fff;
        }

        html.automall-dark .settings-header p,
        html.automall-dark .settings-card-header p,
        html.automall-dark .setting-description,
        html.automall-dark .setting-status {
            color: #aaa;
        }

        html.automall-dark .setting-row,
        html.automall-dark .settings-card-header {
            border-color: #2d2d2d;
        }

        html.automall-dark .settings-menu-item {
            color: #bbb;
        }

        html.automall-dark .settings-menu-item:hover:not(.active) {
            background: #242424;
            color: #fff;
        }

        html.automall-dark .select-control,
        html.automall-dark .security-link {
            background: #202020;
            border-color: #3a3a3a;
            color: #fff;
        }

        html.automall-dark .danger-card {
            border-color: #542727;
        }
    </style>

    <div class="settings-page">

        <div class="settings-container">

            <div class="settings-header">
                <h1>Settings</h1>
                <p>Manage your AutoMall account and preferences.</p>
            </div>

            <div class="settings-layout">

                <nav class="settings-menu">

                    <a href="#preferences" class="settings-menu-item active">
                        Preferences
                    </a>

                    <a href="#notifications" class="settings-menu-item">
                        Notifications
                    </a>

                    <a href="#security" class="settings-menu-item">
                        Security
                    </a>

                    <a href="#account" class="settings-menu-item">
                        Account
                    </a>

                </nav>

                <main>

                    {{-- PREFERENCES --}}

                    <section id="preferences" class="settings-card">

                        <div class="settings-card-header">
                            <h2>Preferences</h2>
                            <p>
                                Customize how AutoMall looks and behaves for you.
                            </p>
                        </div>

                        {{-- Dark Mode --}}

                        <div class="setting-row">

                            <div class="setting-info">
                                <p class="setting-title">Dark Mode</p>

                                <p class="setting-description">
                                    Use a darker interface throughout AutoMall.
                                </p>
                            </div>

                            <div class="setting-control">

                                <label class="toggle">

                                    <input
                                        type="checkbox"
                                        id="darkModeToggle"
                                    >

                                    <span class="toggle-slider"></span>

                                </label>

                            </div>

                        </div>

                        {{-- Language --}}

                        <div class="setting-row">

                            <div class="setting-info">
                                <p class="setting-title">Language</p>

                                <p class="setting-description">
                                    Choose the language used throughout the marketplace.
                                </p>
                            </div>

                            <div class="setting-control">

                                <select class="select-control">
                                    <option selected>English</option>
                                </select>

                            </div>

                        </div>

                        {{-- Online Status --}}

                        <div class="setting-row">

                            <div class="setting-info">

                                <p class="setting-title">
                                    Online Status
                                </p>

                                <p class="setting-description">
                                    Allow other dealers to see when you are online
                                    or recently active.
                                </p>

                                <div
                                    id="onlineStatusMessage"
                                    class="setting-status"
                                ></div>

                            </div>

                            <div class="setting-control">

                                <label class="toggle">

                                    <input
                                        type="checkbox"
                                        id="onlineStatusToggle"
                                        {{ auth()->user()->show_online_status ? 'checked' : '' }}
                                    >

                                    <span class="toggle-slider"></span>

                                </label>

                            </div>

                        </div>

                    </section>

                    {{-- NOTIFICATIONS --}}

                    <section id="notifications" class="settings-card">

                        <div class="settings-card-header">
                            <h2>Notifications</h2>

                            <p>
                                Choose which updates you want to receive.
                            </p>
                        </div>

                        <div class="setting-row">

                            <div class="setting-info">
                                <p class="setting-title">
                                    Vehicle Requests
                                </p>

                                <p class="setting-description">
                                    Receive updates when dealers respond to your vehicle requests.
                                </p>
                            </div>

                            <div class="setting-control">

                                <label class="toggle">

                                    <input
                                        type="checkbox"
                                        checked
                                    >

                                    <span class="toggle-slider"></span>

                                </label>

                            </div>

                        </div>

                        <div class="setting-row">

                            <div class="setting-info">
                                <p class="setting-title">
                                    Messages
                                </p>

                                <p class="setting-description">
                                    Receive notifications for new dealer messages.
                                </p>
                            </div>

                            <div class="setting-control">

                                <label class="toggle">

                                    <input
                                        type="checkbox"
                                        checked
                                    >

                                    <span class="toggle-slider"></span>

                                </label>

                            </div>

                        </div>

                        <div class="setting-row">

                            <div class="setting-info">
                                <p class="setting-title">
                                    Marketplace Updates
                                </p>

                                <p class="setting-description">
                                    Receive important AutoMall marketplace updates.
                                </p>
                            </div>

                            <div class="setting-control">

                                <label class="toggle">

                                    <input
                                        type="checkbox"
                                        checked
                                    >

                                    <span class="toggle-slider"></span>

                                </label>

                            </div>

                        </div>

                    </section>

                    {{-- SECURITY --}}

                    <section id="security" class="settings-card">

                        <div class="settings-card-header">
                            <h2>Security</h2>

                            <p>
                                Keep your AutoMall account secure.
                            </p>
                        </div>

                        <div class="setting-row">

                            <div class="setting-info">

                                <p class="setting-title">
                                    Password
                                </p>

                                <p class="setting-description">
                                    Change your account password.
                                </p>

                            </div>

                            <div class="setting-control">

                                <a
                                    href="{{ route('profile.edit') }}#password"
                                    class="security-link"
                                >
                                    Change Password
                                </a>

                            </div>

                        </div>

                        <div class="setting-row">

                            <div class="setting-info">

                                <p class="setting-title">
                                    Account Email
                                </p>

                                <p class="setting-description">
                                    {{ auth()->user()->email }}
                                </p>

                            </div>

                            <div class="setting-control">

                                <a
                                    href="{{ route('profile.edit') }}"
                                    class="security-link"
                                >
                                    Edit Profile
                                </a>

                            </div>

                        </div>

                    </section>

                    {{-- ACCOUNT --}}

                    <section id="account" class="settings-card danger-card">

                        <div class="settings-card-header">

                            <h2>Account</h2>

                            <p>
                                Manage your AutoMall account session.
                            </p>

                        </div>

                        <div class="setting-row">

                            <div class="setting-info">

                                <p class="setting-title">
                                    Log Out
                                </p>

                                <p class="setting-description">
                                    Sign out of your AutoMall account on this device.
                                </p>

                            </div>

                            <div class="setting-control">

                                <form
                                    method="POST"
                                    action="{{ route('logout') }}"
                                >

                                    @csrf

                                    <button
                                        type="submit"
                                        class="logout-button"
                                    >
                                        Log Out
                                    </button>

                                </form>

                            </div>

                        </div>

                    </section>

                </main>

            </div>

        </div>

    </div>

    <script>

        /* --------------------------------
           DARK MODE
        -------------------------------- */

        const darkModeToggle =
            document.getElementById('darkModeToggle');

        function applyDarkMode(enabled) {

            document.documentElement.classList.toggle(
                'automall-dark',
                enabled
            );

            localStorage.setItem(
                'automall-dark-mode',
                enabled ? '1' : '0'
            );
        }

        const savedDarkMode =
            localStorage.getItem('automall-dark-mode') === '1';

        if (darkModeToggle) {

            darkModeToggle.checked = savedDarkMode;

            applyDarkMode(savedDarkMode);

            darkModeToggle.addEventListener(
                'change',
                function () {

                    applyDarkMode(this.checked);

                }
            );
        }


        /* --------------------------------
           ONLINE STATUS
        -------------------------------- */

        const onlineStatusToggle =
            document.getElementById('onlineStatusToggle');

        const onlineStatusMessage =
            document.getElementById('onlineStatusMessage');

        function showOnlineStatusMessage(
            message,
            type = 'success'
        ) {

            if (!onlineStatusMessage) {
                return;
            }

            onlineStatusMessage.textContent = message;

            onlineStatusMessage.className =
                'setting-status show ' + type;

            setTimeout(function () {

                onlineStatusMessage.classList.remove('show');

            }, 2200);
        }

        if (onlineStatusToggle) {

            onlineStatusToggle.addEventListener(
                'change',
                async function () {

                    const checkbox = this;
                    const previousValue = !checkbox.checked;

                    checkbox.disabled = true;

                    try {

                        const response = await fetch(
                            "{{ route('settings.online-status') }}",
                            {
                                method: 'POST',

                                headers: {
                                    'Content-Type': 'application/json',
                                    'Accept': 'application/json',

                                    'X-CSRF-TOKEN':
                                        document
                                            .querySelector(
                                                'meta[name="csrf-token"]'
                                            )
                                            ?.getAttribute('content')
                                },

                                body: JSON.stringify({
                                    show_online_status:
                                        checkbox.checked
                                })
                            }
                        );

                        const data =
                            await response.json();

                        if (!response.ok || !data.success) {
                            throw new Error(
                                data.message ||
                                'Unable to update online status.'
                            );
                        }

                        showOnlineStatusMessage(
                            checkbox.checked
                                ? 'Online status is visible.'
                                : 'Online status is hidden.',
                            'success'
                        );

                    } catch (error) {

                        console.error(error);

                        checkbox.checked = previousValue;

                        showOnlineStatusMessage(
                            'Unable to update. Please try again.',
                            'error'
                        );

                    } finally {

                        checkbox.disabled = false;

                    }

                }
            );

        }


        /* --------------------------------
           SETTINGS MENU
        -------------------------------- */

        const settingMenuItems =
            document.querySelectorAll(
                '.settings-menu-item'
            );

        const settingSections =
            document.querySelectorAll(
                '.settings-card'
            );

        function updateActiveSettingsMenu() {

            let currentSection = '';

            settingSections.forEach(function (section) {

                const rect =
                    section.getBoundingClientRect();

                if (rect.top <= 150) {
                    currentSection = section.id;
                }

            });

            settingMenuItems.forEach(function (item) {

                const target =
                    item.getAttribute('href');

                item.classList.toggle(
                    'active',
                    target === '#' + currentSection
                );

            });

        }

        window.addEventListener(
            'scroll',
            updateActiveSettingsMenu,
            { passive: true }
        );

        updateActiveSettingsMenu();

    </script>

</x-app-layout>