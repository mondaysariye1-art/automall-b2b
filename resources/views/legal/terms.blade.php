<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Terms & Conditions | AutoMall</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-gray-50 text-gray-900">

<div class="min-h-screen">

    <header class="bg-black text-white">
        <div class="mx-auto flex max-w-6xl items-center justify-between px-6 py-5">
            <a href="{{ url('/') }}" class="text-2xl font-black tracking-tight">
                AUTO<span class="text-red-600">AUTOMALL</span>
            </a>

            <a href="{{ route('register') }}"
               class="rounded-lg bg-red-600 px-5 py-2.5 text-sm font-semibold hover:bg-red-700">
                Create Account
            </a>
        </div>
    </header>

    <main class="mx-auto max-w-4xl px-6 py-12">

        <div class="mb-10">
            <p class="mb-2 text-sm font-semibold uppercase tracking-wider text-red-600">
                AutoMall
            </p>

            <h1 class="text-4xl font-black tracking-tight">
                Terms & Conditions
            </h1>

            <p class="mt-3 text-sm text-gray-500">
                Last updated: September 2026
            </p>
        </div>

        <div class="space-y-8 rounded-2xl bg-white p-6 shadow-sm ring-1 ring-gray-200 sm:p-10">

            <section>
                <h2 class="text-xl font-bold">1. About AutoMall</h2>

                <p class="mt-3 leading-7 text-gray-600">
                    AutoMall is a business-to-business automotive marketplace that allows
                    vehicle dealers and automotive businesses to list vehicles, discover
                    vehicles offered by other dealers, create vehicle requests, and
                    communicate with other marketplace participants.
                </p>
            </section>

            <section>
                <h2 class="text-xl font-bold">2. Account Registration</h2>

                <p class="mt-3 leading-7 text-gray-600">
                    To use certain AutoMall features, you must create an account and
                    provide accurate and current information.
                </p>

                <p class="mt-3 leading-7 text-gray-600">
                    You are responsible for maintaining the confidentiality of your
                    account credentials and for activity carried out through your account.
                </p>

                <p class="mt-3 leading-7 text-gray-600">
                    AutoMall may require additional information or verification before
                    granting access to certain marketplace features.
                </p>
            </section>

            <section>
                <h2 class="text-xl font-bold">3. Dealer Accounts</h2>

                <p class="mt-3 leading-7 text-gray-600">
                    AutoMall is intended primarily for automotive dealers and other
                    legitimate automotive businesses. You agree to provide truthful
                    dealership information when creating your business profile.
                </p>

                <p class="mt-3 leading-7 text-gray-600">
                    You must not impersonate another business or create an account using
                    false dealership information.
                </p>
            </section>

            <section>
                <h2 class="text-xl font-bold">4. Vehicle Listings</h2>

                <p class="mt-3 leading-7 text-gray-600">
                    Dealers are responsible for the accuracy of information contained
                    in their vehicle listings, including vehicle identification numbers,
                    mileage, price, condition, specifications, location, photographs,
                    videos, and descriptions.
                </p>

                <p class="mt-3 leading-7 text-gray-600">
                    You must not knowingly publish misleading, fraudulent, stolen,
                    or materially inaccurate vehicle information.
                </p>
            </section>

            <section>
                <h2 class="text-xl font-bold">5. VIN Information</h2>

                <p class="mt-3 leading-7 text-gray-600">
                    AutoMall may validate the structure and check digit of vehicle
                    identification numbers (VINs).
                </p>

                <p class="mt-3 leading-7 text-gray-600">
                    A valid VIN check does not establish that a vehicle has a clean
                    accident history, ownership history, title history, or other
                    defect-free history.
                </p>

                <p class="mt-3 leading-7 text-gray-600">
                    Users are responsible for conducting appropriate vehicle inspections
                    and obtaining any additional vehicle history information they require
                    before completing a transaction.
                </p>
            </section>

            <section>
                <h2 class="text-xl font-bold">6. Vehicle Requests</h2>

                <p class="mt-3 leading-7 text-gray-600">
                    Dealers may create vehicle requests describing vehicles they are
                    looking to purchase or source.
                </p>

                <p class="mt-3 leading-7 text-gray-600">
                    Requests must be genuine business requests and must not contain
                    unlawful, fraudulent, abusive, or misleading content.
                </p>
            </section>

            <section>
                <h2 class="text-xl font-bold">7. Communication</h2>

                <p class="mt-3 leading-7 text-gray-600">
                    AutoMall may provide messaging and other communication features
                    between marketplace participants.
                </p>

                <p class="mt-3 leading-7 text-gray-600">
                    Users are responsible for their communications and must not use
                    AutoMall to harass, threaten, defraud, impersonate, or unlawfully
                    obtain information from another user.
                </p>
            </section>

            <section>
                <h2 class="text-xl font-bold">8. Transactions Between Dealers</h2>

                <p class="mt-3 leading-7 text-gray-600">
                    AutoMall provides marketplace and communication functionality.
                    Unless expressly stated otherwise, AutoMall is not a party to
                    transactions between dealers.
                </p>

                <p class="mt-3 leading-7 text-gray-600">
                    Dealers are responsible for negotiating, inspecting, documenting,
                    and completing transactions with other dealers.
                </p>
            </section>

            <section>
                <h2 class="text-xl font-bold">9. Prohibited Activities</h2>

                <p class="mt-3 leading-7 text-gray-600">
                    Users must not use AutoMall to:
                </p>

                <ul class="mt-3 list-disc space-y-2 pl-6 leading-7 text-gray-600">
                    <li>Publish fraudulent or deliberately misleading listings.</li>
                    <li>Use another person's account without authorization.</li>
                    <li>Impersonate a dealer, business, or individual.</li>
                    <li>Upload unlawful or malicious content.</li>
                    <li>Attempt to gain unauthorized access to the platform.</li>
                    <li>Abuse or interfere with AutoMall's systems.</li>
                    <li>Use the platform for unlawful activities.</li>
                </ul>
            </section>

            <section>
                <h2 class="text-xl font-bold">10. Content and Media</h2>

                <p class="mt-3 leading-7 text-gray-600">
                    You retain responsibility for photographs, videos, descriptions,
                    and other content you upload to AutoMall.
                </p>

                <p class="mt-3 leading-7 text-gray-600">
                    By uploading content, you confirm that you have the necessary rights
                    to use and publish that content.
                </p>
            </section>

            <section>
                <h2 class="text-xl font-bold">11. Account Suspension or Termination</h2>

                <p class="mt-3 leading-7 text-gray-600">
                    AutoMall may restrict, suspend, or terminate an account where there
                    is a violation of these Terms, suspected fraud, misuse of the
                    marketplace, or activity that may compromise the security of users
                    or the platform.
                </p>
            </section>

            <section>
                <h2 class="text-xl font-bold">12. Marketplace Information</h2>

                <p class="mt-3 leading-7 text-gray-600">
                    AutoMall does not guarantee that every listing, dealer, vehicle,
                    photograph, description, price, or other marketplace information
                    is accurate, complete, current, or suitable for a particular
                    transaction.
                </p>

                <p class="mt-3 leading-7 text-gray-600">
                    Users should independently verify important information before
                    making business decisions.
                </p>
            </section>

            <section>
                <h2 class="text-xl font-bold">13. Privacy</h2>

                <p class="mt-3 leading-7 text-gray-600">
                    Your use of AutoMall is also subject to our Privacy Policy, which
                    explains how information may be collected, used, stored, and handled.
                </p>
            </section>

            <section>
                <h2 class="text-xl font-bold">14. Changes to These Terms</h2>

                <p class="mt-3 leading-7 text-gray-600">
                    AutoMall may update these Terms & Conditions from time to time.
                    Updated terms will be published on this page with a revised
                    effective date.
                </p>
            </section>

            <section>
                <h2 class="text-xl font-bold">15. Contact</h2>

                <p class="mt-3 leading-7 text-gray-600">
                    If you have questions about these Terms & Conditions, please use
                    the contact information provided through the AutoMall platform.
                </p>
            </section>

        </div>

        <div class="mt-8 text-center">
            <a href="{{ route('register') }}"
               class="font-semibold text-red-600 hover:text-red-700">
                ← Back to Create Account
            </a>
        </div>

    </main>

</div>

</body>
</html>