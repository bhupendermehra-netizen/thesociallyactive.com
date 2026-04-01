@extends("layouts.front_app")

@section("content")

<link rel="stylesheet" href="{{ asset('assets/css/portfolio.css') }}">
<style>
  .blog-page { background: #000; min-height: 100vh; }

  /* Hero */
  .blog-hero {
    padding: 8rem 2rem 4rem;
    text-align: center;
    position: relative;
    overflow: hidden;
  }
  .blog-hero::before {
    content: '';
    position: absolute;
    inset: 0;
    background: radial-gradient(ellipse at center top, rgba(223,248,17,0.06) 0%, transparent 60%);
    pointer-events: none;
  }
  .blog-hero h1 {
    font-family: 'Space Grotesk', sans-serif;
    font-size: clamp(3.5rem, 10vw, 8rem);
    font-weight: 700;
    letter-spacing: -0.04em;
    color: #ffffff;
    line-height: 1;
    margin-bottom: 1.5rem;
  }
  .blog-hero p {
    font-size: 1.1rem;
    color: rgba(255,255,255,0.45);
    max-width: 500px;
    margin: 0 auto 2.5rem;
    line-height: 1.6;
  }

  /* Search bar */
  .blog-search {
    display: flex;
    max-width: 500px;
    margin: 0 auto;
    background: rgba(255,255,255,0.06);
    border: 1px solid rgba(255,255,255,0.12);
    border-radius: 50px;
    overflow: hidden;
  }
  .blog-search input {
    flex: 1;
    background: none;
    border: none;
    padding: 14px 20px;
    font-size: 14px;
    color: #fff;
    outline: none;
    font-family: 'Space Grotesk', sans-serif;
  }
  .blog-search input::placeholder { color: rgba(255,255,255,0.3); }
  .blog-search button {
    background: #dff811;
    color: #000;
    border: none;
    padding: 14px 24px;
    font-size: 13px;
    font-weight: 700;
    cursor: pointer;
    transition: opacity 0.2s;
    font-family: 'Space Grotesk', sans-serif;
  }
  .blog-search button:hover { opacity: 0.85; }

  /* Category pills */
  .cat-pills {
    display: flex;
    flex-wrap: wrap;
    gap: 8px;
    justify-content: center;
    padding: 0 2rem 3rem;
    max-width: 900px;
    margin: 0 auto;
  }
  .cat-pill {
    padding: 6px 16px;
    border-radius: 50px;
    font-size: 12px;
    font-weight: 600;
    text-decoration: none;
    border: 1px solid rgba(255,255,255,0.15);
    color: rgba(255,255,255,0.6);
    transition: all 0.2s;
    font-family: 'Space Grotesk', sans-serif;
    text-transform: uppercase;
    letter-spacing: 0.06em;
  }
  .cat-pill:hover, .cat-pill.active {
    background: #dff811;
    color: #000;
    border-color: #dff811;
  }

  /* Blog grid */
  .blog-grid-wrap {
    max-width: 1400px;
    margin: 0 auto;
    padding: 0 2rem 6rem;
  }
  .blog-grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(360px, 1fr));
    gap: 32px;
  }

  /* Blog card */
  .blog-card {
    background: rgba(255,255,255,0.03);
    border: 1px solid rgba(255,255,255,0.08);
    border-radius: 16px;
    overflow: hidden;
    transition: all 0.35s cubic-bezier(0.16,1,0.3,1);
    text-decoration: none;
    display: block;
  }
  .blog-card:hover {
    transform: translateY(-6px);
    border-color: rgba(223,248,17,0.25);
    box-shadow: 0 20px 40px rgba(0,0,0,0.4), 0 0 30px rgba(223,248,17,0.06);
  }
  .blog-card-img {
    width: 100%;
    aspect-ratio: 16/9;
    object-fit: cover;
    display: block;
    transition: transform 0.5s ease;
  }
  .blog-card:hover .blog-card-img { transform: scale(1.04); }
  .blog-card-img-wrap { overflow: hidden; position: relative; }

  .blog-card-cat {
    position: absolute;
    top: 12px;
    left: 12px;
    background: #dff811;
    color: #000;
    font-size: 10px;
    font-weight: 700;
    padding: 4px 10px;
    border-radius: 20px;
    text-transform: uppercase;
    letter-spacing: 0.06em;
    font-family: 'Space Grotesk', sans-serif;
  }

  .blog-card-body { padding: 20px 22px 22px; }
  .blog-card-date {
    font-size: 11px;
    color: rgba(255,255,255,0.3);
    margin-bottom: 8px;
    text-transform: uppercase;
    letter-spacing: 0.08em;
    font-family: 'Space Grotesk', sans-serif;
  }
  .blog-card-title {
    font-family: 'Space Grotesk', sans-serif;
    font-size: 1.15rem;
    font-weight: 600;
    color: #ffffff;
    line-height: 1.35;
    margin-bottom: 10px;
    transition: color 0.2s;
  }
  .blog-card:hover .blog-card-title { color: #dff811; }
  .blog-card-desc {
    font-size: 13px;
    color: rgba(255,255,255,0.45);
    line-height: 1.65;
    display: -webkit-box;
    -webkit-line-clamp: 3;
    -webkit-box-orient: vertical;
    overflow: hidden;
  }
  .blog-card-footer {
    display: flex;
    align-items: center;
    justify-content: space-between;
    padding: 0 22px 18px;
    border-top: 1px solid rgba(255,255,255,0.06);
    margin-top: 16px;
    padding-top: 14px;
  }
  .blog-read-more {
    font-size: 12px;
    font-weight: 700;
    color: #dff811;
    text-transform: uppercase;
    letter-spacing: 0.08em;
    font-family: 'Space Grotesk', sans-serif;
    display: flex;
    align-items: center;
    gap: 6px;
  }

  /* Pagination */
  .blog-pagination {
    display: flex;
    justify-content: center;
    gap: 8px;
    margin-top: 48px;
  }
  .blog-pagination .page-link {
    padding: 8px 16px;
    border-radius: 8px;
    background: rgba(255,255,255,0.05);
    border: 1px solid rgba(255,255,255,0.1);
    color: rgba(255,255,255,0.6);
    text-decoration: none;
    font-size: 13px;
    font-family: 'Space Grotesk', sans-serif;
    transition: all 0.2s;
  }
  .blog-pagination .page-link:hover,
  .blog-pagination .page-link.active {
    background: #dff811;
    color: #000;
    border-color: #dff811;
    font-weight: 700;
  }

  /* Empty state */
  .blog-empty {
    text-align: center;
    padding: 80px 20px;
    color: rgba(255,255,255,0.3);
    grid-column: 1/-1;
  }
  .blog-empty i { font-size: 40px; margin-bottom: 16px; display: block; opacity: 0.3; }

  @media (max-width: 768px) {
    .blog-grid { grid-template-columns: 1fr; }
    .blog-hero { padding: 7rem 1.5rem 3rem; }
    .blog-grid-wrap { padding: 0 1.5rem 4rem; }
  }
</style>

<div class="blog-page">

  {{-- Hero --}}
  <div class="blog-hero">
    <h1 class="animate-fade-up" style="animation-delay:0.1s">BLOG</h1>
    <p class="animate-fade-up" style="animation-delay:0.2s">
      Insights, strategies & ideas from The Socially Active team
    </p>
    <form class="blog-search animate-fade-up" style="animation-delay:0.3s"
      action="{{ route('blog') }}" method="GET">
      @if(request('category'))
        <input type="hidden" name="category" value="{{ request('category') }}">
      @endif
      <input type="text" name="search" value="{{ request('search') }}"
        placeholder="Search articles..." />
      <button type="submit">Search</button>
    </form>
  </div>

  {{-- Category Pills --}}
  <div class="cat-pills">
    <a href="{{ route('blog') }}"
      class="cat-pill {{ !request('category') && !request('search') ? 'active' : '' }}">
      All
    </a>
    @foreach($categories as $cat)
    <a href="{{ route('blog', ['category' => $cat->slug]) }}"
      class="cat-pill {{ request('category') == $cat->slug ? 'active' : '' }}">
      {{ $cat->name }}
      <span style="opacity:0.5;margin-left:4px;">({{ $cat->blogs_count }})</span>
    </a>
    @endforeach
  </div>

  {{-- Grid --}}
  <div class="blog-grid-wrap">
    <div class="blog-grid">
      @forelse($blogs as $i => $blog)
      <a href="{{ route('blog.show', $blog->slug) }}"
        class="blog-card animate-fade-up"
        style="animation-delay:{{ 0.1 + $i * 0.07 }}s">
        <div class="blog-card-img-wrap">
          @if($blog->cover_image)
            @if(Str::startsWith($blog->cover_image, 'http'))
              <img class="blog-card-img" src="{{ $blog->cover_image }}" alt="{{ $blog->title }}" loading="lazy">
            @else
              <img class="blog-card-img" src="{{ asset($blog->cover_image) }}" alt="{{ $blog->title }}" loading="lazy">
            @endif
          @else
            <div style="width:100%;aspect-ratio:16/9;background:linear-gradient(135deg,#1a1730,#0d0b1a);display:flex;align-items:center;justify-content:center;">
              <i class="fas fa-newspaper" style="font-size:32px;color:rgba(255,255,255,0.1);"></i>
            </div>
          @endif
          @if($blog->category)
          <span class="blog-card-cat">{{ $blog->category->name }}</span>
          @endif
        </div>
        <div class="blog-card-body">
          <div class="blog-card-date">{{ $blog->created_at->format('d M Y') }}</div>
          <h3 class="blog-card-title">{{ $blog->title }}</h3>
          <p class="blog-card-desc">{{ strip_tags($blog->description ?? $blog->excerpt) }}</p>
        </div>
        <div class="blog-card-footer">
          <span class="blog-read-more">Read More <i class="fas fa-arrow-right" style="font-size:10px;"></i></span>
          <span style="font-size:11px;color:rgba(255,255,255,0.25);font-family:'Space Grotesk',sans-serif;">TheSociallyActive</span>
        </div>
      </a>
      @empty
      <div class="blog-empty">
        <i class="fas fa-newspaper"></i>
        <p style="font-size:1.1rem;margin-bottom:8px;">No posts yet</p>
        <p style="font-size:13px;">Check back soon!</p>
      </div>
      @endforelse
    </div>

    {{-- Pagination --}}
    @if($blogs->hasPages())
    <div class="blog-pagination">
      @if($blogs->onFirstPage())
        <span class="page-link" style="opacity:0.3;cursor:default;">← Prev</span>
      @else
        <a class="page-link" href="{{ $blogs->previousPageUrl() }}">← Prev</a>
      @endif

      @foreach($blogs->getUrlRange(1, $blogs->lastPage()) as $page => $url)
        <a class="page-link {{ $page == $blogs->currentPage() ? 'active' : '' }}"
          href="{{ $url }}">{{ $page }}</a>
      @endforeach

      @if($blogs->hasMorePages())
        <a class="page-link" href="{{ $blogs->nextPageUrl() }}">Next →</a>
      @else
        <span class="page-link" style="opacity:0.3;cursor:default;">Next →</span>
      @endif
    </div>
    @endif

  </div>
</div>

<script src="{{ asset('assets/js/splash-cursor.js') }}"></script>

@endsection