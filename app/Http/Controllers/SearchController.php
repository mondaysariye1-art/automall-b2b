<?php

namespace App\Http\Controllers;

use App\Models\Dealer;
use App\Models\Vehicle;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Schema;

class SearchController extends Controller
{
    public function index(Request $request)
    {
        $type = strtolower(trim((string) $request->query('type', 'all')));
        $allowedTypes = ['all', 'vehicles', 'dealers', 'vin'];

        if (! in_array($type, $allowedTypes, true)) {
            $type = 'all';
        }

        $term = trim((string) $request->query('q', ''));

        if ($type === 'vin') {
            return $this->vinPage($request, $term);
        }

        $city = trim((string) $request->query('city', ''));
        $state = trim((string) $request->query('state', ''));
        $minPrice = $request->query('min_price');
        $maxPrice = $request->query('max_price');
        $condition = trim((string) $request->query('condition', ''));
        $country = trim((string) $request->query('country', ''));
        $sort = strtolower(trim((string) $request->query('sort', 'relevance')));
        $dealerId = $request->query('dealer_id');

        $conditionColumnAvailable = Schema::hasColumn('vehicles', 'condition');
        $countryColumnAvailable = Schema::hasColumn('vehicles', 'country_of_origin');

        $vehicleQuery = Vehicle::query()
            ->with([
                'dealer.user',
                'media',
            ])
            ->where('status', 'active');

        if ($dealerId !== null && $dealerId !== '') {
            $vehicleQuery->where('dealer_id', (int) $dealerId);
        }

        if ($term !== '') {
            $search = '%' . $term . '%';

            $vehicleQuery->where(function ($query) use ($search, $term) {
                $query->where('make', 'like', $search)
                    ->orWhere('model', 'like', $search)
                    ->orWhere('trim', 'like', $search)
                    ->orWhere('body_type', 'like', $search)
                    ->orWhere('color', 'like', $search)
                    ->orWhere('engine', 'like', $search)
                    ->orWhere('transmission', 'like', $search)
                    ->orWhere('fuel_type', 'like', $search)
                    ->orWhere('drivetrain', 'like', $search)
                    ->orWhere('vin', 'like', $search)
                    ->orWhere('city', 'like', $search)
                    ->orWhere('state', 'like', $search)
                    ->orWhere('country', 'like', $search)
                    ->orWhere('year', 'like', $search);

                if (Schema::hasColumn('vehicles', 'condition')) {
                    $query->orWhere('condition', 'like', $search);
                }

                if (Schema::hasColumn('vehicles', 'country_of_origin')) {
                    $query->orWhere('country_of_origin', 'like', $search);
                }

                $query->orWhereHas('dealer', function ($dealerQuery) use ($search) {
                    $dealerQuery->where('business_name', 'like', $search)
                        ->orWhere('city', 'like', $search)
                        ->orWhere('state', 'like', $search)
                        ->orWhere('country', 'like', $search)
                        ->orWhereHas('user', function ($userQuery) use ($search) {
                            $userQuery->where('name', 'like', $search);
                        });
                });
            });
        }

        if ($city !== '') {
            $vehicleQuery->whereRaw('LOWER(city) = ?', [mb_strtolower($city)]);
        }

        if ($state !== '') {
            $vehicleQuery->whereRaw('LOWER(state) = ?', [mb_strtolower($state)]);
        }

        if ($minPrice !== null && $minPrice !== '' && is_numeric($minPrice)) {
            $vehicleQuery->where('price', '>=', (float) $minPrice);
        }

        if ($maxPrice !== null && $maxPrice !== '' && is_numeric($maxPrice)) {
            $vehicleQuery->where('price', '<=', (float) $maxPrice);
        }

        if ($conditionColumnAvailable && $condition !== '') {
            $vehicleQuery->whereRaw('LOWER(condition) = ?', [mb_strtolower($condition)]);
        }

        if ($countryColumnAvailable && $country !== '') {
            $vehicleQuery->where('country_of_origin', 'like', '%' . $country . '%');
        }

        switch ($sort) {
            case 'newest':
                $vehicleQuery->latest();
                break;

            case 'price_low':
                $vehicleQuery->orderByRaw('price IS NULL ASC')->orderBy('price', 'asc');
                break;

            case 'price_high':
                $vehicleQuery->orderByRaw('price IS NULL ASC')->orderBy('price', 'desc');
                break;

            default:
                $vehicleQuery->latest();
                break;
        }

        $dealerQuery = Dealer::query()
            ->with('user');

        if ($term !== '') {
            $search = '%' . $term . '%';

            $dealerQuery->where(function ($query) use ($search) {
                $query->where('business_name', 'like', $search)
                    ->orWhere('city', 'like', $search)
                    ->orWhere('state', 'like', $search)
                    ->orWhere('country', 'like', $search)
                    ->orWhereHas('user', function ($userQuery) use ($search) {
                        $userQuery->where('name', 'like', $search)
                            ->orWhere('email', 'like', $search);
                    });
            });
        }

        if ($city !== '') {
            $dealerQuery->whereRaw('LOWER(city) = ?', [mb_strtolower($city)]);
        }

        if ($state !== '') {
            $dealerQuery->whereRaw('LOWER(state) = ?', [mb_strtolower($state)]);
        }

        if ($dealerId !== null && $dealerId !== '') {
            $dealerQuery->whereKey((int) $dealerId);
        }

        $cities = Vehicle::query()
            ->where('status', 'active')
            ->whereNotNull('city')
            ->where('city', '!=', '')
            ->distinct()
            ->orderBy('city')
            ->pluck('city');

        $states = Vehicle::query()
            ->where('status', 'active')
            ->whereNotNull('state')
            ->where('state', '!=', '')
            ->distinct()
            ->orderBy('state')
            ->pluck('state');

        if ($type === 'vehicles') {
            $vehicles = $vehicleQuery->paginate(12, ['*'], 'vehicles_page')->withQueryString();
            $dealers = collect();
            $vehiclePaginator = $vehicles;
            $dealerPaginator = null;
        } elseif ($type === 'dealers') {
            $vehicles = collect();
            $vehiclePaginator = null;
            $dealers = $dealerQuery->latest('id')->paginate(12, ['*'], 'dealers_page')->withQueryString();
            $dealerPaginator = $dealers;
        } else {
            $vehicles = $vehicleQuery->take(9)->get();
            $dealers = $dealerQuery->latest('id')->take(9)->get();
            $vehiclePaginator = null;
            $dealerPaginator = null;
        }

        return view('search.index', [
            'type' => $type,
            'term' => $term,
            'city' => $city,
            'state' => $state,
            'minPrice' => $minPrice,
            'maxPrice' => $maxPrice,
            'condition' => $condition,
            'country' => $country,
            'sort' => $sort,
            'dealerId' => $dealerId,
            'conditionColumnAvailable' => $conditionColumnAvailable,
            'countryColumnAvailable' => $countryColumnAvailable,
            'cities' => $cities,
            'states' => $states,
            'vehicles' => $vehicles,
            'dealers' => $dealers,
            'vehiclePaginator' => $vehiclePaginator,
            'dealerPaginator' => $dealerPaginator,
            'vinResult' => null,
            'vinSource' => null,
            'vinError' => null,
            'localVehicle' => null,
        ]);
    }

