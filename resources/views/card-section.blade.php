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
        overflow: hidden;
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

        gsap.set(".gsap-card", {
            xPercent: -50,
            yPercent: -50,
            left: "50%",
            top: "50%"
        });

        let infiniteBounce; 

        const tl = gsap.timeline({
            scrollTrigger: {
                trigger: '#gsap-card-section',
                start: 'top top',
                end: '+=1500', 
                scrub: 1,
                pin: true,
                anticipatePin: 1,
                onUpdate: (self) => {
                    // Start the bounce once the flip sequence begins (around 30% progress)
                    // and kill it if we scroll back up before that point.
                    if (self.progress > 0.3) {
                        if (!infiniteBounce) {
                            startFloating();
                        }
                    } else {
                        stopFloating();
                    }
                },
                // Hard reset when leaving the section backwards
                onEnterBack: () => {
                    if (tl.progress() < 0.3) stopFloating();
                }
            }
        });

        // 1. FAN OUT
        tl.to('.gsap-card-1', { x: '-32vw', rotation: -8, ease: "power1.inOut" }, 0)
          .to('.gsap-card-2', { x: '-11vw', rotation: -3, ease: "power1.inOut" }, 0)
          .to('.gsap-card-3', { x: '11vw', rotation: 3, ease: "power1.inOut" }, 0)
          .to('.gsap-card-4', { x: '32vw', rotation: 8, ease: "power1.inOut" }, 0);

        // 2. 180 DEGREE FLIP
        tl.to('.card-inner', {
            rotationY: 180,
            duration: 1.5,
            stagger: 0.2,
            ease: "back.out(1.2)"
        }, "-=0.2");

        // 3. SCALE UP
        tl.to('.gsap-card', {
            scale: 1,
            duration: 1,
            stagger: 0.2
        }, "<");

        // --- BOUNCE CONTROL FUNCTIONS ---

        function startFloating() {
            // Move all to start position simultaneously
            gsap.set(".gsap-card", { y: -30 });

            infiniteBounce = gsap.to(".gsap-card", {
                y: 30,
                duration: 2,
                repeat: -1,
                yoyo: true,
                ease: "sine.inOut"
            });
        }

        function stopFloating() {
            if (infiniteBounce) {
                infiniteBounce.kill();
                infiniteBounce = null;
                // Smoothly reset cards to their base Y position
                gsap.to(".gsap-card", { y: 0, duration: 0.5, ease: "power2.out" });
            }
        }
    });
</script>
@endsection