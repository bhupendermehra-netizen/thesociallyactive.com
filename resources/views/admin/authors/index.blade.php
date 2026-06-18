@extends('admin.layout.app')
@section('page-title', 'Authors')

@section('content')

@if(session('success'))
<div style="background:rgba(103,252,198,0.1);border:1px solid rgba(103,252,198,0.3);border-radius:10px;padding:12px 16px;font-size:13px;color:var(--teal);display:flex;align-items:center;gap:8px;margin-bottom:20px;">
  <i class="fas fa-circle-check"></i> {{ session('success') }}
</div>
@endif

{{-- Header --}}
<div style="display:flex;align-items:center;justify-content:space-between;margin-bottom:20px;">
  <div>
    <h2 style="margin:0;font-size:22px;">Authors</h2>
    <p style="margin:4px 0 0;font-size:13px;color:var(--muted);">Manage blog authors and their profiles</p>
  </div>
  <a href="{{ route('admin.authors.create') }}" class="btn btn-lime" style="padding:10px 24px;display:flex;align-items:center;gap:8px;">
    <i class="fas fa-plus"></i> Add Author
  </a>
</div>

{{-- Authors List --}}
<div class="tsa-card" style="overflow:hidden;">
  @if(count($authors))
    <table class="tsa-table" style="margin:0;">
      <thead>
        <tr>
          <th style="width:40px;"></th>
          <th>Name</th>
          <th>Bio</th>
          <th style="width:60px;">Blogs</th>
          <th style="width:100px;">Social</th>
          <th style="width:120px;">Action</th>
        </tr>
      </thead>
      <tbody>
        @foreach($authors as $author)
        <tr>
          <td>
            @if($author->profile_image)
              <img src="{{ asset('uploaded_files/image/' . $author->profile_image) }}"
                   style="width:32px;height:32px;border-radius:50%;object-fit:cover;"
                   alt="{{ $author->name }}" />
            @else
              <div style="width:32px;height:32px;border-radius:50%;background:var(--bg-dark);display:flex;align-items:center;justify-content:center;font-size:13px;color:var(--muted);">
                <i class="fas fa-user"></i>
              </div>
            @endif
          </td>
          <td style="font-weight:600;">{{ $author->name }}</td>
          <td style="max-width:250px;overflow:hidden;text-overflow:ellipsis;white-space:nowrap;color:var(--muted);font-size:13px;">
            {{ Str::limit($author->bio, 80) }}
          </td>
          <td><span class="badge badge-muted">{{ $author->blogs_count }}</span></td>
          <td>
            <div style="display:flex;gap:6px;font-size:14px;">
              @if($author->facebook) <a href="{{ $author->facebook }}" target="_blank" style="color:#1877F2;"><i class="fab fa-facebook"></i></a> @endif
              @if($author->instagram) <a href="{{ $author->instagram }}" target="_blank" style="color:#E4405F;"><i class="fab fa-instagram"></i></a> @endif
              @if($author->linkedin) <a href="{{ $author->linkedin }}" target="_blank" style="color:#0A66C2;"><i class="fab fa-linkedin"></i></a> @endif
              @if($author->twitter) <a href="{{ $author->twitter }}" target="_blank" style="color:#1DA1F2;"><i class="fab fa-x-twitter"></i></a> @endif
              @if(!$author->facebook && !$author->instagram && !$author->linkedin && !$author->twitter)
                <span style="color:var(--muted);font-size:11px;">—</span>
              @endif
            </div>
          </td>
          <td>
            <div style="display:flex;gap:6px;">
              <a href="{{ route('admin.authors.edit', $author->id) }}" class="btn btn-ghost" style="padding:6px 12px;font-size:12px;">
                <i class="fas fa-edit"></i>
              </a>
              <form action="{{ route('admin.authors.destroy', $author->id) }}" method="POST"
                    onsubmit="return confirm('Delete {{ $author->name }}? Blogs by this author will become unassigned.');">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-red" style="padding:6px 12px;font-size:12px;">
                  <i class="fas fa-trash"></i>
                </button>
              </form>
            </div>
          </td>
        </tr>
        @endforeach
      </tbody>
    </table>
  @else
    <div style="text-align:center;padding:60px 20px;color:var(--muted);">
      <i class="fas fa-user-pen" style="font-size:40px;display:block;margin-bottom:12px;opacity:0.4;"></i>
      <p style="font-size:14px;">No authors yet. Create your first author profile above.</p>
    </div>
  @endif
</div>

@endsection
