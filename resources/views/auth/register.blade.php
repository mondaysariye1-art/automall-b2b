<!DOCTYPE html>

<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Join AutoMall</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            font-family: Arial, Helvetica, sans-serif;
            background: #f5f5f5;
            color: #111;
        }

        .register-page {
            min-height: 100vh;
            display: grid;
            grid-template-columns: 42% 58%;
        }

        .register-brand {
            background: #111;
            color: #fff;
            padding: 55px;
            display: flex;
            flex-direction: column;
            justify-content: center;
        }

        .brand-logo {
            display: flex;
            align-items: center;
            gap: 12px;
            margin-bottom: 55px;
        }

        .brand-mark {
            width: 48px;
            height: 48px;
            background: #d60000;
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 24px;
            font-weight: 900;
        }

        .brand-name {
            font-size: 28px;
            font-weight: 900;
        }

        .register-brand h1 {
            font-size: 48px;
            line-height: 1.05;
            margin: 0 0 20px;
            max-width: 520px;
        }

        .register-brand h1 span {
            color: #d60000;
        }

        .register-brand p {
            max-width: 480px;
            color: #bdbdbd;
            font-size: 17px;
            line-height: 1.7;
        }

        .brand-points {
            margin-top: 35px;
            display: grid;
            gap: 16px;
        }

        .brand-point {
            display: flex;
            gap: 12px;
            align-items: center;
            color: #ddd;
            font-size: 14px;
        }

        .point-mark {
            width: 9px;
            height: 9px;
            background: #d60000;
            border-radius: 50%;
            flex-shrink: 0;
        }

        .register-panel {
            padding: 45px 60px;
            display: flex;
            align-items: center;
            justify-content: center;
            overflow-y: auto;
        }

        .register-container {
            width: 100%;
            max-width: 650px;
        }

        .mobile-brand {
            display: none;
        }

        .register-heading {
            margin-bottom: 30px;
        }

        .register-heading h2 {
            margin: 0;
            font-size: 32px;
            font-weight: 800;
        }

        .register-heading p {
            margin: 8px 0 0;
            color: #666;
        }

        .form-section {
            margin-bottom: 30px;
        }

        .form-section-title {
            font-size: 17px;
            font-weight: 800;
            margin-bottom: 16px;
        }

        .form-grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 16px;
        }

        .form-group {
            display: flex;
            flex-direction: column;
        }

        .form-group.full {
            grid-column: 1 / -1;
        }

        .form-group label {
            font-size: 13px;
            font-weight: 700;
            margin-bottom: 7px;
            color: #333;
        }

        .form-group input,
        .form-group select {
            width: 100%;
            padding: 13px 14px;
            border: 1px solid #d4d4d4;
            border-radius: 8px;
            background: #fff;
            color: #111;
            font-size: 14px;
        }

        .form-group input:focus,
        .form-group select:focus {
            outline: none;
            border-color: #d60000;
            box-shadow: 0 0 0 2px rgba(214, 0, 0, .08);
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
            color: #777;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .password-toggle:hover {
            color: #d60000;
        }

        .password-toggle:focus {
            outline: none;
        }

        .password-toggle svg {
            width: 20px;
            height: 20px;
        }

        .error {
            color: #d60000;
            font-size: 12px;
            margin-top: 5px;
        }

        .terms {
            display: flex;
            gap: 9px;
            align-items: flex-start;
            margin: 20px 0;
            color: #666;
            font-size: 13px;
            line-height: 1.5;
        }

        .terms input {
            margin-top: 3px;
            accent-color: #d60000;
        }

        .terms a {
            color: #d60000;
            text-decoration: none;
            font-weight: 700;
        }

        .terms a:hover {
            text-decoration: underline;
        }

        .register-button {
            width: 100%;
            border: none;
            background: #d60000;
            color: #fff;
            padding: 15px;
            border-radius: 8px;
            font-size: 15px;
            font-weight: 800;
            cursor: pointer;
        }

        .register-button:hover {
            background: #b50000;
        }

        .login-link {
            text-align: center;
            margin-top: 20px;
            color: #666;
            font-size: 14px;
        }

        .login-link a {
            color: #d60000;
            font-weight: 800;
            text-decoration: none;
        }

        .login-link a:hover {
            text-decoration: underline;
        }

        @media (max-width: 900px) {
            .register-page {
                display: block;
            }

            .register-brand {
                display: none;
            }

            .register-panel {
                min-height: 100vh;
                padding: 35px 22px;
            }

            .mobile-brand {
                display: flex;
                align-items: center;
                gap: 10px;
                margin-bottom: 35px;
            }

            .mobile-brand .brand-mark {
                width: 40px;
                height: 40px;
                font-size: 19px;
            }

            .mobile-brand .brand-name {
                font-size: 23px;
            }
        }

        @media (max-width: 600px) {
            .form-grid {
                grid-template-columns: 1fr;
            }

            .form-group.full {
                grid-column: auto;
            }

            .register-heading h2 {
                font-size: 27px;
            }
        }
    </style>
