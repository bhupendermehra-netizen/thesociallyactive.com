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

		<div class="content">

			<div class="col-lg-10">
				<center>
					@php
						$heading = explode(";", (isset($pages['home_banner'][1]) ? $pages['home_banner'][1]->text : ''));
					@endphp
					<h1 class="heading desktop-view" style="position:relative">
						<span class="bhe4">{{$heading[0]}}</span><br> <span class="bhe1">{{$heading[1]}}</span><br> <span
							class="bhe2" style="">{{$heading[2]}}</span> <span class="bhe3" style="">{{$heading[3]}}</span>
					</h1>
					<h1 class="heading mobile-view" style="position:relative">
						<span class="bhe4">{{$heading[0]}}</span><span class="bhe1">{{$heading[1]}}</span><br> <span
							class="bhe2" style="">{{$heading[2]}}</span> <span class="bhe3" style="">{{$heading[3]}}</span>
					</h1>
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
			<video playsinline muted class="video_customize2 lazy-load" data-cursor="2" data-played-once="0"
				referrerpolicy="no-referrer-when-downgrade">
				<source
					data-src="{{(env('IMG_FETCH_URL') . 'uploaded_files/' . (isset($pages['home_banner'][3]) ? $pages['home_banner'][3]->img : ''))}}"
					type="video/mp4">
			</video>

		</div>
	</div>

	<div class="passion_section page-section" style="background:url('{{(env('IMG_FETCH_URL') . 'uploaded_files/' . (isset($pages['about_section'][4]) ? $pages['about_section'][4]->img : ''))}}'), linear-gradient(0deg,black,black);
					background-size:contain;
					background-position:right;
					background-repeat:no-repeat;">





		<center>
			<h2 class="heading">{{(isset($pages['about_section'][6]) ? $pages['about_section'][6]->text : '')}}</h2>
			<div class="col-lg-8 col-11 p-4">
				<div class="row">
					<div class="col-lg-6 section_2">
						<div>
							<img class="pointer_change_1"
								src="{{(env('IMG_FETCH_URL') . 'uploaded_files/' . (isset($pages['about_section'][5]) ? $pages['about_section'][5]->img : ''))}}">
						</div>
					</div>
					<div class="col-lg-6 section_1">
						<div>
							<h2 class="heading">
								{{(isset($pages['about_section'][0]) ? $pages['about_section'][0]->text : '')}}<br> <span
									class="impact word-change" word-remaine-time="1500"
									words="{{(isset($pages['about_section'][1]) ? $pages['about_section'][1]->text : '')}}"></span>
							</h2>
							<p class="content">
								{{(isset($pages['about_section'][2]) ? $pages['about_section'][2]->text : '')}}</p>
							<div onclick="window.location.href='{{(isset($pages['about_section'][3]) ? (isset($pages['about_section'][3]) ? $pages['about_section'][3]->link : '#') : '#')}}'"
								class="button-style-div">
								<div class="button-style-span">
									<div class="button-style-span2">
										{{(isset($pages['about_section'][3]) ? $pages['about_section'][3]->text : '')}}
									</div>
								</div>
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

				<h4 class="heading">{{(isset($pages['who_we_are'][0]) ? $pages['who_we_are'][0]->text : '') ?? ''}}</h4>
				<p class="sub-heading">{{(isset($pages["who_we_are"][1]) ? $pages["who_we_are"][1]->text : '') ?? ''}}</p>

				<div class="video_section_outer mb-4 col-lg-10">
					<div class="video_section">
						<div class="video_div" data-selected="-1" data-id="0">
							<video playsinline autoplay loop muted class="lazy-load">
								<source
								data-src="{{(env('IMG_FETCH_URL') . 'uploaded_files/' . (isset($pages['who_we_are'][2]) ? $pages['who_we_are'][2]->img : ''))}}"

									type="video/mp4">
							</video>
						</div>
						<div class="video_div" data-selected="0" data-id="1">
							<video playsinline autoplay loop muted class="lazy-load">
								<source
								data-src="{{(env('IMG_FETCH_URL') . 'uploaded_files/' . (isset($pages['who_we_are'][3]) ? $pages['who_we_are'][3]->img : ''))}}"

									type="video/mp4">
							</video>
						</div>
						<div class="video_div" data-selected="1" data-id="2">
							<video playsinline autoplay loop muted class="lazy-load">
								<source
									data-src="{{(env('IMG_FETCH_URL') . 'uploaded_files/' . (isset($pages['who_we_are'][4]) ? $pages['who_we_are'][4]->img : ''))}}"
									type="video/mp4">
							</video>
						</div>
						<div class="video_div" data-selected="2" data-id="3">
							<video playsinline autoplay loop muted class="lazy-load">
								<source
								data-src="{{(env('IMG_FETCH_URL') . 'uploaded_files/' . (isset($pages['who_we_are'][5]) ? $pages['who_we_are'][5]->img : ''))}}"
									type="video/mp4">
							</video>
						</div>
						<div class="video_div" data-selected="3" data-id="4">
							<video playsinline autoplay loop muted class="lazy-load">
								<source
								data-src="{{(env('IMG_FETCH_URL') . 'uploaded_files/' . (isset($pages['who_we_are'][6]) ? $pages['who_we_are'][6]->img : ''))}}"
									type="video/mp4">
							</video>
						</div>
						<div class="navigate-arrows">

							<div class="inner">
								<button type="button" class="video_section_previous"><img
										src="{{asset('uploaded_files/image/main_files2/paginate/prev_arrow.svg')}}"></button>
										

								<button type="button" class="video_section_next"><img
										src="{{asset('uploaded_files/image/main_files2/paginate/next_arrow.svg')}}"></button>

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
		<img class="bulb-effect before lazy-load"
			data-src="{{(env('IMG_FETCH_URL') . 'uploaded_files/' . (isset($pages['who_we_help'][1]) ? $pages['who_we_help'][1]->img : ''))}}">
		<img class="bulb-effect after lazy-load"
			data-src="{{(env('IMG_FETCH_URL') . 'uploaded_files/' . (isset($pages['who_we_help'][15]) ? $pages['who_we_help'][15]->img : ''))}}">
		<div class="inner">
			<div class="container">
				<h3 class="heading">{{(isset($pages['who_we_help'][0]) ? $pages['who_we_help'][0]->text : '')}}</h3>
				<div class="content">
					<div class="row">
						<div class="col-lg-4 col-md-6 mb-3">
							<div class="content_div">
								<img class="part1 lazy-load"
									data-src="{{(env('IMG_FETCH_URL') . 'uploaded_files/' . (isset($pages['who_we_help'][4]) ? $pages['who_we_help'][4]->img : ''))}}"
									data-selected="1">
								<img class="part2 lazy-load"
									data-src="{{(env('IMG_FETCH_URL') . 'uploaded_files/' . (isset($pages['who_we_help'][5]) ? $pages['who_we_help'][5]->img : ''))}}"
									data-selected="0">
								<h4 class="content_heading">
									{{(isset($pages['who_we_help'][2]) ? $pages['who_we_help'][2]->text : '')}}</h4>
								<p class="content_text">
									{{(isset($pages['who_we_help'][3]) ? $pages['who_we_help'][3]->text : '')}}</p>
							</div>
						</div>
						<div class="col-lg-4 col-md-6 mb-3">
							<div class="content_div">
								<img class="part1 lazy-load"
									data-src="{{(env('IMG_FETCH_URL') . 'uploaded_files/' . (isset($pages['who_we_help'][8]) ? $pages['who_we_help'][8]->img : ''))}}"
									data-selected="1">
								<img class="part2 lazy-load"
									data-src="{{(env('IMG_FETCH_URL') . 'uploaded_files/' . (isset($pages['who_we_help'][9]) ? $pages['who_we_help'][9]->img : ''))}}"
									data-selected="0">
								<h4 class="content_heading">
									{{(isset($pages['who_we_help'][6]) ? $pages['who_we_help'][6]->text : '')}}</h4>
								<p class="content_text">
									{{(isset($pages['who_we_help'][7]) ? $pages['who_we_help'][7]->text : '')}}</p>
							</div>
						</div>
						<div class="col-lg-4 col-md-6 mb-3">
							<div class="content_div">
								<img class="part1 lazy-load"
									data-src="{{(env('IMG_FETCH_URL') . 'uploaded_files/' . (isset($pages['who_we_help'][12]) ? $pages['who_we_help'][12]->img : ''))}}"
									data-selected="1">
								<img class="part2 lazy-load"
									data-src="{{(env('IMG_FETCH_URL') . 'uploaded_files/' . (isset($pages['who_we_help'][13]) ? $pages['who_we_help'][13]->img : ''))}}"
									data-selected="0">
								<h4 class="content_heading">
									{{(isset($pages['who_we_help'][10]) ? $pages['who_we_help'][10]->text : '')}}</h4>
								<p class="content_text">
									{{(isset($pages['who_we_help'][11]) ? $pages['who_we_help'][11]->text : '')}}</p>
							</div>
						</div>
					</div>
				</div>
			</div>


			<br><br>
			<div class="bottom-div">
				<img class="part1" src="{{asset('assets/images/who_we_are_icon.png')}}" data-selected="1">
				<div class="part2" data-selected="0">
					<div class="inner">
						<div class="box1"></div>
						<p>{{(isset($pages['who_we_help'][14]) ? $pages['who_we_help'][14]->text : '')}}</p>
						<div class="box2"></div>

					</div>
				</div>
			</div>

		</div>
	</div>
	<div class="outer_video_section page-section">
		<div class="inner">


			<video playsinline class="video_customize2 lazy-load" autoplay muted data-cursor="2">
				<source
					data-src="{{(env('IMG_FETCH_URL') . 'uploaded_files/' . (isset($pages['video_section'][0]) ? $pages['video_section'][0]->img : ''))}}">
			</video>

		</div>
	</div>



    {{-- OUR EXPERTISE & SERVICES --}}
    <div id="gsap-card-section" class="page-section">
        <style>
            #gsap-card-section {
                position: sticky;
                top: 0;
                width: 100%;
                background: #DAF301;
                opacity: 1 !important;
                margin-bottom: 0;
                padding-bottom: 0;
                z-index: 1;
            }

            #gsap-card-inner {
                position: relative;
                width: 100%;
                background: #DAF301;
                overflow: hidden;
                display: flex;
                flex-direction: column;
                align-items: center;
                justify-content: center;
                padding-bottom: 120px;
            }

            .gsap-heading {
                text-align: center;
                user-select: none;
            }










            .gsap-heading .sub-label {
                display: block;
                font-size: 13px;
                letter-spacing: 0.18em;
                color: #444;
                margin-bottom: 10px;
                opacity: 0;
            }

            .gsap-heading .char {
                display: inline-block;
                font-size: clamp(28px, 5vw, 60px);
                font-weight: 800;
                color: #111;
                opacity: 0;
                transform: translateY(60px);
            }

    .sweep-heading {
        position: relative;
        display: inline-block;
        font-size: clamp(28px, 4vw, 48px);
        font-weight: 800;
        color: #ffffff;
        line-height: 2;
    }
    @media (max-width: 768px) {
        .sweep-heading {
            font-size: clamp(14px, 5.5vw, 24px) !important;
            line-height: 1.5 !important;
        }
    }
    .sweep-heading .text-base {
        position: relative;
        z-index: 1;
        white-space: nowrap;
    }
    /* White fill layer — clip-path driven by scroll */
    .sweep-heading .fill-layer {
        position: absolute;
        inset: 0;
        z-index: 2;
        color: #000000;
        overflow: hidden;
        clip-path: inset(0 100% 0 0); /* fully hidden at start */
        white-space: nowrap;
        pointer-events: none;
    }

            .gsap-card-stack {
                position: relative;
                width: 100%;
                max-width: 1200px;
                height: 380px;
                display: flex;
                align-items: center;
                justify-content: center;
            }

            .gsap-card {
                position: absolute;
                width: 260px;
                height: 380px;
                cursor: pointer;
            }

            .card-inner {
                position: relative;
                width: 100%;
                height: 100%;
                transform-style: preserve-3d;
            }

            .card-front,
            .card-back {
                position: absolute;
                width: 100%;
                height: 100%;
                backface-visibility: hidden;
                border-radius: 16px;
                overflow: hidden;
            }

            .card-front img,
            .card-back img {
                width: 100%;
                height: 100%;
                object-fit: fill;
            }

            .card-back { transform: rotateY(180deg); }

            .gsap-card-1 { z-index: 4; }
            .gsap-card-2 { z-index: 3; }
            .gsap-card-3 { z-index: 2; }
            .gsap-card-4 { z-index: 1; }

            @media (max-width: 768px) {
                .gsap-card { width: 90px; height: 135px; }
                .gsap-card-stack { height: 135px; }
                .sweep-heading { font-size: clamp(22px, 7vw, 40px); }
            }
        </style>

        <div id="gsap-card-inner">

            <div class="gsap-heading">
				<div class="sweep-heading" id="sweepHeading">
					<span class="text-base">OUR EXPERTISE &amp; SERVICES</span>
					<span class="fill-layer" id="sweepFillLayer">OUR EXPERTISE &amp; SERVICES</span>
				</div>
			</div>

            <div class="gsap-card-stack">
                @foreach([1,2,3,4] as $i)
                <div class="gsap-card gsap-card-{{ $i }}">
                    <div class="card-inner">
                        <div class="card-front">
                            <img src="{{ asset('admin/assets/img/card/card'.$i.'front.webp') }}" alt="Front {{ $i }}">
                        </div>
                        <div class="card-back">
                            <img src="{{ asset('admin/assets/img/card/card'.$i.'back.webp') }}" alt="Back {{ $i }}">
                        </div>
                    </div>
                </div>
                @endforeach
            </div>

        </div>

        <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/gsap.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/ScrollTrigger.min.js"></script>
        <script>
        document.addEventListener('DOMContentLoaded', function () {
            if (typeof gsap === 'undefined') return;
            gsap.registerPlugin(ScrollTrigger);
            // ScrollTrigger.normalizeScroll(true);

            gsap.set('.gsap-card', {
                xPercent: -50,
                yPercent: -50,
                left: '50%',
                top: '50%'
            });

            var floatAnim = null;

            function startFloating() {
                if (floatAnim) return;
                floatAnim = gsap.to('.gsap-card', {
                    y: 16, duration: 2, repeat: -1, yoyo: true,
                    ease: 'sine.inOut',
                    stagger: { each: 0.2, from: 'start' }
                });
            }
            function stopFloating() {
                if (!floatAnim) return;
                floatAnim.kill();
                floatAnim = null;
                gsap.to('.gsap-card', { y: 0, duration: 0.4, ease: 'power2.out' });
            }

            var tl = gsap.timeline({
                scrollTrigger: {
                    trigger: '.gsap-card-stack',
                    start: 'top 10%',
                    end: 'bottom top',
                    scrub: 1.5,
                    onUpdate: function(self) {
                        if (self.progress > 0.45) startFloating();
                        else stopFloating();
                    },
                    onLeave: function() { stopFloating(); },
                    onLeaveBack: function() { stopFloating(); }
                }
            });

            tl.to('.gsap-card-1', { x: '-32vw', rotation: -8, ease: 'power1.inOut' }, 0)
              .to('.gsap-card-2', { x: '-11vw', rotation: -3, ease: 'power1.inOut' }, 0)
              .to('.gsap-card-3', { x:  '11vw', rotation:  3, ease: 'power1.inOut' }, 0)
              .to('.gsap-card-4', { x:  '32vw', rotation:  8, ease: 'power1.inOut' }, 0);

            tl.to('.card-inner', {
                rotationY: 180,
                duration: 1,
                stagger: 0.18,
                ease: 'back.out(1.2)'
            }, '>-0.1');

            tl.to('#sweepFillLayer', {
                clipPath: 'inset(0 0% 0 0)',
                duration: 0.8,
                ease: 'power1.inOut'
            }, 0);

            // Post-card section reveal
            gsap.utils.toArray('.brand_strategy_section').forEach(function(section, i) {
                var startVal = i === 3 ? 'top 70%' : 'top 80%';
                gsap.from(section, {
                    opacity: 0,
                    y: 40,
                    duration: 0.7,
                    scrollTrigger: {
                        trigger: section,
                        start: startVal,
                        toggleActions: 'play none none reverse'
                    }
                });
            });
        });
        </script>
    </div>

    {{-- OUR EXPERTISE & SERVICES end  --}}


    <!-- Section 1 -->
    <div class="brand_strategy_section page-section" data-id="1" style="top: 31%; transition: top 0.4s cubic-bezier(0.25, 0.46, 0.45, 0.94); opacity: 1;">
        <div class="col-11">
            <div class="row">
                <div class="col-lg-3 col-md-3 col-4 mb-3">
                    <div class="visuals">
                        <img class="main-image desktop-view2 lazy-load loaded" data-selected="1" src="{{ env('IMG_FETCH_URL') . 'uploaded_files/' . (isset($pages['card_section_1'][2]) ? $pages['card_section_1'][2]->img : '') }}">
                        <img class="main-image_2 desktop-view2 lazy-load loaded" data-selected="0" src="{{ env('IMG_FETCH_URL') . 'uploaded_files/' . (isset($pages['card_section_1'][3]) ? $pages['card_section_1'][3]->img : '') }}">
                        <video playsinline="" class="mobile-view2 video_customize2 lazy-load" data-cursor="2" autoplay muted loop>
                            <source data-src="{{ env('IMG_FETCH_URL') . 'uploaded_files/' . (isset($pages['card_section_1'][4]) ? $pages['card_section_1'][4]->img : '') }}" type="video/mp4">
                        </video>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6 col-8 mb-3">
                    <div class="content">
                        <div>
                            <h2 class="heading" style="color: transparent; background: linear-gradient(90deg, rgb(218, 243, 1) 241.135%, rgba(255, 255, 255, 0.9) 0%) text;">
                                Photography & Videography Solutions</h2>
                            <p class="text">
                                We specialize in branded visual content that commands attention and drives results. From fashion and bridal campaigns to reels, photography, and full-scale brand films, our creative production blends artistry with performance for digital-first impact. We make your brand seen, felt, and remembered.</p>
                            <div onclick="window.location.href='#'" class="button-style-div">
                                <div class="button-style-span">
                                    <div class="button-style-span2">Learn More</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-3 col-12 mb-3 desktop-view2">
                    <div class="visuals2">
                        <video playsinline="" class="desktop-view2 video_customize2 lazy-load loaded" data-cursor="2" autoplay muted loop>
                            <source data-src="{{ env('IMG_FETCH_URL') . 'uploaded_files/' . (isset($pages['card_section_1'][4]) ? $pages['card_section_1'][4]->img : '') }}" type="video/mp4" src="{{ env('IMG_FETCH_URL') . 'uploaded_files/' . (isset($pages['card_section_1'][4]) ? $pages['card_section_1'][4]->img : '') }}">
                        </video>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Section 2 -->
    <div class="brand_strategy_section page-section" data-id="2" style="top: 46%; transition: top 0.4s cubic-bezier(0.25, 0.46, 0.45, 0.94); opacity: 1;">
        <div class="col-11">
            <div class="row">
                <div class="col-lg-3 col-md-3 col-4 mb-3">
                    <div class="visuals">
                        <img class="main-image desktop-view2 lazy-load loaded" data-selected="1" src="{{ env('IMG_FETCH_URL') . 'uploaded_files/' . (isset($pages['card_section_2'][2]) ? $pages['card_section_2'][2]->img : '') }}">
                        <img class="main-image_2 desktop-view2 lazy-load" data-src="{{ env('IMG_FETCH_URL') . 'uploaded_files/' . (isset($pages['card_section_2'][3]) ? $pages['card_section_2'][3]->img : '') }}" data-selected="0">
                        <video playsinline="" class="mobile-view2 video_customize2 lazy-load" data-cursor="2" autoplay muted loop>
                            <source data-src="{{ env('IMG_FETCH_URL') . 'uploaded_files/' . (isset($pages['card_section_2'][4]) ? $pages['card_section_2'][4]->img : '') }}" type="video/mp4">
                        </video>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6 col-8 mb-3">
                    <div class="content">
                        <div>
                            <h2 class="heading" style="color: transparent; background: linear-gradient(90deg, rgb(218, 243, 1) 199.527%, rgba(255, 255, 255, 0.9) 0%) text;">
                                BRAND STRATEGY & ADVISORY DIVISION</h2>
                            <p class="text">
                                We specialize in building brands that stand out and scale with purpose. From defining your core positioning and brand voice to crafting strategic narratives and market differentiation, we align creativity with business goals to create lasting impact. Our approach blends insight, storytelling, and sharp strategy to ensure your brand is not just seen but understood, trusted, and chosen.</p>
                            <div onclick="window.location.href='#'" class="button-style-div">
                                <div class="button-style-span">
                                    <div class="button-style-span2">Learn More</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-3 col-12 mb-3">
                    <div class="visuals2">
                        <video playsinline="" class="desktop-view2 video_customize2 lazy-load loaded" data-cursor="2" autoplay muted loop>
                            <source data-src="{{ env('IMG_FETCH_URL') . 'uploaded_files/' . (isset($pages['card_section_2'][4]) ? $pages['card_section_2'][4]->img : '') }}" type="video/mp4" src="{{ env('IMG_FETCH_URL') . 'uploaded_files/' . (isset($pages['card_section_2'][4]) ? $pages['card_section_2'][4]->img : '') }}">
                        </video>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Section 3 -->
    <div class="brand_strategy_section page-section" data-id="3" style="top: 61%; transition: top 0.4s cubic-bezier(0.25, 0.46, 0.45, 0.94); opacity: 1;">
        <div class="col-11">
            <div class="row">
                <div class="col-lg-3 col-md-3 col-4 mb-3">
                    <div class="visuals">
                        <img class="main-image desktop-view2 lazy-load loaded" data-selected="1" src="{{ env('IMG_FETCH_URL') . 'uploaded_files/' . (isset($pages['card_section_3'][2]) ? $pages['card_section_3'][2]->img : '') }}">
                        <img class="main-image_2 desktop-view2 lazy-load" data-src="{{ env('IMG_FETCH_URL') . 'uploaded_files/' . (isset($pages['card_section_3'][3]) ? $pages['card_section_3'][3]->img : '') }}" data-selected="0">
                        <video playsinline="" class="mobile-view2 video_customize2 lazy-load" data-cursor="2" autoplay muted loop>
                            <source data-src="{{ env('IMG_FETCH_URL') . 'uploaded_files/' . (isset($pages['card_section_3'][4]) ? $pages['card_section_3'][4]->img : '') }}" type="video/mp4">
                        </video>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6 col-8 mb-3">
                    <div class="content">
                        <div>
                            <h2 class="heading" style="color: transparent; background: linear-gradient(90deg, rgb(218, 243, 1) 102.679%, rgba(255, 255, 255, 0.9) 0%) text;">
                                SOCIAL MEDIA & WEB SOLUTIONS</h2>
                            <p class="text">
                                We specialize in end-to-end social media and web solutions that build a powerful digital presence. From strategic content planning and platform management to immersive, high-performing website development, we create seamless brand experiences across touchpoints. Our approach blends creativity, technology, and performance to ensure your brand not only looks exceptional but engages, converts, and grows consistently.</p>
                            <div onclick="window.location.href='#'" class="button-style-div">
                                <div class="button-style-span">
                                    <div class="button-style-span2">Learn More</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-3 col-12 mb-3">
                    <div class="visuals2">
                        <video playsinline="" class="desktop-view2 video_customize2 lazy-load loaded" data-cursor="2" autoplay muted loop>
                            <source data-src="{{ env('IMG_FETCH_URL') . 'uploaded_files/' . (isset($pages['card_section_3'][4]) ? $pages['card_section_3'][4]->img : '') }}" type="video/mp4" src="{{ env('IMG_FETCH_URL') . 'uploaded_files/' . (isset($pages['card_section_3'][4]) ? $pages['card_section_3'][4]->img : '') }}">
                        </video>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Section 4 -->
    <div class="brand_strategy_section page-section" data-id="4" style="top: 76%; transition: top 0.4s cubic-bezier(0.25, 0.46, 0.45, 0.94); opacity: 1;">
        <div class="col-11">
            <div class="row">
                <div class="col-lg-3 col-md-3 col-4 mb-3">
                    <div class="visuals">
                        <img class="main-image desktop-view2 lazy-load loaded" data-selected="1" src="{{ env('IMG_FETCH_URL') . 'uploaded_files/' . (isset($pages['card_section_4'][2]) ? $pages['card_section_4'][2]->img : '') }}">
                        <img class="main-image_2 desktop-view2 lazy-load loaded" data-selected="0" src="{{ env('IMG_FETCH_URL') . 'uploaded_files/' . (isset($pages['card_section_4'][3]) ? $pages['card_section_4'][3]->img : '') }}">
                        <video playsinline="" class="mobile-view2 video_customize2 lazy-load" data-cursor="2" autoplay muted loop>
                            <source data-src="{{ env('IMG_FETCH_URL') . 'uploaded_files/' . (isset($pages['card_section_4'][4]) ? $pages['card_section_4'][4]->img : '') }}" type="video/mp4">
                        </video>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6 col-8 mb-3">
                    <div class="content">
                        <div>
                            <h2 class="heading" style="color: transparent; background: linear-gradient(90deg, rgb(218, 243, 1) 2.67931%, rgba(255, 255, 255, 0.9) 0%) text;">
                                INFLUENCER & CREATOR MANAGEMENT</h2>
                            <p class="text">
                                We specialize in influencer and creator management that drives authentic engagement and measurable impact. From identifying the right talent and building meaningful collaborations to managing campaigns end-to-end, we align creators with your brand's voice and goals. Our approach blends strategy, relationships, and performance to ensure every partnership feels genuine, reaches the right audience, and delivers real results.</p>
                            <div onclick="window.location.href='#'" class="button-style-div">
                                <div class="button-style-span">
                                    <div class="button-style-span2" style="background: transparent; left: 0px; top: 0px; color: white;">Learn More</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-3 col-12 mb-3">
                    <div class="visuals2">
                        <video playsinline="" class="desktop-view2 video_customize2 lazy-load loaded" data-cursor="2" autoplay muted loop>
                            <source data-src="{{ env('IMG_FETCH_URL') . 'uploaded_files/' . (isset($pages['card_section_4'][4]) ? $pages['card_section_4'][4]->img : '') }}" type="video/mp4" src="{{ env('IMG_FETCH_URL') . 'uploaded_files/' . (isset($pages['card_section_4'][4]) ? $pages['card_section_4'][4]->img : '') }}">
                        </video>
                    </div>
                </div>
            </div>
        </div>
    </div>


	<div class="values_section desktop-view page-section" style="background:url('{{env('IMG_FETCH_URL') . 'uploaded_files/' . (isset($pages['values_section'][24]) ? $pages['values_section'][24]->img : '')}}'), linear-gradient(0deg,black,black);
					background-size:100%;
					background-attachment:fixed;">
		<div class="upper">
			<div class="inner">
				<center>
					<div class="col-lg-4">
						<h3 class="heading">
							{{(isset($pages['values_section'][0]) ? $pages['values_section'][0]->text : '')}}</h3>
						<p class="text">{{(isset($pages['values_section'][1]) ? $pages['values_section'][1]->text : '')}}
						</p>
					</div>
					<div class="content">
						<div class="col-lg-10 row">
							<div class="col-lg-4">
								<div class="content_upper_div">
									<div class="content_div">
										<div class="part2Text" data-selected="0" style="top:100px;left:-10px">
											<h4 class="text_heading">
												{{(isset($pages['values_section'][2]) ? $pages['values_section'][2]->text : '')}}
											</h4>
											<p class="text_content">
												{{(isset($pages['values_section'][3]) ? $pages['values_section'][3]->text : '')}}
											</p>
										</div>
										<div class="part1"
											data-img-change="{{(env('IMG_FETCH_URL') . 'uploaded_files/' . (isset($pages['values_section'][20]) ? $pages['values_section'][20]->img : ''))}}"
											data-selected="1" style="top:330px;left:-5px">
																						{!! render_media(($pages['values_section'][4]->img ?? ''), 'style="height:110px;width:230px;"') !!}
																					</div>
																					<div class="part2" data-selected="0" style="top:150px;left:-30px">

																						{!! render_media(($pages['values_section'][5]->img ?? '')) !!}

										</div>
									</div>
									<div class="content_div" style="left:200px;top:100px">
										<div class="part2Text" data-selected="0" style="top:-90px;left:-10px;">
											<h4 class="text_heading">
												{{(isset($pages['values_section'][6]) ? $pages['values_section'][6]->text : '')}}
											</h4>
											<p class="text_content">
												{{(isset($pages['values_section'][7]) ? $pages['values_section'][7]->text : '')}}
											</p>
										</div>
										<div class="part1"
											data-img-change="{{(env('IMG_FETCH_URL') . 'uploaded_files/' . (isset($pages['values_section'][21]) ? $pages['values_section'][21]->img : ''))}}"
											data-selected="1" style="top:130px;left:-10px">
																						{!! render_media(($pages['values_section'][8]->img ?? ''), 'style="height:110px;width:230px;"') !!}
																					</div>
																					<div class="part2" data-selected="0" style="top:-30px;left:-30px;">

																						{!! render_media(($pages['values_section'][9]->img ?? ''), 'style="height:270px;width:230px;"') !!}

										</div>
									</div>
								</div>
							</div>
							<div class="col-lg-4">
								<div class="main_content_upper_div">
									<div class="main_content_div">
										<div class="part24">
											{!! render_media(($pages['values_section'][18]->img ?? ''), 'class="part1"') !!}
											{!! render_media(($pages['values_section'][19]->img ?? ''), 'class="part2"') !!}
										</div>

									</div>
								</div>
							</div>
							<div class="col-lg-4">
								<div class="content_upper_div">
									<div class="content_div" style="top:100px;right:200px">
										<div class="part2Text" data-selected="0" style="top:-110px;right:-10px;">
											<h4 class="text_heading">
												{{(isset($pages['values_section'][10]) ? $pages['values_section'][10]->text : '')}}
											</h4>
											<p class="text_content">
												{{(isset($pages['values_section'][11]) ? $pages['values_section'][11]->text : '')}}
											</p>
										</div>
										<div class="part1"
											data-img-change="{{(env('IMG_FETCH_URL') . 'uploaded_files/' . (isset($pages['values_section'][22]) ? $pages['values_section'][22]->img : ''))}}"
											data-selected="1" style="top:125px;right:-20px">
																						{!! render_media(($pages['values_section'][12]->img ?? ''), 'style="height:110px;width:230px;"') !!}
																					</div>
																					<div class="part2" data-selected="0" style="top:-50px;right:-50px;">

																						{!! render_media(($pages['values_section'][13]->img ?? ''), 'style="height:295px;width:280px;"') !!}

										</div>
									</div>
									<div class="content_div" style="right:0;top:300px">
										<div class="part2Text" data-selected="0" style="top:-190px;right:-20px">
											<h4 class="text_heading">
												{{(isset($pages['values_section'][14]) ? $pages['values_section'][14]->text : '')}}
											</h4>
											<p class="text_content">
												{{(isset($pages['values_section'][15]) ? $pages['values_section'][15]->text : '')}}
											</p>
										</div>
										<div class="part1"
											data-img-change="{{(env('IMG_FETCH_URL') . 'uploaded_files/' . (isset($pages['values_section'][23]) ? $pages['values_section'][23]->img : ''))}}"
											data-selected="1" style="top:30px;right:-15px">
																						{!! render_media(($pages['values_section'][16]->img ?? ''), 'style="height:105px;width:200px;"') !!}
																					</div>
																					<div class="part2" data-selected="0" style="top:-130px;right:-40px">

																						{!! render_media(($pages['values_section'][17]->img ?? ''), 'style="height:285px;width:245px;"') !!}

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
	<div class="values_section mobile-view" style="background:url('{{env('IMG_FETCH_URL') . 'uploaded_files/' . (isset($pages['values_section'][24]) ? $pages['values_section'][24]->img : '')}}'), linear-gradient(0deg,black,black);
					background-size:cover;
					background-attachment:fixed;
															   background-repeat:no-repeat">
		<div class="upper">
			<div class="inner">
				<center>
					<div class="col-8">
						<h3 class="heading">
							{{(isset($pages['values_section'][0]) ? $pages['values_section'][0]->text : '')}}</h3>
						<p class="text">{{(isset($pages['values_section'][1]) ? $pages['values_section'][1]->text : '')}}
						</p>
					</div>
					<div class="content">
						<div class="col-12">

							<div class="main_content_upper_div">
								<div class="main_content_div">
									<div class="part24">
										{!! render_media(($pages['values_section'][18]->img ?? ''), 'class="part1"') !!}
										{!! render_media(($pages['values_section'][19]->img ?? ''), 'class="part2"') !!}
									</div>

								</div>
							</div>

							<div class="col-12" style="margin-bottom:100px">
								<div class="content_upper_div">
									<div class="content_div">
										<div class="part2Text" data-selected="0" style="top:-70px;right:0;left:0">
											<h4 class="text_heading">
												{{(isset($pages['values_section'][2]) ? $pages['values_section'][2]->text : '')}}
											</h4>
											<p class="text_content">
												{{(isset($pages['values_section'][3]) ? $pages['values_section'][3]->text : '')}}
											</p>
										</div>
										<div class="part1" data-selected="1"
											data-img-change="{{(env('IMG_FETCH_URL') . 'uploaded_files/' . (isset($pages['values_section'][20]) ? $pages['values_section'][20]->img : ''))}}">
																					{!! render_media(($pages['values_section'][4]->img ?? '')) !!}
																					</div>
																					<div class="part2" data-selected="0" style="top:-40px;right:0;left:0">

																						{!! render_media(($pages['values_section'][5]->img ?? '')) !!}

										</div>
									</div>
									<div class="content_div">
										<div class="part2Text" data-selected="0" style="top:-70px;right:0;left:0">
											<h4 class="text_heading">
												{{(isset($pages['values_section'][6]) ? $pages['values_section'][6]->text : '')}}
											</h4>
											<p class="text_content">
												{{(isset($pages['values_section'][7]) ? $pages['values_section'][7]->text : '')}}
											</p>
										</div>
										<div class="part1" data-selected="1"
											data-img-change="{{(env('IMG_FETCH_URL') . 'uploaded_files/' . (isset($pages['values_section'][21]) ? $pages['values_section'][21]->img : ''))}}">
																					{!! render_media(($pages['values_section'][8]->img ?? '')) !!}
																					</div>
																					<div class="part2" data-selected="0" style="top:-40px;right:0;left:0">

																						{!! render_media(($pages['values_section'][9]->img ?? '')) !!}

										</div>
									</div>
								</div>
							</div>

							<div class="col-lg-12 ">
								<div class="content_upper_div">
									<div class="content_div">
										<div class="part2Text" data-selected="0" style="top:-30px;right:0;left:0">
											<h4 class="text_heading">
												{{(isset($pages['values_section'][10]) ? $pages['values_section'][10]->text : '')}}
											</h4>
											<p class="text_content">
												{{(isset($pages['values_section'][11]) ? $pages['values_section'][11]->text : '')}}
											</p>
										</div>
										<div class="part1" data-selected="1"
											data-img-change="{{(env('IMG_FETCH_URL') . 'uploaded_files/' . (isset($pages['values_section'][22]) ? $pages['values_section'][22]->img : ''))}}">
																					{!! render_media(($pages['values_section'][12]->img ?? '')) !!}
																					</div>
																					<div class="part2" data-selected="0" style="top:-20px;right:0;left:0">

																						{!! render_media(($pages['values_section'][13]->img ?? '')) !!}

										</div>
									</div>
									<div class="content_div">
										<div class="part2Text" data-selected="0" style="top:-30px;right:0;left:0">
											<h4 class="text_heading">
												{{(isset($pages['values_section'][14]) ? $pages['values_section'][14]->text : '')}}
											</h4>
											<p class="text_content">
												{{(isset($pages['values_section'][15]) ? $pages['values_section'][15]->text : '')}}
											</p>
										</div>
										<div class="part1" data-selected="1"
											data-img-change="{{(env('IMG_FETCH_URL') . 'uploaded_files/' . (isset($pages['values_section'][23]) ? $pages['values_section'][23]->img : ''))}}">
																					{!! render_media(($pages['values_section'][16]->img ?? '')) !!}
																					</div>
																					<div class="part2" data-selected="0" style="top:-20px;right:0;left:0">

																						{!! render_media(($pages['values_section'][17]->img ?? '')) !!}

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
				<h1 class="heading">{{(isset($pages['brands_section'][0]) ? $pages['brands_section'][0]->text : '')}}</h1>
				<marquee scrollamount="10" style="display:flex">
					@foreach(extra_image("Home") as $data)
						<img class="lazy-load" data-src="{{(env('IMG_FETCH_URL') . 'uploaded_files/' . $data->banner)}}">
					@endforeach




				</marquee>
			</div>


		</center>
	</div>


	<div class="impact_section page-section">
		<center>
			<h1 class="heading">{{(isset($pages['impact_section'][0]) ? $pages['impact_section'][0]->text : '')}}</h1>
			<div class="container">
				<div class="row">
					<div class="col-lg-8">


						<div class="form">
							@include('component.contact_form')

						</div>
					</div>
					<div class="col-lg-4">
						<div class="waving_div">
							@php
								$impactMedia = isset($pages['impact_section'][2]) ? $pages['impact_section'][2]->img : '';
								$isVideoFile = preg_match('/\.(mp4|webm|mov|avi|mkv)$/i', $impactMedia);
							@endphp
							@if($isVideoFile)
								<video class="lazy-load" playsinline muted loop autoplay
									style="width:100%;height:auto;object-fit:cover;border-radius:12px;">
									<source src="{{ env('IMG_FETCH_URL') . 'uploaded_files/' . $impactMedia }}" type="video/{{ pathinfo($impactMedia, PATHINFO_EXTENSION) == 'mp4' ? 'mp4' : 'webm' }}">
								</video>
							@else
								<img class="lazy-load"
									data-src="{{(env('IMG_FETCH_URL') . 'uploaded_files/' . $impactMedia)}}">
							@endif
						</div>
					</div>
					</div>
				</div>
			</div>

		</center>
	</div>
	<div class="brand_lower">

		<p><span class="impact word-change" word-remaine-time="1500"
				words="{{(isset($pages['brands_section'][6]) ? $pages['brands_section'][6]->text : '')}}"></span>
		</p>


	</div>
