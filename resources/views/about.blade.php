@extends("layouts.front_app")
@section("content")


    <div class="aboutus_section page-section">
        <center>
        <div class="col-lg-8  col-11">
            <div class="row">
                <div class="col-lg-6 col-md-12 col-12 section_1">
                    <div>
                    
                    <p class="heading">{{$pages["about_heading"][0]->text ?? ''}}</p>
                    </div>
                </div>
                <div class="col-lg-6 col-md-12 col-12 section_2">
                    <div>
                    {{--<p class="sh1">{{$pages["about_heading"][1]->text ?? ''}}</p>
                    <p class="sh2">{{$pages["about_heading"][2]->text ?? ''}}</p>
                    <p class="sh3">{{$pages["about_heading"][3]->text ?? ''}}</p>--}}
						{!! webp_picture(env('IMG_FETCH_URL').'uploaded_files/'.(isset($pages["about_heading"][4]) ? $pages["about_heading"][4]->img : ''), 'loading="lazy" alt="About heading image" width="200" height="150"') !!}
                    </div>
                </div>
            </div>
        </div>
</center>
    </div>

    <div class="passion_section page-section" style="height:100%">
        <center>
        <div class="col-lg-8 col-11">
            <div class="row">
                <div class="col-lg-6 section_1">
                    <div>
                    <{{ $pages["passion_section"][0]->heading_tag ?? 'h2' }} class="heading">{{$pages["passion_section"][0]->text ?? ''}} <span class="impact word-change" word-remaine-time="3000" words="{{$pages["passion_section"][1]->text ?? ''}}"></span></{{ $pages["passion_section"][0]->heading_tag ?? 'h2' }}>
                    <p class="content">{{$pages["passion_section"][2]->text ?? ''}}</p>
                    </div>
                </div>
                <div class="col-lg-6 section_2">
                    <div>
                        {!! webp_picture(env('IMG_FETCH_URL').'uploaded_files/'.(isset($pages['passion_section'][3]) ? $pages['passion_section'][3]->img : ''), 'loading="lazy" alt="Passion section image" width="250" height="300"') !!}
                    </div>
                </div>
            </div>
        </div>
</center>
    </div>

<div class="founder_section page-section">
	<center>
		<{{ $pages["founder_section"][0]->heading_tag ?? 'h1' }} class="heading">{{$pages["founder_section"][0]->text ?? ''}}</{{ $pages["founder_section"][0]->heading_tag ?? 'h1' }}>
	<div class="col-lg-6 col-md-8">
		<div class="row">
			<div class="col-lg-6 col-md-6 col-6">
				<div class="content"data-selected="1">
					{!! webp_picture(env('IMG_FETCH_URL').'uploaded_files/'.(isset($pages['founder_section'][1]) ? $pages['founder_section'][1]->img : ''), 'loading="lazy" alt="Founder photo 1" width="300" height="500"') !!}
				</div>
				<div class="content2" data-selected="0">
					<div class="inner">
					<div>
					<{{ $pages["founder_section"][2]->heading_tag ?? 'h3' }} class="title">{{$pages["founder_section"][2]->text ?? ''}}</{{ $pages["founder_section"][2]->heading_tag ?? 'h3' }}>
					<p class="position">{{$pages["founder_section"][3]->text ?? ''}}</p>
						<div class="links">
							<a href="{{$pages["founder_section"][7]->link ?? ''}}"><i class="fa fa-linkedin"></i></a>
							<a href="{{$pages["founder_section"][8]->link ?? ''}}"><i class="fa fa-link"></i></a>
					</div>
					</div>
				</div>
			</div>
			</div>
			<div class="col-lg-6 col-md-6 col-6">
				<div class="content"data-selected="1">
					{!! webp_picture(env('IMG_FETCH_URL').'uploaded_files/'.(isset($pages['founder_section'][4]) ? $pages['founder_section'][4]->img : ''), 'loading="lazy" alt="Founder photo 2" width="300" height="500"') !!}
				</div>
				<div class="content2" data-selected="0">
					<div class="inner">
					<div>
					<{{ $pages["founder_section"][5]->heading_tag ?? 'h3' }} class="title">{{$pages["founder_section"][5]->text ?? ''}}</{{ $pages["founder_section"][5]->heading_tag ?? 'h3' }}>
					<p class="position">{{$pages["founder_section"][6]->text ?? ''}}</p>
						<div class="links">
							<a href="{{$pages["founder_section"][9]->link ?? ''}}"><i class="fa fa-linkedin"></i></a>
					</div>
					</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	</center>
		
