<?php

use App\Models\Booking\Provider;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('booking_offers', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Provider::class)
                ->constrained((new Provider())->getTable());

            $table->string('name');
            $table->text('description');
            $table->string('type');
            // Capacity
            $table->unsignedTinyInteger('max_adults')->default(0);
            $table->unsignedTinyInteger('max_childs')->default(0);
            // Prices
            $table->unsignedDecimal('price_adult', 8, 2)->default(0);
            $table->unsignedDecimal('price_child', 8, 2)->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('booking_offers');
    }
};
