<x-app-layout>
    <style>
        .request-show-page {
            min-height: 100vh;
            background: #f5f5f5;
            padding: 40px 24px;
        }

    .request-show-container {
        max-width: 900px;
        margin: 0 auto;
    }

    .back-link {
        display: inline-block;
        margin-bottom: 22px;
        color: #d60000;
        text-decoration: none;
        font-weight: 700;
        font-size: 14px;
    }

    .request-card {
        background: #fff;
        border: 1px solid #e5e5e5;
        border-radius: 14px;
        padding: 30px;
        box-shadow: 0 5px 20px rgba(0, 0, 0, .05);
    }

    .request-header {
        display: flex;
        justify-content: space-between;
        align-items: flex-start;
        gap: 20px;
        padding-bottom: 24px;
        border-bottom: 1px solid #eee;
    }

    .request-header h1 {
        margin: 0;
        font-size: 28px;
        font-weight: 800;
        color: #111;
    }

    .request-header p {
        margin: 7px 0 0;
        color: #777;
    }

    .status {
        display: inline-block;
        padding: 7px 12px;
        border-radius: 20px;
        background: #e8f7ed;
        color: #16803c;
        font-size: 13px;
        font-weight: 800;
        text-transform: capitalize;
    }

    .details-section {
        padding-top: 25px;
    }

    .details-section h2 {
        margin: 0 0 18px;
        font-size: 18px;
        color: #111;
    }

    .details-grid {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        gap: 16px;
    }

    .detail-box {
        background: #f8f8f8;
        border-radius: 9px;
        padding: 15px;
    }

    .detail-label {
        display: block;
        color: #777;
        font-size: 12px;
        font-weight: 700;
        margin-bottom: 5px;
        text-transform: uppercase;
    }

    .detail-value {
        color: #111;
        font-size: 15px;
        font-weight: 700;
    }

    .description {
        margin-top: 22px;
        padding: 18px;
        background: #f8f8f8;
        border-radius: 9px;
        color: #333;
        line-height: 1.6;
    }

    .description-title {
        font-size: 13px;
        font-weight: 800;
        text-transform: uppercase;
        color: #777;
        margin-bottom: 8px;
    }

    .dealer-section {
        margin-top: 25px;
        padding-top: 25px;
        border-top: 1px solid #eee;
    }

    .dealer-section h2 {
        margin: 0 0 10px;
        font-size: 18px;
    }

    .dealer-name {
        font-weight: 800;
        color: #111;
    }

    .dealer-location {
        color: #777;
        margin-top: 4px;
    }

    .actions {
        display: flex;
        flex-wrap: wrap;
        gap: 10px;
        margin-top: 28px;
        padding-top: 24px;
        border-top: 1px solid #eee;
    }

    .action-button {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        padding: 11px 18px;
        border-radius: 8px;
        font-size: 14px;
        font-weight: 700;
        text-decoration: none;
        border: none;
        cursor: pointer;
    }

    .edit-button {
        background: #111;
        color: #fff;
    }

    .edit-button:hover {
        background: #333;
    }

    .cancel-button {
        background: #d60000;
        color: #fff;
    }

    .cancel-button:hover {
        background: #b50000;
    }

    .back-button {
        background: #eee;
        color: #222;
    }

    @media (max-width: 700px) {
        .request-header {
            flex-direction: column;
        }

        .details-grid {
            grid-template-columns: 1fr;
        }

        .request-card {
            padding: 20px;
        }

        .action-button {
            width: 100%;
        }
    }
</style>

