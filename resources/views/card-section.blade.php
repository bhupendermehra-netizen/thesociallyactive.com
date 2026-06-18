@extends("index")
@section("cards")
<style>
    #gsap-card-section {
        position: relative;
        width: 100%;
        min-height: 100vh;
        background: #aaf103;
        overflow: hidden;
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 40px 0;
    }
    .width_div {
        zoom: 85.3333%;
        width: 85.3333%;
    }
    .width_div23 {
        display: flex;
        justify-content: center;
        flex-wrap: wrap;
        gap: 20px;
    }
    .service_section {
        position: relative;
        width: 220px;
        height: 280px;
        cursor: pointer;
        transition: transform 0.3s ease;
    }
    .service_section:hover {
        transform: translateY(-10px);
    }
    .service_img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        border-radius: 12px;
        position: absolute;
        top: 0;
        left: 0;
        transition: opacity 0.3s ease;
    }
    .service_img_2 {
        width: 100%;
        height: 100%;
        object-fit: cover;
        border-radius: 12px;
        position: absolute;
        top: 0;
        left: 0;
        opacity: 0;
        transition: opacity 0.3s ease;
    }
    .service_section:hover .service_img { opacity: 0; }
    .service_section:hover .service_img_2 { opacity: 1; }

    @media (max-width: 768px) {
        .service_section { width: 150px; height: 200px; }
        .width_div { zoom: 1; width: 100%; }
    }
    @media (max-width: 480px) {
        .service_section { width: 130px; height: 170px; }
    }
</style>

<div id="gsap-card-section">
    <div class="width_div">
        <div class="width_div23">
            @for($i = 1; $i <= 4; $i++)
                @php
                    $cardKey = 'card_' . $i;
                    $cardData = $pages[$cardKey] ?? [];
                @endphp
                <div class="service_section">
                    <img class="service_img lazy-load" data-selected="1"
                        data-src="{{ env('IMG_FETCH_URL') . 'uploaded_files/' . ($cardData[0]->img ?? '') }}"
                        src="{{ env('IMG_FETCH_URL') . 'uploaded_files/' . ($cardData[0]->img ?? '') }}">
                    <img class="service_img_2 lazy-load" data-selected="0"
                        data-src="{{ env('IMG_FETCH_URL') . 'uploaded_files/' . ($cardData[1]->img ?? '') }}"
                        src="{{ env('IMG_FETCH_URL') . 'uploaded_files/' . ($cardData[1]->img ?? '') }}">
                </div>
            @endfor
        </div>
    </div>
</div>
@endsection