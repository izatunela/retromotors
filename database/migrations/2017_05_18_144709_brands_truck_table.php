<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Str;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use App\Models\BrandsTruck;

class BrandsTruckTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('brands_truck', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name_slug');
            $table->string('name');
            $table->timestamps();
        });

        $arr = "AM General,Citroen,DAF,Dodge,FAP,Fiat,Ford,Freightliner,GAZ,GMC,International,Isuzu,Iveco,Kamaz,Kenworth,KrAZ,Magirus Deutz,Mack,MAN,MAZ,Mercedes-Benz,Mitsubishi,Peterbilt,Pinzgauer,Raba,Renault,Saurer,Scania,Steyr,TAM,Tata,Tatra,Volkswagen,Volvo,Zastava,ZiL,Ostalo";

        $brands_arr = explode(',',$arr);

        foreach ($brands_arr as $key => $value) {
        	$brand = new BrandsTruck;
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
        Schema::dropIfExists('brands_truck');
    }
}
