	@extends("layouts.front_app")
@section("content")
<div class="extra_page_section">
	
<div class="container">
	<h1 class="heading">{{$pages['content'][0]->text}}</h1>
	<div style="color:white">
	{!!$pages['content'][1]->text!!}
	</div>
</div>
	
		
</div>
@endsection