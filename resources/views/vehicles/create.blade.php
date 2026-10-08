
<x-app-layout>

    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                Add Vehicle
            </h2>

            <a
                href="{{ route('vehicles.index') }}"
                class="text-sm font-semibold text-gray-600 hover:text-black dark:text-gray-300 dark:hover:text-white"
            >
                ← Back to Vehicles
            </a>
        </div>
    </x-slot>

    <div class="py-10">
        <div class="max-w-5xl mx-auto sm:px-6 lg:px-8">

            <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-sm p-6 md:p-8">

                <div class="mb-8">
                    <h1 class="text-2xl font-bold text-gray-900 dark:text-white">
                        List a Vehicle
                    </h1>

                    <p class="mt-2 text-gray-600 dark:text-gray-400">
                        Add the vehicle details and VIN to your AutoMall inventory.
                    </p>
                </div>

                @if ($errors->any())
                    <div class="mb-6 rounded-lg bg-red-100 border border-red-200 text-red-800 px-5 py-4">
                        <p class="font-semibold mb-2">
                            Please correct the following:
                        </p>

                        <ul class="list-disc list-inside text-sm">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form method="POST" action="{{ route('vehicles.store') }}">
                    @csrf

                    <!-- VIN -->
                    <div class="mb-8">

                        <h3 class="text-lg font-bold text-gray-900 dark:text-white mb-4">
                            VIN Information
                        </h3>

                        <label
                            for="vin"
                            class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2"
                        >
                            Vehicle Identification Number (VIN)
                        </label>

                        <input
                            id="vin"
                            name="vin"
                            type="text"
                            value="{{ old('vin') }}"
                            maxlength="17"
                            minlength="17"
                            required
                            placeholder="Enter 17-character VIN"
                            class="w-full rounded-lg border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white focus:border-red-500 focus:ring-red-500 uppercase"
                        >

                        <p class="mt-2 text-xs text-gray-500 dark:text-gray-400">
                            VIN must contain exactly 17 characters.
                        </p>

                    </div>

                    <!-- Basic Information -->
                    <div class="border-t border-gray-200 dark:border-gray-700 pt-8">

                        <h3 class="text-lg font-bold text-gray-900 dark:text-white mb-4">
                            Vehicle Information
                        </h3>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                            <div>
                                <label for="make" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                    Make *
                                </label>

                                <input
                                    id="make"
                                    name="make"
                                    type="text"
                                    value="{{ old('make') }}"
                                    required
                                    placeholder="e.g. Mercedes-Benz"
                                    class="w-full rounded-lg border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white focus:border-red-500 focus:ring-red-500"
                                >
                            </div>

                            <div>
                                <label for="model" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                    Model *
                                </label>

                                <input
                                    id="model"
                                    name="model"
                                    type="text"
                                    value="{{ old('model') }}"
                                    required
                                    placeholder="e.g. GLK 350"
                                    class="w-full rounded-lg border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white focus:border-red-500 focus:ring-red-500"
                                >
                            </div>

                            <div>
                                <label for="year" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                    Year *
                                </label>

                                <input
                                    id="year"
                                    name="year"
                                    type="number"
                                    value="{{ old('year') }}"
                                    min="1900"
                                    max="2100"
                                    required
                                    placeholder="e.g. 2020"
                                    class="w-full rounded-lg border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white focus:border-red-500 focus:ring-red-500"
                                >
                            </div>

                            <div>
                                <label for="trim" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                    Trim
                                </label>

                                <input
                                    id="trim"
                                    name="trim"
                                    type="text"
                                    value="{{ old('trim') }}"
                                    placeholder="e.g. AMG Line"
                                    class="w-full rounded-lg border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white focus:border-red-500 focus:ring-red-500"
                                >
                            </div>

                            <div>
                                <label for="body_type" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                    Body Type
                                </label>

                                <input
                                    id="body_type"
                                    name="body_type"
                                    type="text"
                                    value="{{ old('body_type') }}"
                                    placeholder="e.g. SUV"
                                    class="w-full rounded-lg border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white focus:border-red-500 focus:ring-red-500"
                                >
                            </div>

                            <div>
                                <label for="color" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                    Color
                                </label>

                                <input
                                    id="color"
                                    name="color"
                                    type="text"
                                    value="{{ old('color') }}"
                                    placeholder="e.g. Black"
                                    class="w-full rounded-lg border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white focus:border-red-500 focus:ring-red-500"
                                >
                            </div>

                        </div>

                    </div>

                    <!-- Mechanical -->
                    <div class="border-t border-gray-200 dark:border-gray-700 pt-8 mt-8">

                        <h3 class="text-lg font-bold text-gray-900 dark:text-white mb-4">
                            Mechanical Details
                        </h3>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                            <div>
                                <label for="engine" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                    Engine
                                </label>

                                <input
                                    id="engine"
                                    name="engine"
                                    type="text"
                                    value="{{ old('engine') }}"
                                    placeholder="e.g. 3.5L V6"
                                    class="w-full rounded-lg border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white focus:border-red-500 focus:ring-red-500"
                                >
                            </div>

                            <div>
                                <label for="transmission" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                    Transmission
                                </label>

                                <input
                                    id="transmission"
                                    name="transmission"
                                    type="text"
                                    value="{{ old('transmission') }}"
                                    placeholder="e.g. Automatic"
                                    class="w-full rounded-lg border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white focus:border-red-500 focus:ring-red-500"
                                >
                            </div>

                            <div>
                                <label for="fuel_type" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                    Fuel Type
                                </label>

                                <input
                                    id="fuel_type"
                                    name="fuel_type"
                                    type="text"
                                    value="{{ old('fuel_type') }}"
                                    placeholder="e.g. Petrol"
                                    class="w-full rounded-lg border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white focus:border-red-500 focus:ring-red-500"
                                >
                            </div>

                            <div>
                                <label for="drivetrain" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                    Drivetrain
                                </label>

                                <input
                                    id="drivetrain"
                                    name="drivetrain"
                                    type="text"
                                    value="{{ old('drivetrain') }}"
                                    placeholder="e.g. AWD"
                                    class="w-full rounded-lg border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white focus:border-red-500 focus:ring-red-500"
                                >
                            </div>

                        </div>

                    </div>

                    <!-- Price and Mileage -->
                    <div class="border-t border-gray-200 dark:border-gray-700 pt-8 mt-8">

                        <h3 class="text-lg font-bold text-gray-900 dark:text-white mb-4">
                            Price & Mileage
                        </h3>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                            <div>
                                <label for="mileage" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                    Mileage
                                </label>

                                <input
                                    id="mileage"
                                    name="mileage"
                                    type="number"
                                    min="0"
                                    value="{{ old('mileage') }}"
                                    placeholder="e.g. 85000"
                                    class="w-full rounded-lg border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white focus:border-red-500 focus:ring-red-500"
                                >
                            </div>

                            <div>
                                <label for="price" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                    Price
                                </label>

                                <input
                                    id="price"
                                    name="price"
                                    type="number"
                                    min="0"
                                    step="0.01"
                                    value="{{ old('price') }}"
                                    placeholder="e.g. 25000000"
                                    class="w-full rounded-lg border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white focus:border-red-500 focus:ring-red-500"
                                >
                            </div>

                        </div>

                    </div>

                    <!-- Location -->
                    <div class="border-t border-gray-200 dark:border-gray-700 pt-8 mt-8">

                        <h3 class="text-lg font-bold text-gray-900 dark:text-white mb-4">
                            Location
                        </h3>

                        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">

                            <div>
                                <label for="city" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                    City
                                </label>

                                <input
                                    id="city"
                                    name="city"
                                    type="text"
                                    value="{{ old('city') }}"
                                    placeholder="e.g. Abuja"
                                    class="w-full rounded-lg border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white focus:border-red-500 focus:ring-red-500"
                                >
                            </div>

                            <div>
                                <label for="state" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                    State
                                </label>

                                <input
                                    id="state"
                                    name="state"
                                    type="text"
                                    value="{{ old('state') }}"
                                    placeholder="e.g. FCT"
                                    class="w-full rounded-lg border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white focus:border-red-500 focus:ring-red-500"
                                >
                            </div>

                            <div>
                                <label for="country" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                    Country *
                                </label>

                                <input
                                    id="country"
                                    name="country"
                                    type="text"
                                    value="{{ old('country', 'Nigeria') }}"
                                    required
                                    class="w-full rounded-lg border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white focus:border-red-500 focus:ring-red-500"
                                >
                            </div>

                        </div>

                    </div>

                    <!-- Description -->
                    <div class="border-t border-gray-200 dark:border-gray-700 pt-8 mt-8">

                        <h3 class="text-lg font-bold text-gray-900 dark:text-white mb-4">
                            Description
                        </h3>

                        <textarea
                            id="description"
                            name="description"
                            rows="5"
                            placeholder="Describe the vehicle..."
                            class="w-full rounded-lg border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white focus:border-red-500 focus:ring-red-500"
                        >{{ old('description') }}</textarea>

                    </div>

                    <!-- Submit -->
                    <div class="border-t border-gray-200 dark:border-gray-700 pt-8 mt-8 flex flex-col sm:flex-row gap-3 justify-end">

                        <a
                            href="{{ route('vehicles.index') }}"
                            class="text-center px-6 py-3 rounded-lg border border-gray-300 text-gray-700 hover:bg-gray-100 transition"
                        >
                            Cancel
                        </a>

                        <button
                            type="submit"
                            class="px-6 py-3 rounded-lg bg-red-600 hover:bg-red-700 text-white font-semibold transition"
                        >
                            Add Vehicle
                        </button>

                    </div>

                </form>

            </div>

        </div>
    </div>

</x-app-layout>
