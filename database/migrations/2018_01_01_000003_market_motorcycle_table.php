<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class MarketMotorcycleTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('market_motorcycle', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('user_id');
            $table->unsignedInteger('views')->default(0);
            $table->string('title_slug');
            $table->string('title');
            $table->unsignedInteger('brand_id');
            $table->string('model');
            $table->unsignedInteger('type_id');
            $table->unsignedInteger('manufacture_year');
            $table->unsignedInteger('country_id');
            $table->string('city');
            $table->unsignedInteger('vehicle_registration_id');
            $table->unsignedInteger('condition_id');
            $table->unsignedInteger('color_id');
            $table->unsignedInteger('transmission_id');
            $table->unsignedInteger('kilometerage');
            $table->unsignedInteger('volume');
            $table->unsignedInteger('cylinder_id');
            $table->unsignedInteger('power');
            $table->unsignedInteger('price')->nullable();
            $table->unsignedTinyInteger('fixed_price')->nullable();
            $table->unsignedTinyInteger('negotiate_price')->nullable();
            $table->text('description');
            $table->string('contact_phone');
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('user_id')->references('id')->on('user');
            $table->foreign('brand_id')->references('id')->on('brands_motorcycle');
            $table->foreign('type_id')->references('id')->on('type_motorcycle');
            $table->foreign('country_id')->references('id')->on('country');
            $table->foreign('vehicle_registration_id')->references('id')->on('vehicle_registration');
            $table->foreign('condition_id')->references('id')->on('vehicle_condition');
            $table->foreign('color_id')->references('id')->on('color');
            $table->foreign('transmission_id')->references('id')->on('transmission');
            $table->foreign('cylinder_id')->references('id')->on('cylinder');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('market_motorcycle');
    }
}
