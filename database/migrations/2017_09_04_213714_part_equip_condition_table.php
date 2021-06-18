<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use App\Models\PartEquipCondition;

class PartEquipConditionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('part_equip_condition', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->timestamps();
        });

        $part_equip_condition = ['Novo','Polovno'];

        foreach ($part_equip_condition as $key => $value) {
        	$brand = new PartEquipCondition;
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
        Schema::dropIfExists('part_equip_condition');
    }
}
