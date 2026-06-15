	@extends("layouts.front_app")
@section("content")

	<div class="brand_strategy_banner page-section"style="background:url('{{webp_url(env('IMG_FETCH_URL').'uploaded_files/'.$pages['banner'][2]->img)}}');background-size:100% 100%;">
		<center>
				

		<div class="col-lg-8 col-10">
			<div class="row">
			
			<div class="col-lg-6 mb-3">
				<div class="content">
					<div>
					<{{ $pages['banner'][0]->heading_tag ?? 'h2' }} class="heading">{{$pages['banner'][0]->text}}</{{ $pages['banner'][0]->heading_tag ?? 'h2' }}>
					<p class="text">{{$pages['banner'][1]->text}}</p>
				</div>
				</div>
				
				
			</div>
				<div class="col-lg-6 mb-3">
			<div class="visuals">
				<div class="visual_inner">
				<div class="bg1" style="background:url('{{(env('IMG_FETCH_URL').'uploaded_files/'.$pages['banner'][3]->img)}}');transform:rotate(10deg)">
				</div>
				<video playsinline class="video_customize2" data-cursor="2" autoplay muted loop width="350" height="500">
					<source src="{{(env('IMG_FETCH_URL').'uploaded_files/'.str_ireplace('.gif', '.mp4', $pages['banner'][4]->img))}}" type="video/mp4">
					<source src="{{ asset('uploaded_files/'.str_ireplace('.gif', '.mp4', $pages['banner'][4]->img)) }}" type="video/mp4">
				</video> 
				</div>
			</div>
			</div>
			</div>
		</div>
			</center>
		
		<div class="other_details_inner col-lg-6 col-10">
			<div class="inner">
					<p class="impact" ><span class="moving_numbers" data-no="{{$pages['banner'][5]->text}}" data-time="500"></span></p>
					<p class="text">{{$pages['banner'][6]->text}}</p>
			</div>
			<div class="inner">
					<p class="impact"><span class="moving_numbers" data-no="{{$pages['banner'][7]->text}}"data-time="100"></span>+</p>
					<p class="text">{{$pages['banner'][8]->text}}</p>
			</div>
			</div>
		
	</div>

<div class="banner1 page-section" style="background:url('{{webp_url(env('IMG_FETCH_URL').'uploaded_files/'.$pages['strip_1'][0]->img)}}')">
	
		<p>
			<span class="word-change" word-remaine-time="1500" words="{{$pages['strip_1'][1]->text}}"></span>
		</p>
	
</div>
<div class="brand_service_section page-section">
	<center>
<div class="col-lg-10">
<div class="heading_div">
	<{{ $pages['brand_service_section'][0]->heading_tag ?? 'h2' }} class="heading">{{$pages['brand_service_section'][0]->text}}</{{ $pages['brand_service_section'][0]->heading_tag ?? 'h2' }}>
	</div>
<div class="content">
	@foreach(extra_image($page) as $data)
            	<img loading="lazy" src="{{(env('IMG_FETCH_URL').'uploaded_files/'.$data->banner)}}" alt="Service feature banner" width="1000" height="500">
				@endforeach
	
	
</div>
</div>
	</center>
		
</div>
	<div class="banner1 page-section" style="background:#DAF301;padding:30px 0">
		<{{ $pages['strip_2'][0]->heading_tag ?? 'h4' }}>{{$pages['strip_2'][0]->text}} <span>{{$pages['strip_2'][1]->text}}</span></{{ $pages['strip_2'][0]->heading_tag ?? 'h4' }}>
			
</div>

	<div class="talk_section page-section">
	<center>
		<div class="col-lg-5">
			<{{ $pages['talk_section'][0]->heading_tag ?? 'h2' }} class="heading">{{$pages['talk_section'][0]->text}}  <span class="impact">{{$pages['talk_section'][1]->text}}</span></{{ $pages['talk_section'][0]->heading_tag ?? 'h2' }}>
			<p class="text">{{$pages['talk_section'][2]->text}}</p>
			
		</div>
	</center>
	
</div>

