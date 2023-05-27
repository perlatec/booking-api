<?php

namespace App\Http\Controllers\Booking;

use App\Enums\Constants;
use App\Http\Controllers\Controller;
use App\Http\Resources\Booking\ProviderResponse;
use App\Models\Booking\Provider;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;


class ProviderController extends Controller
{
    /**
     * UserController constructor
     */
    public function __construct()
    {
        $this->middleware(['auth:sanctum']);
        $this->authorizeResource(Provider::class, 'provider');
    }

    /**
     * Display a listing of the resource.
     */
    public function index(): AnonymousResourceCollection
    {
        return ProviderResponse::collection(
            Provider::query()->simplePaginate(Constants::ELEMENTS_PER_PAGE)
        );
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return ProviderResponse
     */
    public function store(Request $request): ProviderResponse
    {
        $validator = $this->validate($request, [
            'name' => ['required', 'string'],
            'description' => ['required', 'string'],
            'api_token' => ['required', 'string'],
        ]);

        $provider = Provider::create($validator);

        return new ProviderResponse($provider);
    }

    /**
     * Show the specified resource.
     * @param Provider $provider
     * @return ProviderResponse
     */
    public function show(Provider $provider): ProviderResponse
    {
        return new ProviderResponse($provider);
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param Provider $provider
     * @return ProviderResponse
     */
    public function update(Request $request, Provider $provider): ProviderResponse
    {
        $validator = $this->validate($request, [
            'name' => ['nullable', 'string'],
            'description' => ['nullable', 'string'],
            'api_token' => ['nullable', 'string'],
        ]);

        $provider->update($validator);

        return new ProviderResponse($provider);
    }

    /**
     * Remove the specified resource from storage.
     * @param Provider $provider
     * @return Response
     */
    public function destroy(Provider $provider): bool|null
    {
        return $provider->delete();
    }
}
