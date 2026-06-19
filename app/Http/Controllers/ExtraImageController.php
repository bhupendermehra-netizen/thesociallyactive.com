<?php

namespace App\Http\Controllers;
use App\Models\Page;
use App\Models\ExtraImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

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
		$req->validate([
			'banner' => 'required|image|mimes:jpeg,png,jpg,gif,webp|max:5120',
			'page' => 'required|string|max:255',
		]);

		$extraImage = new ExtraImage();
		$img = $req->banner->store("image", "public");
		$extraImage->banner = $img;
		$extraImage->page = $req->page;
		$extraImage->save();
		
		return redirect()->route("admin.extraImage",$extraImage->page)->with('success', 'Image added successfully!');
	}
	public function update(Request $req,$id){
		$extraImage = ExtraImage::findOrFail($id);

		$req->validate([
			'banner' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:5120',
			'page' => 'required|string|max:255',
		]);
		
		if(!empty($req->banner)){
			$img = $req->banner->store("image", "public");
			
			$oldPath = storage_path('app/public/' . $extraImage->banner);
			if (file_exists($oldPath)) {
				unlink($oldPath);
			}
		}else{
			$img = $extraImage->banner;
		}
		$extraImage->banner = $img;
		$extraImage->page = $req->page;
		$extraImage->save();
		
		return redirect()->route("admin.extraImage",$extraImage->page)->with('success', 'Image updated successfully!');
	}
	public function delete($id){
		$extraImage = ExtraImage::findOrFail($id);
		$oldPath = storage_path('app/public/' . $extraImage->banner);
		if (file_exists($oldPath)) {
			@unlink($oldPath);
		}
		$extraImage->delete();
		return redirect()->back()->with('success', 'Image deleted successfully!');
		
	}
}
