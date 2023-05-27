<?php

use App\Http\Controllers\Booking\OfferController;
use App\Http\Controllers\Booking\ProviderController;
use Illuminate\Support\Facades\Route;

Route::prefix('booking')->group(function () {

    Route::prefix('offers')->group(function () {
        Route::get('filter', [OfferController::class, 'filter']);
    });

    /**
     * -----------------------------------------
     *	JsonResources
     * -----------------------------------------
     */

    Route::apiResources([
        'offers' => OfferController::class,
        'providers' => ProviderController::class,
    ]);
});
