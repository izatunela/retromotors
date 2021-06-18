<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use App\Models\Country;

class CountryTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('country', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->timestamps();
        });

        $countries = ['Srbija'=>'Srbija','Slovenija'=>'Slovenija','Hrvatska'=>'Hrvatska','Bosna i Hercegovina'=>'Bosna i Hercegovina','Crna Gora'=>'Crna Gora','Makedonija'=>'Makedonija'];

        foreach ($countries as $key => $value) {
        	$country = new Country;
        	$country->name = $value;
        	$country->save();
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('country');
    }
}
