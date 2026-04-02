@extends("layouts.front_app")
@section("content")
<div class="main_contact_popup_form" style="display:none">
<div class="contact_popup_form">
        <center>
        <div class="container">
            <div class="form col-lg-8 col-12">
            <button type="button" class="close_contact_popup_form"><i class="fa fa-close"></i></button>
            <h1 class="heading">LET'S CREATE IMPACT TOGETHER</h1>
            <p class="content">You're just one message away from bringing your brand closer to heart.</p>
            @include('component.contact_form')
            </div>
        </div>
        </center>
    </div>
    </div>
    <div class="banner page-section">
		
		{{--<div class="video_banner_section" style="background:white">
			<video playsinline id="video_banner_section" autoplay muted >
				<source src="{{(env('IMG_FETCH_URL').'uploaded_files/'.$pages['home_banner'][3]->img)}}" type="video/mp4">
			</video>
			<img id="image_banner_section" src="{{(env('IMG_FETCH_URL').'uploaded_files/'.$pages['home_banner'][2]->img)}}">
		</div>--}}
		
	<div class="content">
        
        <div class="col-lg-10">
			<center>
				@php
				$heading = explode(";",$pages['home_banner'][1]->text);
				@endphp
			<h1 class="heading desktop-view" style="position:relative">
				<span class="bhe4">{{$heading[0]}}</span><br> <span class="bhe1">{{$heading[1]}}</span><br> <span class="bhe2"style="">{{$heading[2]}}</span> <span class="bhe3" style="">{{$heading[3]}}</span>
				{{--{{$pages['home_banner'][0]->text}}<br> <span class="impact word-change" word-remaine-time="1500" words="{{$pages['home_banner'][1]->text}}"></span>--}}</h1>
				<h1 class="heading mobile-view" style="position:relative">
				<span class="bhe4">{{$heading[0]}}</span><span class="bhe1">{{$heading[1]}}</span><br> <span class="bhe2"style="">{{$heading[2]}}</span> <span class="bhe3" style="">{{$heading[3]}}</span>
				{{--{{$pages['home_banner'][0]->text}}<br> <span class="impact word-change" word-remaine-time="1500" words="{{$pages['home_banner'][1]->text}}"></span>--}}</h1>
            </center>
        </div>
    </div>	
        
			
			<div class="canvasBg">
				<canvas id="bannerCanvas">
				</canvas>
			</div>
    
    </div>
<div class="main_video_frame">
<div class="video_frame page-section" data-active="0">
				<video playsinline class="video_customize2 lazy-load" data-cursor="1" referrerpolicy="no-referrer-when-downgrade">
					<source data-src="{{(env('IMG_FETCH_URL').'uploaded_files/'.$pages['home_banner'][3]->img)}}" type="video/mp4">
	</video>

			</div>
</div>

<div class="passion_section page-section"style="background:url('{{(env('IMG_FETCH_URL').'uploaded_files/'.$pages['about_section'][4]->img)}}'), linear-gradient(0deg,black,black);
	background-size:contain;
	background-position:right;
	background-repeat:no-repeat;">
	

		
	
		
        <center>
		<h2 class="heading">{{$pages['about_section'][6]->text}}</h2>
        <div class="col-lg-8 col-11 p-4">
            <div class="row">
				<div class="col-lg-6 section_2">
                    <div>
                        <img class="pointer_change_1" src="{{(env('IMG_FETCH_URL').'uploaded_files/'.$pages['about_section'][5]->img)}}"> 
                    </div>
                </div>
                <div class="col-lg-6 section_1">
                    <div>
                    <h2 class="heading">{{$pages['about_section'][0]->text}}<br> <span class="impact word-change" word-remaine-time="1500" words="{{$pages['about_section'][1]->text}}"></span></h2>
                    <p class="content">{{$pages['about_section'][2]->text}}</p>
                    <div onclick="window.location.href='{{$pages['about_section'][3]->link}}'" class="button-style-div"><div class="button-style-span">
						<div class="button-style-span2">{{$pages['about_section'][3]->text}}</div></div>
						</div>
                    </div>
                </div>
            </div>
        </div>
</center>
    </div>
	<div class="main_whoweare_section_video">
	<div class="whoweare_section_video">
	<div class="inner">
		<button class="close_video" type="button"><i class="fa fa-close"></i></button>
		<video playsinline class="video_customize" loop muted>
		<source src="" type="video/mp4">
	</video>
		<img class="mockup" src="{{asset('assets/images/iphone_mockup.png')}}">
		
		<button class="video_mute" data-type="mute" type="button"><i class="fa fa-volume-off"></i></button>
		<button class="play_pause fa fa-play" type="button"></button>
</div>
		</div>
