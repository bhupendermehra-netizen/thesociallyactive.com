@extends("layouts.front_app")
@section("content")


    <div class="aboutus_section page-section">
        <center>
        <div class="col-lg-8  col-11">
            <div class="row">
                <div class="col-lg-6 col-6 section_1">
                    <div>
                    
                    <p class="heading">{{$pages["about_heading"][0]->text}}</p>
                    </div>
                </div>
                <div class="col-lg-6 col-6 section_2">
                    <div>
                    {{--<p class="sh1">{{$pages["about_heading"][1]->text}}</p>
                    <p class="sh2">{{$pages["about_heading"][2]->text}}</p>
                    <p class="sh3">{{$pages["about_heading"][3]->text}}</p>--}}
						<img src="{{(env('IMG_FETCH_URL').'uploaded_files/'.$pages["about_heading"][4]->img)}}">
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
                    <h2 class="heading">{{$pages["passion_section"][0]->text}} <span class="impact word-change" word-remaine-time="3000" words="{{$pages["passion_section"][1]->text}}"></span></h2>
                    <p class="content">{{$pages["passion_section"][2]->text}}</p>
                    </div>
                </div>
                <div class="col-lg-6 section_2">
                    <div>
                        <img src="{{(env('IMG_FETCH_URL').'uploaded_files/'.$pages['passion_section'][3]->img)}}"> 
                    </div>
                </div>
            </div>
        </div>
</center>
    </div>

<div class="founder_section page-section">
	<center>
		<h1 class="heading">{{$pages["founder_section"][0]->text}}</h1>
	<div class="col-lg-6 col-md-8">
		<div class="row">
			<div class="col-lg-6 col-md-6 col-6">
				<div class="content"data-selected="1">
					<img src="{{(env('IMG_FETCH_URL').'uploaded_files/'.$pages['founder_section'][1]->img)}}">
				</div>
				<div class="content2" data-selected="0">
					<div class="inner">
					<div>
					<h3 class="title">{{$pages["founder_section"][2]->text}}</h3>
					<p class="position">{{$pages["founder_section"][3]->text}}</p>
						<div class="links">
							<a href="{{$pages["founder_section"][7]->link}}"><i class="fa fa-linkedin"></i></a>
							<a href="{{$pages["founder_section"][8]->link}}"><i class="fa fa-link"></i></a>
					</div>
					</div>
				</div>
			</div>
			</div>
			<div class="col-lg-6 col-md-6 col-6">
				<div class="content"data-selected="1">
					<img src="{{(env('IMG_FETCH_URL').'uploaded_files/'.$pages['founder_section'][4]->img)}}">
				</div>
				<div class="content2" data-selected="0">
					<div class="inner">
					<div>
					<h3 class="title">{{$pages["founder_section"][5]->text}}</h3>
					<p class="position">{{$pages["founder_section"][6]->text}}</p>
						<div class="links">
							<a href="{{$pages["founder_section"][9]->link}}"><i class="fa fa-linkedin"></i></a>
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
			<img class="img1" src="{{asset('assets/images/story/Group 1000001799.png')}}">
			<div class="content1_inner">
			<p class="text">Two sds.Different paths. Same itch.</p>
			<img class="img2 moving_animate" src="{{asset('assets/images/story/Groups-2.png')}}">	
			</div>
		</div>
		<div class="extra_space">
			
		</div>
		<div class="content_upper">
		<div class="col-8 content3">
			<p class="text">I want to do something big</p>
			<img class="img1" src="{{asset('assets/images/story/Group 1000001800.png')}}">
			
			
		</div>
		</div>
		<div class="content_4_upper">
		<div class="col-8 content4">
			<center>
			<p class="text">The kind that spreadsheets, small
talk, and endless email threads
 just couldn't scratch.</p>
			<div class="inner">
			<img class="img1" src="{{asset('assets/images/story/Groups-1.png')}}">
			<img class="img2 moving_animate" src="{{asset('assets/images/story/Groups.png')}}">
			</div>
			<p class="text2">I am tired of working for someone else</p>
			
			</center>
			
		</div>
			<img class="img3" src="{{asset('assets/images/story/Group 1000001801.png')}}">	
		</div>
		
	</div>
	</center>
