<!DOCTYPE html>

<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

<title>
    {{ trim(collect([$vehicle->year, $vehicle->make, $vehicle->model])->filter()->implode(' ')) ?: 'Vehicle' }}
    - AutoMall
</title>

<style>
    * {
        box-sizing: border-box;
    }

    html {
        scroll-behavior: smooth;
    }

    body {
        margin: 0;
        background: #f4f5f7;
        color: #101828;
        font-family: Arial, Helvetica, sans-serif;
    }

    body.no-scroll {
        overflow: hidden;
    }

    a,
    button {
        -webkit-tap-highlight-color: transparent;
    }

    button {
        font-family: inherit;
    }

    .page {
        min-height: 100vh;
        padding: 24px 18px 60px;
    }

    .wrap {
        max-width: 1180px;
        margin: 0 auto;
    }

    /* =========================
       TOP BAR
    ========================= */

    .top {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 15px;
        margin-bottom: 18px;
    }

    .brand {
        display: inline-flex;
        align-items: center;
        gap: 10px;
        color: #111;
        text-decoration: none;
        font-weight: 900;
    }

    .brand-mark {
        width: 38px;
        height: 38px;
        border-radius: 10px;
        background: #ed1b2f;
        color: #fff;
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: 900;
    }

    .back {
        color: #667085;
        text-decoration: none;
        font-size: 11px;
        font-weight: 800;
    }

    .back:hover {
        color: #ed1b2f;
    }

    /* =========================
       HERO
    ========================= */

    .hero {
        background: #fff;
        border: 1px solid #e0e4e9;
        border-radius: 14px;
        padding: 24px;
        margin-bottom: 18px;
    }

    .eyebrow {
        color: #ed1b2f;
        font-size: 9px;
        font-weight: 900;
        letter-spacing: 1.4px;
        text-transform: uppercase;
        margin-bottom: 7px;
    }

    h1 {
        margin: 0;
        font-size: 32px;
        line-height: 1.1;
        letter-spacing: -.8px;
    }

    .subtitle {
        margin: 8px 0 0;
        color: #667085;
        font-size: 12px;
    }

    /* =========================
       GRID
    ========================= */

    .grid {
        display: grid;
        grid-template-columns: minmax(0, 1.5fr) minmax(300px, .8fr);
        gap: 18px;
    }

    .card {
        background: #fff;
        border: 1px solid #e0e4e9;
        border-radius: 14px;
        overflow: hidden;
    }

    /* =========================
       GALLERY
    ========================= */

    .gallery {
        position: relative;
        background: #101214;
    }

    .gallery-main {
        height: 500px;
        position: relative;
        background: #101214;
        display: flex;
        align-items: center;
        justify-content: center;
        overflow: hidden;
        cursor: zoom-in;
    }

    .gallery-main img,
    .gallery-main video {
        width: 100%;
        height: 100%;
        object-fit: contain;
        display: block;
    }

    .gallery-main img {
        transition: transform .25s ease;
    }

    .gallery-main.zoomed {
        cursor: zoom-out;
    }

    .gallery-main.zoomed img {
        transform: scale(1.8);
    }

    .no-media {
        color: #98a2b3;
        font-size: 12px;
        font-weight: 800;
    }

    .gallery-arrow {
        position: absolute;
        top: 50%;
        transform: translateY(-50%);
        width: 46px;
        height: 46px;
        border: 0;
        border-radius: 50%;
        background: rgba(0, 0, 0, .62);
        color: #fff;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 28px;
        line-height: 1;
        cursor: pointer;
        z-index: 5;
    }

    .gallery-arrow:hover {
        background: #ed1b2f;
    }

    .gallery-prev {
        left: 16px;
    }

    .gallery-next {
        right: 16px;
    }

    .gallery-counter {
        position: absolute;
        left: 50%;
        bottom: 15px;
        transform: translateX(-50%);
        padding: 7px 12px;
        border-radius: 999px;
        background: rgba(0, 0, 0, .65);
        color: #fff;
        font-size: 10px;
        font-weight: 900;
        z-index: 5;
    }

    .gallery-tools {
        position: absolute;
        right: 14px;
        top: 14px;
        display: flex;
        gap: 7px;
        z-index: 6;
    }

    .gallery-tool {
        width: 38px;
        height: 38px;
        border: 0;
        border-radius: 9px;
        background: rgba(0, 0, 0, .62);
        color: #fff;
        cursor: pointer;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 16px;
        font-weight: 900;
    }

    .gallery-tool:hover {
        background: #ed1b2f;
    }

    /* =========================
       THUMBNAILS
    ========================= */

    .thumbs {
        padding: 12px;
        display: grid;
        grid-template-columns: repeat(6, 1fr);
        gap: 8px;
        border-top: 1px solid #25282c;
        background: #181a1d;
    }

    .thumb {
        height: 74px;
        border: 2px solid transparent;
        border-radius: 8px;
        overflow: hidden;
        background: #25282c;
        cursor: pointer;
        padding: 0;
        opacity: .65;
        transition: opacity .2s, border .2s;
    }

    .thumb:hover,
    .thumb.active {
        opacity: 1;
    }

    .thumb.active {
        border-color: #ed1b2f;
    }

    .thumb img,
    .thumb video {
        width: 100%;
        height: 100%;
        object-fit: cover;
        display: block;
    }

    /* =========================
       VEHICLE BODY
    ========================= */

    .body {
        padding: 20px;
    }

    .price {
        font-size: 25px;
        font-weight: 900;
        letter-spacing: -.4px;
    }

    .meta {
        margin-top: 7px;
        color: #667085;
        font-size: 11px;
    }

    .section {
        padding: 20px;
        border-top: 1px solid #eef0f2;
    }

    .section h2 {
        margin: 0 0 5px;
        font-size: 14px;
        font-weight: 900;
    }

    .section p {
        margin: 0;
        color: #667085;
        font-size: 11px;
        line-height: 1.65;
    }

    /* =========================
       INFORMATION
    ========================= */

    .info {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        border: 1px solid #eef0f2;
        border-radius: 10px;
        overflow: hidden;
        margin-top: 12px;
    }

    .item {
        padding: 12px;
        border-right: 1px solid #eef0f2;
        border-bottom: 1px solid #eef0f2;
    }

    .item:nth-child(2n) {
        border-right: 0;
    }

    .label {
        display: block;
        color: #98a2b3;
        font-size: 8px;
        font-weight: 900;
        letter-spacing: .8px;
        text-transform: uppercase;
    }

    .value {
        display: block;
        margin-top: 4px;
        color: #101828;
        font-size: 11px;
        font-weight: 800;
    }

    /* =========================
       DEALER
    ========================= */

    .dealer {
        padding: 20px;
        height: fit-content;
        position: sticky;
        top: 18px;
    }

    .dealer-top {
        display: flex;
        align-items: center;
        gap: 12px;
        margin-bottom: 15px;
    }

    .avatar {
        width: 54px;
        height: 54px;
        border-radius: 12px;
        background: #ed1b2f;
        color: #fff;
        overflow: hidden;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 18px;
        font-weight: 900;
        flex-shrink: 0;
    }

    .avatar img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    .dealer-name {
        margin: 0;
        font-size: 15px;
        font-weight: 900;
    }

    .dealer-loc {
        margin-top: 3px;
        color: #98a2b3;
        font-size: 10px;
    }

    .dealer-actions {
        display: flex;
        flex-direction: column;
        gap: 9px;
        margin-top: 18px;
    }

    .dealer-link {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        width: 100%;
        min-height: 44px;
        padding: 10px 14px;
        border-radius: 9px;
        color: #fff;
        text-decoration: none;
        font-size: 10px;
        font-weight: 900;
        transition: .2s;
    }

    .message-dealer {
        background: #ed1b2f;
    }

    .message-dealer:hover {
        background: #c81022;
    }

    .dealer-profile-link {
        background: #111;
    }

    .dealer-profile-link:hover {
        background: #333;
    }

    .self-note {
        margin-top: 12px;
        color: #98a2b3;
        font-size: 9px;
        text-align: center;
    }

    .login-note {
        margin-top: 9px;
        color: #98a2b3;
        font-size: 9px;
        line-height: 1.5;
        text-align: center;
    }

    /* =========================
       LIGHTBOX
    ========================= */

    .lightbox {
        position: fixed;
        inset: 0;
        background: rgba(0, 0, 0, .96);
        z-index: 9999;
        display: none;
        align-items: center;
        justify-content: center;
    }

    .lightbox.open {
        display: flex;
    }

    .lightbox-content {
        width: 100%;
        height: 100%;
        display: flex;
        align-items: center;
        justify-content: center;
        position: relative;
        overflow: hidden;
    }

    .lightbox-media {
        max-width: 92vw;
        max-height: 88vh;
        object-fit: contain;
        user-select: none;
        transition: transform .25s ease;
        cursor: zoom-in;
    }

    .lightbox-media.zoomed {
        transform: scale(1.8);
        cursor: zoom-out;
    }

    .lightbox-close {
        position: absolute;
        right: 20px;
        top: 18px;
        width: 46px;
        height: 46px;
        border: 0;
        border-radius: 50%;
        background: rgba(255,255,255,.12);
        color: #fff;
        font-size: 27px;
        cursor: pointer;
        z-index: 20;
    }

    .lightbox-close:hover {
        background: #ed1b2f;
    }

    .lightbox-arrow {
        position: absolute;
        top: 50%;
        transform: translateY(-50%);
        width: 54px;
        height: 54px;
        border: 0;
        border-radius: 50%;
        background: rgba(255,255,255,.12);
        color: #fff;
        font-size: 34px;
        cursor: pointer;
        z-index: 20;
    }

    .lightbox-arrow:hover {
        background: #ed1b2f;
    }

    .lightbox-prev {
        left: 20px;
    }

    .lightbox-next {
        right: 20px;
    }

    .lightbox-counter {
        position: absolute;
        bottom: 22px;
        left: 50%;
        transform: translateX(-50%);
        color: #fff;
        background: rgba(0,0,0,.65);
        padding: 8px 14px;
        border-radius: 999px;
        font-size: 11px;
        font-weight: 900;
        z-index: 20;
    }

    .lightbox-hint {
        position: absolute;
        bottom: 22px;
        left: 20px;
        color: rgba(255,255,255,.55);
        font-size: 9px;
    }

    /* =========================
       MOBILE
    ========================= */

    @media(max-width: 900px) {
        .grid {
            grid-template-columns: 1fr;
        }

        .dealer {
            position: static;
        }

        .gallery-main {
            height: 430px;
        }
    }

    @media(max-width: 600px) {
        .page {
            padding: 18px 12px 45px;
        }

        h1 {
            font-size: 25px;
        }

        .gallery-main {
            height: 300px;
        }

        .thumbs {
            grid-template-columns: repeat(4, 1fr);
        }

        .thumb {
            height: 62px;
        }

        .info {
            grid-template-columns: 1fr;
        }

        .item {
            border-right: 0;
        }

        .top {
            align-items: flex-start;
        }

        .body,
        .section,
        .dealer,
        .hero {
            padding: 16px;
        }

        .gallery-arrow {
            width: 40px;
            height: 40px;
            font-size: 23px;
        }

        .gallery-prev {
            left: 9px;
        }

        .gallery-next {
            right: 9px;
        }

        .gallery-tools {
            right: 9px;
            top: 9px;
        }

        .gallery-tool {
            width: 34px;
            height: 34px;
        }

        .lightbox-arrow {
            width: 42px;
            height: 42px;
            font-size: 27px;
        }

        .lightbox-prev {
            left: 8px;
        }

        .lightbox-next {
            right: 8px;
        }

        .lightbox-close {
            right: 10px;
            top: 10px;
        }

        .lightbox-hint {
            display: none;
        }
    }
