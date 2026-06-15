@extends('admin.layout.app')
@section('page-title', 'Create New Blog Post')

@section('content')

<div style="margin-bottom:20px;">
  <a href="{{ route('admin.blog.index') }}" class="btn btn-ghost">
    <i class="fas fa-arrow-left"></i> Back to Blog Posts
  </a>
</div>

<div class="tsa-card" style="max-width:1000px;">
  <div class="tsa-card-title">
    <span><i class="fas fa-plus" style="color:var(--lime);margin-right:8px;"></i>Create New Blog Post</span>
  </div>

  <form action="{{ route('admin.blog.store') }}" method="POST" enctype="multipart/form-data" id="blogForm">
    @csrf

    {{-- Basic Info --}}
    <div style="background:var(--hover);border-radius:12px;padding:20px;margin-bottom:20px;">
      <div style="font-size:13px;font-weight:600;color:var(--lime);margin-bottom:16px;border-bottom:1px solid var(--border);padding-bottom:8px;">
        <i class="fas fa-info-circle" style="margin-right:8px;"></i>Basic Information
      </div>
      <div style="display:grid;grid-template-columns:1fr 1fr;gap:16px;">
        <div class="form-group">
          <label>Title *</label>
          <input class="form-control" type="text" id="title" name="title" value="{{ old('title') }}" placeholder="Blog post title" required />
        </div>
        <div class="form-group">
          <label>Heading Tag</label>
          <select class="form-control" name="title_tag">
            @foreach(['h1','h2','h3','h4','h5','h6'] as $tag)
              <option value="{{ $tag }}" {{ old('title_tag', 'h1') == $tag ? 'selected' : '' }}>{{ strtoupper($tag) }}</option>
            @endforeach
          </select>
        </div>
        <div class="form-group">
          <label>URL Slug <span style="color:var(--muted);font-weight:400;">(leave blank to auto-generate)</span></label>
          <input class="form-control" type="text" id="slug" name="slug" value="{{ old('slug') }}" placeholder="my-blog-post-title" />
          <small style="font-size:11px;color:var(--muted);display:block;margin-top:4px;">yoursite.com/blog/<strong style="color:var(--teal);">this-value</strong></small>
        </div>
        <div class="form-group">
          <label>Author</label>
          <select class="form-control" name="author_id">
            <option value="">Select author</option>
            @foreach($authors as $author)
              <option value="{{ $author->id }}" {{ old('author_id') == $author->id ? 'selected' : '' }}>{{ $author->name }}</option>
            @endforeach
          </select>
        </div>
      </div>
      <div style="display:grid;grid-template-columns:1fr 1fr;gap:16px;margin-top:16px;">
        <div class="form-group">
          <label>Category</label>
          <select class="form-control" name="category_id">
            <option value="">Select category</option>
            @foreach($categories as $cat)
              <option value="{{ $cat->id }}" {{ old('category_id') == $cat->id ? 'selected' : '' }}>{{ $cat->name }}</option>
            @endforeach
          </select>
        </div>
        <div class="form-group">
          <label>Blog Date</label>
          <input class="form-control" type="date" name="blog_date" value="{{ old('blog_date', now()->toDateString()) }}" />
        </div>
      </div>
    </div>

    {{-- Cover Image --}}
    <div style="background:var(--hover);border-radius:12px;padding:20px;margin-bottom:20px;">
      <div style="font-size:13px;font-weight:600;color:var(--lime);margin-bottom:16px;border-bottom:1px solid var(--border);padding-bottom:8px;">
        <i class="fas fa-image" style="margin-right:8px;"></i>Cover Image
      </div>
      <input class="form-control" type="file" name="cover_image" accept="image/*" id="cover_image" style="padding:8px 12px;font-size:13px;" />
      <div style="font-size:11px;color:var(--muted);margin-top:6px;">Recommended: 800x450px, JPG/PNG/WEBP, max 2MB</div>
      <div id="imagePreview" style="margin-top:12px;display:none;">
        <img id="previewImg" src="#" alt="Preview" style="max-height:180px;border-radius:8px;" />
      </div>
    </div>

    {{-- Short Description --}}
    <div style="background:var(--hover);border-radius:12px;padding:20px;margin-bottom:20px;">
      <div style="font-size:13px;font-weight:600;color:var(--lime);margin-bottom:16px;border-bottom:1px solid var(--border);padding-bottom:8px;">
        <i class="fas fa-align-left" style="margin-right:8px;"></i>Short Description <span style="color:var(--muted);font-weight:400;">(shown on listing page, ~160 chars)</span>
      </div>
      <textarea class="form-control" id="description" name="description" rows="3" placeholder="Brief description...">{{ old('description') }}</textarea>
      <div style="font-size:11px;color:var(--muted);margin-top:4px;text-align:right;" id="descCounter">0 / 160</div>
    </div>

    {{-- Main Content — Quill WYSIWYG --}}
    <div style="background:var(--hover);border-radius:12px;padding:20px;margin-bottom:20px;">
      <div style="font-size:13px;font-weight:600;color:var(--lime);margin-bottom:16px;border-bottom:1px solid var(--border);padding-bottom:8px;">
        <i class="fas fa-pen-nib" style="margin-right:8px;"></i>Main Content
      </div>
      {{-- Hidden textarea for form submit --}}
      <textarea name="content" id="content" style="display:none;">{{ old('content') }}</textarea>
      {{-- Quill editor container --}}
      <div id="quill-editor" style="min-height:350px;background:#fff;border-radius:0 0 8px 8px;"></div>
    </div>

    {{-- SEO --}}
    <div style="background:var(--hover);border-radius:12px;padding:20px;margin-bottom:20px;">
      <div style="font-size:13px;font-weight:600;color:var(--lime);margin-bottom:16px;border-bottom:1px solid var(--border);padding-bottom:8px;">
        <i class="fas fa-search" style="margin-right:8px;"></i>SEO Settings
      </div>
      <div class="form-group">
        <label>SEO Title <span style="color:var(--muted);font-weight:400;">(leave blank to use post title)</span></label>
        <input class="form-control" type="text" id="seo_title" name="seo_title" value="{{ old('seo_title') }}" />
      </div>
      <div class="form-group" style="margin-top:12px;">
        <label>SEO Meta Description <span style="color:var(--muted);font-weight:400;">(~160 chars)</span></label>
        <textarea class="form-control" id="seo_description" name="seo_description" rows="2">{{ old('seo_description') }}</textarea>
        <div style="font-size:11px;color:var(--muted);margin-top:4px;text-align:right;" id="seoCounter">0 / 160</div>
      </div>
      <div class="form-group" style="margin-top:12px;">
        <label>Custom Meta Tags (raw HTML for &lt;head&gt;)</label>
        <textarea class="form-control" name="custom_meta_tags" style="min-height:120px;font-family:monospace;font-size:13px;line-height:1.6;margin-top:6px;" placeholder="&lt;link rel=&quot;canonical&quot; href=&quot;https://...&quot;&gt;&#10;&lt;meta property=&quot;og:title&quot; content=&quot;...&quot;&gt;&#10;&lt;script type=&quot;application/ld+json&quot;&gt;{...}&lt;/script&gt;">{{ old('custom_meta_tags') }}</textarea>
        <div style="font-size:11px;color:var(--muted);margin-top:4px;">
          Paste raw &lt;meta&gt;, &lt;link&gt;, &lt;script&gt; tags — output verbatim inside &lt;head&gt;.
        </div>
      </div>
      <div class="form-group" style="margin-top:12px;">
        <label>Head Script <span style="color:var(--muted);font-weight:400;">(inside &lt;head&gt;)</span></label>
        <textarea class="form-control" name="head_script" style="min-height:80px;font-family:monospace;font-size:13px;line-height:1.6;margin-top:6px;" placeholder="&lt;script&gt;console.log('blog-specific head');&lt;/script&gt;">{{ old('head_script') }}</textarea>
      </div>
      <div class="form-group" style="margin-top:12px;">
        <label>Body Script <span style="color:var(--muted);font-weight:400;">(after &lt;body&gt;)</span></label>
        <textarea class="form-control" name="body_script" style="min-height:80px;font-family:monospace;font-size:13px;line-height:1.6;margin-top:6px;" placeholder="&lt;noscript&gt;&lt;iframe src=&quot;...&quot;&gt;&lt;/iframe&gt;&lt;/noscript&gt;">{{ old('body_script') }}</textarea>
      </div>
    </div>

    {{-- Settings --}}
    <div style="background:var(--hover);border-radius:12px;padding:20px;margin-bottom:24px;">
      <div style="font-size:13px;font-weight:600;color:var(--lime);margin-bottom:16px;border-bottom:1px solid var(--border);padding-bottom:8px;">
        <i class="fas fa-cog" style="margin-right:8px;"></i>Settings
      </div>
      <div style="display:flex;align-items:center;gap:32px;flex-wrap:wrap;">
        <label style="display:flex;align-items:center;gap:8px;cursor:pointer;font-size:14px;color:var(--text);">
          <input type="checkbox" name="enable_comments" value="1" {{ old('enable_comments', 1) ? 'checked' : '' }} style="width:16px;height:16px;accent-color:var(--lime);cursor:pointer;" />
          Enable Comments
        </label>
        <label style="display:flex;align-items:center;gap:8px;cursor:pointer;font-size:14px;color:var(--text);">
          <input type="checkbox" name="is_published" value="1" {{ old('is_published', 1) ? 'checked' : '' }} style="width:16px;height:16px;accent-color:var(--lime);cursor:pointer;" />
          Publish Immediately
        </label>
      </div>
    </div>

    {{-- FAQs --}}
    <div style="background:var(--hover);border-radius:12px;padding:20px;margin-bottom:24px;">
      <div style="font-size:13px;font-weight:600;color:var(--lime);margin-bottom:16px;border-bottom:1px solid var(--border);padding-bottom:8px;display:flex;align-items:center;justify-content:space-between;">
        <span><i class="fas fa-question-circle" style="margin-right:8px;"></i>FAQs</span>
        <button type="button" id="add-faq" class="btn btn-teal" style="padding:6px 14px;font-size:12px;">
          <i class="fas fa-plus"></i> Add FAQ
        </button>
      </div>
      <div id="faq-container">
        <div id="faq-empty" style="text-align:center;padding:24px;color:var(--muted);font-size:13px;">
          <i class="fas fa-plus-circle" style="font-size:20px;display:block;margin-bottom:6px;opacity:0.4;"></i>
          No FAQs added yet. Click "Add FAQ" to add question/answer pairs.
        </div>
      </div>
    </div>

    <div style="display:flex;gap:12px;justify-content:flex-end;">
      <button type="button" id="saveDraft" class="btn btn-ghost" style="padding:12px 24px;">
        <i class="fas fa-save"></i> Save as Draft
      </button>
      <button type="submit" class="btn btn-lime" style="padding:12px 32px;font-size:14px;">
        <i class="fas fa-paper-plane"></i> Publish Post
      </button>
    </div>

  </form>
