<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $dealer->business_name ?: ($dealer->user->name ?? 'Dealer') }} - AutoMall</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        * { box-sizing: border-box; }
        body {
            margin: 0;
            background: #f4f5f7;
            color: #101828;
            font-family: inherit;
        }
        a { color: inherit; }
        .dealer-page { min-height: 100vh; padding: 36px 18px 70px; }
        .dealer-wrap { max-width: 1180px; margin: 0 auto; }
        .dealer-topbar {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 16px;
            margin-bottom: 20px;
        }
        .dealer-logo {
            display: inline-flex;
            align-items: center;
            gap: 10px;
            font-size: 19px;
            font-weight: 900;
            text-decoration: none;
        }
        .dealer-logo-mark {
            width: 36px;
            height: 36px;
            border-radius: 9px;
            background: #ed1b2f;
            color: #fff;
            display: inline-flex;
            align-items: center;
            justify-content: center;
        }
        .dealer-back {
            font-size: 11px;
            font-weight: 800;
            text-decoration: none;
            color: #667085;
        }
        .dealer-back:hover { color: #ed1b2f; }
        .dealer-hero {
            background: #080d15;
            border-radius: 16px;
            padding: 28px;
            color: #fff;
            display: grid;
            grid-template-columns: 84px minmax(0, 1fr);
            gap: 20px;
            align-items: center;
        }
        .dealer-avatar {
            width: 84px;
            height: 84px;
            border-radius: 16px;
            overflow: hidden;
            background: #ed1b2f;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 28px;
            font-weight: 900;
        }
        .dealer-avatar img { width: 100%; height: 100%; object-fit: cover; }
        .dealer-name {
            margin: 0;
            font-size: 29px;
            line-height: 1.1;
            font-weight: 900;
            letter-spacing: -.8px;
        }
        .dealer-location {
            margin-top: 7px;
            color: #aeb7c5;
            font-size: 12px;
        }
        .dealer-status {
            display: inline-flex;
            margin-top: 12px;
            padding: 5px 9px;
            border-radius: 999px;
            background: rgba(255,255,255,.09);
            color: #fff;
            font-size: 9px;
            font-weight: 900;
            letter-spacing: .8px;
            text-transform: uppercase;
        }
        .dealer-main {
            margin-top: 20px;
            display: grid;
            grid-template-columns: minmax(0, 1fr) 300px;
            gap: 20px;
        }
        .dealer-card {
            background: #fff;
            border: 1px solid #e0e4e9;
            border-radius: 12px;
            overflow: hidden;
        }
        .dealer-card-head {
            padding: 18px 20px;
            border-bottom: 1px solid #e9ecf0;
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 15px;
        }
        .dealer-card-title { font-size: 14px; font-weight: 900; }
        .dealer-card-count { font-size: 10px; color: #98a2b3; font-weight: 800; }
        .dealer-description { padding: 18px 20px 20px; color: #667085; font-size: 12px; line-height: 1.65; }
        .dealer-vehicles {
            padding: 18px;
            display: grid;
            grid-template-columns: repeat(2, minmax(0, 1fr));
            gap: 14px;
        }
        .vehicle-card {
            border: 1px solid #e0e4e9;
            border-radius: 10px;
            overflow: hidden;
            text-decoration: none;
            background: #fff;
        }
        .vehicle-photo { height: 190px; background: #e7e9ec; }
        .vehicle-photo img { width: 100%; height: 100%; object-fit: cover; display: block; }
        .vehicle-no-photo { height: 100%; display: flex; align-items: center; justify-content: center; color: #98a2b3; font-size: 10px; font-weight: 800; }
        .vehicle-copy { padding: 12px; }
        .vehicle-title { font-size: 12px; font-weight: 900; }
        .vehicle-meta { margin-top: 5px; color: #98a2b3; font-size: 9px; }
        .dealer-side { padding: 18px; }
        .dealer-side-row { padding: 12px 0; border-bottom: 1px solid #eef0f2; }
        .dealer-side-row:first-child { padding-top: 0; }
        .dealer-side-row:last-child { border-bottom: 0; }
        .dealer-side-label { color: #98a2b3; font-size: 8px; font-weight: 900; letter-spacing: .8px; text-transform: uppercase; }
        .dealer-side-value { margin-top: 4px; color: #101828; font-size: 11px; font-weight: 800; word-break: break-word; }
        .empty-state { padding: 42px 20px; text-align: center; color: #98a2b3; font-size: 11px; font-weight: 700; }
        @media (max-width: 900px) {
            .dealer-main { grid-template-columns: 1fr; }
        }
        @media (max-width: 680px) {
            .dealer-page { padding: 20px 12px 50px; }
            .dealer-hero { grid-template-columns: 1fr; padding: 22px; }
            .dealer-name { font-size: 24px; }
            .dealer-vehicles { grid-template-columns: 1fr; }
        }
    </style>
</head>
<body>
<div class="dealer-page">
    <div class="dealer-wrap">
        <div class="dealer-topbar">
            <a class="dealer-logo" href="{{ auth()->check() ? route('dashboard') : url('/') }}">
                <span class="dealer-logo-mark">A</span>
                <span>AutoMall</span>
            </a>
            <a class="dealer-back" href="javascript:history.back()">Back</a>
        </div>

        <section class="dealer-hero">
            <div class="dealer-avatar">
                @if($dealer->logo)
                    <img src="{{ asset('storage/' . $dealer->logo) }}" alt="{{ $dealer->business_name }}">
                @else
                    {{ strtoupper(substr($dealer->business_name ?: ($dealer->user->name ?? 'D'), 0, 1)) }}
                @endif
            </div>
            <div>
                <h1 class="dealer-name">{{ $dealer->business_name ?: ($dealer->user->name ?? 'Dealer') }}</h1>
                <div class="dealer-location">
                    {{ collect([$dealer->city, $dealer->state, $dealer->country])->filter()->implode(', ') ?: 'Location not provided' }}
                </div>
                @if($dealer->verification_status === 'verified')
                    <div class="dealer-status">Verified Dealer</div>
                @endif
            </div>
        </section>

        <div class="dealer-main">
            <section class="dealer-card">
                <div class="dealer-card-head">
                    <div class="dealer-card-title">Vehicles from this dealer</div>
                    <div class="dealer-card-count">{{ $vehicles->count() }} active</div>
                </div>

                @if($dealer->description)
                    <div class="dealer-description">{{ $dealer->description }}</div>
                @endif

                @if($vehicles->count())
                    <div class="dealer-vehicles">
                        @foreach($vehicles as $vehicle)
                            @php($photo = $vehicle->media->where('type', 'photo')->first())
                            <a class="vehicle-card" href="{{ route('vehicles.show', $vehicle) }}">
                                <div class="vehicle-photo">
                                    @if($photo)
                                        <img src="{{ asset('storage/' . $photo->file_path) }}" alt="{{ $vehicle->year }} {{ $vehicle->make }} {{ $vehicle->model }}">
                                    @else
                                        <div class="vehicle-no-photo">No vehicle photo</div>
                                    @endif
                                </div>
                                <div class="vehicle-copy">
                                    <div class="vehicle-title">{{ trim(collect([$vehicle->year, $vehicle->make, $vehicle->model, $vehicle->trim])->filter()->implode(' ')) }}</div>
                                    <div class="vehicle-meta">
                                        {{ $vehicle->price !== null ? '₦' . number_format((float) $vehicle->price, 0) : 'Price on request' }}
                                        @if($vehicle->city || $vehicle->state)
                                            · {{ collect([$vehicle->city, $vehicle->state])->filter()->implode(', ') }}
                                        @endif
                                    </div>
                                </div>
                            </a>
                        @endforeach
                    </div>
                @else
                    <div class="empty-state">This dealer has no active vehicle listings yet.</div>
                @endif
            </section>

            <aside class="dealer-card dealer-side">
                <div class="dealer-side-row">
                    <div class="dealer-side-label">Dealer</div>
                    <div class="dealer-side-value">{{ $dealer->business_name ?: ($dealer->user->name ?? 'Dealer') }}</div>
                </div>
                <div class="dealer-side-row">
                    <div class="dealer-side-label">Location</div>
                    <div class="dealer-side-value">{{ collect([$dealer->city, $dealer->state, $dealer->country])->filter()->implode(', ') ?: 'Not provided' }}</div>
                </div>
                @if($dealer->phone)
                    <div class="dealer-side-row">
                        <div class="dealer-side-label">Phone</div>
                        <div class="dealer-side-value">{{ $dealer->phone }}</div>
                    </div>
                @endif
                @if($dealer->verification_status)
                    <div class="dealer-side-row">
                        <div class="dealer-side-label">Status</div>
                        <div class="dealer-side-value">{{ ucfirst($dealer->verification_status) }}</div>
                    </div>
                @endif
                @if($isSelf)
                    <div class="dealer-side-row">
                        <a href="{{ route('profile.edit') }}" style="color:#ed1b2f;font-size:11px;font-weight:900;text-decoration:none;">Edit your dealer profile</a>
                    </div>
                @endif
            </aside>
        </div>
    </div>
</div>
</body>
</html>