</style>

</head>

<body>

<div class="page">
    <div class="wrap">

    <div class="top">
        <a class="brand"
           href="{{ auth()->check() ? route('dashboard') : url('/') }}">
            <span class="brand-mark">A</span>
            <span>AutoMall</span>
        </a>

        <a class="back" href="javascript:history.back()">
            Back
        </a>
    </div>

    <section class="hero">
        <div class="eyebrow">Vehicle Information</div>

        <h1>
            {{ trim(collect([
                $vehicle->year,
                $vehicle->make,
                $vehicle->model
            ])->filter()->implode(' ')) ?: 'Vehicle' }}
        </h1>

        <p class="subtitle">
            {{ collect([
                $vehicle->city,
                $vehicle->state,
                $vehicle->country
            ])->filter()->implode(', ') ?: 'Location not provided' }}
        </p>
    </section>

    <div class="grid">

        <main class="card">

            @php
                $media = $vehicle->media->values();
            @endphp

            <div class="gallery">

                <div class="gallery-main" id="galleryMain">

                    @if($media->count())

                        @php
                            $first = $media->first();
                        @endphp

                        @if($first->type === 'video')

                            <video id="mainVideo"
                                   controls
                                   preload="metadata">
                                <source src="{{ asset('storage/' . $first->file_path) }}">
                            </video>

                        @else

                            <img id="mainImage"
                                 src="{{ asset('storage/' . $first->file_path) }}"
                                 alt="{{ $vehicle->make }} {{ $vehicle->model }}">

                        @endif

                        @if($media->count() > 1)

                            <button type="button"
                                    class="gallery-arrow gallery-prev"
                                    onclick="previousMedia()">
                                ‹
                            </button>

                            <button type="button"
                                    class="gallery-arrow gallery-next"
                                    onclick="nextMedia()">
                                ›
                            </button>

                        @endif

                        <div class="gallery-tools">

                            <button type="button"
                                    class="gallery-tool"
                                    onclick="zoomMain()"
                                    title="Zoom">
                                +
                            </button>

                            <button type="button"
                                    class="gallery-tool"
                                    onclick="openLightbox()"
                                    title="Fullscreen">
                                ⛶
                            </button>

                        </div>

                        <div class="gallery-counter"
                             id="galleryCounter">
                            1 / {{ $media->count() }}
                        </div>

                    @else

                        <div class="no-media">
                            No vehicle photos or videos available.
                        </div>

                    @endif

                </div>

                @if($media->count())

                    <div class="thumbs">

                        @foreach($media as $index => $item)

                            <button type="button"
                                    class="thumb {{ $index === 0 ? 'active' : '' }}"
                                    onclick="changeMedia({{ $index }})">

                                @if($item->type === 'video')

                                    <video src="{{ asset('storage/' . $item->file_path) }}"
                                           muted
                                           preload="metadata">
                                    </video>

                                @else

                                    <img src="{{ asset('storage/' . $item->file_path) }}"
                                         alt="Vehicle photo">

                                @endif

                            </button>

                        @endforeach

                    </div>

                @endif

            </div>

            <div class="body">

                <div class="price">
                    {{ $vehicle->price !== null
                        ? '₦' . number_format((float) $vehicle->price, 2)
                        : 'Price on Request'
                    }}
                </div>

                <div class="meta">
                    {{ $vehicle->year }}
                    ·
                    {{ $vehicle->make }}
                    ·
                    {{ $vehicle->model }}

                    @if($vehicle->mileage !== null)
                        · {{ number_format($vehicle->mileage) }} km
                    @endif
                </div>

            </div>

            <section class="section">

                <h2>Vehicle Information</h2>

                <p>
                    Information provided by the dealer for this  vehicle.
                </p>

                <div class="info">

                    @foreach([
                        'Make' => $vehicle->make,
                        'Model' => $vehicle->model,
                        'Year' => $vehicle->year,
                        'Trim' => $vehicle->trim,
                        'Body Type' => $vehicle->body_type,
                        'Color' => $vehicle->color,
                        'Engine' => $vehicle->engine,
                        'Transmission' => $vehicle->transmission,
                        'Fuel Type' => $vehicle->fuel_type,
                        'Drivetrain' => $vehicle->drivetrain,
                        'Mileage' => ($vehicle->mileage !== null
                            ? number_format($vehicle->mileage) . ' km'
                            : null),
                        'Location' => collect([
                            $vehicle->city,
                            $vehicle->state,
                            $vehicle->country
                        ])->filter()->implode(', '),
                    ] as $label => $value)

                        <div class="item">
                            <span class="label">{{ $label }}</span>
                            <span class="value">
                                {{ $value ?: 'Not provided' }}
                            </span>
                        </div>

                    @endforeach

                </div>

            </section>

            @if($vehicle->description)

                <section class="section">

                    <h2>Description</h2>

                    <p>
                        {{ $vehicle->description }}
                    </p>

                </section>

            @endif

        </main>

        <aside class="card dealer">

            <div class="dealer-top">

                <div class="avatar">

                    @if($dealer->logo)

                        <img src="{{ asset('storage/' . $dealer->logo) }}"
                             alt="{{ $dealer->business_name }}">

                    @else

                        {{
                            strtoupper(
                                substr(
                                    $dealer->business_name
                                        ?: ($dealer->user->name ?? 'D'),
                                    0,
                                    1
                                )
                            )
                        }}

                    @endif

                </div>

                <div>

                    <h2 class="dealer-name">
                        {{ $dealer->business_name
                            ?: ($dealer->user->name ?? 'Dealer') }}
                    </h2>

                    <div class="dealer-loc">
                        {{ collect([
                            $dealer->city,
                            $dealer->state,
                            $dealer->country
                        ])->filter()->implode(', ')
                            ?: 'Location not provided' }}
                    </div>

                </div>

            </div>

            @if($dealer->description)

                <div class="section"
                     style="padding:0 0 5px;border-top:0;">

                    <p>
                        {{ $dealer->description }}
                    </p>

                </div>

            @endif

            <div class="dealer-actions">

                @if(!$isSelf)

                    @auth

                        <a class="dealer-link message-dealer"
                           href="{{ route('messages.start', ['vehicle' => $vehicle->id]) }}">

                            Message Dealer

                        </a>

                    @else

                        <a class="dealer-link message-dealer"
                           href="{{ route('login') }}">

                            Login to Message Dealer

                        </a>

                        <div class="login-note">
                            Sign in to contact this dealer about this vehicle.
                        </div>

                    @endauth

                @endif

                <a class="dealer-link dealer-profile-link"
                   href="{{ route('public.dealers.show', $dealer) }}">

                    View Dealer's Page

                </a>

            <!-- </div>

            @if($isSelf)

                <div class="self-note">
                    This is your own public listing.
                </div>

            @endif

        </aside>

    </div> -->

