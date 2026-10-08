<x-app-layout>
    <style>
        .request-edit-page {
            min-height: 100vh;
            background: #f5f5f5;
            padding: 40px 24px;
        }

    .request-edit-container {
        max-width: 850px;
        margin: 0 auto;
    }

    .request-edit-header {
        margin-bottom: 28px;
    }

    .request-edit-header h1 {
        margin: 0;
        font-size: 30px;
        font-weight: 800;
        color: #111;
    }

    .request-edit-header p {
        margin-top: 8px;
        color: #666;
    }

    .request-form {
        background: #fff;
        border-radius: 14px;
        padding: 30px;
        border: 1px solid #e5e5e5;
        box-shadow: 0 5px 20px rgba(0, 0, 0, .05);
    }

    .form-section {
        margin-bottom: 30px;
    }

    .form-section h2 {
        font-size: 18px;
        margin: 0 0 18px;
        color: #111;
    }

    .form-grid {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        gap: 18px;
    }

    .form-group {
        display: flex;
        flex-direction: column;
    }

    .form-group.full {
        grid-column: 1 / -1;
    }

    .form-group label {
        font-size: 14px;
        font-weight: 700;
        color: #333;
        margin-bottom: 7px;
    }

    .form-group input,
    .form-group select,
    .form-group textarea {
        width: 100%;
        box-sizing: border-box;
        border: 1px solid #d5d5d5;
        border-radius: 8px;
        padding: 12px 13px;
        font-size: 15px;
        background: #fff;
        color: #111;
    }

    .form-group textarea {
        min-height: 130px;
        resize: vertical;
    }

    .form-group input:focus,
    .form-group select:focus,
    .form-group textarea:focus {
        outline: none;
        border-color: #d60000;
        box-shadow: 0 0 0 2px rgba(214, 0, 0, .08);
    }

    .field-error {
        color: #d60000;
        font-size: 13px;
        margin-top: 5px;
    }

    .location-note {
        margin-top: 8px;
        font-size: 13px;
        color: #777;
    }

    .form-actions {
        display: flex;
        justify-content: flex-end;
        gap: 12px;
        margin-top: 30px;
    }

    .cancel-btn,
    .submit-btn {
        padding: 13px 22px;
        border-radius: 8px;
        font-weight: 700;
        text-decoration: none;
        border: none;
        cursor: pointer;
        font-size: 14px;
    }

    .cancel-btn {
        background: #eee;
        color: #222;
    }

    .submit-btn {
        background: #d60000;
        color: #fff;
    }

    .submit-btn:hover {
        background: #b50000;
    }

    @media (max-width: 700px) {
        .form-grid {
            grid-template-columns: 1fr;
        }

        .form-group.full {
            grid-column: auto;
        }

        .request-form {
            padding: 20px;
        }

        .form-actions {
            flex-direction: column;
        }

        .cancel-btn,
        .submit-btn {
            width: 100%;
            text-align: center;
        }
    }
</style>

