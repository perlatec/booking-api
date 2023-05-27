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
            'price_adult' => ['required', 'decimal:0,2', 'min:0'],
            'price_child' => ['required', 'decimal:0,2', 'min:0'],
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
            'price_adult' => ['nullable', 'decimal:0,2', 'min:0'],
            'price_child' => ['nullable', 'decimal:0,2', 'min:0'],
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

    /**
     * -----------------------------------------
     *	Custom endpoints
     * -----------------------------------------
     */

    public function filter(Request $request): AnonymousResourceCollection
    {
        $validator = $this->validate($request, [
            'name' => ['nullable', 'string'],
            'description' => ['nullable', 'string'],
            'type' => ['nullable', 'string'],
            // Capacity
            'max_adults' => ['nullable', 'integer', 'min:0'],
            'max_childs' => ['nullable', 'integer', 'min:0'],
            // Price
            'price_adult' => ['nullable', 'decimal:0,2', 'min:0'],
            'price_child' => ['nullable', 'decimal:0,2', 'min:0'],
        ]);

        $qry = Offer::query();

        if (array_key_exists('name', $validator))
            $qry = $qry->where('name', 'like', '%' . $validator['name'] . '%');
        if (array_key_exists('max_adults', $validator))
            $qry = $qry->where('max_adults', '<=', $validator['max_adults']);
        if (array_key_exists('max_childs', $validator))
            $qry = $qry->where('max_childs', '<=', $validator['max_childs']);
        if (array_key_exists('price_adult', $validator))
            $qry = $qry->where('price_adult', '<=', $validator['price_adult']);
        if (array_key_exists('price_child', $validator))
            $qry = $qry->where('price_child', '<=', $validator['price_child']);

        return OfferResponse::collection($qry->simplePaginate(Constants::ELEMENTS_PER_PAGE));
    }
}
