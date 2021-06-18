<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Str;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use App\Models\BrandsAutomobile;

class BrandsAutomobileTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('brands_automobile', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name_slug');
            $table->string('name');
            $table->timestamps();
        });

        $arr = "Alfa Romeo,Amphicar,Aston Martin,Audi,Austin,Bentley,Bugatti,BMW,Buick,Cadillac,Chevrolet,Chrysler,Citroen,Dacia,Daihatsu,Datsun,DeLorean,Dodge,Ferrari,Fiat,Ford,GAZ,GMC,Honda,Hummer,Hyundai,Isuzu,Jaguar,Jeep,Kia,Lada,Lamborghini,Lancia,Land Rover,Lincoln,Lotus,Maserati,Matra,Mazda,Maybach,Mercedes-Benz,MG,Mini,Mitsubishi,McLaren,Morgan,Moskvitch,Nissan,NSU,Oldsmobile,Opel,Peugeot,Pontiac,Packard,Porsche,Renault,Rolls Royce,Rover,Saab,Seat,Simca,Subaru,Suzuki,Škoda,Talbot,Tavria,Toyota,Trabant,Triumph,TVR,UAZ,VW,Volvo,Wartburg,Zastava,Ostalo";

        $brands_arr = explode(',',$arr);

        foreach ($brands_arr as $key => $value) {
        	$brand = new BrandsAutomobile;
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
        Schema::dropIfExists('brands_automobile');
    }
}