</div>
    <div class="whoweare_section page-section">
        <center>
			
        <div class="whoweare_setion_width_section col-12">
			
            <h4 class="heading">{{$pages['who_we_are'][0]->text}}</h4>
            <p class="sub-heading">{{$pages["who_we_are"][1]->text}}</p>
			
            <div class="video_section_outer mb-4 col-lg-10">
            <div class="video_section">
				<div class="video_div" data-selected="-1" data-id="0">
                    <video playsinline autoplay loop muted class="lazy-load">
						<source data-src="{{(env('IMG_FETCH_URL').'uploaded_files/'.$pages['who_we_are'][2]->img)}}" type="video/mp4">
                    </video>
                </div>
				<div class="video_div" data-selected="0"data-id="1">
                    <video playsinline autoplay loop muted class="lazy-load">
						<source data-src="{{(env('IMG_FETCH_URL').'uploaded_files/'.$pages['who_we_are'][3]->img)}}" type="video/mp4">
                    </video>
                </div>
                <div class="video_div" data-selected="1"data-id="2">
                    <video playsinline autoplay loop muted class="lazy-load">
						<source data-src="{{(env('IMG_FETCH_URL').'uploaded_files/'.$pages['who_we_are'][4]->img)}}" type="video/mp4">
                    </video>
                </div>
				<div class="video_div" data-selected="2"data-id="3">
                    <video playsinline autoplay loop muted class="lazy-load">
						<source data-src="{{(env('IMG_FETCH_URL').'uploaded_files/'.$pages['who_we_are'][5]->img)}}" type="video/mp4">
                    </video>
                </div>
				<div class="video_div" data-selected="3"data-id="4">
                    <video playsinline autoplay loop muted class="lazy-load">
						<source data-src="{{(env('IMG_FETCH_URL').'uploaded_files/'.$pages['who_we_are'][6]->img)}}" type="video/mp4">
                    </video>
                </div>
			<div class="navigate-arrows">
                
                <div class="inner">
                    <button type="button" class="video_section_previous"><img src="{{asset('assets/images/main_files2/paginate/prev_arrow.svg')}}"></button>
                    <button type="button"class="video_section_next"><img src="{{asset('assets/images/main_files2/paginate/next_arrow.svg')}}"></button>
            </div>
				<div class="inner0">
				
				</div>
            </div>	
            </div>
				
            </div>
            
        
			
        </div>
        
        </center>
    </div>
	
	
	<div class="who_we_help_section page-section">
		<img class="bulb-effect before lazy-load" data-src="{{(env('IMG_FETCH_URL').'uploaded_files/'.$pages['who_we_help'][1]->img)}}">
		<img class="bulb-effect after lazy-load" data-src="{{(env('IMG_FETCH_URL').'uploaded_files/'.$pages['who_we_help'][15]->img)}}">
		<div class="inner">
			<div class="container">
				<h3 class="heading">{{$pages['who_we_help'][0]->text}}</h3>
				<div class="content">
					<div class="row">
						<div class="col-lg-4 col-md-6 mb-3">
							<div class="content_div">
								<img class="part1 lazy-load" data-src="{{(env('IMG_FETCH_URL').'uploaded_files/'.$pages['who_we_help'][4]->img)}}"data-selected="1">
								<img class="part2 lazy-load" data-src="{{(env('IMG_FETCH_URL').'uploaded_files/'.$pages['who_we_help'][5]->img)}}" data-selected="0">
								<h4 class="content_heading">{{$pages['who_we_help'][2]->text}}</h4>
								<p class="content_text">{{$pages['who_we_help'][3]->text}}</p>
							</div>
						</div>
						<div class="col-lg-4 col-md-6 mb-3">
							<div class="content_div">
								<img class="part1 lazy-load" data-src="{{(env('IMG_FETCH_URL').'uploaded_files/'.$pages['who_we_help'][8]->img)}}"data-selected="1">
								<img class="part2 lazy-load" data-src="{{(env('IMG_FETCH_URL').'uploaded_files/'.$pages['who_we_help'][9]->img)}}" data-selected="0">
								<h4 class="content_heading">{{$pages['who_we_help'][6]->text}}</h4>
								<p class="content_text">{{$pages['who_we_help'][7]->text}}</p>
							</div>
						</div>
						<div class="col-lg-4 col-md-6 mb-3">
							<div class="content_div">
								<img class="part1 lazy-load" data-src="{{(env('IMG_FETCH_URL').'uploaded_files/'.$pages['who_we_help'][12]->img)}}"data-selected="1">
								<img class="part2 lazy-load" data-src="{{(env('IMG_FETCH_URL').'uploaded_files/'.$pages['who_we_help'][13]->img)}}" data-selected="0">
								<h4 class="content_heading">{{$pages['who_we_help'][10]->text}}</h4>
								<p class="content_text">{{$pages['who_we_help'][11]->text}}</p>
							</div>
						</div>
					</div>
				</div>
			</div>
			
			
			<br><br>
		<div class="bottom-div">
			<img class="part1" src="{{asset('assets/images/who_we_are_icon.png')}}" data-selected="1">
			<div class="part2"data-selected="0">
				<div  class="inner">
				<div class="box1"></div>
				<p>{{$pages['who_we_help'][14]->text}}</p>
				<div class="box2"></div>
				
			</div>
			</div>
		</div>
		
	</div>
	</div>
