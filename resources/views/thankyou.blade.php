@extends("layouts.front_app")
@section("content")
<div class="thankyou_section">
	<center>
		<div class="col-lg-3 col-12 div">
	<video autoplay loop muted playsinline>
		<source src="{{(env('IMG_FETCH_URL').'uploaded_files/'.str_ireplace('.gif', '.mp4', ($pages['thankyou'][0]->img ?? '')))}}" type="video/mp4">
		<source src="{{ asset('uploaded_files/'.str_ireplace('.gif', '.mp4', ($pages['thankyou'][0]->img ?? ''))) }}" type="video/mp4">
	</video>
	<{{ $pages['thankyou'][1]->heading_tag ?? 'h5' }} class="content"><span>{{$pages['thankyou'][1]->text ?? ''}} </span> {{$pages['thankyou'][2]->text ?? ''}}</{{ $pages['thankyou'][1]->heading_tag ?? 'h5' }}>
	<a class="link" href="{{route('index')}}"><i class="fa fa-arrow-left"></i> Go Back</a>
		</div>
			
	</center>
								  
</div>
@endsection