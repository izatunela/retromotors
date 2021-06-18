<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Requests\FormComment;
use App\Models\GalleryComment;
use App\Models\Gallery;

class GalleryCommentsController extends Controller
{
	public function __construct()
	{
		$this->middleware('auth')->except(['getComments','storeInSession']);
	}
	public function getComments(Request $request)
	{
		$tnow = time();
		$ses = session('tlastreq')??0;
		$lastDate = Carbon::createFromTimestamp((int)$ses)->toDateTimeString();
		$request->session()->forget('tlastreq');
    	$comments = GalleryComment::with('replies','user')->where('gallery_id',$request->gallery_id)->where('created_at','>',$lastDate)->get();
		$totalcomments = Gallery::find($request->gallery_id)->comments()->count();
		session(['tlastreq'=>0]);

		return response()->json(['comments'=>$comments,'total'=>$totalcomments,'tnow'=>$tnow]);
	}
    public function store(FormComment $request,Gallery $galleryItem)
    {
		$tlastreq = $request->tlastreq;
		$comment = new GalleryComment;
		$comment->body = $request->body;
		$comment->gallery_id = $galleryItem->id;
		$comment->user_id = auth()->user()->id;
		$comment->parent_id = $request->parent_id;
		$comment->save();
		session(['tlastreq'=>$tlastreq]);

		return response()->json(['comment'=>$comment,'tlastreq'=>$tlastreq]);
	}
	public function storeInSession(Request $request)
	{
		session(['comment'=>$request->comment,'url.intended'=>url()->previous().'#comments-section']);

		return response()->json('ok');
	}
}
