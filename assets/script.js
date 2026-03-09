// Lazy Loading Implementation - Hide preloader after first section loads
$(document).ready(function(){
    // Hide preloader once banner section is ready
    setTimeout(function(){
        $(".loader").fadeOut(300);
        $("body").css("overflow-y","visible");
    }, 500);

    // Lazy load videos and images
    if ('IntersectionObserver' in window) {
        const lazyMediaObserver = new IntersectionObserver(function(entries, observer) {
            entries.forEach(function(entry) {
                if (entry.isIntersecting) {
                    const media = entry.target;

                    // Handle videos
                    if (media.tagName === 'VIDEO') {
                        const source = media.querySelector('source');
                        if (source && source.dataset.src) {
                            source.src = source.dataset.src;
                            media.load();
                        }
                    }

                    // Handle images
                    if (media.tagName === 'IMG' && media.dataset.src) {
                        media.src = media.dataset.src;
                        media.removeAttribute('data-src');
                    }

                    media.classList.add('loaded');
                    observer.unobserve(media);
                }
            });
        }, {
            rootMargin: '50px 0px',
            threshold: 0.01
        });

        // Observe all lazy elements
        document.querySelectorAll('video.lazy-load, img.lazy-load').forEach(function(media) {
            lazyMediaObserver.observe(media);
        });
    } else {
        // Fallback for browsers without IntersectionObserver
        $('video.lazy-load source[data-src]').each(function(){
            $(this).attr('src', $(this).data('src'));
            this.parentElement.load();
        });
        $('img.lazy-load[data-src]').each(function(){
            $(this).attr('src', $(this).data('src'));
        });
    }
});

$(window).on("load",function(){
    if($(".main_contact_popup_form").length){
$(".main_contact_popup_form").css("display","block");
}
scrollF();


zoomf(1500,$(".expertise_section .width_div"),30,"zoom",1000);
zoomf(1500,$(".expertise_section .width_div"),30,"width",1000);
zoomf(1000,$(".expertise_section .width_div"),0,"zoom",500);
zoomf(1000,$(".expertise_section .width_div"),10,"width",500);
//zoomf(500,$(".expertise_section .width_div"),-45,"zoom",0);
//zoomf(500,$(".expertise_section .width_div"),-50,"width",0);
zoomi(1600,$(".expertise_section .service_section"),30);


zoomf(700,$(".brand_strategy_section"),0,"zoom",500);
zoomf(1200,$(".brand_strategy_section .visuals"),-10,"zoom",500);
zoomf(1200,$(".brand_strategy_section .content"),0,"zoom",500);
//zoomf(500,$(".brand_strategy_section .visuals"),-40,"zoom");
//zoomf(500,$(".brand_strategy_section .content"),-20,"zoom");

zoomf(1000,$(".brand_strategy_banner .other_details_inner"),0,"zoom",700);
zoomf(700,$(".brand_strategy_banner .other_details_inner"),0,"zoom",500);
zoomf(1200,$(".brand_strategy_banner .content"),0,"zoom",500);
//zoomf(500,$(".brand_strategy_banner .content"));
zoomf(1200,$(".brand_strategy_banner .visuals"),0,"zoom",500);
//zoomf(500,$(".brand_strategy_banner .visuals"));

zoomf(1800,$(".our_story_section"),0,"zoom",500);

zoomf(1500,$(".values_section.desktop-view .inner"));

zoomf(1300,$(".whoweare_section .whoweare_setion_width_section"),0,"zoom",500);
//zoomf(500,$(".whoweare_section .whoweare_setion_width_section"),-20);
//zoomf(500,$(".whoweare_section .whoweare_setion_width_section"),-20,"width");
zoomf(500,$(".footer_upper .pebbles button"),-55);

zoomf(1800,$(".banner .heading"),-10,"zoom",1300);
zoomf(1300,$(".banner .heading"),-10,"zoom",700);
//zoomf(600,$(".banner .heading"),-10);
zoomf(1500,$(".whoweare_section_video"),0,"zoom",500);


//zoomf(500,$(".talk_section"),-30);
//zoomf(500,$(".explore_more_section"),-35);
//zoomf(500,$(".testimonial_section"),-10);
zoomf(700,$(".values_section.mobile-view .content"),-10,"zoom",500);
zoomi(1500,$(".who_we_help_section .content"));
zoomi(1500,$(".video_section_outer"));

zoomf(500,$(".aboutus_section"));
//zoomf(500,$(".navbar-options"));
//zoomf(500,$(".navbar-top .navbar"));
zoomf(500,$(".navbar .logo img"),0,"scale");
zoomf(500,$(".navbar .audio_control"),0,"scale");
zoomf(500,$(".navbar .link .menu-control"),0,"scale");

//zoomf(500,$(".brand_lower p"));

zoomf(1800,$(".who_we_help_section .bulb-effect"),-10,"zoom",1000);
zoomf(1000,$(".who_we_help_section .bulb-effect"),0,"zoom",500);
//zoomf(500,$(".who_we_help_section .bulb-effect"));
	if($(".expertise_section").length){
	$(".expertise_section").attr("main-top",$(".expertise_section").offset().top);
		
		
	}
	if($(".brand_strategy_banner .other_details_inner").length){
	$(".brand_strategy_banner .other_details_inner").addClass("upDownAni2");
	}
if(window.screen.width < 1000){
	if($(".whoweare_section .sub-heading").length){
				$(".whoweare_section .sub-heading").animate({opacity:"0.9"},"slow");
	
	}

}
	if($(".video_customize").length){
	$(".video_customize")[0].play();
	}
	var moving_numbers = $(".moving_numbers").length;
	
	for(let i=0;i<moving_numbers;i++){
		
		movingnoeffect($(".moving_numbers").eq(i));
	}
	if($(".word-change").length){
		var wordChanges = $(".word-change").length;
		for(let i=0;i<wordChanges;i++){
		wordchangeeffect($(".word-change").eq(i),1);
		}
	}
	
 
	
	
	if($(".banner #video_banner_section").length){
	$(".banner #video_banner_section").on("ended",function(){
		$(".banner #video_banner_section").hide();
		$(".banner #image_banner_section").show();
	});
	}

});
$(window).on("resize",function(){

	if($(".expertise_section").length){
	$(".expertise_section").attr("main-top",$(".expertise_section").offset().top);	
	}
	
scrollF();
	
zoomf(1500,$(".expertise_section .width_div"),30,"zoom",1000);
zoomf(1500,$(".expertise_section .width_div"),30,"width",1000);
zoomf(1000,$(".expertise_section .width_div"),0,"zoom",500);
zoomf(1000,$(".expertise_section .width_div"),10,"width",500);
//zoomf(500,$(".expertise_section .width_div"),-45,"zoom",0);
//zoomf(500,$(".expertise_section .width_div"),-50,"width",0);
zoomi(1600,$(".expertise_section .service_section"),30);


zoomf(700,$(".brand_strategy_section"));
zoomf(1200,$(".brand_strategy_section .visuals"),-10,"zoom",500);
zoomf(1200,$(".brand_strategy_section .content"),0,"zoom",500);
//zoomf(500,$(".brand_strategy_section .visuals"),-40,"zoom");
//zoomf(500,$(".brand_strategy_section .content"),-20,"zoom");

zoomf(1000,$(".brand_strategy_banner .other_details_inner"),0,"zoom",700);
zoomf(700,$(".brand_strategy_banner .other_details_inner"),0,"zoom",700);
zoomf(1200,$(".brand_strategy_banner .content"),0,"zoom",500);
//zoomf(500,$(".brand_strategy_banner .content"));
zoomf(1200,$(".brand_strategy_banner .visuals"),0,"zoom",500);
//zoomf(500,$(".brand_strategy_banner .visuals"));

zoomf(1800,$(".our_story_section"),0,"zoom",500);

zoomf(1500,$(".values_section.desktop-view .inner"));

zoomf(1300,$(".whoweare_section .whoweare_setion_width_section"),0,"zoom",500);
//zoomf(500,$(".whoweare_section .whoweare_setion_width_section"),-20);
//zoomf(500,$(".whoweare_section .whoweare_setion_width_section"),-20,"width");
zoomf(500,$(".footer_upper .pebbles button"),-55);

zoomf(1800,$(".banner .heading"),-10,"zoom",1300);
zoomf(1300,$(".banner .heading"),-10,"zoom",700);
//zoomf(600,$(".banner .heading"),-10);
zoomf(1500,$(".whoweare_section_video"),0,"zoom",500);


//zoomf(500,$(".talk_section"),-30);
//zoomf(500,$(".explore_more_section"),-35);
//zoomf(500,$(".testimonial_section"),-10);
zoomf(700,$(".values_section.mobile-view .content"),-10,"zoom",500);
zoomi(1500,$(".who_we_help_section .content"));
zoomi(1500,$(".video_section_outer"));

zoomf(500,$(".aboutus_section"));
//zoomf(500,$(".navbar-options"));
//zoomf(500,$(".navbar-top .navbar"));

//zoomf(500,$(".brand_lower p"));

zoomf(1800,$(".who_we_help_section .bulb-effect"),-10,"zoom",1000);
zoomf(1000,$(".who_we_help_section .bulb-effect"),0,"zoom",500);
//zoomf(500,$(".who_we_help_section .bulb-effect"));
});
	



