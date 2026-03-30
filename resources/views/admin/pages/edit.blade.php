@extends('admin.layout.app')
@section('page-title', 'Edit Section')

@section('content')

<div style="margin-bottom:20px;">
  <a href="{{ url()->previous() }}" class="btn btn-ghost">
    <i class="fas fa-arrow-left"></i> Back
  </a>
</div>

{{-- Info bar --}}
<div class="tsa-card" style="margin-bottom:20px;padding:16px 24px;">
  <div style="display:flex;gap:32px;flex-wrap:wrap;align-items:center;">
    <div>
      <div style="font-size:11px;color:var(--muted);text-transform:uppercase;letter-spacing:0.06em;margin-bottom:4px;">Page</div>
      <div style="font-weight:700;color:var(--text);">{{ $page->page }}</div>
    </div>
    <div>
      <div style="font-size:11px;color:var(--muted);text-transform:uppercase;letter-spacing:0.06em;margin-bottom:4px;">Title</div>
      <div style="font-weight:700;color:var(--text);">{{ $page->title }}</div>
    </div>
    <div>
      <div style="font-size:11px;color:var(--muted);text-transform:uppercase;letter-spacing:0.06em;margin-bottom:4px;">Section</div>
      <span class="badge badge-lime">{{ $page->section }}</span>
    </div>
  </div>
</div>

{{-- Edit Form --}}
<div class="tsa-card">
  <div class="tsa-card-title">
    <span><i class="fas fa-pen" style="color:var(--lime);margin-right:8px;"></i>Edit Fields</span>
  </div>

  <form action="{{ route('admin.page.update', $page->id) }}" method="POST" enctype="multipart/form-data">
    @csrf

    {{-- Hidden top fields --}}
    <div style="display:grid;grid-template-columns:repeat(auto-fit,minmax(200px,1fr));gap:16px;margin-bottom:24px;">
      <div class="form-group" style="margin:0;">
        <label>Page</label>
        <input class="form-control" type="text" name="page" value="{{ $page->page }}" required />
      </div>
      <div class="form-group" style="margin:0;">
        <label>Title</label>
        <input class="form-control" type="text" name="title" value="{{ $page->title }}" required />
      </div>
      <div class="form-group" style="margin:0;">
        <label>Section</label>
        <input class="form-control" type="text" name="section" value="{{ $page->section }}" required />
      </div>
      <div class="form-group" style="margin:0;">
        <label>Meta Title</label>
        <input class="form-control" type="text" name="meta_title" value="{{ $page->meta_title ?? '' }}" placeholder="SEO page title" />
      </div>
      <div class="form-group" style="margin:0;">
        <label>Meta Description</label>
        <textarea class="form-control" name="meta_description" style="min-height:50px;" placeholder="SEO description">{{ $page->meta_description ?? '' }}</textarea>
      </div>
      <div class="form-group" style="margin:0;">
        <label>Meta Keywords</label>
        <input class="form-control" type="text" name="meta_keywords" value="{{ $page->meta_keywords ?? '' }}" placeholder="keyword1, keyword2" />
      </div>
      <div class="form-group" style="margin:0;">
        <label>Status</label>
        <select class="form-control" name="status">
          <option value="published" {{ ($page->status ?? 'published') == 'published' ? 'selected' : '' }}>Published</option>
          <option value="draft" {{ ($page->status ?? '') == 'draft' ? 'selected' : '' }}>Draft</option>
        </select>
      </div>
    </div>

    {{-- Fields Table --}}
    <div style="overflow-x:auto;">
      <table class="tsa-table">
        <thead>
          <tr>
            <th style="width:40px;">Id</th>
            <th style="width:160px;">Name</th>
            <th>Text</th>
            <th style="width:160px;">Link</th>
            <th style="width:180px;">Image</th>
            <th style="width:120px;">Type</th>
          </tr>
        </thead>
        <tbody>
          @php $fields = json_decode($page->fields); @endphp
          @foreach($fields as $key => $data)
          <tr>
            <td class="muted">{{ $key }}</td>

            <td>
              <input class="form-control" type="text" name="name[]"
                value="{{ $data->name }}" readonly
                style="background:rgba(255,255,255,0.04);cursor:not-allowed;opacity:0.7;" />
            </td>

            <td>
              @if($data->type == 'text' || $data->type == 'link')
                <textarea class="form-control @if(($page->id == 72 && $key==1)||($page->id == 73 && $key==1)) textEditor @endif"
                  name="text[]" style="min-height:80px;">{{ isset($data->text) ? $data->text : '' }}</textarea>
              @else
                <textarea style="display:none;" class="form-control" name="text[]">{{ isset($data->text) ? $data->text : '' }}</textarea>
                <span class="muted" style="font-size:12px;">—</span>
              @endif
            </td>

            <td>
              @if($data->type == 'link')
                <input class="form-control" type="text" name="link[]"
                  value="{{ isset($data->link) ? $data->link : '' }}" placeholder="https://" />
              @else
                <input style="display:none;" class="form-control" type="text" name="link[]"
                  value="{{ isset($data->link) ? $data->link : '' }}" />
                <span class="muted" style="font-size:12px;">—</span>
              @endif
            </td>

            <td>
              @if($data->type == 'image')
                @if(isset($data->img))
                  @if(str_contains($data->img, '.mp4'))
                    <video style="height:80px;width:120px;object-fit:cover;border-radius:8px;margin-bottom:8px;display:block;" muted autoplay loop>
                      <source src="{{ env('IMG_FETCH_URL').'uploaded_files/'.$data->img }}" type="video/mp4">
                    </video>
                  @elseif(str_contains($data->img, '.mp3'))
                    <audio controls style="margin-bottom:8px;display:block;width:140px;">
                      <source src="{{ env('IMG_FETCH_URL').'uploaded_files/'.$data->img }}" type="audio/mp3">
                    </audio>
                  @else
                    <img src="{{ env('IMG_FETCH_URL').'uploaded_files/'.$data->img }}"
                      style="height:70px;width:100px;object-fit:cover;border-radius:8px;margin-bottom:8px;display:block;" />
                  @endif
                @endif
                <input class="form-control" type="file" name="image[]"
                  style="font-size:12px;padding:6px 10px;" />
              @else
                <input style="display:none;" class="form-control" type="file" name="image[]" />
                <span class="muted" style="font-size:12px;">—</span>
              @endif
            </td>

            <td>
              <select class="form-control" name="type[]">
                <option value="text"  {{ $data->type == 'text'  ? 'selected' : '' }}>Text</option>
                <option value="image" {{ $data->type == 'image' ? 'selected' : '' }}>Image</option>
                <option value="link"  {{ $data->type == 'link'  ? 'selected' : '' }}>Link</option>
              </select>
            </td>
          </tr>
          @endforeach
        </tbody>
      </table>
    </div>

    <div style="margin-top:24px;">
      <button type="submit" class="btn btn-lime" style="padding:12px 32px;font-size:14px;">
        <i class="fas fa-floppy-disk"></i> Save Changes
      </button>
    </div>

  </form>
</div>

@endsection

@section('scripts')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<script>
  $(document).ready(function() {
    if (typeof RichTextEditor !== 'undefined') {
      var editor1 = new RichTextEditor(".textEditor");
    }
  });
</script>
@endsection