</div>

</div>

@if($media->count())

<div class="lightbox" id="lightbox">

<div class="lightbox-content" id="lightboxContent">

    <button type="button"
            class="lightbox-close"
            onclick="closeLightbox()"
            aria-label="Close">
        ×
    </button>

    @if($media->count() > 1)

        <button type="button"
                class="lightbox-arrow lightbox-prev"
                onclick="previousMedia()">
            ‹
        </button>

        <button type="button"
                class="lightbox-arrow lightbox-next"
                onclick="nextMedia()">
            ›
        </button>

    @endif

    <div id="lightboxMediaContainer"></div>

    <div class="lightbox-counter" id="lightboxCounter">
        1 / {{ $media->count() }}
    </div>

    <div class="lightbox-hint">
        ← → Navigate &nbsp; • &nbsp; ESC Close &nbsp; • &nbsp; Click image to zoom
    </div>

</div>

</div>

<script>

const publicMedia = @json(
    $media->map(function ($item) {
        return [
            'type' => $item->type,
            'src' => asset('storage/' . $item->file_path),
        ];
    })->values()
);

let currentMediaIndex = 0;
let mainZoomed = false;
let lightboxZoomed = false;


/* =========================
   CHANGE MEDIA
========================= */

function changeMedia(index) {

    if (!publicMedia[index]) {
        return;
    }

    currentMediaIndex = index;
    mainZoomed = false;

    const item = publicMedia[index];
    const main = document.getElementById('galleryMain');

    if (!main) {
        return;
    }

    main.classList.remove('zoomed');

    let mediaHtml = '';

    if (item.type === 'video') {

        mediaHtml = `
            <video id="mainVideo"
                   controls
                   preload="metadata">
                <source src="${item.src}">
            </video>
        `;

    } else {

        mediaHtml = `
            <img id="mainImage"
                 src="${item.src}"
                 alt="Vehicle media">
        `;

    }

    let controls = '';

    if (publicMedia.length > 1) {

        controls += `
            <button type="button"
                    class="gallery-arrow gallery-prev"
                    onclick="previousMedia()">
                ‹
            </button>

            <button type="button"
                    class="gallery-arrow gallery-next"
                    onclick="nextMedia()">
                ›
            </button>
        `;

    }

    controls += `
        <div class="gallery-tools">

            <button type="button"
                    class="gallery-tool"
                    onclick="zoomMain()">
                +
            </button>

            <button type="button"
                    class="gallery-tool"
                    onclick="openLightbox()">
                ⛶
            </button>

        </div>

        <div class="gallery-counter"
             id="galleryCounter">

            ${index + 1} / ${publicMedia.length}

        </div>
    `;

    main.innerHTML = mediaHtml + controls;

    document.querySelectorAll('.thumb').forEach((el, i) => {
        el.classList.toggle('active', i === index);
    });

    if (
        document.getElementById('lightbox') &&
        document.getElementById('lightbox').classList.contains('open')
    ) {
        renderLightbox();
    }
}


