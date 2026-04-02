@extends('admin.layout.app')
@section('page-title', 'Edit Blog Post')

@section('content')

<div style="margin-bottom:20px;">
  <a href="{{ route('admin.blog.index') }}" class="btn btn-ghost">
    <i class="fas fa-arrow-left"></i> Back
  </a>
</div>

<div class="tsa-card" style="max-width:1000px;">
  <div class="tsa-card-title">
    <span><i class="fas fa-pen" style="color:var(--lime);margin-right:8px;"></i>Edit Post</span>
  </div>

  <form action="{{ route('admin.blog.update', $blog->id) }}" method="POST" enctype="multipart/form-data" id="blogForm">
    @csrf

    {{-- Basic Info --}}
    <div style="background:var(--hover);border-radius:12px;padding:20px;margin-bottom:20px;">
      <div style="font-size:13px;font-weight:600;color:var(--lime);margin-bottom:16px;border-bottom:1px solid var(--border);padding-bottom:8px;">
        <i class="fas fa-info-circle" style="margin-right:8px;"></i>Basic Information
      </div>
      <div style="display:grid;grid-template-columns:1fr 1fr;gap:16px;">
        <div class="form-group">
          <label>Title *</label>
          <input class="form-control" type="text" id="title" name="title" value="{{ old('title', $blog->title) }}" required />
        </div>
        <div class="form-group">
          <label>Author</label>
          <select class="form-control" name="author_id">
            <option value="">Select author</option>
            @foreach($users as $user)
              <option value="{{ $user->id }}" {{ $blog->author_id == $user->id ? 'selected' : '' }}>{{ $user->name }}</option>
            @endforeach
          </select>
        </div>
      </div>
      <div style="display:grid;grid-template-columns:1fr 1fr;gap:16px;margin-top:16px;">
        <div class="form-group">
          <label>Category</label>
          <select class="form-control" name="category_id">
            <option value="">Select category</option>
            @foreach($categories as $cat)
              <option value="{{ $cat->id }}" {{ $blog->category_id == $cat->id ? 'selected' : '' }}>{{ $cat->name }}</option>
            @endforeach
          </select>
        </div>
        <div class="form-group">
          <label>Blog Date</label>
          <input class="form-control" type="date" name="blog_date" value="{{ old('blog_date', $blog->blog_date ? $blog->blog_date->format('Y-m-d') : now()->toDateString()) }}" />
        </div>
      </div>
    </div>

    {{-- Cover Image --}}
    <div style="background:var(--hover);border-radius:12px;padding:20px;margin-bottom:20px;">
      <div style="font-size:13px;font-weight:600;color:var(--lime);margin-bottom:16px;border-bottom:1px solid var(--border);padding-bottom:8px;">
        <i class="fas fa-image" style="margin-right:8px;"></i>Cover Image
      </div>
      @if($blog->cover_image)
        <div style="margin-bottom:12px;">
          @if(Str::startsWith($blog->cover_image, 'http'))
            <img src="{{ $blog->cover_image }}" style="height:100px;border-radius:8px;object-fit:cover;" />
          @else
            <img src="{{ asset($blog->cover_image) }}" style="height:100px;border-radius:8px;object-fit:cover;" />
          @endif
          <div style="font-size:11px;color:var(--muted);margin-top:4px;">Current image — upload new to replace</div>
        </div>
      @endif
      <input class="form-control" type="file" name="cover_image" accept="image/*" id="cover_image" style="padding:8px 12px;font-size:13px;" />
      <div id="imagePreview" style="margin-top:12px;display:none;">
        <img id="previewImg" src="#" alt="Preview" style="max-height:180px;border-radius:8px;" />
      </div>
    </div>

    {{-- Short Description --}}
    <div style="background:var(--hover);border-radius:12px;padding:20px;margin-bottom:20px;">
      <div style="font-size:13px;font-weight:600;color:var(--lime);margin-bottom:16px;border-bottom:1px solid var(--border);padding-bottom:8px;">
        <i class="fas fa-align-left" style="margin-right:8px;"></i>Short Description
      </div>
      <textarea class="form-control" id="description" name="description" rows="3">{{ old('description', $blog->description) }}</textarea>
      <div style="font-size:11px;color:var(--muted);margin-top:4px;text-align:right;" id="descCounter">0 / 160</div>
    </div>

    {{-- Main Content — Quill --}}
    <div style="background:var(--hover);border-radius:12px;padding:20px;margin-bottom:20px;">
      <div style="font-size:13px;font-weight:600;color:var(--lime);margin-bottom:16px;border-bottom:1px solid var(--border);padding-bottom:8px;">
        <i class="fas fa-pen-nib" style="margin-right:8px;"></i>Main Content
      </div>
      <textarea name="content" id="content" style="display:none;">{{ old('content', $blog->content) }}</textarea>
      <div id="quill-editor" style="min-height:350px;background:#fff;border-radius:0 0 8px 8px;"></div>
    </div>

    {{-- SEO --}}
    <div style="background:var(--hover);border-radius:12px;padding:20px;margin-bottom:20px;">
      <div style="font-size:13px;font-weight:600;color:var(--lime);margin-bottom:16px;border-bottom:1px solid var(--border);padding-bottom:8px;">
        <i class="fas fa-search" style="margin-right:8px;"></i>SEO Settings
      </div>
      <div class="form-group">
        <label>SEO Title</label>
        <input class="form-control" type="text" id="seo_title" name="seo_title" value="{{ old('seo_title', $blog->seo_title) }}" />
      </div>
      <div class="form-group" style="margin-top:12px;">
        <label>SEO Meta Description</label>
        <textarea class="form-control" id="seo_description" name="seo_description" rows="2">{{ old('seo_description', $blog->seo_description) }}</textarea>
        <div style="font-size:11px;color:var(--muted);margin-top:4px;text-align:right;" id="seoCounter">0 / 160</div>
      </div>
    </div>

    {{-- Settings --}}
    <div style="background:var(--hover);border-radius:12px;padding:20px;margin-bottom:24px;">
      <div style="font-size:13px;font-weight:600;color:var(--lime);margin-bottom:16px;border-bottom:1px solid var(--border);padding-bottom:8px;">
        <i class="fas fa-cog" style="margin-right:8px;"></i>Settings
      </div>
      <div style="display:flex;align-items:center;gap:32px;flex-wrap:wrap;">
        <label style="display:flex;align-items:center;gap:8px;cursor:pointer;font-size:14px;color:var(--text);">
          <input type="checkbox" name="enable_comments" value="1" {{ $blog->enable_comments ? 'checked' : '' }} style="width:16px;height:16px;accent-color:var(--lime);cursor:pointer;" />
          Enable Comments
        </label>
        <label style="display:flex;align-items:center;gap:8px;cursor:pointer;font-size:14px;color:var(--text);">
          <input type="checkbox" name="is_published" value="1" {{ $blog->is_published ? 'checked' : '' }} style="width:16px;height:16px;accent-color:var(--lime);cursor:pointer;" />
          Published
        </label>
      </div>
    </div>

    <div style="display:flex;gap:12px;justify-content:flex-end;">
      <button type="submit" class="btn btn-lime" style="padding:12px 32px;font-size:14px;">
        <i class="fas fa-floppy-disk"></i> Save Changes
      </button>
    </div>

  </form>
