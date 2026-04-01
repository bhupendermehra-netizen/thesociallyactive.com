<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\BlogCategory;
use Illuminate\Http\Request;

class BlogFrontController extends Controller
{
    public function index(Request $request)
    {
        $query = Blog::with('category')->where('is_published', true)->latest();

        if ($request->category) {
            $query->whereHas('category', fn($q) => $q->where('slug', $request->category));
        }
        if ($request->search) {
            $query->where('title', 'like', '%' . $request->search . '%');
        }

        $blogs      = $query->paginate(9)->withQueryString();
        $categories = BlogCategory::withCount(['blogs' => fn($q) => $q->where('is_published', true)])->get();
        $featured   = Blog::with('category')->where('is_published', true)->latest()->first();

        return view('blog', compact('blogs', 'categories', 'featured'));
    }

    public function show($slug)
    {
        $blog    = Blog::with('category')->where('slug', $slug)->where('is_published', true)->firstOrFail();
        $related = Blog::with('category')
            ->where('is_published', true)
            ->where('id', '!=', $blog->id)
            ->where('category_id', $blog->category_id)
            ->latest()->take(3)->get();
        $categories = BlogCategory::withCount(['blogs' => fn($q) => $q->where('is_published', true)])->get();

        return view('blog-single', compact('blog', 'related', 'categories'));
    }
}