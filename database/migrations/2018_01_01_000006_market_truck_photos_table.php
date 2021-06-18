<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class MarketTruckPhotosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('market_truck_photos', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('market_truck_id');
            $table->string('filename');
            $table->string('path');
            $table->timestamps();
            $table->softDeletes();

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
        Schema::dropIfExists('market_truck_photos');
    }
}
