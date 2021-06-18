<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Gallery;
use App\Models\GalleryPhoto;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use App\Http\Requests\FormGallery;

// use App\Models\MarketAutomobile;


use Image;
// use App\Http\Controllers\Controller;

class GalleryController extends Controller
{
	public function __construct()
	{
		$this->middleware('auth')->except(['index','show']);
	}

	public function index()
	{
		$gallery = Gallery::with('galleryPhotoThumbnail')->orderBy('created_at','desc')->paginate(12);
		// $auto = MarketAutomobile::withTrashed()->first();

		// if($auto->restore()){
		// 	$auto->galleryAllPhotos()->restore();
		// }
		// $auto = MarketAutomobile::first();
		// if (!is_null($auto)) {
		// 	$auto->delete();
		// }

		return view('gallery/index',compact('gallery'));
	}

	public function create()
	{
		$galleryID = auth()->user()->id.uniqid(); // dodatni random na uuid
    	session(['galleryID'=>$galleryID]);

		return view('gallery/create');
	}

	public function storeTempImages(Request $request)
	{
		$user = $request->user();

		if ($request->hasFile('gallery_photos')) {
			$files = $request->file('gallery_photos');
			// $temp_path = 'public/Images/User_images/'.$username.'/Gallery_images/temp/'.session('galleryID').'/';
			$temp_path = 'public/Images/User_images/Gallery_images/temp/'.session('galleryID').'/';
			foreach($files as $file){
				$extension = $file->getClientOriginalExtension();
				$file->storeAs($temp_path,$file->getClientOriginalName());
			}
		}
	}

	public function editGetPhotos(Request $request)
	{
		$item = Gallery::find($request->id);
		$photos = $item->galleryAllPhotos;

		return response()->json(['photos'=>$photos,'photos_len'=>$photos->count()]);
	}

	public function storeEditTempImages(Request $request)
	{
		$user = $request->user();

		if ($request->hasFile('gallery_photos')) {
			$files = $request->file('gallery_photos');
			// $temp_path = 'public/Images/User_images/'.$username.'/Gallery_images/edit-temp/'.session('galleryID').'/';
			$temp_path = 'public/Images/User_images/Gallery_images/edit-temp/'.session('galleryID').'/';
			foreach($files as $file){
				$extension = $file->getClientOriginalExtension();
				$file->storeAs($temp_path,$request->fn);
			}
		}
	}

	public function store(FormGallery $request)
	{
		ini_set('memory_limit','256M');
		$user = $request->user();
		$username 					= $user->name_slug;

		$title_slug = Str::slug($request->title,'-');

		$gallery_item = new Gallery;

		$gallery_item->user_id 		= $user->id;
		$gallery_item->title_slug 	= $title_slug;
		$gallery_item->title 		= $request->title;
		$gallery_item->description 	= $request->description;
		$gallery_item->save();

		$gallery_id = $gallery_item->id;
		// $temp_photos_path 	= 'public/Images/User_images/'.$username.'/Gallery_images/temp/'.session('galleryID').'/';
		$temp_photos_path 	= 'public/Images/User_images/Gallery_images/temp/'.session('galleryID').'/';
		$perm_photos_path 	= 'public/Images/User_images/'.$username.'/Gallery_images/'.$gallery_id.'_'.$title_slug.'/';
		$db_path 			= 'Images/User_images/'.$username.'/Gallery_images/'.$gallery_id.'_'.$title_slug.'/';

		$temp_photos = Storage::files($temp_photos_path);

		$photos_order = json_decode($request->photosOrder);
		foreach ($photos_order as $photo) {
			$extension = pathinfo($photo,PATHINFO_EXTENSION);
			$prefix = uniqid();
			$filename = $prefix.'.'.$extension;
			Storage::move($temp_photos_path.$photo,$perm_photos_path.$filename);

			$galleryPhoto 								= new GalleryPhoto;
			$galleryPhoto->gallery_id 					= $gallery_id;
			$galleryPhoto->filename 					= $filename;
			$galleryPhoto->path 						= $db_path;
			$galleryPhoto->save();

			$img = Image::make(storage_path().'/app/'.$perm_photos_path.$filename);
			$thumbnail = clone $img;
			$watermark = Image::make(public_path('img/wm.png'));

			$img->insert($watermark, 'bottom-right', 10, 10);
			$img->save();

			$thumbnail->resize(220, null, function ($constraint) {
				$constraint->aspectRatio();
			});
			$thumbnail->save(storage_path().'/app/'.$perm_photos_path.'/tn-'.$filename);
		}
		Storage::deleteDirectory($temp_photos_path);

		return response()->json(['id'=>$gallery_item->id,'title'=>$gallery_item->title_slug]);
	}

