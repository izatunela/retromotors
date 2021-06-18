<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use App\Models\Cylinder;

class CylinderTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cylinder', function (Blueprint $table) {
            $table->increments('id');
            $table->tinyInteger('name');
            $table->timestamps();
        });
        $cylinder = [1,2,3,4,5,6];

        foreach ($cylinder as $key => $value) {
        	$brand = new Cylinder;
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
        Schema::dropIfExists('cylinder');
    }
}
