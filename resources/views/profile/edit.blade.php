<x-app-layout>
    <style>
        .profile-page {
            min-height: calc(100vh - 65px);
            background: #f5f5f5;
            padding: 35px;
        }

    .profile-container {
        max-width: 1100px;
        margin: 0 auto;
    }

    .profile-header {
        margin-bottom: 30px;
    }

    .profile-header h1 {
        margin: 0 0 7px;
        color: #111;
        font-size: 32px;
        font-weight: 800;
    }

    .profile-header p {
        margin: 0;
        color: #777;
        font-size: 15px;
    }

    .profile-grid {
        display: grid;
        grid-template-columns: 280px 1fr;
        gap: 25px;
    }

    .profile-card,
    .form-card,
    .account-card {
        background: #fff;
        border: 1px solid #e5e5e5;
        border-radius: 12px;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.04);
    }

    .profile-card {
        padding: 28px;
        height: fit-content;
    }

    .profile-avatar {
        width: 82px;
        height: 82px;
        border-radius: 50%;
        background: #111;
        color: #fff;
        display: flex;
        align-items: center;
        justify-content: center;
        margin-bottom: 18px;
        font-size: 28px;
        font-weight: 800;
    }

    .profile-card h2 {
        margin: 0 0 5px;
        color: #111;
        font-size: 20px;
    }

    .profile-email {
        margin: 0 0 22px;
        color: #777;
        font-size: 13px;
        word-break: break-word;
    }

    .dealer-status {
        padding: 13px;
        border-radius: 8px;
        background: #f7f7f7;
    }

    .dealer-status-label {
        display: block;
        margin-bottom: 6px;
        color: #888;
        font-size: 11px;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: .7px;
    }

    .status-badge {
        display: inline-block;
        padding: 5px 9px;
        border-radius: 5px;
        background: #fff1f1;
        color: #c00000;
        font-size: 12px;
        font-weight: 800;
        text-transform: capitalize;
    }

    .form-card {
        padding: 32px;
    }

    .form-section {
        margin-bottom: 35px;
    }

    .section-title {
        margin-bottom: 20px;
        padding-bottom: 13px;
        border-bottom: 1px solid #e8e8e8;
    }

    .section-title h2 {
        margin: 0 0 5px;
        color: #111;
        font-size: 19px;
        font-weight: 800;
    }

    .section-title p {
        margin: 0;
        color: #888;
        font-size: 13px;
    }

    .form-grid {
        display: grid;
        grid-template-columns: repeat(2, minmax(0, 1fr));
        gap: 20px;
    }

    .form-group.full {
        grid-column: 1 / -1;
    }

    .form-group label {
        display: block;
        margin-bottom: 8px;
        color: #222;
        font-size: 13px;
        font-weight: 700;
    }

    .form-group input,
    .form-group textarea {
        width: 100%;
        box-sizing: border-box;
        border: 1px solid #d8d8d8;
        border-radius: 7px;
        padding: 12px 13px;
        background: #fff;
        color: #111;
        font-size: 14px;
        outline: none;
    }

    .form-group input {
        height: 47px;
    }

    .form-group textarea {
        min-height: 120px;
        resize: vertical;
    }

    .form-group input:focus,
    .form-group textarea:focus {
        border-color: #c90000;
        box-shadow: 0 0 0 3px rgba(201, 0, 0, .07);
    }

    .field-error {
        min-height: 18px;
        margin-top: 6px;
        color: #c00000;
        font-size: 12px;
    }

    .success-message {
        margin-bottom: 25px;
        padding: 13px 15px;
        border-radius: 8px;
        background: #eef8f1;
        color: #176b37;
        font-size: 14px;
        font-weight: 600;
    }

    .form-actions {
        margin-top: 30px;
        padding-top: 22px;
        border-top: 1px solid #e8e8e8;
        display: flex;
        justify-content: flex-end;
        gap: 12px;
    }

    .btn {
        min-width: 130px;
        height: 45px;
        padding: 0 20px;
        border-radius: 7px;
        font-size: 13px;
        font-weight: 800;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        box-sizing: border-box;
    }

    .btn-secondary {
        border: 1px solid #d5d5d5;
        background: #fff;
        color: #333;
    }

    .btn-primary {
        border: 0;
        background: #c90000;
        color: #fff;
    }

    .btn-primary:hover {
        background: #a80000;
    }

    .account-card {
        margin-top: 25px;
        padding: 25px;
    }

    .account-card h3 {
        margin: 0 0 6px;
        color: #111;
        font-size: 17px;
    }

    .account-card p {
        margin: 0 0 18px;
        color: #777;
        font-size: 13px;
        line-height: 1.6;
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

    @media (max-width: 850px) {
        .profile-grid {
            grid-template-columns: 1fr;
        }

        .profile-card {
            display: flex;
            align-items: center;
            gap: 20px;
        }

        .profile-avatar {
            margin-bottom: 0;
            flex-shrink: 0;
        }

        .profile-email {
            margin-bottom: 10px;
        }
    }

    @media (max-width: 650px) {
        .profile-page {
            padding: 22px 15px;
        }

        .form-card {
            padding: 22px;
        }

        .form-grid {
            grid-template-columns: 1fr;
        }

        .form-group.full {
            grid-column: auto;
        }

        .profile-card {
            display: block;
        }

        .profile-avatar {
            margin-bottom: 18px;
        }

        .form-actions {
            flex-direction: column-reverse;
        }

        .btn {
            width: 100%;
        }
    }
</style>

<div class="profile-page">
    <div class="profile-container">

        <div class="profile-header">
            <h1>My Profile</h1>
            <p>Manage your personal and dealership information.</p>
        </div>

        {{ session('status') === 'profile-updated' ? '' : '' }}

        @php
            $dealerName = $dealer->business_name ?? '';
            $dealerPhone = $dealer->phone ?? '';
            $dealerDescription = $dealer->description ?? '';
            $dealerAddress = $dealer->address ?? '';
            $dealerCity = $dealer->city ?? '';
            $dealerState = $dealer->state ?? '';
            $dealerCountry = $dealer->country ?? 'Nigeria';
            $dealerStatus = $dealer->verification_status ?? 'pending';
            $initial = strtoupper(substr($user->name ?? 'U', 0, 1));
        @endphp

        @if (session('status') === 'profile-updated')
            <div class="success-message">
                Your profile has been updated successfully.
            </div>
        @endif

        <div class="profile-grid">

            <aside class="profile-card">

                <div class="profile-avatar">
                    {{ $initial }}
                </div>

                <div>
                    <h2>{{ $user->name }}</h2>

                    <p class="profile-email">
                        {{ $user->email }}
                    </p>

                    <div class="dealer-status">
                        <span class="dealer-status-label">
                            Dealer Verification
                        </span>

                        <span class="status-badge">
                            {{ $dealerStatus }}
                        </span>
                    </div>
                </div>

            </aside>

            <div>

                <div class="form-card">

                    <form method="POST" action="{{ route('profile.update') }}">
                        @csrf
                        @method('PATCH')

                        <div class="form-section">

                            <div class="section-title">
                                <h2>Personal Information</h2>
                                <p>Information connected to your AutoMall account.</p>
                            </div>

                            <div class="form-grid">

                                <div class="form-group">
                                    <label for="name">Full name</label>

                                    <input
                                        id="name"
                                        name="name"
                                        type="text"
                                        value="{{ old('name', $user->name) }}"
                                        required
                                        autocomplete="name"
                                    >

                                    <div class="field-error">
                                        {{ $errors->first('name') }}
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="email">Email address</label>

                                    <input
                                        id="email"
                                        name="email"
                                        type="email"
                                        value="{{ old('email', $user->email) }}"
                                        required
                                        autocomplete="email"
                                    >

                                    <div class="field-error">
                                        {{ $errors->first('email') }}
                                    </div>
                                </div>

                            </div>

                        </div>

                        <div class="form-section">

                            <div class="section-title">
                                <h2>Dealership Information</h2>
                                <p>Information other dealers can use to identify your business.</p>
                            </div>

                            <div class="form-grid">

                                <div class="form-group full">
                                    <label for="business_name">Business name</label>

                                    <input
                                        id="business_name"
                                        name="business_name"
                                        type="text"
                                        value="{{ old('business_name', $dealerName) }}"
                                        required
                                        placeholder="Enter your dealership name"
                                    >

                                    <div class="field-error">
                                        {{ $errors->first('business_name') }}
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="phone">Phone number</label>

                                    <input
                                        id="phone"
                                        name="phone"
                                        type="text"
                                        value="{{ old('phone', $dealerPhone) }}"
                                        placeholder="Enter phone number"
                                    >

                                    <div class="field-error">
                                        {{ $errors->first('phone') }}
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="country">Country</label>

                                    <input
                                        id="country"
                                        name="country"
                                        type="text"
                                        value="{{ old('country', $dealerCountry) }}"
                                        required
                                    >

                                    <div class="field-error">
                                        {{ $errors->first('country') }}
                                    </div>
                                </div>

                                <div class="form-group full">
                                    <label for="address">Business address</label>

                                    <input
                                        id="address"
                                        name="address"
                                        type="text"
                                        value="{{ old('address', $dealerAddress) }}"
                                        placeholder="Enter your business address"
                                    >

                                    <div class="field-error">
                                        {{ $errors->first('address') }}
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="city">City</label>

                                    <input
                                        id="city"
                                        name="city"
                                        type="text"
                                        value="{{ old('city', $dealerCity) }}"
                                        placeholder="Enter city"
                                    >

                                    <div class="field-error">
                                        {{ $errors->first('city') }}
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="state">State</label>

                                    <input
                                        id="state"
                                        name="state"
                                        type="text"
                                        value="{{ old('state', $dealerState) }}"
                                        placeholder="Enter state"
                                    >

                                    <div class="field-error">
                                        {{ $errors->first('state') }}
                                    </div>
                                </div>

                                <div class="form-group full">
                                    <label for="description">Business description</label>

                                    <textarea
                                        id="description"
                                        name="description"
                                        placeholder="Tell other dealers about your dealership"
                                    >{{ old('description', $dealerDescription) }}</textarea>

                                    <div class="field-error">
                                        {{ $errors->first('description') }}
                                    </div>
                                </div>

                            </div>

                        </div>

                        <div class="form-actions">

                            <a
                                href="{{ route('dashboard') }}"
                                class="btn btn-secondary"
                            >
                                Cancel
                            </a>

                            <button
                                type="submit"
                                class="btn btn-primary"
                            >
                                Save Changes
                            </button>

                        </div>

                    </form>

                </div>

                <div class="account-card">

                    <h3>Account</h3>

                    <p>
                        Sign out of your AutoMall account on this device.
                    </p>

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

        </div>

    </div>
</div>


</x-app-layout>
