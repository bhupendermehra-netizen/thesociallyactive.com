<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Page;
use App\Models\User;
use App\Models\Query;
use App\Models\ExtraImage;

use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\View;
use Spatie\Analytics\Facades\Analytics;
use Spatie\Analytics\Period;
use Illuminate\View\View as ViewResponse;

class ManageController extends Controller
{
  public function index(Request $request)
{
    $sections = [
        "home_banner", "about_section", "who_we_are", "who_we_help",
        "video_section", "expertise_section", "card_section_1", "card_section_2",
        "card_section_3", "card_section_4", "values_section", "brands_section",
        "impact_section", "testimonial_section"
    ];

    foreach ($sections as $section) {
        $record = Page::wherePage("Home")->whereSection($section)->first();
        $pages[$section] = $record ? json_decode($record->fields) : [];
    }

    $seo = page_seo('Home');
    return view("index", compact("pages", "seo"));
}
public function about()
{
    $sections = ["about_heading", "passion_section", "founder_section", "story_section"];

    foreach ($sections as $section) {
        $record = Page::wherePage("About")->whereSection($section)->first();
        $pages[$section] = $record ? json_decode($record->fields) : [];
    }

    $seo = page_seo('About');
    return view("about", compact("pages", "seo"));
}
    public function extraPage($slug)
    {

        $pageSearch = Page::whereSection("Important-Page-Slug")->get();
        $page = "";
        foreach ($pageSearch as $data) {
            if (isset(json_decode($data->fields)[0]) && json_decode($data->fields)[0]->link == $slug) {
                $page = $data->page;
            }
        }

        if ($page == "" || empty($page)) {
            abort(404);
        }

        $pages["content"] = json_decode(Page::wherePage($page)->whereSection("Content")->first()->fields);

        $seo = page_seo($page);
        return view("extra_page", compact('pages', 'page', 'seo'));
    }
    public function service($slug)
    {

        $pageSearch = Page::whereSection("Service-Page-Slug")->get();
        $page = "";
        foreach ($pageSearch as $data) {
            if (isset(json_decode($data->fields)[0]) && json_decode($data->fields)[0]->link == $slug) {
                $page = $data->page;
            }
        }

        if ($page == "" || empty($page)) {
            abort(404);
        }

        $pages["banner"] = json_decode(Page::wherePage($page)->whereSection("banner")->first()->fields);

        $pages["strip_1"] = json_decode(Page::wherePage($page)->whereSection("strip_1")->first()->fields);
        $pages["brand_service_section"] = json_decode(Page::wherePage($page)->whereSection("brand_service_section")->first()->fields);
        $pages["strip_2"] = json_decode(Page::wherePage($page)->whereSection("strip_2")->first()->fields);
        $pages["talk_section"] = json_decode(Page::wherePage($page)->whereSection("talk_section")->first()->fields);
        $pages["explore_section"] = json_decode(Page::wherePage($page)->whereSection("explore_section")->first()->fields);


        $seo = page_seo($page);
        return view("service_page", compact('pages', 'page', 'seo'));
    }
    public function contact()
    {
        return view("contact");
    }


    public function queryStore(Request $request)
    {
        $query = Query::create($request->all());
        return redirect()->route('thankyou');
    }
    public function thankyou()
    {
       $record = Page::wherePage("Thankyou")->whereSection("thanks")->first();
$pages["thankyou"] = $record ? json_decode($record->fields) : [];
    }
    public function dashboard()
    {
        $pageCount = Page::count();
        $queryCount = Query::count();
        $blogCount = \App\Models\Blog::where('is_published', true)->count();
        return view('admin.index', compact('pageCount', 'queryCount', 'blogCount'));
    }
    public function page()
    {
        $pages = Page::select("page")->groupBy("page")->get();

        return view("admin.pages.index", compact("pages"));
    }
   public function pageView($page)
{
    $pages = Page::wherePage($page)->get();
    
    if ($pages->isEmpty()) {
        return redirect()->route('admin.page')->with('error', 'Page not found!');
    }
    
    $extraImage = ExtraImage::wherePage($page)->count();

    return view("admin.pages.view_detail", compact("pages", "extraImage", "page"));
}

    public function seo($page)
    {
        $seoRow = Page::wherePage($page)->whereSection('seo')->first();
        $seoFields = $seoRow ? json_decode($seoRow->fields, true) : [];

        return view('admin.pages.seo', compact('page', 'seoFields'));
    }

    public function seoUpdate(Request $request, $page)
    {
        $names = $request->input('name', []);
        $contents = $request->input('content', []);
        $seoData = [];

        foreach ($names as $idx => $name) {
            $name = trim($name);
            $content = isset($contents[$idx]) ? trim($contents[$idx]) : '';
            if ($name === '' && $content === '') {
                continue;
            }

            if ($name === '') {
                continue;
            }

            $seoData[] = [
                'name' => $name,
                'text' => $content,
            ];
        }

        $existingSeo = Page::wherePage($page)->whereSection('seo')->first();

        Page::updateOrCreate(
            ['page' => $page, 'section' => 'seo'],
            [
                'title' => 'SEO Meta',
                'fields' => json_encode($seoData),
                'meta_title' => $existingSeo->meta_title ?? '',
                'meta_description' => $existingSeo->meta_description ?? '',
                'meta_keywords' => $existingSeo->meta_keywords ?? '',
                'status' => $existingSeo->status ?? 'published',
            ]
        );

        return redirect()->route('admin.page.view', $page)->with('success', 'SEO updated successfully.');
    }