    public function suggestions(Request $request)
    {
        $term = trim((string) $request->query('q', ''));
        $cleanTerm = mb_strtolower($term);

        if ($term === '' || mb_strlen($term) < 2) {
            return response()->json([
                'dealers' => [],
                'vehicles' => [],
            ]);
        }

        /*
         * VIN validation is only performed when the browser explicitly asks
         * for it. Normal searches never call the VIN decoder.
         */
        if ($request->boolean('check_vin') && $this->looksLikeVin($term)) {
            $vin = strtoupper($term);

            $localVehicle = Vehicle::query()
                ->whereRaw('UPPER(vin) = ?', [$vin])
                ->first();

            if ($localVehicle) {
                return response()->json([
                    'dealers' => [],
                    'vehicles' => [],
                    'vin_valid' => true,
                    'vin_error' => null,
                ]);
            }

            [$vinResult, $vinError] = $this->decodeExternalVin($vin);

            return response()->json([
                'dealers' => [],
                'vehicles' => [],
                'vin_valid' => ! is_null($vinResult),
                'vin_error' => $vinError,
            ]);
        }

        $search = '%' . $term . '%';

        /*
         * Keep the endpoint small: fetch only a small candidate set, then
         * rank the candidates in PHP using exact/start/word-start/contains.
         */
        $currentDealerId = $request->user()
            ? Dealer::where('user_id', $request->user()->id)->value('id')
            : null;

        $dealers = Dealer::query()
            ->with('user')
            ->where(function ($query) use ($search) {
                $query->where('business_name', 'like', $search)
                    ->orWhere('city', 'like', $search)
                    ->orWhere('state', 'like', $search)
                    ->orWhere('country', 'like', $search)
                    ->orWhereHas('user', function ($userQuery) use ($search) {
                        $userQuery->where('name', 'like', $search);
                    });
            })
            ->limit(20)
            ->get()
            ->map(function (Dealer $dealer) use ($cleanTerm, $currentDealerId) {
                $businessName = trim((string) ($dealer->business_name ?? ''));
                $userName = trim((string) ($dealer->user->name ?? ''));
                $city = trim((string) ($dealer->city ?? ''));
                $state = trim((string) ($dealer->state ?? ''));

                $rank = min([
                    $this->matchRank($businessName, $cleanTerm),
                    $this->matchRank($userName, $cleanTerm),
                    $this->matchRank($city, $cleanTerm),
                    $this->matchRank($state, $cleanTerm),
                ]);

                return [
                    'id' => $dealer->id,
                    'name' => $businessName !== '' ? $businessName : ($userName !== '' ? $userName : 'Dealer'),
                    'location' => collect([$city, $state])->filter()->implode(', '),
                    'is_self' => (int) $dealer->id === (int) $currentDealerId,
                    'url' => (int) $dealer->id === (int) $currentDealerId
                        ? route('profile.edit')
                        : route('public.dealers.show', $dealer),
                    '_rank' => $rank === PHP_INT_MAX ? 999 : $rank,
                ];
            })
            ->sortBy([
                ['_rank', 'asc'],
                ['name', 'asc'],
            ])
            ->take(7)
            ->map(function (array $dealer) {
                unset($dealer['_rank']);
                return $dealer;
            })
            ->values();

        $vehicles = Vehicle::query()
            ->with(['dealer'])
            ->where('status', 'active')
            ->where(function ($query) use ($search) {
                $query->where('make', 'like', $search)
                    ->orWhere('model', 'like', $search)
                    ->orWhere('trim', 'like', $search)
                    ->orWhere('body_type', 'like', $search)
                    ->orWhere('year', 'like', $search)
                    ->orWhere('city', 'like', $search)
                    ->orWhere('state', 'like', $search)
                    ->orWhere('vin', 'like', $search)
                    ->orWhereHas('dealer', function ($dealerQuery) use ($search) {
                        $dealerQuery->where('business_name', 'like', $search);
                    });
            })
            ->limit(25)
            ->get()
            ->map(function (Vehicle $vehicle) use ($cleanTerm) {
                $title = trim(collect([
                    $vehicle->year,
                    $vehicle->make,
                    $vehicle->model,
                    $vehicle->trim,
                ])->filter()->implode(' '));

                $dealerName = trim((string) ($vehicle->dealer?->business_name ?? ''));
                $make = trim((string) ($vehicle->make ?? ''));
                $model = trim((string) ($vehicle->model ?? ''));
                $trim = trim((string) ($vehicle->trim ?? ''));
                $year = trim((string) ($vehicle->year ?? ''));
                $bodyType = trim((string) ($vehicle->body_type ?? ''));

                $rank = min([
                    $this->matchRank($title, $cleanTerm),
                    $this->matchRank($make, $cleanTerm),
                    $this->matchRank($model, $cleanTerm),
                    $this->matchRank($trim, $cleanTerm),
                    $this->matchRank($year, $cleanTerm),
                    $this->matchRank($bodyType, $cleanTerm),
                    $this->matchRank($dealerName, $cleanTerm),
                ]);

                return [
                    'id' => $vehicle->id,
                    'title' => $title !== '' ? $title : 'Vehicle',
                    'dealer' => $dealerName !== '' ? $dealerName : null,
                    'location' => collect([$vehicle->city, $vehicle->state])->filter()->implode(', '),
                    'url' => route('public.vehicles.show', $vehicle),
                    '_rank' => $rank === PHP_INT_MAX ? 999 : $rank,
                ];
            })
            ->sortBy([
                ['_rank', 'asc'],
                ['title', 'asc'],
            ])
            ->take(10)
            ->map(function (array $vehicle) {
                unset($vehicle['_rank']);
                return $vehicle;
            })
            ->values();

        return response()->json([
            'dealers' => $dealers,
            'vehicles' => $vehicles,
        ]);
    }

