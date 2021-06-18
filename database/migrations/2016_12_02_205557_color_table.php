<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use App\Models\Color;

class ColorTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('color',function (Blueprint $table){
        	$table->increments('id');
        	$table->string('name');
            $table->timestamps();
        });

        $colors = ['Bela','Bež','Bordo','Braon','Crna','Crvena','Narandzasta','Plava','Siva','Srebrna','Tirkiz','Teget','Zelena','Zlatna','Žuta','Ostalo'];

        foreach ($colors as $key => $value) {
        	$brand = new Color;
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
        Schema::dropIfExists('color');
    }
}
