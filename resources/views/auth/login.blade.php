<x-guest-layout>

    <style>
        html,
        body {
            margin: 0 !important;
            padding: 0 !important;
            width: 100% !important;
            min-width: 100% !important;
            height: 100% !important;
            min-height: 100% !important;
        }

        body {
            font-family: Arial, Helvetica, sans-serif;
            background: #ffffff !important;
        }

        body > div {
            width: 100% !important;
            min-height: 100vh !important;
        }

        .automall-auth {
            position: fixed;
            inset: 0;
            width: 100vw;
            height: 100vh;
            min-height: 100vh;
            display: flex;
            overflow: hidden;
            background: #ffffff;
        }

        .auth-showcase {
            width: 48%;
            height: 100vh;
            min-height: 100vh;
            background: #0b0b0b;
            color: #ffffff;
            padding: 55px;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            position: relative;
            overflow: hidden;
        }

        .auth-showcase::after {
            content: "";
            position: absolute;
            width: 420px;
            height: 420px;
            right: -180px;
            bottom: -180px;
            border: 70px solid #c90000;
            border-radius: 50%;
            opacity: 0.18;
        }

        .brand {
            position: relative;
            z-index: 2;
            font-size: 30px;
            font-weight: 900;
            letter-spacing: -1.5px;
        }

        .brand span {
            color: #d00000;
        }

        .showcase-content {
            position: relative;
            z-index: 2;
            max-width: 520px;
        }

        .showcase-label {
            display: inline-block;
            color: #d00000;
            font-size: 13px;
            font-weight: 800;
            letter-spacing: 1.5px;
            text-transform: uppercase;
            margin-bottom: 18px;
        }

        .showcase-content h1 {
            margin: 0 0 22px;
            font-size: clamp(42px, 5vw, 68px);
            line-height: 0.98;
            letter-spacing: -3px;
        }

        .showcase-content p {
            margin: 0;
            max-width: 460px;
            color: #bdbdbd;
            font-size: 17px;
            line-height: 1.7;
        }

        .showcase-points {
            position: relative;
            z-index: 2;
            display: grid;
            gap: 13px;
            margin-top: 40px;
        }

        .showcase-point {
            display: flex;
            align-items: center;
            gap: 13px;
            color: #dddddd;
            font-size: 14px;
        }

        .point-icon {
            width: 30px;
            height: 30px;
            border-radius: 50%;
            background: #d00000;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
        }

        .point-icon::after {
            content: "";
            width: 8px;
            height: 4px;
            border-left: 2px solid #ffffff;
            border-bottom: 2px solid #ffffff;
            transform: rotate(-45deg);
            margin-top: -3px;
        }

        .showcase-footer {
            position: relative;
            z-index: 2;
            color: #777777;
            font-size: 12px;
        }

        .auth-panel {
            width: 52%;
            height: 100vh;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 45px 35px;
            background: #ffffff;
            overflow-y: auto;
        }

        .login-card {
            width: 100%;
            max-width: 470px;
        }

        .mobile-brand {
            display: none;
            margin-bottom: 35px;
            font-size: 27px;
            font-weight: 900;
            letter-spacing: -1px;
        }

        .mobile-brand span {
            color: #d00000;
        }

        .login-header {
            margin-bottom: 32px;
        }

        .login-header h2 {
            margin: 0 0 9px;
            font-size: 34px;
            line-height: 1.15;
            letter-spacing: -1px;
            color: #111111;
        }

        .login-header p {
            margin: 0;
            color: #777777;
            font-size: 15px;
            line-height: 1.6;
        }

        .status-message {
            margin-bottom: 20px;
            padding: 13px 15px;
            border-radius: 8px;
            background: #f1f8f3;
            color: #176b37;
            font-size: 14px;
        }

        .field {
            margin-bottom: 21px;
        }

        .field label {
            display: block;
            margin-bottom: 8px;
            color: #222222;
            font-size: 14px;
            font-weight: 700;
        }

        .field input {
            width: 100%;
            height: 52px;
            padding: 0 15px;
            border: 1px solid #d8d8d8;
            border-radius: 8px;
            background: #ffffff;
            color: #111111;
            font-size: 15px;
            outline: none;
            transition: border-color 0.2s ease, box-shadow 0.2s ease;
        }

        .field input:focus {
            border-color: #c90000;
            box-shadow: 0 0 0 3px rgba(201, 0, 0, 0.08);
        }

        .field input::placeholder {
            color: #aaaaaa;
        }

        /* Password */
        .password-field {
            position: relative;
        }

        .password-field input {
            padding-right: 50px;
        }

        .password-toggle {
            position: absolute;
            right: 10px;
            top: 50%;
            transform: translateY(-50%);
            width: 34px;
            height: 34px;
            padding: 0;
            border: 0;
            background: transparent;
            color: #777777;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .password-toggle:hover {
            color: #c90000;
        }

        .password-toggle:focus {
            outline: none;
        }

        .password-toggle svg {
            width: 20px;
            height: 20px;
        }

        .field-error {
            margin-top: 7px;
            color: #c90000;
            font-size: 13px;
        }

        .login-options {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 15px;
            margin: 2px 0 25px;
        }

        .remember {
            display: flex;
            align-items: center;
            gap: 9px;
            color: #555555;
            font-size: 14px;
            cursor: pointer;
        }

        .remember input {
            width: 16px;
            height: 16px;
            accent-color: #c90000;
            cursor: pointer;
        }

        .forgot {
            color: #c90000;
            font-size: 14px;
            font-weight: 700;
            text-decoration: none;
        }

        .forgot:hover {
            text-decoration: underline;
        }

        .login-button {
            width: 100%;
            height: 53px;
            border: 0;
            border-radius: 8px;
            background: #c90000;
            color: #ffffff;
            font-size: 15px;
            font-weight: 800;
            cursor: pointer;
            transition: background 0.2s ease, transform 0.2s ease;
        }

        .login-button:hover {
            background: #a80000;
        }

        .login-button:active {
            transform: translateY(1px);
        }

        .register-section {
            margin-top: 28px;
            padding-top: 24px;
            border-top: 1px solid #e7e7e7;
            text-align: center;
            color: #777777;
            font-size: 14px;
        }

        .register-section a {
            color: #c90000;
            font-weight: 800;
            text-decoration: none;
        }

        .register-section a:hover {
            text-decoration: underline;
        }

        .security-note {
            margin-top: 22px;
            text-align: center;
            color: #999999;
            font-size: 12px;
        }

        @media (max-width: 900px) {

            .auth-showcase {
                width: 42%;
                padding: 40px 30px;
            }

            .auth-panel {
                width: 58%;
                padding: 40px 28px;
            }

            .showcase-content h1 {
                font-size: 48px;
            }
        }

        @media (max-width: 700px) {

            .automall-auth {
                position: relative;
                min-height: 100vh;
                height: auto;
                overflow: visible;
            }

            .auth-showcase {
                display: none;
            }

            .auth-panel {
                width: 100%;
                height: 100vh;
                min-height: 100vh;
                padding: 35px 22px;
                align-items: flex-start;
                overflow-y: auto;
            }

            .login-card {
                max-width: 500px;
                margin: 0 auto;
                padding-top: 15px;
            }

            .mobile-brand {
                display: block;
            }

            .login-header h2 {
                font-size: 30px;
            }
        }

        @media (max-width: 420px) {

            .auth-panel {
                padding: 28px 18px;
            }

            .mobile-brand {
                margin-bottom: 28px;
            }

            .login-options {
                align-items: flex-start;
                flex-direction: column;
                gap: 12px;
            }
        }
    </style>

    <div class="automall-auth">

        <section class="auth-showcase">

            <div class="brand">
                Auto<span>Mall</span>
            </div>

            <div class="showcase-content">

                <span class="showcase-label">
                    B2B Automotive Marketplace
                </span>

                <h1>
                    Your cars.<br>
                    Your network.<br>
                    One marketplace.
                </h1>

                <p>
                    Connect with dealers, manage your inventory and discover
                    vehicles through one professional automotive marketplace.
                </p>

                <div class="showcase-points">

                    <div class="showcase-point">
                        <span class="point-icon"></span>
                        <span>Manage your vehicle inventory</span>
                    </div>

                    <div class="showcase-point">
                        <span class="point-icon"></span>
                        <span>Connect with other dealers</span>
                    </div>

                    <div class="showcase-point">
                        <span class="point-icon"></span>
                        <span>Verify vehicles with VIN tools</span>
                    </div>

                </div>

            </div>

            <div class="showcase-footer">
                AutoMall B2B &copy; {{ date('Y') }}
            </div>

        </section>

        <main class="auth-panel">

            <div class="login-card">

                <div class="mobile-brand">
                    Auto<span>Mall</span>
                </div>

                <div class="login-header">
                    <h2>Welcome back</h2>
                    <p>Sign in to your AutoMall dealer account.</p>
                </div>

                @if (session('status'))
                    <div class="status-message">
                        {{ session('status') }}
                    </div>
                @endif

                <form method="POST" action="{{ route('login') }}">
                    @csrf

                    <div class="field">

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
                            autocomplete="username"
                            placeholder="Enter your email address"
                        >

                        @error('email')
                            <div class="field-error">
                                {{ $message }}
                            </div>
                        @enderror

                    </div>

                    <div class="field">

                        <label for="password">
                            Password
                        </label>

                        <div class="password-field">

                            <input
                                id="password"
                                type="password"
                                name="password"
                                required
                                autocomplete="current-password"
                                placeholder="Enter your password"
                            >

                            <button
                                type="button"
                                class="password-toggle"
                                data-password-toggle="password"
                                aria-label="Show password"
                                title="Show password"
                            >
                                <svg
                                    xmlns="http://www.w3.org/2000/svg"
                                    fill="none"
                                    viewBox="0 0 24 24"
                                    stroke="currentColor"
                                    stroke-width="2"
                                >
                                    <path
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        d="M2.458 12C3.732 7.943 7.523 5 12 5c4.477 0 8.268 2.943 9.542 7-1.274 4.057-5.065 7-9.542-7z"
                                    />

                                    <circle
                                        cx="12"
                                        cy="12"
                                        r="3"
                                    />
                                </svg>
                            </button>

                        </div>

                        @error('password')
                            <div class="field-error">
                                {{ $message }}
                            </div>
                        @enderror

                    </div>

                    <div class="login-options">

                        <label class="remember">

                            <input
                                type="checkbox"
                                name="remember"
                                id="remember_me"
                            >

                            <span>
                                Remember me
                            </span>

                        </label>

                        @if (Route::has('password.request'))

                            <a
                                class="forgot"
                                href="{{ route('password.request') }}"
                            >
                                Forgot password?
                            </a>

                        @endif

                    </div>

                    <button
                        type="submit"
                        class="login-button"
                    >
                        Sign In
                    </button>

                </form>

                @if (Route::has('register'))

                    <div class="register-section">

                        Don't have an AutoMall account?

                        <a href="{{ route('register') }}">
                            Create an account
                        </a>

                    </div>

                @endif

                <div class="security-note">
                    Secure dealer account access
                </div>

            </div>

        </main>

    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {

            document.querySelectorAll('[data-password-toggle]').forEach(function (button) {

                button.addEventListener('click', function () {

                    const inputId =
                        button.getAttribute('data-password-toggle');

                    const input =
                        document.getElementById(inputId);

                    if (!input) {
                        return;
                    }

                    if (input.type === 'password') {

                        input.type = 'text';

                        button.setAttribute(
                            'aria-label',
                            'Hide password'
                        );

                        button.setAttribute(
                            'title',
                            'Hide password'
                        );

                        button.innerHTML = `
                            <svg
                                xmlns="http://www.w3.org/2000/svg"
                                fill="none"
                                viewBox="0 0 24 24"
                                stroke="currentColor"
                                stroke-width="2"
                            >
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    d="M3.98 8.223A10.477 10.477 0 001.458 12C2.732 16.057 6.523 19 11 19c1.295 0 2.527-.248 3.646-.697"
                                />

                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    d="M6.228 6.228A10.45 10.45 0 0111 5c4.477 0 8.268 2.943 9.542 7a10.5 10.5 0 01-4.132 5.411"
                                />

                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    d="M3 3l18 18"
                                />
                            </svg>
                        `;

                    } else {

                        input.type = 'password';

                        button.setAttribute(
                            'aria-label',
                            'Show password'
                        );

                        button.setAttribute(
                            'title',
                            'Show password'
                        );

                        button.innerHTML = `
                            <svg
                                xmlns="http://www.w3.org/2000/svg"
                                fill="none"
                                viewBox="0 0 24 24"
                                stroke="currentColor"
                                stroke-width="2"
                            >
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    d="M2.458 12C3.732 7.943 7.523 5 12 5c4.477 0 8.268 2.943 9.542 7-1.274 4.057-5.065 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"
                                />

                                <circle
                                    cx="12"
                                    cy="12"
                                    r="3"
                                />
                            </svg>
                        `;
                    }

                });

            });

        });
    </script>

</x-guest-layout>