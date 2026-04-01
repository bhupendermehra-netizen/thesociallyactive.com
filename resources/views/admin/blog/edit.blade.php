@extends('admin.layout.app')
@section('page-title', 'Edit Blog Post')

@section('content')

<div style="margin-bottom:20px;">
  <a href="{{ route('admin.blog.index') }}" class="btn btn-ghost">
    <i class="fas fa-arrow-left"></i> Back
  </a>
</div>

<div class="tsa-card" style="max-width:800px;">
  <div class="tsa-card-title">
    <span><i class="fas fa-pen" style="color:var(--lime);margin-right:8px;"></i>Edit Post</span>
  </div>

  <form action="{{ route('admin.blog.update', $blog->id) }}" method="POST" enctype="multipart/form-data">
    @csrf

    <div style="display:grid;grid-template-columns:1fr 1fr;gap:16px;margin-bottom:4px;">
      <div class="form-group">
        <label>Title *</label>
        <input class="form-control" type="text" name="title"
          value="{{ old('title', $blog->title) }}" required />
      </div>
      <div class="form-group">
        <label>Category</label>
        <select class="form-control" name="category_id">
          <option value="">Select category</option>
          @foreach($categories as $cat)
            <option value="{{ $cat->id }}" {{ $blog->category_id == $cat->id ? 'selected' : '' }}>
              {{ $cat->name }}
            </option>
          @endforeach
        </select>
      </div>
    </div>

    <div class="form-group">
      <label>Cover Image</label>
      @if($blog->cover_image)
        <div style="margin-bottom:10px;">
          @if(Str::startsWith($blog->cover_image, 'http'))
            <img src="{{ $blog->cover_image }}" style="height:100px;border-radius:8px;object-fit:cover;" />
          @else
            <img src="{{ asset($blog->cover_image) }}" style="height:100px;border-radius:8px;object-fit:cover;" />
          @endif
          <div style="font-size:11px;color:var(--muted);margin-top:4px;">Current image — upload new to replace</div>
        </div>
      @endif
      <input class="form-control" type="file" name="cover_image" accept="image/*"
        style="padding:8px 12px;font-size:13px;" />
    </div>

    <div class="form-group">
      <label>Short Description</label>
      <textarea class="form-control" name="description" rows="3">{{ old('description', $blog->description) }}</textarea>
    </div>

    <div class="form-group">
      <label>Full Content</label>
      <textarea class="form-control" name="content" rows="12">{{ old('content', $blog->content) }}</textarea>
    </div>

    <div style="background:var(--hover);border-radius:10px;padding:16px;margin-bottom:20px;">
      <div style="font-size:12px;font-weight:600;color:var(--muted);text-transform:uppercase;letter-spacing:0.05em;margin-bottom:12px;">SEO Settings</div>
      <div class="form-group" style="margin-bottom:12px;">
        <label>SEO Title</label>
        <input class="form-control" type="text" name="seo_title"
          value="{{ old('seo_title', $blog->seo_title) }}" />
      </div>
      <div class="form-group" style="margin:0;">
        <label>SEO Description</label>
        <textarea class="form-control" name="seo_description" rows="2">{{ old('seo_description', $blog->seo_description) }}</textarea>
      </div>
    </div>

    <div style="display:flex;align-items:center;gap:24px;margin-bottom:24px;">
      <label style="display:flex;align-items:center;gap:8px;cursor:pointer;font-size:13px;color:var(--text);">
        <input type="checkbox" name="is_published" value="1" {{ $blog->is_published ? 'checked' : '' }}
          style="width:16px;height:16px;accent-color:var(--lime);cursor:pointer;" />
        Published
      </label>
    </div>

    <button type="submit" class="btn btn-lime" style="padding:12px 32px;font-size:14px;">
      <i class="fas fa-floppy-disk"></i> Save Changes
    </button>
  </form>
</div>

@endsection