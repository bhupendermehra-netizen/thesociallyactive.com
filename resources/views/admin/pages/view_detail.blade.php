@extends('admin.layout.app')
@section('page-title', 'View Page')

@section('content')

<div style="margin-bottom:20px;">
  <a href="{{ route('admin.page') }}" class="btn btn-ghost">
    <i class="fas fa-arrow-left"></i> Back to Pages
  </a>
</div>

{{-- Page header info --}}
<div class="tsa-card" style="margin-bottom:20px;padding:18px 24px;">
  <div style="display:flex;align-items:center;gap:14px;">
    <div style="width:44px;height:44px;border-radius:12px;background:rgba(223,248,17,0.1);border:1px solid rgba(223,248,17,0.2);display:flex;align-items:center;justify-content:center;flex-shrink:0;">
      <i class="fas fa-file-lines" style="color:var(--lime);font-size:18px;"></i>
    </div>
    <div>
      <div style="font-family:'Manrope',sans-serif;font-size:18px;font-weight:800;color:var(--text);">
        {{ $pages->first()->page ?? $page ?? 'Page' }}
      </div>
      <div style="font-size:12px;color:var(--muted);margin-top:2px;">
        {{ count($pages) }} section(s)
      </div>
    </div>
  </div>
</div>

{{-- Sections table --}}
<div class="tsa-card">
  <div class="tsa-card-title">
    <span>
      <i class="fas fa-layer-group" style="color:var(--teal);margin-right:8px;"></i>
      Page Sections
    </span>
  </div>

  <div style="overflow-x:auto;">
    <table class="tsa-table">
      <thead>
        <tr>
          <th>#</th>
          <th>Title</th>
          <th>Page Section</th>
          <th>Action</th>
        </tr>
      </thead>
      <tbody>
        @foreach($pages as $key => $data)
        <tr>
          <td class="muted">{{ $key + 1 }}</td>
          <td style="font-weight:600;">{{ $data->title }}</td>
          <td>
            <span class="badge badge-muted">{{ $data->section }}</span>
          </td>
          <td>
            <a href="{{ route('admin.page.edit', $data->id) }}" class="btn btn-teal">
              <i class="fas fa-pen"></i> Edit
            </a>
          </td>
        </tr>
        @endforeach

        @if(isset($extraImage) && $extraImage > 0)
        <tr>
          <td class="muted">{{ count($pages) + 1 }}</td>
          <td style="font-weight:600;">Extra Images</td>
          <td><span class="badge badge-lime">Gallery</span></td>
          <td>
            <a href="{{ route('admin.extraImage', $page) }}" class="btn btn-lime">
              <i class="fas fa-images"></i> View
            </a>
          </td>
        </tr>
        @endif
      </tbody>
    </table>
  </div>
</div>

@endsection