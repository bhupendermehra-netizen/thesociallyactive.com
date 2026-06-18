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
            $filename = 'author_' . time() . '_' . Str::random(6) . '.webp';
            $this->resizeToSquare($image->getRealPath(), public_path('uploaded_files/image/' . $filename), 400);
            $data['profile_image'] = $filename;
        } elseif ($request->filled('profile_image_cropped')) {
            $filename = 'author_' . time() . '_' . Str::random(6) . '.webp';
            $this->saveBase64Image($request->input('profile_image_cropped'), public_path('uploaded_files/image/' . $filename), 400);
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
            $filename = 'author_' . time() . '_' . Str::random(6) . '.webp';
            $this->resizeToSquare($image->getRealPath(), public_path('uploaded_files/image/' . $filename), 400);
            $data['profile_image'] = $filename;
        } elseif ($request->input('profile_image_cropped') === 'remove') {
            // User wants to remove the image
            if ($author->profile_image && file_exists(public_path('uploaded_files/image/' . $author->profile_image))) {
                @unlink(public_path('uploaded_files/image/' . $author->profile_image));
            }
            $data['profile_image'] = null;
        } elseif ($request->filled('profile_image_cropped')) {
            $filename = 'author_' . time() . '_' . Str::random(6) . '.webp';
            $this->saveBase64Image($request->input('profile_image_cropped'), public_path('uploaded_files/image/' . $filename), 400);
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

    /**
     * Resize an image to a perfect square using GD, saved as WebP.
     */
    private function resizeToSquare($sourcePath, $destPath, $size = 400)
    {
        if (!file_exists($sourcePath)) return;

        [$w, $h, $type] = @getimagesize($sourcePath);
        if (!$w || !$h) return;

        // Create source image
        $src = null;
        switch ($type) {
            case IMAGETYPE_JPEG: $src = @imagecreatefromjpeg($sourcePath); break;
            case IMAGETYPE_PNG:  $src = @imagecreatefrompng($sourcePath); break;
            case IMAGETYPE_GIF:  $src = @imagecreatefromgif($sourcePath); break;
            case IMAGETYPE_WEBP: $src = @imagecreatefromwebp($sourcePath); break;
        }
        if (!$src) return;

        // Square center crop
        $min = min($w, $h);
        $square = imagecreatetruecolor($size, $size);
        imagealphablending($square, false);
        imagesavealpha($square, true);
        imagecopyresampled($square, $src, 0, 0, ($w - $min) / 2, ($h - $min) / 2, $size, $size, $min, $min);
        @imagewebp($square, $destPath, 85);
        imagedestroy($square);
        imagedestroy($src);
    }

    /**
     * Save a base64 image string as a square WebP.
     */
    private function saveBase64Image($base64, $destPath, $size = 400)
    {
        // Strip data URI prefix
        if (!str_starts_with($base64, 'data:image')) return;
        $base64 = preg_replace('#^data:image/[^;]+;base64,#', '', $base64);
        $data = base64_decode($base64);
        if (!$data) return;

        $tmpPath = sys_get_temp_dir() . '/' . uniqid('author_crop_') . '.png';
        file_put_contents($tmpPath, $data);

        $this->resizeToSquare($tmpPath, $destPath, $size);

        @unlink($tmpPath);
    }
}
