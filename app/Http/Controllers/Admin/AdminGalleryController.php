<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Gallery;

class AdminGalleryController extends Controller
{
    public function gallery(Request $request)
    {
        if ($request->ajax()) {
            return response()->json(['html'=>view('admin/gallery',['ext'=>'admin/admin-master-empty','gallery'=>Gallery::all(),'inactive_gallery'=>Gallery::onlyTrashed()->get()])->render()]);
        }

        return view('admin/gallery',['ext'=>'admin/admin-master','gallery'=>Gallery::all(),'inactive_gallery'=>Gallery::onlyTrashed()->get()]);
    }
    public function galleryDelete(Gallery $id)
    {
        $id->delete();
    }
    public function galleryRestore(Request $req)
    {
        $gallery = Gallery::onlyTrashed()->where('id',$req->id);
        $gallery->restore();
        $restored = Gallery::find($req->id);
        $restored->galleryAllPhotos()->restore();
    }
}
