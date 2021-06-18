<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use App\Models\TypeMotorcycle;

class TypeMotorcycleTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('type_motorcycle', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->timestamps();
        });

        $type = ['Street','Cafe Racer','Cruiser','Sport','Touring','Scrambler','Off-Road','Moped'];

        foreach ($type as $key => $value) {
        	$brand = new TypeMotorcycle;
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
        Schema::dropIfExists('type_motorcycle');
    }
}
