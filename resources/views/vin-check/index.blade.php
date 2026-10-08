<x-app-layout>


<style>
    .am-vin-page {
        min-height: 100vh;
        background: #f5f5f5;
        padding: 35px 20px 60px;
    }

    .am-vin-container {
        max-width: 1050px;
        margin: 0 auto;
    }

    .am-vin-heading {
        margin-bottom: 25px;
    }

    .am-vin-heading h1 {
        margin: 0;
        color: #111;
        font-size: 30px;
        font-weight: 900;
    }

    .am-vin-heading p {
        margin: 7px 0 0;
        color: #777;
        font-size: 13px;
    }

    .am-vin-card {
        background: #fff;
        border: 1px solid #e5e5e5;
        border-radius: 16px;
        padding: 28px;
        margin-bottom: 20px;
        box-shadow: 0 4px 18px rgba(0, 0, 0, .04);
    }

    .am-vin-card h2 {
        margin: 0 0 7px;
        color: #111;
        font-size: 18px;
        font-weight: 900;
    }

    .am-vin-card p {
        margin: 0 0 20px;
        color: #777;
        font-size: 12px;
        line-height: 1.6;
    }

    .am-vin-form {
        display: flex;
        gap: 10px;
    }

    .am-vin-input {
        flex: 1;
        min-width: 0;
        height: 48px;
        padding: 0 15px;
        border: 1px solid #d8d8d8;
        border-radius: 9px;
        outline: none;
        color: #111;
        background: #fff;
        font-family: monospace;
        font-size: 15px;
        font-weight: 800;
        letter-spacing: 1px;
        text-transform: uppercase;
    }

    .am-vin-input:focus {
        border-color: #c40000;
        box-shadow: 0 0 0 3px rgba(196, 0, 0, .08);
    }

    .am-vin-button {
        height: 48px;
        padding: 0 22px;
        border: 0;
        border-radius: 9px;
        background: #c40000;
        color: #fff;
        font-size: 12px;
        font-weight: 900;
        cursor: pointer;
    }

    .am-vin-button:hover {
        background: #a90000;
    }

    .am-vin-result {
        margin-top: 20px;
        padding: 18px;
        border-radius: 10px;
        background: #f7f7f7;
        border: 1px solid #e5e5e5;
    }

    .am-vin-result-title {
        margin-bottom: 7px;
        font-size: 14px;
        font-weight: 900;
    }

    .am-vin-result-text {
        color: #666;
        font-size: 12px;
        line-height: 1.6;
    }

    .am-vin-valid {
        border-color: #c9e8d1;
        background: #edf9f1;
    }

    .am-vin-valid .am-vin-result-title {
        color: #17713a;
    }

    .am-vin-invalid {
        border-color: #efc5c5;
        background: #fff0f0;
    }

    .am-vin-invalid .am-vin-result-title {
        color: #a00000;
    }

    .am-vin-info-grid {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 12px;
        margin-top: 20px;
    }

    .am-vin-info {
        padding: 15px;
        border: 1px solid #e5e5e5;
        border-radius: 10px;
        background: #fafafa;
    }

    .am-vin-info strong {
        display: block;
        margin-bottom: 5px;
        color: #111;
        font-size: 12px;
        font-weight: 900;
    }

    .am-vin-info span {
        color: #777;
        font-size: 11px;
        line-height: 1.5;
    }

    .am-history-box {
        padding: 18px;
        border: 1px solid #e5e5e5;
        border-radius: 10px;
        background: #fafafa;
    }

    .am-history-box strong {
        display: block;
        margin-bottom: 7px;
        color: #111;
        font-size: 13px;
    }

    .am-history-box span {
        color: #777;
        font-size: 11px;
        line-height: 1.6;
    }

    .am-recent-empty {
        color: #888;
        font-size: 12px;
    }

    @media (max-width: 650px) {
        .am-vin-page {
            padding: 25px 12px 45px;
        }

        .am-vin-heading h1 {
            font-size: 25px;
        }

        .am-vin-card {
            padding: 20px;
        }

        .am-vin-form {
            flex-direction: column;
        }

        .am-vin-button {
            width: 100%;
        }

        .am-vin-info-grid {
            grid-template-columns: 1fr;
        }
    }
