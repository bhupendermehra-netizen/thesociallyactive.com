@extends('admin.layout.app')
@section('page-title', 'FAQs - ' . $pageName)

@section('content')

<div style="margin-bottom:20px;">
  <a href="{{ route('admin.page') }}" class="btn btn-ghost">
    <i class="fas fa-arrow-left"></i> Back to Pages
  </a>
  <span style="margin-left:12px;font-size:16px;font-weight:600;color:var(--text);">{{ $pageName }}</span>
</div>

<div class="tsa-card">
  <div class="tsa-card-title">
    <span><i class="fas fa-question-circle" style="color:var(--lime);margin-right:8px;"></i>FAQs for {{ $pageName }}</span>
  </div>

  <form action="{{ route('admin.page.faqs.save', $pageSlug) }}" method="POST">
    @csrf

    <div style="margin-bottom:24px;">
      <div style="display:flex;align-items:center;justify-content:space-between;margin-bottom:16px;">
        <div style="font-size:14px;font-weight:600;color:var(--text);">
          <i class="fas fa-list" style="color:var(--teal);margin-right:8px;"></i>Questions &amp; Answers
        </div>
        <button type="button" id="add-faq" class="btn btn-teal" style="padding:6px 14px;font-size:12px;">
          <i class="fas fa-plus"></i> Add FAQ
        </button>
      </div>

      <div id="faq-container">
        @php $faqIdx = 0; @endphp
        @forelse($faqs as $faq)
        <div class="faq-row" data-index="{{ $faqIdx }}" style="background:var(--card);border:1px solid var(--border);border-radius:8px;padding:16px;margin-bottom:12px;">
          <div style="display:flex;gap:12px;margin-bottom:10px;align-items:center;">
            <span style="font-size:12px;font-weight:600;color:var(--teal);">FAQ #{{ $faqIdx + 1 }}</span>
            <button type="button" class="btn btn-red faq-remove" style="padding:4px 10px;font-size:11px;margin-left:auto;">
              <i class="fas fa-trash"></i> Remove
            </button>
          </div>
          <div style="display:grid;grid-template-columns:1fr 1fr;gap:12px;">
            <div class="form-group" style="margin:0;">
              <label style="font-size:12px;">Question</label>
              <input class="form-control" type="text" name="faq_question[]" value="{{ $faq->question }}" placeholder="e.g. What services do you offer?" style="font-size:13px;" />
            </div>
            <div class="form-group" style="margin:0;">
              <label style="font-size:12px;">Answer</label>
              <textarea class="form-control" name="faq_answer[]" rows="2" placeholder="Write the answer..." style="font-size:13px;">{{ $faq->answer }}</textarea>
            </div>
          </div>
        </div>
        @php $faqIdx++; @endphp
        @empty
        <div id="faq-empty" style="text-align:center;padding:32px;color:var(--muted);font-size:13px;">
          <i class="fas fa-plus-circle" style="font-size:24px;display:block;margin-bottom:8px;opacity:0.4;"></i>
          No FAQs added for this page yet. Click "Add FAQ" to add question/answer pairs.
        </div>
        @endforelse
      </div>
    </div>

    <button type="submit" class="btn btn-lime" style="padding:12px 32px;font-size:14px;">
      <i class="fas fa-floppy-disk"></i> Save FAQs
    </button>

  </form>
</div>

@endsection

@section('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
  const faqContainer = document.getElementById('faq-container');
  const faqEmpty = document.getElementById('faq-empty');
  let faqIndex = document.querySelectorAll('.faq-row').length;

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
      '<div style="display:grid;grid-template-columns:1fr 1fr;gap:12px;">' +
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
</script>
@endsection
