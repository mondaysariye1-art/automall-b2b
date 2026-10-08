<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Create Dealer Profile - AutoMall</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-gray-100">

    <div class="min-h-screen flex items-center justify-center px-4 py-10">

        <div class="w-full max-w-2xl bg-white rounded-2xl shadow-lg p-8">

            <div class="mb-8">
                <h1 class="text-3xl font-bold text-gray-900">
                    Create Your Dealer Profile
                </h1>

                <p class="mt-2 text-gray-600">
                    Set up your AutoMall dealership profile.
                </p>
            </div>

            @if ($errors->any())
                <div class="mb-6 rounded-lg bg-red-100 p-4 text-red-700">
                    <ul class="list-disc pl-5">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form method="POST" action="{{ route('dealer.store') }}" class="space-y-5">

                @csrf

                <div>
                    <label class="block text-sm font-medium text-gray-700">
                        Business Name
                    </label>

                    <input
                        type="text"
                        name="business_name"
                        value="{{ old('business_name') }}"
                        required
                        class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm"
                        placeholder="e.g. Elite Motors"
                    >
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700">
                        Phone
                    </label>

                    <input
                        type="text"
                        name="phone"
                        value="{{ old('phone') }}"
                        class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm"
                        placeholder="+234..."
                    >
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700">
                        Description
                    </label>

                    <textarea
                        name="description"
                        rows="4"
                        class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm"
                        placeholder="Tell other dealers about your dealership..."
                    >{{ old('description') }}</textarea>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700">
                        Address
                    </label>

                    <input
                        type="text"
                        name="address"
                        value="{{ old('address') }}"
                        class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm"
                        placeholder="Dealership address"
                    >
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-5">

                    <div>
                        <label class="block text-sm font-medium text-gray-700">
                            City
                        </label>

                        <input
                            type="text"
                            name="city"
                            value="{{ old('city') }}"
                            class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm"
                            placeholder="Abuja"
                        >
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700">
                            State
                        </label>

                        <input
                            type="text"
                            name="state"
                            value="{{ old('state') }}"
                            class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm"
                            placeholder="FCT"
                        >
                    </div>

                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700">
                        Country
                    </label>

                    <input
                        type="text"
                        name="country"
                        value="{{ old('country', 'Nigeria') }}"
                        required
                        class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm"
                    >
                </div>

                <button
                    type="submit"
                    class="w-full rounded-lg bg-red-600 px-6 py-3 font-semibold text-white hover:bg-red-700"
                >
                    Create Dealer Profile
                </button>

            </form>

        </div>

    </div>

</body>
</html>