function movingnoeffect(div){
	var no = parseInt(div.attr('data-no'));
	var time = parseInt(div.attr('data-time'));
	for(let i2=1;i2<=no;i2++){
		
		
					
		if(i2<=9){
		i2 = "0"+i2;
		}
		
	setTimeout(function(){
		div.html(i2);
	},time*i2);
	}
}

function wordchangeeffect(div,word_i){
	var words32 = div.attr('words').split(";");
	var wordremainetime = parseInt(div.attr('word-remaine-time'));
	//letterchangetime
	var lct = 100;
	
		var ws = words32[word_i-1].split("");
		div.html("");
		for(let i2=1;i2<=ws.length;i2++){
			setTimeout(function(){
				div.append(ws[i2-1]);
				
				if(ws.length == i2){
					var ws2 = ws.join("");
					setTimeout(function(){
					for(let i3=1;i3<=ws.length;i3++){
					
					setTimeout(function(){
					ws2 =ws2.slice(0,-1) 
					div.html(ws2);
					
						
						if(i3 == ws.length){
					
						if(word_i == words32.length){
						wordchangeeffect(div,1);
						}else{
						wordchangeeffect(div,word_i+1);
						}
					}
					
					},lct*i3);
						
					}
						},wordremainetime);
				}
			},lct*i2);	
		}
	
}
//zoom low
function zoomf(limit,data,plus=0,type="zoom",min_limit=0,allow_ex=0){
var zoom = 100;
if(window.screen.width < limit && min_limit < window.screen.width){
	var per = (window.screen.width/limit)*100;
	if((per+plus) < 90 || allow_ex==1){
	per = per+plus;
	}
	
	data.css(type,per+"%");
	   
	
}
}
//zoom high
function zoomi(limit,data,plus=0,type="zoom"){
var zoom = 100;
if(window.screen.width > limit ){
	var per = 100-((limit/window.screen.width)*100);
	
	if((per+plus) < 90){
	per = per+plus;
	}
	data.css(type,(100+per)+"%");
}
}

