<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Dyrynda\Database\Support\CascadeSoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class MarketParts extends Model
{
	use SoftDeletes,CascadeSoftDeletes,HasFactory;

	protected $dates = ['deleted_at'];
	protected $cascadeDeletes = ['marketAllPhotos'];
	protected $table = 'market_parts';

	public function marketPhotoThumbnail()
	{
		return $this->hasOne(MarketPartsPhoto::class);
	}

	public function marketAllPhotos()
	{
		return $this->hasMany(MarketPartsPhoto::class);
	}

	public function country()
    {
    	return $this->belongsTo(Country::class);
    }

    public function vehicle()
    {
    	return $this->belongsTo(VehicleCategory::class,'vehicle_category_id');
    }
    public function getBrandIdAttribute($value)
    {
		$vehicle_cat = $this->vehicle->name;
		if ($vehicle_cat === 'automobile') {
			$brand_name = BrandsAutomobile::find($value)->name;
		} else if ($vehicle_cat === 'motorcycle'){
			$brand_name = BrandsMotorcycle::find($value)->name;
		}else {
			$brand_name = BrandsTruck::find($value)->name;
		}
		return $brand_name;
	}

    public function condition()
    {
    	return $this->belongsTo(PartEquipCondition::class);
	}

	public function user()
	{
		return $this->belongsTo(User::class);
	}
}
