@extends('admin.layout.app')
@section('page-title', 'Add Page Section')

@section('content')

<div style="margin-bottom:20px;">
  <a href="{{ route('admin.page') }}" class="btn btn-ghost">
    <i class="fas fa-arrow-left"></i> Back to Pages
  </a>
</div>

<div class="tsa-card">
  <div class="tsa-card-title">
    <span><i class="fas fa-plus" style="color:var(--lime);margin-right:8px;"></i>Add New Section</span>
  </div>

  <form action="{{ route('admin.page.add') }}" method="POST" enctype="multipart/form-data">
    @csrf

    {{-- Top Fields --}}
    <div style="display:grid;grid-template-columns:repeat(auto-fit,minmax(200px,1fr));gap:16px;margin-bottom:28px;">
      <div class="form-group" style="margin:0;">
        <label>Page</label>
        <input class="form-control" type="text" name="page" list="page_list"
          placeholder="Select or type page name" required />
        <datalist id="page_list">
          @foreach($pages as $data)
            <option value="{{ $data->page }}">{{ $data->page }}</option>
          @endforeach
        </datalist>
      </div>
      <div class="form-group" style="margin:0;">
        <label>Title</label>
        <input class="form-control" type="text" name="title" placeholder="Section title" required />
      </div>
      <div class="form-group" style="margin:0;">
        <label>Section Key</label>
        <input class="form-control" type="text" name="section" placeholder="e.g. hero_section" required />
      </div>
      <div class="form-group" style="margin:0;">
        <label>Meta Title</label>
        <input class="form-control" type="text" name="meta_title" placeholder="SEO page title" />
      </div>
      <div class="form-group" style="margin:0;">
        <label>Meta Description</label>
        <textarea class="form-control" name="meta_description" style="min-height:50px;" placeholder="SEO description"></textarea>
      </div>
      <div class="form-group" style="margin:0;">
        <label>Meta Keywords</label>
        <input class="form-control" type="text" name="meta_keywords" placeholder="keyword1, keyword2" />
      </div>
      <div class="form-group" style="margin:0;">
        <label>Status</label>
        <select class="form-control" name="status">
          <option value="published" selected>Published</option>
          <option value="draft">Draft</option>
        </select>
      </div>
    </div>

    {{-- Fields Table --}}
    <div style="margin-bottom:16px;display:flex;align-items:center;justify-content:space-between;">
      <div style="font-size:14px;font-weight:600;color:var(--text);">
        <i class="fas fa-list" style="color:var(--teal);margin-right:8px;"></i>Fields
      </div>
      <button class="btn btn-teal add_fields" type="button">
        <i class="fas fa-plus"></i> Add Field
      </button>
    </div>

    <div style="overflow-x:auto;margin-bottom:24px;">
      <table class="tsa-table" id="fields-table">
        <thead>
          <tr>
            <th>Name</th>
            <th>Text</th>
            <th>Link</th>
            <th>Image</th>
            <th>Type</th>
            <th style="width:50px;"></th>
          </tr>
        </thead>
        <tbody class="field_div">
          {{-- Rows added dynamically --}}
        </tbody>
      </table>
      <div id="empty-fields" style="text-align:center;padding:32px;color:var(--muted);font-size:13px;">
        <i class="fas fa-plus-circle" style="font-size:24px;display:block;margin-bottom:8px;opacity:0.4;"></i>
        Click "Add Field" to add fields
      </div>
    </div>

    <button type="submit" class="btn btn-lime" style="padding:12px 32px;font-size:14px;">
      <i class="fas fa-floppy-disk"></i> Save Section
    </button>

  </form>
</div>

@endsection

@section('scripts')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<script>
$(document).ready(function() {

  function updateEmpty() {
    const rows = $('.field_div tr').length;
    $('#empty-fields').toggle(rows === 0);
  }

  updateEmpty();

  $('.add_fields').click(function() {
    $('#empty-fields').hide();
    $('.field_div').append(`
      <tr style="background:var(--card);">
        <td><input class="form-control" type="text" name="name[]" placeholder="Field name" /></td>
        <td><textarea class="form-control" name="text[]" style="min-height:60px;" placeholder="Content..."></textarea></td>
        <td><input class="form-control" type="text" name="link[]" placeholder="https://" /></td>
        <td><input class="form-control" type="file" name="image[]" style="font-size:12px;padding:6px 10px;" /></td>
        <td>
          <select class="form-control" name="type[]">
            <option value="text">Text</option>
            <option value="image">Image</option>
            <option value="link">Link</option>
          </select>
        </td>
        <td>
          <button type="button" class="btn btn-red remove-row" style="padding:6px 10px;">
            <i class="fas fa-trash"></i>
          </button>
        </td>
      </tr>
    `);
  });

  $(document).on('click', '.remove-row', function() {
    $(this).closest('tr').remove();
    updateEmpty();
  });

});
</script>
@endsection