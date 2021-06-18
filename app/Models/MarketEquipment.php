<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Dyrynda\Database\Support\CascadeSoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class MarketEquipment extends Model
{
	use SoftDeletes,CascadeSoftDeletes,HasFactory;

    protected $dates = ['deleted_at'];
	protected $cascadeDeletes = ['marketAllPhotos'];
    protected $table = 'market_equipment';

    public function marketPhotoThumbnail()
    {
    	return $this->hasOne(MarketEquipmentPhoto::class);
    }

    public function marketAllPhotos()
    {
    	return $this->hasMany(MarketEquipmentPhoto::class);
    }

    public function country()
    {
    	return $this->belongsTo(Country::class);
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
