
@extends("admin.layout.app")
@section("content")
      <div class="w-full px-6 py-6 mx-auto">
        <div class="flex flex-wrap -mx-3">
          <div class="flex-none w-full max-w-full px-3">
            <div class="relative flex flex-col min-w-0 mb-6 break-words bg-white border-0 border-transparent border-solid shadow-soft-xl rounded-2xl bg-clip-border">
              <div class="p-6 pb-0 mb-0 bg-white border-b-0 border-b-solid rounded-t-2xl border-b-transparent">
                <form action="{{route('admin.page.update',$page->id)}}" method="Post" enctype="multipart/form-data">
                  @csrf
                  <div class="row">
                    <div class="col-lg-4 col-12 mb-3">
                      <label>Page</label>
						  <input class="form-control" type="name" name="page" value="{{$page->page}}" required>
                      
                    </div>
                    <div class="col-lg-4 col-12 mb-3">
                      <label>Title</label>
                      <input class="form-control" type="name" name="title" value="{{$page->title}}" required>
                    </div>
                    <div class="col-lg-4 col-12 mb-3">
                      <label>Section</label>
                      <input class="form-control" type="text" name="section" value="{{$page->section}}" required>
                    </div>
                    <div class="col-lg-12 mb-3">
                      <h5>Fields</h5>
                      
                     {{--<button class="btn btn-primary add_fields" type="button">Add</button>--}}
                      <div class="">
                        <table class="table table-bordered">
                          <thead>
                            <th>Id</th>
                            <th>Name</th>
                            <th>Text</th>
                            <th>Link</th>
                            <th>Image</th>
                            <th>Type</th>
                          </thead>
                          <tbody class="field_div">
                            @php
                            $fields = json_decode($page->fields);
                            @endphp
                            @foreach($fields as $key=> $data)
                            <tr>
								<td>{{ $key}}</td>
								<td>
								
                              <input class="form-control" type="text" name="name[]" value="{{$data->name}}" readonly>
								
									</td>
                              <td>
								  @if($data->type=="text"||$data->type=="link")
								  <textarea class="form-control @if(($page->id == 72 && $key==1)||($page->id == 73 && $key==1)) textEditor @endif" type="text" name="text[]" >{{isset($data->text)?$data->text:''}}</textarea>
								  @else
								  <textarea style="display:none" class="form-control" type="text" name="text[]">{{isset($data->text)?$data->text:''}}</textarea>
								  -
								  
								@endif
								</td>
                              <td>
								  @if($data->type=="link")
								  <input class="form-control" type="text" name="link[]"value="{{isset($data->link)?$data->link:''}}">
								  @else
								  	 <input style="display:none" class="form-control" type="text" name="link[]"value="{{isset($data->link)?$data->link:''}}">
-
								  @endif
								</td>

                              <td>
                                @if($data->type=="image")
								  @if(str_contains($data->img,".mp4"))
                                <video style="height:200px;width:200px;object-fit:contain;border:1px solid black;border-radius:0.5rem" muted autoplay loop>
									<source src="{{(env('IMG_FETCH_URL').'uploaded_files/'.$data->img)}}" type="video/mp4">
								  </video>
								  @elseif(str_contains($data->img,".mp3"))
								  <audio controls loop>
									<source src="{{(env('IMG_FETCH_URL').'uploaded_files/'.$data->img)}}" type="video/mp4">
								  </audio>
								  @else
								  <img style="height:100px;width:100px;object-fit:cover;border-radius:0.5rem" src="{{(env('IMG_FETCH_URL').'uploaded_files/'.$data->img)}}">
								  @endif
								  <input class="form-control" type="file" name="image[]">
								  @else
								  <input style="display:none" class="form-control" type="file" name="image[]">
								  -
                                @endif
                                
                              <td>
                                <select class="form-control" name="type[]">
                                  <option value="text" {{$data->type=="text"?'selected':'disabled'}}>Text</option>
                                  <option value="image"{{$data->type=="image"?'selected':'disabled'}}>image</option>
                                  <option value="link"{{$data->type=="link"?'selected':'disabled'}}>Link</option>
                                </select>
                              </td>
                            </tr>
                            @endforeach
                          </tbody>
                        </table>
                      </div>
                    </div>
                  </div>
                  <button class="btn btn-success btn-lg" type="submit">Submit</button>
                </form>
            </div>
          </div>
        </div>

        
      </div>
    </main>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

    <script>
      $(document).ready(function(){
          	var editor1 = new RichTextEditor(".textEditor");

        $(".add_fields").click(function(){
          
          $(".field_div").append(`
          <tr>
                              <td><input class="form-control" type="text" name="name[]"></td>
                              <td><input class="form-control" type="text" name="text[]"></td>
                              <td><input class="form-control" type="text" name="link[]"></td>
                              <td><input class="form-control" type="file" name="image[]"></td>
                              <td>
                                <select class="form-control" name="type[]">
                                  <option value="text">Text</option>
                                  <option value="image">image</option>
                                  <option value="link">Link</option>
                                </select>
                              </td>
                            </tr>
          `);
        });
      });
      </script>
@endsection