</div>
<div class="our_story_section page-section">
	<center>
	<div class="col-lg-10">
		<center>
		<div class="col-10 content5">
			<p class="text"> We came from different worlds, but we found  ourselves in the same place</p>
			<img class="img1" src="{{asset('assets/images/story/Vector-3.png')}}">
			
			
			<img class="img2 " src="{{asset('assets/images/story/Group 1000001803.png')}}">	
			
		</div>
			<div class="col-10 content6">
			
			
			
			
			<img class="img2" src="{{asset('assets/images/story/Group 1000001802.png')}}">	
				<img class="img1 moving_animate" src="{{asset('assets/images/story/Vector-2.png')}}">
				<p class="text">Caught up in a
loop of calendar invites, polite small talk, and work that felt…hollow</p>
			
		</div>
		
	</center>
	</div>
	</center>
</div>
<div class="our_story_section page-section">
	<center>
	<div class="col-lg-10">
		<center>
		<div class="col-10 content7">
			<div class="inner">
			<p class="text">Then came the moment. 
Not loud, not dramatic. Just a
quiet realization during a late
night and a lukewarm cup of
coffee</p>
				<img class="img1 moving_animate" src="{{asset('assets/images/story/Groups-5.png')}}">
			</div>
			
			
			
			<img class="img2" src="{{asset('assets/images/story/Group 1000001804.png')}}">	
			
		</div>
			<div class="col-10 content8">
				<img class="img2" src="{{asset('assets/images/story/Group 1000001805.png')}}">	
			<div class="inner">
			
				<img class="img1 moving_animate" src="{{asset('assets/images/story/Vector.png')}}">
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
<div class="our_story_section page-section">
	<center>
	<div class="col-lg-10">
		<center>
		<div class="col-10 content5">
			<p class="text">That question lit a spark We didn’t have it all figured out — just a
crazy idea, a shared belief in each other, and the courage to
begin.</p>
			<img class="img1 moving_animate" src="{{asset('assets/images/story/Vector-3.png')}}">
			
			
			<img class="img2" src="{{asset('assets/images/story/Group 1000001806.png')}}">	
			
		</div>
			<div class="col-10 content6">
			
			
			
			
			<img class="img2" src="{{asset('assets/images/story/Group 1000001802.png')}}">	
				<img class="img1 moving_animate" src="{{asset('assets/images/story/Vector-2.png')}}">
				<p class="text">And so,
The Socially Active
came to life.</p>
			
		</div>
		
	</center>
	</div>
	</center>
</div>
<div class="our_story_section page-section">
	<center>
	<div class="col-lg-10">
		<center>
		<div class="col-10 content7">
			<div class="inner">
			<p class="text">Not just as a business plan, but as a promise To create space for brave brands, bold ideas, and the kind of work that makes people feel something.</p>
				<img class="img1 moving_animate" src="{{asset('assets/images/story/Groups-5.png')}}">
			</div>
			
			
			
			<img class="img2" src="{{asset('assets/images/story/Group 1000001804.png')}}">	
			
		</div>
			<div class="col-10 content8">
				<img class="img2" src="{{asset('assets/images/story/Group 1000001805.png')}}">	
			<div class="inner">
			
				<img class="img1 moving_animate" src="{{asset('assets/images/story/Vector.png')}}">
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
		<h1 class="heading">{{$pages["story_section"][0]->text}}</h1>
	
	<img src="{{(env('IMG_FETCH_URL').'uploaded_files/'.$pages['story_section'][1]->img)}}">
	<img src="{{(env('IMG_FETCH_URL').'uploaded_files/'.$pages['story_section'][2]->img)}}">
	<img src="{{(env('IMG_FETCH_URL').'uploaded_files/'.$pages['story_section'][3]->img)}}">
	<img src="{{(env('IMG_FETCH_URL').'uploaded_files/'.$pages['story_section'][4]->img)}}">
	<img src="{{(env('IMG_FETCH_URL').'uploaded_files/'.$pages['story_section'][5]->img)}}">
	
</div>
--}}
    

        
@endsection