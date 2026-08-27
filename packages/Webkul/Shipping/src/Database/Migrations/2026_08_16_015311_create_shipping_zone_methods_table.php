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
        Schema::create('shipping_zone_methods', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('shipping_zone_id')->unsigned();
            $table->string('type'); // 'flat_rate', 'free_shipping'
            $table->string('title');
            $table->boolean('is_active')->default(1);
            $table->decimal('price', 12, 4)->default(0);
            $table->decimal('min_weight', 12, 4)->nullable();
            $table->decimal('max_weight', 12, 4)->nullable();
            $table->decimal('min_subtotal', 12, 4)->nullable();
            $table->decimal('max_subtotal', 12, 4)->nullable();
            $table->integer('priority')->default(0);
            $table->timestamps();

            $table->foreign('shipping_zone_id')->references('id')->on('shipping_zones')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('shipping_zone_methods');
    }
};
