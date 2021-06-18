<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use App\Models\VehicleRegistration;

class VehicleRegistrationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vehicle_registration', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->timestamps();
        });

        $vehicle_registration = ['Registrovan','Neregistrovan','Strane tablice','Odjavljen'];

        foreach ($vehicle_registration as $key => $value) {
        	$brand = new VehicleRegistration;
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
        Schema::dropIfExists('vehicle_registration');
    }
}
