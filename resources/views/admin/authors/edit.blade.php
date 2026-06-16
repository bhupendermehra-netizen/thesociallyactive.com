@extends('admin.layout.app')
@section('page-title', 'Edit Author')

@section('content')

<div style="display:flex;align-items:center;gap:12px;margin-bottom:20px;">
  <a href="{{ route('admin.authors.index') }}" class="btn btn-ghost" style="padding:8px 16px;">
    <i class="fas fa-arrow-left"></i> Back
  </a>
  <h2 style="margin:0;font-size:22px;">Edit Author</h2>
</div>

<div class="tsa-card" style="max-width:800px;">
  <form action="{{ route('admin.authors.update', $author->id) }}" method="POST" enctype="multipart/form-data">
    @csrf

    <div class="form-group">
      <label>Name <span style="color:var(--red);">*</span></label>
      <input class="form-control" type="text" name="name" value="{{ old('name', $author->name) }}" required />
    </div>

    <div class="form-group">
      <label>Bio</label>
      <textarea class="form-control" name="bio" rows="4" placeholder="Short author biography...">{{ old('bio', $author->bio) }}</textarea>
    </div>

    <div class="form-group">
      <label>Profile Image</label>
      @if($author->profile_image)
        <div style="display:flex;align-items:center;gap:12px;margin-bottom:8px;">
          <img src="{{ asset('uploaded_files/image/' . $author->profile_image) }}"
               style="width:48px;height:48px;border-radius:50%;object-fit:cover;border:2px solid var(--border);"
               alt="{{ $author->name }}" />
          <span style="font-size:12px;color:var(--muted);">{{ $author->profile_image }}</span>
        </div>
      @endif
      <input class="form-control" type="file" name="profile_image" accept="image/*" />
      <p style="font-size:11px;color:var(--muted);margin-top:4px;">Leave empty to keep current image.</p>
    </div>

    <div style="margin-top:20px;padding-top:16px;border-top:1px solid var(--border);">
      <h4 style="margin:0 0 12px;font-size:14px;color:var(--text);">Social Links</h4>

      <div style="display:grid;grid-template-columns:1fr 1fr;gap:12px;">
        <div class="form-group">
          <label><i class="fab fa-facebook" style="color:#1877F2;margin-right:6px;"></i>Facebook</label>
          <input class="form-control" type="url" name="facebook" value="{{ old('facebook', $author->facebook) }}" placeholder="https://facebook.com/..." />
        </div>
        <div class="form-group">
          <label><i class="fab fa-instagram" style="color:#E4405F;margin-right:6px;"></i>Instagram</label>
          <input class="form-control" type="url" name="instagram" value="{{ old('instagram', $author->instagram) }}" placeholder="https://instagram.com/..." />
        </div>
        <div class="form-group">
          <label><i class="fab fa-linkedin" style="color:#0A66C2;margin-right:6px;"></i>LinkedIn</label>
          <input class="form-control" type="url" name="linkedin" value="{{ old('linkedin', $author->linkedin) }}" placeholder="https://linkedin.com/..." />
        </div>
        <div class="form-group">
          <label><i class="fab fa-x-twitter" style="color:#1DA1F2;margin-right:6px;"></i>Twitter / X</label>
          <input class="form-control" type="url" name="twitter" value="{{ old('twitter', $author->twitter) }}" placeholder="https://twitter.com/..." />
        </div>
      </div>
    </div>

    <button type="submit" class="btn btn-lime" style="padding:12px 32px;font-size:14px;margin-top:24px;">
      <i class="fas fa-save"></i> Update Author
    </button>
  </form>
</div>

@endsection