</head>

<body>

<div class="register-page">

    <div class="register-brand">

        <div class="brand-logo">
            <div class="brand-mark">A</div>
            <div class="brand-name">AutoMall</div>
        </div>

        <h1>
            Join the <span>AutoMall</span> marketplace.
        </h1>

        <p>
            Create your dealer account and connect with automotive businesses
            across Nigeria.
        </p>

        <div class="brand-points">

            <div class="brand-point">
                <span class="point-mark"></span>
                List and manage your vehicles
            </div>

            <div class="brand-point">
                <span class="point-mark"></span>
                Connect with other dealers
            </div>

            <div class="brand-point">
                <span class="point-mark"></span>
                Discover vehicles across Nigeria
            </div>

            <div class="brand-point">
                <span class="point-mark"></span>
                Post vehicle requests
            </div>

        </div>

    </div>

    <div class="register-panel">

        <div class="register-container">

            <div class="mobile-brand">
                <div class="brand-mark">A</div>
                <div class="brand-name">AutoMall</div>
            </div>

            <div class="register-heading">
                <h2>Create your account</h2>
                <p>Set up your AutoMall dealer account.</p>
            </div>

            <form method="POST" action="{{ route('register') }}">
                @csrf

                <div class="form-section">

                    <div class="form-section-title">
                        Personal Information
                    </div>

                    <div class="form-grid">

                        <div class="form-group full">
                            <label for="name">Full Name</label>

                            <input
                                id="name"
                                name="name"
                                type="text"
                                value="{{ old('name') }}"
                                required
                                autofocus
                                autocomplete="name"
                                placeholder="Your full name"
                            >

                            @error('name')
                                <div class="error">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="email">Email Address</label>

                            <input
                                id="email"
                                name="email"
                                type="email"
                                value="{{ old('email') }}"
                                required
                                autocomplete="username"
                                placeholder="you@example.com"
                            >

                            @error('email')
                                <div class="error">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="phone">Phone Number</label>

                            <input
                                id="phone"
                                name="phone"
                                type="tel"
                                value="{{ old('phone') }}"
                                required
                                autocomplete="tel"
                                placeholder="+234..."
                            >

                            @error('phone')
                                <div class="error">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">

                            <label for="password">
                                Password
                            </label>

                            <div class="password-field">

                                <input
                                    id="password"
                                    name="password"
                                    type="password"
                                    required
                                    autocomplete="new-password"
                                    placeholder="Create a password"
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
                                            d="M2.458 12C3.732 7.943 7.523 5 12 5c4.477 0 8.268 2.943 9.542 7-1.274 4.057-5.065 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"
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
                                <div class="error">{{ $message }}</div>
                            @enderror

                        </div>

                        <div class="form-group">

                            <label for="password_confirmation">
                                Confirm Password
                            </label>

                            <div class="password-field">

                                <input
                                    id="password_confirmation"
                                    name="password_confirmation"
                                    type="password"
                                    required
                                    autocomplete="new-password"
                                    placeholder="Confirm your password"
                                >

                                <button
                                    type="button"
                                    class="password-toggle"
                                    data-password-toggle="password_confirmation"
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
                                            d="M2.458 12C3.732 7.943 7.523 5 12 5c4.477 0 8.268 2.943 9.542 7-1.274 4.057-5.065 7-9.542 7-4.477 0-8.268 2.943-9.542 7-4.477 0-8.268-2.943-9.542-7z"
                                        />
                                        <circle
                                            cx="12"
                                            cy="12"
                                            r="3"
                                        />
                                    </svg>
                                </button>

                            </div>

                            @error('password_confirmation')
                                <div class="error">{{ $message }}</div>
                            @enderror

                        </div>

                    </div>

                </div>

                <div class="form-section">

                    <div class="form-section-title">
                        Dealership Information
                    </div>

                    <div class="form-grid">

                        <div class="form-group full">
                            <label for="business_name">
                                Dealership Name
                            </label>

                            <input
                                id="business_name"
                                name="business_name"
                                type="text"
                                value="{{ old('business_name') }}"
                                required
                                placeholder="Your dealership name"
                            >

                            @error('business_name')
                                <div class="error">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="business_phone">
                                Dealership Phone
                            </label>

                            <input
                                id="business_phone"
                                name="business_phone"
                                type="tel"
                                value="{{ old('business_phone') }}"
                                required
                                placeholder="+234..."
                            >

                            @error('business_phone')
                                <div class="error">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="city">City</label>

                            <input
                                id="city"
                                name="city"
                                type="text"
                                value="{{ old('city') }}"
                                required
                                placeholder="e.g. Abuja"
                            >

                            @error('city')
                                <div class="error">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="state">State</label>

                            <select
                                id="state"
                                name="state"
                                required
                            >
                                <option value="">Select state</option>

                                @foreach([
                                    'Abia',
                                    'Adamawa',
                                    'Akwa Ibom',
                                    'Anambra',
                                    'Bauchi',
                                    'Bayelsa',
                                    'Benue',
                                    'Borno',
                                    'Cross River',
                                    'Delta',
                                    'Ebonyi',
                                    'Edo',
                                    'Ekiti',
                                    'Enugu',
                                    'Gombe',
                                    'Imo',
                                    'Jigawa',
                                    'Kaduna',
                                    'Kano',
                                    'Katsina',
                                    'Kebbi',
                                    'Kogi',
                                    'Kwara',
                                    'Lagos',
                                    'Nasarawa',
                                    'Niger',
                                    'Ogun',
                                    'Ondo',
                                    'Osun',
                                    'Oyo',
                                    'Plateau',
                                    'Rivers',
                                    'Sokoto',
                                    'Taraba',
                                    'Yobe',
                                    'Zamfara',
                                    'FCT'
                                ] as $state)

                                    <option
                                        value="{{ $state }}"
                                        {{ old('state') === $state ? 'selected' : '' }}
                                    >
                                        {{ $state }}
                                    </option>

                                @endforeach

                            </select>

                            @error('state')
                                <div class="error">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group full">

                            <label for="address">
                                Dealership Address
                            </label>

                            <input
                                id="address"
                                name="address"
                                type="text"
                                value="{{ old('address') }}"
                                required
                                placeholder="Dealership address"
                            >

                            @error('address')
                                <div class="error">{{ $message }}</div>
                            @enderror

                        </div>

                    </div>

                </div>

                <div class="terms">

                    <input
                        id="terms"
                        name="terms"
                        type="checkbox"
                        value="1"
                        required
                    >

                    <label for="terms">
                        I agree to the AutoMall

                        <a
                            href="{{ route('terms') }}"
                            target="_blank"
                        >
                            Terms & Conditions
                        </a>

                        and understand that dealership verification may be
                        required.
                    </label>

                </div>

                @error('terms')
                    <div
                        class="error"
                        style="margin-top:-12px;margin-bottom:15px;"
                    >
                        {{ $message }}
                    </div>
                @enderror

                <button
                    type="submit"
                    class="register-button"
                >
                    Create AutoMall Account
                </button>

                <div class="login-link">
                    Already have an account?

                    <a href="{{ route('login') }}">
                        Sign in
                    </a>
                </div>

            </form>

        </div>

    </div>

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

</body>
</html>