<div class="request-show-page">
    <div class="request-show-container">

        <a
            href="{{ route('requests.index') }}"
            class="back-link"
        >
            ← Back to Vehicle Requests
        </a>

        <div class="request-card">

            <div class="request-header">
                <div>
                    <h1>
                        {{ $vehicleRequest->make }}
                        {{ $vehicleRequest->model }}
                    </h1>

                    <p>
                        Vehicle Request #{{ $vehicleRequest->id }}
                    </p>
                </div>

                <span class="status">
                    {{ $vehicleRequest->status }}
                </span>
            </div>

            <div class="details-section">
                <h2>Vehicle Details</h2>

                <div class="details-grid">

                    <div class="detail-box">
                        <span class="detail-label">Make</span>
                        <span class="detail-value">
                            {{ $vehicleRequest->make }}
                        </span>
                    </div>

                    <div class="detail-box">
                        <span class="detail-label">Model</span>
                        <span class="detail-value">
                            {{ $vehicleRequest->model }}
                        </span>
                    </div>

                    <div class="detail-box">
                        <span class="detail-label">Year</span>
                        <span class="detail-value">
                            {{ $vehicleRequest->year ?? 'Any year' }}
                        </span>
                    </div>

                    <div class="detail-box">
                        <span class="detail-label">Trim</span>
                        <span class="detail-value">
                            {{ $vehicleRequest->trim ?? 'Any trim' }}
                        </span>
                    </div>

                    <div class="detail-box">
                        <span class="detail-label">Body Type</span>
                        <span class="detail-value">
                            {{ $vehicleRequest->body_type ?? 'Any body type' }}
                        </span>
                    </div>

                    <div class="detail-box">
                        <span class="detail-label">Vehicle Usage</span>
                        <span class="detail-value">
                            @if($vehicleRequest->usage_type === 'nigerian_used')
                                Nigerian Used
                            @elseif($vehicleRequest->usage_type === 'foreign_used')
                                Foreign Used
                            @elseif($vehicleRequest->usage_type === 'brand_new')
                                Brand New
                            @else
                                Not specified
                            @endif
                        </span>
                    </div>

                    <div class="detail-box">
                        <span class="detail-label">Minimum Budget</span>
                        <span class="detail-value">
                            @if(!is_null($vehicleRequest->min_budget))
                                ₦{{ number_format($vehicleRequest->min_budget) }}
                            @else
                                No minimum
                            @endif
                        </span>
                    </div>

                    <div class="detail-box">
                        <span class="detail-label">Maximum Budget</span>
                        <span class="detail-value">
                            @if(!is_null($vehicleRequest->max_budget))
                                ₦{{ number_format($vehicleRequest->max_budget) }}
                            @else
                                No maximum
                            @endif
                        </span>
                    </div>

                    <div class="detail-box">
                        <span class="detail-label">Search Area</span>
                        <span class="detail-value">
                            @if($vehicleRequest->location_scope === 'nationwide')
                                Nationwide
                            @else
                                My State
                            @endif
                        </span>
                    </div>

                    <div class="detail-box">
                        <span class="detail-label">State</span>
                        <span class="detail-value">
                            {{ $vehicleRequest->state ?? 'Any state' }}
                        </span>
                    </div>

                    <div class="detail-box">
                        <span class="detail-label">City</span>
                        <span class="detail-value">
                            {{ $vehicleRequest->city ?? 'Any city' }}
                        </span>
                    </div>

                </div>

                @if($vehicleRequest->description)
                    <div class="description">
                        <div class="description-title">
                            Additional Details
                        </div>

                        {{ $vehicleRequest->description }}
                    </div>
                @endif
            </div>

            <div class="dealer-section">
                <h2>Requested By</h2>

                <div class="dealer-name">
                    {{ $vehicleRequest->dealer->business_name }}
                </div>

                <div class="dealer-location">
                    {{ $vehicleRequest->dealer->city ?? 'Nigeria' }}
                    @if($vehicleRequest->dealer->state)
                        , {{ $vehicleRequest->dealer->state }}
                    @endif
                </div>
            </div>

            <div class="actions">

                @if($vehicleRequest->dealer_id === $dealer->id)
                    <a
                        href="{{ route('requests.edit', $vehicleRequest) }}"
                        class="action-button edit-button"
                    >
                        Edit Request
                    </a>

                    @if($vehicleRequest->status === 'open')
                        <form
                            method="POST"
                            action="{{ route('requests.cancel', $vehicleRequest) }}"
                        >
                            @csrf
                            @method('PATCH')

                            <button
                                type="submit"
                                class="action-button cancel-button"
                            >
                                Cancel Request
                            </button>
                        </form>
                    @endif
                @endif

                <a
                    href="{{ route('requests.index') }}"
                    class="action-button back-button"
                >
                    Back to Requests
                </a>

            </div>

        </div>
    </div>
</div>

</x-app-layout>
