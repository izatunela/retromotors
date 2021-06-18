<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class MarketPartsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('market_parts', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('user_id');
            $table->unsignedInteger('views')->default(0);
            $table->string('title_slug');
            $table->string('title');
            $table->unsignedInteger('vehicle_category_id');
            $table->unsignedInteger('brand_id'); //ovde je moglo foreign ali 3 tabele za brendove
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
            $table->foreign('vehicle_category_id')->references('id')->on('vehicle_category');
            $table->foreign('condition_id')->references('id')->on('part_equip_condition');
            $table->foreign('country_id')->references('id')->on('country');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('market_parts');
    }
}
