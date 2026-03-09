
@extends("admin.layout.app")
@section("content")
      <div class="w-full px-6 py-6 mx-auto">
        <div class="flex flex-wrap -mx-3">
          <div class="flex-none w-full max-w-full px-3">
            <div class="relative flex flex-col min-w-0 mb-6 break-words bg-white border-0 border-transparent border-solid shadow-soft-xl rounded-2xl bg-clip-border">
              <div class="p-6 pb-0 mb-0 bg-white border-b-0 border-b-solid rounded-t-2xl border-b-transparent">
                <form action="{{route('admin.page.add')}}" method="Post" enctype="multipart/form-data">
                  @csrf
                  <div class="row">
                    <div class="col-lg-4 col-12 mb-3">
                      <label>Page</label>
                      <input class="form-control" type="name" name="page" list="page_list" required>
                      <datalist id="page_list">
                        @foreach($pages as $data)
                        <option value="{{$data->page}}">{{$data->page}}</option>
                        @endforeach
                      </datalist>
                      
                    </div>
                    <div class="col-lg-4 col-12 mb-3">
                      <label>Title</label>
                      <input class="form-control" type="name" name="title" required>
                    </div>
                    <div class="col-lg-4 col-12 mb-3">
                      <label>Section</label>
                      <input class="form-control" type="text" name="section" required>
                    </div>
                    <div class="col-lg-12 mb-3">
                      <h5>Fields</h5>
                      
                      <button class="btn btn-primary add_fields" type="button">Add</button>
                      <div class="">
                        <table class="table table-bordered">
                          <thead>
                            <th>Name</th>
                            <th>Text</th>
                            <th>Link</th>
                            <th>Image</th>
                            <th>Type</th>
                          </thead>
                          <tbody class="field_div">
                            
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