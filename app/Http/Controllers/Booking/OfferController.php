<?php

namespace App\Http\Controllers\Booking;

use App\Enums\Constants;
use App\Http\Controllers\Controller;
use App\Http\Resources\Booking\OfferResponse;
use App\Models\Booking\Offer;
use App\Models\Booking\Provider;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;


class OfferController extends Controller
{
    /**
     * UserController constructor
     */
    public function __construct()
    {
        $this->middleware(['auth:sanctum']);
        $this->authorizeResource(Offer::class, 'offer');
    }

    /**
     * Display a listing of the resource.
     */
    public function index(): AnonymousResourceCollection
    {
        return OfferResponse::collection(
            Offer::query()->simplePaginate(Constants::ELEMENTS_PER_PAGE)
        );
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return OfferResponse
     */
    public function store(Request $request): OfferResponse
    {
        $validator = $this->validate($request, [
            'provider_id' => [
                'required',
                'integer',
                'exists:' . (new Provider())->getTable() . ',id'
            ],
            'name' => ['required', 'string'],
            'description' => ['required', 'string'],
            'type' => ['required', 'string'],
            // Capacity
            'max_adults' => ['required', 'integer', 'min:0'],
            'max_childs' => ['required', 'integer', 'min:0'],
            // Price
            'price_adult' => ['required', 'decimal', 'min:0'],
            'price_child' => ['required', 'decimal', 'min:0'],
        ]);

        $offer = Offer::create($validator);

        return new OfferResponse($offer);
    }

    /**
     * Show the specified resource.
     * @param Offer $offer
     * @return OfferResponse
     */
    public function show(Offer $offer): OfferResponse
    {
        return new OfferResponse($offer);
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param Offer $offer
     * @return OfferResponse
     */
    public function update(Request $request, Offer $offer): OfferResponse
    {
        $validator = $this->validate($request, [
            'provider_id' => [
                'nullable',
                'integer',
                'exists:' . (new Provider())->getTable() . ',id'
            ],
            'name' => ['nullable', 'string'],
            'description' => ['nullable', 'string'],
            'type' => ['nullable', 'string'],
            // Capacity
            'max_adults' => ['nullable', 'integer', 'min:0'],
            'max_childs' => ['nullable', 'integer', 'min:0'],
            // Price
            'price_adult' => ['nullable', 'decimal', 'min:0'],
            'price_child' => ['nullable', 'decimal', 'min:0'],
        ]);

        $offer->update($validator);

        return new OfferResponse($offer);
    }

    /**
     * Remove the specified resource from storage.
     * @param Offer $offer
     * @return Response
     */
    public function destroy(Offer $offer): bool|null
    {
        return $offer->delete();
    }
}
