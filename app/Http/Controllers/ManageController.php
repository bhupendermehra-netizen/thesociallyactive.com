<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Page;
use App\Models\User;
use App\Models\Query;
use App\Models\ExtraImage;

use Illuminate\Support\Facades\Hash;


class ManageController extends Controller
{
    public function index(Request $request){
        
        
        
$pages["home_banner"] = json_decode(Page::wherePage("Home")->whereSection("home_banner")->first()->fields);
$pages["about_section"] = json_decode(Page::wherePage("Home")->whereSection("about_section")->first()->fields);
$pages["who_we_are"] = json_decode(Page::wherePage("Home")->whereSection("who_we_are")->first()->fields);
$pages["who_we_help"] = json_decode(Page::wherePage("Home")->whereSection("who_we_help")->first()->fields);
$pages["video_section"] = json_decode(Page::wherePage("Home")->whereSection("video_section")->first()->fields);
$pages["expertise_section"] = json_decode(Page::wherePage("Home")->whereSection("expertise_section")->first()->fields);
$pages["card_section_1"] = json_decode(Page::wherePage("Home")->whereSection("card_section_1")->first()->fields);
$pages["card_section_2"] = json_decode(Page::wherePage("Home")->whereSection("card_section_2")->first()->fields);
$pages["card_section_3"] = json_decode(Page::wherePage("Home")->whereSection("card_section_3")->first()->fields);
$pages["card_section_4"] = json_decode(Page::wherePage("Home")->whereSection("card_section_4")->first()->fields);
$pages["values_section"] = json_decode(Page::wherePage("Home")->whereSection("values_section")->first()->fields);
$pages["brands_section"] = json_decode(Page::wherePage("Home")->whereSection("brands_section")->first()->fields);
$pages["impact_section"] = json_decode(Page::wherePage("Home")->whereSection("impact_section")->first()->fields);
$pages["testimonial_section"] = json_decode(Page::wherePage("Home")->whereSection("testimonial_section")->first()->fields);
        
        
        return view("index",compact("pages"));
    }
    public function about(){
        $pages["about_heading"] = json_decode(Page::wherePage("About")->whereSection("about_heading")->first()->fields);
        $pages["passion_section"] = json_decode(Page::wherePage("About")->whereSection("passion_section")->first()->fields);
        $pages["founder_section"] = json_decode(Page::wherePage("About")->whereSection("founder_section")->first()->fields);
        $pages["story_section"] = json_decode(Page::wherePage("About")->whereSection("story_section")->first()->fields);

        return view("about",compact("pages"));
    }
	public function extraPage($slug){
		
		$pageSearch = Page::whereSection("Important-Page-Slug")->get();
		$page = "";
		foreach($pageSearch as $data){
		if(isset(json_decode($data->fields)[0]) && json_decode($data->fields)[0]->link == $slug){
			$page = $data->page;
		}
		}
		
		if($page == "" || empty($page)){
		abort(404);
		}
		
        $pages["content"] = json_decode(Page::wherePage($page)->whereSection("Content")->first()->fields);
		
        
        

        return view("extra_page",compact('pages','page'));
    }
	public function service($slug){
		
		$pageSearch = Page::whereSection("Service-Page-Slug")->get();
		$page = "";
		foreach($pageSearch as $data){
		if(isset(json_decode($data->fields)[0]) && json_decode($data->fields)[0]->link == $slug){
			$page = $data->page;
		}
		}
		
		if($page == "" || empty($page)){
		abort(404);
		}
		
        $pages["banner"] = json_decode(Page::wherePage($page)->whereSection("banner")->first()->fields);
		
        $pages["strip_1"] = json_decode(Page::wherePage($page)->whereSection("strip_1")->first()->fields);
        $pages["brand_service_section"] = json_decode(Page::wherePage($page)->whereSection("brand_service_section")->first()->fields);
        $pages["strip_2"] = json_decode(Page::wherePage($page)->whereSection("strip_2")->first()->fields);
        $pages["talk_section"] = json_decode(Page::wherePage($page)->whereSection("talk_section")->first()->fields);
        $pages["explore_section"] = json_decode(Page::wherePage($page)->whereSection("explore_section")->first()->fields);
        

        return view("service_page",compact('pages','page'));
    }
		public function contact(){
        
        
        return view("contact");
    }
	
	
	public function queryStore(Request $request){
        $query = Query::create($request->all());
        return redirect()->route('thankyou');
    }
	public function thankyou(){
        $pages["thankyou"] = json_decode(Page::wherePage("Thankyou")->whereSection("thanks")->first()->fields);
        return view('thankyou',compact('pages'));
    }
    public function dashboard()
    {
        return view('admin.index');
    }
    public function page(){
        $pages = Page::select("page")->groupBy("page")->get();

        return view("admin.pages.index",compact("pages"));
    }
    public function pageView($page){
        $pages = Page::wherePage($page)->get();
        $extraImage = ExtraImage::wherePage($page)->count();

        return view("admin.pages.view_detail",compact("pages","extraImage","page"));
    }
    public function pageAdd(){
        $pages = Page::select("page")->groupBy("page")->get();

        return view("admin.pages.add",compact("pages"));
    }
    public function pageEdit($id){
        $page = Page::findorfail($id);

        return view("admin.pages.edit",compact("page"));
    }
    public function pageStore(Request $request){
        $type = $request->type;
        $fields = [];
        
        foreach($type as $key => $data){
            
            $fields[$key]["name"] = $request->name[$key];
            $fields[$key]["type"] = $data;
            if($data == "text"){
            $fields[$key]["text"] = $request->text[$key];
            }
            if($data == "link"){
            $fields[$key]["text"] = $request->text[$key];
            $fields[$key]["link"] = $request->link[$key];
            }
            if($data == "image"){
            if(!empty($request->image[$key])){
				$img = fileUpload($request->image[$key],"image");
                $fields[$key]["img"] = $img;
            }
            }
        }
        
        $page = new Page();
        $page->page = $request->page;
        $page->title = $request->title;
        $page->section = $request->section;
        $page->fields= json_encode($fields);
        $page->save();
        return redirect()->back();
        
    }
    public function pageUpdate(Request $request,$id){
        $type = $request->type;
        $fields = [];
        $page = Page::findorfail($id);

        foreach($type as $key => $data){
            
            $fields[$key]["name"] = $request->name[$key];
            $fields[$key]["type"] = $data;
            if($data == "text"){
            $fields[$key]["text"] = $request->text[$key];
            }
            if($data == "link"){
            $fields[$key]["text"] = $request->text[$key];
            $fields[$key]["link"] = $request->link[$key];
            }
            if($data == "image"){
                
            if(!empty($request->image[$key])){
				
				if(isset(json_decode($page->fields)[$key])&&json_decode($page->fields)[$key]->type =="image"){
					
                
				
                deleteImage(json_decode($page->fields)[$key]->img);
                
				}
                $img = fileUpload($request->image[$key],"image");

                    				
				
                $fields[$key]["img"] = $img;
				
				
            }else{
				
                $fields[$key]["img"] = json_decode($page->fields)[$key]->img;
				
            }
            }
        }
        
        
        $page->page = $request->page;
        $page->title = $request->title;
        $page->section = $request->section;
        $page->fields= json_encode($fields);
        $page->save();
        return redirect()->back();
        
    }

    public function profile() {
        return view("admin.profile.index");
    }
    public function profileUpdate(Request $req) {
        $user = User::first();
        $user->email = $req->email;
        if($req->password != ""){
        $user->password = Hash::make($req->password);
        }
        $user->save();
        return redirect()->back();

    }
	public function query(Request $request){
        $query = Query::latest()->get();
        return view('admin.query.index',compact('query'));
    }
	public function queryDelete($id){
        $query = Query::findOrFail($id)->delete();
        return redirect()->back();
    }
    public function projects()
    {
        $projects = \App\Models\Project::where('is_active', true)
                    ->orderBy('sort_order')
                    ->orderBy('created_at', 'desc')
                    ->get();
        return view('projects', compact('projects'));
    }
}
