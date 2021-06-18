<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class MarketTruckPhoto extends Model
{
	use SoftDeletes,HasFactory;

    protected $table = 'market_truck_photos';
}
