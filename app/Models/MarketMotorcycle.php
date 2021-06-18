<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Dyrynda\Database\Support\CascadeSoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class MarketMotorcycle extends Model
{
	use SoftDeletes,CascadeSoftDeletes,HasFactory;

	protected $dates = ['deleted_at'];
	protected $cascadeDeletes = ['marketAllPhotos','customBrandModel'];
	protected $table = 'market_motorcycle';

	public function marketPhotoThumbnail()
	{
		return $this->hasOne(MarketMotorcyclePhoto::class);
	}

	public function marketAllPhotos()
	{
		return $this->hasMany(MarketMotorcyclePhoto::class);
	}

	public function country()
    {
    	return $this->belongsTo(Country::class);
    }

    public function brand()
    {
    	return $this->belongsTo(BrandsMotorcycle::class);
    }
    public function customBrandModel()
    {
    	return $this->hasOne(CustomBrandsModels::class);
    }
    public function type()
    {
    	return $this->belongsTo(TypeMotorcycle::class);
    }
    public function vehicleRegistration()
    {
    	return $this->belongsTo(VehicleRegistration::class);
    }
    public function condition()
    {
    	return $this->belongsTo(VehicleCondition::class);
    }
    public function transmission()
    {
    	return $this->belongsTo(Transmission::class);
    }

    public function cylinder()
    {
    	return $this->belongsTo(Cylinder::class);
    }

	public function color()
    {
    	return $this->belongsTo(Color::class);
    }

	public function user()
	{
		return $this->belongsTo(User::class);
	}
}
