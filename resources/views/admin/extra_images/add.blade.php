
@extends("admin.layout.app")
@section("content")
      <div class="w-full px-6 py-6 mx-auto">
        <div class="flex flex-wrap -mx-3">
          <div class="flex-none w-full max-w-full px-3">
            <div class="relative flex flex-col min-w-0 mb-6 break-words bg-white border-0 border-transparent border-solid shadow-soft-xl rounded-2xl bg-clip-border">
              <div class="p-6 pb-0 mb-0 bg-white border-b-0 border-b-solid rounded-t-2xl border-b-transparent">
                <form action="{{route('admin.extraImage.add')}}" method="Post" enctype="multipart/form-data">
                  @csrf
                  <div class="row">
                    <div class="col-lg-4 col-12 mb-3">
                      <label>Page</label>
                      <input class="form-control" type="name" name="page" list="page_list" required value="{{$page ?? ""}}">
                      <datalist id="page_list">
                        @foreach($pages as $data)
                        <option value="{{$data->id}}">{{$data->page}}</option>
                        @endforeach
                      </datalist>
                    </div>
                    <div class="col-lg-4 col-12 mb-3">
                      <label>Image</label>
                      <input class="form-control" type="file" name="banner" required>
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

    
@endsection