<?php

namespace App\Http\Controllers;
use App\Models\Page;
use App\Models\ExtraImage;
use Illuminate\Http\Request;

class ExtraImageController extends Controller
{
	public function index($page){
		$page_find = Page::select("page")->wherePage($page)->first();
		if(is_null($page_find)){
		abort(404);
		}
		$extraImage = ExtraImage::wherePage($page)->get();
		
		return view("admin.extra_images.index",compact('extraImage','page'));
	}
    public function add($page=null){
		$pages = Page::select("page")->groupBy("page")->get();
		
		return view("admin.extra_images.add",compact('pages','page'));
	}
	public function edit($id){
		$extraImage = ExtraImage::findOrFail($id);
		$pages = Page::select("page")->groupBy("page")->get();
		
		
		return view("admin.extra_images.edit",compact('extraImage','pages'));
	}
	public function create(Request $req){
		$extraImage = new ExtraImage();
		
		if(!empty($req->banner)){
			$img = $req->banner->store("image");
		}else{
			dd("please insert image");
		}
		$extraImage->banner = $img;
		$extraImage->page = $req->page;
		$extraImage->save();
		
		return redirect()->route("admin.extraImage",$extraImage->page);
	}
	public function update(Request $req,$id){
		$extraImage = ExtraImage::findOrFail($id);
		
		if(!empty($req->banner)){
			$img = $req->banner->store("image");
			
			unlink("storage/".$extraImage->banner);
		}else{
			$img = $extraImage->banner;
		}
		$extraImage->banner = $img;
		$extraImage->page = $req->page;
		$extraImage->save();
		
		return redirect()->route("admin.extraImage",$extraImage->page);
	}
	public function delete($id){
		$extraImage = ExtraImage::findOrFail($id);
		if(file_exists("storage/".$extraImage->banner)){
			unlink("storage/".$extraImage->banner);
		}
		$extraImage->delete();
		return redirect()->back();
		
	}
}
