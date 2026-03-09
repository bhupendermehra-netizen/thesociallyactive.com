@extends("layouts.front_app")
@section("content")
<div class="thankyou_section">
	<center>
		<div class="col-lg-3 col-12 div">
	<img src="{{(env('IMG_FETCH_URL').'uploaded_files/'.$pages['thankyou'][0]->img)}}">
	<h5 class="content"><span>{{$pages['thankyou'][1]->text}} </span> {{$pages['thankyou'][2]->text}}</h5>
	<a class="link" href="{{route('index')}}"><i class="fa fa-arrow-left"></i> Go Back</a>
		</div>
			
	</center>
								  
</div>
@endsection