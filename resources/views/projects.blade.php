@extends("layouts.front_app")

@section("content")

<link rel="stylesheet" href="{{ asset('assets/css/portfolio.css') }}">

<style>
  /* Override portfolio CSS colors for dark site */
  .projects-page-wrap {
    background: #000000;
    min-height: 100vh;
  }

  /* Fix text colors for dark background */
  .projects-page-wrap .header-label,
  .projects-page-wrap .count-label span {
    color: rgba(255,255,255,0.4) !important;
  }

  .projects-page-wrap .header-count {
    color: rgba(255,255,255,0.15) !important;
  }

  .projects-page-wrap .project-title {
    color: #ffffff !important;
  }

  .projects-page-wrap .project-tag {
    color: rgba(255,255,255,0.4) !important;
  }

  .projects-page-wrap .tag-dot {
    color: rgba(255,255,255,0.2) !important;
  }

  .projects-page-wrap .cta-label {
    color: rgba(255,255,255,0.4) !important;
  }

  .projects-page-wrap .cta-title {
    color: #ffffff !important;
  }

  .projects-page-wrap .marquee-text {
    color: rgba(255,255,255,0.15) !important;
  }

  .projects-page-wrap .marquee-wrap {
    border-top-color: rgba(255,255,255,0.1) !important;
    border-bottom-color: rgba(255,255,255,0.1) !important;
  }

  .projects-page-wrap .project-card-image {
    background: #111 !important;
  }

  /* Hide portfolio nav */
  .portfolio-nav { display: none !important; }

  /* Big PROJECTS heading */
  .projects-hero-heading {
    text-align: center;
    padding: 8rem 1.5rem 3rem;
    position: relative;
    z-index: 10;
    margin: 100px auto 50px;
  }

  .projects-hero-heading h1 {
    font-family: 'Space Grotesk', sans-serif;
    font-size: clamp(4rem, 12vw, 10rem);
    font-weight: 700;
    letter-spacing: -0.04em;
    color: #ffffff;
    line-height: 1;
    margin: 0;
  }

  .projects-hero-heading .count-label {
    display: flex;
    align-items: center;
    justify-content: space-between;
    max-width: 1400px;
    margin: 1rem auto 0;
    padding: 0 1.5rem;
  }

  .projects-hero-heading .count-label span {
    font-size: 0.75rem;
    text-transform: uppercase;
    letter-spacing: 0.3em;
    color: rgba(255,255,255,0.4);
  }
</style>

