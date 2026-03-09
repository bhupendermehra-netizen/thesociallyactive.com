@extends("layouts.front_app")
@section("content")

	<div class="contact_section" style="margin-top:100px">
        <center>
        <div class="container">
            <h1 class="heading">Contact Us</h1>
            <h3 class="subheading">Get in Touch</h3>
            <p class="content">Lorem ipsum dolor sit amet consectetur adipisicing elit.</p>
            <div class="form col-lg-8 col-12">
                
                @include("component.contact_form")
            </div>
        </div>
        </center>
    </div>
@endsection