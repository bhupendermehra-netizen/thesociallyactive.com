@extends("layouts.front_app")
@section("content")
<style>
    #gsap-card-section {
        position: relative;
        width: 100%;
        height: 100vh;
        background: #aaf103; /* Matching the video's blue theme */
        overflow: hidden;
        display: flex;
        align-items: center;
        justify-content: center;
        /* Perspective gives the 3D depth for the flip */
        perspective: 2000px; 
    }

    .gsap-card-stack {
        position: relative;
        width: 100%;
        max-width: 1200px;
        height: 500px;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .gsap-card {
        position: absolute;
        width: 280px;
        height: 400px;
        cursor: pointer;
    }

    /* The container that actually rotates */
    .card-inner {
        position: relative;
        width: 100%;
        height: 100%;
        transition: transform 0.6s cubic-bezier(0.23, 1, 0.32, 1);
        transform-style: preserve-3d;
    }

    .card-front, .card-back {
        position: absolute;
        width: 100%;
        height: 100%;
        backface-visibility: hidden;
        border-radius: 16px;
        overflow: hidden;S
    }

    .card-front img, .card-back img {
        width: 100%;
        height: 100%;
        object-fit: fil;
    }

    /* Back side starts rotated 180 degrees */
    .card-back {
        transform: rotateY(180deg);
    }

    /* Layering the stack */
    .gsap-card-1 { z-index: 4; }
    .gsap-card-2 { z-index: 3; }
    .gsap-card-3 { z-index: 2; }
    .gsap-card-4 { z-index: 1; }

    @media (max-width: 768px) {
        .gsap-card { width: 180px; height: 260px; }
    }
</style>

<div id="gsap-card-section">
    <div class="gsap-card-stack">
        @foreach([1, 2, 3, 4] as $i)
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
        gsap.registerPlugin(ScrollTrigger);

        // Initial setup: Stack all cards in center
        gsap.set(".gsap-card", {
            xPercent: -50,
            yPercent: -50,
            left: "50%",
            top: "50%"
        });

        const tl = gsap.timeline({
            scrollTrigger: {
                trigger: '#gsap-card-section',
                start: 'top top',
                end: '+=3000', // Long scroll for smooth transition
                scrub: 1,
                pin: true,
                anticipatePin: 1
            }
        });

        // 1. FAN OUT EFFECT
        // Moving cards to their spread positions with slight rotation
        tl.to('.gsap-card-1', { x: '-32vw', rotation: -8, ease: "power1.inOut" }, 0)
          .to('.gsap-card-2', { x: '-11vw', rotation: -3, ease: "power1.inOut" }, 0)
          .to('.gsap-card-3', { x: '11vw', rotation: 3, ease: "power1.inOut" }, 0)
          .to('.gsap-card-4', { x: '32vw', rotation: 8, ease: "power1.inOut" }, 0);

        // 2. 180 DEGREE FLIP
        // We target '.card-inner' for the rotation
        // Stagger makes them flip one after another like the video
        tl.to('.card-inner', {
            rotationY: 180,
            duration: 1.5,
            stagger: 0.2, // This creates the sequential flip effect
            ease: "back.out(1.2)" // Gives a slight "bounce" to the flip
        }, "-=0.2"); // Starts slightly before the fan-out fully finishes

        // 3. OPTIONAL: SCALE UP
        // Slightly enlarge the cards as they flip to make them prominent
        tl.to('.gsap-card', {
            scale: 1.1,
            duration: 1,
            stagger: 0.2
        }, "<"); 
    });
</script>
@endsection