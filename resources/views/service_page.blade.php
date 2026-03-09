	@extends("layouts.front_app")
@section("content")

	<div class="brand_strategy_banner page-section"style="background:url('{{(env('IMG_FETCH_URL').'uploaded_files/'.$pages['banner'][2]->img)}}');background-size:100% 100%;">
		<center>
				

		<div class="col-lg-8 col-10">
			<div class="row">
			
			<div class="col-lg-6 mb-3">
				<div class="content">
					<div>
					<h2 class="heading">{{$pages['banner'][0]->text}}</h2>
					<p class="text">{{$pages['banner'][1]->text}}</p>
				</div>
				</div>
				
				
			</div>
				<div class="col-lg-6 mb-3">
			<div class="visuals">
				<div class="visual_inner">
				<div class="bg1" style="background:url('{{(env('IMG_FETCH_URL').'uploaded_files/'.$pages['banner'][3]->img)}}');transform:rotate(10deg)">
				</div>
				<video playsinline class="video_customize2" data-cursor="2" autoplay muted>
					<source src="{{(env('IMG_FETCH_URL').'uploaded_files/'.$pages['banner'][4]->img)}}">
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

<div class="banner1 page-section" style="background:url('{{(env('IMG_FETCH_URL').'uploaded_files/'.$pages['strip_1'][0]->img)}}')">
	
		<p>
			<span class="word-change" word-remaine-time="1500" words="{{$pages['strip_1'][1]->text}}"></span>
		</p>
	
</div>
<div class="brand_service_section page-section">
	<center>
<div class="col-lg-10">
<div class="heading_div">
	<h2 class="heading">{{$pages['brand_service_section'][0]->text}}</h2>
	</div>
<div class="content">
	@foreach(extra_image($page) as $data)
            	<img src="{{(env('IMG_FETCH_URL').'uploaded_files/'.$data->banner)}}">
				@endforeach
	
	
</div>
</div>
	</center>
		
</div>
	<div class="banner1 page-section" style="background:#DAF301;padding:30px 0">
		<h4>{{$pages['strip_2'][0]->text}} <span>{{$pages['strip_2'][1]->text}}</span></h4>
			
</div>

	<div class="talk_section page-section">
	<center>
		<div class="col-lg-5">
			<h2 class="heading">{{$pages['talk_section'][0]->text}}  <span class="impact">{{$pages['talk_section'][1]->text}}</span></h2>
			<p class="text">{{$pages['talk_section'][2]->text}}</p>
			
		</div>
	</center>
	
</div>

<div class="explore_more_section">
        <center>
        <div class="col-lg-10 col-md-12">
            <h1 class="heading">{{$pages["explore_section"][0]->text}}</h1>
            </div>
            <div class="content">
                <div class="c1">
                    <div class="col-lg-10 col-md-12">
                    <div class="row" style="width:100%">
                        <div class="col-lg-4 col-3 m-2">
                            <div class="content_heading"data-selected="0">
                            <h1 >{{$pages["explore_section"][1]->text}}</h1>
                            </div>
                        </div>
                        <div class="col-lg-5 col-6 m-2">
                            <div class="content_text">
                            <p data-selected="1">{{$pages["explore_section"][2]->text}}</p>
								<div class="content_video" data-selected="0" >
								<video playsinline autoplay muted loop>
									<source src="{{(env('IMG_FETCH_URL').'uploaded_files/'.$pages['explore_section'][3]->img)}}"type="video/mp4">
								</video>
									<img src="{{asset('assets/images/right_arrow.svg')}}" onclick="window.location.href='{{$pages["explore_section"][13]->link}}'">
								</div>
                            </div>
                        </div>
                        <div class="col-2 m-2">
                            <div class="badge">
                                <div class="inner">
                                        <img src="{{(env('IMG_FETCH_URL').'uploaded_files/'.$pages["explore_section"][4]->img)}}">
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
                            <h1 data-selected="0">{{$pages["explore_section"][5]->text}}</h1>
                            </div>
                        </div>
                        <div class="col-lg-5 col-6 m-2">
                            <div class="content_text">
                            <p data-selected="1">{{$pages["explore_section"][6]->text}}</p>
							
								
								<div class="content_video" data-selected="0" >
<video playsinline data-selected="0" autoplay muted loop>
									<source src="{{(env('IMG_FETCH_URL').'uploaded_files/'.$pages['explore_section'][7]->img)}}"type="video/mp4">
								</video>
									<img src="{{asset('assets/images/right_arrow.svg')}}" onclick="window.location.href='{{$pages["explore_section"][14]->link}}'">
								</div>
                            </div>
                        </div>
                        <div class="col-2 m-2">
                            <div class="badge">
                                <div class="inner">
                                        <img src="{{(env('IMG_FETCH_URL').'uploaded_files/'.$pages["explore_section"][8]->img)}}">
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
                            <h1 data-selected="0">{{$pages["explore_section"][9]->text}}</h1>
                            </div>
                        </div>
                        <div class="col-lg-5 col-6 m-2">
                            <div class="content_text">
                            <p data-selected="1">{{$pages["explore_section"][10]->text}}</p>
							
								<div class="content_video" data-selected="0">
<video playsinline data-selected="0" autoplay muted loop>
									<source src="{{(env('IMG_FETCH_URL').'uploaded_files/'.$pages['explore_section'][11]->img)}}" type="video/mp4">
								</video>
									<img  onclick="window.location.href='{{$pages["explore_section"][15]->link}}'" src="{{asset('assets/images/right_arrow.svg')}}">
								</div>
                            </div>
                        </div>
                        <div class="col-2 m-2">
                            <div class="badge">
                                <div class="inner">
                                        <img src="{{(env('IMG_FETCH_URL').'uploaded_files/'.$pages["explore_section"][12]->img)}}">
                                </div>
                            </div>
                        </div>
                    </div>
                    </div>
                
            </div>
				
				

			
			</div>
</center>
    </div>
@endsection