/* =========================
   PREVIOUS
========================= */

function previousMedia() {

    if (!publicMedia.length) {
        return;
    }

    currentMediaIndex =
        currentMediaIndex <= 0
            ? publicMedia.length - 1
            : currentMediaIndex - 1;

    changeMedia(currentMediaIndex);
}


/* =========================
   NEXT
========================= */

function nextMedia() {

    if (!publicMedia.length) {
        return;
    }

    currentMediaIndex =
        currentMediaIndex >= publicMedia.length - 1
            ? 0
            : currentMediaIndex + 1;

    changeMedia(currentMediaIndex);
}


/* =========================
   MAIN ZOOM
========================= */

function zoomMain() {

    const main = document.getElementById('galleryMain');
    const image = document.getElementById('mainImage');

    if (!main || !image) {
        return;
    }

    mainZoomed = !mainZoomed;

    main.classList.toggle('zoomed', mainZoomed);
}


/* =========================
   LIGHTBOX
========================= */

function openLightbox() {

    const lightbox = document.getElementById('lightbox');

    if (!lightbox) {
        return;
    }

    lightbox.classList.add('open');
    document.body.classList.add('no-scroll');

    lightboxZoomed = false;

    renderLightbox();
}


function closeLightbox() {

    const lightbox = document.getElementById('lightbox');

    if (!lightbox) {
        return;
    }

    lightbox.classList.remove('open');
    document.body.classList.remove('no-scroll');

    lightboxZoomed = false;
}


