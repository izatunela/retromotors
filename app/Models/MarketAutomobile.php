<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Dyrynda\Database\Support\CascadeSoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Carbon\Carbon;

class MarketAutomobile extends Model
{
	use SoftDeletes,CascadeSoftDeletes,HasFactory;

	protected $dates = ['deleted_at'];
	protected $cascadeDeletes = ['marketAllPhotos','customBrandModel'];
    protected $table = 'market_automobile';

    public function marketPhotoThumbnail()
    {
    	return $this->hasOne(MarketAutomobilePhoto::class);
    }

    public function marketAllPhotos()
    {
    	return $this->hasMany(MarketAutomobilePhoto::class);
    }

    public function country()
    {
    	return $this->belongsTo(Country::class);
    }

    public function brand()
    {
    	return $this->belongsTo(BrandsAutomobile::class);
    }

    public function customBrandModel()
    {
    	return $this->hasOne(CustomBrandsModels::class);
    }

	public function model()
    {
    	return $this->belongsTo(ModelsAutomobile::class);
    }
    public function type()
    {
    	return $this->belongsTo(TypeAutomobile::class);
    }
    public function vehicleRegistration()
    {
    	return $this->belongsTo(VehicleRegistration::class);
    }
    public function condition()
    {
    	return $this->belongsTo(VehicleCondition::class);
    }
	public function color()
    {
    	return $this->belongsTo(Color::class);
    }
    public function transmission()
    {
    	return $this->belongsTo(Transmission::class);
    }
    public function fuel()
    {
    	return $this->belongsTo(Fuel::class);
    }
    public function drivetrain()
    {
    	return $this->belongsTo(Drivetrain::class);
    }

    public function user()
    {
    	return $this->belongsTo(User::class);
    }
}
