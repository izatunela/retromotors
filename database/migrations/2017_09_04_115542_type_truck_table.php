<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use App\Models\TypeTruck;

class TypeTruckTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('type_truck', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->timestamps();
        });

        $type = ['Kamion', 'Kombi', 'Autobus', 'Kamper'];

        foreach ($type as $key => $value) {
        	$brand = new TypeTruck;
        	$brand->name = $value;
        	$brand->save();
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('type_truck');
    }
}
