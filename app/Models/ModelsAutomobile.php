<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ModelsAutomobile extends Model
{
    protected $table = 'models_automobile';
    // public $timestamps = false;

    public function getBrand()
    {
    	return $this->belongsTo(BrandsAutomobile::class,'brands_automobile_id');
    }
    public function market()
    {
    	return $this->hasMany(MarketAutomobile::class,'model_id');
    }
}
