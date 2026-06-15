<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Page;
use App\Models\Faq;
use App\Models\SiteSetting;
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
    // ===================== HELPER =====================
    private function uploadFile($file)
    {
        $extension = $file->getClientOriginalExtension();
        $videoExtensions = ['mp4', 'mov', 'avi', 'webm', 'mkv'];
        $folder = in_array(strtolower($extension), $videoExtensions) ? 'video' : 'image';
        $uniqueName = uniqid() . '.' . $extension;

        // Seedha public/uploaded_files/ mein save karo
        $destinationPath = public_path('uploaded_files/' . $folder);
        if (!file_exists($destinationPath)) {
            mkdir($destinationPath, 0755, true);
        }
        $file->move($destinationPath, $uniqueName);

        return $folder . '/' . $uniqueName;
    }

    private function deleteOldFile($imgPath)
    {
        if (!empty($imgPath)) {
            $fullPath = public_path('uploaded_files/' . $imgPath);
            if (file_exists($fullPath)) {
                @unlink($fullPath);
            }
        }
    }

    // ===================== FRONTEND =====================
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

        $faqs = \App\Models\Faq::where('page_slug', 'Home')->orderBy('sort_order')->get();
        $seo = page_seo('Home');
        return view("index", compact("pages", "seo", "faqs"));
    }

    public function about()
    {
        $sections = ["about_heading", "passion_section", "founder_section", "story_section"];

        foreach ($sections as $section) {
            $record = Page::wherePage("About")->whereSection($section)->first();
            $pages[$section] = $record ? json_decode($record->fields) : [];
        }

        $faqs = \App\Models\Faq::where('page_slug', 'About')->orderBy('sort_order')->get();
        $seo = page_seo('About');
        return view("about", compact("pages", "seo", "faqs"));
    }

    public function extraPage($slug)
    {
        // First try: look up by the new slug column on any row
        $slugRow = Page::where('slug', $slug)->first();
        if ($slugRow) {
            $page = $slugRow->page;
            $record = Page::wherePage($page)->whereSection("Content")->first();
            $pages["content"] = $record ? json_decode($record->fields) : [];
            $faqs = \App\Models\Faq::where('page_slug', $page)->orderBy('sort_order')->get();
            $seo = page_seo($page);
            return view("extra_page", compact('pages', 'page', 'seo', 'faqs'));
        }

        // Fallback: old JSON-based lookup for legacy data
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

        $record = Page::wherePage($page)->whereSection("Content")->first();
        $pages["content"] = $record ? json_decode($record->fields) : [];

        $faqs = Faq::where('page_slug', $page)->orderBy('sort_order')->get();
        $seo = page_seo($page);
        return view("extra_page", compact('pages', 'page', 'seo', 'faqs'));
    }

    public function service($slug)
    {
        // First try: look up by the new slug column on any row
        $slugRow = Page::where('slug', $slug)->first();
        if ($slugRow) {
            $page = $slugRow->page;
            $sections = ["banner", "strip_1", "brand_service_section", "strip_2", "talk_section", "explore_section"];
            foreach ($sections as $section) {
                $record = Page::wherePage($page)->whereSection($section)->first();
                $pages[$section] = $record ? json_decode($record->fields) : [];
            }
            $faqs = \App\Models\Faq::where('page_slug', $page)->orderBy('sort_order')->get();
            $seo = page_seo($page);
            return view("service_page", compact('pages', 'page', 'seo', 'faqs'));
        }

        // Fallback: old JSON-based lookup for legacy data
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

        $sections = ["banner", "strip_1", "brand_service_section", "strip_2", "talk_section", "explore_section"];
        foreach ($sections as $section) {
            $record = Page::wherePage($page)->whereSection($section)->first();
            $pages[$section] = $record ? json_decode($record->fields) : [];
        }

        $faqs = Faq::where('page_slug', $page)->orderBy('sort_order')->get();
        $seo = page_seo($page);
        return view("service_page", compact('pages', 'page', 'seo', 'faqs'));
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
        return view('thankyou', compact('pages'));
    }

    // ===================== ADMIN =====================
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
        $customMetaTags = $seoRow?->custom_meta_tags ?? '';
        $headScript = $seoRow?->head_script ?? '';
        $bodyScript = $seoRow?->body_script ?? '';
        return view('admin.pages.seo', compact('page', 'seoFields', 'customMetaTags', 'headScript', 'bodyScript'));
    }

    public function seoUpdate(Request $request, $page)
    {
        $names = $request->input('name', []);
        $contents = $request->input('content', []);
        $seoData = [];

        foreach ($names as $idx => $name) {
            $name = trim($name);
            $content = isset($contents[$idx]) ? trim($contents[$idx]) : '';
            if ($name === '' && $content === '') continue;
            if ($name === '') continue;

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
                'custom_meta_tags' => $request->custom_meta_tags ?? '',
                'head_script' => $request->head_script ?? '',
                'body_script' => $request->body_script ?? '',
                'status' => $existingSeo->status ?? 'published',
            ]
        );

        return redirect()->back()->with('success', 'SEO meta tags updated successfully!');
    }

    public function pageAdd()
    {
        $pages = Page::select("page")->groupBy("page")->get();
        return view("admin.pages.add", compact("pages"));
    }

    public function pageEdit($id)
    {
        $page = Page::findorfail($id);

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
                if (isset($request->heading_tag[$key]) && $request->heading_tag[$key] !== '') {
                    $fields[$key]["heading_tag"] = $request->heading_tag[$key];
                }
            }
            if ($data == "link") {
                $fields[$key]["text"] = $request->text[$key];
                $fields[$key]["link"] = $request->link[$key];
                if (isset($request->heading_tag[$key]) && $request->heading_tag[$key] !== '') {
                    $fields[$key]["heading_tag"] = $request->heading_tag[$key];
                }
            }
            if ($data == "image") {
                if (!empty($request->image[$key]) && $request->image[$key]->isValid()) {
                    $fields[$key]["img"] = $this->uploadFile($request->image[$key]);
                } else {
                    $fields[$key]["img"] = '';
                }
            }
        }

        $page = new Page();
        $page->page = $request->page;
        $page->title = $request->title;
        $page->section = $request->section;
        $page->slug = $request->slug;
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
        $oldFields = json_decode($page->fields) ?? [];

        foreach ($type as $key => $data) {
            $fields[$key]["name"] = $request->name[$key];
            $fields[$key]["type"] = $data;

            if ($data == "text") {
                $fields[$key]["text"] = $request->text[$key];
                if (isset($request->heading_tag[$key]) && $request->heading_tag[$key] !== '') {
                    $fields[$key]["heading_tag"] = $request->heading_tag[$key];
                }
            }
            if ($data == "link") {
                $fields[$key]["text"] = $request->text[$key];
                $fields[$key]["link"] = $request->link[$key];
                if (isset($request->heading_tag[$key]) && $request->heading_tag[$key] !== '') {
                    $fields[$key]["heading_tag"] = $request->heading_tag[$key];
                }
            }
            if ($data == "image") {
                if (!empty($request->image[$key]) && $request->image[$key]->isValid()) {
                    // Purani file delete karo
                    if (isset($oldFields[$key]->img)) {
                        $this->deleteOldFile($oldFields[$key]->img);
                    }
                    // Nayi file save karo
                    $fields[$key]["img"] = $this->uploadFile($request->image[$key]);
                } else {
                    // Purana path rakho
                    $fields[$key]["img"] = isset($oldFields[$key]->img) ? $oldFields[$key]->img : '';
                }
            }
        }

        $page->page = $request->page;
        $page->title = $request->title;
        $page->section = $request->section;
        $page->slug = $request->slug;
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
        $propertyId = config('analytics_id', env('ANALYTICS_ID'));

        if (!$propertyId) {
            return view('admin.dashboard', [
                'visitorCount' => 0
            ]);
        }

        $analyticsData = Analytics::fetchTotalVisitorsAndPageViews(Period::days(7));
        $totalVisitors = $analyticsData->sum('activeUsers');

        return view('admin.dashboard', [
            'visitorCount' => $totalVisitors
        ]);
    }
    public function cardSection(){
        return view('card-section');
    }

    public function scripts()
    {
        $settings = SiteSetting::first();
        return view('admin.scripts', compact('settings'));
    }

    public function scriptsUpdate(Request $request)
    {
        SiteSetting::first()->update([
            'global_head_script' => $request->global_head_script ?? '',
            'global_body_script' => $request->global_body_script ?? '',
        ]);

        return redirect()->back()->with('success', 'Site-wide scripts updated successfully!');
    }

    public function pageFaqs($pageSlug)
    {
        $faqs = Faq::where('page_slug', $pageSlug)->orderBy('sort_order')->get();
        $pageName = $pageSlug;
        return view('admin.pages.faq', compact('faqs', 'pageName', 'pageSlug'));
    }

    public function pageFaqsSave(Request $request, $pageSlug)
    {
        // Delete existing page FAQs
        Faq::where('page_slug', $pageSlug)->delete();

        // Re-insert from form
        if ($request->has('faq_question')) {
            foreach ($request->faq_question as $i => $question) {
                if (!empty(trim($question)) && isset($request->faq_answer[$i]) && !empty(trim($request->faq_answer[$i]))) {
                    Faq::create([
                        'page_slug'  => $pageSlug,
                        'question'   => $question,
                        'answer'     => $request->faq_answer[$i],
                        'sort_order' => $i,
                    ]);
                }
            }
        }

        return redirect()->route('admin.page.faqs', $pageSlug)->with('success', 'FAQs saved successfully!');
    }
}
