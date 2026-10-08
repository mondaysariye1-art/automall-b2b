<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Forgot Password | AutoMall</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        html,
        body {
            width: 100%;
            min-width: 100%;
            height: 100%;
            min-height: 100%;
            margin: 0;
            padding: 0;
        }

        html {
            background: #ffffff;
        }

        body {
            background: #ffffff;
            font-family: Arial, Helvetica, sans-serif;
        }

        *,
        *::before,
        *::after {
            box-sizing: border-box;
        }

        .automall-reset-page {
            position: fixed;
            inset: 0;
            width: 100vw;
            height: 100vh;
            min-height: 100vh;

            display: flex;

            overflow-y: auto;
            overflow-x: hidden;

            background: #ffffff;
        }

        /* LEFT SIDE */

        .reset-showcase {
            position: relative;

            width: 48%;
            min-width: 48%;
            height: 100vh;
            min-height: 100vh;

            padding: 55px;

            background: #0b0b0b;
            color: #ffffff;

            display: flex;
            flex-direction: column;
            justify-content: space-between;

            overflow: hidden;
        }

        .reset-showcase::after {
            content: "";

            position: absolute;

            width: 500px;
            height: 500px;

            right: -230px;
            bottom: -230px;

            border: 80px solid #d60000;
            border-radius: 50%;

            opacity: 0.15;
        }

        .automall-brand {
            position: relative;
            z-index: 2;

            font-size: 30px;
            font-weight: 900;
            letter-spacing: -1.5px;
        }

        .automall-brand span {
            color: #d60000;
        }

        .reset-showcase-content {
            position: relative;
            z-index: 2;

            max-width: 520px;
        }

        .reset-label {
            display: inline-block;

            margin-bottom: 18px;

            color: #d60000;

            font-size: 13px;
            font-weight: 800;
            letter-spacing: 1.5px;

            text-transform: uppercase;
        }

        .reset-showcase-content h1 {
            margin: 0 0 24px;

            font-size: clamp(44px, 5vw, 68px);
            line-height: 0.98;
            letter-spacing: -3px;
        }

        .reset-showcase-content p {
            margin: 0;

            max-width: 470px;

            color: #bdbdbd;

            font-size: 17px;
            line-height: 1.7;
        }

        .reset-showcase-footer {
            position: relative;
            z-index: 2;

            color: #777777;
            font-size: 12px;
        }

        /* RIGHT SIDE */

        .reset-panel {
            width: 52%;
            height: 100vh;
            min-height: 100vh;

            display: flex;
            align-items: center;
            justify-content: center;

            padding: 45px 60px;

            background: #ffffff;

            overflow-y: auto;
        }

        .reset-card {
            width: 100%;
            max-width: 470px;
        }

        .mobile-brand {
            display: none;

            margin-bottom: 35px;

            font-size: 28px;
            font-weight: 900;
            letter-spacing: -1px;
        }

        .mobile-brand span {
            color: #d60000;
        }

        .reset-header {
            margin-bottom: 30px;
        }

        .reset-header h2 {
            margin: 0 0 10px;

            color: #111111;

            font-size: 34px;
            line-height: 1.15;
            letter-spacing: -1px;
        }

        .reset-header p {
            margin: 0;

            color: #777777;

            font-size: 15px;
            line-height: 1.7;
        }

        .status-message {
            margin-bottom: 20px;

            padding: 14px 16px;

            border-radius: 8px;

            background: #f1f8f3;
            color: #176b37;

            font-size: 14px;
            line-height: 1.5;
        }

        .reset-field {
            margin-bottom: 22px;
        }

        .reset-field label {
            display: block;

            margin-bottom: 8px;

            color: #222222;

            font-size: 14px;
            font-weight: 700;
        }

        .reset-field input {
            width: 100%;
            height: 53px;

            padding: 0 15px;

            border: 1px solid #d8d8d8;
            border-radius: 8px;

            background: #ffffff;
            color: #111111;

            font-size: 15px;

            outline: none;

            transition:
                border-color 0.2s ease,
                box-shadow 0.2s ease;
        }

        .reset-field input:focus {
            border-color: #d60000;

            box-shadow:
                0 0 0 3px rgba(214, 0, 0, 0.08);
        }

        .reset-field input::placeholder {
            color: #aaaaaa;
        }

        .field-error {
            margin-top: 7px;

            color: #d60000;

            font-size: 13px;
        }

        .reset-button {
            width: 100%;
            height: 53px;

            border: 0;
            border-radius: 8px;

            background: #d60000;
            color: #ffffff;

            font-size: 15px;
            font-weight: 800;

            cursor: pointer;

            transition:
                background 0.2s ease,
                transform 0.2s ease;
        }

        .reset-button:hover {
            background: #b50000;
        }

        .reset-button:active {
            transform: translateY(1px);
        }

        .back-login {
            margin-top: 25px;

            text-align: center;

            color: #777777;

            font-size: 14px;
        }

        .back-login a {
            color: #d60000;

            font-weight: 800;

            text-decoration: none;
        }

        .back-login a:hover {
            text-decoration: underline;
        }

        .security-note {
            margin-top: 22px;

            text-align: center;

            color: #999999;

            font-size: 12px;
        }

        /* TABLET */

        @media (max-width: 900px) {

            .reset-showcase {
                width: 42%;
                min-width: 42%;

                padding: 40px 30px;
            }

            .reset-panel {
                width: 58%;

                padding: 40px 30px;
            }

            .reset-showcase-content h1 {
                font-size: 48px;
            }
        }

        /* MOBILE */

        @media (max-width: 700px) {

            .automall-reset-page {
                position: relative;

                width: 100%;
                min-height: 100vh;
                height: auto;

                display: block;

                overflow-y: auto;
            }

            .reset-showcase {
                display: none;
            }

            .reset-panel {
                width: 100%;
                height: auto;
                min-height: 100vh;

                padding: 35px 22px;

                display: flex;
                align-items: flex-start;
                justify-content: center;

                overflow: visible;
            }

            .reset-card {
                max-width: 500px;

                margin: 0 auto;

                padding-top: 15px;
            }

            .mobile-brand {
                display: block;
            }

            .reset-header h2 {
                font-size: 30px;
            }
        }

        @media (max-width: 420px) {

            .reset-panel {
                padding: 28px 18px;
            }

            .mobile-brand {
                margin-bottom: 28px;
            }
        }
    </style>