    private function looksLikeVin(string $value): bool
    {
        return (bool) preg_match('/^[A-HJ-NPR-Z0-9]{17}$/i', trim($value));
    }

    private function matchRank(?string $value, string $term): int
    {
        $value = mb_strtolower(trim((string) $value));

        if ($value === '' || $term === '') {
            return PHP_INT_MAX;
        }

        if ($value === $term) {
            return 0;
        }

        if (str_starts_with($value, $term)) {
            return 1;
        }

        if (preg_match('/(?:^|[\\s\\-\\/\\,\\.\\(])' . preg_quote($term, '/') . '/iu', $value)) {
            return 2;
        }

        if (str_contains($value, $term)) {
            return 3;
        }

        return PHP_INT_MAX;
    }

    public function vin(Request $request, ?string $vin = null)
    {
        $term = strtoupper(trim((string) ($vin ?: $request->query('vin', ''))));

        return $this->vinPage($request, $term);
    }

    private function vinPage(Request $request, string $term)
    {
        $term = strtoupper(preg_replace('/[^A-Z0-9]/', '', $term));
        $vinResult = null;
        $vinSource = null;
        $vinError = null;
        $localVehicle = null;

        if ($term !== '') {
            if (strlen($term) !== 17) {
                $vinError = 'A VIN must contain exactly 17 characters.';
            } else {
                $localVehicle = Vehicle::query()
                    ->with(['dealer.user', 'media'])
                    ->whereRaw('UPPER(vin) = ?', [$term])
                    ->first();

                if ($localVehicle) {
                    $vinResult = [
                        'Make' => $localVehicle->make,
                        'Model' => $localVehicle->model,
                        'ModelYear' => $localVehicle->year,
                        'Trim' => $localVehicle->trim,
                        'BodyClass' => $localVehicle->body_type,
                        'Manufacturer' => null,
                        'PlantCity' => null,
                        'PlantCountry' => $localVehicle->country,
                        'Engine' => $localVehicle->engine,
                        'Transmission' => $localVehicle->transmission,
                        'FuelTypePrimary' => $localVehicle->fuel_type,
                        'DriveType' => $localVehicle->drivetrain,
                        'VehicleType' => null,
                    ];

                    $vinSource = 'AutoMall inventory';
                } else {
                    [$vinResult, $vinError] = $this->decodeExternalVin($term);
                    $vinSource = $vinResult ? 'NHTSA vPIC' : null;
                }
            }
        }

        $myDealer = $request->user()
            ? Dealer::where('user_id', $request->user()->id)->first()
            : null;

        $cities = Vehicle::query()
            ->where('status', 'active')
            ->whereNotNull('city')
            ->where('city', '!=', '')
            ->distinct()
            ->orderBy('city')
            ->pluck('city');

        $states = Vehicle::query()
            ->where('status', 'active')
            ->whereNotNull('state')
            ->where('state', '!=', '')
            ->distinct()
            ->orderBy('state')
            ->pluck('state');

        return view('search.index', [
            'type' => 'vin',
            'term' => $term,
            'city' => '',
            'state' => '',
            'minPrice' => null,
            'maxPrice' => null,
            'condition' => '',
            'country' => '',
            'sort' => 'relevance',
            'dealerId' => null,
            'conditionColumnAvailable' => Schema::hasColumn('vehicles', 'condition'),
            'countryColumnAvailable' => Schema::hasColumn('vehicles', 'country_of_origin'),
            'cities' => $cities,
            'states' => $states,
            'vehicles' => collect(),
            'dealers' => collect(),
            'vehiclePaginator' => null,
            'dealerPaginator' => null,
            'vinResult' => $vinResult,
            'vinSource' => $vinSource,
            'vinError' => $vinError,
            'localVehicle' => $localVehicle,
        ]);
    }