</div>

@endsection

@section('scripts')
{{-- Quill WYSIWYG Editor --}}
<link href="https://cdn.jsdelivr.net/npm/quill@2.0.2/dist/quill.snow.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/quill@2.0.2/dist/quill.js"></script>

<style>
  #quill-editor { color: #0d0b1a; font-size: 14px; line-height: 1.7; }
  .ql-toolbar.ql-snow { background: var(--card); border-color: var(--border) !important; border-radius: 8px 8px 0 0; }
  .ql-container.ql-snow { border-color: var(--border) !important; border-radius: 0 0 8px 8px; }
  .ql-toolbar .ql-stroke { stroke: var(--muted) !important; }
  .ql-toolbar .ql-fill { fill: var(--muted) !important; }
  .ql-toolbar button:hover .ql-stroke { stroke: var(--lime) !important; }
  .ql-toolbar button:hover .ql-fill { fill: var(--lime) !important; }
  .ql-toolbar .ql-active .ql-stroke { stroke: var(--lime) !important; }
  .ql-toolbar .ql-picker-label { color: var(--muted) !important; }
  small.form-text { font-size: 11px; color: var(--muted); display: block; margin-top: 4px; }
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {

  // ── Quill WYSIWYG ──
  const quill = new Quill('#quill-editor', {
    theme: 'snow',
    placeholder: 'Write your blog content here...',
    modules: {
      toolbar: [
        [{ header: [1, 2, 3, false] }],
        ['bold', 'italic', 'underline', 'strike'],
        [{ color: [] }, { background: [] }],
        [{ list: 'ordered' }, { list: 'bullet' }],
        [{ align: [] }],
        ['blockquote', 'code-block'],
        ['link', 'image'],
        ['clean']
      ]
    }
  });

  // Load existing content
  const contentTextarea = document.getElementById('content');
  if (contentTextarea.value) {
    quill.root.innerHTML = contentTextarea.value;
  }

  // Sync Quill content to hidden textarea on form submit
  document.getElementById('blogForm').addEventListener('submit', function() {
    contentTextarea.value = quill.root.innerHTML;
  });

  // ── Description counter ──
  const desc = document.getElementById('description');
  const descCounter = document.getElementById('descCounter');
  function updateDescCounter() {
    const len = desc.value.length;
    descCounter.textContent = len + ' / 160';
    descCounter.style.color = len > 160 ? 'var(--danger)' : 'var(--muted)';
  }
  desc.addEventListener('input', updateDescCounter);
  updateDescCounter();

  // ── SEO counter ──
  const seoDesc = document.getElementById('seo_description');
  const seoCounter = document.getElementById('seoCounter');
  seoDesc.addEventListener('input', function() {
    const len = seoDesc.value.length;
    seoCounter.textContent = len + ' / 160';
    seoCounter.style.color = len > 160 ? 'var(--danger)' : 'var(--muted)';
  });

  // ── Auto SEO title from blog title ──
  document.getElementById('title').addEventListener('input', function() {
    const seoTitle = document.getElementById('seo_title');
    if (!seoTitle.value) seoTitle.value = this.value;
  });

  // ── Image preview ──
  document.getElementById('cover_image').addEventListener('change', function(e) {
    const file = e.target.files[0];
    if (file) {
      const reader = new FileReader();
      reader.onload = function(e) {
        document.getElementById('previewImg').src = e.target.result;
        document.getElementById('imagePreview').style.display = 'block';
      };
      reader.readAsDataURL(file);
    }
  });

  // ── Save as Draft ──
  document.getElementById('saveDraft').addEventListener('click', function() {
    document.querySelector('input[name="is_published"]').checked = false;
    contentTextarea.value = quill.root.innerHTML;
    document.getElementById('blogForm').submit();
  });

  // ── FAQs - Add / Remove ──
  const faqContainer = document.getElementById('faq-container');
  const faqEmpty = document.getElementById('faq-empty');
  let faqIndex = 0;

  function updateFaqEmpty() {
    const rows = faqContainer.querySelectorAll('.faq-row');
    if (faqEmpty) faqEmpty.style.display = rows.length === 0 ? '' : 'none';
  }

  function addFaqRow(question = '', answer = '') {
    const idx = faqIndex++;
    const div = document.createElement('div');
    div.className = 'faq-row';
    div.dataset.index = idx;
    div.style.cssText = 'background:var(--card);border:1px solid var(--border);border-radius:8px;padding:16px;margin-bottom:12px;';
    div.innerHTML =
      '<div style="display:flex;gap:12px;margin-bottom:10px;align-items:center;">' +
        '<span style="font-size:12px;font-weight:600;color:var(--teal);">FAQ #' + (idx + 1) + '</span>' +
        '<button type="button" class="btn btn-red faq-remove" style="padding:4px 10px;font-size:11px;margin-left:auto;">' +
          '<i class="fas fa-trash"></i> Remove' +
        '</button>' +
      '</div>' +
      '<div style="display:grid;grid-template-columns:1fr;gap:10px;">' +
        '<div class="form-group" style="margin:0;">' +
          '<label style="font-size:12px;">Question</label>' +
          '<input class="form-control" type="text" name="faq_question[]" value="' + question.replace(/"/g, '&quot;') + '" placeholder="e.g. What services do you offer?" style="font-size:13px;" />' +
        '</div>' +
        '<div class="form-group" style="margin:0;">' +
          '<label style="font-size:12px;">Answer</label>' +
          '<textarea class="form-control" name="faq_answer[]" rows="2" placeholder="Write the answer..." style="font-size:13px;">' + answer + '</textarea>' +
        '</div>' +
      '</div>';
    if (faqEmpty) faqEmpty.style.display = 'none';
    faqContainer.appendChild(div);
  }

  document.getElementById('add-faq').addEventListener('click', function() {
    addFaqRow();
  });

  document.addEventListener('click', function(e) {
    if (e.target.closest('.faq-remove')) {
      const row = e.target.closest('.faq-row');
      if (row) {
        row.remove();
        updateFaqEmpty();
      }
    }
  });

  updateFaqEmpty();
});