    public function pageAdd()
    {
        $pages = Page::select("page")->groupBy("page")->get();

        return view("admin.pages.add", compact("pages"));
    }
public function pageEdit($id)
{
    $page = Page::findorfail($id);
    
    // Agar fields null ya empty hai toh empty array set karo
    if (empty($page->fields) || $page->fields === 'null') {
        $page->fields = '[]';
        $page->save();
    }
    
    return view("admin.pages.edit", compact("page"));
}
    public function pageStore(Request $request)
    {
        $type = $request->type;
        $fields = [];

        foreach ($type as $key => $data) {

            $fields[$key]["name"] = $request->name[$key];
            $fields[$key]["type"] = $data;
            if ($data == "text") {
                $fields[$key]["text"] = $request->text[$key];
            }
            if ($data == "link") {
                $fields[$key]["text"] = $request->text[$key];
                $fields[$key]["link"] = $request->link[$key];
            }
    if ($data == "image") {
    if (!empty($request->image[$key]) && $request->image[$key]->isValid()) {
        $file = $request->image[$key];
        $extension = $file->getClientOriginalExtension();
        $filename = 'image/' . uniqid() . '.' . $extension;
        $file->storeAs('uploaded_files', $filename, 'public');
        $fields[$key]["img"] = $filename;
    }
}
        }

        $page = new Page();
        $page->page = $request->page;
        $page->title = $request->title;
        $page->section = $request->section;
        $page->meta_title = $request->meta_title;
        $page->meta_description = $request->meta_description;
        $page->meta_keywords = $request->meta_keywords;
        $page->status = $request->status ?? 'published';
        $page->fields = json_encode($fields);
        $page->save();
        return redirect()->back();
    }
    public function pageUpdate(Request $request, $id)
    {
        $type = $request->type;
        $fields = [];
        $page = Page::findorfail($id);

        foreach ($type as $key => $data) {

            $fields[$key]["name"] = $request->name[$key];
            $fields[$key]["type"] = $data;
            if ($data == "text") {
                $fields[$key]["text"] = $request->text[$key];
            }
            if ($data == "link") {
                $fields[$key]["text"] = $request->text[$key];
                $fields[$key]["link"] = $request->link[$key];
            }
           if ($data == "image") {
    if (!empty($request->image[$key]) && $request->image[$key]->isValid()) {
        // Sirf valid uploaded file process karo
        $file = $request->image[$key];
        $extension = $file->getClientOriginalExtension();
        $filename = 'image/' . uniqid() . '.' . $extension;
        $file->storeAs('uploaded_files', $filename, 'public');

        // Purani file delete karo
        if (isset(json_decode($page->fields)[$key]) && json_decode($page->fields)[$key]->type == "image") {
            $oldImg = json_decode($page->fields)[$key]->img ?? null;
            if ($oldImg && file_exists(storage_path('app/public/uploaded_files/' . $oldImg))) {
                @unlink(storage_path('app/public/uploaded_files/' . $oldImg));
            }
        }

        $fields[$key]["img"] = $filename;
    } else {
        // Naya file nahi aaya — purana hi rakho
        $fields[$key]["img"] = json_decode($page->fields)[$key]->img ?? '';
    }
}
        }


        $page->page = $request->page;
        $page->title = $request->title;
        $page->section = $request->section;
        $page->meta_title = $request->meta_title;
        $page->meta_description = $request->meta_description;
        $page->meta_keywords = $request->meta_keywords;
        $page->status = $request->status ?? 'published';
        $page->fields = json_encode($fields);
        $page->save();
        return redirect()->back();
    }

    public function profile()
    {
        return view("admin.profile.index");
    }
    public function profileUpdate(Request $req)
    {
        $user = User::first();
        $user->email = $req->email;
        if ($req->password != "") {
            $user->password = Hash::make($req->password);
        }
        $user->save();
        return redirect()->back();
    }
    public function query(Request $request)
    {
        $query = Query::latest()->get();
        return view('admin.query.index', compact('query'));
    }
    public function queryDelete($id)
    {
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
    public function analytics(): ViewResponse
    {
        return $propertyId = config('analytics_id', env('ANALYTICS_ID'));

        if (!$propertyId) {
            return view('admin.dashboard', [
                'visitorCount' => 0
            ]);
        }

        // 1. Ask Google for visitors from the last 7 days
        // This automatically uses the ANALYTICS_PROPERTY_ID from your config
        $analyticsData = Analytics::fetchTotalVisitorsAndPageViews(Period::days(7));

        // 2. Sum up the 'activeUsers' column from the returned collection
        $totalVisitors = $analyticsData->sum('activeUsers');

        // 3. Send that number to your dashboard view
        return view('admin.dashboard', [
            'visitorCount' => $totalVisitors
        ]);
    }
}
