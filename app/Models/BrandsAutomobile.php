<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BrandsAutomobile extends Model
{
    protected $table = 'brands_automobile';
    // public $timestamps = false;

    public function getAutoModels()
    {
    	return $this->hasMany(ModelsAutomobile::class,'brands_automobile_id');
    }

    public function market()
    {
    	return $this->hasMany(MarketAutomobile::class,'brand_id');
    }

}
