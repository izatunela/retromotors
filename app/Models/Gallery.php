<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Dyrynda\Database\Support\CascadeSoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Gallery extends Model
{
	use SoftDeletes,CascadeSoftDeletes,HasFactory;

    protected $table = 'gallery';
	protected $dates = ['deleted_at'];
	protected $cascadeDeletes = ['galleryAllPhotos'];

    public function comments()
    {
    	return $this->hasMany(GalleryComment::class);
    }

    public function galleryPhotoThumbnail()
    {
    	return $this->hasOne(GalleryPhoto::class);
    }

    public function galleryAllPhotos()
    {
    	return $this->hasMany(GalleryPhoto::class);
    }

	public function user()
    {
    	return $this->belongsTo(User::class);
    }


}
