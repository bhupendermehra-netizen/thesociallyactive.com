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

    <div style="margin-bottom:16px;">
      <label style="font-size:14px;font-weight:600;color:var(--text);display:block;margin-bottom:8px;">
        <i class="fas fa-code" style="color:var(--teal);margin-right:8px;"></i>Custom Meta Tags (raw HTML)
      </label>
      <textarea class="form-control" name="custom_meta_tags" style="min-height:150px;font-family:monospace;font-size:13px;line-height:1.6;" placeholder="&lt;link rel=&quot;canonical&quot; href=&quot;https://...&quot;&gt;&#10;&lt;meta property=&quot;og:title&quot; content=&quot;...&quot;&gt;&#10;&lt;meta property=&quot;og:description&quot; content=&quot;...&quot;&gt;&#10;&lt;script type=&quot;application/ld+json&quot;&gt;{...}&lt;/script&gt;">{{ $customMetaTags ?? '' }}</textarea>
      <div style="font-size:11px;color:var(--muted);margin-top:4px;">
        Paste raw &lt;meta&gt;, &lt;link&gt;, &lt;script&gt; tags here — they will be output verbatim inside &lt;head&gt;.
        Only logged-in admins can set this (XSS-safe).
      </div>
    </div>

    <div style="margin-bottom:16px;padding-top:8px;border-top:1px solid var(--border);">
      <div style="font-size:14px;font-weight:600;color:var(--text);display:block;margin-bottom:12px;">
        <i class="fas fa-code" style="color:var(--lime);margin-right:8px;"></i>Page-Specific Scripts
      </div>
      <div style="font-size:12px;color:var(--muted);margin-bottom:12px;">
        These scripts are output <strong>after</strong> any global scripts set in <strong>System → Custom Scripts</strong>.
      </div>

      <label style="font-size:13px;font-weight:600;color:var(--text);display:block;margin-bottom:6px;">
        Head Script (inside &lt;head&gt;)
      </label>
      <textarea class="form-control" name="head_script" style="min-height:100px;font-family:monospace;font-size:13px;line-height:1.6;" placeholder="&lt;script&gt;console.log('page-specific head');&lt;/script&gt;">{{ $headScript ?? '' }}</textarea>
      <div style="font-size:11px;color:var(--muted);margin-top:4px;margin-bottom:14px;">
        Output before &lt;/head&gt; — only on this page.
      </div>

      <label style="font-size:13px;font-weight:600;color:var(--text);display:block;margin-bottom:6px;">
        Body Script (after &lt;body&gt;)
      </label>
      <textarea class="form-control" name="body_script" style="min-height:100px;font-family:monospace;font-size:13px;line-height:1.6;" placeholder="&lt;noscript&gt;&lt;iframe src=&quot;...&quot;&gt;&lt;/iframe&gt;&lt;/noscript&gt;">{{ $bodyScript ?? '' }}</textarea>
      <div style="font-size:11px;color:var(--muted);margin-top:4px;">
        Output right after &lt;body&gt; opens — only on this page.
      </div>
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
