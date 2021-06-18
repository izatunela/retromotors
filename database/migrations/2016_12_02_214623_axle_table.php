<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use App\Models\Axle;

class AxleTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('axle', function (Blueprint $table) {
            $table->increments('id');
            $table->tinyInteger('name');
            $table->timestamps();
        });

        $axle = [2,3,4,5,6];

        foreach ($axle as $key => $value) {
        	$brand = new Axle;
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
        Schema::dropIfExists('axle');
    }
}
