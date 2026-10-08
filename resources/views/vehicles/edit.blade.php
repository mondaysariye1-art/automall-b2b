<x-app-layout>
    <style>
        .am-edit-page {
            min-height: 100vh;
            background: #f5f5f5;
            color: #111;
            padding: 32px 20px 60px;
        }


    .am-edit-container {
        max-width: 1100px;
        margin: 0 auto;
    }

    .am-top {
        display: flex;
        justify-content: space-between;
        align-items: center;
        gap: 20px;
        margin-bottom: 28px;
    }

    .am-back {
        color: #555;
        text-decoration: none;
        font-size: 14px;
        font-weight: 700;
    }

    .am-back:hover {
        color: #c40000;
    }

    .am-title h1 {
        margin: 0;
        font-size: 30px;
        font-weight: 900;
        letter-spacing: -0.5px;
    }

    .am-title p {
        margin: 6px 0 0;
        color: #666;
        font-size: 14px;
    }

    .am-card {
        background: #fff;
        border: 1px solid #e5e5e5;
        border-radius: 16px;
        margin-bottom: 20px;
        overflow: hidden;
        box-shadow: 0 4px 18px rgba(0,0,0,.04);
    }

    .am-card-header {
        padding: 20px 24px;
        border-bottom: 1px solid #eee;
    }

    .am-card-header h2 {
        margin: 0;
        font-size: 18px;
        font-weight: 900;
    }

    .am-card-header p {
        margin: 5px 0 0;
        color: #777;
        font-size: 13px;
    }

    .am-card-body {
        padding: 24px;
    }

    .am-grid {
        display: grid;
        grid-template-columns: repeat(2, minmax(0, 1fr));
        gap: 20px;
    }

    .am-field {
        display: flex;
        flex-direction: column;
        gap: 7px;
    }

    .am-field.full {
        grid-column: 1 / -1;
    }

    .am-field label {
        font-size: 13px;
        font-weight: 800;
        color: #222;
    }

    .am-field input,
    .am-field select,
    .am-field textarea {
        width: 100%;
        border: 1px solid #d8d8d8;
        border-radius: 10px;
        background: #fff;
        color: #111;
        padding: 12px 13px;
        font-size: 14px;
        outline: none;
        box-sizing: border-box;
        transition: border-color .15s, box-shadow .15s;
    }

    .am-field input:focus,
    .am-field select:focus,
    .am-field textarea:focus {
        border-color: #c40000;
        box-shadow: 0 0 0 3px rgba(196,0,0,.08);
    }

    .am-field textarea {
        min-height: 140px;
        resize: vertical;
    }

    .am-readonly {
        background: #f1f1f1 !important;
        color: #555 !important;
        cursor: not-allowed;
    }

    .am-help {
        font-size: 12px;
        color: #777;
        line-height: 1.5;
    }

    .am-error {
        color: #b00000;
        font-size: 12px;
        font-weight: 700;
    }

    .am-vin-box {
        display: grid;
        grid-template-columns: 1fr auto;
        gap: 14px;
        align-items: center;
    }

    .am-vin-status {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        padding: 9px 13px;
        border-radius: 999px;
        background: #e9f7ee;
        color: #18753c;
        font-size: 12px;
        font-weight: 900;
        white-space: nowrap;
    }

    .am-actions {
        display: flex;
        justify-content: space-between;
        align-items: center;
        gap: 14px;
        flex-wrap: wrap;
        margin-top: 26px;
    }

    .am-actions-left,
    .am-actions-right {
        display: flex;
        gap: 10px;
        align-items: center;
    }

    .am-btn {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        min-height: 44px;
        padding: 0 18px;
        border-radius: 10px;
        border: 1px solid transparent;
        text-decoration: none;
        font-size: 13px;
        font-weight: 900;
        cursor: pointer;
        transition: .15s;
    }

    .am-btn-secondary {
        background: #fff;
        color: #222;
        border-color: #d8d8d8;
    }

    .am-btn-secondary:hover {
        border-color: #aaa;
        background: #f7f7f7;
    }

    .am-btn-primary {
        background: #c40000;
        color: #fff;
    }

    .am-btn-primary:hover {
        background: #a90000;
    }

    .am-alert {
        padding: 14px 16px;
        border-radius: 10px;
        margin-bottom: 20px;
        font-size: 13px;
        font-weight: 700;
    }

    .am-alert-error {
        background: #fff0f0;
        border: 1px solid #f2c4c4;
        color: #9b0000;
    }

    @media (max-width: 700px) {
        .am-edit-page {
            padding: 24px 14px 45px;
        }

        .am-top {
            align-items: flex-start;
            flex-direction: column;
        }

        .am-title h1 {
            font-size: 25px;
        }

        .am-grid {
            grid-template-columns: 1fr;
        }

        .am-field.full {
            grid-column: auto;
        }

        .am-card-body {
            padding: 18px;
        }

        .am-vin-box {
            grid-template-columns: 1fr;
        }

        .am-actions {
            flex-direction: column-reverse;
            align-items: stretch;
        }

        .am-actions-left,
        .am-actions-right {
            width: 100%;
        }

        .am-btn {
            width: 100%;
        }
    }