<div class="testimonial_section page-section"
style="background:url('{{ isset($pages["testimonial_section"][27]->img) ? env('IMG_FETCH_URL').'uploaded_files/'.$pages["testimonial_section"][27]->img : '' }}');background-size:cover;background-attachment:fixed;background-position:bottom;background-repeat:no-repeat">

<div class="upper">														   
<div class="inner">
<center>

<div class="col-lg-6 col-10">
    <h1 class="heading">{{ $pages["testimonial_section"][0]->text ?? '' }}</h1>
    <p class="content">{{ $pages["testimonial_section"][1]->text ?? '' }}</p>
</div>

<div class="col-lg-8 col-11">
<div class="owl-carousel">

{{-- Testimonial 1 --}}
<div class="item">
<div class="review">
<div class="effect_layer">

<p class="review_content">{{ $pages["testimonial_section"][2]->text ?? '' }}</p>   

<div class="stars">
@for($i=1;$i<=5;$i++)
<i class="fa {{ (int)($pages["testimonial_section"][3]->text ?? 0) >= $i ? 'fa-star' : 'fa-star-o' }}"></i>
@endfor
</div>

<div class="customer">
@if(isset($pages["testimonial_section"][4]->img))
<img class="lazy-load" data-src="{{ env('IMG_FETCH_URL').'uploaded_files/'.$pages["testimonial_section"][4]->img }}">
@endif
<p class="name">{{ $pages["testimonial_section"][5]->text ?? '' }}</p>
<p class="type">{{ $pages["testimonial_section"][6]->text ?? '' }}</p>
</div>