</div>
<div class="our_story_section page-section">
	<center>
	<div class="col-lg-10">
		<div class="col-8 content1">
			<img loading="lazy" class="img1" src="{{asset ('assets/images/story/Group_1000001799.png')}}" alt="Story illustration 1" width="400" height="500">
			<div class="content1_inner">
			<p class="text">Two minds.Different paths. Same itch.</p>
			<img loading="lazy" class="img2 moving_animate" src="{{asset('assets/images/story/Groups-2.png')}}" alt="Story illustration 2" width="150" height="150">	
			</div>
		</div>
		<div class="extra_space">
			
		</div>
		<div class="content_upper">
		<div class="col-8 content3">
			<p class="text">The kind spreadsheets and small talk could never scratch.</p>
			<img loading="lazy" class="img1" src="{{asset('assets/images/story/Group 1000001802.png')}}" alt="Story illustration 3" width="250" height="500">
			
			
		</div>
		</div>
		<div class="content_4_upper">
		<div class="col-8 content4">
			<center>
			<p class="text">Different worlds.  Same feeling stuck in loops of calendar invites, polite chatter, and work that felt… hollow.</p>
			<div class="inner">
			<img loading="lazy" class="img1" src="{{asset('assets/images/story/Groups-1.png')}}" alt="Story illustration 4" width="150" height="150">
			<!--<img loading="lazy" class="img2 moving_animate" src="{{asset('assets/images/story/Groups.png')}}">-->
			</div>
			<!--<p class="text2">I am tired of working for someone else</p>-->
			
			</center>
			
		</div>
			<img loading="lazy" class="img3" src="{{asset('assets/images/story/Group 1000001801.png')}}" alt="Story illustration 5" width="400" height="500">	
		</div>
		
	</div>
	</center>
</div>
<div class="our_story_section page-section">
	<center>
	<div class="col-lg-10">
		<center>
		<div class="col-10 content5">
			<p class="text">Then came the moment.  Not loud.  Not dramatic.</p>
			<img loading="lazy" class="img1" src="{{asset('assets/images/story/Vector-3.png')}}" alt="Story background vector" width="150" height="150">
			
			
			<img loading="lazy" class="img2 " src="{{asset('assets/images/story/Group 1000001803.png')}}" alt="Story portrait 1" width="500" height="500">	
			
		</div>
			<div class="col-10 content6">
			
			
			
			
			<img loading="lazy" class="img2" src="{{asset('assets/images/story/Group 1000001804.png')}}" alt="Story portrait 2" width="500" height="500">	
				<img loading="lazy" class="img1 moving_animate" src="{{asset('assets/images/story/Vector-2.png')}}" alt="Story background vector 2" width="150" height="150">
				<p class="text">Just a late night,  a lukewarm coffee,  and a quiet thought:</p>
			
		</div>
		
	</center>
	</div>
	</center>
</div>
<div class="our_story_section page-section">
	<center>
	<div class="col-lg-10">
		<center>
<!--		<div class="col-10 content7">-->
<!--			<div class="inner">-->
<!--			<p class="text">Then came the moment. -->
<!--Not loud, not dramatic. Just a-->
<!--quiet realization during a late-->
<!--night and a lukewarm cup of-->
<!--coffee</p>-->
<!--				<img loading="lazy" class="img1 moving_animate" src="{{asset('assets/images/story/Groups-5.png')}}">-->
<!--			</div>-->
			
			
			
<!--			<img loading="lazy" class="img2" src="{{asset('assets/images/story/Group 1000001804.png')}}">	-->
			
<!--		</div>-->
			<div class="col-10 content8">
				<img loading="lazy" class="img2" src="{{asset('assets/images/story/Group 1000001805.png')}}" alt="Story portrait 3" width="450" height="450">	
			<div class="inner">
			
				<img loading="lazy" class="img1 moving_animate" src="{{asset('assets/images/story/Vector.png')}}" alt="Story background vector 3" width="150" height="150">
				<p class="text">“What if we stop building
