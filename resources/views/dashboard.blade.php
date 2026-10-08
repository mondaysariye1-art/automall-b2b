{{-- resources/views/dashboard.blade.php --}}

<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1"
    >

    <title>
        {{ config('app.name', 'AutoMall') }} - Dashboard
    </title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>

        /* =========================================================
           BASE
        ========================================================= */

        * {
            box-sizing: border-box;
        }

        html,
        body {
            margin: 0;
            padding: 0;
            min-height: 100%;
        }

        body {
            font-family: inherit;
            background: #f4f5f7;
            color: #111827;
        }

        a {
            -webkit-tap-highlight-color: transparent;
        }


        /* =========================================================
           DASHBOARD
        ========================================================= */

        .automall-dashboard {
            min-height: 100vh;
            background: #f4f5f7;
            color: #111827;
        }


        /* =========================================================
           MAIN LAYOUT
        ========================================================= */

        .dashboard-layout {
            width: 100%;
            min-height: 100vh;
        }


        /* =========================================================
           FIXED DESKTOP SIDEBAR
        ========================================================= */

        .dashboard-sidebar {
            position: fixed;
            top: 0;
            left: 0;
            bottom: 0;

            width: 250px;
            min-width: 250px;
            height: 100vh;

            background: #080d15;
            color: #fff;

            display: flex;
            flex-direction: column;

            z-index: 1000;

            overflow: hidden;

            transition:
                width 0.25s ease,
                min-width 0.25s ease;
        }


        /* =========================================================
           SIDEBAR BRAND
        ========================================================= */

        .sidebar-brand {
            position: relative;

            height: 78px;
            min-height: 78px;

            padding: 0 28px;

            display: flex;
            align-items: center;

            gap: 12px;

            border-bottom: 1px solid #1c222c;
        }

        .sidebar-brand-icon {
            width: 38px;
            height: 38px;

            border-radius: 8px;

            background: #ed1b2f;
            color: #fff;

            display: flex;
            align-items: center;
            justify-content: center;

            font-size: 19px;
            font-weight: 800;

            flex-shrink: 0;
        }

        .sidebar-brand-details {
            min-width: 0;
            overflow: hidden;
        }

        .sidebar-brand-name {
            color: #fff;
            font-size: 20px;
            font-weight: 800;
            letter-spacing: -.6px;
            white-space: nowrap;
        }

        .sidebar-brand-tagline {
            margin-top: 3px;

            color: #7d8798;

            font-size: 8px;
            font-weight: 700;

            letter-spacing: 1.2px;
            white-space: nowrap;
        }


        /* =========================================================
           SIDEBAR COLLAPSE BUTTON
        ========================================================= */

        .sidebar-toggle {
            position: absolute;

            right: -13px;
            top: 50%;

            transform: translateY(-50%);

            width: 28px;
            height: 28px;

            padding: 0;

            border: 1px solid #343b47;
            border-radius: 50%;

            background: #080d15;
            color: #fff;

            display: flex;
            align-items: center;
            justify-content: center;

            cursor: pointer;

            z-index: 1200;

            transition:
                background 0.2s ease,
                border-color 0.2s ease;
        }

        .sidebar-toggle:hover {
            background: #ed1b2f;
            border-color: #ed1b2f;
        }

        .sidebar-toggle svg {
            width: 17px;
            height: 17px;

            stroke: currentColor;

            transition: transform 0.25s ease;
        }


        /* =========================================================
           SIDEBAR CONTENT
        ========================================================= */

        .sidebar-content {
            flex: 1;

            padding: 30px 16px 20px;
        }

        .sidebar-label {
            margin: 0 12px 12px;

            color: #657084;

            font-size: 9px;
            font-weight: 700;

            letter-spacing: 1.6px;
            text-transform: uppercase;
        }

        .sidebar-nav {
            display: flex;
            flex-direction: column;
            gap: 4px;
        }

        .sidebar-nav a {
            min-height: 46px;

            padding: 0 13px;

            border-radius: 8px;

            display: flex;
            align-items: center;

            gap: 13px;

            color: #c0c6d0;

            text-decoration: none;

            font-size: 13px;
            font-weight: 500;

            transition:
                background 0.15s ease,
                color 0.15s ease;
        }

        .sidebar-nav a:hover {
            background: #141b26;
            color: #fff;
        }

        .sidebar-nav a.active {
            background: #ed1b2f;
            color: #fff;
        }

        .sidebar-icon {
            width: 17px;
            height: 17px;

            flex-shrink: 0;

            display: flex;
            align-items: center;
            justify-content: center;
        }

        .sidebar-icon svg {
            width: 17px;
            height: 17px;

            stroke: currentColor;
        }


        /* =========================================================
           SIDEBAR ACCOUNT
        ========================================================= */

        .sidebar-account-section {
            margin-top: 32px;
        }

        .sidebar-account {
            margin: 0 16px 16px;

            padding: 12px;

            border-radius: 8px;

            background: #121a28;

            display: flex;
            align-items: center;

            gap: 10px;
        }

        .sidebar-account-avatar {
            width: 36px;
            height: 36px;

            border-radius: 50%;

            background: #ed1b2f;
            color: #fff;

            display: flex;
            align-items: center;
            justify-content: center;

            overflow: hidden;

            font-size: 13px;
            font-weight: 700;

            flex-shrink: 0;
        }

        .sidebar-account-avatar img {
            width: 100%;
            height: 100%;

            object-fit: cover;
        }

        .sidebar-account-name {
            max-width: 145px;

            overflow: hidden;

            white-space: nowrap;
            text-overflow: ellipsis;

            color: #d0d5dd;

            font-size: 11px;
        }

        .sidebar-account-role {
            margin-top: 3px;

            color: #6d7788;

            font-size: 8px;
        }


        /* =========================================================
           COLLAPSED SIDEBAR
        ========================================================= */

        .dashboard-sidebar.collapsed {
            width: 76px;
            min-width: 76px;
        }

        .dashboard-sidebar.collapsed .sidebar-brand {
            justify-content: center;
            padding: 0;
        }

        .dashboard-sidebar.collapsed .sidebar-brand-details {
            display: none;
        }

        .dashboard-sidebar.collapsed .sidebar-toggle svg {
            transform: rotate(180deg);
        }

        .dashboard-sidebar.collapsed .sidebar-content {
            padding-left: 10px;
            padding-right: 10px;
        }

        .dashboard-sidebar.collapsed .sidebar-label {
            visibility: hidden;
        }

        .dashboard-sidebar.collapsed .sidebar-nav a {
            justify-content: center;
            padding-left: 0;
            padding-right: 0;
        }

        .dashboard-sidebar.collapsed .sidebar-nav a > span:last-child {
            display: none;
        }

        .dashboard-sidebar.collapsed .sidebar-account {
            margin-left: 10px;
            margin-right: 10px;

            justify-content: center;
        }

        .dashboard-sidebar.collapsed .sidebar-account > div:last-child {
            display: none;
        }


        /* =========================================================
           MAIN CONTENT
        ========================================================= */

        .dashboard-main {
            min-width: 0;
            min-height: 100vh;

            margin-left: 250px;

            transition: margin-left 0.25s ease;
        }

        .dashboard-sidebar.collapsed + .dashboard-main {
            margin-left: 76px;
        }


        /* =========================================================
           TOPBAR
        ========================================================= */

        .dashboard-topbar {
            height: 68px;

            padding: 0 30px;

            background: #fff;

            border-bottom: 1px solid #e2e5e9;

            display: flex;
            align-items: center;
            justify-content: space-between;

            position: sticky;
            top: 0;

            z-index: 900;
        }

        .dashboard-search {
            position: relative;
            width: 430px;
            height: 40px;

            padding: 0 13px;

            border: 1px solid #dfe3e8;
            border-radius: 8px;

            background: #fafbfc;

            display: flex;
            align-items: center;

            gap: 10px;
        }

        .dashboard-search svg {
            width: 17px;
            height: 17px;

            color: #98a2b3;
            stroke: currentColor;

            flex-shrink: 0;
        }

        .dashboard-search input {
            width: 100%;

            border: 0;
            outline: 0;

            background: transparent;
            color: #344054;

            font-size: 12px;
        }

        .dashboard-search input::placeholder {
            color: #98a2b3;
        }


        /* =========================================================
           LIVE SEARCH SUGGESTIONS
        ========================================================= */

        .dashboard-search:focus-within {
            border-color: #c40000;
            box-shadow: 0 0 0 3px rgba(196, 0, 0, .07);
            background: #fff;
        }

        .dashboard-search-suggestions {
            position: absolute;
            top: calc(100% + 8px);
            left: 0;
            width: min(430px, calc(100vw - 24px));
            max-height: 430px;
            overflow-y: auto;
            display: none;
            z-index: 3000;
            padding: 8px;
            border: 1px solid #e1e4e8;
            border-radius: 12px;
            background: #fff;
            box-shadow: 0 18px 45px rgba(0, 0, 0, .13);
        }

        .dashboard-search-suggestions.open {
            display: block;
        }

        .search-suggestion-group {
            margin-bottom: 6px;
        }

        .search-suggestion-group:last-child {
            margin-bottom: 0;
        }

        .search-suggestion-label {
            padding: 7px 9px 5px;
            color: #98a2b3;
            font-size: 8px;
            font-weight: 900;
            letter-spacing: .9px;
            text-transform: uppercase;
        }

        .search-suggestion-item {
            width: 100%;
            padding: 9px;
            border: 0;
            border-radius: 8px;
            background: transparent;
            display: flex;
            align-items: center;
            gap: 10px;
            text-align: left;
            color: #101828;
            cursor: pointer;
        }

        .search-suggestion-item:hover,
        .search-suggestion-item:focus {
            background: #f5f6f8;
            outline: none;
        }

        .search-suggestion-icon {
            width: 30px;
            height: 30px;
            flex: 0 0 30px;
            border-radius: 8px;
            background: #111;
            color: #fff;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 10px;
            font-weight: 900;
        }

        .search-suggestion-icon.red {
            background: #c40000;
        }

        .search-suggestion-copy {
            min-width: 0;
            flex: 1;
        }

        .search-suggestion-title {
            overflow: hidden;
            white-space: nowrap;
            text-overflow: ellipsis;
            color: #111827;
            font-size: 11px;
            font-weight: 850;
        }

        .search-suggestion-meta {
            margin-top: 2px;
            overflow: hidden;
            white-space: nowrap;
            text-overflow: ellipsis;
            color: #98a2b3;
            font-size: 9px;
            font-weight: 650;
        }

        .search-suggestion-footer {
            margin-top: 5px;
            padding: 9px 8px 2px;
            border-top: 1px solid #eef0f2;
            color: #c40000;
            font-size: 9px;
            font-weight: 900;
            cursor: pointer;
        }

        .search-suggestion-empty {
            padding: 18px 10px;
            text-align: center;
            color: #8b94a3;
            font-size: 10px;
            font-weight: 700;
        }

        .dashboard-top-right {
            display: flex;
            align-items: center;

            gap: 18px;
        }

        .notification-button {
            width: 38px;
            height: 38px;

            border: 1px solid #dfe3e8;
            border-radius: 8px;

            background: #fff;
            color: #667085;

            display: flex;
            align-items: center;
            justify-content: center;

            position: relative;

            text-decoration: none;
        }

        .notification-button svg {
            width: 18px;
            height: 18px;

            stroke: currentColor;
        }

        .notification-dot {
            position: absolute;

            top: 7px;
            right: 7px;

            width: 6px;
            height: 6px;

            border-radius: 50%;

            background: #ed1b2f;
        }

        .top-profile {
            display: flex;
            align-items: center;

            gap: 10px;

            text-decoration: none;
        }

        .top-profile-avatar {
            width: 38px;
            height: 38px;

            border-radius: 50%;

            background: #111827;
            color: #fff;

            display: flex;
            align-items: center;
            justify-content: center;

            overflow: hidden;

            font-size: 12px;
            font-weight: 700;
        }

        .top-profile-avatar img {
            width: 100%;
            height: 100%;

            object-fit: cover;
        }

        .top-profile-label {
            color: #667085;
            font-size: 10px;
        }


        /* =========================================================
           CONTENT
        ========================================================= */

        .dashboard-content {
            width: 100%;
            max-width: 1480px;

            margin: 0 auto;

            padding: 36px 42px 60px;
        }

        .dashboard-heading-row {
            display: flex;
            align-items: flex-end;
            justify-content: space-between;

            margin-bottom: 25px;
        }

        .dashboard-eyebrow {
            margin-bottom: 8px;

            color: #ed1b2f;

            font-size: 10px;
            font-weight: 800;

            letter-spacing: 1.4px;
            text-transform: uppercase;
        }

        .dashboard-heading h1 {
            margin: 0;

            color: #101828;

            font-size: 30px;
            line-height: 1.05;

            letter-spacing: -.9px;

            font-weight: 800;
        }

        .dashboard-heading p {
            margin: 7px 0 0;

            color: #667085;

            font-size: 12px;
        }

        .heading-actions {
            display: flex;
            gap: 9px;
        }

        .dashboard-button {
            height: 40px;

            padding: 0 18px;

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
        }

        .dashboard-button-red {
            background: #ed1b2f;
            border-color: #ed1b2f;
            color: #fff;
        }

        .dashboard-button-red:hover {
            background: #d91528;
            border-color: #d91528;
            color: #fff;
        }


        /* =========================================================
           STATS
        ========================================================= */

        .dashboard-stats {
            display: grid;

            grid-template-columns: repeat(4, 1fr);

            gap: 14px;

            margin-bottom: 22px;
        }

        .stat-card {
            min-height: 142px;

            padding: 20px;

            border: 1px solid #e0e4e9;
            border-radius: 10px;

            background: #fff;
        }

        .stat-card-top {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
        }

        .stat-title {
            color: #475467;

            font-size: 11px;
            font-weight: 600;
        }

        .stat-icon {
            width: 36px;
            height: 36px;

            border-radius: 8px;

            background: #ffeaed;
            color: #ed1b2f;

            display: flex;
            align-items: center;
            justify-content: center;
        }

        .stat-icon svg {
            width: 17px;
            height: 17px;

            stroke: currentColor;
        }

        .stat-number {
            margin-top: 19px;

            color: #101828;

            font-size: 27px;
            line-height: 1;

            font-weight: 800;
        }

        .stat-description {
            margin-top: 7px;

            color: #98a2b3;

            font-size: 9px;
        }


        /* =========================================================
           LOWER CONTENT
        ========================================================= */

        .dashboard-lower {
            display: grid;

            grid-template-columns: minmax(0, 1fr) 320px;

            gap: 18px;
        }

        .dashboard-panel {
            background: #fff;

            border: 1px solid #e0e4e9;
            border-radius: 10px;

            overflow: hidden;
        }

        .panel-header {
            min-height: 62px;

            padding: 0 20px;

            border-bottom: 1px solid #e9ecf0;

            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .panel-title {
            color: #101828;

            font-size: 14px;
            font-weight: 800;
        }

        .panel-link {
            color: #ed1b2f;

            text-decoration: none;

            font-size: 10px;
            font-weight: 700;
        }


        /* =========================================================
           VEHICLES
        ========================================================= */

        .vehicle-listings {
            padding: 18px;

            display: grid;

            grid-template-columns: repeat(2, minmax(0, 1fr));

            gap: 14px;
        }

        .vehicle-card {
            border: 1px solid #dfe3e8;
            border-radius: 8px;

            background: #fff;

            overflow: hidden;

            text-decoration: none;

            display: block;
        }

        .vehicle-card:hover {
            border-color: #c8ced7;
        }

        .vehicle-image {
            height: 210px;

            position: relative;

            background: #e7e9ec;

            overflow: hidden;
        }

        .vehicle-image img {
            width: 100%;
            height: 100%;

            object-fit: cover;

            display: block;
        }

        .vehicle-no-image {
            width: 100%;
            height: 100%;

            display: flex;
            align-items: center;
            justify-content: center;

            color: #98a2b3;

            font-size: 11px;
        }

        .vehicle-status {
            position: absolute;

            top: 10px;
            left: 10px;

            padding: 5px 8px;

            border-radius: 4px;

            background: #fff;
            color: #344054;

            font-size: 8px;
            font-weight: 800;

            text-transform: uppercase;
        }

        .vehicle-status.active {
            color: #087443;
        }

        .vehicle-status.sold {
            color: #344054;
        }

        .vehicle-status.archived {
            color: #b42318;
        }

        .vehicle-details {
            padding: 14px;
        }

        .vehicle-name {
            color: #101828;

            font-size: 13px;
            font-weight: 800;

            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        .vehicle-mileage {
            margin-top: 6px;

            color: #667085;

            font-size: 10px;
        }

        .vehicle-price {
            margin-top: 9px;

            color: #101828;

            font-size: 14px;
            font-weight: 800;
        }

        .vehicle-vin {
            margin-top: 6px;

            color: #98a2b3;

            font-size: 8px;

            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }


        /* =========================================================
           QUICK ACTIONS
        ========================================================= */

        .quick-actions {
            padding: 15px;

            display: flex;
            flex-direction: column;

            gap: 8px;
        }

        .quick-action {
            min-height: 67px;

            padding: 11px;

            border: 1px solid #e0e4e9;
            border-radius: 8px;

            display: flex;
            align-items: center;

            gap: 11px;

            text-decoration: none;

            color: #101828;
        }

        .quick-action:hover {
            border-color: #ed1b2f;
        }

        .quick-action-icon {
            width: 36px;
            height: 36px;

            border-radius: 8px;

            background: #ffeaed;
            color: #ed1b2f;

            display: flex;
            align-items: center;
            justify-content: center;

            flex-shrink: 0;
        }

        .quick-action-icon svg {
            width: 17px;
            height: 17px;

            stroke: currentColor;
        }

        .quick-action-text {
            flex: 1;
            min-width: 0;
        }

        .quick-action-title {
            color: #101828;

            font-size: 10px;
            font-weight: 800;
        }

        .quick-action-description {
            margin-top: 4px;

            color: #98a2b3;

            font-size: 8px;
        }

        .quick-action-arrow {
            color: #98a2b3;

            font-size: 18px;
        }


        /* =========================================================
           NETWORK CARD
        ========================================================= */

        .network-card {
            margin-top: 18px;

            min-height: 178px;

            padding: 21px;

            border-radius: 10px;

            background: #080d15;

            color: #fff;
        }

        .network-label {
            color: #8390a2;

            font-size: 8px;
            font-weight: 700;

            letter-spacing: 1px;
            text-transform: uppercase;
        }

        .network-card h3 {
            margin: 9px 0 0;

            color: #fff;

            font-size: 19px;
            line-height: 1.15;
        }

        .network-card p {
            margin: 12px 0 17px;

            color: #9ca7b8;

            font-size: 9px;
            line-height: 1.55;
        }

        .network-button {
            height: 31px;

            padding: 0 12px;

            border: 1px solid #5b6575;
            border-radius: 6px;

            display: inline-flex;
            align-items: center;

            color: #fff;

            text-decoration: none;

            font-size: 9px;
            font-weight: 700;
        }


        /* =========================================================
           EMPTY STATE
        ========================================================= */

        .empty-state {
            padding: 80px 30px;

            text-align: center;
        }

        .empty-state h3 {
            margin: 0;

            color: #101828;

            font-size: 16px;
        }

        .empty-state p {
            margin: 8px 0 18px;

            color: #98a2b3;

            font-size: 11px;
        }


        /* =========================================================
           MOBILE BOTTOM NAV
        ========================================================= */

        .automall-mobile-nav {
            display: none;
        }


        /* =========================================================
           TABLET
        ========================================================= */

        @media (max-width: 1200px) {

            .dashboard-sidebar {
                width: 225px;
                min-width: 225px;
            }

            .dashboard-main {
                margin-left: 225px;
            }

            .dashboard-sidebar.collapsed {
                width: 76px;
                min-width: 76px;
            }

            .dashboard-sidebar.collapsed + .dashboard-main {
                margin-left: 76px;
            }

            .dashboard-content {
                padding-left: 30px;
                padding-right: 30px;
            }

            .dashboard-lower {
                grid-template-columns: minmax(0, 1fr) 285px;
            }
        }


        @media (max-width: 1000px) {

            .dashboard-lower {
                grid-template-columns: 1fr;
            }

            .network-card {
                margin-top: 0;
            }

            .dashboard-search {
                width: 330px;
            }
        }


        /* =========================================================
           MOBILE
        ========================================================= */

        @media (max-width: 760px) {

            .dashboard-sidebar {
                display: none;
            }

            .dashboard-main {
                margin-left: 0 !important;

                min-height: 100vh;
            }

            .dashboard-topbar {
                height: 64px;

                padding: 0 15px;

                position: sticky;
                top: 0;

                z-index: 900;
            }

            .dashboard-search {
                width: 100%;
                max-width: 280px;
            }

            .dashboard-search-suggestions {
                left: 50%;
                transform: translateX(-50%);
            }

            .dashboard-top-right {
                gap: 8px;
            }

            .top-profile-label {
                display: none;
            }

            .dashboard-content {
                padding: 25px 18px 105px;
            }

            .dashboard-heading-row {
                flex-direction: column;

                align-items: flex-start;

                gap: 17px;
            }

            .dashboard-stats {
                grid-template-columns: repeat(2, 1fr);
            }

            .automall-mobile-nav {
                position: fixed;

                left: 0;
                right: 0;
                bottom: 0;

                width: 100%;
                height: 72px;

                padding: 6px 8px;

                background: #080d15;

                border-top: 1px solid #1c222c;

                display: flex;

                align-items: center;
                justify-content: space-around;

                z-index: 2000;

                box-shadow: 0 -5px 20px rgba(0, 0, 0, 0.15);
            }

            .automall-mobile-nav a {
                min-width: 54px;
                height: 58px;

                padding: 6px 7px;

                border-radius: 8px;

                display: flex;

                flex-direction: column;

                align-items: center;
                justify-content: center;

                gap: 4px;

                color: #aeb6c3;

                text-decoration: none;

                font-size: 8px;
                font-weight: 600;
            }

            .automall-mobile-nav a.active {
                background: #ed1b2f;
                color: #fff;
            }

            .automall-mobile-nav svg {
                width: 19px;
                height: 19px;

                stroke: currentColor;
            }

            .automall-mobile-nav span {
                white-space: nowrap;
            }
        }


        /* =========================================================
           SMALL PHONES
        ========================================================= */

        @media (max-width: 560px) {

            .dashboard-search {
                max-width: 190px;
            }

            .dashboard-stats,
            .vehicle-listings {
                grid-template-columns: 1fr;
            }

            .heading-actions {
                width: 100%;
            }

            .heading-actions .dashboard-button {
                flex: 1;
            }

            .dashboard-content {
                padding-left: 14px;
                padding-right: 14px;
            }

            .dashboard-topbar {
                padding-left: 12px;
                padding-right: 12px;
            }

            .notification-button {
                width: 36px;
                height: 36px;
            }

            .top-profile-avatar {
                width: 36px;
                height: 36px;
            }

            .automall-mobile-nav a {
                min-width: 48px;
                padding-left: 4px;
                padding-right: 4px;
            }
        }

    </style>
</head>


<body>

<div class="automall-dashboard">

    <div class="dashboard-layout">


        {{-- =====================================================
             FIXED SIDEBAR
        ====================================================== --}}

        <aside
            class="dashboard-sidebar"
            id="automallSidebar"
        >

            <div class="sidebar-brand">

                <div class="sidebar-brand-icon">
                    A
                </div>

                <div class="sidebar-brand-details">

                    <div class="sidebar-brand-name">
                        AutoMall
                    </div>

                    <div class="sidebar-brand-tagline">
                        BUY. SELL. TRADE.
                    </div>

                </div>


                {{-- COLLAPSE BUTTON --}}

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
                        <path d="M15 18l-6-6 6-6"/>
                    </svg>

                </button>

            </div>


            <div class="sidebar-content">


                {{-- WORKSPACE --}}

                <div class="sidebar-label">
                    Workspace
                </div>


                <nav class="sidebar-nav">


                    {{-- DASHBOARD --}}

                    <a
                        href="{{ route('dashboard') }}"
                        class="active"
                    >

                        <span class="sidebar-icon">

                            <svg
                                viewBox="0 0 24 24"
                                fill="none"
                                stroke-width="1.7"
                            >
                                <rect x="4" y="4" width="6" height="6" rx="1"/>
                                <rect x="14" y="4" width="6" height="6" rx="1"/>
                                <rect x="4" y="14" width="6" height="6" rx="1"/>
                                <rect x="14" y="14" width="6" height="6" rx="1"/>
                            </svg>

                        </span>

                        <span>
                            Dashboard
                        </span>

                    </a>


                    {{-- MY VEHICLES --}}

                    <a href="{{ route('vehicles.index') }}">

                        <span class="sidebar-icon">

                            <svg
                                viewBox="0 0 24 24"
                                fill="none"
                                stroke-width="1.7"
                            >
                                <path d="M5 17h14"/>
                                <path d="M6 17l1-6h10l1 6"/>
                                <path d="M8 11l1.5-4h5L16 11"/>
                                <circle cx="8" cy="17.5" r="1.5"/>
                                <circle cx="16" cy="17.5" r="1.5"/>
                            </svg>

                        </span>

                        <span>
                            My Vehicles
                        </span>

                    </a>


                    {{-- ADD VEHICLE --}}

                    <a href="{{ route('vehicles.create') }}">

                        <span class="sidebar-icon">

                            <svg
                                viewBox="0 0 24 24"
                                fill="none"
                                stroke-width="1.7"
                            >
                                <path d="M12 5v14"/>
                                <path d="M5 12h14"/>
                            </svg>

                        </span>

                        <span>
                            Add Vehicle
                        </span>

                    </a>


                    {{-- MESSAGES --}}

                    <a href="{{ route('communication') }}">

                        <span class="sidebar-icon">

                            <svg
                                viewBox="0 0 24 24"
                                fill="none"
                                stroke-width="1.7"
                            >
                                <rect x="4" y="5" width="16" height="13" rx="2"/>
                                <path d="M8 18v2l4-2"/>
                                <path d="M8 9h8"/>
                                <path d="M8 12h5"/>
                            </svg>

                        </span>

                        <span>
                            Messages & Requests
                        </span>

                    </a>


                    {{-- VIN CHECK --}}

                    <a href="{{ route('vin.check') }}">

                        <span class="sidebar-icon">

                            <svg
                                viewBox="0 0 24 24"
                                fill="none"
                                stroke-width="1.7"
                            >
                                <rect x="4" y="3" width="16" height="18" rx="2"/>
                                <path d="M8 8h8"/>
                                <path d="M8 12h4"/>
                                <path d="m8 16 2 2 5-5"/>
                            </svg>

                        </span>

                        <span>
                            VIN Check
                        </span>

                    </a>

                </nav>


                {{-- ACCOUNT --}}

                <div class="sidebar-account-section">

                    <div class="sidebar-label">
                        Account
                    </div>


                    <nav class="sidebar-nav">


                        {{-- PROFILE --}}

                        <a href="{{ route('profile.edit') }}">

                            <span class="sidebar-icon">

                                <svg
                                    viewBox="0 0 24 24"
                                    fill="none"
                                    stroke-width="1.7"
                                >
                                    <circle cx="12" cy="8" r="3"/>
                                    <path d="M5 20c.7-4 2.9-6 7-6s6.3 2 7 6"/>
                                </svg>

                            </span>

                            <span>
                                Profile
                            </span>

                        </a>


                        {{-- SETTINGS --}}

                        <a href="{{ route('settings') }}">

                            <span class="sidebar-icon">

                                <svg
                                    viewBox="0 0 24 24"
                                    fill="none"
                                    stroke-width="1.7"
                                >
                                    <circle cx="12" cy="12" r="3"/>

                                    <path d="M19 12a7 7 0 0 0-.1-1.2l2-1.5-2-3.4-2.3.9a7 7 0 0 0-2-1.2L14.3 3h-4.6l-.4 2.6a7 7 0 0 0-2 1.2L5 5.9 3 9.3l2 1.5A7 7 0 0 0 5 12c0 .4 0 .8.1 1.2l-2 1.5 2 3.4 2.3-.9a7 7 0 0 0 2 1.2l.4 2.6h4.6l.4-2.6a7 7 0 0 0 2-1.2l2.3.9 2 3.4-2 1.5c.1-.4.1-.8.1-1.2z"/>
                                </svg>

                            </span>

                            <span>
                                Settings
                            </span>

                        </a>

                    </nav>

                </div>

            </div>


            {{-- DEALER ACCOUNT --}}

            <div class="sidebar-account">

                <div class="sidebar-account-avatar">

                    @if($dealer->logo)

                        <img
                            src="{{ asset('storage/' . $dealer->logo) }}"
                            alt="{{ $dealer->business_name }}"
                        >

                    @else

                        {{ strtoupper(substr($dealer->business_name, 0, 1)) }}

                    @endif

                </div>


                <div>

                    <div class="sidebar-account-name">
                        {{ $dealer->business_name }}
                    </div>

                    <div class="sidebar-account-role">
                        Dealer Account
                    </div>

                </div>

            </div>

        </aside>



        {{-- =====================================================
             MAIN CONTENT
        ====================================================== --}}

        <main class="dashboard-main">


            {{-- TOP BAR --}}

            <header class="dashboard-topbar">


                <form
                    class="dashboard-search"
                    method="GET"
                    action="{{ route('search') }}"
                    id="dashboardSearchForm"
                    autocomplete="off"
                >

                    <svg
                        viewBox="0 0 24 24"
                        fill="none"
                        stroke-width="1.8"
                        aria-hidden="true"
                    >
                        <circle cx="11" cy="11" r="6"/>
                        <path d="m16 16 4 4"/>
                    </svg>


                    <input
                        id="dashboardSearchInput"
                        type="search"
                        name="q"
                        placeholder="Search cars, dealers, or VIN..."
                        aria-label="Search AutoMall"
                        aria-autocomplete="list"
                        aria-controls="dashboardSearchSuggestions"
                    >

                    <div
                        id="dashboardSearchSuggestions"
                        class="dashboard-search-suggestions"
                        role="listbox"
                        aria-label="Search suggestions"
                    ></div>

                </form>


                <div class="dashboard-top-right">


                    <a 
                 href="{{ route('notifications.index') }}" 
                 class="notification-button"
                  aria-label="Notifications"
                   title="Notifications"
                      >

                        <svg
                            viewBox="0 0 24 24"
                            fill="none"
                            stroke-width="1.7"
                        >
                            <path d="M18 8a6 6 0 0 0-12 0c0 7-3 7-3 9h18c0-2-3-2-3-9"/>
                            <path d="M10 21h4"/>
                        </svg>

                        <span class="notification-dot"></span>

                    </a>


                    <a
                        href="{{ route('profile.edit') }}"
                        class="top-profile"
                    >

                        <div class="top-profile-avatar">

                            @if($dealer->logo)

                                <img
                                    src="{{ asset('storage/' . $dealer->logo) }}"
                                    alt="{{ $dealer->business_name }}"
                                >

                            @else

                                {{ strtoupper(substr($dealer->business_name, 0, 1)) }}

                            @endif

                        </div>

                        <span class="top-profile-label">
                            Dealer
                        </span>

                    </a>

                </div>

            </header>



            {{-- =================================================
                 DASHBOARD CONTENT
            ================================================== --}}

            <div class="dashboard-content">


                {{-- WELCOME --}}

                <div class="dashboard-heading-row">

                    <div class="dashboard-heading">

                        <div class="dashboard-eyebrow">
                            Dealer Workspace
                        </div>

                        <h1>
                            Welcome back,
                        </h1>

                        <p>
                            Manage your inventory and keep your dealership moving.
                        </p>

                    </div>


                    <div class="heading-actions">

                        <a
                            href="{{ route('vehicles.create') }}"
                            class="dashboard-button dashboard-button-red"
                        >
                            + &nbsp; Add Vehicle
                        </a>

                        <a
                            href="{{ route('vehicles.index') }}"
                            class="dashboard-button"
                        >
                            My Vehicles
                        </a>

                    </div>

                </div>



                {{-- =================================================
                     STATS
                ================================================== --}}

                <div class="dashboard-stats">


                    {{-- TOTAL --}}

                    <div class="stat-card">

                        <div class="stat-card-top">

                            <span class="stat-title">
                                Total Vehicles
                            </span>

                            <span class="stat-icon">

                                <svg
                                    viewBox="0 0 24 24"
                                    fill="none"
                                    stroke-width="1.7"
                                >
                                    <path d="M5 17h14"/>
                                    <path d="M6 17l1-6h10l1 6"/>
                                    <path d="M8 11l1.5-4h5L16 11"/>
                                    <circle cx="8" cy="17.5" r="1.5"/>
                                    <circle cx="16" cy="17.5" r="1.5"/>
                                </svg>

                            </span>

                        </div>

                        <div class="stat-number">
                            {{ $stats['total'] }}
                        </div>

                        <div class="stat-description">
                            All vehicles in your inventory
                        </div>

                    </div>


                    {{-- ACTIVE --}}

                    <div class="stat-card">

                        <div class="stat-card-top">

                            <span class="stat-title">
                                Active Listings
                            </span>

                            <span class="stat-icon">

                                <svg
                                    viewBox="0 0 24 24"
                                    fill="none"
                                    stroke-width="1.7"
                                >
                                    <circle cx="12" cy="12" r="8"/>
                                    <path d="m9 12 2 2 4-4"/>
                                </svg>

                            </span>

                        </div>

                        <div class="stat-number">
                            {{ $stats['active'] }}
                        </div>

                        <div class="stat-description">
                            Vehicles currently listed
                        </div>

                    </div>


                    {{-- SOLD --}}

                    <div class="stat-card">

                        <div class="stat-card-top">

                            <span class="stat-title">
                                Sold Vehicles
                            </span>

                            <span class="stat-icon">

                                <svg
                                    viewBox="0 0 24 24"
                                    fill="none"
                                    stroke-width="1.7"
                                >
                                    <path d="m6 12 4 4 8-8"/>
                                </svg>

                            </span>

                        </div>

                        <div class="stat-number">
                            {{ $stats['sold'] }}
                        </div>

                        <div class="stat-description">
                            Vehicles marked as sold
                        </div>

                    </div>


                    {{-- ARCHIVED --}}

                    <div class="stat-card">

                        <div class="stat-card-top">

                            <span class="stat-title">
                                Archived
                            </span>

                            <span class="stat-icon">

                                <svg
                                    viewBox="0 0 24 24"
                                    fill="none"
                                    stroke-width="1.7"
                                >
                                    <path d="M5 7h14v13H5z"/>
                                    <path d="M4 4h16v3H4z"/>
                                    <path d="M9 11h6"/>
                                </svg>

                            </span>

                        </div>

                        <div class="stat-number">
                            {{ $stats['archived'] }}
                        </div>

                        <div class="stat-description">
                            Vehicles kept in your archive
                        </div>

                    </div>

                </div>



                {{-- =================================================
                     LOWER CONTENT
                ================================================== --}}

                <div class="dashboard-lower">


                    {{-- RECENT LISTINGS --}}

                    <section class="dashboard-panel">

                        <div class="panel-header">

                            <div class="panel-title">
                                Recent Listings
                            </div>

                            <a
                                href="{{ route('vehicles.index') }}"
                                class="panel-link"
                            >
                                View all
                            </a>

                        </div>


                        @if($recentVehicles->count())

                            <div class="vehicle-listings">

                                @foreach($recentVehicles as $vehicle)

                                    @php
                                        $photo = $vehicle->media
                                            ->where('type', 'photo')
                                            ->first();
                                    @endphp


                                    <a
                                        href="{{ route('vehicles.show', $vehicle) }}"
                                        class="vehicle-card"
                                    >

                                        <div class="vehicle-image">

                                            @if($photo)

                                                <img
                                                    src="{{ asset('storage/' . $photo->file_path) }}"
                                                    alt="{{ $vehicle->year }} {{ $vehicle->make }} {{ $vehicle->model }}"
                                                >

                                            @else

                                                <div class="vehicle-no-image">
                                                    No vehicle photo
                                                </div>

                                            @endif


                                            <span class="vehicle-status {{ $vehicle->status }}">
                                                {{ $vehicle->status }}
                                            </span>

                                        </div>


                                        <div class="vehicle-details">

                                            <div class="vehicle-name">

                                                {{ $vehicle->year }}
                                                {{ $vehicle->make }}
                                                {{ $vehicle->model }}

                                            </div>


                                            <div class="vehicle-mileage">

                                                @if($vehicle->mileage !== null)

                                                    {{ number_format($vehicle->mileage) }} miles

                                                @else

                                                    Mileage not provided

                                                @endif

                                            </div>


                                            <div class="vehicle-price">

                                                @if($vehicle->price !== null)

                                                    ₦{{ number_format((float) $vehicle->price, 2) }}

                                                @else

                                                    Price on request

                                                @endif

                                            </div>


                                            <div class="vehicle-vin">
                                                VIN: {{ $vehicle->vin }}
                                            </div>

                                        </div>

                                    </a>

                                @endforeach

                            </div>

                        @else

                            <div class="empty-state">

                                <h3>
                                    No vehicles listed yet
                                </h3>

                                <p>
                                    Add your first vehicle to start building your inventory.
                                </p>

                                <a
                                    href="{{ route('vehicles.create') }}"
                                    class="dashboard-button dashboard-button-red"
                                >
                                    Add Vehicle
                                </a>

                            </div>

                        @endif

                    </section>



                    {{-- RIGHT SIDE --}}

                    <aside>


                        {{-- QUICK ACTIONS --}}

                        <div class="dashboard-panel">

                            <div class="panel-header">

                                <div class="panel-title">
                                    Quick Actions
                                </div>

                            </div>


                            <div class="quick-actions">


                                {{-- ADD VEHICLE --}}

                                <a
                                    href="{{ route('vehicles.create') }}"
                                    class="quick-action"
                                >

                                    <div class="quick-action-icon">

                                        <svg
                                            viewBox="0 0 24 24"
                                            fill="none"
                                            stroke-width="1.7"
                                        >
                                            <path d="M12 5v14"/>
                                            <path d="M5 12h14"/>
                                        </svg>

                                    </div>


                                    <div class="quick-action-text">

                                        <div class="quick-action-title">
                                            Add New Vehicle
                                        </div>

                                        <div class="quick-action-description">
                                            List a vehicle for sale
                                        </div>

                                    </div>


                                    <div class="quick-action-arrow">
                                        ›
                                    </div>

                                </a>


                                {{-- MANAGE INVENTORY --}}

                                <a
                                    href="{{ route('vehicles.index') }}"
                                    class="quick-action"
                                >

                                    <div class="quick-action-icon">

                                        <svg
                                            viewBox="0 0 24 24"
                                            fill="none"
                                            stroke-width="1.7"
                                        >
                                            <path d="M5 17h14"/>
                                            <path d="M6 17l1-6h10l1 6"/>
                                            <path d="M8 11l1.5-4h5L16 11"/>
                                            <circle cx="8" cy="17.5" r="1.5"/>
                                            <circle cx="16" cy="17.5" r="1.5"/>
                                        </svg>

                                    </div>


                                    <div class="quick-action-text">

                                        <div class="quick-action-title">
                                            Manage Inventory
                                        </div>

                                        <div class="quick-action-description">
                                            View and manage your vehicles
                                        </div>

                                    </div>


                                    <div class="quick-action-arrow">
                                        ›
                                    </div>

                                </a>


                                {{-- DEALER PROFILE --}}

                                <a
                                    href="{{ route('profile.edit') }}"
                                    class="quick-action"
                                >

                                    <div class="quick-action-icon">

                                        <svg
                                            viewBox="0 0 24 24"
                                            fill="none"
                                            stroke-width="1.7"
                                        >
                                            <circle cx="12" cy="8" r="3"/>
                                            <path d="M5 20c.7-4 2.9-6 7-6s6.3 2 7 6"/>
                                        </svg>

                                    </div>


                                    <div class="quick-action-text">

                                        <div class="quick-action-title">
                                            Dealer Profile
                                        </div>

                                        <div class="quick-action-description">
                                            Manage your dealership profile
                                        </div>

                                    </div>


                                    <div class="quick-action-arrow">
                                        ›
                                    </div>

                                </a>

                            </div>

                        </div>



                        {{-- NETWORK CARD --}}

                        <div class="network-card">

                            <div class="network-label">
                                AutoMall Dealer Network
                            </div>

                            <h3>
                                Your inventory.<br>
                                Your business.
                            </h3>

                            <p>
                                Keep your vehicles organized and ready for other dealers to discover.
                            </p>

                            <a
                                href="{{ route('vehicles.create') }}"
                                class="network-button"
                            >
                                List a Vehicle
                            </a>

                        </div>

                    </aside>

                </div>

            </div>

        </main>


        {{-- =====================================================
             MOBILE BOTTOM NAVIGATION
        ====================================================== --}}

        <nav class="automall-mobile-nav">


            {{-- DASHBOARD --}}

            <a
                href="{{ route('dashboard') }}"
                class="active"
            >

                <svg
                    viewBox="0 0 24 24"
                    fill="none"
                    stroke-width="1.7"
                >
                    <rect x="4" y="4" width="6" height="6" rx="1"/>
                    <rect x="14" y="4" width="6" height="6" rx="1"/>
                    <rect x="4" y="14" width="6" height="6" rx="1"/>
                    <rect x="14" y="14" width="6" height="6" rx="1"/>
                </svg>

                <span>
                    Dashboard
                </span>

            </a>

<!-- 
            {{-- VEHICLES --}}

            <a href="{{ route('vehicles.index') }}">

                <svg
                    viewBox="0 0 24 24"
                    fill="none"
                    stroke-width="1.7"
                >
                    <path d="M5 17h14"/>
                    <path d="M6 17l1-6h10l1 6"/>
                    <path d="M8 11l1.5-4h5L16 11"/>
                    <circle cx="8" cy="17.5" r="1.5"/>
                    <circle cx="16" cy="17.5" r="1.5"/>
                </svg>

                <span>
                    Vehicles
                </span>

            </a> -->


            {{-- ADD --}}

            <a href="{{ route('vehicles.create') }}">

                <svg
                    viewBox="0 0 24 24"
                    fill="none"
                    stroke-width="1.7"
                >
                    <path d="M12 5v14"/>
                    <path d="M5 12h14"/>
                </svg>

                <span>
                    Add
                </span>

            </a>


            {{-- MESSAGES --}}

            <a href="{{ route('communication') }}">

                <svg
                    viewBox="0 0 24 24"
                    fill="none"
                    stroke-width="1.7"
                >
                    <rect x="4" y="5" width="16" height="13" rx="2"/>
                    <path d="M8 18v2l4-2"/>
                    <path d="M8 9h8"/>
                    <path d="M8 12h5"/>
                </svg>

                <span>
                    Messages
                </span>

            </a>


            <!-- {{-- VIN --}}

            <a href="{{ route('vin.check') }}">

                <svg
                    viewBox="0 0 24 24"
                    fill="none"
                    stroke-width="1.7"
                >
                    <rect x="4" y="3" width="16" height="18" rx="2"/>
                    <path d="M8 8h8"/>
                    <path d="M8 12h4"/>
                    <path d="m8 16 2 2 5-5"/>
                </svg>

                <span>
                    VIN
                </span>

            </a> -->


            {{-- PROFILE --}}

            <a href="{{ route('profile.edit') }}">

                <svg
                    viewBox="0 0 24 24"
                    fill="none"
                    stroke-width="1.7"
                >
                    <circle cx="12" cy="8" r="3"/>
                    <path d="M5 20c.7-4 2.9-6 7-6s6.3 2 7 6"/>
                </svg>

                <span>
                    Profile
                </span>

            </a>

        </nav>

    </div>

</div>


<script>

document.addEventListener('DOMContentLoaded', function () {

    const form = document.getElementById('dashboardSearchForm');
    const input = document.getElementById('dashboardSearchInput');
    const suggestions = document.getElementById('dashboardSearchSuggestions');

    if (!form || !input || !suggestions) {
        return;
    }

    const suggestionsUrl = @json(route('search.suggestions'));
    const vinCheckUrl = @json(route('vin.check'));

    let debounceTimer = null;
    let activeController = null;
    let vinCheckController = null;

    function escapeHtml(value) {
        const div = document.createElement('div');
        div.textContent = value ?? '';
        return div.innerHTML;
    }

    function closeSuggestions() {
        suggestions.classList.remove('open');
        suggestions.innerHTML = '';
    }

    function isVin(value) {
        return /^[A-HJ-NPR-Z0-9]{17}$/i.test(String(value || '').replace(/\s+/g, ''));
    }

    function showVinError(message) {
        let toast = document.getElementById('automallSearchToast');

        if (!toast) {
            toast = document.createElement('div');
            toast.id = 'automallSearchToast';
            toast.style.position = 'fixed';
            toast.style.right = '20px';
            toast.style.bottom = '20px';
            toast.style.zIndex = '5000';
            toast.style.maxWidth = '360px';
            toast.style.padding = '13px 16px';
            toast.style.borderRadius = '10px';
            toast.style.background = '#111827';
            toast.style.color = '#fff';
            toast.style.boxShadow = '0 14px 35px rgba(0,0,0,.22)';
            toast.style.fontSize = '12px';
            toast.style.fontWeight = '700';
            toast.style.lineHeight = '1.45';
            document.body.appendChild(toast);
        }

        toast.textContent = message || 'Invalid VIN. Please check the VIN and try again.';
        toast.style.display = 'block';

        clearTimeout(toast._timer);
        toast._timer = setTimeout(function () {
            toast.style.display = 'none';
        }, 3500);
    }

    function openUrl(url) {
        if (!url) {
            return;
        }

        closeSuggestions();
        window.location.href = url;
    }

    async function validateAndOpenVin(rawVin) {
        const cleanVin = String(rawVin || '').trim().toUpperCase();

        if (!isVin(cleanVin)) {
            showVinError('Invalid VIN. Please check the VIN and try again.');
            return;
        }

        if (vinCheckController) {
            vinCheckController.abort();
        }

        vinCheckController = new AbortController();

        try {
            const url = new URL(suggestionsUrl, window.location.origin);
            url.searchParams.set('q', cleanVin);
            url.searchParams.set('check_vin', '1');

            const response = await fetch(url.toString(), {
                method: 'GET',
                headers: {
                    'Accept': 'application/json',
                    'X-Requested-With': 'XMLHttpRequest'
                },
                signal: vinCheckController.signal
            });

            if (!response.ok) {
                throw new Error('VIN validation failed.');
            }

            const data = await response.json();

            if (data.vin_valid === true) {
                const target = vinCheckUrl + (vinCheckUrl.includes('?') ? '&' : '?') + 'vin=' + encodeURIComponent(cleanVin);
                window.location.href = target;
                return;
            }

            showVinError('Invalid VIN. Please check the VIN and try again.');
        } catch (error) {
            if (error.name !== 'AbortError') {
                showVinError('We could not verify this VIN right now. Please try again.');
            }
        }
    }

    function renderSuggestions(data, query) {
        const dealers = Array.isArray(data.dealers) ? data.dealers : [];
        const vehicles = Array.isArray(data.vehicles) ? data.vehicles : [];
        const cleanQuery = String(query || '').trim();
        const vinLike = isVin(cleanQuery);

        let html = '';

        if (vehicles.length) {
            html += '<div class="search-suggestion-group">';
            html += '<div class="search-suggestion-label">Vehicles</div>';

            vehicles.forEach(function (vehicle) {
                const title = vehicle.title || 'Vehicle';
                const meta = [vehicle.dealer, vehicle.location].filter(Boolean).join(' · ');
                const url = vehicle.url || '';

                html += `
                    <button type="button" class="search-suggestion-item" data-action="open" data-url="${escapeHtml(url)}">
                        <span class="search-suggestion-icon red">C</span>
                        <span class="search-suggestion-copy">
                            <span class="search-suggestion-title">${escapeHtml(title)}</span>
                            <span class="search-suggestion-meta">${escapeHtml(meta || 'AutoMall vehicle')}</span>
                        </span>
                    </button>
                `;
            });

            html += '</div>';
        }

        if (dealers.length) {
            html += '<div class="search-suggestion-group">';
            html += '<div class="search-suggestion-label">Dealers</div>';

            dealers.forEach(function (dealer) {
                const location = dealer.location || 'Location not provided';
                const url = dealer.url || '';
                const isSelf = dealer.is_self === true;
                const meta = isSelf ? 'Your AutoMall dealer profile' : location;

                html += `
                    <button type="button" class="search-suggestion-item" data-action="open" data-url="${escapeHtml(url)}">
                        <span class="search-suggestion-icon">D</span>
                        <span class="search-suggestion-copy">
                            <span class="search-suggestion-title">${escapeHtml(dealer.name || 'Dealer')}</span>
                            <span class="search-suggestion-meta">${escapeHtml(meta)}</span>
                        </span>
                    </button>
                `;
            });

            html += '</div>';
        }

        if (vinLike) {
            html += `
                <div class="search-suggestion-group">
                    <div class="search-suggestion-label">VIN</div>
                    <button type="button" class="search-suggestion-item" data-action="vin" data-vin="${escapeHtml(cleanQuery)}">
                        <span class="search-suggestion-icon red">VIN</span>
                        <span class="search-suggestion-copy">
                            <span class="search-suggestion-title">Check this VIN</span>
                            <span class="search-suggestion-meta">Validate the 17-character VIN and open VIN Check</span>
                        </span>
                    </button>
                </div>
            `;
        }

        if (!html) {
            html = '<div class="search-suggestion-empty">No quick matches yet. Press Enter to search everything.</div>';
        }

        suggestions.innerHTML = html;
        suggestions.classList.add('open');
    }

    async function fetchSuggestions(query) {
        const cleanQuery = query.trim();

        if (cleanQuery.length < 2) {
            closeSuggestions();
            return;
        }

        if (activeController) {
            activeController.abort();
        }

        activeController = new AbortController();

        try {
            const url = new URL(suggestionsUrl, window.location.origin);
            url.searchParams.set('q', cleanQuery);

            const response = await fetch(url.toString(), {
                method: 'GET',
                headers: {
                    'Accept': 'application/json',
                    'X-Requested-With': 'XMLHttpRequest'
                },
                signal: activeController.signal
            });

            if (!response.ok) {
                throw new Error('Suggestion request failed.');
            }

            const data = await response.json();
            renderSuggestions(data, cleanQuery);
        } catch (error) {
            if (error.name !== 'AbortError') {
                renderSuggestions({ dealers: [], vehicles: [] }, cleanQuery);
            }
        }
    }

    form.addEventListener('submit', function (event) {
        const cleanQuery = input.value.trim();

        if (isVin(cleanQuery)) {
            event.preventDefault();
            closeSuggestions();
            validateAndOpenVin(cleanQuery);
        }
    });

    input.addEventListener('input', function () {
        clearTimeout(debounceTimer);

        const query = input.value;

        debounceTimer = setTimeout(function () {
            fetchSuggestions(query);
        }, 250);
    });

    input.addEventListener('focus', function () {
        if (input.value.trim().length >= 2) {
            fetchSuggestions(input.value);
        }
    });

    suggestions.addEventListener('click', function (event) {
        const target = event.target.closest('[data-action]');

        if (!target) {
            return;
        }

        const action = target.getAttribute('data-action');

        if (action === 'open') {
            openUrl(target.getAttribute('data-url') || '');
            return;
        }

        if (action === 'vin') {
            closeSuggestions();
            validateAndOpenVin(target.getAttribute('data-vin') || '');
        }
    });

    document.addEventListener('click', function (event) {
        if (!form.contains(event.target)) {
            closeSuggestions();
        }
    });

});

</script>


{{-- =========================================================
     SIDEBAR COLLAPSE JAVASCRIPT
========================================================= --}}

<script>

document.addEventListener('DOMContentLoaded', function () {

    const sidebar = document.getElementById('automallSidebar');
    const toggle = document.getElementById('sidebarToggle');

    if (!sidebar || !toggle) {
        return;
    }


    /*
     * Restore previous sidebar state.
     */

    const savedState = localStorage.getItem(
        'automall-sidebar-state'
    );


    if (savedState === 'collapsed') {

        sidebar.classList.add('collapsed');

        toggle.setAttribute(
            'aria-label',
            'Expand sidebar'
        );

        toggle.setAttribute(
            'title',
            'Expand sidebar'
        );

    }


    /*
     * Collapse / expand.
     */

    toggle.addEventListener('click', function (event) {

        event.preventDefault();
        event.stopPropagation();


        sidebar.classList.toggle('collapsed');


        const collapsed =
            sidebar.classList.contains('collapsed');


        localStorage.setItem(
            'automall-sidebar-state',
            collapsed
                ? 'collapsed'
                : 'expanded'
        );


        toggle.setAttribute(
            'aria-label',
            collapsed
                ? 'Expand sidebar'
                : 'Collapse sidebar'
        );


        toggle.setAttribute(
            'title',
            collapsed
                ? 'Expand sidebar'
                : 'Collapse sidebar'
        );

    });

});

</script>

</body>
</html>