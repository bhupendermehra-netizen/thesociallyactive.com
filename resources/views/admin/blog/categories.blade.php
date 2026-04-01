@extends('admin.layout.app')
@section('page-title', 'Blog Categories')

@section('content')

@if(session('success'))
<div style="background:rgba(103,252,198,0.1);border:1px solid rgba(103,252,198,0.3);border-radius:10px;padding:12px 16px;font-size:13px;color:var(--teal);display:flex;align-items:center;gap:8px;margin-bottom:20px;">
  <i class="fas fa-circle-check"></i> {{ session('success') }}
</div>
@endif

<div style="display:grid;grid-template-columns:1fr 1fr;gap:20px;">

  {{-- Add Category --}}
  <div class="tsa-card">
    <div class="tsa-card-title">
      <span><i class="fas fa-plus" style="color:var(--lime);margin-right:8px;"></i>Add Category</span>
    </div>
    <form action="{{ route('admin.blog.category.store') }}" method="POST">
      @csrf
      <div class="form-group">
        <label>Category Name</label>
        <input class="form-control" type="text" name="name" placeholder="e.g. Brand Strategy" required />
      </div>
      <button type="submit" class="btn btn-lime" style="padding:10px 24px;">
        <i class="fas fa-plus"></i> Add
      </button>
    </form>
  </div>

  {{-- Categories List --}}
  <div class="tsa-card">
    <div class="tsa-card-title">
      <span><i class="fas fa-tags" style="color:var(--teal);margin-right:8px;"></i>All Categories</span>
      <a href="{{ route('admin.blog.index') }}" class="btn btn-ghost">
        <i class="fas fa-arrow-left"></i> Posts
      </a>
    </div>

    <table class="tsa-table">
      <thead>
        <tr>
          <th>Name</th>
          <th>Posts</th>
          <th>Action</th>
        </tr>
      </thead>
      <tbody>
        @foreach($categories as $cat)
        <tr>
          <td style="font-weight:600;">{{ $cat->name }}</td>
          <td><span class="badge badge-muted">{{ $cat->blogs_count }}</span></td>
          <td>
            <form action="{{ route('admin.blog.category.destroy', $cat->id) }}" method="POST"
              onsubmit="return confirm('Delete {{ $cat->name }}?')">
              @csrf
              <button type="submit" class="btn btn-red">
                <i class="fas fa-trash"></i>
              </button>
            </form>
          </td>
        </tr>
        @endforeach
        @if($categories->isEmpty())
        <tr>
          <td colspan="3" style="text-align:center;padding:32px;color:var(--muted);">No categories yet</td>
        </tr>
        @endif
      </tbody>
    </table>
  </div>

</div>

@endsection