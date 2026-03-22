@extends('admin.layout.app')
@section('page-title', 'Pages')

@section('content')

<div class="tsa-card">
  <div class="tsa-card-title">
    <span>
      <i class="fas fa-file-lines" style="color:var(--lime);margin-right:8px;"></i>
      All Pages
    </span>
    <a href="{{ route('admin.page.add') }}" class="btn btn-lime">
      <i class="fas fa-plus"></i> Add New
    </a>
  </div>

  <div style="overflow-x:auto;">
    <table class="tsa-table">
      <thead>
        <tr>
          <th>#</th>
          <th>Page Name</th>
          <th>Action</th>
        </tr>
      </thead>
      <tbody>
        @foreach($pages as $key => $data)
        <tr>
          <td class="muted">{{ $key + 1 }}</td>
          <td>
            <div style="display:flex;align-items:center;gap:10px;">
              <div style="width:34px;height:34px;border-radius:8px;background:rgba(223,248,17,0.1);border:1px solid rgba(223,248,17,0.2);display:flex;align-items:center;justify-content:center;flex-shrink:0;">
                <i class="fas fa-file" style="color:var(--lime);font-size:13px;"></i>
              </div>
              <span style="font-weight:600;">{{ $data->page }}</span>
            </div>
          </td>
          <td>
            <a href="{{ route('admin.page.view', $data->page) }}" class="btn btn-teal">
              <i class="fas fa-eye"></i> View
            </a>
          </td>
        </tr>
        @endforeach

        @if(count($pages) === 0)
        <tr>
          <td colspan="3" style="text-align:center;padding:48px;">
            <i class="fas fa-file-lines" style="font-size:32px;color:var(--muted);opacity:0.4;display:block;margin-bottom:12px;"></i>
            <span style="color:var(--muted);">No pages found</span>
          </td>
        </tr>
        @endif
      </tbody>
    </table>
  </div>
</div>

@endsection