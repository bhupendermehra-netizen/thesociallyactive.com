@extends("layouts.front_app")

@section("content")

<link rel="stylesheet" href="{{ asset('assets/css/portfolio.css') }}">
<style>
  .single-blog { background: #000; min-height: 100vh; }

  /* Hero */
  .single-hero {
    padding: 7rem 2rem 3rem;
    max-width: 860px;
    margin: 0 auto;
    text-align: center;
  }
  .single-cat {
    display: inline-block;
    background: #dff811;
    color: #000;
    font-size: 11px;
    font-weight: 700;
    padding: 5px 14px;
    border-radius: 20px;
    text-transform: uppercase;
    letter-spacing: 0.08em;
    margin-bottom: 20px;
    font-family: 'Space Grotesk', sans-serif;
  }
  .single-title {
    font-family: 'Space Grotesk', sans-serif;
    font-size: clamp(1.8rem, 4vw, 3rem);
    font-weight: 700;
    color: #ffffff;
    line-height: 1.2;
    letter-spacing: -0.025em;
    margin-bottom: 20px;
  }
  .single-meta {
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 20px;
    font-size: 12px;
    color: rgba(255,255,255,0.35);
    font-family: 'Space Grotesk', sans-serif;
    text-transform: uppercase;
    letter-spacing: 0.08em;
    margin-bottom: 36px;
  }
  .single-meta-dot { width: 3px; height: 3px; border-radius: 50%; background: rgba(255,255,255,0.2); }

  /* Cover image */
  .single-cover {
    max-width: 900px;
    margin: 0 auto 60px;
    padding: 0 2rem;
  }
  .single-cover img {
    width: 100%;
    border-radius: 16px;
    display: block;
    max-height: 480px;
    object-fit: cover;
  }

  /* Content */
  .single-content {
    max-width: 720px;
    margin: 0 auto;
    padding: 0 2rem 80px;
    color: rgba(255,255,255,0.8);
    font-size: 1.05rem;
    line-height: 1.85;
    font-family: 'Space Grotesk', sans-serif;
  }
  .single-content h2 {
    font-size: 1.6rem; font-weight: 700;
    color: #fff; margin: 2.5rem 0 1rem;
    letter-spacing: -0.02em;
  }
  .single-content h3 {
    font-size: 1.3rem; font-weight: 600;
    color: #fff; margin: 2rem 0 0.75rem;
  }
  .single-content p { margin-bottom: 1.4rem; }
  .single-content ul, .single-content ol {
    padding-left: 1.5rem; margin-bottom: 1.4rem;
  }
  .single-content li { margin-bottom: 0.5rem; }
  .single-content strong { color: #fff; font-weight: 600; }
  .single-content a { color: #dff811; text-decoration: underline; }
  .single-content blockquote {
    border-left: 3px solid #dff811;
    padding: 16px 20px;
    margin: 2rem 0;
    background: rgba(223,248,17,0.05);
    border-radius: 0 8px 8px 0;
    color: rgba(255,255,255,0.7);
    font-style: italic;
  }
  .single-content img {
    width: 100%; border-radius: 12px; margin: 1.5rem 0;
  }

  /* Divider */
  .single-divider {
    max-width: 720px;
    margin: 0 auto 60px;
    padding: 0 2rem;
    border: none;
    border-top: 1px solid rgba(255,255,255,0.08);
  }

  /* Related */
  .related-section {
    max-width: 1100px;
    margin: 0 auto;
    padding: 0 2rem 80px;
  }
  .related-title {
    font-family: 'Space Grotesk', sans-serif;
    font-size: 1.5rem; font-weight: 700;
    color: #fff; margin-bottom: 28px;
    letter-spacing: -0.02em;
  }
  .related-grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
    gap: 20px;
  }
  .related-card {
    background: rgba(255,255,255,0.03);
    border: 1px solid rgba(255,255,255,0.08);
    border-radius: 12px;
    overflow: hidden;
    text-decoration: none;
    transition: all 0.3s ease;
    display: block;
  }
  .related-card:hover {
    border-color: rgba(223,248,17,0.2);
    transform: translateY(-4px);
  }
  .related-card img {
    width: 100%; height: 160px;
    object-fit: cover; display: block;
  }
  .related-card-body { padding: 16px; }
  .related-card-title {
    font-family: 'Space Grotesk', sans-serif;
    font-size: 15px; font-weight: 600;
    color: #fff; line-height: 1.35;
    transition: color 0.2s;
  }
  .related-card:hover .related-card-title { color: #dff811; }

  /* Back button */
  .back-wrap {
    max-width: 720px;
    margin: 0 auto 32px;
    padding: 0 2rem;
  }

  @media (max-width: 768px) {
    .single-hero { padding: 6rem 1.5rem 2rem; }
    .single-cover, .single-content, .related-section, .back-wrap { padding-left: 1.5rem; padding-right: 1.5rem; }
  }
</style>

<div class="single-blog">

  {{-- Back --}}
  <div class="back-wrap" style="padding-top:7rem;">
    <a href="{{ route('blog') }}" style="font-size:13px;color:rgba(255,255,255,0.4);text-decoration:none;font-family:'Space Grotesk',sans-serif;text-transform:uppercase;letter-spacing:0.08em;transition:color 0.2s;"
      onmouseover="this.style.color='#dff811'" onmouseout="this.style.color='rgba(255,255,255,0.4)'">
      ← Back to Blog
    </a>
  </div>

  {{-- Hero --}}
  <div class="single-hero">
    @if($blog->category)
      <span class="single-cat">{{ $blog->category->name }}</span>
    @endif
    <{{ $blog->title_tag ?? 'h1' }} class="single-title">{{ $blog->title }}</{{ $blog->title_tag ?? 'h1' }}>
    <div class="single-meta">
      <span>TheSociallyActive</span>
      <span class="single-meta-dot"></span>
      <span>{{ $blog->created_at->format('d M Y') }}</span>
      @if($blog->category)
      <span class="single-meta-dot"></span>
      <span>{{ $blog->category->name }}</span>
      @endif
    </div>
  </div>

  {{-- Cover Image --}}
  @if($blog->cover_image)
  <div class="single-cover">
    @if(Str::startsWith($blog->cover_image, 'http'))
      <img src="{{ $blog->cover_image }}" alt="{{ $blog->title }}">
    @else
      <img src="{{ asset($blog->cover_image) }}" alt="{{ $blog->title }}">
    @endif
  </div>
  @endif

  {{-- Content --}}
  <div class="single-content">
    {!! $blog->content !!}
  </div>

  <hr class="single-divider">

  {{-- Author Box --}}
  @if($blog->author)
  <div style="max-width:720px;margin:0 auto 48px;padding:0 2rem;">
    <div style="display:flex;gap:24px;align-items:flex-start;background:rgba(255,255,255,0.03);border:1px solid rgba(255,255,255,0.08);border-radius:16px;padding:32px;">
      {{-- Avatar --}}
      <div style="flex-shrink:0;">
        @if($blog->author->profile_image)
          <img src="{{ asset('uploaded_files/image/' . $blog->author->profile_image) }}"
               alt="{{ $blog->author->name }}"
               style="width:72px;height:72px;border-radius:50%;object-fit:cover;border:2px solid rgba(255,255,255,0.1);">
        @else
          <div style="width:72px;height:72px;border-radius:50%;background:rgba(255,255,255,0.06);display:flex;align-items:center;justify-content:center;font-size:24px;color:rgba(255,255,255,0.3);">
            <i class="fas fa-user"></i>
          </div>
        @endif
      </div>
      {{-- Info --}}
      <div style="flex:1;min-width:0;">
        <div style="font-family:'Space Grotesk',sans-serif;font-size:11px;font-weight:600;text-transform:uppercase;letter-spacing:0.08em;color:rgba(255,255,255,0.4);margin-bottom:4px;">About the Author</div>
        <div style="font-family:'Space Grotesk',sans-serif;font-size:18px;font-weight:600;color:#fff;margin-bottom:8px;">{{ $blog->author->name }}</div>
        @if($blog->author->bio)
          <div style="font-size:14px;line-height:1.7;color:rgba(255,255,255,0.65);margin-bottom:16px;">{{ $blog->author->bio }}</div>
        @endif
        @php $hasSocial = $blog->author->facebook || $blog->author->instagram || $blog->author->linkedin || $blog->author->twitter; @endphp
        @if($hasSocial)
          <div style="display:flex;gap:10px;">
            @if($blog->author->facebook)
              <a href="{{ $blog->author->facebook }}" target="_blank" rel="noopener"
                 title="Facebook" style="width:32px;height:32px;border-radius:50%;display:flex;align-items:center;justify-content:center;border:1px solid rgba(255,255,255,0.12);color:rgba(255,255,255,0.6);font-size:14px;transition:all 0.2s;text-decoration:none;"
                 onmouseover="this.style.borderColor='#1877F2';this.style.color='#1877F2';this.style.background='rgba(24,119,242,0.1)'"
                 onmouseout="this.style.borderColor='rgba(255,255,255,0.12)';this.style.color='rgba(255,255,255,0.6)';this.style.background='transparent'">
                <i class="fab fa-facebook-f"></i>
              </a>
            @endif
            @if($blog->author->instagram)
              <a href="{{ $blog->author->instagram }}" target="_blank" rel="noopener"
                 title="Instagram" style="width:32px;height:32px;border-radius:50%;display:flex;align-items:center;justify-content:center;border:1px solid rgba(255,255,255,0.12);color:rgba(255,255,255,0.6);font-size:14px;transition:all 0.2s;text-decoration:none;"
                 onmouseover="this.style.borderColor='#E4405F';this.style.color='#E4405F';this.style.background='rgba(228,64,95,0.1)'"
                 onmouseout="this.style.borderColor='rgba(255,255,255,0.12)';this.style.color='rgba(255,255,255,0.6)';this.style.background='transparent'">
                <i class="fab fa-instagram"></i>
              </a>
            @endif
            @if($blog->author->linkedin)
              <a href="{{ $blog->author->linkedin }}" target="_blank" rel="noopener"
                 title="LinkedIn" style="width:32px;height:32px;border-radius:50%;display:flex;align-items:center;justify-content:center;border:1px solid rgba(255,255,255,0.12);color:rgba(255,255,255,0.6);font-size:14px;transition:all 0.2s;text-decoration:none;"
                 onmouseover="this.style.borderColor='#0A66C2';this.style.color='#0A66C2';this.style.background='rgba(10,102,194,0.1)'"
                 onmouseout="this.style.borderColor='rgba(255,255,255,0.12)';this.style.color='rgba(255,255,255,0.6)';this.style.background='transparent'">
                <i class="fab fa-linkedin-in"></i>
              </a>
            @endif
            @if($blog->author->twitter)
              <a href="{{ $blog->author->twitter }}" target="_blank" rel="noopener"
                 title="X / Twitter" style="width:32px;height:32px;border-radius:50%;display:flex;align-items:center;justify-content:center;border:1px solid rgba(255,255,255,0.12);color:rgba(255,255,255,0.6);font-size:14px;transition:all 0.2s;text-decoration:none;"
                 onmouseover="this.style.borderColor='#1DA1F2';this.style.color='#1DA1F2';this.style.background='rgba(29,161,242,0.1)'"
                 onmouseout="this.style.borderColor='rgba(255,255,255,0.12)';this.style.color='rgba(255,255,255,0.6)';this.style.background='transparent'">
                <i class="fab fa-x-twitter"></i>
              </a>
            @endif
          </div>
        @endif
      </div>
    </div>
  </div>
  @endif

  {{-- FAQs --}}
  @if($blog->faqs->count() > 0)
  <div style="max-width:720px;margin:0 auto 48px;padding:0 2rem;">
    <h2 style="font-size:28px;font-weight:700;color:#fff;margin-bottom:24px;text-align:center;">Frequently Asked Questions</h2>
    <div class="accordion" id="faqAccordion">
      @foreach($blog->faqs->sortBy('sort_order') as $index => $faq)
      <div class="accordion-item" style="background:rgba(255,255,255,0.03);border:1px solid rgba(255,255,255,0.08);border-radius:12px;margin-bottom:8px;overflow:hidden;">
        <h3 class="accordion-header" id="faq-heading-{{ $index }}">
          <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq-collapse-{{ $index }}"
            style="background:transparent;color:#fff;font-size:16px;font-weight:600;padding:16px 20px;box-shadow:none;"
            aria-expanded="false" aria-controls="faq-collapse-{{ $index }}">
            {{ $faq->question }}
          </button>
        </h3>
        <div id="faq-collapse-{{ $index }}" class="accordion-collapse collapse" aria-labelledby="faq-heading-{{ $index }}"
          data-bs-parent="#faqAccordion">
          <div class="accordion-body" style="padding:0 20px 16px;color:rgba(255,255,255,0.8);font-size:15px;line-height:1.7;">
            {{ $faq->answer }}
          </div>
        </div>
      </div>
      @endforeach
    </div>
  </div>

  {{-- JSON-LD FAQPage Schema --}}
  <script type="application/ld+json">
  {
    "@@context": "https://schema.org",
    "@@type": "FAQPage",
    "mainEntity": [
      @foreach($blog->faqs->sortBy('sort_order') as $i => $faq)
      {
        "@@type": "Question",
        "name": {{ json_encode($faq->question) }},
        "acceptedAnswer": {
          "@@type": "Answer",
          "text": {{ json_encode($faq->answer) }}
        }
      }@if(!$loop->last),@endif
      @endforeach
    ]
  }
  </script>
  @endif

  {{-- Related Posts --}}
  @if($related->count() > 0)
  <div class="related-section">
    <h2 class="related-title">Related Articles</h2>
    <div class="related-grid">
      @foreach($related as $post)
      <a href="{{ route('blog.show', $post->slug) }}" class="related-card">
        @if($post->cover_image)
          @if(Str::startsWith($post->cover_image, 'http'))
            <img src="{{ $post->cover_image }}" alt="{{ $post->title }}" loading="lazy">
          @else
            <img src="{{ asset($post->cover_image) }}" alt="{{ $post->title }}" loading="lazy">
          @endif
        @else
          <div style="width:100%;height:160px;background:rgba(255,255,255,0.04);display:flex;align-items:center;justify-content:center;">
            <i class="fas fa-newspaper" style="font-size:24px;color:rgba(255,255,255,0.1);"></i>
          </div>
        @endif
        <div class="related-card-body">
          <div class="related-card-title">{{ Str::limit($post->title, 60) }}</div>
          <div style="font-size:11px;color:rgba(255,255,255,0.3);margin-top:6px;font-family:'Space Grotesk',sans-serif;">
            {{ $post->created_at->format('d M Y') }}
          </div>
        </div>
      </a>
      @endforeach
    </div>
  </div>
  @endif

</div>

<script src="{{ asset('assets/js/splash-cursor.js') }}"></script>

@endsection