<?php

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
        Schema::create('shipping_zone_locations', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('shipping_zone_id')->unsigned();
            $table->string('location_type'); // 'country', 'state', 'postcode'
            $table->string('location_code');
            $table->timestamps();

            $table->foreign('shipping_zone_id')->references('id')->on('shipping_zones')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('shipping_zone_locations');
    }
};
