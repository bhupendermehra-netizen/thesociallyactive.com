	@extends("layouts.front_app")
@section("content")
<div class="extra_page_section">
	
<div class="container">
	<{{ $pages['content'][0]->heading_tag ?? 'h1' }} class="heading">{{$pages['content'][0]->text}}</{{ $pages['content'][0]->heading_tag ?? 'h1' }}>
	<div style="color:white">
	{!!$pages['content'][1]->text!!}
	</div>
|</div>
|	
|		
|</div>
|
|{{-- FAQs --}}
|@if(isset($faqs) && $faqs->count() > 0)
|<div style="max-width:720px;margin:0 auto 48px;padding:0 2rem;">
|  <h2 style="font-size:28px;font-weight:700;color:#fff;margin-bottom:24px;text-align:center;">Frequently Asked Questions</h2>
|  <div class="accordion" id="faqAccordion">
|    @foreach($faqs->sortBy('sort_order') as $index => $faq)
|    <div class="accordion-item" style="background:rgba(255,255,255,0.03);border:1px solid rgba(255,255,255,0.08);border-radius:12px;margin-bottom:8px;overflow:hidden;">
|      <h3 class="accordion-header" id="faq-heading-{{ $index }}">
|        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq-collapse-{{ $index }}"
|          style="background:transparent;color:#fff;font-size:16px;font-weight:600;padding:16px 20px;box-shadow:none;"
|          aria-expanded="false" aria-controls="faq-collapse-{{ $index }}">
|          {{ $faq->question }}
|        </button>
|      </h3>
|      <div id="faq-collapse-{{ $index }}" class="accordion-collapse collapse" aria-labelledby="faq-heading-{{ $index }}"
|        data-bs-parent="#faqAccordion">
|        <div class="accordion-body" style="padding:0 20px 16px;color:rgba(255,255,255,0.8);font-size:15px;line-height:1.7;">
|          {{ $faq->answer }}
|        </div>
|      </div>
|    </div>
|    @endforeach
|  </div>
|</div>
|
|{{-- JSON-LD FAQPage Schema --}}
|<script type="application/ld+json">
|{
|  "@@context": "https://schema.org",
|  "@@type": "FAQPage",
|  "mainEntity": [
|    @foreach($faqs->sortBy('sort_order') as $i => $faq)
|    {
|      "@@type": "Question",
|      "name": {{ json_encode($faq->question) }},
|      "acceptedAnswer": {
|        "@@type": "Answer",
|        "text": {{ json_encode($faq->answer) }}
|      }
|    }@if(!$loop->last),@endif
|    @endforeach
|  ]
|}
|</script>
|@endif
|
|@endsection