</style>


<div class="am-vin-page">

    <div class="am-vin-container">

        <div class="am-vin-heading">
            <h1>VIN Check</h1>

            <p>
                Validate a vehicle identification number before listing a vehicle.
            </p>
        </div>


        <div class="am-vin-card">

            <h2>Check a VIN</h2>

            <p>
                Enter a 17-character VIN to check its structure and check digit.
            </p>


            <form
                method="GET"
                action="{{ route('vin.check') }}"
                class="am-vin-form"
            >

                <input
                    type="text"
                    name="vin"
                    class="am-vin-input"
                    value="{{ request('vin') }}"
                    maxlength="17"
                    minlength="17"
                    placeholder="ENTER 17-CHARACTER VIN"
                    autocomplete="off"
                    required
                >

                <button
                    type="submit"
                    class="am-vin-button"
                >
                    Check VIN
                </button>

            </form>


            @if (request('vin'))

                @if (isset($vinValid) && $vinValid)

                    <div class="am-vin-result am-vin-valid">

                        <div class="am-vin-result-title">
                            VIN is structurally valid
                        </div>

                        <div class="am-vin-result-text">
                            The VIN format and check digit are valid.
                        </div>

                    </div>

                @else

                    <div class="am-vin-result am-vin-invalid">

                        <div class="am-vin-result-title">
                            VIN is not valid
                        </div>

                        <div class="am-vin-result-text">
                            Check the VIN and make sure all 17 characters were entered correctly.
                        </div>

                    </div>

                @endif

            @endif

        </div>


        <div class="am-vin-card">

            <h2>What this check means</h2>

            <p>
                AutoMall first validates the VIN itself. A valid VIN does not automatically
                mean the vehicle has a clean history.
            </p>


            <div class="am-vin-info-grid">

                <div class="am-vin-info">

                    <strong>VIN Format</strong>

                    <span>
                        Checks that the VIN contains the correct 17 characters.
                    </span>

                </div>


                <div class="am-vin-info">

                    <strong>Check Digit</strong>

                    <span>
                        Checks the mathematical VIN check digit where applicable.
                    </span>

                </div>


                <div class="am-vin-info">

                    <strong>Vehicle History</strong>

                    <span>
                        Accident, theft, title and other history require a separate
                        vehicle-history data provider.
                    </span>

                </div>

            </div>

        </div>


        <div class="am-vin-card">

            <h2>Vehicle History</h2>

            <p>
                Full history reporting will be connected to AutoMall's VIN history service later.
            </p>

            <div class="am-history-box">

                <strong>
                    History reports are not available yet
                </strong>

                <span>
                    This section is reserved for verified vehicle-history information
                    such as accident records, theft records, title information,
                    mileage records and other available data.
                </span>

            </div>

        </div>


        <div class="am-vin-card">

            <h2>Recent VIN Checks</h2>

            @if (isset($recentChecks) && $recentChecks->count())

                @foreach ($recentChecks as $check)

                    <div
                        style="
                            display:flex;
                            justify-content:space-between;
                            gap:15px;
                            padding:13px 0;
                            border-bottom:1px solid #eee;
                        "
                    >

                        <strong
                            style="
                                font-family:monospace;
                                font-size:12px;
                                letter-spacing:1px;
                            "
                        >
                            {{ $check->vin }}
                        </strong>

                        <span
                            style="
                                color:#777;
                                font-size:11px;
                            "
                        >
                            {{ $check->created_at->format('M d, Y') }}
                        </span>

                    </div>

                @endforeach

            @else

                <div class="am-recent-empty">
                    No recent VIN checks yet.
                </div>

            @endif

        </div>

    </div>

</div>
```

</x-app-layout>
