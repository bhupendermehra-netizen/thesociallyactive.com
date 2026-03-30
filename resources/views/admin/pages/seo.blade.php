@extends('admin.layout.app')
@section('page-title', 'SEO Meta Tags')

@section('content')

<div style="margin-bottom:20px;">
  <a href="{{ route('admin.page.view', $page) }}" class="btn btn-ghost">
    <i class="fas fa-arrow-left"></i> Back to Page
  </a>
</div>

<div class="tsa-card">
  <div class="tsa-card-title">
    <span><i class="fas fa-search" style="color:var(--lime);margin-right:8px;"></i>SEO Meta Tags for "{{ $page }}"</span>
  </div>

  <form action="{{ route('admin.page.seo.update', $page) }}" method="POST">
    @csrf

    <div style="margin-bottom:16px;display:flex;align-items:center;justify-content:space-between;">
      <div style="font-size:14px;font-weight:600;color:var(--text);">
        <i class="fas fa-list" style="color:var(--teal);margin-right:8px;"></i>Meta entries
      </div>
      <button class="btn btn-teal" type="button" id="add-meta-row">
        <i class="fas fa-plus"></i> Add Meta Tag
      </button>
    </div>

    <div style="overflow-x:auto;margin-bottom:24px;">
      <table class="tsa-table">
        <thead>
          <tr>
            <th style="width:40px;">#</th>
            <th>Name</th>
            <th>Content</th>
            <th style="width:100px;">Action</th>
          </tr>
        </thead>
        <tbody id="meta-table-body">
          @foreach($seoFields as $idx => $meta)
            <tr>
              <td>{{ $idx + 1 }}</td>
              <td><input class="form-control" type="text" name="name[]" value="{{ $meta['name'] ?? '' }}" placeholder="meta name" required/></td>
              <td><input class="form-control" type="text" name="content[]" value="{{ $meta['text'] ?? '' }}" placeholder="meta content" required/></td>
              <td><button type="button" class="btn btn-red remove-meta"><i class="fas fa-trash"></i></button></td>
            </tr>
          @endforeach

          @if(count($seoFields) === 0)
            <tr id="meta-empty-row">
              <td colspan="4" style="text-align:center;color:var(--muted);padding:24px;">No SEO meta tags yet; use ‘Add Meta Tag’.</td>
            </tr>
          @endif
        </tbody>
      </table>
    </div>

    <button type="submit" class="btn btn-lime" style="padding:12px 32px;font-size:14px;">
      <i class="fas fa-floppy-disk"></i> Save SEO Tags
    </button>
  </form>
</div>

@endsection

@section('scripts')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<script>
$(document).ready(function() {
  function updateEmptyRow() {
    if($('#meta-table-body tr').length === 0) {
      $('#meta-table-body').append('<tr id="meta-empty-row"><td colspan="4" style="text-align:center;color:var(--muted);padding:24px;">No SEO meta tags yet; use \'Add Meta Tag\'.</td></tr>');
    } else {
      $('#meta-empty-row').remove();
    }
  }

  $('#add-meta-row').click(function() {
    $('#meta-table-body').append(`
      <tr>
        <td>?</td>
        <td><input class="form-control" type="text" name="name[]" placeholder="meta name" required/></td>
        <td><input class="form-control" type="text" name="content[]" placeholder="meta content" required/></td>
        <td><button type="button" class="btn btn-red remove-meta"><i class="fas fa-trash"></i></button></td>
      </tr>
    `);
    updateEmptyRow();
  });

  $(document).on('click', '.remove-meta', function() {
    $(this).closest('tr').remove();
    updateEmptyRow();
  });

  updateEmptyRow();
});
</script>
@endsection
