<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class MarketEquipmentTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('market_equipment', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('user_id');
            $table->unsignedInteger('views')->default(0);
            $table->string('title_slug');
            $table->string('title');
            $table->unsignedInteger('country_id');
            $table->string('city');
            $table->unsignedInteger('condition_id');
            $table->unsignedInteger('price')->nullable();
            $table->unsignedTinyInteger('fixed_price')->nullable();
            $table->unsignedTinyInteger('negotiate_price')->nullable();
            $table->text('description');
            $table->string('contact_phone');
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('user_id')->references('id')->on('user');
            $table->foreign('country_id')->references('id')->on('country');
            $table->foreign('condition_id')->references('id')->on('part_equip_condition');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('market_equipment');
    }
}
