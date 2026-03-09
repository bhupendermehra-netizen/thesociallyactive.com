@php
$services = explode(";",header_footer()["main_component"][3]->text);
@endphp
<form action="{{route('query')}}" method="POST">
				@csrf
                <div class="row col-lg-10 col-12">
                    <div class="col-lg-6 col-12 mb-3 fields">
                        <label for="name">Name</label>
                        <input type="name" name="name" required>
                    </div>
                    <div class="col-lg-6 col-12 mb-3 fields">
                        <label for="email">Email</label>
                        <input type="email" name="email" required>
                    </div>
                    <div class="col-lg-6 col-12 mb-3 fields">
                        <label for="phone">Phone Number</label>
                        <input type="tel" name="phone"minlength="10"maxlength="10" required>
                    </div>
                    <div class="col-lg-6 col-12 mb-3 fields">
                        <label for="Services">Services</label>
                        <select name="service" required>
                            @for($i=0;$i<count($services);$i++)
                            <option value="{{$services[$i]}}">{{$services[$i]}}</option>
						@endfor
                        </select>
                    </div>
                    <div class="col-lg-12 col-12 mb-3 fields">
                        <label for="message">Message</label>
                        <input type="text" name="message" required>
                    </div>
                </div>
                <button type="submit">Send Message</button>
				</form>