<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class MarketPartsPhotosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('market_parts_photos', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('market_parts_id');
            $table->string('filename');
            $table->string('path');
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('market_parts_id')->references('id')->on('market_parts');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('market_parts_photos');
    }
}
