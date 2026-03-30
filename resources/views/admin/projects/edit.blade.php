 
{{-- ============================================================ --}}
{{-- FILE 2: resources/views/admin/projects/edit.blade.php --}}
{{-- ============================================================ --}}

@extends('admin.layout.app')
@section('page-title', 'Edit Project')
 
@section('content')
 
<div style="margin-bottom:20px;">
  <a href="{{ route('admin.projects.index') }}" class="btn btn-ghost">
    <i class="fas fa-arrow-left"></i> Back
  </a>
</div>
 
<div class="tsa-card" style="max-width:680px;">
  <div class="tsa-card-title">
    <span><i class="fas fa-pen" style="color:var(--lime);margin-right:8px;"></i>Edit Project</span>
  </div>
 
  <form action="{{ route('admin.projects.update', $project->id) }}" method="POST" enctype="multipart/form-data">
    @csrf
 
    <div class="form-group">
      <label>Project Title *</label>
      <input class="form-control" type="text" name="title" value="{{ old('title', $project->title) }}" required />
    </div>
 
    <div class="form-group">
      <label>Tags <span style="color:var(--muted);font-weight:400;text-transform:none;">(comma separated)</span></label>
      <input class="form-control" type="text" name="tags" value="{{ old('tags', $project->tags) }}"
        placeholder="e.g. web, design, development, 3d" />
    </div>
 
    <div class="form-group">
      <label>Project Image</label>
      @if($project->image)
        <div style="margin-bottom:10px;">
          <img src="{{ asset('images/' . $project->image) }}"
            style="height:100px;border-radius:8px;object-fit:cover;" />
          <div style="font-size:11px;color:var(--muted);margin-top:4px;">Current image — upload new to replace</div>
        </div>
      @endif
      <input class="form-control" type="file" name="image" accept="image/*"
        style="padding:8px 12px;font-size:13px;" />
    </div>
 
    <div class="form-group">
      <label>Project Link</label>
      <input class="form-control" type="text" name="link" value="{{ old('link', $project->link) }}" />
    </div>
 
    <div style="display:grid;grid-template-columns:1fr 1fr;gap:16px;">
      <div class="form-group">
        <label>Sort Order</label>
        <input class="form-control" type="number" name="sort_order"
          value="{{ old('sort_order', $project->sort_order) }}" min="0" />
      </div>
      <div class="form-group">
        <label>Status</label>
        <div style="display:flex;align-items:center;gap:10px;margin-top:10px;">
          <input type="checkbox" name="is_active" id="is_active" value="1"
            {{ $project->is_active ? 'checked' : '' }}
            style="width:16px;height:16px;accent-color:var(--lime);cursor:pointer;" />
          <label for="is_active" style="font-size:13px;color:var(--text);text-transform:none;letter-spacing:0;margin:0;cursor:pointer;">
            Active (visible on website)
          </label>
        </div>
      </div>
    </div>
 
    <div style="margin-top:8px;">
      <button type="submit" class="btn btn-lime" style="padding:12px 32px;font-size:14px;">
        <i class="fas fa-floppy-disk"></i> Update Project
      </button>
    </div>
  </form>
</div>
 
@endsection
