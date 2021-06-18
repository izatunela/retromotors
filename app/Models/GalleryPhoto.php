<?php

namespace App\Models;

use App\Gallery;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class GalleryPhoto extends Model
{
	use SoftDeletes,HasFactory;

    protected $table = 'gallery_photos';

    public function gallery()
    {
        return $this->belongsTo(Gallery::class);
    }
}
