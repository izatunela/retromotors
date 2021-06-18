<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CustomBrandsModels extends Model
{
	use SoftDeletes;

    protected $table = 'custom_brands_models';
    protected $fillable = ['market_automobile_id','market_motorcycle_id','market_truck_id'];

    //
}