</style>

<div class="am-edit-page">
    <div class="am-edit-container">

        <div class="am-top">
            <div>
                <a href="{{ route('vehicles.show', $vehicle) }}" class="am-back">
                    ← Back to Vehicle
                </a>
            </div>

            <div class="am-title">
                <h1>Edit Vehicle</h1>
                <p>Update the vehicle information for this listing.</p>
            </div>
        </div>

        @if ($errors->any())
            <div class="am-alert am-alert-error">
                Please correct the highlighted information and try again.
            </div>
        @endif

        <form method="POST" action="{{ route('vehicles.update', $vehicle) }}">
            @csrf
            @method('PATCH')

            <!-- VIN -->
            <div class="am-card">
                <div class="am-card-header">
                    <h2>Vehicle Identification</h2>
                    <p>The VIN cannot be changed after the vehicle is created.</p>
                </div>

                <div class="am-card-body">
                    <div class="am-vin-box">
                        <div class="am-field">
                            <label for="vin">VIN</label>

                            <input
                                id="vin"
                                type="text"
                                value="{{ $vehicle->vin }}"
                                class="am-readonly"
                                readonly
                            >

                            <div class="am-help">
                                VIN: 17 characters. This vehicle's VIN is permanently associated
                                with the listing.
                            </div>
                        </div>

                        <div>
                            @if ($vehicle->vin_status === 'valid')
                                <span class="am-vin-status">VIN Valid</span>
                            @elseif ($vehicle->vin_status === 'invalid')
                                <span class="am-vin-status" style="background:#fff0f0;color:#a00000;">
                                    VIN Invalid
                                </span>
                            @else
                                <span class="am-vin-status" style="background:#f5f5f5;color:#555;">
                                    VIN Pending
                                </span>
                            @endif
                        </div>
                    </div>
                </div>
            </div>

            <!-- Basic Information -->
            <div class="am-card">
                <div class="am-card-header">
                    <h2>Basic Information</h2>
                    <p>Update the vehicle's main details.</p>
                </div>

                <div class="am-card-body">
                    <div class="am-grid">

                        <div class="am-field">
                            <label for="make">Make *</label>
                            <input
                                id="make"
                                name="make"
                                type="text"
                                value="{{ old('make', $vehicle->make) }}"
                                required
                            >
                            @error('make')
                                <span class="am-error">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="am-field">
                            <label for="model">Model *</label>
                            <input
                                id="model"
                                name="model"
                                type="text"
                                value="{{ old('model', $vehicle->model) }}"
                                required
                            >
                            @error('model')
                                <span class="am-error">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="am-field">
                            <label for="year">Year *</label>
                            <input
                                id="year"
                                name="year"
                                type="number"
                                min="1886"
                                max="{{ date('Y') + 1 }}"
                                value="{{ old('year', $vehicle->year) }}"
                                required
                            >
                            @error('year')
                                <span class="am-error">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="am-field">
                            <label for="trim">Trim</label>
                            <input
                                id="trim"
                                name="trim"
                                type="text"
                                value="{{ old('trim', $vehicle->trim) }}"
                            >
                            @error('trim')
                                <span class="am-error">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="am-field">
                            <label for="body_type">Body Type</label>
                            <input
                                id="body_type"
                                name="body_type"
                                type="text"
                                value="{{ old('body_type', $vehicle->body_type) }}"
                                placeholder="SUV, Sedan, Coupe..."
                            >
                            @error('body_type')
                                <span class="am-error">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="am-field">
                            <label for="color">Color</label>
                            <input
                                id="color"
                                name="color"
                                type="text"
                                value="{{ old('color', $vehicle->color) }}"
                            >
                            @error('color')
                                <span class="am-error">{{ $message }}</span>
                            @enderror
                        </div>

                    </div>
                </div>
            </div>

            <!-- Mechanical -->
            <div class="am-card">
                <div class="am-card-header">
                    <h2>Mechanical Information</h2>
                    <p>Update engine, transmission and drivetrain information.</p>
                </div>

                <div class="am-card-body">
                    <div class="am-grid">

                        <div class="am-field">
                            <label for="engine">Engine</label>
                            <input
                                id="engine"
                                name="engine"
                                type="text"
                                value="{{ old('engine', $vehicle->engine) }}"
                                placeholder="Example: 3.5L V6"
                            >
                            @error('engine')
                                <span class="am-error">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="am-field">
                            <label for="transmission">Transmission</label>
                            <input
                                id="transmission"
                                name="transmission"
                                type="text"
                                value="{{ old('transmission', $vehicle->transmission) }}"
                                placeholder="Automatic, Manual..."
                            >
                            @error('transmission')
                                <span class="am-error">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="am-field">
                            <label for="fuel_type">Fuel Type</label>
                            <input
                                id="fuel_type"
                                name="fuel_type"
                                type="text"
                                value="{{ old('fuel_type', $vehicle->fuel_type) }}"
                                placeholder="Petrol, Diesel, Hybrid..."
                            >
                            @error('fuel_type')
                                <span class="am-error">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="am-field">
                            <label for="drivetrain">Drivetrain</label>
                            <input
                                id="drivetrain"
                                name="drivetrain"
                                type="text"
                                value="{{ old('drivetrain', $vehicle->drivetrain) }}"
                                placeholder="FWD, RWD, AWD..."
                            >
                            @error('drivetrain')
                                <span class="am-error">{{ $message }}</span>
                            @enderror
                        </div>

                    </div>
                </div>
            </div>

            <!-- Pricing and Location -->
            <div class="am-card">
                <div class="am-card-header">
                    <h2>Pricing & Location</h2>
                    <p>Keep the listing information accurate for buyers.</p>
                </div>

                <div class="am-card-body">
                    <div class="am-grid">

                        <div class="am-field">
                            <label for="mileage">Mileage</label>
                            <input
                                id="mileage"
                                name="mileage"
                                type="number"
                                min="0"
                                value="{{ old('mileage', $vehicle->mileage) }}"
                            >
                            @error('mileage')
                                <span class="am-error">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="am-field">
                            <label for="price">Price</label>
                            <input
                                id="price"
                                name="price"
                                type="number"
                                min="0"
                                step="0.01"
                                value="{{ old('price', $vehicle->price) }}"
                            >
                            @error('price')
                                <span class="am-error">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="am-field">
                            <label for="city">City</label>
                            <input
                                id="city"
                                name="city"
                                type="text"
                                value="{{ old('city', $vehicle->city) }}"
                            >
                            @error('city')
                                <span class="am-error">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="am-field">
                            <label for="state">State</label>
                            <input
                                id="state"
                                name="state"
                                type="text"
                                value="{{ old('state', $vehicle->state) }}"
                            >
                            @error('state')
                                <span class="am-error">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="am-field">
                            <label for="country">Country</label>
                            <input
                                id="country"
                                name="country"
                                type="text"
                                value="{{ old('country', $vehicle->country ?? 'Nigeria') }}"
                            >
                            @error('country')
                                <span class="am-error">{{ $message }}</span>
                            @enderror
                        </div>

                    </div>
                </div>
            </div>

            <!-- Description -->
            <div class="am-card">
                <div class="am-card-header">
                    <h2>Description</h2>
                    <p>Add useful information about the vehicle.</p>
                </div>

                <div class="am-card-body">
                    <div class="am-field">
                        <label for="description">Vehicle Description</label>

                        <textarea
                            id="description"
                            name="description"
                            placeholder="Describe the condition, features and other useful information..."
                        >{{ old('description', $vehicle->description) }}</textarea>

                        @error('description')
                            <span class="am-error">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
            </div>

            <!-- Actions -->
            <div class="am-actions">
                <div class="am-actions-left">
                    <a
                        href="{{ route('vehicles.show', $vehicle) }}"
                        class="am-btn am-btn-secondary"
                    >
                        Cancel
                    </a>
                </div>

                <div class="am-actions-right">
                    <button
                        type="submit"
                        class="am-btn am-btn-primary"
                    >
                        Save Changes
                    </button>
                </div>
            </div>

        </form>

    </div>
</div>

</x-app-layout>