</div>
</div>
</div>

{{-- Testimonial 2 --}}
<div class="item">
<div class="review">
<div class="effect_layer">

<p class="review_content">{{ $pages["testimonial_section"][7]->text ?? '' }}</p>   

<div class="stars">
@for($i=1;$i<=5;$i++)
<i class="fa {{ (int)($pages["testimonial_section"][8]->text ?? 0) >= $i ? 'fa-star' : 'fa-star-o' }}"></i>
@endfor
</div>

<div class="customer">
@if(isset($pages["testimonial_section"][9]->img))
<img class="lazy-load" data-src="{{ env('IMG_FETCH_URL').'uploaded_files/'.$pages["testimonial_section"][9]->img }}">
@endif
<p class="name">{{ $pages["testimonial_section"][10]->text ?? '' }}</p>
<p class="type">{{ $pages["testimonial_section"][11]->text ?? '' }}</p>
</div>

</div>
</div>
</div>

{{-- Testimonial 3 --}}
<div class="item">
<div class="review">
<div class="effect_layer">

<p class="review_content">{{ $pages["testimonial_section"][12]->text ?? '' }}</p>   

<div class="stars">
@for($i=1;$i<=5;$i++)
<i class="fa {{ (int)($pages["testimonial_section"][13]->text ?? 0) >= $i ? 'fa-star' : 'fa-star-o' }}"></i>
@endfor
</div>