<div class="outer_video_section page-section">
	<div class="inner">


	<video playsinline class="video_customize2 lazy-load" autoplay muted data-cursor="2">
		<source data-src="{{(env('IMG_FETCH_URL').'uploaded_files/'.$pages['video_section'][0]->img)}}">
	</video>

</div>
</div>
			{{-- Old expertise section removed - replaced with cinematic scroll section --}}
		<div class="expertise_section page-section" data-change="0">
		<div style="width:100%;">
		<h1 class="heading">{{$pages['expertise_section'][0]->text}}</h1>
			<div style="display:flex;justify-content:center;width:100%">
			
		<div class="width_div">


			<div class="width_div23" style="display:flex;justify-content:center">
			<div class="service_section">
			<img class="service_img lazy-load" data-src="{{(env('IMG_FETCH_URL').'uploaded_files/'.$pages['expertise_section'][1]->img)}}" data-selected="1">
			<img class="service_img_2 lazy-load" data-src="{{(env('IMG_FETCH_URL').'uploaded_files/'.$pages['expertise_section'][2]->img)}}" data-selected="0">
			</div>

			<div class="service_section ">
			<img class="service_img lazy-load" data-src="{{(env('IMG_FETCH_URL').'uploaded_files/'.$pages['expertise_section'][3]->img)}}" data-selected="1">
			<img class="service_img_2 lazy-load" data-src="{{(env('IMG_FETCH_URL').'uploaded_files/'.$pages['expertise_section'][4]->img)}}" data-selected="0">
			</div>
				<div class="service_section ">
			<img class="service_img lazy-load" data-src="{{(env('IMG_FETCH_URL').'uploaded_files/'.$pages['expertise_section'][5]->img)}}" data-selected="1">
			<img class="service_img_2 lazy-load" data-src="{{(env('IMG_FETCH_URL').'uploaded_files/'.$pages['expertise_section'][6]->img)}}" data-selected="0">
			</div>
				<div class="service_section ">
			<img class="service_img lazy-load" data-src="{{(env('IMG_FETCH_URL').'uploaded_files/'.$pages['expertise_section'][7]->img)}}" data-selected="1">
			<img class="service_img_2 lazy-load" data-src="{{(env('IMG_FETCH_URL').'uploaded_files/'.$pages['expertise_section'][8]->img)}}" data-selected="0">
			</div>
			</div>
		
				
				
				
			
				
		</div>
		</div>
		</div>
		</div>
			
	<div class="invisible_page desktop-view page-section">
