<x-app-layout>
    <style>
        .requests-page {
            min-height: 100vh;
            background: #f5f5f5;
            padding: 40px 24px;
        }

    .requests-container {
        max-width: 1200px;
        margin: 0 auto;
    }

    .requests-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        gap: 20px;
        margin-bottom: 30px;
    }

    .requests-header h1 {
        margin: 0;
        font-size: 30px;
        font-weight: 800;
        color: #111;
    }

    .requests-header p {
        margin: 7px 0 0;
        color: #666;
    }

    .create-request-btn {
        display: inline-block;
        padding: 13px 20px;
        background: #d60000;
        color: #fff;
        text-decoration: none;
        border-radius: 8px;
        font-weight: 700;
    }

    .create-request-btn:hover {
        background: #b50000;
    }

    .success-message {
        background: #e9f8ee;
        color: #176b35;
        padding: 14px 18px;
        border-radius: 8px;
        margin-bottom: 20px;
    }

    .requests-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
        gap: 20px;
    }

    .request-card {
        background: #fff;
        border: 1px solid #e5e5e5;
        border-radius: 12px;
        padding: 22px;
        box-shadow: 0 4px 14px rgba(0, 0, 0, .05);
    }

    .request-card h2 {
        margin: 0 0 8px;
        font-size: 20px;
        color: #111;
    }

    .request-meta {
        color: #666;
        font-size: 14px;
        margin-bottom: 15px;
    }

    .request-description {
        color: #444;
        line-height: 1.6;
        margin-bottom: 18px;
    }

    .request-status {
        display: inline-block;
        padding: 6px 10px;
        border-radius: 20px;
        background: #111;
        color: #fff;
        font-size: 12px;
        font-weight: 700;
        text-transform: uppercase;
    }

    .request-view {
        display: block;
        margin-top: 18px;
        color: #d60000;
        text-decoration: none;
        font-weight: 700;
    }

    .empty-state {
        background: #fff;
        border: 1px dashed #ccc;
        border-radius: 12px;
        padding: 60px 20px;
        text-align: center;
        color: #666;
    }

    @media (max-width: 700px) {
        .requests-header {
            flex-direction: column;
            align-items: flex-start;
        }

        .create-request-btn {
            width: 100%;
            text-align: center;
        }
    }
</style>

<div class="requests-page">
    <div class="requests-container">

        <div class="requests-header">
            <div>
                <h1>Vehicle Requests</h1>
                <p>Find vehicles other dealers are looking for.</p>
            </div>

            <a href="{{ route('requests.create') }}" class="create-request-btn">
                Post Vehicle Request
            </a>
        </div>

        @if (session('success'))
            <div class="success-message">
                {{ session('success') }}
            </div>
        @endif

        @if ($requests->count())
            <div class="requests-grid">
                @foreach ($requests as $requestItem)
                    <div class="request-card">
                        <h2>
                            {{ $requestItem->year ? $requestItem->year . ' ' : '' }}
                            {{ $requestItem->make }}
                            {{ $requestItem->model }}
                        </h2>

                        <div class="request-meta">
                            Requested by
                            {{ $requestItem->dealer->business_name ?? 'Dealer' }}
                        </div>

                        @if ($requestItem->city || $requestItem->state)
                            <div class="request-meta">
                                Location:
                                {{ $requestItem->city }}
                                @if ($requestItem->city && $requestItem->state)
                                    ,
                                @endif
                                {{ $requestItem->state }}
                            </div>
                        @endif

                        @if ($requestItem->description)
                            <div class="request-description">
                                {{ Str::limit($requestItem->description, 140) }}
                            </div>
                        @endif

                        <span class="request-status">
                            {{ $requestItem->status }}
                        </span>

                        <a
                            href="{{ route('requests.show', $requestItem) }}"
                            class="request-view"
                        >
                            View Request
                        </a>
                    </div>
                @endforeach
            </div>
        @else
            <div class="empty-state">
                <h2>No vehicle requests yet</h2>
                <p>Be the first dealer to post a vehicle request.</p>
            </div>
        @endif

    </div>
</div>

</x-app-layout>