/* =========================
   RENDER LIGHTBOX
========================= */

function renderLightbox() {

    const container =
        document.getElementById('lightboxMediaContainer');

    if (!container) {
        return;
    }

    const item = publicMedia[currentMediaIndex];

    if (!item) {
        return;
    }

    if (item.type === 'video') {

        container.innerHTML = `
            <video class="lightbox-media"
                   controls
                   autoplay>
                <source src="${item.src}">
            </video>
        `;

    } else {

        container.innerHTML = `
            <img class="lightbox-media"
                 id="lightboxImage"
                 src="${item.src}"
                 alt="Vehicle media">
        `;

        const image =
            document.getElementById('lightboxImage');

        if (image) {

            image.addEventListener('click', function () {

                lightboxZoomed = !lightboxZoomed;

                image.classList.toggle(
                    'zoomed',
                    lightboxZoomed
                );

            });

        }
    }

    const counter =
        document.getElementById('lightboxCounter');

    if (counter) {

        counter.textContent =
            `${currentMediaIndex + 1} / ${publicMedia.length}`;

    }
}


/* =========================
   KEYBOARD
========================= */

document.addEventListener('keydown', function(event) {

    const lightbox =
        document.getElementById('lightbox');

    const isOpen =
        lightbox &&
        lightbox.classList.contains('open');

    if (event.key === 'Escape' && isOpen) {

        closeLightbox();
        return;

    }

    if (!isOpen) {
        return;
    }

    if (event.key === 'ArrowLeft') {

        previousMedia();

    } else if (event.key === 'ArrowRight') {

        nextMedia();

    }

});


/* =========================
   CLICK OUTSIDE
========================= */

document
    .getElementById('lightbox')
    ?.addEventListener('click', function(event) {

        if (
            event.target === this ||
            event.target.id === 'lightboxContent'
        ) {

            closeLightbox();

        }

    });


/* =========================
   MOBILE SWIPE
========================= */

let touchStartX = 0;

document
    .getElementById('lightbox')
    ?.addEventListener(
        'touchstart',
        function(event) {

            touchStartX =
                event.changedTouches[0].screenX;

        },
        { passive: true }
    );

document
    .getElementById('lightbox')
    ?.addEventListener(
        'touchend',
        function(event) {

            const touchEndX =
                event.changedTouches[0].screenX;

            const difference =
                touchStartX - touchEndX;

            if (Math.abs(difference) < 50) {
                return;
            }

            if (difference > 0) {
                nextMedia();
            } else {
                previousMedia();
            }

        },
        { passive: true }
    );

</script>

@endif

</body>
</html>