<div class="explore_more_section">
        <center>
        <div class="col-lg-10 col-md-12">
            <{{ $pages["explore_section"][0]->heading_tag ?? 'h1' }} class="heading">{{$pages["explore_section"][0]->text}}</{{ $pages["explore_section"][0]->heading_tag ?? 'h1' }}>
            </div>
            <div class="content">
                <div class="c1">
                    <div class="col-lg-10 col-md-12">
                    <div class="row" style="width:100%">
                        <div class="col-lg-4 col-3 m-2">
                            <div class="content_heading"data-selected="0">
                            <{{ $pages["explore_section"][1]->heading_tag ?? 'h1' }}>{{$pages["explore_section"][1]->text}}</{{ $pages["explore_section"][1]->heading_tag ?? 'h1' }}>
                            </div>
                        </div>
                        <div class="col-lg-5 col-6 m-2">
                            <div class="content_text">
                            <p data-selected="1">{{$pages["explore_section"][2]->text}}</p>
								<div class="content_video" data-selected="0" >
								<video playsinline autoplay muted loop width="150" height="200">
									<source src="{{(env('IMG_FETCH_URL').'uploaded_files/'.str_ireplace('.gif', '.mp4', $pages['explore_section'][3]->img))}}" type="video/mp4">
									<source src="{{ asset('uploaded_files/'.str_ireplace('.gif', '.mp4', $pages['explore_section'][3]->img)) }}" type="video/mp4">
								</video>
									<img loading="lazy" src="{{asset('assets/images/right_arrow.svg')}}" onclick="window.location.href='{{$pages["explore_section"][13]->link}}'" alt="Right arrow" width="50" height="50">
								</div>
                            </div>
                        </div>
                        <div class="col-2 m-2">
                            <div class="badge">
                                <div class="inner">
                                        <img loading="lazy" src="{{(env('IMG_FETCH_URL').'uploaded_files/'.$pages["explore_section"][4]->img)}}" class="brand_service_section_img-1" alt="Explore badge 1" width="50" height="50">
                                </div>
                            </div>
                        </div>
                    </div>
                    </div>
                
            </div>
				<div class="c1">
                    <div class="col-lg-10 col-md-12">
                    <div class="row"style="width:100%">
                        <div class="col-lg-4 col-3 m-2">
                            <div class="content_heading"data-selected="0">
                            <{{ $pages["explore_section"][5]->heading_tag ?? 'h1' }} data-selected="0">{{$pages["explore_section"][5]->text}}</{{ $pages["explore_section"][5]->heading_tag ?? 'h1' }}>
                            </div>
                        </div>
                        <div class="col-lg-5 col-6 m-2">
                            <div class="content_text">
                            <p data-selected="1">{{$pages["explore_section"][6]->text}}</p>
							
								
								<div class="content_video" data-selected="0" >
<video playsinline data-selected="0" autoplay muted loop width="150" height="200">
									<source src="{{(env('IMG_FETCH_URL').'uploaded_files/'.str_ireplace('.gif', '.mp4', $pages['explore_section'][7]->img))}}" type="video/mp4">
									<source src="{{ asset('uploaded_files/'.str_ireplace('.gif', '.mp4', $pages['explore_section'][7]->img)) }}" type="video/mp4">
								</video>
									<img loading="lazy" src="{{asset('assets/images/right_arrow.svg')}}" onclick="window.location.href='{{$pages["explore_section"][14]->link}}'" alt="Right arrow" width="50" height="50">
								</div>
                            </div>
                        </div>
                        <div class="col-2 m-2">
                            <div class="badge">
                                <div class="inner">
                                        <img loading="lazy" src="{{(env('IMG_FETCH_URL').'uploaded_files/'.$pages["explore_section"][8]->img)}}" alt="Explore badge 2" width="50" height="50">
                                </div>
                            </div>
                        </div>
                    </div>
                    </div>
                
            </div>
				<div class="c1">
                    <div class="col-lg-10 col-md-12">
                    <div class="row"style="width:100%">
                        <div class="col-lg-4 col-3 m-2">
                            <div class="content_heading"data-selected="0">
                            <{{ $pages["explore_section"][9]->heading_tag ?? 'h1' }} data-selected="0">{{$pages["explore_section"][9]->text}}</{{ $pages["explore_section"][9]->heading_tag ?? 'h1' }}>
                            </div>
                        </div>
                        <div class="col-lg-5 col-6 m-2">
                            <div class="content_text">
                            <p data-selected="1">{{$pages["explore_section"][10]->text}}</p>
							
								<div class="content_video" data-selected="0">
<video playsinline data-selected="0" autoplay muted loop width="150" height="200">
									<source src="{{(env('IMG_FETCH_URL').'uploaded_files/'.str_ireplace('.gif', '.mp4', $pages['explore_section'][11]->img))}}" type="video/mp4">
									<source src="{{ asset('uploaded_files/'.str_ireplace('.gif', '.mp4', $pages['explore_section'][11]->img)) }}" type="video/mp4">
								</video>
									<img loading="lazy"  onclick="window.location.href='{{$pages["explore_section"][15]->link}}'" src="{{asset('assets/images/right_arrow.svg')}}" alt="Right arrow" width="50" height="50">
								</div>
                            </div>
                        </div>
                        <div class="col-2 m-2">
                            <div class="badge">
                                <div class="inner">
                                        <img loading="lazy" src="{{(env('IMG_FETCH_URL').'uploaded_files/'.$pages["explore_section"][12]->img)}}" alt="Explore badge 3" width="50" height="50">
                                </div>
                            </div>
                        </div>
                    </div>
                    </div>
                
            </div>
				
				

			
			</div>
</center>
    </div>
@if($faqs->count() > 0)
  <script type="application/ld+json">
  {
    "@@context": "https://schema.org",
    "@@type": "FAQPage",
    "mainEntity": [
      @foreach($faqs->sortBy('sort_order') as $i => $faq)
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
      @foreach($faqs->sortBy('sort_order') as $index => $faq)
      <div class="accordion-item" style="background:rgba(255,255,255,0.03);border:1px solid rgba(255,255,255,0.08);border-radius:12px;margin-bottom:8px;overflow:hidden;">
        <h3 class="accordion-header" id="faq-heading-{{ $index }}">
          <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq-collapse-{{ $index }}" style="background:transparent;color:#fff;font-size:16px;font-weight:600;padding:16px 20px;box-shadow:none;" aria-expanded="false" aria-controls="faq-collapse-{{ $index }}">
            {{ $faq->question }}
          </button>
        </h3>
        <div id="faq-collapse-{{ $index }}" class="accordion-collapse collapse" aria-labelledby="faq-heading-{{ $index }}" data-bs-parent="#faqAccordion">
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