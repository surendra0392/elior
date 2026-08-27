<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('recipes', function (Blueprint $table) {
            $table->increments('id');
            $table->boolean('status')->default(0);
            $table->string('featured_image')->nullable();
            $table->integer('prep_time')->nullable()->comment('Preparation time in minutes');
            $table->integer('cook_time')->nullable()->comment('Cooking time in minutes');
            $table->integer('difficulty')->default(1)->comment('1: Easy, 2: Medium, 3: Hard');
            $table->integer('servings')->nullable()->comment('Number of servings');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('recipes');
    }
};
