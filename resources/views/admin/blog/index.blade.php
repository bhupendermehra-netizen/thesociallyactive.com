@extends('admin.layout.app')
@section('page-title', 'Blog Posts')

@section('content')

@if(session('success'))
<div style="background:rgba(103,252,198,0.1);border:1px solid rgba(103,252,198,0.3);border-radius:10px;padding:12px 16px;font-size:13px;color:var(--teal);display:flex;align-items:center;gap:8px;margin-bottom:20px;">
  <i class="fas fa-circle-check"></i> {{ session('success') }}
</div>
@endif

{{-- Search & Filter --}}
<div class="tsa-card" style="margin-bottom:20px;padding:20px 24px;">
  <form method="GET" action="{{ route('admin.blog.index') }}">
    <div style="display:grid;grid-template-columns:1fr 1fr 1fr auto;gap:12px;align-items:end;">
      <div>
        <label style="font-size:11px;color:var(--muted);font-weight:600;text-transform:uppercase;letter-spacing:0.05em;display:block;margin-bottom:6px;">Search</label>
        <input class="form-control" type="text" name="search" value="{{ request('search') }}" placeholder="Search posts..." />
      </div>
      <div>
        <label style="font-size:11px;color:var(--muted);font-weight:600;text-transform:uppercase;letter-spacing:0.05em;display:block;margin-bottom:6px;">Category</label>
        <select class="form-control" name="category">
          <option value="">All Categories</option>
          @foreach($categories as $cat)
            <option value="{{ $cat->id }}" {{ request('category') == $cat->id ? 'selected' : '' }}>{{ $cat->name }}</option>
          @endforeach
        </select>
      </div>
      <div>
        <label style="font-size:11px;color:var(--muted);font-weight:600;text-transform:uppercase;letter-spacing:0.05em;display:block;margin-bottom:6px;">Status</label>
        <select class="form-control" name="status">
          <option value="">All</option>
          <option value="published" {{ request('status') == 'published' ? 'selected' : '' }}>Published</option>
          <option value="draft" {{ request('status') == 'draft' ? 'selected' : '' }}>Draft</option>
        </select>
      </div>
      <button type="submit" class="btn btn-lime" style="padding:11px 20px;">
        <i class="fas fa-search"></i> Filter
      </button>
    </div>
  </form>
</div>

<div class="tsa-card">
  <div class="tsa-card-title">
    <span><i class="fas fa-newspaper" style="color:var(--lime);margin-right:8px;"></i>All Posts <span class="badge badge-muted" style="margin-left:8px;">{{ $blogs->total() }}</span></span>
    <div style="display:flex;gap:8px;">
      <a href="{{ route('admin.blog.categories') }}" class="btn btn-ghost">
        <i class="fas fa-tags"></i> Categories
      </a>
      <a href="{{ route('admin.blog.create') }}" class="btn btn-lime">
        <i class="fas fa-plus"></i> New Post
      </a>
    </div>
  </div>

  <div style="overflow-x:auto;">
    <table class="tsa-table">
      <thead>
        <tr>
          <th>#</th>
          <th>Cover</th>
          <th>Title</th>
          <th>Category</th>
          <th>Status</th>
          <th>Date</th>
          <th>Actions</th>
        </tr>
      </thead>
      <tbody>
        @foreach($blogs as $i => $blog)
        <tr>
          <td class="muted">{{ $blogs->firstItem() + $i }}</td>
          <td>
            @if($blog->cover_image)
              @if(Str::startsWith($blog->cover_image, 'http'))
                <img src="{{ $blog->cover_image }}" style="width:64px;height:44px;object-fit:cover;border-radius:8px;" />
              @else
                <img src="{{ asset($blog->cover_image) }}" style="width:64px;height:44px;object-fit:cover;border-radius:8px;" />
              @endif
            @else
              <div style="width:64px;height:44px;border-radius:8px;background:var(--hover);display:flex;align-items:center;justify-content:center;">
                <i class="fas fa-image" style="color:var(--muted);font-size:16px;"></i>
              </div>
            @endif
          </td>
          <td>
            <div style="font-weight:600;max-width:280px;">{{ Str::limit($blog->title, 50) }}</div>
            <div style="font-size:11px;color:var(--muted);margin-top:2px;">{{ Str::limit(strip_tags($blog->description), 60) }}</div>
          </td>
          <td>
            @if($blog->category)
              <span class="badge badge-teal">{{ $blog->category->name }}</span>
            @else
              <span class="muted">—</span>
            @endif
          </td>
          <td>
            @if($blog->is_published)
              <span class="badge badge-lime">Published</span>
            @else
              <span class="badge badge-muted">Draft</span>
            @endif
          </td>
          <td class="muted" style="white-space:nowrap;">{{ $blog->created_at->format('d M Y') }}</td>
          <td>
            <div style="display:flex;gap:6px;">
              <a href="{{ route('admin.blog.edit', $blog->id) }}" class="btn btn-teal">
                <i class="fas fa-pen"></i>
              </a>
              <form action="{{ route('admin.blog.destroy', $blog->id) }}" method="POST"
                onsubmit="return confirm('Delete this post?')">
                @csrf
                <button type="submit" class="btn btn-red"><i class="fas fa-trash"></i></button>
              </form>
            </div>
          </td>
        </tr>
        @endforeach

        @if($blogs->isEmpty())
        <tr>
          <td colspan="7" style="text-align:center;padding:48px;">
            <i class="fas fa-newspaper" style="font-size:32px;color:var(--muted);opacity:0.4;display:block;margin-bottom:12px;"></i>
            <span style="color:var(--muted);">No posts yet</span>
          </td>
        </tr>
        @endif
      </tbody>
    </table>
  </div>

  @if($blogs->hasPages())
  <div style="padding:16px 0 4px;display:flex;justify-content:center;">
    {{ $blogs->links() }}
  </div>
  @endif
</div>

@endsection