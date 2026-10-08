<x-app-layout>

@php
    $photos = $vehicle->media->where('type', 'photo')->values();
    $videos = $vehicle->media->where('type', 'video')->values();
    $allMedia = $vehicle->media->values();

    $statusClass = match ($vehicle->status) {
        'sold' => 'am-status-sold',
        'archived' => 'am-status-archived',
        default => 'am-status-active',
    };
@endphp

<style>
    
    .am-show-page {
        min-height: 100vh;
        background: #f5f5f5;
        color: #111;
        padding: 30px 20px 60px;
    }

    .am-show-container {
        max-width: 1250px;
        margin: 0 auto;
    }

    /* HEADER */
    .am-show-header {
        display: flex;
        justify-content: space-between;
        align-items: flex-start;
        gap: 25px;
        margin-bottom: 25px;
    }

    .am-back-link {
        display: inline-block;
        margin-bottom: 12px;
        color: #666;
        text-decoration: none;
        font-size: 13px;
        font-weight: 800;
    }

    .am-back-link:hover {
        color: #c40000;
    }

    .am-title-row {
        display: flex;
        align-items: center;
        flex-wrap: wrap;
        gap: 10px;
    }

    .am-title {
        margin: 0;
        font-size: 31px;
        line-height: 1.15;
        font-weight: 900;
        letter-spacing: -0.6px;
    }

    .am-subtitle {
        margin: 7px 0 0;
        color: #777;
        font-size: 13px;
    }

    /* STATUS */
    .am-status {
        display: inline-flex;
        align-items: center;
        padding: 6px 10px;
        border-radius: 999px;
        background: #eaf8ef;
        color: #17713a;
        font-size: 10px;
        font-weight: 900;
        text-transform: uppercase;
    }

    .am-status-sold {
        background: #ededed;
        color: #555;
    }

    .am-status-archived {
        background: #f1f1f1;
        color: #777;
    }

    /* ACTIONS */
    .am-actions {
        display: flex;
        align-items: center;
        justify-content: flex-end;
        gap: 8px;
        flex-wrap: wrap;
    }

    .am-actions form {
        margin: 0;
    }

    .am-btn {
        min-height: 42px;
        padding: 0 15px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        border-radius: 9px;
        border: 1px solid transparent;
        font-size: 12px;
        font-weight: 900;
        text-decoration: none;
        cursor: pointer;
        transition: .15s ease;
    }

    .am-btn-edit {
        background: #111;
        color: #fff;
        border-color: #e56262;
    }

    .am-btn-edit:hover {
        background: #333;
        color: #fff;
    }

    .am-btn-red {
        background: #c40000;
        color: #fff;
        border-color: #c40000;
    }

    .am-btn-red:hover {
        background: #a90000;
        color: #fff;
    }

    .am-btn-white {
        background: #fff;
        color: #222;
        border-color: #d2d2d2;
    }

    .am-btn-white:hover {
        background: #f2f2f2;
    }

    .am-btn-delete {
        background: #fff;
        color: #b00000;
        border-color: #ddb0b0;
    }

    .am-btn-delete:hover {
        background: #b00000;
        color: #fff;
        border-color: #b00000;
    }

    /* ALERTS */
    .am-alert {
        padding: 14px 16px;
        border-radius: 10px;
        margin-bottom: 20px;
        font-size: 13px;
        font-weight: 700;
    }

    .am-success {
        background: #edf9f1;
        color: #176b35;
        border: 1px solid #c9e8d1;
    }

    .am-error {
        background: #fff0f0;
        color: #9b0000;
        border: 1px solid #efc5c5;
    }

    /* LAYOUT */
    .am-content-grid {
        display: grid;
        grid-template-columns: minmax(0, 1.7fr) minmax(300px, .8fr);
        gap: 20px;
        align-items: start;
    }

    .am-card {
        background: #fff;
        border: 1px solid #e5e5e5;
        border-radius: 16px;
        overflow: hidden;
        margin-bottom: 20px;
        box-shadow: 0 4px 18px rgba(0, 0, 0, .04);
    }

    .am-card-header {
        padding: 18px 20px;
        border-bottom: 1px solid #eee;
    }

    .am-card-header h2 {
        margin: 0;
        font-size: 17px;
        font-weight: 900;
    }

    .am-card-header p {
        margin: 5px 0 0;
        color: #777;
        font-size: 12px;
    }

    .am-card-body {
        padding: 20px;
    }

    /* GALLERY */
    .am-gallery {
        background: #111;
    }

    .am-main-media {
        position: relative;
        height: 500px;
        background: #111;
        overflow: hidden;
    }

    .am-main-media img,
    .am-main-media video {
        width: 100%;
        height: 100%;
        display: block;
        object-fit: contain;
        background: #111;
    }

    .am-no-media {
        height: 100%;
        display: flex;
        align-items: center;
        justify-content: center;
        color: #999;
        font-size: 13px;
        font-weight: 700;
    }

    .am-media-type {
        position: absolute;
        top: 14px;
        left: 14px;
        z-index: 3;
        padding: 7px 10px;
        border-radius: 6px;
        background: rgba(0, 0, 0, .72);
        color: #fff;
        font-size: 9px;
        font-weight: 900;
        letter-spacing: .5px;
    }

    .am-fullscreen-btn {
        position: absolute;
        top: 14px;
        right: 14px;
        z-index: 3;
        width: 38px;
        height: 38px;
        border: 0;
        border-radius: 50%;
        background: #fff;
        color: #111;
        cursor: pointer;
        font-size: 16px;
        font-weight: 900;
    }

    .am-thumbnails {
        display: grid;
        grid-template-columns: repeat(6, 1fr);
        gap: 7px;
        padding: 10px;
        background: #111;
    }

    .am-thumb {
        position: relative;
        height: 70px;
        padding: 0;
        overflow: hidden;
        border: 2px solid transparent;
        border-radius: 7px;
        background: #222;
        cursor: pointer;
    }

    .am-thumb.active {
        border-color: #c40000;
    }

    .am-thumb img,
    .am-thumb video {
        width: 100%;
        height: 100%;
        object-fit: cover;
        display: block;
    }

    .am-thumb-video {
        position: absolute;
        inset: 0;
        display: flex;
        align-items: center;
        justify-content: center;
        background: rgba(0, 0, 0, .45);
        color: #fff;
        font-size: 10px;
        font-weight: 900;
    }

    .am-media-actions {
        padding: 10px;
        background: #111;
        display: flex;
        justify-content: flex-end;
    }

    .am-media-delete {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        padding: 7px 10px;
        border-radius: 7px;
        border: 1px solid #7d0000;
        background: #b00000;
        color: #fff;
        font-size: 10px;
        font-weight: 900;
        cursor: pointer;
    }
    .am-media-add {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        padding: 7px 10px;
        border-radius: 7px;
        border: 1px solid #7d0000;
        background: #fff;
        color: #121111;
        font-size: 10px;
        font-weight: 900;
        cursor: pointer;
    }

    /* SUMMARY */
    .am-summary {
        padding: 22px;
    }

    .am-price {
        margin-bottom: 7px;
        color: #c40000;
        font-size: 29px;
        font-weight: 900;
    }

    .am-summary-meta {
        display: flex;
        flex-wrap: wrap;
        gap: 8px;
        color: #666;
        font-size: 12px;
        font-weight: 700;
    }

    /* INFO GRID */
    .am-info-grid {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
    }

    .am-info-item {
        padding: 15px 18px;
        border-right: 1px solid #eee;
        border-bottom: 1px solid #eee;
    }

    .am-info-item:nth-child(even) {
        border-right: 0;
    }

    .am-info-label {
        display: block;
        margin-bottom: 5px;
        color: #888;
        font-size: 9px;
        font-weight: 900;
        text-transform: uppercase;
        letter-spacing: .4px;
    }

    .am-info-value {
        color: #222;
        font-size: 13px;
        font-weight: 800;
        word-break: break-word;
    }

    /* DESCRIPTION */
    .am-description {
        color: #444;
        font-size: 14px;
        line-height: 1.7;
        white-space: pre-line;
    }

    /* VIN */
    .am-vin {
        font-family: monospace;
        font-size: 17px;
        font-weight: 900;
        letter-spacing: 1px;
        word-break: break-all;
    }

    .am-vin-note {
        margin-top: 12px;
        color: #777;
        font-size: 11px;
        line-height: 1.6;
    }

    /* HISTORY */
    .am-history-box {
        padding: 15px;
        border: 1px solid #e2e2e2;
        border-radius: 10px;
    }

    .am-history-title {
        font-size: 12px;
        font-weight: 900;
    }

    .am-history-description {
        margin-top: 6px;
        color: #777;
        font-size: 11px;
        line-height: 1.6;
    }

    /* UPLOAD */
    .am-upload-box {
        padding: 20px;
        border: 1px dashed #ccc;
        border-radius: 12px;
        background: #fafafa;
    }

    .am-upload-group {
        margin-bottom: 18px;
    }

    .am-upload-group:last-child {
        margin-bottom: 0;
    }

    .am-upload-label {
        display: block;
        margin-bottom: 7px;
        font-size: 12px;
        font-weight: 900;
    }

    .am-upload-input {
        width: 100%;
        padding: 9px;
        border: 1px solid #ddd;
        border-radius: 8px;
        background: #fff;
        font-size: 12px;
    }

    .am-upload-help {
        margin-top: 6px;
        color: #888;
        font-size: 10px;
    }

    /* DANGER */
    .am-danger-text {
        margin: 0 0 15px;
        color: #777;
        font-size: 11px;
        line-height: 1.6;
    }

    /* VIEWER */
    .am-viewer {
        position: fixed;
        inset: 0;
        z-index: 99999;
        display: none;
        align-items: center;
        justify-content: center;
        padding: 30px;
        background: rgba(0, 0, 0, .96);
    }

    .am-viewer.open {
        display: flex;
    }

    .am-viewer-content {
        width: 100%;
        height: 100%;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .am-viewer-content img,
    .am-viewer-content video {
        max-width: 90vw;
        max-height: 88vh;
        object-fit: contain;
    }

    .am-viewer-close,
    .am-viewer-prev,
    .am-viewer-next {
        position: absolute;
        z-index: 2;
        width: 44px;
        height: 44px;
        border: 0;
        border-radius: 50%;
        background: #fff;
        color: #111;
        cursor: pointer;
        font-size: 18px;
        font-weight: 900;
    }

    .am-viewer-close {
        top: 18px;
        right: 20px;
    }

    .am-viewer-prev {
        left: 20px;
        top: 50%;
        transform: translateY(-50%);
    }

    .am-viewer-next {
        right: 20px;
        top: 50%;
        transform: translateY(-50%);
    }

    .am-viewer-count {
        position: absolute;
        bottom: 20px;
        left: 50%;
        transform: translateX(-50%);
        padding: 7px 11px;
        border-radius: 999px;
        background: rgba(0, 0, 0, .65);
        color: #fff;
        font-size: 11px;
        font-weight: 800;
    }

    /* =========================================================
       POLISHED RED / BLACK / WHITE OVERRIDES
    ========================================================= */

    .am-show-page {
        background:
            radial-gradient(circle at top right, rgba(196, 0, 0, .06), transparent 28%),
            #f4f5f7;
        padding-top: 28px;
    }

    .am-show-container {
        max-width: 1320px;
    }

    .am-show-header {
        padding: 24px 26px;
        margin-bottom: 22px;
        border: 1px solid #e3e5e8;
        border-radius: 18px;
        background: #fff;
        box-shadow: 0 10px 30px rgba(17, 17, 17, .05);
        position: relative;
        overflow: hidden;
    }

    .am-show-header::before {
        content: '';
        position: absolute;
        left: 0;
        top: 0;
        bottom: 0;
        width: 5px;
        background: #c40000;
    }

    .am-back-link {
        display: inline-flex;
        align-items: center;
        gap: 7px;
        margin-bottom: 13px;
        color: #777;
    }

    .am-back-link::before {
        content: '←';
        font-size: 16px;
        line-height: 1;
        color: #c40000;
    }

    .am-title {
        font-size: clamp(27px, 3vw, 38px);
    }

    .am-subtitle {
        max-width: 720px;
        font-size: 13px;
    }

    .am-status {
        border: 1px solid transparent;
        letter-spacing: .4px;
    }

    .am-status-active {
        background: #edf9f1;
        color: #17713a;
        border-color: #c9e8d1;
    }

    .am-status-sold {
        background: #f1f1f1;
        color: #555;
        border-color: #ddd;
    }

    .am-status-archived {
        background: #fff7e8;
        color: #9a6500;
        border-color: #efd59c;
    }

    .am-actions {
        max-width: 520px;
    }

    .am-actions form,
    .am-actions a {
        flex: 0 0 auto;
    }

    .am-btn {
        min-height: 44px;
        padding: 0 17px;
        border-radius: 10px;
        box-shadow: none;
    }

    .am-btn-edit {
        background: #111;
        border-color: #111;
    }

    .am-btn-edit:hover {
        background: #2b2b2b;
    }

    .am-btn-red:hover {
        transform: translateY(-1px);
    }

    .am-card {
        border-color: #e1e4e8;
        border-radius: 17px;
        box-shadow: 0 8px 24px rgba(17, 17, 17, .045);
    }

    .am-card-header {
        padding: 19px 21px;
        background: linear-gradient(to bottom, #fff, #fcfcfc);
    }

    .am-card-header h2 {
        font-size: 16px;
    }

    .am-gallery {
        background: #090909;
    }

    .am-main-media {
        height: min(57vw, 540px);
        min-height: 340px;
        background: #090909;
    }

    .am-main-media img,
    .am-main-media video {
        object-fit: contain;
    }

    .am-fullscreen-btn {
        width: 42px;
        height: 42px;
        border: 1px solid rgba(255,255,255,.8);
        box-shadow: 0 4px 14px rgba(0,0,0,.24);
    }

    .am-thumbnails {
        padding: 12px;
        gap: 8px;
    }

    .am-thumb {
        border-radius: 9px;
    }

    .am-summary {
        padding: 24px;
    }

    .am-price {
        font-size: clamp(28px, 3vw, 36px);
        letter-spacing: -.5px;
    }

    .am-summary-meta {
        gap: 7px;
    }

    .am-info-grid {
        background: #eee;
        gap: 1px;
    }

    .am-info-item {
        background: #fff;
        border: 0;
        min-height: 77px;
    }

    .am-info-label {
        color: #8b8f96;
    }

    .am-info-value {
        font-size: 13px;
    }

    .am-vin-row {
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .am-vin {
        flex: 1;
        min-width: 0;
        padding: 13px 14px;
        border: 1px solid #e0e0e0;
        border-radius: 10px;
        background: #fafafa;
    }

    .am-copy-btn {
        flex: 0 0 auto;
        min-height: 44px;
        padding: 0 13px;
        border: 1px solid #111;
        border-radius: 10px;
        background: #111;
        color: #fff;
        font-size: 11px;
        font-weight: 900;
        cursor: pointer;
        transition: .15s ease;
    }

    .am-copy-btn:hover {
        background: #c40000;
        border-color: #c40000;
    }

    .am-upload-box {
        border-color: #d9d9d9;
        background: #fbfbfb;
    }

    .am-upload-input:focus,
    .am-btn:focus-visible,
    .am-copy-btn:focus-visible,
    .am-thumb:focus-visible,
    .am-fullscreen-btn:focus-visible {
        outline: 3px solid rgba(196, 0, 0, .17);
        outline-offset: 2px;
    }

    @media (max-width: 950px) {
        .am-show-header {
            padding: 21px;
        }
    }

    /* MOBILE */
    @media (max-width: 950px) {
        .am-content-grid {
            grid-template-columns: 1fr;
        }

        .am-show-header {
            flex-direction: column;
        }

        .am-actions {
            justify-content: flex-start;
        }
    }

    @media (max-width: 650px) {
        .am-show-page {
            padding: 20px 12px 45px;
        }

        .am-title {
            font-size: 25px;
        }

        .am-main-media {
            height: 330px;
        }

        .am-thumbnails {
            grid-template-columns: repeat(4, 1fr);
        }

        .am-thumb {
            height: 62px;
        }

        .am-info-grid {
            grid-template-columns: 1fr;
        }

        .am-info-item {
            border-right: 0;
        }

        .am-actions {
            width: 100%;
        }

        .am-vin-row {
            align-items: stretch;
            flex-direction: column;
        }

        .am-copy-btn {
            width: 100%;
        }

        .am-actions form,
        .am-actions a,
        .am-actions button {
            width: 100%;
        }

        .am-btn {
            width: 100%;
        }

        .am-viewer {
            padding: 10px;
        }

        .am-viewer-prev {
            left: 8px;
        }

        .am-viewer-next {
            right: 8px;
        }
    }
</style>

<div class="am-show-page">
    <div class="am-show-container">

        <!-- HEADER -->
        <div class="am-show-header">
            <div>
                <a
                    href="{{ route('vehicles.index') }}"
                    class="am-back-link"
                >
                    Back to My Vehicles
                </a>

                <div class="am-title-row">
                    <h1 class="am-title">
                        {{ $vehicle->year }}
                        {{ $vehicle->make }}
                        {{ $vehicle->model }}
                    </h1>

                    <span class="am-status {{ $statusClass }}">
                        {{ ucfirst($vehicle->status ?: 'active') }}
                    </span>
                </div>

                <p class="am-subtitle">
                    Vehicle listing and management
                </p>
            </div>

            <!-- ACTION BUTTONS -->
            <div class="am-actions">

                <a
                    href="{{ route('vehicles.edit', $vehicle) }}"
                    class="am-btn am-btn-edit"
                >
                    Edit Vehicle
                </a>

                @if ($vehicle->status === 'active')

                    <form
                        method="POST"
                        action="{{ route('vehicles.sold', $vehicle) }}"
                    >
                        @csrf
                        @method('PATCH')

                        <button
                            type="submit"
                            class="am-btn am-btn-red"
                            onclick="return confirm('Mark this vehicle as sold?');"
                        >
                            Mark Sold
                        </button>
                    </form>

                    <form
                        method="POST"
                        action="{{ route('vehicles.archive', $vehicle) }}"
                    >
                        @csrf
                        @method('PATCH')

                        <button
                            type="submit"
                            class="am-btn am-btn-white"
                            onclick="return confirm('Archive this vehicle?');"
                        >
                            Archive
                        </button>
                    </form>

                @elseif ($vehicle->status === 'sold')

                    <form
                        method="POST"
                        action="{{ route('vehicles.archive', $vehicle) }}"
                    >
                        @csrf
                        @method('PATCH')

                        <button
                            type="submit"
                            class="am-btn am-btn-white"
                            onclick="return confirm('Archive this sold vehicle?');"
                        >
                            Archive
                        </button>
                    </form>

                @elseif ($vehicle->status === 'archived')

                    <form
                        method="POST"
                        action="{{ route('vehicles.restore', $vehicle) }}"
                    >
                        @csrf
                        @method('PATCH')

                        <button
                            type="submit"
                            class="am-btn am-btn-red"
                            onclick="return confirm('Re-list this vehicle?');"
                        >
                            Re-list Vehicle
                        </button>
                    </form>

                @endif

            </div>
        </div>

        <!-- ALERTS -->
        @if (session('success'))
            <div class="am-alert am-success">
                {{ session('success') }}
            </div>
        @endif

        @if ($errors->any())
            <div class="am-alert am-error">
                {{ $errors->first() }}
            </div>
        @endif

        <!-- MAIN CONTENT -->
        <div class="am-content-grid">

            <!-- LEFT COLUMN -->
            <div>

                <!-- GALLERY -->
                <div class="am-card">
                    <div class="am-gallery">

                        <div
                            class="am-main-media"
                            id="amMainMedia"
                        >

                            @if ($allMedia->count() > 0)

                                @php
                                    $firstMedia = $allMedia->first();
                                @endphp

                                @if ($firstMedia->type === 'photo')

                                    <img
                                        id="amMainImage"
                                        src="{{ asset('storage/' . $firstMedia->file_path) }}"
                                        alt="{{ $vehicle->make }} {{ $vehicle->model }}"
                                    >

                                @elseif ($firstMedia->type === 'video')

                                    <video
                                        id="amMainVideo"
                                        controls
                                        preload="metadata"
                                    >
                                        <source
                                            src="{{ asset('storage/' . $firstMedia->file_path) }}"
                                        >
                                    </video>

                                @endif

                                <span
                                    class="am-media-type"
                                    id="amMediaType"
                                >
                                    {{ strtoupper($firstMedia->type) }}
                                </span>

                                <button
                                    type="button"
                                    class="am-fullscreen-btn"
                                    onclick="openViewer(0)"
                                >
                                    Full
                                </button>

                                @if ($allMedia->count() > 1)

                                    <button
                                        type="button"
                                        id="amGalleryPrev"
                                        onclick="previousGalleryMedia()"
                                        aria-label="Previous media"
                                        style="position:absolute;left:14px;top:50%;transform:translateY(-50%);z-index:4;width:42px;height:42px;border:0;border-radius:50%;background:#fff;color:#111;cursor:pointer;font-size:22px;font-weight:900;box-shadow:0 4px 14px rgba(0,0,0,.24);"
                                    >
                                        &lt;
                                    </button>

                                    <button
                                        type="button"
                                        id="amGalleryNext"
                                        onclick="nextGalleryMedia()"
                                        aria-label="Next media"
                                        style="position:absolute;right:14px;top:50%;transform:translateY(-50%);z-index:4;width:42px;height:42px;border:0;border-radius:50%;background:#fff;color:#111;cursor:pointer;font-size:22px;font-weight:900;box-shadow:0 4px 14px rgba(0,0,0,.24);"
                                    >
                                        &gt;
                                    </button>

                                @endif

                            @else

                                <div class="am-no-media">
                                    No vehicle media uploaded yet.
                                </div>

                            @endif

                        </div>

                        @if ($allMedia->count() > 0)

                            <div
                                style="display:flex;align-items:center;justify-content:center;padding:8px 10px;background:#111;color:#fff;font-size:11px;font-weight:800;"
                            >
                                <span id="amGalleryCount">
                                    1 / {{ $allMedia->count() }}
                                </span>
                            </div>

                            <div class="am-thumbnails">

                                @foreach ($allMedia as $index => $media)

                                    <button
                                        type="button"
                                        class="am-thumb {{ $index === 0 ? 'active' : '' }}"
                                        data-index="{{ $index }}"
                                        onclick="changeMedia({{ $index }})"
                                    >

                                        @if ($media->type === 'photo')

                                            <img
                                                src="{{ asset('storage/' . $media->file_path) }}"
                                                alt="Vehicle photo"
                                            >

                                        @elseif ($media->type === 'video')

                                            <video
                                                src="{{ asset('storage/' . $media->file_path) }}"
                                                muted
                                                preload="metadata"
                                            ></video>

                                            <span class="am-thumb-video">
                                                VIDEO
                                            </span>

                                        @endif

                                    </button>

                                @endforeach

                            </div>

                            <!-- Individual media delete -->
                            <div class="am-media-actions">

                                @php
                                    $firstMediaId = $allMedia->first()->id;
                                @endphp

                                <form
                                    method="POST"
                                    action="{{ route('vehicles.media.destroy', $firstMediaId) }}"
                                    data-route-template="{{ route('vehicles.media.destroy', ['media' => '__MEDIA_ID__']) }}"
                                    id="amMediaDeleteForm"
                                >
                                    @csrf
                                    @method('DELETE')

                                    <button
                                        type="submit"
                                        class="am-media-delete"
                                        id="amDeleteMediaButton"
                                >
                                        Delete Current Media
                                    </button>
                                   <button
                                       type="button"
                                        class="am-media-add"
                                        id="amAddPhotoButton"
                                        >
                                        Add Photo
                                     </button>
                                </form>

                            </div>

                        @endif

                    </div>
                </div>

                <!-- PRICE SUMMARY -->
                <div class="am-card">
                    <div class="am-summary">

                        @if ($vehicle->price !== null)

                            <div class="am-price">
                                ₦{{ number_format((float) $vehicle->price, 2) }}
                            </div>

                        @else

                            <div class="am-price">
                                Price on Request
                            </div>

                        @endif

                        <div class="am-summary-meta">
                            <span>{{ $vehicle->year }}</span>
                            <span>|</span>
                            <span>{{ $vehicle->make }}</span>
                            <span>|</span>
                            <span>{{ $vehicle->model }}</span>

                            @if ($vehicle->mileage !== null)
                                <span>|</span>
                                <span>
                                    {{ number_format($vehicle->mileage) }} km
                                </span>
                            @endif
                        </div>

                    </div>
                </div>

                <!-- VEHICLE INFORMATION -->
                <div class="am-card">

                    <div class="am-card-header">
                        <h2>
                            Vehicle Information
                        </h2>

                        <p>
                            Detailed information about this vehicle.
                        </p>
                    </div>

                    <div class="am-info-grid">

                        <div class="am-info-item">
                            <span class="am-info-label">Make</span>
                            <span class="am-info-value">
                                {{ $vehicle->make ?: 'Not provided' }}
                            </span>
                        </div>

                        <div class="am-info-item">
                            <span class="am-info-label">Model</span>
                            <span class="am-info-value">
                                {{ $vehicle->model ?: 'Not provided' }}
                            </span>
                        </div>

                        <div class="am-info-item">
                            <span class="am-info-label">Year</span>
                            <span class="am-info-value">
                                {{ $vehicle->year ?: 'Not provided' }}
                            </span>
                        </div>

                        <div class="am-info-item">
                            <span class="am-info-label">Trim</span>
                            <span class="am-info-value">
                                {{ $vehicle->trim ?: 'Not provided' }}
                            </span>
                        </div>

                        <div class="am-info-item">
                            <span class="am-info-label">Body Type</span>
                            <span class="am-info-value">
                                {{ $vehicle->body_type ?: 'Not provided' }}
                            </span>
                        </div>

                        <div class="am-info-item">
                            <span class="am-info-label">Color</span>
                            <span class="am-info-value">
                                {{ $vehicle->color ?: 'Not provided' }}
                            </span>
                        </div>

                        <div class="am-info-item">
                            <span class="am-info-label">Engine</span>
                            <span class="am-info-value">
                                {{ $vehicle->engine ?: 'Not provided' }}
                            </span>
                        </div>

                        <div class="am-info-item">
                            <span class="am-info-label">Transmission</span>
                            <span class="am-info-value">
                                {{ $vehicle->transmission ?: 'Not provided' }}
                            </span>
                        </div>

                        <div class="am-info-item">
                            <span class="am-info-label">Fuel Type</span>
                            <span class="am-info-value">
                                {{ $vehicle->fuel_type ?: 'Not provided' }}
                            </span>
                        </div>

                        <div class="am-info-item">
                            <span class="am-info-label">Drivetrain</span>
                            <span class="am-info-value">
                                {{ $vehicle->drivetrain ?: 'Not provided' }}
                            </span>
                        </div>

                        <div class="am-info-item">
                            <span class="am-info-label">Mileage</span>
                            <span class="am-info-value">

                                @if ($vehicle->mileage !== null)
                                    {{ number_format($vehicle->mileage) }} km
                                @else
                                    Not provided
                                @endif

                            </span>
                        </div>

                        <div class="am-info-item">
                            <span class="am-info-label">Location</span>

                            <span class="am-info-value">
                                {{
                                    collect([
                                        $vehicle->city,
                                        $vehicle->state,
                                        $vehicle->country
                                    ])->filter()->implode(', ')
                                    ?: 'Not provided'
                                }}
                            </span>
                        </div>

                    </div>
                </div>

                <!-- DESCRIPTION -->
                @if ($vehicle->description)

                    <div class="am-card">

                        <div class="am-card-header">
                            <h2>Description</h2>
                        </div>

                        <div class="am-card-body">

                            <div class="am-description">
                                {{ $vehicle->description }}
                            </div>

                        </div>

                    </div>

                @endif

                <!-- MEDIA UPLOAD -->
                <div class="am-card">

                    <div class="am-card-header">

                        <h2>
                            Vehicle Media
                        </h2>

                        <p>
                            Add photos and one vehicle video.
                        </p>

                    </div>

                    <div class="am-card-body">

                        <form
                            method="POST"
                            action="{{ route('vehicles.media.store', $vehicle) }}"
                            enctype="multipart/form-data"
                            id="amMediaUploadForm"
                        >

                            @csrf

                            <div class="am-upload-box">

                                <div class="am-upload-group">

                                    <label
                                        class="am-upload-label"
                                        for="photos"
                                    >
                                        Add Photos
                                    </label>

                                    <input
                                        id="photos"
                                        class="am-upload-input"
                                        type="file"
                                        name="photos[]"
                                        accept="image/jpeg,image/png,image/webp"
                                        multiple
                                    >

                                    <div class="am-upload-help">
                                        JPG, JPEG, PNG or WEBP. Maximum 25 photos total. You can select up to 5 photos at once. Maximum 5MB per photo.
                                    </div>

                                    <div
                                        class="am-upload-help"
                                        id="amPhotoCounter"
                                        style="font-weight:900;color:#222;"
                                    >
                                        {{ $photos->count() }} / 25 photos uploaded. {{ max(0, 25 - $photos->count()) }} slots remaining.
                                    </div>

                                    <div
                                        class="am-upload-help"
                                        id="amSelectedPhotos"
                                        style="font-weight:900;color:#c40000;"
                                    ></div>

                                </div>

                                <div class="am-upload-group">

                                    <label
                                        class="am-upload-label"
                                        for="video"
                                    >
                                        Add Video
                                    </label>

                                    <input
                                        id="video"
                                        class="am-upload-input"
                                        type="file"
                                        name="video"
                                        accept="video/mp4,video/quicktime,video/webm"
                                    >

                                    <div class="am-upload-help">
                                        MP4, MOV or WEBM. Maximum 1 video and 50MB.
                                    </div>

                                </div>

                                <button
                                    type="submit"
                                    class="am-btn am-btn-red"
                                    id="amUploadButton"
                                >
                                    Upload Media
                                </button>

                            </div>

                        </form>

                    </div>
                </div>

            </div>

            <!-- RIGHT COLUMN -->
            <div>

                <!-- VIN -->
                <div class="am-card">

                    <div class="am-card-header">

                        <h2>
                            VIN
                        </h2>

                        <p>
                            Vehicle identification number.
                        </p>

                    </div>

                    <div class="am-card-body">

                        <div class="am-vin-row">

                            <div class="am-vin">
                                {{ $vehicle->vin ?: 'VIN not provided' }}
                            </div>

                            @if ($vehicle->vin)

                                <button
                                    type="button"
                                    class="am-copy-btn"
                                    onclick="copyVehicleVin()"
                                >
                                    Copy VIN
                                </button>

                            @endif

                        </div>

                        <div style="margin-top:12px;">

                            @if ($vehicle->vin && $vehicle->vin_status === 'valid')

                                <span class="am-status">
                                    VIN Valid
                                </span>

                            @elseif ($vehicle->vin_status === 'invalid')

                                <span
                                    class="am-status"
                                    style="background:#fff0f0;color:#a00000;"
                                >
                                    VIN Invalid
                                </span>

                            @else

                                <span
                                    class="am-status"
                                    style="background:#f1f1f1;color:#666;"
                                >
                                    VIN Pending
                                </span>

                            @endif

                        </div>

                        <div class="am-vin-note">
                            A valid VIN check digit confirms the VIN structure.
                            It does not confirm accident history, theft history,
                            ownership history or title condition.
                        </div>

                    </div>

                </div>

                <!-- HISTORY -->
                <div class="am-card">

                    <div class="am-card-header">

                        <h2>
                            Vehicle History
                        </h2>

                        <p>
                            History check status.
                        </p>

                    </div>

                    <div class="am-card-body">

                        <div class="am-history-box">

                            @if ($vehicle->history_checked)

                                <div
                                    class="am-history-title"
                                    style="color:#17713a;"
                                >
                                    History Checked
                                </div>

                                <div class="am-history-description">
                                    A vehicle history check has been performed.
                                </div>

                            @else

                                <div
                                    class="am-history-title"
                                    style="color:#777;"
                                >
                                    History Not Checked
                                </div>

                                <div class="am-history-description">
                                    A full vehicle history report has not been
                                    performed for this vehicle yet.
                                </div>

                            @endif

                        </div>

                    </div>

                </div>

                <!-- LISTING DETAILS -->
                <div class="am-card">

                    <div class="am-card-header">

                        <h2>
                            Listing Details
                        </h2>

                    </div>

                    <div class="am-info-grid">

                        <div class="am-info-item">

                            <span class="am-info-label">
                                Status
                            </span>

                            <span class="am-info-value">
                                {{ ucfirst($vehicle->status) }}
                            </span>

                        </div>

                        <div class="am-info-item">

                            <span class="am-info-label">
                                Photos
                            </span>

                            <span
                                class="am-info-value"
                                data-listing-photo-count
                            >
                                {{ $photos->count() }} / 25
                            </span>

                        </div>

                        <div class="am-info-item">

                            <span class="am-info-label">
                                Video
                            </span>

                            <span
                                class="am-info-value"
                                data-listing-video-count
                            >
                                {{ $videos->count() }} / 1
                            </span>

                        </div>

                        <div class="am-info-item">

                            <span class="am-info-label">
                                Listed
                            </span>

                            <span class="am-info-value">
                                {{ $vehicle->created_at->format('M d, Y') }}
                            </span>

                        </div>

                        <div class="am-info-item">

                            <span class="am-info-label">
                                Updated
                            </span>

                            <span class="am-info-value">
                                {{ $vehicle->updated_at->format('M d, Y') }}
                            </span>

                        </div>

                    </div>

                </div>

                <!-- DELETE -->
                <div class="am-card">

                    <div class="am-card-header">

                        <h2>
                            Vehicle Management
                        </h2>

                        <p>
                            Permanent actions
                        </p>

                    </div>

                    <div class="am-card-body">

                        <p class="am-danger-text">
                            Permanently deleting this vehicle will remove the
                            listing and all photos and videos belonging to it.
                            This action cannot be undone.
                        </p>

                        <form
                            method="POST"
                            action="{{ route('vehicles.destroy', $vehicle) }}"
                        >

                            @csrf
                            @method('DELETE')

                            <button
                                type="submit"
                                class="am-btn am-btn-delete"
                                style="width:100%;"
                                onclick="return confirm('PERMANENTLY DELETE this vehicle and all of its media? This cannot be undone.');"
                            >
                                Permanently Delete Vehicle
                            </button>

                        </form>

                    </div>

                </div>

            </div>

        </div>

    </div>
</div>

<!-- FULLSCREEN VIEWER -->
<div
    id="amViewer"
    class="am-viewer"
>

    <button
        type="button"
        class="am-viewer-close"
        onclick="closeViewer()"
    >
        X
    </button>

    <button
        type="button"
        class="am-viewer-prev"
        onclick="previousMedia()"
    >
        &lt;
    </button>

    <div
        id="amViewerContent"
        class="am-viewer-content"
    ></div>

    <button
        type="button"
        class="am-viewer-next"
        onclick="nextMedia()"
    >
        &gt;
    </button>

    <div
        id="amViewerCount"
        class="am-viewer-count"
    ></div>

</div>

<script>
    /*
    |--------------------------------------------------------------------------
    | MEDIA DATA
    |--------------------------------------------------------------------------
    */

    const mediaItems = [];

    @foreach ($allMedia as $media)
        mediaItems.push({
            id: @json($media->id),
            type: @json($media->type),
            url: @json(asset('storage/' . $media->file_path))
        });
    @endforeach

    const maxPhotos = 25;
    const maxPhotosPerUpload = 5;

    let currentMediaIndex = 0;


    /*
    |--------------------------------------------------------------------------
    | HELPERS
    |--------------------------------------------------------------------------
    */

    function getPhotoCount() {
        return mediaItems.filter(function (media) {
            return media.type === 'photo';
        }).length;
    }


    function getVideoCount() {
        return mediaItems.filter(function (media) {
            return media.type === 'video';
        }).length;
    }


    function updatePhotoCounter() {

        const photoCount = getPhotoCount();

        const counter =
            document.getElementById('amPhotoCounter');

        if (counter) {

            counter.textContent =
                photoCount +
                ' / 25 photos uploaded. ' +
                Math.max(0, 25 - photoCount) +
                ' slots remaining.';
        }

        const listingPhotoCount =
            document.querySelector(
                '[data-listing-photo-count]'
            );

        if (listingPhotoCount) {
            listingPhotoCount.textContent =
                photoCount + ' / 25';
        }

        const listingVideoCount =
            document.querySelector(
                '[data-listing-video-count]'
            );

        if (listingVideoCount) {
            listingVideoCount.textContent =
                getVideoCount() + ' / 1';
        }
    }


    function updateGalleryCounter() {

        const counter =
            document.getElementById('amGalleryCount');

        if (!counter) {
            return;
        }

        if (!mediaItems.length) {

            counter.textContent = '0 / 0';

            return;
        }

        counter.textContent =
            (currentMediaIndex + 1) +
            ' / ' +
            mediaItems.length;
    }


    /*
    |--------------------------------------------------------------------------
    | DELETE ROUTE
    |--------------------------------------------------------------------------
    |
    | IMPORTANT:
    | Laravel creates the correct route here.
    | We do NOT manually create /vehicle-media/{id}.
    |
    */

    function getDeleteUrl(mediaId) {

        const deleteForm =
            document.getElementById('amMediaDeleteForm');

        if (!deleteForm) {
            return null;
        }

        const template =
            deleteForm.dataset.routeTemplate;

        if (!template) {
            return null;
        }

        return template.replace(
            '__MEDIA_ID__',
            encodeURIComponent(mediaId)
        );
    }


    function updateMediaDeleteForm() {

        const deleteForm =
            document.getElementById('amMediaDeleteForm');

        const deleteButton =
            document.getElementById('amDeleteMediaButton');

        if (!deleteForm) {
            return;
        }

        const currentMedia =
            mediaItems[currentMediaIndex];

        if (!currentMedia) {

            deleteForm.style.display = 'none';

            return;
        }

        deleteForm.style.display = '';

        const deleteUrl =
            getDeleteUrl(currentMedia.id);

        if (deleteUrl) {
            deleteForm.action = deleteUrl;
        }

        if (deleteButton) {
            deleteButton.disabled = false;
            deleteButton.textContent =
                'Delete Current Media';
        }
    }


    /*
    |--------------------------------------------------------------------------
    | MAIN GALLERY
    |--------------------------------------------------------------------------
    */

    function renderMainGallery() {

        const mainMedia =
            document.getElementById('amMainMedia');

        if (!mainMedia) {
            return;
        }

        if (!mediaItems.length) {

            mainMedia.innerHTML = `
                <div class="am-no-media">
                    No vehicle media uploaded yet.
                </div>
            `;

            const thumbnails =
                document.querySelector('.am-thumbnails');

            if (thumbnails) {
                thumbnails.innerHTML = '';
            }

            const actions =
                document.querySelector('.am-media-actions');

            if (actions) {
                actions.style.display = 'none';
            }

            updateGalleryCounter();
            updateMediaDeleteForm();

            return;
        }

        const actions =
            document.querySelector('.am-media-actions');

        if (actions) {
            actions.style.display = '';
        }

        if (currentMediaIndex >= mediaItems.length) {

            currentMediaIndex =
                mediaItems.length - 1;
        }

        if (currentMediaIndex < 0) {
            currentMediaIndex = 0;
        }

        const media =
            mediaItems[currentMediaIndex];

        mainMedia.innerHTML = '';

        /*
        | MEDIA TYPE LABEL
        */

        const label =
            document.createElement('span');

        label.className = 'am-media-type';
        label.id = 'amMediaType';
        label.textContent =
            media.type.toUpperCase();

        mainMedia.appendChild(label);


        /*
        | FULLSCREEN BUTTON
        */

        const fullscreen =
            document.createElement('button');

        fullscreen.type = 'button';
        fullscreen.className =
            'am-fullscreen-btn';

        fullscreen.textContent = 'Full';

        fullscreen.onclick = function () {
            openViewer(currentMediaIndex);
        };

        mainMedia.appendChild(fullscreen);


        /*
        | PREVIOUS BUTTON
        */

        if (mediaItems.length > 1) {

            const previousButton =
                document.createElement('button');

            previousButton.type = 'button';

            previousButton.setAttribute(
                'aria-label',
                'Previous media'
            );

            previousButton.innerHTML = '&lt;';

            previousButton.style.cssText =
                'position:absolute;' +
                'left:14px;' +
                'top:50%;' +
                'transform:translateY(-50%);' +
                'z-index:4;' +
                'width:42px;' +
                'height:42px;' +
                'border:0;' +
                'border-radius:50%;' +
                'background:#fff;' +
                'color:#111;' +
                'cursor:pointer;' +
                'font-size:22px;' +
                'font-weight:900;' +
                'box-shadow:0 4px 14px rgba(0,0,0,.24);';

            previousButton.onclick =
                previousGalleryMedia;

            mainMedia.appendChild(previousButton);


            /*
            | NEXT BUTTON
            */

            const nextButton =
                document.createElement('button');

            nextButton.type = 'button';

            nextButton.setAttribute(
                'aria-label',
                'Next media'
            );

            nextButton.innerHTML = '&gt;';

            nextButton.style.cssText =
                'position:absolute;' +
                'right:14px;' +
                'top:50%;' +
                'transform:translateY(-50%);' +
                'z-index:4;' +
                'width:42px;' +
                'height:42px;' +
                'border:0;' +
                'border-radius:50%;' +
                'background:#fff;' +
                'color:#111;' +
                'cursor:pointer;' +
                'font-size:22px;' +
                'font-weight:900;' +
                'box-shadow:0 4px 14px rgba(0,0,0,.24);';

            nextButton.onclick =
                nextGalleryMedia;

            mainMedia.appendChild(nextButton);
        }


        /*
        | PHOTO
        */

        if (media.type === 'photo') {

            const image =
                document.createElement('img');

            image.src = media.url;

            image.alt =
                @json($vehicle->make . ' ' . $vehicle->model);

            mainMedia.appendChild(image);
        }


        /*
        | VIDEO
        */

        else if (media.type === 'video') {

            const video =
                document.createElement('video');

            video.controls = true;
            video.preload = 'metadata';

            const source =
                document.createElement('source');

            source.src = media.url;

            video.appendChild(source);

            mainMedia.appendChild(video);
        }

        renderThumbnails();
        updateMediaDeleteForm();
        updateGalleryCounter();
    }


    /*
    |--------------------------------------------------------------------------
    | THUMBNAILS
    |--------------------------------------------------------------------------
    */

    function renderThumbnails() {

        const thumbnailContainer =
            document.querySelector('.am-thumbnails');

        if (!thumbnailContainer) {
            return;
        }

        thumbnailContainer.innerHTML = '';

        mediaItems.forEach(function (media, index) {

            const button =
                document.createElement('button');

            button.type = 'button';

            button.className =
                'am-thumb' +
                (
                    index === currentMediaIndex
                        ? ' active'
                        : ''
                );

            button.dataset.index = index;

            button.onclick = function () {
                changeMedia(index);
            };


            if (media.type === 'photo') {

                const image =
                    document.createElement('img');

                image.src = media.url;
                image.alt = 'Vehicle photo';

                button.appendChild(image);

            } else {

                const video =
                    document.createElement('video');

                video.src = media.url;
                video.muted = true;
                video.preload = 'metadata';

                button.appendChild(video);

                const videoLabel =
                    document.createElement('span');

                videoLabel.className =
                    'am-thumb-video';

                videoLabel.textContent =
                    'VIDEO';

                button.appendChild(videoLabel);
            }

            thumbnailContainer.appendChild(button);
        });
    }


    /*
    |--------------------------------------------------------------------------
    | CHANGE MEDIA
    |--------------------------------------------------------------------------
    */

    function changeMedia(index) {

        if (!mediaItems[index]) {
            return;
        }

        currentMediaIndex = index;

        renderMainGallery();

        const activeThumb =
            document.querySelector(
                '.am-thumb[data-index="' +
                index +
                '"]'
            );

        if (activeThumb) {

            activeThumb.scrollIntoView({
                behavior: 'smooth',
                block: 'nearest',
                inline: 'nearest'
            });
        }
    }


    function previousGalleryMedia() {

        if (!mediaItems.length) {
            return;
        }

        currentMediaIndex =
            (
                currentMediaIndex -
                1 +
                mediaItems.length
            ) %
            mediaItems.length;

        renderMainGallery();
    }


    function nextGalleryMedia() {

        if (!mediaItems.length) {
            return;
        }

        currentMediaIndex =
            (
                currentMediaIndex +
                1
            ) %
            mediaItems.length;

        renderMainGallery();
    }


    /*
    |--------------------------------------------------------------------------
    | FULLSCREEN VIEWER
    |--------------------------------------------------------------------------
    */

    function openViewer(index) {

        if (!mediaItems.length) {
            return;
        }

        currentMediaIndex = index;

        renderViewer();

        document
            .getElementById('amViewer')
            .classList.add('open');

        document.body.style.overflow = 'hidden';
    }


    function closeViewer() {

        const viewer =
            document.getElementById('amViewer');

        if (viewer) {
            viewer.classList.remove('open');
        }

        document.body.style.overflow = '';
    }


    function renderViewer() {

        if (!mediaItems[currentMediaIndex]) {
            return;
        }

        const media =
            mediaItems[currentMediaIndex];

        const content =
            document.getElementById(
                'amViewerContent'
            );

        const count =
            document.getElementById(
                'amViewerCount'
            );

        if (!content || !count) {
            return;
        }

        content.innerHTML = '';


        if (media.type === 'photo') {

            const image =
                document.createElement('img');

            image.src = media.url;

            image.alt =
                @json($vehicle->make . ' ' . $vehicle->model);

            content.appendChild(image);

        } else if (media.type === 'video') {

            const video =
                document.createElement('video');

            video.controls = true;
            video.autoplay = true;
            video.playsInline = true;

            const source =
                document.createElement('source');

            source.src = media.url;

            video.appendChild(source);

            content.appendChild(video);
        }


        count.textContent =
            (currentMediaIndex + 1) +
            ' / ' +
            mediaItems.length;
    }


    function previousMedia() {

        if (!mediaItems.length) {
            return;
        }

        currentMediaIndex =
            (
                currentMediaIndex -
                1 +
                mediaItems.length
            ) %
            mediaItems.length;

        renderViewer();
    }


    function nextMedia() {

        if (!mediaItems.length) {
            return;
        }

        currentMediaIndex =
            (
                currentMediaIndex +
                1
            ) %
            mediaItems.length;

        renderViewer();
    }


    /*
    |--------------------------------------------------------------------------
    | AJAX DELETE
    |--------------------------------------------------------------------------
    |
    | This is deliberately handled on the FORM SUBMIT event.
    | There is NO onclick handler and NO normal form reload.
    |
    */

    const deleteForm =
        document.getElementById(
            'amMediaDeleteForm'
        );

    if (deleteForm) {

        deleteForm.addEventListener(
            'submit',
            async function (event) {

                /*
                | STOP NORMAL FORM SUBMISSION
                */

                event.preventDefault();

                const currentMedia =
                    mediaItems[currentMediaIndex];

                if (!currentMedia) {
                    return;
                }

                const confirmed =
                    confirm(
                        'Delete this ' +
                        currentMedia.type +
                        '? This cannot be undone.'
                    );

                if (!confirmed) {
                    return;
                }

                const deleteButton =
                    document.getElementById(
                        'amDeleteMediaButton'
                    );

                if (deleteButton) {

                    deleteButton.disabled = true;

                    deleteButton.textContent =
                        'Deleting...';

                    deleteButton.style.opacity =
                        '0.65';

                    deleteButton.style.cursor =
                        'not-allowed';
                }


                /*
                | GET THE REAL LARAVEL ROUTE
                */

                const deleteUrl =
                    getDeleteUrl(
                        currentMedia.id
                    );

                if (!deleteUrl) {

                    alert(
                        'The delete route could not be found.'
                    );

                    if (deleteButton) {

                        deleteButton.disabled = false;

                        deleteButton.textContent =
                            'Delete Current Media';

                        deleteButton.style.opacity = '';
                        deleteButton.style.cursor = '';
                    }

                    return;
                }


                try {

                    const csrfToken =
                        document
                            .querySelector(
                                'meta[name="csrf-token"]'
                            )
                            ?.getAttribute('content')
                        || '{{ csrf_token() }}';


                    const response =
                        await fetch(
                            deleteUrl,
                            {
                                method: 'POST',

                                headers: {

                                    'Accept':
                                        'application/json',

                                    'X-Requested-With':
                                        'XMLHttpRequest',

                                    'X-CSRF-TOKEN':
                                        csrfToken,

                                    'Content-Type':
                                        'application/x-www-form-urlencoded;charset=UTF-8'
                                },

                                body:
                                    '_token=' +
                                    encodeURIComponent(
                                        csrfToken
                                    ) +
                                    '&_method=DELETE'
                            }
                        );


                    const contentType =
                        response.headers.get(
                            'content-type'
                        ) || '';


                    let data = null;

                    if (
                        contentType.includes(
                            'application/json'
                        )
                    ) {

                        data =
                            await response.json();

                    } else {

                        throw new Error(
                            'The server returned an unexpected response. Check the Laravel route for vehicle media deletion.'
                        );
                    }


                    if (
                        !response.ok ||
                        !data.success
                    ) {

                        throw new Error(
                            data.message ||
                            'Unable to delete this media.'
                        );
                    }


                    /*
                    | REMOVE FROM CURRENT JAVASCRIPT ARRAY
                    */

                    mediaItems.splice(
                        currentMediaIndex,
                        1
                    );


                    /*
                    | KEEP INDEX VALID
                    */

                    if (!mediaItems.length) {

                        currentMediaIndex = 0;

                    } else if (
                        currentMediaIndex >=
                        mediaItems.length
                    ) {

                        currentMediaIndex =
                            mediaItems.length - 1;
                    }


                    /*
                    | CLOSE FULLSCREEN IF OPEN
                    */

                    const viewer =
                        document.getElementById(
                            'amViewer'
                        );

                    if (
                        viewer &&
                        viewer.classList.contains('open')
                    ) {

                        closeViewer();
                    }


                    /*
                    | REDRAW EVERYTHING
                    */

                    renderMainGallery();
                    renderThumbnails();
                    updateGalleryCounter();
                    updatePhotoCounter();
                    updateMediaDeleteForm();


                    showMediaMessage(
                        data.message ||
                        'Media deleted successfully.'
                    );


                } catch (error) {

                    console.error(
                        'Media delete error:',
                        error
                    );

                    alert(
                        error.message ||
                        'Something went wrong while deleting the media.'
                    );

                } finally {

                    if (deleteButton) {

                        deleteButton.disabled = false;

                        deleteButton.textContent =
                            'Delete Current Media';

                        deleteButton.style.opacity =
                            '';

                        deleteButton.style.cursor =
                            '';
                    }
                }
            }
        );
    }


    /*
    |--------------------------------------------------------------------------
    | AJAX MESSAGE
    |--------------------------------------------------------------------------
    */

    function showMediaMessage(message) {

        const existing =
            document.getElementById(
                'amMediaAjaxMessage'
            );

        if (existing) {
            existing.remove();
        }

        const messageBox =
            document.createElement('div');

        messageBox.id =
            'amMediaAjaxMessage';

        messageBox.className =
            'am-alert am-success';

        messageBox.style.marginBottom =
            '20px';

        messageBox.textContent =
            message;

        const showPage =
            document.querySelector(
                '.am-show-container'
            );

        if (showPage) {

            showPage.insertBefore(
                messageBox,
                showPage.children[1]
            );
        }

        setTimeout(function () {

            if (messageBox) {
                messageBox.remove();
            }

        }, 2500);
    }


    /*
    |--------------------------------------------------------------------------
    | COPY VIN
    |--------------------------------------------------------------------------
    */

    async function copyVehicleVin() {

        const vin =
            @json($vehicle->vin ?? '');

        const button =
            document.querySelector(
                '.am-copy-btn'
            );

        if (!vin || !button) {
            return;
        }

        try {

            await navigator.clipboard.writeText(
                vin
            );

            const original =
                button.textContent;

            button.textContent =
                'Copied';

            setTimeout(function () {

                button.textContent =
                    original;

            }, 1400);

        } catch (error) {

            const helper =
                document.createElement(
                    'textarea'
                );

            helper.value = vin;

            helper.setAttribute(
                'readonly',
                ''
            );

            helper.style.position =
                'fixed';

            helper.style.opacity =
                '0';

            document.body.appendChild(
                helper
            );

            helper.select();

            document.execCommand(
                'copy'
            );

            helper.remove();

            const original =
                button.textContent;

            button.textContent =
                'Copied';

            setTimeout(function () {

                button.textContent =
                    original;

            }, 1400);
        }
    }


    /*
    |--------------------------------------------------------------------------
    | PHOTO SELECTION
    |--------------------------------------------------------------------------
    */

    const photoInput =
        document.getElementById(
            'photos'
        );

    const selectedPhotos =
        document.getElementById(
            'amSelectedPhotos'
        );

    const uploadForm =
        document.getElementById(
            'amMediaUploadForm'
        );

    const uploadButton =
        document.getElementById(
            'amUploadButton'
        );


    if (photoInput) {

        photoInput.addEventListener(
            'change',
            function () {

                const files =
                    Array.from(
                        this.files || []
                    );

                const remainingSlots =
                    maxPhotos -
                    getPhotoCount();


                if (selectedPhotos) {
                    selectedPhotos.textContent =
                        '';
                }


                if (!files.length) {
                    return;
                }


                /*
                | MAX 5 IN ONE SELECTION
                */

                if (
                    files.length >
                    maxPhotosPerUpload
                ) {

                    alert(
                        'You can select up to 5 photos at once.'
                    );

                    this.value = '';

                    return;
                }


                /*
                | MAX 25 TOTAL
                */

                if (
                    files.length >
                    remainingSlots
                ) {

                    alert(
                        'You can only add ' +
                        remainingSlots +
                        ' more photo(s). The maximum is 25 photos.'
                    );

                    this.value = '';

                    return;
                }


                /*
                | FILE TYPE
                */

                const invalidFile =
                    files.find(
                        function (file) {

                            return ![
                                'image/jpeg',
                                'image/png',
                                'image/webp'
                            ].includes(
                                file.type
                            );
                        }
                    );


                if (invalidFile) {

                    alert(
                        'Only JPG, JPEG, PNG and WEBP images are allowed.'
                    );

                    this.value = '';

                    return;
                }


                /*
                | FILE SIZE
                */

                const oversizedFile =
                    files.find(
                        function (file) {

                            return file.size >
                                5 * 1024 * 1024;
                        }
                    );


                if (oversizedFile) {

                    alert(
                        oversizedFile.name +
                        ' is larger than 5MB.'
                    );

                    this.value = '';

                    return;
                }


                /*
                | DISPLAY SELECTION
                */

                if (selectedPhotos) {

                    selectedPhotos.textContent =
                        files.length +
                        ' photo' +
                        (
                            files.length === 1
                                ? ''
                                : 's'
                        ) +
                        ' selected for upload.';
                }
            }
        );
    }


    /*
    |--------------------------------------------------------------------------
    | AJAX MEDIA UPLOAD
    |--------------------------------------------------------------------------
    */

    if (uploadForm) {

        uploadForm.addEventListener(
            'submit',
            async function (event) {

                /*
                | STOP NORMAL PAGE RELOAD
                */

                event.preventDefault();


                const files =
                    photoInput
                        ? Array.from(
                            photoInput.files || []
                        )
                        : [];


                const videoInput =
                    document.getElementById(
                        'video'
                    );


                const hasVideo =
                    videoInput &&
                    videoInput.files &&
                    videoInput.files.length > 0;


                const remainingSlots =
                    maxPhotos -
                    getPhotoCount();


                /*
                | NOTHING SELECTED
                */

                if (
                    files.length === 0 &&
                    !hasVideo
                ) {

                    alert(
                        'Please select at least one photo or video.'
                    );

                    return;
                }


                /*
                | MAX 5 PHOTOS PER UPLOAD
                */

                if (
                    files.length >
                    maxPhotosPerUpload
                ) {

                    alert(
                        'You can upload a maximum of 5 photos at once.'
                    );

                    return;
                }


                /*
                | MAX 25 TOTAL PHOTOS
                */

                if (
                    files.length >
                    remainingSlots
                ) {

                    alert(
                        'You can only add ' +
                        remainingSlots +
                        ' more photo(s). The maximum is 25 photos.'
                    );

                    return;
                }


                /*
                | VIDEO CHECK
                */

                if (hasVideo) {

                    const existingVideo =
                        mediaItems.some(
                            function (media) {

                                return media.type ===
                                    'video';
                            }
                        );


                    if (existingVideo) {

                        alert(
                            'This vehicle already has a video. Only 1 video is allowed.'
                        );

                        return;
                    }
                }


                /*
                | VALIDATE EACH FILE
                */

                for (
                    let i = 0;
                    i < files.length;
                    i++
                ) {

                    const file =
                        files[i];


                    if (
                        ![
                            'image/jpeg',
                            'image/png',
                            'image/webp'
                        ].includes(
                            file.type
                        )
                    ) {

                        alert(
                            file.name +
                            ' is not a supported image.'
                        );

                        return;
                    }


                    if (
                        file.size >
                        5 * 1024 * 1024
                    ) {

                        alert(
                            file.name +
                            ' is larger than 5MB.'
                        );

                        return;
                    }
                }


                /*
                | BUTTON STATE
                */

                if (uploadButton) {

                    uploadButton.disabled =
                        true;

                    uploadButton.textContent =
                        'Uploading...';

                    uploadButton.style.opacity =
                        '0.65';

                    uploadButton.style.cursor =
                        'not-allowed';
                }


                try {

                    /*
                    |--------------------------------------------------------------------------
                    | BUILD FORMDATA MANUALLY
                    |--------------------------------------------------------------------------
                    |
                    | This is important.
                    |
                    | We explicitly append every selected photo
                    | as photos[] instead of relying only on
                    | FormData(form).
                    |
                    */

                    const formData =
                        new FormData();


                    /*
                    | CSRF
                    */

                    formData.append(
                        '_token',
                        '{{ csrf_token() }}'
                    );


                    /*
                    | ADD ALL SELECTED PHOTOS
                    */

                    files.forEach(
                        function (file) {

                            formData.append(
                                'photos[]',
                                file
                            );
                        }
                    );


                    /*
                    | ADD VIDEO IF SELECTED
                    */

                    if (hasVideo) {

                        formData.append(
                            'video',
                            videoInput.files[0]
                        );
                    }


                    /*
                    | SEND TO LARAVEL
                    */

                    const response =
                        await fetch(
                            uploadForm.action,
                            {
                                method: 'POST',

                                body: formData,

                                headers: {
                                    'Accept':
                                        'application/json',

                                    'X-Requested-With':
                                        'XMLHttpRequest'
                                }
                            }
                        );


                    /*
                    | READ RESPONSE
                    */

                    const contentType =
                        response.headers.get(
                            'content-type'
                        ) || '';


                    let data = null;


                    if (
                        contentType.includes(
                            'application/json'
                        )
                    ) {

                        data =
                            await response.json();

                    } else {

                        throw new Error(
                            'The server returned an unexpected response. Please check the Laravel media upload response.'
                        );
                    }


                    /*
                    | HANDLE SERVER ERROR
                    */

                    if (
                        !response.ok ||
                        !data.success
                    ) {

                        throw new Error(
                            data.message ||
                            'Unable to upload the media.'
                        );
                    }


                    /*
                    |--------------------------------------------------------------------------
                    | ADD ALL UPLOADED MEDIA TO GALLERY
                    |--------------------------------------------------------------------------
                    */

                    if (
                        Array.isArray(
                            data.media
                        )
                    ) {

                        data.media.forEach(
                            function (media) {

                                const exists =
                                    mediaItems.some(
                                        function (existing) {

                                            return Number(
                                                existing.id
                                            ) === Number(
                                                media.id
                                            );
                                        }
                                    );


                                if (!exists) {

                                    mediaItems.push({
                                        id:
                                            media.id,

                                        type:
                                            media.type,

                                        url:
                                            media.url
                                    });
                                }
                            }
                        );
                    }


                    /*
                    |--------------------------------------------------------------------------
                    | SELECT THE FIRST NEWLY UPLOADED MEDIA
                    |--------------------------------------------------------------------------
                    */

                    if (
                        Array.isArray(
                            data.media
                        ) &&
                        data.media.length > 0
                    ) {

                        const firstNewMedia =
                            data.media[0];

                        const newIndex =
                            mediaItems.findIndex(
                                function (media) {

                                    return Number(
                                        media.id
                                    ) === Number(
                                        firstNewMedia.id
                                    );
                                }
                            );


                        if (newIndex !== -1) {

                            currentMediaIndex =
                                newIndex;
                        }
                    }


                    /*
                    |--------------------------------------------------------------------------
                    | RESET INPUT
                    |--------------------------------------------------------------------------
                    */

                    uploadForm.reset();


                    if (selectedPhotos) {

                        selectedPhotos.textContent =
                            '';
                    }


                    /*
                    |--------------------------------------------------------------------------
                    | REFRESH PAGE ELEMENTS WITHOUT RELOAD
                    |--------------------------------------------------------------------------
                    */

                    renderMainGallery();
                    renderThumbnails();
                    updateGalleryCounter();
                    updatePhotoCounter();
                    updateMediaDeleteForm();


                    /*
                    |--------------------------------------------------------------------------
                    | SUCCESS MESSAGE
                    |--------------------------------------------------------------------------
                    */

                    showMediaMessage(
                        data.message ||
                        'Media uploaded successfully.'
                    );


                } catch (error) {

                    console.error(
                        'Media upload error:',
                        error
                    );

                    alert(
                        error.message ||
                        'Something went wrong while uploading the media.'
                    );

                } finally {

                    if (uploadButton) {

                        uploadButton.disabled =
                            false;

                        uploadButton.textContent =
                            'Upload Media';

                        uploadButton.style.opacity =
                            '';

                        uploadButton.style.cursor =
                            '';
                    }
                }
            }
        );
    }


    /*
    |--------------------------------------------------------------------------
    | KEYBOARD NAVIGATION
    |--------------------------------------------------------------------------
    */

    document.addEventListener(
        'keydown',
        function (event) {

            const viewer =
                document.getElementById(
                    'amViewer'
                );


            if (
                viewer &&
                viewer.classList.contains(
                    'open'
                )
            ) {

                if (
                    event.key ===
                    'Escape'
                ) {

                    closeViewer();
                }


                if (
                    event.key ===
                    'ArrowLeft'
                ) {

                    previousMedia();
                }


                if (
                    event.key ===
                    'ArrowRight'
                ) {

                    nextMedia();
                }

                return;
            }


            if (
                event.key ===
                'ArrowLeft'
            ) {

                previousGalleryMedia();
            }


            if (
                event.key ===
                'ArrowRight'
            ) {

                nextGalleryMedia();
            }
        }
    );


    /*
    |--------------------------------------------------------------------------
    | INITIAL GALLERY
    |--------------------------------------------------------------------------
    */
       document.getElementById('amAddPhotoButton')?.addEventListener('click', function () {
        document.getElementById('photos')?.click();
    });


    updatePhotoCounter();
    updateGalleryCounter();
    updateMediaDeleteForm();
</script>

</x-app-layout>