</head>

<body>

<div class="automall-reset-page">

    <!-- LEFT -->
    <section class="reset-showcase">

        <div class="automall-brand">
            Auto<span>Mall</span>
        </div>

        <div class="reset-showcase-content">

            <span class="reset-label">
                Secure Dealer Access
            </span>

            <h1>
                Get back<br>
                to your<br>
                marketplace.
            </h1>

            <p>
                Enter the email address connected to your AutoMall
                dealer account and we'll send you a secure password
                reset link.
            </p>

        </div>

        <div class="reset-showcase-footer">
            AutoMall B2B &copy; {{ date('Y') }}
        </div>

    </section>


    <!-- RIGHT -->
    <main class="reset-panel">

        <div class="reset-card">

            <div class="mobile-brand">
                Auto<span>Mall</span>
            </div>

            <div class="reset-header">

                <h2>
                    Forgot your password?
                </h2>

                <p>
                    No problem. Enter your email below and we'll send
                    you a secure link to choose a new password.
                </p>

            </div>


            @if (session('status'))

                <div class="status-message">
                    {{ session('status') }}
                </div>

            @endif


            <form
                method="POST"
                action="{{ route('password.email') }}"
            >

                @csrf

                <div class="reset-field">

                    <label for="email">
                        Email address
                    </label>

                    <input
                        id="email"
                        type="email"
                        name="email"
                        value="{{ old('email') }}"
                        required
                        autofocus
                        autocomplete="email"
                        placeholder="Enter your AutoMall email"
                    >

                    @error('email')

                        <div class="field-error">
                            {{ $message }}
                        </div>

                    @enderror

                </div>


                <button
                    type="submit"
                    class="reset-button"
                >
                    Send Password Reset Link
                </button>

            </form>


            <div class="back-login">

                Remember your password?

                <a href="{{ route('login') }}">
                    Back to Sign In
                </a>

            </div>


            <div class="security-note">
                Secure dealer account access
            </div>

        </div>

    </main>

</div>

</body>
</html>