<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class MarketMotorcyclePhotosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('market_motorcycle_photos', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('market_motorcycle_id');
            $table->string('filename');
            $table->string('path');
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('market_motorcycle_id')->references('id')->on('market_motorcycle');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('market_motorcycle_photos');
    }
}
