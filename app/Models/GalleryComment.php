<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GalleryComment extends Model
{
    //
    protected $table = 'gallery_comments';

    protected $appends = ['relative_cdate','formated_cdate'];

    public function galleryItem()
    {
    	return $this->belongsTo(Gallery::class);
    }

	public function user()
    {
    	return $this->belongsTo(User::class);
    }
    public function replies()
    {
    	return $this->hasMany(GalleryComment::class,'parent_id')->with('replies','user');
    }

    public function getRelativeCdateAttribute()
    {
    	return $this->created_at->diffForHumans();
    }

    public function getFormatedCdateAttribute()
    {
    	return $this->created_at->format('j.M.Y G:i:s');
    }
}
