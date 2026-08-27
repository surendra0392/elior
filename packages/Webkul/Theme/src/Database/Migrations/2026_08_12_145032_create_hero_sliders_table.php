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
        Schema::create('theme_hero_sliders', function (Blueprint $table) {
            $table->increments('id');
            $table->string('code')->unique();
            $table->string('name');
            $table->boolean('status')->default(1);
            $table->string('placement')->default('homepage');
            $table->integer('channel_id')->unsigned()->nullable();
            $table->json('settings')->nullable(); // autoplay, loop, navigation configuration
            $table->timestamps();

            $table->foreign('channel_id')->references('id')->on('channels')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('theme_hero_sliders');
    }
};
