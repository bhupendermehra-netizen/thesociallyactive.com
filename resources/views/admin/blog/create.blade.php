{{-- ============================================================ --}}
{{-- FILE: resources/views/admin/blog/create.blade.php          --}}
{{-- ============================================================ --}}
@extends('admin.layout.app')
@section('page-title', 'New Blog Post')

@section('content')

<div style="margin-bottom:20px;">
  <a href="{{ route('admin.blog.index') }}" class="btn btn-ghost">
    <i class="fas fa-arrow-left"></i> Back
  </a>
</div>

<div class="tsa-card" style="max-width:800px;">
  <div class="tsa-card-title">
    <span><i class="fas fa-plus" style="color:var(--lime);margin-right:8px;"></i>New Blog Post</span>
  </div>

  <form action="{{ route('admin.blog.store') }}" method="POST" enctype="multipart/form-data">
    @csrf

    <div style="display:grid;grid-template-columns:1fr 1fr;gap:16px;margin-bottom:4px;">
      <div class="form-group">
        <label>Title *</label>
        <input class="form-control" type="text" name="title" value="{{ old('title') }}"
          placeholder="Blog post title" required />
      </div>
      <div class="form-group">
        <label>Category</label>
        <select class="form-control" name="category_id">
          <option value="">Select category</option>
          @foreach($categories as $cat)
            <option value="{{ $cat->id }}" {{ old('category_id') == $cat->id ? 'selected' : '' }}>
              {{ $cat->name }}
            </option>
          @endforeach
        </select>
      </div>
    </div>

    <div class="form-group">
      <label>Cover Image</label>
      <input class="form-control" type="file" name="cover_image" accept="image/*"
        style="padding:8px 12px;font-size:13px;" />
      <div style="font-size:11px;color:var(--muted);margin-top:4px;">Recommended: 800x450px, JPG/PNG/WEBP</div>
    </div>

    <div class="form-group">
      <label>Short Description <span style="color:var(--muted);font-weight:400;text-transform:none;">(shown on listing page)</span></label>
      <textarea class="form-control" name="description" rows="3"
        placeholder="Brief description ~150 characters...">{{ old('description') }}</textarea>
    </div>

    <div class="form-group">
      <label>Full Content</label>
      <textarea class="form-control" name="content" id="blog_content" rows="12"
        placeholder="Write your blog content here... (HTML supported)">{{ old('content') }}</textarea>
    </div>

    <div style="background:var(--hover);border-radius:10px;padding:16px;margin-bottom:20px;">
      <div style="font-size:12px;font-weight:600;color:var(--muted);text-transform:uppercase;letter-spacing:0.05em;margin-bottom:12px;">SEO Settings</div>
      <div class="form-group" style="margin-bottom:12px;">
        <label>SEO Title <span style="color:var(--muted);font-weight:400;text-transform:none;">(leave blank to use post title)</span></label>
        <input class="form-control" type="text" name="seo_title" value="{{ old('seo_title') }}" />
      </div>
      <div class="form-group" style="margin:0;">
        <label>SEO Description <span style="color:var(--muted);font-weight:400;text-transform:none;">(155-160 chars)</span></label>
        <textarea class="form-control" name="seo_description" rows="2">{{ old('seo_description') }}</textarea>
      </div>
    </div>

    <div style="display:flex;align-items:center;gap:24px;margin-bottom:24px;">
      <label style="display:flex;align-items:center;gap:8px;cursor:pointer;font-size:13px;color:var(--text);">
        <input type="checkbox" name="is_published" value="1" {{ old('is_published', 1) ? 'checked' : '' }}
          style="width:16px;height:16px;accent-color:var(--lime);cursor:pointer;" />
        Publish immediately
      </label>
    </div>

    <button type="submit" class="btn btn-lime" style="padding:12px 32px;font-size:14px;">
      <i class="fas fa-floppy-disk"></i> Publish Post
    </button>
  </form>
</div>

@endsection