    private function decodeExternalVin(string $vin): array
    {
        try {
            $response = Http::timeout(12)
                ->acceptJson()
                ->get('https://vpic.nhtsa.dot.gov/api/vehicles/DecodeVinValuesExtended/' . urlencode($vin), [
                    'format' => 'json',
                ]);

            if (! $response->successful()) {
                return [null, 'The external VIN service could not be reached right now.'];
            }

            $payload = $response->json();
            $results = $payload['Results'] ?? [];
            $result = is_array($results) && isset($results[0]) ? $results[0] : null;

            if (! is_array($result)) {
                return [null, 'No vehicle information was returned for this VIN.'];
            }

            $errorCode = trim((string) ($result['ErrorCode'] ?? ''));
            $make = trim((string) ($result['Make'] ?? ''));
            $model = trim((string) ($result['Model'] ?? ''));
            $modelYear = trim((string) ($result['ModelYear'] ?? ''));

            $hasVehicleData = ($make !== '' || $model !== '' || $modelYear !== '');
            $hardError = in_array($errorCode, ['6', '400'], true);

            if ($hardError || ! $hasVehicleData) {
                $errorText = trim((string) ($result['ErrorText'] ?? ''));
                return [null, $errorText !== '' ? $errorText : 'The VIN could not be decoded.'];
            }

            return [$result, null];
        } catch (\Throwable $e) {
            report($e);

            return [null, 'The external VIN service is temporarily unavailable.'];
        }
    }
}
