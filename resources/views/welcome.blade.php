<!DOCTYPE html>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >


<title>AutoMall | B2B Vehicle Marketplace</title>

<meta
    name="description"
    content="AutoMall is a B2B vehicle marketplace built for professional dealers to buy, sell and manage vehicle inventory."
>

<style>
    * {
        box-sizing: border-box;
        margin: 0;
        padding: 0;
    }

    html {
        scroll-behavior: smooth;
    }

    body {
        font-family:
            Inter,
            ui-sans-serif,
            system-ui,
            -apple-system,
            BlinkMacSystemFont,
            "Segoe UI",
            sans-serif;

        background: #ffffff;
        color: #111111;
        line-height: 1.5;
    }

    a {
        text-decoration: none;
        color: inherit;
    }

    button,
    a {
        -webkit-tap-highlight-color: transparent;
    }


    /* ========================================================= */
    /* VARIABLES */
    /* ========================================================= */

    :root {
        --black: #090909;
        --black-soft: #111111;
        --dark: #171717;
        --red: #d71920;
        --red-dark: #b51218;
        --white: #ffffff;
        --gray-50: #fafafa;
        --gray-100: #f5f5f5;
        --gray-200: #e7e7e7;
        --gray-300: #d4d4d4;
        --gray-500: #737373;
        --gray-600: #525252;
        --max-width: 1240px;
    }


    /* ========================================================= */
    /* NAVBAR */
    /* ========================================================= */

    .navbar {
        position: sticky;
        top: 0;
        z-index: 1000;

        background: rgba(255,255,255,.94);
        backdrop-filter: blur(16px);

        border-bottom: 1px solid rgba(0,0,0,.08);
    }

    .nav-container {
        max-width: var(--max-width);
        margin: 0 auto;
        height: 76px;

        padding: 0 24px;

        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 30px;
    }

    .brand {
        display: flex;
        align-items: center;
        gap: 10px;
        font-weight: 900;
        font-size: 23px;
        letter-spacing: -1px;
    }

    .brand-mark {
        width: 34px;
        height: 34px;

        background: var(--red);
        color: white;

        border-radius: 9px;

        display: flex;
        align-items: center;
        justify-content: center;

        font-size: 17px;
        font-weight: 900;
    }

    .brand span {
        color: var(--black);
    }

    .brand strong {
        color: var(--red);
    }

    .nav-links {
        display: flex;
        align-items: center;
        gap: 28px;

        font-size: 14px;
        font-weight: 600;
        color: #404040;
    }

    .nav-links a {
        transition: color .2s ease;
    }

    .nav-links a:hover {
        color: var(--red);
    }

    .nav-actions {
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .login-button {
        padding: 10px 16px;
        font-size: 14px;
        font-weight: 700;
        color: #222;
    }

    .register-button {
        background: var(--black);
        color: white;

        padding: 11px 18px;

        border-radius: 8px;

        font-size: 14px;
        font-weight: 700;

        transition:
            background .2s ease,
            transform .2s ease;
    }

    .register-button:hover {
        background: var(--red);
        transform: translateY(-1px);
    }


    /* ========================================================= */
    /* HERO */
    /* ========================================================= */

    .hero {
        position: relative;
        overflow: hidden;

        background:
            radial-gradient(
                circle at 80% 20%,
                rgba(215,25,32,.14),
                transparent 30%
            ),
            linear-gradient(
                135deg,
                #ffffff 0%,
                #f7f7f7 55%,
                #eeeeee 100%
            );
    }

    .hero-container {
        max-width: var(--max-width);
        margin: 0 auto;

        min-height: 720px;

        padding: 80px 24px 90px;

        display: grid;
        grid-template-columns: .9fr 1.1fr;
        align-items: center;
        gap: 60px;
    }

    .eyebrow {
        display: inline-flex;
        align-items: center;
        gap: 8px;

        color: var(--red);

        font-size: 12px;
        font-weight: 800;

        letter-spacing: 1.5px;
        text-transform: uppercase;

        margin-bottom: 20px;
    }

    .eyebrow-line {
        width: 28px;
        height: 2px;
        background: var(--red);
    }

    .hero h1 {
        font-size: clamp(48px, 6vw, 76px);
        line-height: .98;
        letter-spacing: -4px;
        font-weight: 900;

        max-width: 650px;

        margin-bottom: 25px;
    }

    .hero h1 span {
        color: var(--red);
    }

    .hero-description {
        max-width: 570px;

        color: var(--gray-600);

        font-size: 18px;
        line-height: 1.7;

        margin-bottom: 32px;
    }

    .hero-buttons {
        display: flex;
        flex-wrap: wrap;
        gap: 12px;

        margin-bottom: 38px;
    }

    .primary-button {
        background: var(--red);
        color: white;

        padding: 14px 23px;

        border-radius: 9px;

        font-size: 15px;
        font-weight: 800;

        transition:
            background .2s ease,
            transform .2s ease;
    }

    .primary-button:hover {
        background: var(--red-dark);
        transform: translateY(-2px);
    }

    .secondary-button {
        background: white;
        color: #111;

        border: 1px solid #d5d5d5;

        padding: 14px 23px;

        border-radius: 9px;

        font-size: 15px;
        font-weight: 800;
    }

    .secondary-button:hover {
        border-color: #999;
        background: #fafafa;
    }

    .hero-trust {
        display: flex;
        flex-wrap: wrap;
        gap: 22px;

        color: #555;
        font-size: 13px;
        font-weight: 600;
    }

    .hero-trust-item {
        display: flex;
        align-items: center;
        gap: 7px;
    }

    .trust-dot {
        width: 7px;
        height: 7px;
        border-radius: 50%;
        background: var(--red);
    }


    /* ========================================================= */
    /* PRODUCT DEVICE MOCKUPS */
    /* ========================================================= */

    .product-preview {
        position: relative;

        min-height: 570px;

        display: flex;
        align-items: center;
        justify-content: center;
    }

    .laptop {
        width: min(700px, 100%);
        position: relative;
        z-index: 2;
    }

    .laptop-screen {
        background: #111;

        border: 8px solid #222;

        border-radius: 16px 16px 8px 8px;

        padding: 9px;

        box-shadow:
            0 35px 70px rgba(0,0,0,.23),
            0 10px 25px rgba(0,0,0,.12);
    }

    .screen-inner {
        overflow: hidden;

        background: #f5f5f5;

        border-radius: 7px;

        min-height: 360px;
    }

    .mock-topbar {
        height: 44px;

        background: white;

        border-bottom: 1px solid #ddd;

        display: flex;
        align-items: center;
        justify-content: space-between;

        padding: 0 14px;
    }

    .mock-logo {
        font-size: 13px;
        font-weight: 900;
    }

    .mock-logo span {
        color: var(--red);
    }

    .mock-search {
        width: 180px;
        height: 26px;

        background: #f2f2f2;

        border-radius: 5px;
    }

    .mock-body {
        display: grid;
        grid-template-columns: 135px 1fr;

        min-height: 315px;
    }

    .mock-sidebar {
        background: #111;
        padding: 18px 12px;
    }

    .mock-side-item {
        height: 27px;

        border-radius: 5px;

        margin-bottom: 8px;

        color: #aaa;

        font-size: 9px;

        display: flex;
        align-items: center;

        padding-left: 9px;
    }

    .mock-side-item.active {
        background: var(--red);
        color: white;
    }

    .mock-content {
        padding: 17px;
    }

    .mock-heading {
        font-size: 17px;
        font-weight: 900;

        margin-bottom: 12px;
    }

    .mock-cards {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 9px;
    }

    .mock-car {
        background: white;

        border-radius: 7px;

        overflow: hidden;

        border: 1px solid #ddd;
    }

    .mock-car-image {
        height: 80px;

        background:
            linear-gradient(
                135deg,
                #252525,
                #777
            );

        position: relative;
    }

    .mock-car-image.red-car {
        background:
            linear-gradient(
                135deg,
                #4d090d,
                #d71920
            );
    }

    .mock-car-image.gray-car {
        background:
            linear-gradient(
                135deg,
                #414141,
                #aaa
            );
    }

    .mock-car-info {
        padding: 8px;
    }

    .mock-car-title {
        height: 8px;
        width: 70%;

        background: #222;

        border-radius: 3px;

        margin-bottom: 6px;
    }

    .mock-car-price {
        height: 7px;
        width: 42%;

        background: var(--red);

        border-radius: 3px;
    }

    .mock-laptop-base {
        width: 110%;
        height: 17px;

        margin-left: -5%;

        background: linear-gradient(
            #aaa,
            #707070
        );

        border-radius: 0 0 20px 20px;

        box-shadow:
            0 13px 20px rgba(0,0,0,.15);
    }

    .phone {
        position: absolute;

        z-index: 4;

        width: 185px;
        height: 370px;

        right: -10px;
        bottom: 18px;

        background: #111;

        border: 6px solid #222;

        border-radius: 27px;

        padding: 7px;

        box-shadow:
            0 30px 55px rgba(0,0,0,.3);
    }

    .phone-screen {
        width: 100%;
        height: 100%;

        overflow: hidden;

        background: #f4f4f4;

        border-radius: 19px;
    }

    .phone-notch {
        width: 75px;
        height: 17px;

        background: #111;

        border-radius: 0 0 12px 12px;

        margin: 0 auto;
    }

    .phone-header {
        padding: 13px 12px 10px;

        font-size: 13px;
        font-weight: 900;
    }

    .phone-search {
        margin: 0 10px 12px;

        height: 30px;

        border-radius: 7px;

        background: white;

        border: 1px solid #ddd;
    }

    .phone-car {
        margin: 0 10px 9px;

        background: white;

        border-radius: 8px;

        overflow: hidden;

        border: 1px solid #ddd;
    }

    .phone-car-image {
        height: 105px;

        background:
            linear-gradient(
                135deg,
                #272727,
                #888
            );
    }

    .phone-car-details {
        padding: 8px;
    }

    .phone-line {
        height: 7px;

        background: #222;

        border-radius: 3px;

        width: 70%;

        margin-bottom: 6px;
    }

    .phone-line.red {
        background: var(--red);
        width: 40%;
    }


    /* ========================================================= */
    /* SECTION COMMON */
    /* ========================================================= */

    .section {
        padding: 100px 24px;
    }

    .section-container {
        max-width: var(--max-width);
        margin: 0 auto;
    }

    .section-label {
        color: var(--red);

        font-size: 12px;
        font-weight: 900;

        letter-spacing: 1.5px;
        text-transform: uppercase;

        margin-bottom: 12px;
    }

    .section-heading {
        max-width: 720px;

        font-size: clamp(34px, 4vw, 52px);
        line-height: 1.05;

        letter-spacing: -2px;

        font-weight: 900;

        margin-bottom: 18px;
    }

    .section-description {
        max-width: 650px;

        color: var(--gray-500);

        font-size: 17px;
        line-height: 1.7;

        margin-bottom: 50px;
    }


    /* ========================================================= */
    /* BUY / SELL */
    /* ========================================================= */

    .audience-section {
        background: #111;
        color: white;
    }

    .audience-grid {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 18px;
    }

    .audience-card {
        padding: 42px;

        border: 1px solid #303030;

        border-radius: 15px;

        background: #181818;

        position: relative;
        overflow: hidden;
    }

    .audience-card::after {
        content: "";

        position: absolute;

        width: 180px;
        height: 180px;

        right: -70px;
        bottom: -90px;

        border-radius: 50%;

        background: rgba(215,25,32,.15);
    }

    .audience-number {
        color: var(--red);

        font-size: 12px;
        font-weight: 900;

        letter-spacing: 1px;

        margin-bottom: 20px;
    }

    .audience-card h3 {
        font-size: 30px;

        letter-spacing: -1px;

        margin-bottom: 14px;
    }

    .audience-card p {
        color: #aaa;

        line-height: 1.7;

        margin-bottom: 25px;
    }

    .audience-link {
        color: white;

        font-size: 14px;
        font-weight: 800;
    }

    .audience-link span {
        color: var(--red);
        margin-left: 5px;
    }


    /* ========================================================= */
    /* FEATURES */
    /* ========================================================= */

    .features-grid {
        display: grid;

        grid-template-columns:
            repeat(3, 1fr);

        gap: 18px;
    }

    .feature-card {
        padding: 30px;

        border: 1px solid #e4e4e4;

        border-radius: 14px;

        background: white;

        transition:
            transform .2s ease,
            box-shadow .2s ease;
    }

    .feature-card:hover {
        transform: translateY(-4px);

        box-shadow:
            0 18px 35px rgba(0,0,0,.08);
    }

    .feature-icon {
        width: 45px;
        height: 45px;

        border-radius: 10px;

        background: #111;
        color: white;

        display: flex;
        align-items: center;
        justify-content: center;

        font-size: 15px;
        font-weight: 900;

        margin-bottom: 23px;
    }

    .feature-card h3 {
        font-size: 18px;
        margin-bottom: 9px;
    }

    .feature-card p {
        color: #666;
        font-size: 14px;
        line-height: 1.7;
    }


    /* ========================================================= */
    /* VIN SECTION */
    /* ========================================================= */

    .vin-section {
        background:
            linear-gradient(
                135deg,
                #f6f6f6,
                #ffffff
            );
    }

    .vin-layout {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 70px;
        align-items: center;
    }

    .vin-box {
        background: #111;

        border-radius: 16px;

        padding: 32px;

        color: white;

        box-shadow:
            0 25px 55px rgba(0,0,0,.15);
    }

    .vin-top {
        display: flex;
        justify-content: space-between;
        align-items: center;

        margin-bottom: 28px;
    }

    .vin-title {
        font-size: 14px;
        font-weight: 800;
    }

    .verified {
        background: #dcfce7;
        color: #166534;

        padding: 5px 9px;

        border-radius: 5px;

        font-size: 10px;
        font-weight: 900;
    }

    .vin-number {
        font-family: monospace;

        letter-spacing: 2px;

        font-size: clamp(17px, 2.5vw, 27px);

        margin-bottom: 30px;

        word-break: break-all;
    }

    .vin-lines {
        display: grid;
        gap: 10px;
    }

    .vin-line {
        display: flex;
        justify-content: space-between;

        padding: 12px 0;

        border-top: 1px solid #303030;

        font-size: 13px;
    }

    .vin-line span {
        color: #999;
    }

    .vin-line strong {
        color: white;
    }


    /* ========================================================= */
    /* HOW IT WORKS */
    /* ========================================================= */

    .steps {
        display: grid;

        grid-template-columns:
            repeat(4, 1fr);

        gap: 15px;
    }

    .step {
        position: relative;

        padding: 28px 20px;

        border-top: 2px solid #111;
    }

    .step-number {
        color: var(--red);

        font-size: 12px;
        font-weight: 900;

        margin-bottom: 22px;
    }

    .step h3 {
        font-size: 18px;

        margin-bottom: 10px;
    }

    .step p {
        color: #666;

        font-size: 14px;

        line-height: 1.7;
    }


    /* ========================================================= */
    /* MARKETPLACE CTA */
    /* ========================================================= */

    .marketplace-section {
        background: var(--red);

        color: white;

        overflow: hidden;
    }

    .marketplace-container {
        max-width: var(--max-width);

        margin: 0 auto;

        padding: 90px 24px;

        display: flex;
        justify-content: space-between;
        align-items: center;

        gap: 50px;
    }

    .marketplace-section .section-label {
        color: white;
        opacity: .8;
    }

    .marketplace-section h2 {
        max-width: 700px;

        font-size: clamp(36px, 5vw, 60px);

        line-height: 1;

        letter-spacing: -2.5px;

        margin-bottom: 18px;
    }

    .marketplace-section p {
        max-width: 600px;

        color: rgba(255,255,255,.82);

        font-size: 16px;
    }

    .white-button {
        background: white;
        color: #111;

        padding: 15px 24px;

        border-radius: 9px;

        font-size: 15px;
        font-weight: 900;

        white-space: nowrap;
    }

    .white-button:hover {
        background: #f2f2f2;
    }


    /* ========================================================= */
    /* FOOTER */
    /* ========================================================= */

    footer {
        background: #080808;
        color: white;

        padding: 65px 24px 30px;
    }

    .footer-container {
        max-width: var(--max-width);
        margin: 0 auto;
    }

    .footer-main {
        display: grid;

        grid-template-columns: 1.5fr 1fr 1fr 1fr;

        gap: 50px;

        padding-bottom: 55px;
    }

    .footer-brand p {
        color: #888;

        max-width: 330px;

        font-size: 14px;

        line-height: 1.7;

        margin-top: 16px;
    }

    .footer-column h4 {
        font-size: 13px;

        margin-bottom: 18px;

        color: white;
    }

    .footer-column a {
        display: block;

        color: #888;

        font-size: 13px;

        margin-bottom: 11px;
    }

    .footer-column a:hover {
        color: white;
    }

    .footer-bottom {
        border-top: 1px solid #242424;

        padding-top: 22px;

        display: flex;
        justify-content: space-between;

        gap: 20px;

        color: #666;

        font-size: 12px;
    }


    /* ========================================================= */
    /* MOBILE */
    /* ========================================================= */

    @media (max-width: 1000px) {

        .nav-links {
            display: none;
        }

        .hero-container {
            grid-template-columns: 1fr;

            padding-top: 65px;
        }

        .product-preview {
            min-height: 500px;
        }

        .vin-layout {
            grid-template-columns: 1fr;
        }

        .features-grid {
            grid-template-columns: repeat(2, 1fr);
        }

        .steps {
            grid-template-columns: repeat(2, 1fr);
        }

        .footer-main {
            grid-template-columns: repeat(2, 1fr);
        }
    }


    @media (max-width: 650px) {

        .nav-container {
            padding: 0 15px;
        }

        .brand {
            font-size: 20px;
        }

        .login-button {
            display: none;
        }

        .register-button {
            padding: 9px 13px;
        }

        .hero-container {
            padding:
                55px 18px
                60px;
        }

        .hero h1 {
            font-size: 48px;
            letter-spacing: -2.5px;
        }

        .hero-description {
            font-size: 16px;
        }

        .hero-trust {
            gap: 12px;
        }

        .product-preview {
            min-height: 360px;
        }

        .laptop {
            width: 100%;
        }

        .screen-inner {
            min-height: 210px;
        }

        .mock-body {
            grid-template-columns: 80px 1fr;
        }

        .mock-sidebar {
            padding: 10px 7px;
        }

        .mock-content {
            padding: 9px;
        }

        .mock-heading {
            font-size: 11px;
        }

        .mock-cards {
            gap: 5px;
        }

        .mock-car-image {
            height: 48px;
        }

        .mock-car-info {
            padding: 4px;
        }

        .mock-topbar {
            height: 30px;
        }

        .mock-search {
            width: 90px;
        }

        .phone {
            width: 115px;
            height: 235px;
            right: -3px;
            bottom: 0;
            border-width: 4px;
        }

        .phone-header {
            font-size: 9px;
            padding: 8px;
        }

        .phone-search {
            height: 19px;
            margin: 0 7px 7px;
        }

        .phone-car {
            margin: 0 7px 6px;
        }

        .phone-car-image {
            height: 62px;
        }

        .phone-car-details {
            padding: 5px;
        }

        .phone-line {
            height: 4px;
        }

        .section {
            padding: 70px 18px;
        }

        .audience-grid,
        .features-grid,
        .steps {
            grid-template-columns: 1fr;
        }

        .audience-card {
            padding: 30px;
        }

        .marketplace-container {
            padding: 70px 18px;

            flex-direction: column;
            align-items: flex-start;
        }

        .footer-main {
            grid-template-columns: 1fr;
            gap: 35px;
        }

        .footer-bottom {
            flex-direction: column;
        }
    }
</style>

</head>

<body>

{{-- ========================================================= --}}
{{-- NAVIGATION --}}
{{-- ========================================================= --}}

<header class="navbar">

    <div class="nav-container">

        <a href="{{ url('/') }}" class="brand">
            <div class="brand-mark">
                A
            </div>

            <span>
                Auto<strong>Mall</strong>
            </span>
        </a>


        <nav class="nav-links">
            <a href="#marketplace">
                Marketplace
            </a>

            <a href="#buyers">
                For Buyers
            </a>

            <a href="#sellers">
                For Sellers
            </a>

            <a href="#how-it-works">
                How It Works
            </a>

            <a href="#about">
                About
            </a>
        </nav>


        <div class="nav-actions">

            @auth
                <a
                    href="{{ route('dashboard') }}"
                    class="register-button"
                >
                    Dashboard
                </a>
            @else
                <a
                    href="{{ route('login') }}"
                    class="login-button"
                >
                    Log in
                </a>

                <a
                    href="{{ route('register') }}"
                    class="register-button"
                >
                    Join AutoMall
                </a>
            @endauth

        </div>

    </div>

</header>


{{-- ========================================================= --}}
{{-- HERO --}}
{{-- ========================================================= --}}

<main>

    <section class="hero">

        <div class="hero-container">

            <div class="hero-copy">

                <div class="eyebrow">
                    <span class="eyebrow-line"></span>
                    B2B VEHICLE MARKETPLACE
                </div>


                <h1>
                    The marketplace
                    <span>built for dealers.</span>
                </h1>


                <p class="hero-description">
                    AutoMall brings professional vehicle dealers together
                    in one platform to discover inventory, list vehicles,
                    verify VINs and build trusted business connections.
                </p>


                <div class="hero-buttons">

                    @auth

                        <a
                            href="{{ route('dashboard') }}"
                            class="primary-button"
                        >
                            Enter AutoMall
                        </a>

                        <a
                            href="{{ route('vehicles.index') }}"
                            class="secondary-button"
                        >
                            My Vehicles
                        </a>

                    @else

                        <a
                            href="{{ route('register') }}"
                            class="primary-button"
                        >
                            Join AutoMall
                        </a>

                        <a
                            href="{{ route('login') }}"
                            class="secondary-button"
                        >
                            I'm already a dealer
                        </a>

                    @endauth

                </div>


                <div class="hero-trust">

                    <div class="hero-trust-item">
                        <span class="trust-dot"></span>
                        Built for professional dealers
                    </div>

                    <div class="hero-trust-item">
                        <span class="trust-dot"></span>
                        VIN-focused listings
                    </div>
                     <div class="hero-trust-item">
                        <span class="trust-dot"></span>
                        VIN-Checks
                    </div>


                    <div class="hero-trust-item">
                        <span class="trust-dot"></span>
                        Built for African markets
                    </div>

                </div>

            </div>


            {{-- PRODUCT PREVIEW --}}

            <div class="product-preview">

                <div class="laptop">

                    <div class="laptop-screen">

                        <div class="screen-inner">

                            <div class="mock-topbar">

                                <div class="mock-logo">
                                    Auto<span>Mall</span>
                                </div>

                                <div class="mock-search"></div>

                            </div>


                            <div class="mock-body">

                                <div class="mock-sidebar">

                                    <div class="mock-side-item active">
                                        Marketplace
                                    </div>

                                    <div class="mock-side-item">
                                        My Vehicles
                                    </div>

                                    <div class="mock-side-item">
                                        Requests
                                    </div>

                                    <div class="mock-side-item">
                                        Messages
                                    </div>

                                    <div class="mock-side-item">
                                        Profile
                                    </div>

                                </div>


                                <div class="mock-content">

                                    <div class="mock-heading">
                                        Find your next vehicle
                                    </div>


                                    <div class="mock-cards">

                                        <div class="mock-car">

                                            <div class="mock-car-image red-car"></div>

                                            <div class="mock-car-info">

                                                <div class="mock-car-title"></div>

                                                <div class="mock-car-price"></div>

                                            </div>

                                        </div>


                                        <div class="mock-car">

                                            <div class="mock-car-image gray-car"></div>

                                            <div class="mock-car-info">

                                                <div class="mock-car-title"></div>

                                                <div class="mock-car-price"></div>

                                            </div>

                                        </div>


                                        <div class="mock-car">

                                            <div class="mock-car-image"></div>

                                            <div class="mock-car-info">

                                                <div class="mock-car-title"></div>

                                                <div class="mock-car-price"></div>

                                            </div>

                                        </div>


                                        <div class="mock-car">

                                            <div class="mock-car-image gray-car"></div>

                                            <div class="mock-car-info">

                                                <div class="mock-car-title"></div>

                                                <div class="mock-car-price"></div>

                                            </div>

                                        </div>


                                        <div class="mock-car">

                                            <div class="mock-car-image red-car"></div>

                                            <div class="mock-car-info">

                                                <div class="mock-car-title"></div>

                                                <div class="mock-car-price"></div>

                                            </div>

                                        </div>


                                        <div class="mock-car">

                                            <div class="mock-car-image"></div>

                                            <div class="mock-car-info">

                                                <div class="mock-car-title"></div>

                                                <div class="mock-car-price"></div>

                                            </div>

                                        </div>

                                    </div>

                                </div>

                            </div>

                        </div>

                    </div>

                    <div class="mock-laptop-base"></div>

                </div>


                {{-- PHONE --}}

                <div class="phone">

                    <div class="phone-screen">

                        <div class="phone-notch"></div>

                        <div class="phone-header">
                            Browse vehicles
                        </div>

                        <div class="phone-search"></div>


                        <div class="phone-car">

                            <div class="phone-car-image"></div>

                            <div class="phone-car-details">

                                <div class="phone-line"></div>
                                <div class="phone-line red"></div>

                            </div>

                        </div>


                        <div class="phone-car">

                            <div
                                class="phone-car-image"
                                style="background:linear-gradient(135deg,#50090d,#c91b22);"
                            ></div>

                            <div class="phone-car-details">

                                <div class="phone-line"></div>
                                <div class="phone-line red"></div>

                            </div>

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </section>


    {{-- ========================================================= --}}
    {{-- BUYERS / SELLERS --}}
    {{-- ========================================================= --}}

    <section class="section audience-section" id="marketplace">

        <div class="section-container">

            <div class="section-label">
                One platform. Two sides of the market.
            </div>

            <h2 class="section-heading">
                Everything dealers need to move vehicles.
            </h2>

            <p class="section-description">
                Whether you're looking for your next vehicle or moving
                inventory from your dealership, AutoMall gives you one
                place to manage the process.
            </p>


            <div class="audience-grid" id="buyers">

                <div class="audience-card">

                    <div class="audience-number">
                        FOR BUYERS
                    </div>

                    <h3>
                        Find the right inventory.
                    </h3>

                    <p>
                        Browse vehicles listed by dealers, inspect the
                        details, review available media and use VIN
                        information to make better-informed decisions.
                    </p>

                    <a
                        href="{{ route('register') }}"
                        class="audience-link"
                    >
                        Start sourcing vehicles
                        <span>→</span>
                    </a>

                </div>


                <div
                    class="audience-card"
                    id="sellers"
                >

                    <div class="audience-number">
                        FOR SELLERS
                    </div>

                    <h3>
                        Put your inventory in front of dealers.
                    </h3>

                    <p>
                        Create detailed listings, upload vehicle media,
                        manage your stock and connect your inventory
                        with professional buyers.
                    </p>

                    <a
                        href="{{ route('register') }}"
                        class="audience-link"
                    >
                        Start listing vehicles
                        <span>→</span>
                    </a>

                </div>

            </div>

        </div>

    </section>


    {{-- ========================================================= --}}
    {{-- FEATURES --}}
    {{-- ========================================================= --}}

    <section class="section">

        <div class="section-container">

            <div class="section-label">
                The AutoMall platform
            </div>

            <h2 class="section-heading">
                Built around the way dealers actually work.
            </h2>

            <p class="section-description">
                AutoMall is designed to make vehicle trading more
                organized, transparent and easier to manage.
            </p>


            <div class="features-grid">

                <div class="feature-card">

                    <div class="feature-icon">
                        VIN
                    </div>

                    <h3>
                        VIN-focused listings
                    </h3>

                    <p>
                        Capture the vehicle's VIN and validate its
                        structure and the history of the vehicle.Checking the  vin is also part of the listing
                        process.
                    </p>

                </div>

<!-- 
                <div class="feature-card">

                    <div class="feature-icon">
                        360
                    </div>

                    <h3>
                        Rich vehicle media
                    </h3>

                    <p>
                        Give buyers a better view of your inventory with
                        photos and video in a clean vehicle gallery.
                    </p>

                </div> -->


                <div class="feature-card">

                    <div class="feature-icon">
                        B2B
                    </div>

                    <h3>
                        Dealer-to-dealer
                    </h3>

                    <p>
                        Designed specifically for professional vehicle
                        trading rather than consumer classifieds.
                    </p>

                </div>


                <div class="feature-card">

                    <div class="feature-icon">
                        LIST
                    </div>

                    <h3>
                        Inventory management
                    </h3>

                    <p>
                        Keep track of active, sold and archived vehicles
                        without losing your historical inventory.
                    </p>

                </div>


                <div class="feature-card">

                    <div class="feature-icon">
                        MSG
                    </div>

                    <h3>
                        Dealer communication
                    </h3>

                    <p>
                        Build toward direct communication between buyers
                        and sellers around individual vehicles and deals.
                    </p>

                </div>


                <div class="feature-card">

                    <div class="feature-icon">
                        DATA
                    </div>

                    <h3>
                        Vehicle intelligence
                    </h3>

                    <p>
                        AutoMall is being built to connect vehicle
                        information, VIN data and future history services
                        in one place.
                    </p>

                </div>

            </div>

        </div>

    </section>


    {{-- ========================================================= --}}
    {{-- VIN / TRUST --}}
    {{-- ========================================================= --}}

    <section class="section vin-section">

        <div class="section-container vin-layout">

            <div>

                <div class="section-label">
                    Vehicle confidence
                </div>

                <h2 class="section-heading">
                    Know the vehicle before you make the deal.
                </h2>

                <p class="section-description">
                    AutoMall puts the VIN at the center of the vehicle
                    listing. Structural validation helps catch invalid
                    VIN formats before a vehicle enters the marketplace.
                </p>

                <p class="section-description">
                    Future AutoMall development will connect VINs with
                    deeper vehicle history information. A valid VIN is
                    not the same thing as a clean history—we keep those
                    concepts separate.
                </p>

            </div>


            <div class="vin-box">

                <div class="vin-top">

                    <div class="vin-title">
                        VEHICLE IDENTIFICATION
                    </div>

                    <div class="verified">
                        VALID VIN
                    </div>

                </div>


                <div class="vin-number">
                    1HGCM82633A004352
                </div>


                <div class="vin-lines">

                    <div class="vin-line">
                        <span>Vehicle</span>
                        <strong>Honda Accord</strong>
                    </div>

                    <div class="vin-line">
                        <span>Year</span>
                        <strong>2003</strong>
                    </div>

                    <div class="vin-line">
                        <span>VIN status</span>
                        <strong>Validated</strong>
                    </div>

                    <div class="vin-line">
                        <span>History</span>
                        <strong>Check separately</strong>
                    </div>

                </div>

            </div>

        </div>

    </section>


    {{-- ========================================================= --}}
    {{-- HOW IT WORKS --}}
    {{-- ========================================================= --}}

    <section
        class="section"
        id="how-it-works"
    >

        <div class="section-container">

            <div class="section-label">
                How AutoMall works
            </div>

            <h2 class="section-heading">
                From registration to completed deal.
            </h2>

            <p class="section-description">
                A simple workflow for dealers on both sides of the
                marketplace.
            </p>


            <div class="steps">

                <div class="step">

                    <div class="step-number">
                        01
                    </div>

                    <h3>
                        Join as a dealer
                    </h3>

                    <p>
                        Create your account and set up your dealership
                        profile.
                    </p>

                </div>


                <div class="step">

                    <div class="step-number">
                        02
                    </div>

                    <h3>
                        List or discover
                    </h3>

                    <p>
                        Add your vehicles or browse inventory listed by
                        other dealers.
                    </p>

                </div>


                <div class="step">

                    <div class="step-number">
                        03
                    </div>

                    <h3>
                        Review the vehicle
                    </h3>

                    <p>
                        Inspect the listing, VIN information, media,
                        specifications and dealer information.
                    </p>

                </div>


                <div class="step">

                    <div class="step-number">
                        04
                    </div>

                    <h3>
                        Connect and trade
                    </h3>

                    <p>
                        Move toward direct dealer communication,
                        requests and transactions through the platform.
                    </p>

                </div>

            </div>

        </div>

    </section>


    {{-- ========================================================= --}}
    {{-- FINAL CTA --}}
    {{-- ========================================================= --}}

    <section class="marketplace-section">

        <div class="marketplace-container">

            <div>

                <div class="section-label">
                    The dealer marketplace
                </div>

                <h2>
                    Your inventory.
                    Their demand.
                    One marketplace.
                </h2>

                <p>
                    Join AutoMall and build your dealership's digital
                    presence inside a B2B vehicle marketplace designed
                    for the African automotive industry.
                </p>

            </div>


            <div>

                @auth

                    <a
                        href="{{ route('dashboard') }}"
                        class="white-button"
                    >
                        Enter AutoMall →
                    </a>

                @else

                    <a
                        href="{{ route('register') }}"
                        class="white-button"
                    >
                        Join AutoMall →
                    </a>

                @endauth

            </div>

        </div>

    </section>

</main>


{{-- ========================================================= --}}
{{-- FOOTER --}}
{{-- ========================================================= --}}

<footer id="about">

    <div class="footer-container">

        <div class="footer-main">

            <div class="footer-brand">

                <a href="{{ url('/') }}" class="brand">

                    <div class="brand-mark">
                        A
                    </div>

                    <span style="color:white;">
                        Auto<strong>Mall</strong>
                    </span>

                </a>


                <p>
                    A B2B vehicle marketplace built to help professional
                    dealers buy, sell and manage vehicle inventory.
                </p>

            </div>


            <div class="footer-column">

                <h4>
                    Marketplace
                </h4>

                <a href="#marketplace">
                    Browse Vehicles
                </a>

                <a href="#buyers">
                    For Buyers
                </a>

                <a href="#sellers">
                    For Sellers
                </a>

                <a href="#how-it-works">
                    How It Works
                </a>

            </div>


            <div class="footer-column">

                <h4>
                    AutoMall
                </h4>

                <a href="#about">
                    About
                </a>

                <a href="#how-it-works">
                    How It Works
                </a>

                <a href="#">
                    Contact
                </a>

                <a href="#">
                    Help Center
                </a>

            </div>


            <div class="footer-column">

                <h4>
                    Account
                </h4>

                @auth

                    <a href="{{ route('dashboard') }}">
                        Dashboard
                    </a>

                    <a href="{{ route('vehicles.index') }}">
                        My Vehicles
                    </a>

                @else

                    <a href="{{ route('login') }}">
                        Log in
                    </a>

                    <a href="{{ route('register') }}">
                        Create account
                    </a>

                @endauth

            </div>

        </div>


        <div class="footer-bottom">

            <div>
                © {{ date('Y') }} AutoMall. All rights reserved.
            </div>

            <div>
                B2B Vehicle Marketplace
            </div>

        </div>

    </div>

</footer>

</body>
</html>