</div>
<div class="invisible_page desktop-view page-section">
</div>
		
	<div class="brand_strategy_section page-section" data-id="1">

		<div class="col-11">
			<div class="row">
			<div class="col-lg-3 col-md-3 col-4 mb-3">
			<div class="visuals">
				<img class="main-image desktop-view2 lazy-load" data-src="{{(env('IMG_FETCH_URL').'uploaded_files/'.$pages['card_section_1'][2]->img)}}" data-selected="1">
				<img class="main-image_2 desktop-view2 lazy-load" data-src="{{(env('IMG_FETCH_URL').'uploaded_files/'.$pages['card_section_1'][3]->img)}}"data-selected="0">
				<video playsinline id="video_banner_section" class="mobile-view2 video_customize2 lazy-load" data-cursor="2" autoplay muted>
				<source data-src="{{(env('IMG_FETCH_URL').'uploaded_files/'.$pages['card_section_1'][4]->img)}}" type="video/mp4">
			</video>
			</div>



			</div>
			<div class="col-lg-6 col-md-6 col-8 mb-3">
				<div class="content">
					<div>
					<h2 class="heading">{{$pages['card_section_1'][0]->text}}</h2>
					<p class="text">{{$pages['card_section_1'][1]->text}}</p>
						<div onclick="window.location.href='{{$pages['card_section_1'][5]->link}}'" class="button-style-div"><div class="button-style-span">
						<div class="button-style-span2">{{$pages['card_section_1'][5]->text}}</div></div>
						</div>

				</div>
				</div>


			</div>
				<div class="col-lg-3 col-md-3 col-12 mb-3 desktop-view2">
			<div class="visuals2">

				<video playsinline id="video_banner_section" class="desktop-view2 video_customize2 lazy-load" data-cursor="2" autoplay muted>
				<source data-src="{{(env('IMG_FETCH_URL').'uploaded_files/'.$pages['card_section_1'][4]->img)}}" type="video/mp4">
			</video>

			</div>



			</div>
			</div>
		</div>
	</div>
	<div class="brand_strategy_section page-section" data-id="2">

		<div class="col-11">
			<div class="row">
			<div class="col-lg-3 col-md-3 col-4 mb-3">
			<div class="visuals">
				<img class="main-image desktop-view2 lazy-load" data-src="{{(env('IMG_FETCH_URL').'uploaded_files/'.$pages['card_section_2'][2]->img)}}" data-selected="1">
				<img class="main-image_2 desktop-view2 lazy-load" data-src="{{(env('IMG_FETCH_URL').'uploaded_files/'.$pages['card_section_2'][3]->img)}}"data-selected="0">
				<video playsinline id="video_banner_section" class="mobile-view2 video_customize2 lazy-load" data-cursor="2" autoplay muted >
				<source data-src="{{(env('IMG_FETCH_URL').'uploaded_files/'.$pages['card_section_2'][4]->img)}}" type="video/mp4">
			</video>
			</div>



			</div>
			<div class="col-lg-6 col-md-6 col-8 mb-3">
				<div class="content">
					<div>
					<h2 class="heading">{{$pages['card_section_2'][0]->text}}</h2>
					<p class="text">{{$pages['card_section_2'][1]->text}}</p>

						<div onclick="window.location.href='{{$pages['card_section_2'][5]->link}}'" class="button-style-div"><div class="button-style-span">
						<div class="button-style-span2">{{$pages['card_section_2'][5]->text}}</div></div>
						</div>
				</div>
				</div>


			</div>
				<div class="col-lg-3 col-md-3 col-12 mb-3">
			<div class="visuals2">

				<video playsinline id="video_banner_section" class="desktop-view2 video_customize2 lazy-load" data-cursor="2" autoplay muted>
				<source data-src="{{(env('IMG_FETCH_URL').'uploaded_files/'.$pages['card_section_2'][4]->img)}}" type="video/mp4">
			</video>

			</div>



			</div>
			</div>
		</div>
	</div>
	<div class="brand_strategy_section page-section" data-id="3">

		<div class="col-11">
			<div class="row">
			<div class="col-lg-3 col-md-3 col-4 mb-3">
			<div class="visuals">
				<img class="main-image desktop-view2 lazy-load" data-src="{{(env('IMG_FETCH_URL').'uploaded_files/'.$pages['card_section_3'][2]->img)}}" data-selected="1">
				<img class="main-image_3 desktop-view2 lazy-load" data-src="{{(env('IMG_FETCH_URL').'uploaded_files/'.$pages['card_section_3'][3]->img)}}"data-selected="0">
				<video playsinline id="video_banner_section" class="mobile-view2  video_customize2 lazy-load" data-cursor="2" autoplay muted >
				<source data-src="{{(env('IMG_FETCH_URL').'uploaded_files/'.$pages['card_section_3'][4]->img)}}" type="video/mp4">
			</video>
			</div>



			</div>
			<div class="col-lg-6 col-md-6 col-8 mb-3">
				<div class="content">
					<div>
					<h2 class="heading">{{$pages['card_section_3'][0]->text}}</h2>
					<p class="text">{{$pages['card_section_3'][1]->text}}</p>

						<div onclick="window.location.href='{{$pages['card_section_3'][5]->link}}'" class="button-style-div"><div class="button-style-span">
						<div class="button-style-span2">{{$pages['card_section_3'][5]->text}}</div></div>
						</div>
				</div>
				</div>


			</div>
				<div class="col-lg-3 col-md-3 col-12 mb-3">
			<div class="visuals2">

				<video playsinline id="video_banner_section" class="desktop-view2  video_customize2 lazy-load" data-cursor="2" autoplay muted >
				<source data-src="{{(env('IMG_FETCH_URL').'uploaded_files/'.$pages['card_section_3'][4]->img)}}" type="video/mp4">
			</video>

			</div>



			</div>
			</div>
		</div>
	</div>
	<div class="brand_strategy_section page-section" data-id="4">

		<div class="col-11">
			<div class="row">
			<div class="col-lg-3 col-md-3 col-4 mb-3">
			<div class="visuals">
				<img class="main-image desktop-view2 lazy-load" data-src="{{(env('IMG_FETCH_URL').'uploaded_files/'.$pages['card_section_4'][2]->img)}}" data-selected="1">
				<img class="main-image_4 desktop-view2 lazy-load" data-src="{{(env('IMG_FETCH_URL').'uploaded_files/'.$pages['card_section_4'][3]->img)}}"data-selected="0">
				<video playsinline id="video_banner_section" class="mobile-view2  video_customize2 lazy-load" data-cursor="2" autoplay muted >
				<source data-src="{{(env('IMG_FETCH_URL').'uploaded_files/'.$pages['card_section_4'][4]->img)}}" type="video/mp4">
			</video>
			</div>



			</div>
			<div class="col-lg-6 col-md-6 col-8 mb-3">
				<div class="content">
					<div>
					<h2 class="heading">{{$pages['card_section_4'][0]->text}}</h2>
					<p class="text">{{$pages['card_section_4'][1]->text}}</p>

						<div onclick="window.location.href='{{$pages['card_section_4'][5]->link}}'" class="button-style-div"><div class="button-style-span">
						<div class="button-style-span2">{{$pages['card_section_4'][5]->text}}</div></div>
						</div>
				</div>
				</div>


			</div>
				<div class="col-lg-3 col-md-3 col-12 mb-3">
			<div class="visuals2">

				<video playsinline id="video_banner_section" class="desktop-view2  video_customize2 lazy-load" data-cursor="2" autoplay muted >
				<source data-src="{{(env('IMG_FETCH_URL').'uploaded_files/'.$pages['card_section_4'][4]->img)}}" type="video/mp4">
			</video>

			</div>



			</div>
			</div>
		</div>
	</div>
