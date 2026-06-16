<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Author;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class AuthorController extends Controller
{
    public function index()
    {
        $authors = Author::withCount('blogs')->orderBy('name')->get();
        return view('admin.authors.index', compact('authors'));
    }

    public function create()
    {
        return view('admin.authors.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'bio' => 'nullable|string',
            'profile_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'facebook' => 'nullable|url|max:500',
            'instagram' => 'nullable|url|max:500',
            'linkedin' => 'nullable|url|max:500',
            'twitter' => 'nullable|url|max:500',
        ]);

        $data = $request->only(['name', 'bio', 'facebook', 'instagram', 'linkedin', 'twitter']);

        if ($request->hasFile('profile_image')) {
            $image = $request->file('profile_image');
            $filename = 'author_' . time() . '_' . Str::random(6) . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('uploaded_files/image'), $filename);
            $data['profile_image'] = $filename;
        }

        Author::create($data);

        return redirect()->route('admin.authors.index')->with('success', 'Author created successfully!');
    }

    public function edit($id)
    {
        $author = Author::findOrFail($id);
        return view('admin.authors.edit', compact('author'));
    }

    public function update(Request $request, $id)
    {
        $author = Author::findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:255',
            'bio' => 'nullable|string',
            'profile_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'facebook' => 'nullable|url|max:500',
            'instagram' => 'nullable|url|max:500',
            'linkedin' => 'nullable|url|max:500',
            'twitter' => 'nullable|url|max:500',
        ]);

        $data = $request->only(['name', 'bio', 'facebook', 'instagram', 'linkedin', 'twitter']);

        if ($request->hasFile('profile_image')) {
            // Delete old image
            if ($author->profile_image && file_exists(public_path('uploaded_files/image/' . $author->profile_image))) {
                @unlink(public_path('uploaded_files/image/' . $author->profile_image));
            }

            $image = $request->file('profile_image');
            $filename = 'author_' . time() . '_' . Str::random(6) . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('uploaded_files/image'), $filename);
            $data['profile_image'] = $filename;
        }

        $author->update($data);

        return redirect()->route('admin.authors.index')->with('success', 'Author updated successfully!');
    }

    public function destroy($id)
    {
        $author = Author::findOrFail($id);

        // Delete profile image
        if ($author->profile_image && file_exists(public_path('uploaded_files/image/' . $author->profile_image))) {
            @unlink(public_path('uploaded_files/image/' . $author->profile_image));
        }

        // Nullify blog references before deleting
        $author->blogs()->update(['author_id' => null]);
        $author->delete();

        return redirect()->route('admin.authors.index')->with('success', 'Author deleted successfully!');
    }
}
