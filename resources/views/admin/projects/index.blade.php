@extends('admin.layout.app')
@section('page-title', 'Projects')

@section('content')

@if(session('success'))
<div style="background:rgba(103,252,198,0.1);border:1px solid rgba(103,252,198,0.3);border-radius:10px;padding:12px 16px;font-size:13px;color:var(--teal);display:flex;align-items:center;gap:8px;margin-bottom:20px;">
  <i class="fas fa-circle-check"></i> {{ session('success') }}
</div>
@endif

<div class="tsa-card">
  <div class="tsa-card-title">
    <span><i class="fas fa-briefcase" style="color:var(--lime);margin-right:8px;"></i>All Projects</span>
    <a href="{{ route('admin.projects.create') }}" class="btn btn-lime">
      <i class="fas fa-plus"></i> Add Project
    </a>
  </div>

  <div style="overflow-x:auto;">
    <table class="tsa-table">
      <thead>
        <tr>
          <th>#</th>
          <th>Image</th>
          <th>Title</th>
          <th>Tags</th>
          <th>Order</th>
          <th>Status</th>
          <th>Actions</th>
        </tr>
      </thead>
      <tbody>
        @foreach($projects as $i => $project)
        <tr>
          <td class="muted">{{ $i + 1 }}</td>
          <td>
            @if($project->image)
              <img src="{{ asset('images/' . $project->image) }}"
                style="width:60px;height:44px;object-fit:cover;border-radius:8px;border:1px solid rgba(255,255,255,0.08);" />
            @else
              <div style="width:60px;height:44px;border-radius:8px;background:var(--hover);display:flex;align-items:center;justify-content:center;">
                <i class="fas fa-image" style="color:var(--muted);font-size:16px;"></i>
              </div>
            @endif
          </td>
          <td style="font-weight:600;">{{ $project->title }}</td>
          <td>
            <div style="display:flex;flex-wrap:wrap;gap:4px;">
              @foreach($project->tags_array as $tag)
                @if($tag)
                <span class="badge badge-muted" style="font-size:10px;">{{ $tag }}</span>
                @endif
              @endforeach
            </div>
          </td>
          <td class="muted">{{ $project->sort_order }}</td>
          <td>
            @if($project->is_active)
              <span class="badge badge-teal">Active</span>
            @else
              <span class="badge badge-red">Hidden</span>
            @endif
          </td>
          <td>
            <div style="display:flex;gap:8px;">
              <a href="{{ route('admin.projects.edit', $project->id) }}" class="btn btn-teal">
                <i class="fas fa-pen"></i> Edit
              </a>
              <form action="{{ route('admin.projects.delete', $project->id) }}" method="POST"
                onsubmit="return confirm('Delete {{ $project->title }}?')">
                @csrf
                <button type="submit" class="btn btn-red">
                  <i class="fas fa-trash"></i>
                </button>
              </form>
            </div>
          </td>
        </tr>
        @endforeach

        @if($projects->isEmpty())
        <tr>
          <td colspan="7" style="text-align:center;padding:48px;">
            <i class="fas fa-briefcase" style="font-size:32px;color:var(--muted);opacity:0.4;display:block;margin-bottom:12px;"></i>
            <span style="color:var(--muted);">No projects yet — add your first one!</span>
          </td>
        </tr>
        @endif
      </tbody>
    </table>
  </div>
</div>

@endsection