for others, and finally
start building for
ourselves?”</p>
			</div>
			
			
			
			
			
		</div>
			
		
	</center>
	</div>
	</center>
</div>
<div class="our_story_section page-section" style="opacity: 1 !important; zoom: 71.1111%;">
	<center>
	<div class="col-lg-10">
		<center>
		<div class="col-10 content5">
			<p class="text">That question lit a spark We didn’t have it all figured out — just a
crazy idea, a shared belief in each other, and the courage to
begin.</p>
			<img loading="lazy" class="img1 moving_animate" src="{{asset('assets/images/story/Vector-3.png')}}" alt="Story background vector" width="150" height="150">
			
			
			<img loading="lazy" class="img2" src="{{asset('assets/images/story/Group 1000001806.png')}}" alt="Story portrait 4" width="500" height="500">	
			
		</div>
			<div class="col-10 content6">
			
			
			
			
			<img loading="lazy" class="img2" src="{{asset('assets/images/story/Group 1000001825.png')}}" alt="Story portrait 5" width="500" height="500">	
				<img loading="lazy" class="img1 moving_animate" src="{{asset('assets/images/story/Vector-2.png')}}" alt="Story background vector 2" width="150" height="150">
				<p class="text">And so, The Socially Active was born.  Not as a business plan   but as a promise.</p>
			
		</div>
		
	</center>
	</div>
	</center>
</div>
<div class="our_story_section page-section" style="opacity: 1 !important; zoom: 71.1111%;">
	<center>
	<div class="col-lg-10">
		<center>
		<div class="col-10 content7">
			<div class="inner">
			<p class="text">A promise to create space for brave brands.  Bold ideas.  Work that makes people feel.</p>
				<img loading="lazy" class="img1 moving_animate" src="{{asset('assets/images/story/Groups-5.png')}}" alt="Story portrait 6" width="100" height="100">
			</div>
			
			
			
			<img loading="lazy" class="img2" src="{{asset('assets/images/story/Group 1000001824.png')}}" alt="Story portrait 7" width="450" height="450">	
			
		</div>
			<div class="col-10 content8">
				<img loading="lazy" class="img2" src="{{asset('assets/images/story/Group 1000001805.png')}}" alt="Story portrait 8" width="450" height="450">	
			<div class="inner">
			
				<img loading="lazy" class="img1 moving_animate" src="{{asset('assets/images/story/Vector.png')}}" alt="Story background vector 3" width="150" height="150">
				<p class="text">To choose heart over hype.
Substance over noise.
And to never settle for
"just okay."</p>
			</div>
			
			
			
			
			
		</div>
			
		
	</center>
	</div>
	</center>
</div>
{{--<div class="external_images page-section">
		<h1 class="heading">{{$pages["story_section"][0]->text ?? ''}}</h1>
	
	<img loading="lazy" src="{{(env('IMG_FETCH_URL').'uploaded_files/'.$pages['story_section'][1]->img ?? '')}}">
	<img loading="lazy" src="{{(env('IMG_FETCH_URL').'uploaded_files/'.$pages['story_section'][2]->img ?? '')}}">
	<img loading="lazy" src="{{(env('IMG_FETCH_URL').'uploaded_files/'.$pages['story_section'][3]->img ?? '')}}">
	<img loading="lazy" src="{{(env('IMG_FETCH_URL').'uploaded_files/'.$pages['story_section'][4]->img ?? '')}}">
	<img loading="lazy" src="{{(env('IMG_FETCH_URL').'uploaded_files/'.$pages['story_section'][5]->img ?? '')}}">
	
</div>
--}}

  {{-- FAQs --}}
  @if($faqs->count() > 0)
  {{-- JSON-LD FAQPage Schema --}}
  <script type="application/ld+json">
  {
    "@@context": "https://schema.org",
    "@@type": "FAQPage",
    "mainEntity": [
      @foreach($faqs as $i => $faq)
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
  <div style="max-width:720px;margin:0 auto 48px;padding:0 2rem;">
    <h2 style="font-size:28px;font-weight:700;color:#fff;margin-bottom:24px;text-align:center;">Frequently Asked Questions</h2>
    <div class="accordion" id="faqAccordion">
      @foreach($faqs as $index => $faq)
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
  @endif

        
@endsection