<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class MarketMotorcyclePhoto extends Model
{
	use SoftDeletes,HasFactory;

	protected $table = 'market_motorcycle_photos';

	// public function marketMoto()
	// {
	// 	$this->belongsTo(MarketMotorcycle::class);
	// }
}
