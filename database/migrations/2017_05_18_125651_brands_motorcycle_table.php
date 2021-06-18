<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Str;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use App\Models\BrandsMotorcycle;

class BrandsMotorcycleTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('brands_motorcycle', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name_slug');
            $table->string('name');
            $table->timestamps();
        });

        $arr = "Aprilia,BSA,Benelli,Bimota,BMW,Buell,Cagiva,Derbi,DKW,Dnepr,Ducati,Gilera,Harley Davidson,Hercules,Honda,Husqvarna,Indian,Jawa,Kawasaki,KTM,Laverda,Moto Guzzi,Moto Morini,MV Agusta,MZ,Norton,NSU,Piaggio,Puch,Royal Enfield,Suzuki,Tomos,Triumph,Ural,Vespa,Yamaha,Ostalo";

        $brands_arr = explode(',',$arr);

        foreach ($brands_arr as $key => $value) {
        	$brand = new BrandsMotorcycle;
        	$brand->name_slug = Str::slug($value);
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
        Schema::dropIfExists('brands_motorcycle');
    }
}