function zoomHW(limit,data,plus=0,type){
var zoom = 100;
if(window.screen.width > limit){
	var per = (limit/window.screen.width)*100;
	per = per+plus;
	var data2 = (parseInt(data.css(type))*per)/100;
			
	data.css(type,(parseInt(data.css(type))+data2)+"px");
}
}

function scrollF(){
	
var st = $(window).scrollTop();
	
var selected_id=0;
	var start = 100;
	var totalClass = $(".page-section").length;
	var l = parseInt($(".page-section").eq(0).css("height"));
	var pl = 0;
	var expertise_section_distance_top = 0;
	var screen80height = (window.screen.height*40)/100;
	var page_height=0;	
	for(let i = 1;i<=totalClass;i++){
		 l = l+parseInt($(".page-section").eq(i).css("height"));
		if($(".page-section").eq(i-1).hasClass("expertise_section")){
		expertise_section_distance_top=pl;
			
		}
		
		if($(".page-section").eq(i-1).hasClass('video_frame')){
		 	page_height = ((window.screen.height*80)/100);
		}else{
			 page_height = parseInt($(".page-section").eq(i-1).css("height"));
		}
	if(st > (pl-((80*window.screen.height)/100)) && st < ((pl+ page_height)-((10*window.screen.height)/100))){
		
	
		$(".page-section").eq(i-1).css("opacity","1");
		
	}else{
		
		if(!$(".page-section").eq(i-1).hasClass('video_frame')&&!$(".page-section").eq(i-1).hasClass('invisible_page')&&!$(".page-section").eq(i-1).hasClass('expertise_section')&&!$(".page-section").eq(i-1).hasClass('brand_strategy_section')&&!$(".page-section").eq(i-1).hasClass('brand_strategy_section')&&!$(".page-section").eq(i-1).hasClass('values_section')&&!$(".page-section").eq(i-1).hasClass('testimonial_section')&&!$(".page-section").eq(i-1).hasClass('brands_section')&&!$(".page-section").eq(i-1).hasClass('impact_section')){
					$(".page-section").eq(i-1).css("opacity","0");
		}
	}
		var pl_1=0;
		if($(".page-section").eq(i-1).hasClass('video_frame')){
		 pl = pl+((window.screen.height*80)/100);
		 pl_1 = ((window.screen.height*80)/100);
		}else{
		 pl = pl+parseInt($(".page-section").eq(i-1).css("height"));
		pl_1 = parseInt($(".page-section").eq(i-1).css("height"));
		}
		
		if($(".page-section").eq(i-1).hasClass("values_section")){
			selected_id = i-1;
			
		}
		

		
			
	
	//text effect
	
		
	if(parseInt(window.screen.width) < 1000){
	
	if(st < (pl-(pl_1+((window.screen.height*30)/100))) && !$(".page-section").eq(i-1).hasClass("banner")&& !$(".page-section").eq(i-1).hasClass("brand_strategy_section")){
		
		if(selected_id != 0){
		var w = ((st+window.screen.height)/(pl-(pl_1+((window.screen.height*30)/100))))*100;
		}else{
		var w = ((st)/(pl-(pl_1+((window.screen.height*30)/100))))*100;
		}

		
		$(".page-section").eq(i-1).find(".heading").css("color","transparent");
		if($(".page-section").eq(i-1).hasClass("whoweare_section")||$(".page-section").eq(i-1).hasClass("expertise_section")){
		$(".page-section").eq(i-1).find(".heading").css("background","linear-gradient(90deg, #000 "+w+"%,rgb(255,255,255,0.9) 0%)");
		}else{
		$(".page-section").eq(i-1).find(".heading").css("background","linear-gradient(90deg, #DAF301 "+w+"%,rgb(255,255,255,0.9) 0%)");
		}
		$(".page-section").eq(i-1).find(".heading").css("-webkit-background-clip","text");
	}    
	}else{
	    
	if(st > (pl-(parseInt($(".page-section").eq(i-1).css("height"))+parseInt($(".page-section").eq(i-2).css("height")))) && st < pl && !$(".page-section").eq(i-1).hasClass("banner")){
		var w = ((st-(pl-(parseInt($(".page-section").eq(i-1).css("height"))+parseInt($(".page-section").eq(i-2).css("height"))))))/(pl-(pl-parseInt($(".page-section").eq(i-1).css("height")))) *100;
		$(".page-section").eq(i-1).find(".heading").css("color","transparent");
		if($(".page-section").eq(i-1).hasClass("whoweare_section")||$(".page-section").eq(i-1).hasClass("expertise_section")){
		$(".page-section").eq(i-1).find(".heading").css("background","linear-gradient(90deg, #000 "+w+"%,rgb(255,255,255,0.9) 0%)");
		}else{
		$(".page-section").eq(i-1).find(".heading").css("background","linear-gradient(90deg, #DAF301 "+w+"%,rgb(255,255,255,0.9) 0%)");
		}
		$(".page-section").eq(i-1).find(".heading").css("-webkit-background-clip","text");
	}
	}
	
	}
	if(window.screen.width > 1000){
	if($(".expertise_section").length && $(".expertise_section").offset().top == st){
	
			
	var distance = ((parseInt($(".expertise_section .width_div23").width())-((10*parseInt($(".expertise_section .width_div23").width())/100)))/2);
	var z54 = parseInt($(".expertise_section .service_section").eq(0).css("zoom")*100);
	
	let w3 = (z54*parseInt($(".expertise_section .service_section .service_img").eq(0).width()))/100;
			
	var p65_min = 0;
		var p65_max = 100;
	
		if(expertise_section_distance_top<st && (expertise_section_distance_top+((p65_max*parseInt($(".expertise_section").height()))/100)) > st){

	var p45 = 100-((st/(expertise_section_distance_top+((p65_max*parseInt($(".expertise_section").height()))/100)))*100);
			

	$(".expertise_section .service_section").eq(0).css("transform","translate3d("+((p45*(distance-(parseInt(w3)*(1))))/100)+"px, 0px, 0px)");
	$(".expertise_section .service_section").eq(1).css("transform","translate3d("+((p45*(distance-(parseInt(w3)*(2))))/100)+"px, 0px, 0px)");
	$(".expertise_section .service_section").eq(2).css("transform","translate3d(-"+((p45*(distance-(parseInt(w3)*(2))))/100)+"px, 0px, 0px)");
	$(".expertise_section .service_section").eq(3).css("transform","translate3d(-"+((p45*(distance-(parseInt(w3)*(1))))/100)+"px, 0px, 0px)");
	}
		var p65_min = p65_max;
		var p65_max = p65_max+50;
		if((expertise_section_distance_top+((p65_min*parseInt($(".expertise_section").height()))/100))<st && (expertise_section_distance_top+((p65_max*parseInt($(".expertise_section").height()))/100)) > st){

			$(".expertise_section .service_img").attr("data-selected","1");
	 		$(".expertise_section .service_img_2").attr("data-selected","0");
		var p45 = ((st/(expertise_section_distance_top+((p65_max*parseInt($(".expertise_section").height()))/100)))*100);
			

		$(".expertise_section .service_section").eq(0).css("transform","rotateY("+((p45*88)/100)+"deg)");
		$(".expertise_section .service_section").eq(1).css("transform","rotateY("+((p45*88)/100)+"deg)");
		$(".expertise_section .service_section").eq(2).css("transform","rotateY("+((p45*88)/100)+"deg)");
		$(".expertise_section .service_section").eq(3).css("transform","rotateY("+((p45*88)/100)+"deg)");
		
		}
		var p65_min = p65_max;
		var p65_max = p65_max+50;
		if((expertise_section_distance_top+((p65_min*parseInt($(".expertise_section").height()))/100))<st && (expertise_section_distance_top+((p65_max*parseInt($(".expertise_section").height()))/100)) > st){
			$(".expertise_section .service_img").attr("data-selected","0");
	 		$(".expertise_section .service_img_2").attr("data-selected","1");
			
		var p45 = 100-((st/(expertise_section_distance_top+((p65_max*parseInt($(".expertise_section").height()))/100)))*100);
			
	
		$(".expertise_section .service_section").eq(0).css("transform","rotateY("+((p45*90)/100)+"deg)");
		$(".expertise_section .service_section").eq(1).css("transform","rotateY("+((p45*90)/100)+"deg)");
		$(".expertise_section .service_section").eq(2).css("transform","rotateY("+((p45*90)/100)+"deg)");
		$(".expertise_section .service_section").eq(3).css("transform","rotateY("+((p45*90)/100)+"deg)");
	
		if(p45 <= 10){
		$(".expertise_section .service_section").addClass('updownanimationinfinite');
		}else{
		$(".expertise_section .service_section").removeClass('updownanimationinfinite');
		}
		}
	/**setTimeout(function(){
		$(".expertise_section .service_section").eq(0).css("transform","rotateY(80deg)");
		$(".expertise_section .service_section").eq(1).css("transform","rotateY(80deg)");
		$(".expertise_section .service_section").eq(2).css("transform","rotateY(80deg)");
		$(".expertise_section .service_section").eq(3).css("transform","rotateY(80deg)");
		setTimeout(function(){
			$(".expertise_section .service_img").attr("data-selected","0");
	 		$(".expertise_section .service_img_2").attr("data-selected","1");
			$(".expertise_section .service_section").eq(0).css("transform","rotateY(0deg)");
		$(".expertise_section .service_section").eq(1).css("transform","rotateY(0deg)");
		$(".expertise_section .service_section").eq(2).css("transform","rotateY(0deg)");
		$(".expertise_section .service_section").eq(3).css("transform","rotateY(0deg)");
		},3000);
	},3000);*/
	
			

		}else{
			$(".expertise_section .service_section").removeClass('updownanimationinfinite');

	var distance = ((parseInt($(".expertise_section .width_div23").width())-((10*parseInt($(".expertise_section .width_div23").width())/100)))/2);
	var z54 = parseInt($(".expertise_section .service_section").eq(0).css("zoom")*100);
	
	let w3 = (z54*parseInt($(".expertise_section .service_section .service_img").eq(0).width()))/100;
		
		
		
	$(".expertise_section .service_section").eq(0).css("transform","translate3d("+(distance-(parseInt(w3)*(1)))+"px, 0px, 0px)");
	$(".expertise_section .service_section").eq(1).css("transform","translate3d("+(distance-(parseInt(w3)*(2)))+"px, 0px, 0px)");
	$(".expertise_section .service_section").eq(2).css("transform","translate3d(-"+(distance-(parseInt(w3)*(2)))+"px, 0px, 0px)");
	$(".expertise_section .service_section").eq(3).css("transform","translate3d(-"+(distance-(parseInt(w3)*(1)))+"px, 0px, 0px)");
	$(".expertise_section .service_img").attr("data-selected","1");
	 		$(".expertise_section .service_img_2").attr("data-selected","0");
		}
	
	w = (st/((50*window.screen.width)/100))*100;
	
	if($(".video_frame").length && st < 200){
		$(".video_frame video").css("height","200px");
		$(".video_frame video").css("width","300px");
		if(window.screen.width > 800){
			$(".video_frame video").css("transform","translate(0,-40vh)");
			}else{
			$(".video_frame video").css("transform","translate(0,-30vh)");
			
			}
	}
	if($(".video_frame").length && w > 100){
		var h654 = ((80*window.screen.height)/100);
		var w654 = ((80*window.screen.width)/100);
		
		$(".video_frame video").css("height",h654+"px");
		$(".video_frame video").css("width",w654+"px");
		$(".video_frame video").css("transform","translate(0,0px)");
		

	}
	if($(".video_frame").length && w <= 100 && st > 200){
		
		var h654 = ((80*window.screen.height)/100);
		var w654 = ((80*window.screen.width)/100);
		
		$(".video_frame video").css("height",((w*h654)/100)+"px");
		$(".video_frame video").css("width",((w*w654)/100)+"px");
		$(".video_frame video").css("transform","translate(0,-"+(((100-w)*((h654*40)/100))/100)+"px)");
	}
	if($(".video_frame").length && w < 20){
		$(".video_frame").attr("data-active","0");
		
				$(".video_frame video")[0].play();
				$(".video_frame video")[0].pause();
		$(".video_frame video").prop("currentTime",0);
	}
	if($(".video_frame").length && w >= 20){
	if($(".video_frame").attr("data-active") == "0"){
		
		$(".video_frame video").prop("currentTime",0);
		$(".video_frame video")[0].play();
		$(".video_frame").attr("data-active","1");
	}
	}
	
	
	
	
	
	
	
}else{
$(".page-section").animate({"opacity":1},'slow');
}
	//Expertise section
	
	if(window.screen.width<1000){
		$(".expertise_section .service_section").addClass('updownanimationinfinite');
	if($(".expertise_section").length && ($(".expertise_section").offset().top-((30*window.screen.height)/100)) <= st){
		if($(".expertise_section").attr("data-change") == "0"){
		$(".expertise_section .service_section").css("transition","0.5s");
		$(".expertise_section .service_section").css("transform","rotateY(80deg)");
		setTimeout(function(){
		$(".expertise_section .service_img").attr("data-selected","0");
	 	$(".expertise_section .service_img_2").attr("data-selected","1");
		$(".expertise_section .service_section").css("transform","rotateY(0deg)");
			
		},500);
			$(".expertise_section").attr("data-change","1");
		}
	}else if($(".expertise_section").length && ($(".expertise_section").offset().top-((30*window.screen.height)/100)) > st){
	
		if($(".expertise_section").attr("data-change") == "1"){
		$(".expertise_section .service_section").css("transform","rotateY(80deg)");
		setTimeout(function(){
		$(".expertise_section .service_img").attr("data-selected","1");
	 	$(".expertise_section .service_img_2").attr("data-selected","0");
	$(".expertise_section .service_section").css("transition","0.5s");
			$(".expertise_section .service_section").css("transform","rotateY(00deg)");		
		
		},500);
			$(".expertise_section").attr("data-change","0");
		}
		
	
	}
		if(window.screen.width<500){
		if($(".expertise_section").length && ($(".expertise_section").offset().top) == st){
			$(".expertise_section .heading").css("top","25%");
		}else if($(".expertise_section").length && ($(".expertise_section").offset().top) > st){
			$(".expertise_section .heading").css("top","10%");
		
		}
			
		}
		
		w = (st/((80*500)/100))*100;
	
	
	if($(".video_frame").length && st < ((10*parseInt($(".banner").css("height")))/100)){
		if(window.screen.width < 500){
			$(".video_frame video").css("height","100px");
			$(".video_frame video").css("width","150px");
			$(".video_frame video").css("transform","translate(0,-150px)");
		}else{
			$(".video_frame video").css("height","150px");
			$(".video_frame video").css("width","250px");
			if(window.screen.width > 800){
			$(".video_frame video").css("transform","translate(0,-20vh)");
			}else{
			$(".video_frame video").css("transform","translate(0,-15vh)");
			
			}
		}
	}
	if($(".video_frame").length && st < ((10*parseInt($(".banner").css("height")))/100)){
	if($(".video_frame").attr("data-active") == "1"){
		
		$(".video_frame video").prop("currentTime",0);
		$(".video_frame video")[0].pause();
		$(".video_frame").attr("data-active","0");
	}
	}
	if($(".video_frame").length && st > ((10*parseInt($(".banner").css("height")))/100)){
		
		if(window.screen.width < 500){
		var h654 = 200;
			
		}else{
		var h654 = 500;
		
		}
		var w654 = window.screen.width;
		
		$(".video_frame video").css("height",h654+"px");
		$(".video_frame video").css("width",w654+"px");
		$(".video_frame video").css("transform","translate(0,0px)");
		if($(".video_frame").attr("data-active") == "0"){
		
		$(".video_frame video").prop("currentTime",0);
		$(".video_frame video")[0].play();
		$(".video_frame").attr("data-active","1");
	}
		
	}
	
	if($(".video_frame").length){
		
		
		
		

	}
	}
	
	
	var bss_l = $(".brand_strategy_section").length;
	
	for(let i =1;i<=bss_l;i++){	
		
		
		
		var id = $(".brand_strategy_section").eq(i-1).attr("data-id");
		
		var min = 15;
		if(window.screen.width < 1500 && window.screen.width > 1000){
			
			if(window.screen.width < 1100){
				var plus = 22;
			}else if(window.screen.width < 1200){
				var plus = 18;
			}else if(window.screen.width < 1300){
				var plus = 16;
			}else if(window.screen.width < 1400){
				var plus = 14;
			}else{
			var plus = 12;
			}

		
		}else{
		var plus = 10;
		}
		
		
		
		var i2 = i;
		if(window.screen.height < 800){
			if(i==4){
			i2=1;
			}
		}
		$(".brand_strategy_section").eq(i-1).css("top",(plus+(min*i2))+"%");
		
		
	}
	
	if(st > $(".footer_upper").offset().top-parseInt($(".footer_upper").css("height"))){
		//$(".footer_upper .pebbles").addClass("updownAnimate3");
		
	}
}
$(document).ready(function(){
	setTimeout(function(){

	

	

		
 if($('#video_banner_section').length){
	document.getElementById('video_banner_section').play();
	}	
		
	function bannerChangebleWords(){
		var selected = $(".banner .changeable_words[data-selected='1']");
		$(".banner .changeable_words").attr('data-selected','0');
	}
},1500);
	
$(window).on("scroll",function(event){
	    

	scrollF();
	
});
	
	
	
    $(".close_contact_popup_form").click(function(){
        $(".main_contact_popup_form").hide();
    });
    $(".navbar_close").click(function(){
        $(".navbar-options").hide();
        $(".navbar-top").show();
        $("body").css("overflow-y","visible");

    });
    $(".navbar_open").click(function(){
        $(".navbar-options").show();
        $(".navbar-top").hide();
		$("body").css("overflow-y","hidden");
    });
	$(".service_dropdown").click(function(){
		$(".service_drop").toggle();
		if($(".service_drop").css("display")=="block"){
			$('i',this).removeClass('fa-arrow-down');
			$('i',this).addClass('fa-arrow-up');
			$(this).addClass('active');
		}else{
			$('i',this).removeClass('fa-arrow-up');
			$('i',this).addClass('fa-arrow-down');
			$(this).removeClass('active');
			
		}
	});
	/**$(".expertise_section .service_img").mouseenter(function(){
	 	$(".service_img").attr("data-selected","1");
	 	$(".service_img_2").attr("data-selected","0");
	 	$(this).attr("data-selected","0");
	 	$(this).next(".service_img_2").attr("data-selected","1");
	});
	$(".expertise_section .service_img_2").mouseout(function(){
	 	$(".service_img").attr("data-selected","1");
	 	$(".service_img_2").attr("data-selected","0");
	});*/
	$(".who_we_help_section .content_div").mouseenter(function(){
		$(".who_we_help_section .content_div").attr('data-selected',"0");
		$(".who_we_help_section .content_div .part1").attr('data-selected',"1");
		$(".who_we_help_section .content_div .part2").attr('data-selected',"0");
		$(".who_we_help_section .content_div .content_heading").attr('data-selected',"0");
		
		$(this).attr('data-selected',"1");
		$(".part1",this).attr('data-selected',"0");
		$(".part2",this).attr('data-selected',"1");
		$(".content_heading",this).attr('data-selected',"1");
	});
	$(".values_section .part1").mouseenter(function(){
		$(".values_section .part1").attr('data-selected',"1");
		$(".values_section .part2").attr('data-selected',"0");
		$(".values_section .part2Text").attr('data-selected',"0");
		var img = $(this).attr('data-img-change');
		
		$(".values_section .part24 .part1").attr("src",img);
		$(this).attr('data-selected',"0");
		$(this).next(".part2").attr('data-selected',"1");
		$(this).prev(".part2Text").attr('data-selected',"1");
		
	});
	
	$(".video_section_next").click(function(){
		var id = parseInt($(".video_section .video_div[data-selected='1']").attr('data-id'));
		var length = $(".video_section .video_div").length;
		
		
		if(id==0){
		$(".video_section .video_div[data-selected='1']").attr('data-selected',"0");
		$(".video_section .video_div").eq(1).attr('data-selected',"1");
		$(".video_section .video_div").eq(2).attr('data-selected',"2");
		$(".video_section .video_div").eq(3).attr('data-selected',"3");
		$(".video_section .video_div").eq(4).attr('data-selected',"-1");
		}else if(id==1){
		$(".video_section .video_div[data-selected='1']").attr('data-selected',"0");
		$(".video_section .video_div").eq(2).attr('data-selected',"1");
		$(".video_section .video_div").eq(3).attr('data-selected',"2");
		$(".video_section .video_div").eq(4).attr('data-selected',"3");
		$(".video_section .video_div").eq(0).attr('data-selected',"-1");
		}else if(id==2){
		$(".video_section .video_div[data-selected='1']").attr('data-selected',"0");
		$(".video_section .video_div").eq(3).attr('data-selected',"1");
		$(".video_section .video_div").eq(4).attr('data-selected',"2");
		$(".video_section .video_div").eq(0).attr('data-selected',"3");
		$(".video_section .video_div").eq(1).attr('data-selected',"-1");
		}else if(id==3){
		$(".video_section .video_div[data-selected='1']").attr('data-selected',"0");
		$(".video_section .video_div").eq(4).attr('data-selected',"1");
		$(".video_section .video_div").eq(0).attr('data-selected',"2");
		$(".video_section .video_div").eq(1).attr('data-selected',"3");
		$(".video_section .video_div").eq(2).attr('data-selected',"-1");
		}else if(id==4){
		$(".video_section .video_div[data-selected='1']").attr('data-selected',"0");
		$(".video_section .video_div").eq(0).attr('data-selected',"1");
		$(".video_section .video_div").eq(1).attr('data-selected',"2");
		$(".video_section .video_div").eq(2).attr('data-selected',"3");
		$(".video_section .video_div").eq(3).attr('data-selected',"-1");
		}
	});
	$(".video_section_previous").click(function(){
		var id = parseInt($(".video_section .video_div[data-selected='1']").attr('data-id'));
		var length = $(".video_section .video_div").length;
		
		
		if(id==0){
		$(".video_section .video_div[data-selected='1']").attr('data-selected',"2");
		$(".video_section .video_div").eq(1).attr('data-selected',"3");
		$(".video_section .video_div").eq(2).attr('data-selected',"-1");
		$(".video_section .video_div").eq(3).attr('data-selected',"0");
		$(".video_section .video_div").eq(4).attr('data-selected',"1");
		
		
		}else if(id==1){
		$(".video_section .video_div[data-selected='1']").attr('data-selected',"2");
		$(".video_section .video_div").eq(2).attr('data-selected',"3");
		$(".video_section .video_div").eq(3).attr('data-selected',"-1");
		$(".video_section .video_div").eq(4).attr('data-selected',"0");
		$(".video_section .video_div").eq(0).attr('data-selected',"1");

		}else if(id==2){
		$(".video_section .video_div[data-selected='1']").attr('data-selected',"2");
		$(".video_section .video_div").eq(3).attr('data-selected',"3");
		$(".video_section .video_div").eq(4).attr('data-selected',"-1");
		$(".video_section .video_div").eq(0).attr('data-selected',"0");
		$(".video_section .video_div").eq(1).attr('data-selected',"1");
		}else if(id==3){
		$(".video_section .video_div[data-selected='1']").attr('data-selected',"2");
		$(".video_section .video_div").eq(4).attr('data-selected',"3");
		$(".video_section .video_div").eq(0).attr('data-selected',"-1");
		$(".video_section .video_div").eq(1).attr('data-selected',"0");
		$(".video_section .video_div").eq(2).attr('data-selected',"1");
		}else if(id==4){
		$(".video_section .video_div[data-selected='1']").attr('data-selected',"2");
		$(".video_section .video_div").eq(0).attr('data-selected',"3");
		$(".video_section .video_div").eq(1).attr('data-selected',"-1");
		$(".video_section .video_div").eq(2).attr('data-selected',"0");
		$(".video_section .video_div").eq(3).attr('data-selected',"1");
		}
	});
	$(".who_we_help_section .bottom-div .part1").mouseenter(function(){
	$(".who_we_help_section .bottom-div .part1").attr('data-selected',"0");
	$(".who_we_help_section .bottom-div .part2").attr('data-selected',"1");
	
	
	
	});
	
	$(".explore_more_section .c1 .content_text p").mouseenter(function(){
		$(".explore_more_section .c1 .content_text p").attr('data-selected',"1");
		$(".explore_more_section .c1 .content_text .content_video").attr('data-selected',"0");
		$(".explore_more_section .c1 .content_heading").attr('data-selected',"0");
		
		$(this).attr('data-selected',"0");
		$(this).next().attr('data-selected',"1");
		
		$(this).parent().parent().prev().find(".content_heading").attr('data-selected',"1");
		
	});
	
	$(".video_section .navigate-arrows .inner0").click(function(){
		var src = $(".video_section .video_div[data-selected='1'] video source").attr('src');
		$(".main_whoweare_section_video video source").attr("src",src);
		
		$(".main_whoweare_section_video").show();
		
		$(".main_whoweare_section_video video")[0].load();
		$(".main_whoweare_section_video video")[0].play();
	});
	
	
	$(".who_we_help_section .bulb-effect").mouseenter(function(){
		$(".who_we_help_section .bulb-effect.before").hide();
		$(".who_we_help_section .bulb-effect.after").show();
		$(".who_we_help_section .inner").css("background-color","#DAF301");
		$(".who_we_help_section .content .content_div").css("background-color","#000");
		$(".who_we_help_section .heading").css("color","transparent");
		$(".who_we_help_section .heading").css("background","linear-gradient(90deg, #000 "+70+"%,rgb(255,255,255) "+(100-70)+"%)");
		$(".who_we_help_section .heading").css("-webkit-background-clip","text");
	});
	$(".who_we_help_section .bulb-effect").mouseout(function(){
		$(".who_we_help_section .bulb-effect.before").show();
		$(".who_we_help_section .bulb-effect.after").hide();
		$(".who_we_help_section .inner").css("background-color","transparent");
		$(".who_we_help_section .content .content_div").css("background-color","rgb(255,255,255,0.02)");
		$(".who_we_help_section .heading").css("color","transparent");
		$(".who_we_help_section .heading").css("background","linear-gradient(90deg, #DAF301 "+70+"%,rgb(255,255,255,0.9) "+(100-70)+"%)");
		$(".who_we_help_section .heading").css("-webkit-background-clip","text");
	});
	$(".brand_strategy_section .visuals .main-image").mouseenter(function(){
		$(this).attr('data-selected',"0");
		$(this).next().attr('data-selected',"1");
	});
	$(".brand_strategy_section .visuals .main-image_2").mouseout(function(){
		$(this).attr('data-selected',"0");
		$(this).prev().attr('data-selected',"1");
	});
	$(".video_customize2").click(function(){
		if($(this).prop("muted")){
		$(this).prop("muted",false);
		$(this).attr("data-cursor","1");
		}else{
			$(this).prop("muted",true);
		$(this).attr("data-cursor","2");
		
			
		}
		
	});
	$(".whoweare_section_video .mockup").click(function(){
		
		if($(this).prev()[0].paused){
		$(this).prev()[0].play();
		$(this).next().next().removeClass("fa-pause");
		$(this).next().next().addClass("fa-play");
		}else{
		$(this).prev()[0].pause();
		$(this).next().next().addClass("fa-pause");
		$(this).next().next().removeClass("fa-play");
			
		}
		var type = $(this).next().attr("data-type");
		if(type == "mute"){
	$(this).prev().prop("muted",true);
	
		}else{
	$(this).prev().prop("muted",false);
		
		}
	});
	
	$(".video_mute").click(function(){
	var type = $(this).attr("data-type");
		
		if(type == "mute"){
	$(this).attr("data-type","play");
	$("i",this).removeClass("fa-volume-off");
	$("i",this).addClass("fa-volume-up");
	$(this).prev().prev().prop("muted",false);
		}else{
	$("i",this).addClass("fa-volume-off");
	$("i",this).removeClass("fa-volume-up");
	$(this).attr("data-type","mute");
	$(this).prev().prev().prop("muted",true);
		
		}

	});
	$(".side_contact_button .mainButton").click(function(){
	if($(".side_contact_button .sideButtonDiv").attr("data-selected") == "0"){
		$(".side_contact_button .sideButtonDiv").attr("data-selected","1");
		$("i",this).removeClass("fa-question");
		$("i",this).addClass("fa-close");
	}else{
	$(".side_contact_button .sideButtonDiv").attr("data-selected","0");
		$("i",this).addClass("fa-question");
		$("i",this).removeClass("fa-close");
	}
	

	});
	$(".whoweare_section_video .close_video").click(function(){
	$(".main_whoweare_section_video").hide();
		$(".main_whoweare_section_video .video_mute").attr("data-type","mute");
		$(".main_whoweare_section_video .video_mute i").removeClass("fa-volume-up");
		
		$(".main_whoweare_section_video .video_mute i").addClass("fa-volume-off");
		$(".main_whoweare_section_video .play_pause").addClass("fa-play");
		$(".main_whoweare_section_video .play_pause").removeClass("fa-pause");
		$(".main_whoweare_section_video video").prop("muted",true);
		$(".main_whoweare_section_video video")[0].pause();
			
	});
	$(".founder_section .content").mouseenter(function(){
		$(".founder_section .content").attr("data-selected","1");
		$(".founder_section .content2").attr("data-selected","0");
		$(this).attr("data-selected","0");
		$(this).next().attr("data-selected","1");
		
	});
	$(".founder_section .content2").mouseout(function(){
		$(".founder_section .content").attr("data-selected","1");
		$(".founder_section .content2").attr("data-selected","0");
		
		
	});
	$(".testimonial_section .hover").mouseenter(function(){
		$(".testimonial_section .review .effect").attr("data-effect","0");
		$(".testimonial_section .review .effect").attr("data-effect","0");
		$(this).prev().attr("data-effect","1");
		
	});
	
	$(".testimonial_section .hover").mouseout(function(){
		$(".testimonial_section .review .effect").attr("data-effect","0");
		
		
		
	});
	
	$(".button-style-div .button-style-span2").mouseenter(function(){
		$(this).css("background","#DAF301");
		$(this).css("left","-10px");
		$(this).css("top","10px");
		$(this).css("color","black");
	});
$(".button-style-div .button-style-span2").mouseout(function(){
		$(this).css("background","transparent");
		$(this).css("left","0px");
		$(this).css("top","0px");
		$(this).css("color","white");
	});
	$(".let_talk_link").mouseenter(function(){
		$(".navbar .link .button_before").css("clip-path","circle(141.2% at 0 100%)");
		$(this).css("color","black");
	});
	$(".let_talk_link").mouseout(function(){
		$(".navbar .link .button_before").css("clip-path","circle(0.0% at 0 100%)");
		$(this).css("color","white");
		
	});
	
	$(".audio_control .audio_style_1").click(function(){
		
		if(!$(".page_audio")[0].paused){
			$(".page_audio")[0].pause();
		$(".audio_control .audio_style_1").attr("data-select","0");
		$(".audio_control .audio_style_2").attr("data-select","1");
		}else{
		$(".page_audio")[0].play();
		$(".audio_control .audio_style_1").attr("data-select","1");
		$(".audio_control .audio_style_2").attr("data-select","0");		
		}
	});
	$(".audio_control .audio_style_2").click(function(){
		if($(".page_audio")[0].paused){
		$(".page_audio")[0].play();
		$(".audio_control .audio_style_1").attr("data-select","1");
		$(".audio_control .audio_style_2").attr("data-select","0");
		}else{
		$(".page_audio")[0].pause();
		$(".audio_control .audio_style_1").attr("data-select","0");
		$(".audio_control .audio_style_2").attr("data-select","1");
		}
	});
	$(".navbar .audio_control img").mouseenter(function(){
		$(".navbar .audio_control .before").css("clip-path","circle(141.2% at 0 100%)");
	});
	$(".navbar .audio_control img").mouseout(function(){
		$(".navbar .audio_control .before").css("clip-path","circle(0.0% at 0 100%)");
		
	});
	
	
	
	
});