	public function show(Gallery $id)
	{
		session()->forget('comment');
		return view('gallery/item',['gallery_item'=>$id]);
	}

	public function edit()
	{
		$galleryID = auth()->user()->id.uniqid();
		session(['galleryID'=>$galleryID]);

		$item = Gallery::find(request()->id);
		$this->authorize('change',$item);

		return view('gallery/edit',['item'=>$item]);
	}

	public function update(FormGallery $request)
	{
		$item 				= Gallery::find($request->id);
		$user 				= $request->user();
		$new_title 			= $request->title;
		$new_title_slug 	= Str::slug($new_title,'-');
		$title_slug 		= $item->title_slug;

		$this->authorize('change',$item);

		$item->title_slug 	= $new_title_slug;
		$item->title 		= $request->title;
		$item->description 	= $request->description;
		$item->save();

		$ordered_photos 	= json_decode($request->orderedPhotos);
		$delete_list 		= json_decode($request->deleteList);

		if (!empty($delete_list)) {
			$this->deleteStoredImage($user,$request->id,$title_slug,$delete_list);
		}

		$this->storeUpdateImages($user,$request->id,$title_slug,$new_title_slug,$item,$ordered_photos);

		return response()->json(['id'=>$item->id,'title'=>$item->title_slug]);

	}

	public function delete(Gallery $item)
	{
		$this->authorize('change',$item);

		$item->delete();

		return redirect()->back();
	}

	private function deleteStoredImage($user,$gallery_id,$title_slug,$delete_list)
	{
		$username = $user->name_slug;

		$perm_photos_path 	= 'public/Images/User_images/'.$username.'/Gallery_images/'.$gallery_id.'_'.$title_slug.'/';

		$galleryItem = Gallery::find($gallery_id);

		$uploadovaneFotke = $galleryItem->galleryAllPhotos;

		foreach ($uploadovaneFotke as $key => $photo) {
			if (in_array($photo->filename, $delete_list)) {
				$photo->delete();
				Storage::delete([$perm_photos_path.$photo->filename,$perm_photos_path.'tn-'.$photo->filename]);
			}
		}
	}

	private function storeUpdateImages($user,$gallery_id,$title_slug,$new_title_slug,$item,$ordered_photos)
	{
		ini_set('memory_limit','256M');

		$username 					= $user->name_slug;

		// $temp_photos_path 	= 'public/Images/User_images/'.$username.'/Gallery_images/edit-temp/'.session('galleryID').'/';
		$temp_photos_path 	= 'public/Images/User_images/Gallery_images/edit-temp/'.session('galleryID').'/';
		$perm_photos_path 	= 'public/Images/User_images/'.$username.'/Gallery_images/'.$gallery_id.'_'.$new_title_slug.'/';
		$old_perm_photos_path 	= 'public/Images/User_images/'.$username.'/Gallery_images/'.$gallery_id.'_'.$title_slug.'/';
		$db_path 			= 'Images/User_images/'.$username.'/Gallery_images/'.$gallery_id.'_'.$new_title_slug.'/';

		rename(storage_path('/app/'.$old_perm_photos_path), storage_path('/app/'.$perm_photos_path));
		$temp_photos = Storage::files($temp_photos_path);


		foreach ($temp_photos as $key => $temp_photo) {
			foreach ($ordered_photos as $key => $photo) {
				if (basename($temp_photo) == $photo) {
					$extension = pathinfo($temp_photo,PATHINFO_EXTENSION);
					$prefix = uniqid();
					$filename = $prefix.'.'.$extension;
					$ordered_photos[$key] = $filename;


					Storage::move($temp_photo,$perm_photos_path.$filename);

					$galleryPhoto 								= new GalleryPhoto;
					$galleryPhoto->gallery_id 					= $gallery_id;
					$galleryPhoto->filename 					= $filename;
					$galleryPhoto->path 						= $db_path;
					$galleryPhoto->save();

					$img = Image::make(storage_path().'/app/'.$perm_photos_path.$filename);
					$thumbnail = clone $img;
					$watermark = Image::make(public_path('img/wm.png'));
					$img->insert($watermark, 'bottom-right', 10, 10);
					$img->save();
					$thumbnail->resize(220, null, function ($constraint) {
						$constraint->aspectRatio();
					});
					$thumbnail->save(storage_path().'/app/'.$perm_photos_path.'/tn-'.$filename);
				}

			}
		}

		$uploadovaneFotke = $item->galleryAllPhotos;

		foreach ($uploadovaneFotke as $key => $val) {
			$uploadovaneFotke[$key]->filename = $ordered_photos[$key];
			$uploadovaneFotke[$key]->path = $db_path;
			$uploadovaneFotke[$key]->save();
		}

		Storage::deleteDirectory($temp_photos_path);
	}
}
