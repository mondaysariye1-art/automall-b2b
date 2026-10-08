
<x-app-layout>

    <div class="vehicles-page">

        <div class="vehicles-container">

            {{-- Header --}}
            <div class="page-header">
                <div>
                    <h1>My Vehicles</h1>
                    <p>Manage your vehicles</p>
                </div>

                <a href="{{ route('vehicles.create') }}" class="btn btn-black">
                    + Add Vehicle
                </a>
            </div>

            {{-- Messages --}}
            @if (session('success'))
                <div class="message success">
                    {{ session('success') }}
                </div>
            @endif

            @if ($errors->any())
                <div class="message error">
                    @foreach ($errors->all() as $error)
                        <div>{{ $error }}</div>
                    @endforeach
                </div>
            @endif

            {{-- Tabs --}}
            <div class="tabs">

                <button
                    type="button"
                    class="tab active"
                    onclick="showTab('active')"
                    id="activeTab"
                >
                    Active
                    <span>{{ $activeVehicles->count() }}</span>
                </button>

                <button
                    type="button"
                    class="tab"
                    onclick="showTab('sold')"
                    id="soldTab"
                >
                    Sold
                    <span>{{ $soldVehicles->count() }}</span>
                </button>

                <button
                    type="button"
                    class="tab"
                    onclick="showTab('archived')"
                    id="archivedTab"
                >
                    Archived
                    <span>{{ $archivedVehicles->count() }}</span>
                </button>

            </div>


            {{-- ================= ACTIVE ================= --}}

            <div id="activeSection" class="vehicle-section">

                @if ($activeVehicles->count())

                    <div class="vehicle-grid">

                        @foreach ($activeVehicles as $vehicle)

                            <div class="vehicle-card">

                                <div class="vehicle-image">

                                    @php
                                        $photo = $vehicle->media
                                            ->where('type', 'photo')
                                            ->first();
                                    @endphp

                                    @if ($photo)

                                        <img
                                            src="{{ asset('storage/' . $photo->file_path) }}"
                                            alt="{{ $vehicle->make }} {{ $vehicle->model }}"
                                        >

                                    @else

                                        <div class="no-image">
                                            No image
                                        </div>

                                    @endif

                                </div>

                                <div class="vehicle-content">

                                    <span class="status active-status">
                                        ACTIVE
                                    </span>

                                    <h2>
                                        {{ $vehicle->year }}
                                        {{ $vehicle->make }}
                                        {{ $vehicle->model }}
                                    </h2>

                                    <p class="vin">
                                        VIN: {{ $vehicle->vin }}
                                    </p>

                                    @if ($vehicle->price)
                                        <div class="price">
                                            ₦{{ number_format($vehicle->price, 2) }}
                                        </div>
                                    @endif

                                    <a
                                        href="{{ route('vehicles.show', ['vehicle' => $vehicle->id]) }}"
                                        class="btn btn-black full"
                                    >
                                        View Vehicle
                                    </a>

                                    <div class="button-row">

                                        <form
                                            action="{{ route('vehicles.sold', ['vehicle' => $vehicle->id]) }}"
                                            method="POST"
                                        >
                                            @csrf
                                            @method('PATCH')

                                            <button
                                                type="submit"
                                                class="btn btn-yellow"
                                            >
                                                Mark Sold
                                            </button>
                                        </form>

                                        <form
                                            action="{{ route('vehicles.archive', ['vehicle' => $vehicle->id]) }}"
                                            method="POST"
                                        >
                                            @csrf
                                            @method('PATCH')

                                            <button
                                                type="submit"
                                                class="btn btn-gray"
                                            >
                                                Archive
                                            </button>
                                        </form>

                                    </div>

                                </div>

                            </div>

                        @endforeach

                    </div>

                @else

                    <div class="empty">
                        <h2>No Active Vehicles</h2>
                        <p>You currently have no active vehicles.</p>
                    </div>

                @endif

            </div>


            {{-- ================= SOLD ================= --}}

            <div id="soldSection" class="vehicle-section hidden">

                @if ($soldVehicles->count())

                    <div class="vehicle-grid">

                        @foreach ($soldVehicles as $vehicle)

                            <div class="vehicle-card">

                                <div class="vehicle-image">

                                    @php
                                        $photo = $vehicle->media
                                            ->where('type', 'photo')
                                            ->first();
                                    @endphp

                                    @if ($photo)

                                        <img
                                            src="{{ asset('storage/' . $photo->file_path) }}"
                                            alt="{{ $vehicle->make }} {{ $vehicle->model }}"
                                        >

                                    @else

                                        <div class="no-image">
                                            No image
                                        </div>

                                    @endif

                                </div>

                                <div class="vehicle-content">

                                    <span class="status sold-status">
                                        SOLD
                                    </span>

                                    <h2>
                                        {{ $vehicle->year }}
                                        {{ $vehicle->make }}
                                        {{ $vehicle->model }}
                                    </h2>

                                    <p class="vin">
                                        VIN: {{ $vehicle->vin }}
                                    </p>

                                    <a
                                        href="{{ route('vehicles.show', ['vehicle' => $vehicle->id]) }}"
                                        class="btn btn-black full"
                                    >
                                        View Vehicle
                                    </a>

                                </div>

                            </div>

                        @endforeach

                    </div>

                @else

                    <div class="empty">
                        <h2>No Sold Vehicles</h2>
                        <p>Vehicles marked as sold will appear here.</p>
                    </div>

                @endif

            </div>


            {{-- ================= ARCHIVED ================= --}}

            <div id="archivedSection" class="vehicle-section hidden">

                @if ($archivedVehicles->count())

                    <div class="vehicle-grid">

                        @foreach ($archivedVehicles as $vehicle)

                            <div class="vehicle-card">

                                <div class="vehicle-image">

                                    @php
                                        $photo = $vehicle->media
                                            ->where('type', 'photo')
                                            ->first();
                                    @endphp

                                    @if ($photo)

                                        <img
                                            src="{{ asset('storage/' . $photo->file_path) }}"
                                            alt="{{ $vehicle->make }} {{ $vehicle->model }}"
                                        >

                                    @else

                                        <div class="no-image">
                                            No image
                                        </div>

                                    @endif

                                </div>

                                <div class="vehicle-content">

                                    <span class="status archived-status">
                                        ARCHIVED
                                    </span>

                                    <h2>
                                        {{ $vehicle->year }}
                                        {{ $vehicle->make }}
                                        {{ $vehicle->model }}
                                    </h2>

                                    <p class="vin">
                                        VIN: {{ $vehicle->vin }}
                                    </p>

                                    <a
                                        href="{{ route('vehicles.show', ['vehicle' => $vehicle->id]) }}"
                                        class="btn btn-black full"
                                    >
                                        View Vehicle
                                    </a>

                                    <form
                                        action="{{ route('vehicles.restore', ['vehicle' => $vehicle->id]) }}"
                                        method="POST"
                                    >
                                        @csrf
                                        @method('PATCH')

                                        <button
                                            type="submit"
                                            class="btn btn-green full"
                                        >
                                            Re-list Vehicle
                                        </button>

                                    </form>

                                </div>

                            </div>

                        @endforeach

                    </div>

                @else

                    <div class="empty">
                        <h2>No Archived Vehicles</h2>
                        <p>Archived vehicles will appear here.</p>
                    </div>

                @endif

            </div>

        </div>

    </div>


    <style>

        * {
            box-sizing: border-box;
        }

        .vehicles-page {
            background: #f5f5f5;
            min-height: 100vh;
            padding: 40px 20px;
        }

        .vehicles-container {
            max-width: 1200px;
            margin: auto;
        }

        .page-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 30px;
        }

        .page-header h1 {
            margin: 0;
            font-size: 30px;
            font-weight: 700;
            color: #111;
        }

        .page-header p {
            margin: 6px 0 0;
            color: #666;
        }

        .tabs {
            display: flex;
            gap: 5px;
            border-bottom: 1px solid #ddd;
            margin-bottom: 25px;
        }

        .tab {
            border: none;
            background: transparent;
            padding: 14px 22px;
            font-size: 15px;
            font-weight: 700;
            color: #777;
            cursor: pointer;
            border-bottom: 3px solid transparent;
        }

        .tab:hover {
            color: #111;
        }

        .tab.active {
            color: #111;
            border-bottom: 3px solid #111;
        }

        .tab span {
            margin-left: 5px;
            background: #eee;
            padding: 3px 8px;
            border-radius: 20px;
            font-size: 12px;
        }

        .vehicle-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 24px;
        }

        .vehicle-card {
            background: white;
            border: 1px solid #ddd;
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 2px 8px rgba(0,0,0,0.05);
        }

        .vehicle-image {
            width: 100%;
            height: 210px;
            background: #eee;
        }

        .vehicle-image img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            display: block;
        }

        .no-image {
            width: 100%;
            height: 100%;
            display: flex;
            justify-content: center;
            align-items: center;
            color: #888;
            font-size: 15px;
        }

        .vehicle-content {
            padding: 20px;
        }

        .vehicle-content h2 {
            margin: 12px 0 5px;
            font-size: 20px;
            color: #111;
        }

        .vin {
            color: #777;
            font-size: 14px;
            word-break: break-all;
        }

        .price {
            font-size: 20px;
            font-weight: 700;
            margin: 15px 0;
            color: #111;
        }

        .status {
            display: inline-block;
            padding: 5px 10px;
            border-radius: 20px;
            font-size: 11px;
            font-weight: 800;
        }

        .active-status {
            background: #dcfce7;
            color: #166534;
        }

        .sold-status {
            background: #fee2e2;
            color: #991b1b;
        }

        .archived-status {
            background: #e5e7eb;
            color: #374151;
        }

        .btn {
            display: inline-block;
            border: none;
            text-decoration: none;
            cursor: pointer;
            padding: 12px 16px;
            border-radius: 7px;
            font-size: 14px;
            font-weight: 700;
            text-align: center;
            transition: 0.2s;
        }

        .btn-black {
            background: #111;
            color: white !important;
        }

        .btn-black:hover {
            background: #333;
        }

        .btn-yellow {
            background: #d97706;
            color: white;
            width: 100%;
        }

        .btn-yellow:hover {
            background: #b45309;
        }

        .btn-gray {
            background: #4b5563;
            color: white;
            width: 100%;
        }

        .btn-gray:hover {
            background: #374151;
        }

        .btn-green {
            background: #15803d;
            color: white !important;
        }

        .btn-green:hover {
            background: #166534;
        }

        .full {
            width: 100%;
            margin-top: 15px;
        }

        .button-row {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 10px;
            margin-top: 10px;
        }

        .button-row form {
            margin: 0;
        }

        .button-row button {
            width: 100%;
        }

        .empty {
            background: white;
            border: 1px solid #ddd;
            border-radius: 12px;
            padding: 50px 20px;
            text-align: center;
        }

        .empty h2 {
            margin: 0;
            font-size: 20px;
        }

        .empty p {
            color: #777;
            margin-top: 8px;
        }

        .message {
            padding: 14px 18px;
            border-radius: 8px;
            margin-bottom: 20px;
        }

        .success {
            background: #dcfce7;
            color: #166534;
        }

        .error {
            background: #fee2e2;
            color: #991b1b;
        }

        .hidden {
            display: none !important;
        }

        @media (max-width: 900px) {

            .vehicle-grid {
                grid-template-columns: repeat(2, 1fr);
            }

        }

        @media (max-width: 600px) {

            .vehicles-page {
                padding: 25px 15px;
            }

            .page-header {
                flex-direction: column;
                align-items: flex-start;
                gap: 15px;
            }

            .vehicle-grid {
                grid-template-columns: 1fr;
            }

            .tabs {
                overflow-x: auto;
            }

        }

    </style>


    <script>

        function showTab(tab) {

            const sections = [
                'activeSection',
                'soldSection',
                'archivedSection'
            ];

            const tabs = [
                'activeTab',
                'soldTab',
                'archivedTab'
            ];

            sections.forEach(function(section) {
                document
                    .getElementById(section)
                    .classList.add('hidden');
            });

            tabs.forEach(function(button) {
                document
                    .getElementById(button)
                    .classList.remove('active');
            });

            document
                .getElementById(tab + 'Section')
                .classList.remove('hidden');

            document
                .getElementById(tab + 'Tab')
                .classList.add('active');
        }

    </script>

</x-app-layout>
