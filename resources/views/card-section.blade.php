@extends("layouts.front_app")
@section("content")
    <style>
        #gsap-card-section {
            position: relative;
            width: 100%;
            min-height: 100vh;
            background: #f7de22;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 4rem 0;
        }

        .gsap-card-stack {
            position: relative;
            width: min(360px, 90vw);
            aspect-ratio: 3 / 4;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .gsap-card {
            position: absolute;
            inset: 0;
            width: 100%;
            height: 100%;
            border-radius: 24px;
            object-fit: cover;
            box-shadow: 0 32px 70px rgba(0, 0, 0, 0.22);
        }

        .gsap-card-1 { z-index: 4; }
        .gsap-card-2 { z-index: 3; }
        .gsap-card-3 { z-index: 2; }
        .gsap-card-4 { z-index: 1; }
    </style>

    <div id="gsap-card-section">
        <div class="gsap-card-stack">
            <img src="{{ asset('admin/assets/img/card/card4front.webp') }}" class="gsap-card gsap-card-4" alt="Card 4 front">
            <img src="{{ asset('admin/assets/img/card/card3front.webp') }}" class="gsap-card gsap-card-3" alt="Card 3 front">
            <img src="{{ asset('admin/assets/img/card/card2front.webp') }}" class="gsap-card gsap-card-2" alt="Card 2 front">
            <img src="{{ asset('admin/assets/img/card/card1front.webp') }}" class="gsap-card gsap-card-1" alt="Card 1 front">
        </div>
    </div>
@endsection