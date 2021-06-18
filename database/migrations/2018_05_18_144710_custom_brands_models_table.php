<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CustomBrandsModelsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('custom_brands_models', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('market_automobile_id')->nullable();
            $table->unsignedInteger('market_motorcycle_id')->nullable();
            $table->unsignedInteger('market_truck_id')->nullable();
            $table->string('name_slug');
            $table->string('brand')->nullable();
            $table->string('model')->nullable();
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('market_automobile_id')->references('id')->on('market_automobile');
            $table->foreign('market_motorcycle_id')->references('id')->on('market_motorcycle');
            $table->foreign('market_truck_id')->references('id')->on('market_truck');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('custom_brands_models');
    }
}