</div>

@endsection

@section('scripts')
<link href="https://cdn.jsdelivr.net/npm/quill@2.0.2/dist/quill.snow.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/quill@2.0.2/dist/quill.js"></script>

<style>
  #quill-editor { color: #0d0b1a; font-size: 14px; line-height: 1.7; }
  .ql-toolbar.ql-snow { background: var(--card); border-color: var(--border) !important; border-radius: 8px 8px 0 0; }
  .ql-container.ql-snow { border-color: var(--border) !important; border-radius: 0 0 8px 8px; }
  .ql-toolbar .ql-stroke { stroke: var(--muted) !important; }
  .ql-toolbar .ql-fill { fill: var(--muted) !important; }
  .ql-toolbar button:hover .ql-stroke { stroke: var(--lime) !important; }
  .ql-toolbar button:hover .ql-fill { fill: var(--lime) !important; }
  .ql-toolbar .ql-active .ql-stroke { stroke: var(--lime) !important; }
  .ql-toolbar .ql-picker-label { color: var(--muted) !important; }
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {

  // ── Quill WYSIWYG ──
  const quill = new Quill('#quill-editor', {
    theme: 'snow',
    placeholder: 'Write your blog content here...',
    modules: {
      toolbar: [
        [{ header: [1, 2, 3, false] }],
        ['bold', 'italic', 'underline', 'strike'],
        [{ color: [] }, { background: [] }],
        [{ list: 'ordered' }, { list: 'bullet' }],
        [{ align: [] }],
        ['blockquote', 'code-block'],
        ['link', 'image'],
        ['clean']
      ]
    }
  });

  // Load existing blog content into Quill
  const contentTextarea = document.getElementById('content');
  if (contentTextarea.value) {
    quill.root.innerHTML = contentTextarea.value;
  }

  // Sync to textarea on submit
  document.getElementById('blogForm').addEventListener('submit', function() {
    contentTextarea.value = quill.root.innerHTML;
  });

  // ── Description counter ──
  const desc = document.getElementById('description');
  const descCounter = document.getElementById('descCounter');
  function updateDescCounter() {
    const len = desc.value.length;
    descCounter.textContent = len + ' / 160';
    descCounter.style.color = len > 160 ? 'var(--danger)' : 'var(--muted)';
  }
  desc.addEventListener('input', updateDescCounter);
  updateDescCounter();

  // ── SEO counter ──
  const seoDesc = document.getElementById('seo_description');
  const seoCounter = document.getElementById('seoCounter');
  function updateSeoCounter() {
    const len = seoDesc.value.length;
    seoCounter.textContent = len + ' / 160';
    seoCounter.style.color = len > 160 ? 'var(--danger)' : 'var(--muted)';
  }
  seoDesc.addEventListener('input', updateSeoCounter);
  updateSeoCounter();

  // ── Image preview ──
  document.getElementById('cover_image').addEventListener('change', function(e) {
    const file = e.target.files[0];
    if (file) {
      const reader = new FileReader();
      reader.onload = function(e) {
        document.getElementById('previewImg').src = e.target.result;
        document.getElementById('imagePreview').style.display = 'block';
      };
      reader.readAsDataURL(file);
    }
  });
});
</script>
@endsection