<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class MarketEquipmentPhotosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('market_equipment_photos', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('market_equipment_id');
            $table->string('filename');
            $table->string('path');
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('market_equipment_id')->references('id')->on('market_equipment');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('market_equipment_photos');
    }
}