<div class="values_section desktop-view page-section" style="background:url('{{env('IMG_FETCH_URL').'uploaded_files/'.$pages['values_section'][24]->img}}'), linear-gradient(0deg,black,black);
	background-size:100%;
	background-attachment:fixed;">
	<div class="upper">
		<div class="inner">
		<center>
		<div class="col-lg-4">
		<h3 class="heading">{{$pages['values_section'][0]->text}}</h3>
		<p class="text">{{$pages['values_section'][1]->text}}</p>
		</div>
		<div class="content">
		<div class="col-lg-10 row">
			<div class="col-lg-4">
				<div class="content_upper_div" > 
					<div class="content_div">
					<div class="part2Text" data-selected="0"style="top:100px;left:-10px">
						<h4 class="text_heading">{{$pages['values_section'][2]->text}}</h4>
						<p class="text_content">{{$pages['values_section'][3]->text}}</p>
						</div>
					<div class="part1" data-img-change="{{(env('IMG_FETCH_URL').'uploaded_files/'.$pages['values_section'][20]->img)}}"data-selected="1"style="top:330px;left:-5px">
						<img style="height:110px;width:230px;"  src="{{(env('IMG_FETCH_URL').'uploaded_files/'.$pages['values_section'][4]->img)}}">
					</div>
					<div class="part2"data-selected="0" style="top:150px;left:-30px">
						
						<img src="{{(env('IMG_FETCH_URL').'uploaded_files/'.$pages['values_section'][5]->img)}}">
						
					</div>
				</div>
				<div class="content_div" style="left:200px;top:100px">
					<div class="part2Text" data-selected="0"style="top:-90px;left:-10px;">
						<h4 class="text_heading">{{$pages['values_section'][6]->text}}</h4>
						<p class="text_content">{{$pages['values_section'][7]->text}}</p>
						</div>
					<div class="part1"data-img-change="{{(env('IMG_FETCH_URL').'uploaded_files/'.$pages['values_section'][21]->img)}}"data-selected="1"style="top:130px;left:-10px">
						<img style="height:110px;width:230px;" src="{{(env('IMG_FETCH_URL').'uploaded_files/'.$pages['values_section'][8]->img)}}">
					</div>
					<div class="part2"data-selected="0" style="top:-30px;left:-30px;">
						
						<img style="height:270px;width:230px;" src="{{(env('IMG_FETCH_URL').'uploaded_files/'.$pages['values_section'][9]->img)}}">
						
					</div>
				</div>
			</div>
			</div>
			<div class="col-lg-4">
				<div class="main_content_upper_div"> 
				<div class="main_content_div">
					<div class="part24">
						<img class="part1" src="{{(env('IMG_FETCH_URL').'uploaded_files/'.$pages['values_section'][18]->img)}}">
						<img class="part2" src="{{(env('IMG_FETCH_URL').'uploaded_files/'.$pages['values_section'][19]->img)}}">
					</div>
					
				</div>
			</div>
			</div>
			<div class="col-lg-4">
				<div class="content_upper_div"> 
				<div class="content_div" style="top:100px;right:200px">
					<div class="part2Text" data-selected="0" style="top:-110px;right:-10px;">
						<h4 class="text_heading">{{$pages['values_section'][10]->text}}</h4>
						<p class="text_content">{{$pages['values_section'][11]->text}}</p>
						</div>
					<div class="part1"data-img-change="{{(env('IMG_FETCH_URL').'uploaded_files/'.$pages['values_section'][22]->img)}}"data-selected="1"style="top:125px;right:-20px">
						<img style="height:110px;width:230px;" src="{{(env('IMG_FETCH_URL').'uploaded_files/'.$pages['values_section'][12]->img)}}">
					</div>
					<div class="part2"data-selected="0" style="top:-50px;right:-50px;">
						
						<img style="height:295px;width:280px;" src="{{(env('IMG_FETCH_URL').'uploaded_files/'.$pages['values_section'][13]->img)}}">
						
					</div>
				</div>
				<div class="content_div" style="right:0;top:300px">
					<div class="part2Text" data-selected="0"style="top:-190px;right:-20px">
						<h4 class="text_heading">{{$pages['values_section'][14]->text}}</h4>
						<p class="text_content">{{$pages['values_section'][15]->text}}</p>
						</div>
					<div class="part1"data-img-change="{{(env('IMG_FETCH_URL').'uploaded_files/'.$pages['values_section'][23]->img)}}"data-selected="1"style="top:30px;right:-15px">
						<img style="height:105px;width:200px;" src="{{(env('IMG_FETCH_URL').'uploaded_files/'.$pages['values_section'][16]->img)}}">
					</div>
					<div class="part2"data-selected="0" style="top:-130px;right:-40px">
						
						<img style="height:285px;width:245px;" src="{{(env('IMG_FETCH_URL').'uploaded_files/'.$pages['values_section'][17]->img)}}">
						
					</div>
				</div>
			</div>
			</div>
		</div>
		</div>
		</center>
		</div>
			
	</div>
	</div>