<div class="request-edit-page">
    <div class="request-edit-container">

        <div class="request-edit-header">
            <h1>Edit Vehicle Request</h1>
            <p>Update the vehicle you are looking for.</p>
        </div>

        <form
            method="POST"
            action="{{ route('requests.update', $vehicleRequest) }}"
            class="request-form"
        >
            @csrf
            @method('PATCH')

            <div class="form-section">
                <h2>Vehicle Information</h2>

                <div class="form-grid">

                    <div class="form-group">
                        <label for="make">Make</label>
                        <input
                            id="make"
                            name="make"
                            type="text"
                            value="{{ old('make', $vehicleRequest->make) }}"
                            required
                        >

                        @error('make')
                            <div class="field-error">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="model">Model</label>
                        <input
                            id="model"
                            name="model"
                            type="text"
                            value="{{ old('model', $vehicleRequest->model) }}"
                            required
                        >

                        @error('model')
                            <div class="field-error">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="year">Year</label>
                        <input
                            id="year"
                            name="year"
                            type="number"
                            min="1900"
                            max="2100"
                            value="{{ old('year', $vehicleRequest->year) }}"
                        >

                        @error('year')
                            <div class="field-error">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="trim">Trim</label>
                        <input
                            id="trim"
                            name="trim"
                            type="text"
                            value="{{ old('trim', $vehicleRequest->trim) }}"
                            placeholder="e.g. XLE"
                        >

                        @error('trim')
                            <div class="field-error">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="body_type">Body Type</label>
                        <input
                            id="body_type"
                            name="body_type"
                            type="text"
                            value="{{ old('body_type', $vehicleRequest->body_type) }}"
                            placeholder="e.g. SUV"
                        >

                        @error('body_type')
                            <div class="field-error">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="usage_type">Vehicle Usage</label>

                        <select
                            id="usage_type"
                            name="usage_type"
                            required
                        >
                            <option
                                value="nigerian_used"
                                {{ old('usage_type', $vehicleRequest->usage_type) === 'nigerian_used' ? 'selected' : '' }}
                            >
                                Nigerian Used
                            </option>

                            <option
                                value="foreign_used"
                                {{ old('usage_type', $vehicleRequest->usage_type) === 'foreign_used' ? 'selected' : '' }}
                            >
                                Foreign Used
                            </option>

                            <option
                                value="brand_new"
                                {{ old('usage_type', $vehicleRequest->usage_type) === 'brand_new' ? 'selected' : '' }}
                            >
                                Brand New
                            </option>
                        </select>

                        @error('usage_type')
                            <div class="field-error">{{ $message }}</div>
                        @enderror
                    </div>

                </div>
            </div>

            <div class="form-section">
                <h2>Budget</h2>

                <div class="form-grid">

                    <div class="form-group">
                        <label for="min_budget">Minimum Budget</label>

                        <input
                            id="min_budget"
                            name="min_budget"
                            type="number"
                            min="0"
                            value="{{ old('min_budget', $vehicleRequest->min_budget) }}"
                        >

                        @error('min_budget')
                            <div class="field-error">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="max_budget">Maximum Budget</label>

                        <input
                            id="max_budget"
                            name="max_budget"
                            type="number"
                            min="0"
                            value="{{ old('max_budget', $vehicleRequest->max_budget) }}"
                        >

                        @error('max_budget')
                            <div class="field-error">{{ $message }}</div>
                        @enderror
                    </div>

                </div>
            </div>

            <div class="form-section">
                <h2>Search Area</h2>

                <div class="form-grid">

                    <div class="form-group full">
                        <label for="location_scope">
                            Where are you looking?
                        </label>

                        <select
                            id="location_scope"
                            name="location_scope"
                            required
                        >
                            <option
                                value="state"
                                {{ old('location_scope', $vehicleRequest->location_scope) === 'state' ? 'selected' : '' }}
                            >
                                My State
                            </option>

                            <option
                                value="nationwide"
                                {{ old('location_scope', $vehicleRequest->location_scope) === 'nationwide' ? 'selected' : '' }}
                            >
                                Nationwide
                            </option>
                        </select>

                        @error('location_scope')
                            <div class="field-error">{{ $message }}</div>
                        @enderror
                    </div>

                    <div
                        class="form-group"
                        id="state-group"
                    >
                        <label for="state">State</label>

                        <select id="state" name="state">
                            <option value="">Select state</option>

                            @foreach ([
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
                                    {{ old('state', $vehicleRequest->state) === $state ? 'selected' : '' }}
                                >
                                    {{ $state }}
                                </option>

                            @endforeach
                        </select>

                        @error('state')
                            <div class="field-error">{{ $message }}</div>
                        @enderror
                    </div>

                    <div
                        class="form-group"
                        id="city-group"
                    >
                        <label for="city">City</label>

                        <input
                            id="city"
                            name="city"
                            type="text"
                            value="{{ old('city', $vehicleRequest->city) }}"
                            placeholder="e.g. Abuja"
                        >

                        @error('city')
                            <div class="field-error">{{ $message }}</div>
                        @enderror
                    </div>

                </div>

                <div class="location-note">
                    Nationwide allows dealers anywhere in Nigeria to respond.
                </div>
            </div>

            <div class="form-section">
                <h2>Additional Details</h2>

                <div class="form-grid">

                    <div class="form-group full">
                        <label for="description">Description</label>

                        <textarea
                            id="description"
                            name="description"
                            placeholder="Add any other details about the vehicle you need..."
                        >{{ old('description', $vehicleRequest->description) }}</textarea>

                        @error('description')
                            <div class="field-error">{{ $message }}</div>
                        @enderror
                    </div>

                </div>
            </div>

            <div class="form-actions">
                <a
                    href="{{ route('requests.show', $vehicleRequest) }}"
                    class="cancel-btn"
                >
                    Cancel
                </a>

                <button type="submit" class="submit-btn">
                    Save Changes
                </button>
            </div>

        </form>

    </div>
</div>

<script>
    const locationScope = document.getElementById('location_scope');
    const stateGroup = document.getElementById('state-group');
    const cityGroup = document.getElementById('city-group');
    const stateInput = document.getElementById('state');
    const cityInput = document.getElementById('city');

    function updateLocationFields() {
        if (locationScope.value === 'nationwide') {
            stateGroup.style.display = 'none';
            cityGroup.style.display = 'none';

            stateInput.value = '';
            cityInput.value = '';

            stateInput.removeAttribute('required');
        } else {
            stateGroup.style.display = 'flex';
            cityGroup.style.display = 'flex';

            stateInput.setAttribute('required', 'required');
        }
    }

    locationScope.addEventListener('change', updateLocationFields);

    updateLocationFields();
</script>

</x-app-layout>