<div class="customer">
@if(isset($pages["testimonial_section"][14]->img))
<img class="lazy-load" data-src="{{ env('IMG_FETCH_URL').'uploaded_files/'.$pages["testimonial_section"][14]->img }}">
@endif
<p class="name">{{ $pages["testimonial_section"][15]->text ?? '' }}</p>
<p class="type">{{ $pages["testimonial_section"][16]->text ?? '' }}</p>
</div>

</div>
</div>
</div>

{{-- Testimonial 4 --}}
<div class="item">
<div class="review">
<div class="effect_layer">

<p class="review_content">{{ $pages["testimonial_section"][17]->text ?? '' }}</p>   

<div class="stars">
@for($i=1;$i<=5;$i++)
<i class="fa {{ (int)($pages["testimonial_section"][18]->text ?? 0) >= $i ? 'fa-star' : 'fa-star-o' }}"></i>
@endfor
</div>

<div class="customer">
@if(isset($pages["testimonial_section"][19]->img))
<img class="lazy-load" data-src="{{ env('IMG_FETCH_URL').'uploaded_files/'.$pages["testimonial_section"][19]->img }}">
@endif
<p class="name">{{ $pages["testimonial_section"][20]->text ?? '' }}</p>
<p class="type">{{ $pages["testimonial_section"][21]->text ?? '' }}</p>
</div>

</div>
</div>
</div>

{{-- Testimonial 5 --}}
<div class="item">
<div class="review">
<div class="effect_layer">

<p class="review_content">{{ $pages["testimonial_section"][22]->text ?? '' }}</p>   

<div class="stars">
@for($i=1;$i<=5;$i++)
<i class="fa {{ (int)($pages["testimonial_section"][23]->text ?? 0) >= $i ? 'fa-star' : 'fa-star-o' }}"></i>
@endfor
</div>

<div class="customer">
@if(isset($pages["testimonial_section"][24]->img))
<img class="lazy-load" data-src="{{ env('IMG_FETCH_URL').'uploaded_files/'.$pages["testimonial_section"][24]->img }}">
@endif
<p class="name">{{ $pages["testimonial_section"][25]->text ?? '' }}</p>
<p class="type">{{ $pages["testimonial_section"][26]->text ?? '' }}</p>
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


@if(isset($faqs) && $faqs->count() > 0)
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