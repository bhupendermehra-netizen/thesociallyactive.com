<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{header_footer()['main_component'][1]->text}}</title>
    <link rel="icon" type="image/x-icon"
        href="{{(env('IMG_FETCH_URL') . 'uploaded_files/' . header_footer()['main_component'][0]->img)}}">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/owl-carousel/owl.carousel.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/owl-carousel/owl.theme.default.min.css') }}">

    {{GOOGLESETNV()}}

    <style>
        body { background: black !important; }
    </style>
</head>

<body>
    @if(env("SITE_SETTING"))

        <div class="side_contact_button">
            <button class="mainButton" type="button">
                <img src="{{(env('IMG_FETCH_URL') . 'uploaded_files/' . header_footer()['side_buttons'][0]->img)}}">
            </button>
            <div class="sideButtonDiv" data-selected="0">
                <button class="sideButton" type="button" onclick="window.location.href='{{header_footer()['side_buttons'][1]->link}}'">
                    <i class="{{header_footer()['side_buttons'][1]->text}}"></i>
                </button>
                <button class="sideButton" type="button" onclick="window.location.href='{{header_footer()['side_buttons'][2]->link}}'">
                    <i class="{{header_footer()['side_buttons'][2]->text}}"></i>
                </button>
                <button class="sideButton" type="button" onclick="window.location.href='{{header_footer()['side_buttons'][3]->link}}'">
                    <i class="{{header_footer()['side_buttons'][3]->text}}"></i>
                </button>
                <button class="sideButton" type="button" onclick="window.location.href='{{header_footer()['side_buttons'][4]->link}}'">
                    <i class="{{header_footer()['side_buttons'][4]->text}}"></i>
                </button>
            </div>
        </div>

        <div class="loader">
            <img src="{{(env('IMG_FETCH_URL') . 'uploaded_files/' . header_footer()['main_component'][2]->img)}}">
        </div>

        <header class="navbar-top">
            <div class="navbar">
                <div class="logo" onclick="window.location.href='{{route('index')}}'">
                    <img src="{{(env('IMG_FETCH_URL') . 'uploaded_files/' . header_footer()['navbar'][0]->img)}}">
                </div>
                <div class="link">
                    <div class="audio_control">
                        <div class="before"></div>
                        <audio class="page_audio" controls loop>
                            <source src="{{(env('IMG_FETCH_URL') . 'uploaded_files/' . header_footer()['navbar'][14]->img)}}">
                        </audio>
                        <img class="audio_style_1" src="{{(env('IMG_FETCH_URL') . 'uploaded_files/' . header_footer()['navbar'][15]->img)}}" data-select="0">
                        <img class="audio_style_2" src="{{(env('IMG_FETCH_URL') . 'uploaded_files/' . header_footer()['navbar'][16]->img)}}" data-select="1">
                    </div>
                    <div class="button">
                        <div class="button_before"></div>
                        <a class="let_talk_link" href="{{header_footer()['navbar'][1]->link}}">
                            {{header_footer()['navbar'][1]->text}} <i class='fa fa-phone'></i>
                        </a>
                    </div>
                    <button type="button" class="menu-control navbar_open">
                        <img src="{{asset('assets/images/navbar_open.png')}}">
                    </button>
                </div>
            </div>
        </header>

        <div class="navbar-options">
            <div class="navbar-top-2">
                <div class="navbar">
                    <div class="logo">
                        <img src="{{(env('IMG_FETCH_URL') . 'uploaded_files/' . header_footer()['navbar'][0]->img)}}">
                    </div>
                    <div class="link">
                        <div class="button">
                            <div class="button_before"></div>
                            <a class="let_talk_link" href="{{header_footer()['navbar'][1]->link}}">
                                {{header_footer()['navbar'][1]->text}} <i class='fa fa-phone'></i>
                            </a>
                        </div>
                        <button type="button" class="menu-control navbar_close">
                            <img src="{{asset('assets/images/navbar_close.png')}}">
                        </button>
                    </div>
                </div>
            </div>

            <center>
                <div class="navbar-links">
                    <div class="inner">

                        {{-- Home --}}
                        @if($_SERVER['REQUEST_URI'] != "/" . str_replace("/", "", header_footer()['navbar'][2]->link))
                            <p class="links">
                                <a href="{{header_footer()['navbar'][2]->link}}">{{header_footer()['navbar'][2]->text}}</a>
                            </p>
                        @endif

                        {{-- Our Projects --}}
                        @if($_SERVER['REQUEST_URI'] != '/projects')
                            <p class="links">
                                <a href="{{ route('projects') }}">Our Projects</a>
                            </p>
                        @endif

                        {{-- Our Story --}}
                        @if($_SERVER['REQUEST_URI'] != "/" . str_replace("/", "", header_footer()['navbar'][3]->link))
                            <p class="links">
                                <a href="{{header_footer()['navbar'][3]->link}}">{{header_footer()['navbar'][3]->text}}</a>
                            </p>
                        @endif

                        {{-- Contact --}}
                        @if($_SERVER['REQUEST_URI'] != "/" . str_replace("/", "", header_footer()['navbar'][4]->link))
                            <p class="links">
                                <a href="{{header_footer()['navbar'][4]->link}}">{{header_footer()['navbar'][4]->text}}</a>
                            </p>
                        @endif

                        {{-- Services dropdown --}}
                        <p class="links">
                            <a href="#" class="service_dropdown">{{header_footer()['navbar'][5]->text}}<i class='fa fa-arrow-down'></i></a>
                        </p>

                        <div class="service_drop" style="display:none">
                            <div class="row">
                                @if(str_replace("/", "", $_SERVER['REQUEST_URI']) != str_replace("/", "", header_footer()['navbar'][6]->link))
                                    <div class="col-lg-3 col-12">
                                        <p class="links2"><a href="{{header_footer()['navbar'][6]->link}}">{{header_footer()['navbar'][6]->text}}</a></p>
                                    </div>
                                @endif
                                @if(str_replace("/", "", $_SERVER['REQUEST_URI']) != str_replace("/", "", header_footer()['navbar'][7]->link))
                                    <div class="col-lg-3 col-12">
                                        <p class="links2"><a href="{{header_footer()['navbar'][7]->link}}">{{header_footer()['navbar'][7]->text}}</a></p>
                                    </div>
                                @endif
                                @if(str_replace("/", "", $_SERVER['REQUEST_URI']) != str_replace("/", "", header_footer()['navbar'][8]->link))
                                    <div class="col-lg-3 col-12">
                                        <p class="links2"><a href="{{header_footer()['navbar'][8]->link}}">{{header_footer()['navbar'][8]->text}}</a></p>
                                    </div>
                                @endif
                                @if(str_replace("/", "", $_SERVER['REQUEST_URI']) != str_replace("/", "", header_footer()['navbar'][9]->link))
                                    <div class="col-lg-3 col-12">
                                        <p class="links2"><a href="{{header_footer()['navbar'][9]->link}}">{{header_footer()['navbar'][9]->text}}</a></p>
                                    </div>
                                @endif
                            </div>
                        </div>

                        {{-- Social Icons --}}
                        <div class="icons">
                            <a href="{{header_footer()['navbar'][10]->link}}"><i class="{{header_footer()['navbar'][10]->text}}"></i></a>
                            <a href="{{header_footer()['navbar'][11]->link}}"><i class="{{header_footer()['navbar'][11]->text}}"></i></a>
                            <a href="{{header_footer()['navbar'][12]->link}}"><i class="{{header_footer()['navbar'][12]->text}}"></i></a>
                            <a href="{{header_footer()['navbar'][13]->link}}"><i class="{{header_footer()['navbar'][13]->text}}"></i></a>
                        </div>

                    </div>
                </div>
            </center>
        </div>

        @yield('content')

        <div class="footer_upper">
            <div class="pebbles_upper">
                <div id="footer_pebble_canvas"></div>
            </div>
            <div class="inner">
                <footer>
                    <div class="footer">
                        <div class="container">
                            <div class="row">
                                <div class="col-lg-3 col-md-4 col-sm-4 col-12">
                                    <div class="logo">
                                        <img src="{{(env('IMG_FETCH_URL') . 'uploaded_files/' . header_footer()['footer'][0]->img)}}">
                                        <p class="sub">{{header_footer()['footer'][1]->text}}</p>
                                        <p class="content">{{header_footer()['footer'][2]->text}}</p>
                                    </div>
                                </div>
                                <div class="col-lg-3 col-md-4 col-sm-4 col-12">
                                    <div class="footer-links">
                                        <ul>
                                            <li><a href="{{header_footer()['footer'][3]->link}}">{{header_footer()['footer'][3]->text}}</a></li>
                                            <li><a href="{{header_footer()['footer'][4]->link}}">{{header_footer()['footer'][4]->text}}</a></li>
                                            <li><a href="{{header_footer()['footer'][5]->link}}">{{header_footer()['footer'][5]->text}}</a></li>
                                            <li><a href="{{header_footer()['footer'][6]->link}}">{{header_footer()['footer'][6]->text}}</a></li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="col-lg-3 col-md-4 col-sm-4 col-12">
                                    <div class="information">
                                        <ul>
                                            <li><a href="{{header_footer()['footer'][7]->link}}">{{header_footer()['footer'][7]->text}}</a></li>
                                            <li><a href="{{header_footer()['footer'][8]->link}}">{{header_footer()['footer'][8]->text}}</a></li>
                                            <li><a href="{{header_footer()['footer'][9]->link}}">{{header_footer()['footer'][9]->text}}</a></li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="col-lg-3 col-md-4 col-sm-4 col-12">
                                    <div class="information">
                                        <iframe
                                            src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d13999.790058004712!2d77.1356602!3d28.6912166!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x390d02347a0e8fbb%3A0xa51d40303c4dbfb2!2sITL%20Twin%20Towers!5e0!3m2!1sen!2sin!4v1772881604702!5m2!1sen!2sin"
                                            width="100%" height="245" style="border:0;" allowfullscreen="" loading="lazy"
                                            referrerpolicy="no-referrer-when-downgrade">
                                        </iframe>
                                    </div>
                                </div>
                            </div>
                            <div class="social">
                                <a href="{{header_footer()['footer'][10]->link}}"><i class="{{header_footer()['footer'][10]->text}}"></i></a>
                                <a href="{{header_footer()['footer'][11]->link}}"><i class="{{header_footer()['footer'][11]->text}}"></i></a>
                                <a href="{{header_footer()['footer'][12]->link}}"><i class="{{header_footer()['footer'][12]->text}}"></i></a>
                                <a href="{{header_footer()['footer'][13]->link}}"><i class="{{header_footer()['footer'][13]->text}}"></i></a>
                            </div>
                        </div>
                    </div>
                    <center>
                        <div class="credit_bg">
                            <div class="credit col-lg-7 col-10">
                                <p>Designed & Developed By <a href="#">TheSociallyActive</a></p>
                                <p>{{header_footer()['footer'][16]->text}}</p>
                            </div>
                        </div>
                    </center>
                </footer>
            </div>
        </div>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
        <script src="{{ asset('assets/owl-carousel/owl.carousel.min.js') }}"></script>
        <script src="{{ asset('assets/js/script.js') }}"></script>
        <script src="{{ asset('assets/js/background_script.js') }}"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/p5.js/1.9.4/p5.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/matter-js/0.20.0/matter.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/three.js/0.160.0/three.min.js"></script>

        <script>
            $(document).ready(function() {
                var owl = $('.owl-carousel');
                owl.owlCarousel({
                    margin: 10,
                    loop: true,
                    autoplay: true,
                    responsive: {
                        0: { items: 1 },
                        500: { items: 1 },
                        600: { items: 2 },
                        1000: { items: 3 }
                    }
                });
            });

            const Engine = Matter.Engine;
            const World = Matter.World;
            const Bodies = Matter.Bodies;
            const Body = Matter.Body;

            var pebbles_Data = [
                "Identity","Positioning","Vision","Legacy","Influence","Authority","Signature","Alignment","Authenticity","Differentiation","Perception","Purpose","Trust","Consistency","Transformation","Engagement","Viral","Reach","Trend","Relevance","Community","Aesthetic","Stories","UGC (User Generated Content)","Real-time","Relatable","Impact","Collab (Collaboration)","Creator","Credibility","Micro influencer","Resonance","Partnership","Audience","Niche","Campaign","Retention","ROI (Return on Investment)","Funnels","Conversions","Awareness","Visibility","Disruption","Innovation","Metrics","Bold","Elevate","Magnetic","Loud","Unforgettable",
            ];

            let engine;
            let items = [];
            let ground, wallLeft, wallRight, roof;
            let words = [];

            class Word {
                constructor(x, y, word) {
                    if (window.screen.width > 500) {
                        this.body = Bodies.rectangle(x, y, word.length * 5, 20);
                    } else {
                        this.body = Bodies.rectangle(x, y, word.length * 2, 20);
                    }
                    this.word = word;
                    World.add(engine.world, this.body);
                }
                show() {
                    let pos = this.body.position;
                    let angle = this.body.angle;
                    push();
                    translate(pos.x, pos.y);
                    rotate(angle);
                    rectMode(CENTER);
                    fill("#000");
                    stroke("#DAF301");
                    strokeWeight(3);
                    if (window.screen.width > 500) {
                        rect(0, 0, this.word.length * 20 + 30, 30, 20);
                    } else {
                        rect(0, 0, this.word.length * 7 + 15, 15, 20);
                    }
                    noStroke();
                    fill("#fff");
                    if (window.screen.width > 500) {
                        textSize(20);
                    } else {
                        textSize(13);
                    }
                    textAlign(CENTER, CENTER);
                    text(this.word, 0, 0);
                    pop();
                }
            }

            function setup() {
                if (window.screen.height > 500) {
                    var canvas = createCanvas(window.screen.width, 300);
                } else {
                    var canvas = createCanvas(window.screen.width, 50);
                }
                canvas.parent("footer_pebble_canvas");
                engine = Engine.create();
                roof = Bodies.rectangle(width / 2, height, width, 30, { isStatic: true });
                ground = Bodies.rectangle(width / 2, height - 20, width, 10, { isStatic: true });
                wallLeft = Bodies.rectangle(0, height / 2, 10, height, { isStatic: true });
                wallRight = Bodies.rectangle(width, height / 2, 10, height, { isStatic: true });
                World.add(engine.world, [ground, wallLeft, wallRight, roof]);
                for (let i = 0; i < pebbles_Data.length; i++) {
                    words.push(new Word(random(width), -200, pebbles_Data[i]));
                }
            }

            function draw() {
                background("#000");
                Engine.update(engine);
                for (let word of words) {
                    word.show();
                }
            }

            $("#footer_pebble_canvas").on("touchstart", function() {
                for (let word of words) {
                    if (dist(mouseX, mouseY, word.body.position.x, word.body.position.y) < 50) {
                        Body.applyForce(word.body,
                            { x: word.body.position.x, y: word.body.position.y },
                            { x: random(-0.01, 0.01), y: random(-0.01, 0.01) }
                        );
                    }
                }
            });

            function mouseMoved() {
                for (let word of words) {
                    if (dist(mouseX, mouseY, word.body.position.x, word.body.position.y) < 50) {
                        Body.applyForce(word.body,
                            { x: word.body.position.x, y: word.body.position.y },
                            { x: random(-0.02, 0.02), y: random(-0.02, 0.02) }
                        );
                    }
                }
            }
        </script>

    @else
        {{abort(404)}}
    @endif
</body>
</html>