<div class="values_section mobile-view" style="background:url('{{env('IMG_FETCH_URL').'uploaded_files/'.$pages['values_section'][24]->img}}'), linear-gradient(0deg,black,black);
	background-size:cover;
	background-attachment:fixed;
											   background-repeat:no-repeat">
		<div class="upper">
		<div class="inner">
		<center>
		<div class="col-8">
		<h3 class="heading">{{$pages['values_section'][0]->text}}</h3>
		<p class="text">{{$pages['values_section'][1]->text}}</p>
		</div>
		<div class="content">
		<div class="col-12">
			
				<div class="main_content_upper_div"> 
				<div class="main_content_div">
					<div class="part24">
						<img class="part1" src="{{(env('IMG_FETCH_URL').'uploaded_files/'.$pages['values_section'][18]->img)}}">
						<img class="part2" src="{{(env('IMG_FETCH_URL').'uploaded_files/'.$pages['values_section'][19]->img)}}">
					</div>
					
				</div>
			</div>
			
			<div class="col-12" style="margin-bottom:100px">
				<div class="content_upper_div" > 
					<div class="content_div">
					<div class="part2Text" data-selected="0" style="top:-70px;right:0;left:0">
						<h4 class="text_heading">{{$pages['values_section'][2]->text}}</h4>
						<p class="text_content">{{$pages['values_section'][3]->text}}</p>
						</div>
					<div class="part1"data-selected="1" data-img-change="{{(env('IMG_FETCH_URL').'uploaded_files/'.$pages['values_section'][20]->img)}}">
						<img  src="{{(env('IMG_FETCH_URL').'uploaded_files/'.$pages['values_section'][4]->img)}}">
					</div>
					<div class="part2"data-selected="0" style="top:-40px;right:0;left:0">
						
						<img src="{{(env('IMG_FETCH_URL').'uploaded_files/'.$pages['values_section'][5]->img)}}">
						
					</div>
				</div>
				<div class="content_div" >
					<div class="part2Text" data-selected="0" style="top:-70px;right:0;left:0">
						<h4 class="text_heading">{{$pages['values_section'][6]->text}}</h4>
						<p class="text_content">{{$pages['values_section'][7]->text}}</p>
						</div>
					<div class="part1"data-selected="1"data-img-change="{{(env('IMG_FETCH_URL').'uploaded_files/'.$pages['values_section'][21]->img)}}">
						<img src="{{(env('IMG_FETCH_URL').'uploaded_files/'.$pages['values_section'][8]->img)}}">
					</div>
					<div class="part2"data-selected="0" style="top:-40px;right:0;left:0">
						
						<img src="{{(env('IMG_FETCH_URL').'uploaded_files/'.$pages['values_section'][9]->img)}}">
						
					</div>
				</div>
			</div>
			</div>
			
			<div class="col-lg-12 ">
				<div class="content_upper_div"> 
				<div class="content_div">
					<div class="part2Text" data-selected="0" style="top:-30px;right:0;left:0">
						<h4 class="text_heading">{{$pages['values_section'][10]->text}}</h4>
						<p class="text_content">{{$pages['values_section'][11]->text}}</p>
						</div>
					<div class="part1"data-selected="1"data-img-change="{{(env('IMG_FETCH_URL').'uploaded_files/'.$pages['values_section'][22]->img)}}">
						<img  src="{{(env('IMG_FETCH_URL').'uploaded_files/'.$pages['values_section'][12]->img)}}">
					</div>
					<div class="part2"data-selected="0" style="top:-20px;right:0;left:0">
						
						<img src="{{(env('IMG_FETCH_URL').'uploaded_files/'.$pages['values_section'][13]->img)}}">
						
					</div>
				</div>
				<div class="content_div" >
					<div class="part2Text" data-selected="0"style="top:-30px;right:0;left:0">
						<h4 class="text_heading">{{$pages['values_section'][14]->text}}</h4>
						<p class="text_content">{{$pages['values_section'][15]->text}}</p>
						</div>
					<div class="part1"data-selected="1"data-img-change="{{(env('IMG_FETCH_URL').'uploaded_files/'.$pages['values_section'][23]->img)}}">
						<img src="{{(env('IMG_FETCH_URL').'uploaded_files/'.$pages['values_section'][16]->img)}}">
					</div>
					<div class="part2"data-selected="0" style="top:-20px;right:0;left:0">
						
						<img  src="{{(env('IMG_FETCH_URL').'uploaded_files/'.$pages['values_section'][17]->img)}}">
						
					</div>
				</div>
			</div>
			</div>
		</div>
		</div>
		</center>
		</div>
			
	</div>
	</div>

