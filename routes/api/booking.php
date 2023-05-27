<?php

use App\Http\Controllers\Booking\OfferController;
use App\Http\Controllers\Booking\ProviderController;
use Illuminate\Support\Facades\Route;

Route::prefix('booking')->group(function () {

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
