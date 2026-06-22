<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use App\Models\BlogCategory;
use App\Models\Faq;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class BlogController extends Controller
{
    // ── CATEGORIES ──────────────────────────────

    public function categories()
    {
        $categories = BlogCategory::withCount('blogs')->orderBy('name')->get();
        return view('admin.blog.categories', compact('categories'));
    }

    public function categoryStore(Request $request)
    {
        $request->validate(['name' => 'required|string|max:100']);
        BlogCategory::create([
            'name' => $request->name,
            'slug' => Str::slug($request->name),
        ]);
        return redirect()->route('admin.blog.categories')->with('success', 'Category added!');
    }

    public function categoryUpdate(Request $request, $id)
    {
        $cat = BlogCategory::findOrFail($id);
        $request->validate(['name' => 'required|string|max:100']);
        $cat->update(['name' => $request->name, 'slug' => Str::slug($request->name)]);
        return redirect()->route('admin.blog.categories')->with('success', 'Category updated!');
    }

    public function categoryDestroy($id)
    {
        BlogCategory::findOrFail($id)->delete();
        return redirect()->route('admin.blog.categories')->with('success', 'Category deleted!');
    }

    // ── POSTS ───────────────────────────────────

    public function index(Request $request)
    {
        $query = Blog::with('category')->latest();

        if ($request->search) {
            $query->where('title', 'like', '%' . $request->search . '%');
        }
        if ($request->category) {
            $query->where('category_id', $request->category);
        }
        if ($request->status === 'published') {
            $query->where('is_published', true);
        } elseif ($request->status === 'draft') {
            $query->where('is_published', false);
        }

        $blogs = $query->paginate(15)->withQueryString();
        $categories = BlogCategory::orderBy('name')->get();
        return view('admin.blog.index', compact('blogs', 'categories'));
    }

    public function create()
    {
        $categories = BlogCategory::orderBy('name')->get();
        $authors = \App\Models\Author::orderBy('name')->get();
        return view('admin.blog.create', compact('categories', 'authors'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title'           => 'required|string|max:255',
            'author_id'       => 'nullable|exists:authors,id',
            'category_id'     => 'nullable|exists:blog_categories,id',
            'blog_date'       => 'nullable|date',
            'cover_image'     => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'description'     => 'nullable|string|max:160',
            'content'         => 'nullable|string',
            'seo_title'       => 'nullable|string|max:255',
            'seo_description' => 'nullable|string|max:160',
            'custom_meta_tags'=> 'nullable|string',
            'head_script'     => 'nullable|string',
            'body_script'     => 'nullable|string',
            'enable_comments' => 'boolean',
            'is_published'    => 'boolean',
            'sort_order'      => 'integer|min:0',
            'slug'            => 'nullable|string|max:255|unique:blogs,slug|regex:/^[a-z0-9]+(?:-[a-z0-9]+)*$/',
            'title_tag'       => 'nullable|string|in:h1,h2,h3,h4,h5,h6',
        ]);

        $imagePath = null;
        if ($request->hasFile('cover_image')) {
            $file = $request->file('cover_image');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('images/blogs'), $filename);
            $imagePath = 'images/blogs/' . $filename;
        }

        $blog = Blog::create([
            'title'           => $request->title,
            'slug'            => $request->slug ? Str::slug($request->slug) : (Str::slug($request->title) . '-' . time()),
            'title_tag'       => $request->title_tag ?? 'h1',
            'author_id'       => $request->author_id,
            'category_id'     => $request->category_id,
            'blog_date'       => $request->blog_date ?? now()->toDateString(),
            'cover_image'     => $imagePath,
            'description'     => $request->description,
            'content'         => $request->content,
            'seo_title'       => $request->seo_title ?? $request->title,
            'seo_description' => $request->seo_description,
            'custom_meta_tags' => $request->custom_meta_tags,
            'head_script'     => $request->head_script,
            'body_script'     => $request->body_script,
            'enable_comments' => $request->has('enable_comments') ? 1 : 0,
            'is_published'    => $request->has('is_published') ? 1 : 0,
            'sort_order'      => $request->sort_order ?? 0,
        ]);

        // Save FAQs
        $blog->faqs()->delete();
        if ($request->has('faq_question')) {
            foreach ($request->faq_question as $i => $question) {
                if (!empty(trim($question)) && isset($request->faq_answer[$i]) && !empty(trim($request->faq_answer[$i]))) {
                    Faq::create([
                        'faqable_id'   => $blog->id,
                        'faqable_type' => 'App\Models\Blog',
                        'question'     => $question,
                        'answer'       => $request->faq_answer[$i],
                        'sort_order'   => $i,
                    ]);
                }
            }
        }

        return redirect()->route('admin.blog.index')->with('success', 'Blog post created successfully!');
    }

    public function edit($id)
    {
        $blog = Blog::findOrFail($id);
        $categories = BlogCategory::orderBy('name')->get();
        $authors = \App\Models\Author::orderBy('name')->get();
        return view('admin.blog.edit', compact('blog', 'categories', 'authors'));
    }

    public function update(Request $request, $id)
    {
        $blog = Blog::findOrFail($id);

        $request->validate([
            'title'           => 'required|string|max:255',
            'author_id'       => 'nullable|exists:authors,id',
            'category_id'     => 'nullable|exists:blog_categories,id',
            'blog_date'       => 'nullable|date',
            'cover_image'     => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'description'     => 'nullable|string|max:160',
            'content'         => 'nullable|string',
            'seo_title'       => 'nullable|string|max:255',
            'seo_description' => 'nullable|string|max:160',
            'custom_meta_tags'=> 'nullable|string',
            'head_script'     => 'nullable|string',
            'body_script'     => 'nullable|string',
            'enable_comments' => 'boolean',
            'is_published'    => 'boolean',
            'sort_order'      => 'integer|min:0',
            'slug'            => 'nullable|string|max:255|unique:blogs,slug,' . $id . '|regex:/^[a-z0-9]+(?:-[a-z0-9]+)*$/',
            'title_tag'       => 'nullable|string|in:h1,h2,h3,h4,h5,h6',
        ]);

        $imagePath = $blog->cover_image;
        if ($request->hasFile('cover_image')) {
            if ($blog->cover_image && file_exists(public_path($blog->cover_image))) {
                unlink(public_path($blog->cover_image));
            }
            $file = $request->file('cover_image');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('images/blogs'), $filename);
            $imagePath = 'images/blogs/' . $filename;
        }

        $blog->update([
            'title'           => $request->title,
            'slug'            => $request->slug ? Str::slug($request->slug) : $blog->slug,
            'title_tag'       => $request->title_tag ?? $blog->title_tag ?? 'h1',
            'author_id'       => $request->author_id ?? $blog->getAuthorIdAttribute(),
            'category_id'     => $request->category_id,
            'blog_date'       => $request->blog_date ?? $blog->blog_date,
            'cover_image'     => $imagePath,
            'description'     => $request->description,
            'content'         => $request->content,
            'seo_title'       => $request->seo_title ?? $blog->seo_title ?? $blog->title,
            'seo_description' => $request->seo_description,
            'custom_meta_tags' => $request->custom_meta_tags,
            'head_script'     => $request->head_script,
            'body_script'     => $request->body_script,
            'enable_comments' => $request->has('enable_comments') ? 1 : 0,
            'is_published'    => $request->has('is_published') ? 1 : 0,
            'sort_order'      => $request->sort_order ?? $blog->sort_order ?? 0,
        ]);

        // Sync FAQs
        $blog->faqs()->delete();
        if ($request->has('faq_question')) {
            foreach ($request->faq_question as $i => $question) {
                if (!empty(trim($question)) && isset($request->faq_answer[$i]) && !empty(trim($request->faq_answer[$i]))) {
                    Faq::create([
                        'faqable_id'   => $blog->id,
                        'faqable_type' => 'App\Models\Blog',
                        'question'     => $question,
                        'answer'       => $request->faq_answer[$i],
                        'sort_order'   => $i,
                    ]);
                }
            }
        }

        return redirect()->route('admin.blog.index')->with('success', 'Blog post updated successfully!');
    }

    public function destroy($id)
    {
        $blog = Blog::findOrFail($id);
        if ($blog->cover_image && file_exists(public_path($blog->cover_image))) {
            unlink(public_path($blog->cover_image));
        }
        $blog->delete();
        return redirect()->route('admin.blog.index')->with('success', 'Blog post deleted!');
    }
}