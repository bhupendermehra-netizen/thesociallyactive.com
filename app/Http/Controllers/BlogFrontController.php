<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\BlogCategory;
use App\Models\Author;
use Illuminate\Http\Request;

class BlogFrontController extends Controller
{
    public function index(Request $request)
    {
        $query = Blog::with(['category', 'author', 'faqs'])->where('is_published', true)->latest();

        if ($request->category) {
            $query->whereHas('category', fn($q) => $q->where('slug', $request->category));
        }
        if ($request->search) {
            $query->where('title', 'like', '%' . $request->search . '%');
        }

        $blogs      = $query->paginate(9)->withQueryString();
        $categories = BlogCategory::withCount(['blogs' => fn($q) => $q->where('is_published', true)])->get();
        $featured   = Blog::with(['category', 'author'])->where('is_published', true)->latest()->first();

        return view('blog', compact('blogs', 'categories', 'featured'));
    }

    public function show($slug)
    {
        $blog = Blog::with(['category', 'author', 'faqs'])->where('slug', $slug)->where('is_published', true)->firstOrFail();
        $related = Blog::with(['category', 'author'])
            ->where('is_published', true)
            ->where('id', '!=', $blog->id)
            ->where('category_id', $blog->category_id)
            ->latest()->take(3)->get();
        $categories = BlogCategory::withCount(['blogs' => fn($q) => $q->where('is_published', true)])->get();

        $seo = [
            'title' => $blog->seo_title ?? $blog->title,
            'description' => $blog->seo_description ?? '',
            'custom_meta_tags' => $blog->custom_meta_tags ?? '',
            'head_script' => $blog->head_script ?? '',
            'body_script' => $blog->body_script ?? '',
        ];

        return view('blog-single', compact('blog', 'related', 'categories', 'seo'));
    }
}