<div class="brands_section page-section">
        <center>
        <div class="inner">
            <h1 class="heading">{{$pages['brands_section'][0]->text}}</h1>
			<marquee scrollamount="10" style="display:flex">
				@foreach(extra_image("Home") as $data)
            	<img class="lazy-load" data-src="{{(env('IMG_FETCH_URL').'uploaded_files/'.$data->banner)}}">
				@endforeach




					</marquee>
        </div>
        
			
        </center>
    </div>
	

    <div class="impact_section page-section">
        <center>
		<h1 class="heading">{{$pages['impact_section'][0]->text}}</h1>
        <div class="container">
			<div class="row">
			<div class="col-lg-8">
            
            
            <div class="form">
                @include('component.contact_form')
                
            </div>
            </div>
			<div class="col-lg-4">
				<div class="waving_div">

				            <img class="lazy-load" data-src="{{(env('IMG_FETCH_URL').'uploaded_files/'.$pages['impact_section'][2]->img)}}">


			</div>
			</div>
            </div>
        </div>
			
        </center>
    </div>
<div class="brand_lower">
				
				<p><span class="impact word-change" word-remaine-time="1500" words="{{$pages['brands_section'][6]->text}}"></span></p>
				
					
			</div>
    <div class="testimonial_section page-section"style="background:url('{{(env('IMG_FETCH_URL').'uploaded_files/'.$pages["testimonial_section"][27]->img)}}');background-size:cover;background-attachment:fixed;background-position:bottom;background-repeat:no-repeat">
															<div class="upper">														   
		<div class="inner">
        <center>
        <div class="col-lg-6 col-10">
            <h1 class="heading">{{$pages["testimonial_section"][0]->text}}</h1>
            <p class="content">{{$pages["testimonial_section"][1]->text}}</p>
        </div>
        
            
            <div class="col-lg-8 col-11">
        <div class="owl-carousel">
            <div class="item">
				<div class="review">
					
					<div class="effect_layer">
                    <p class="review_content">{{$pages["testimonial_section"][2]->text}}</p>   
                    <div class="stars">
                        <i class="fa @if((int)$pages["testimonial_section"][3]->text >= 1) fa-star @else fa-star-o @endif"></i>
                        <i class="fa @if((int)$pages["testimonial_section"][3]->text >= 1) fa-star @else fa-star-o @endif"></i>
                        <i class="fa @if((int)$pages["testimonial_section"][3]->text >= 1) fa-star @else fa-star-o @endif"></i>
                        <i class="fa @if((int)$pages["testimonial_section"][3]->text >= 1) fa-star @else fa-star-o @endif"></i>
                        <i class="fa @if((int)$pages["testimonial_section"][3]->text >= 1) fa-star @else fa-star-o @endif"></i>
                    </div>
                    <div class="customer">
                        <img class="lazy-load" data-src="{{(env('IMG_FETCH_URL').'uploaded_files/'.$pages["testimonial_section"][4]->img)}}">
                        <p class="name">{{$pages["testimonial_section"][5]->text}}</p>
                        <p class="type">{{$pages["testimonial_section"][6]->text}}</p>
                    </div>
                </div>
					<div class="effect" data-clip="1" data-effect="0">
					</div>
					<div class="hover">
					</div>
                    </div>
					
            </div>
			<div class="item">
				<div class="review">
					
					<div class="effect_layer">
                    <p class="review_content">{{$pages["testimonial_section"][7]->text}}</p>   
                    <div class="stars">
                        
                        <i class="fa @if((int)$pages["testimonial_section"][8]->text >= 1) fa-star @else fa-star-o @endif"></i>
                        
                        <i class="fa @if((int)$pages["testimonial_section"][8]->text >= 1) fa-star @else fa-star-o @endif"></i>
                        <i class="fa @if((int)$pages["testimonial_section"][8]->text >= 1) fa-star @else fa-star-o @endif"></i>
                        <i class="fa @if((int)$pages["testimonial_section"][8]->text >= 1) fa-star @else fa-star-o @endif"></i>
                        <i class="fa @if((int)$pages["testimonial_section"][8]->text >= 1) fa-star @else fa-star-o @endif"></i>
                    </div>
                    <div class="customer">
                        <img class="lazy-load" data-src="{{(env('IMG_FETCH_URL').'uploaded_files/'.$pages["testimonial_section"][9]->img)}}">
                        <p class="name">{{$pages["testimonial_section"][10]->text}}</p>
                        <p class="type">{{$pages["testimonial_section"][11]->text}}</p>
                    </div>
                </div>
				<div class="effect" data-clip="1" data-effect="0">
					</div>
					<div class="hover">
					</div>
				</div>
            </div>
			<div class="item">
				<div class="review">
					
					<div class="effect_layer">
                    <p class="review_content">{{$pages["testimonial_section"][12]->text}}</p>   
                    <div class="stars">
                        
                        <i class="fa @if((int)$pages["testimonial_section"][13]->text >= 1) fa-star @else fa-star-o @endif"></i>
                        
                        <i class="fa @if((int)$pages["testimonial_section"][13]->text >= 1) fa-star @else fa-star-o @endif"></i>
                        <i class="fa @if((int)$pages["testimonial_section"][13]->text >= 1) fa-star @else fa-star-o @endif"></i>
                        <i class="fa @if((int)$pages["testimonial_section"][13]->text >= 1) fa-star @else fa-star-o @endif"></i>
                        <i class="fa @if((int)$pages["testimonial_section"][13]->text >= 1) fa-star @else fa-star-o @endif"></i>
                    </div>
                    <div class="customer">
                        <img class="lazy-load" data-src="{{(env('IMG_FETCH_URL').'uploaded_files/'.$pages["testimonial_section"][14]->img)}}">
                        <p class="name">{{$pages["testimonial_section"][15]->text}}</p>
                        <p class="type">{{$pages["testimonial_section"][16]->text}}</p>
                    </div>
                </div>
					<div class="effect" data-clip="2" data-effect="0">
					</div>
					<div class="hover">
					</div>
            </div>
            </div>
			<div class="item">
				<div class="review">
					
					<div class="effect_layer">
                    <p class="review_content">{{$pages["testimonial_section"][17]->text}}</p>   
                    <div class="stars">
                        
                        <i class="fa @if((int)$pages["testimonial_section"][18]->text >= 1) fa-star @else fa-star-o @endif"></i>
                        
                        <i class="fa @if((int)$pages["testimonial_section"][18]->text >= 1) fa-star @else fa-star-o @endif"></i>
                        <i class="fa @if((int)$pages["testimonial_section"][18]->text >= 1) fa-star @else fa-star-o @endif"></i>
                        <i class="fa @if((int)$pages["testimonial_section"][18]->text >= 1) fa-star @else fa-star-o @endif"></i>
                        <i class="fa @if((int)$pages["testimonial_section"][18]->text >= 1) fa-star @else fa-star-o @endif"></i>
                    </div>
                    <div class="customer">
                        <img class="lazy-load" data-src="{{(env('IMG_FETCH_URL').'uploaded_files/'.$pages["testimonial_section"][19]->img)}}">
                        <p class="name">{{$pages["testimonial_section"][20]->text}}</p>
                        <p class="type">{{$pages["testimonial_section"][21]->text}}</p>
                    </div>
                </div>
					<div class="effect" data-clip="1" data-effect="0">
					</div>
					<div class="hover">
					</div>
                </div>
            </div>
			<div class="item">
				<div class="review">
					
					<div class="effect_layer">
                    <p class="review_content">{{$pages["testimonial_section"][22]->text}}</p>   
                    <div class="stars">
                        
                        <i class="fa @if((int)$pages["testimonial_section"][23]->text >= 1) fa-star @else fa-star-o @endif"></i>
                        
                        <i class="fa @if((int)$pages["testimonial_section"][23]->text >= 1) fa-star @else fa-star-o @endif"></i>
                        <i class="fa @if((int)$pages["testimonial_section"][23]->text >= 1) fa-star @else fa-star-o @endif"></i>
                        <i class="fa @if((int)$pages["testimonial_section"][23]->text >= 1) fa-star @else fa-star-o @endif"></i>
                        <i class="fa @if((int)$pages["testimonial_section"][23]->text >= 1) fa-star @else fa-star-o @endif"></i>
                    </div>
                    <div class="customer">
                        <img class="lazy-load" data-src="{{(env('IMG_FETCH_URL').'uploaded_files/'.$pages["testimonial_section"][24]->img)}}">
                        <p class="name">{{$pages["testimonial_section"][25]->text}}</p>
                        <p class="type">{{$pages["testimonial_section"][26]->text}}</p>
                    </div>
                </div>
					<div class="effect" data-clip="2" data-effect="0">
					</div>
					<div class="hover">
					</div>
                </div>
            </div>
                
    
            </div>
            
        </div>
        </center>
    </div>
    </div>
    </div>


@endsection