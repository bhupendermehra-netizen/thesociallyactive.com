{{-- ============================================================ --}}
{{-- FILE 1: resources/views/admin/projects/create.blade.php --}}
{{-- ============================================================ --}}
@extends('admin.layout.app')
@section('page-title', 'Add Project')
 
@section('content')
 
<div style="margin-bottom:20px;">
  <a href="{{ route('admin.projects.index') }}" class="btn btn-ghost">
    <i class="fas fa-arrow-left"></i> Back
  </a>
</div>
 
<div class="tsa-card" style="max-width:680px;">
  <div class="tsa-card-title">
    <span><i class="fas fa-plus" style="color:var(--lime);margin-right:8px;"></i>Add New Project</span>
  </div>
 
  <form action="{{ route('admin.projects.store') }}" method="POST" enctype="multipart/form-data">
    @csrf
 
    <div class="form-group">
      <label>Project Title *</label>
      <input class="form-control" type="text" name="title" value="{{ old('title') }}"
        placeholder="e.g. Neural Sentinel" required />
      @error('title') <span style="color:var(--danger);font-size:12px;">{{ $message }}</span> @enderror
    </div>
 
    <div class="form-group">
      <label>Tags <span style="color:var(--muted);font-weight:400;text-transform:none;">(comma separated)</span></label>
      <input class="form-control" type="text" name="tags" value="{{ old('tags') }}"
        placeholder="e.g. web, design, development, 3d" />
      <div style="font-size:11px;color:var(--muted);margin-top:6px;">Example: web, design, 3d, branding</div>
    </div>
 
    <div class="form-group">
      <label>Project Image</label>
      <input class="form-control" type="file" name="image" accept="image/*"
        style="padding:8px 12px;font-size:13px;" />
      <div style="font-size:11px;color:var(--muted);margin-top:6px;">Recommended: 800x600px, JPG/PNG/WEBP</div>
    </div>
 
    <div class="form-group">
      <label>Project Link</label>
      <input class="form-control" type="text" name="link" value="{{ old('link', '#') }}"
        placeholder="https://example.com or #" />
    </div>
 
    <div style="display:grid;grid-template-columns:1fr 1fr;gap:16px;">
      <div class="form-group">
        <label>Sort Order</label>
        <input class="form-control" type="number" name="sort_order" value="{{ old('sort_order', 0) }}"
          placeholder="0" min="0" />
        <div style="font-size:11px;color:var(--muted);margin-top:6px;">Lower number = shows first</div>
      </div>
      <div class="form-group">
        <label>Status</label>
        <div style="display:flex;align-items:center;gap:10px;margin-top:10px;">
          <input type="checkbox" name="is_active" id="is_active" value="1"
            {{ old('is_active', 1) ? 'checked' : '' }}
            style="width:16px;height:16px;accent-color:var(--lime);cursor:pointer;" />
          <label for="is_active" style="font-size:13px;color:var(--text);text-transform:none;letter-spacing:0;margin:0;cursor:pointer;">
            Active (visible on website)
          </label>
        </div>
      </div>
    </div>
 
    <div style="margin-top:8px;">
      <button type="submit" class="btn btn-lime" style="padding:12px 32px;font-size:14px;">
        <i class="fas fa-floppy-disk"></i> Save Project
      </button>
    </div>
  </form>
</div>
 
@endsection
 