<div class="projects-page-wrap">
  <canvas id="splash-canvas"></canvas>

  {{-- Big centered PROJECTS heading --}}
  <div class="projects-hero-heading z-10">
    <h1 class="animate-fade-up" style="animation-delay:0.1s">PROJECTS</h1>
    <div class="count-label animate-fade-up" style="animation-delay:0.2s">
      <span>Selected works</span>
      <span>
        @if($projects->count() > 0)
          {{ str_pad($projects->count(), 2, '0', STR_PAD_LEFT) }} projects
        @else
          08 projects
        @endif
      </span>
    </div>
  </div>

  {{-- Projects Grid --}}
  <section class="projects-section">
    <div class="projects-grid">

      @if($projects->count() > 0)
        @php
        $placeholders = [
          'https://images.unsplash.com/photo-1633356122544-f134324a6cee?w=800&q=80',
          'https://images.unsplash.com/photo-1558618666-fcd25c85cd64?w=800&q=80',
          'https://images.unsplash.com/photo-1617802690992-15d93263d3a9?w=800&q=80',
          'https://images.unsplash.com/photo-1614741118887-7a4ee193a5fa?w=800&q=80',
          'https://images.unsplash.com/photo-1578662996442-48f60103fc96?w=800&q=80',
          'https://images.unsplash.com/photo-1504639725590-34d0984388bd?w=800&q=80',
          'https://images.unsplash.com/photo-1620641788421-7a1c342ea42e?w=800&q=80',
          'https://images.unsplash.com/photo-1558618047-3c8c76ca7d13?w=800&q=80',
        ];
        @endphp
        @foreach($projects as $i => $project)
        <div class="animate-fade-up" style="animation-delay:{{ 0.2 + $i * 0.1 }}s">
          <a href="{{ $project->link ?? '#' }}" class="project-card" style="text-decoration:none;display:block;">
            <div class="project-card-image">
              @if($project->image && file_exists(public_path('images/' . $project->image)))
                <img src="{{ asset('images/' . $project->image) }}" alt="{{ $project->title }}">
              @else
                <img src="{{ $placeholders[$i % count($placeholders)] }}" alt="{{ $project->title }}">
              @endif
              <div class="shine-overlay"></div>
            </div>
            <div class="project-tags">
              @foreach($project->tags_array as $j => $tag)
                @if(trim($tag))
                <span class="project-tag">
                  {{ trim($tag) }}
                  @if($j < count($project->tags_array) - 1)
                  <span class="tag-dot">&bull;</span>
                  @endif
                </span>
                @endif
              @endforeach
            </div>
            <h3 class="project-title">{{ $project->title }}</h3>
          </a>
        </div>
        @endforeach

      @else
        {{-- Demo data --}}
        @php
        $demoProjects = [
          ["title"=>"Brand Strategy","tags"=>["branding","strategy","identity"],"image"=>"https://images.unsplash.com/photo-1626785774573-4b799315345d?w=800&q=80","link"=>"#"],
          ["title"=>"Social Media Growth","tags"=>["social media","content","growth"],"image"=>"https://images.unsplash.com/photo-1611162617213-7d7a39e9b1d7?w=800&q=80","link"=>"#"],
          ["title"=>"Digital Campaign","tags"=>["digital","campaign","marketing"],"image"=>"https://images.unsplash.com/photo-1460925895917-afdab827c52f?w=800&q=80","link"=>"#"],
          ["title"=>"Influencer Marketing","tags"=>["influencer","reach","engagement"],"image"=>"https://images.unsplash.com/photo-1557804506-669a67965ba0?w=800&q=80","link"=>"#"],
          ["title"=>"Content Production","tags"=>["video","photography","production"],"image"=>"https://images.unsplash.com/photo-1492691527719-9d1e07e534b4?w=800&q=80","link"=>"#"],
          ["title"=>"Web Experience","tags"=>["web","design","development"],"image"=>"https://images.unsplash.com/photo-1547658719-da2b51169166?w=800&q=80","link"=>"#"],
          ["title"=>"Brand Launch","tags"=>["launch","PR","visibility"],"image"=>"https://images.unsplash.com/photo-1533750349088-cd871a92f312?w=800&q=80","link"=>"#"],
          ["title"=>"Performance Marketing","tags"=>["ROI","ads","conversions"],"image"=>"https://images.unsplash.com/photo-1551288049-bebda4e38f71?w=800&q=80","link"=>"#"],
        ];
        @endphp
        @foreach($demoProjects as $i => $project)
        <div class="animate-fade-up" style="animation-delay:{{ 0.2 + $i * 0.1 }}s">
          <a href="{{ $project['link'] }}" class="project-card" style="text-decoration:none;display:block;">
            <div class="project-card-image">
              <img src="{{ $project['image'] }}" alt="{{ $project['title'] }}" loading="lazy">
              <div class="shine-overlay"></div>
            </div>
            <div class="project-tags">
              @foreach($project['tags'] as $j => $tag)
              <span class="project-tag">
                {{ $tag }}
                @if($j < count($project['tags']) - 1)
                <span class="tag-dot">&bull;</span>
                @endif
              </span>
              @endforeach
            </div>
            <h3 class="project-title">{{ $project['title'] }}</h3>
          </a>
        </div>
        @endforeach
      @endif

    </div>
  </section>

  {{-- CTA --}}
  <section class="cta-section z-10">
    <div style="max-width:1400px;margin:0 auto;">
      <p class="cta-label">Got a project in mind?</p>
      <h2 class="cta-title">Let's work</h2>
      <h2 class="cta-title cta-title-italic">together!</h2>
      <div style="margin-top:2rem;">
        <a href="{{ route('contact') }}" style="
          display:inline-block;
          padding:16px 40px;
          background:#dff811;
          color:#000000;
          text-decoration:none;
          border-radius:9999px;
          font-size:0.9rem;
          font-weight:700;
          transition:opacity 0.2s;
        " onmouseover="this.style.opacity=0.85" onmouseout="this.style.opacity=1">
          Get In Touch
        </a>
      </div>
    </div>
    <div class="marquee-wrap">
      <div class="marquee-track animate-marquee">
        @for($x = 0; $x < 12; $x++)
        <span class="marquee-text">Continue to scroll</span>
        @endfor
      </div>
    </div>
  </section>
</div>

<script src="{{ asset('assets/js/splash-cursor.js') }}"></script>
<script src="{{ asset('assets/js/project-cards.js') }}"></script>

@endsection