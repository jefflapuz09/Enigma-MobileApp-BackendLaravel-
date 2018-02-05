@extends('admin.index')

@section('style')
<link href="{{ asset('css/toastr.css') }}" rel="stylesheet">
@stop

@section('content')
<script src="{{ asset('js/jquery.min.js') }}"></script>
<script src="{{  asset('js/toastr.js')  }}"></script>
    <div class="row">
        <div class="col-sm-6">
            <div>
                <h3>Post</h3>
            </div>
            @if ($errors->any())
            <script type="text/javascript">
                toastr.error(' <?php echo implode('', $errors->all(':message')) ?>', "There's something wrong!")
            </script>          
            @endif  
            @if(session('error'))
                <script type="text/javascript">
                    toastr.error(' <?php echo session('error'); ?>', "There's something wrong!")
                </script>
            @endif
            <form action="{{ url('/post/post') }}" method="post" enctype="multipart/form-data">

                {{ csrf_field() }}
                    <div class="form-group">
                        <label for="">Title:</label>
                        <input type="text" placeholder="Title" value="" class="form-control" name="title">
                    </div>
                    <div class="form-group">
                            <label for="sel1">Admin:</label>              
                            <select required class="select2 form-control" name="adminId" id="sel1">
                                @foreach($admin as $admins)
                                    <option value='{{$admins->id}}'>{{$admins->name}}</option>
                                @endforeach
                            </select>
                    </div>
                    <div class="form-group">
                            <label for="sel1">Genre:</label>              
                            <select required class="select2 form-control" name="categoryId" id="sel1">
                                @foreach($genre as $genres)
                                    <option value='{{$genres->id}}'>{{$genres->name}}</option>
                                @endforeach
                            </select>
                    </div>
                    <div class="form-group">
                        <label>Publish Date:</label>
        
                        <div class="input-group date">
                          <div class="input-group-addon">
                            <i class="fa fa-calendar"></i>
                          </div>
                          <input type="text" name="created_at" class="form-control pull-right" id="datepicker">
                        </div>
                        <!-- /.input group -->
                      </div>
        </div>
        <div class="col-sm-6">
                <div class="form-group" style="margin-top:10px; border:1px solid black; padding:10px" >
                        <center><img class="img-responsive" id="pic" src="{{ URL::asset('img/grey-pattern.png')}}" style="max-width:300px; background-size: contain" /></center>
                        <b><label style="margin-top:20px;" for="exampleInputFile">Photo Upload</label></b>
                        <input type="file" class="form-control-file" name="image" onChange="readURL(this)" id="exampleInputFile" aria-describedby="fileHelp">
                    </div>

        </div>   
        <div class="col-sm-12">
                    <div class="form-group">
                        <label for="">Description</label>
                        <textarea class="form-control" rows="10" placeholder="Description" name="description" id="details"></textarea>
                    </div>

                    
                <div class="pull-right" style="margin-right:15px;">
                        <button type="reset" class="btn btn-success">Clear</button>
                        <button type="submit" class="btn btn-primary">Submit</button>
                </div> 
        </div>
    </form>
    </div>
@endsection

@section('script')
<script src="{{ url('tinymce/js/tinymce/tinymce.min.js') }}"></script>
<script>
        tinymce.init({
            selector: 'textarea',
            plugins: 'image code',
            toolbar: 'formatselect | bold italic strikethrough forecolor backcolor | link | alignleft aligncenter alignright alignjustify  | numlist bullist outdent indent  | removeformat | undo redo | code',
            image_title: true, 
            automatic_uploads: true,
            file_picker_types: 'image', 
            file_picker_callback: function(cb, value, meta) {
              var input = document.createElement('input');
              input.setAttribute('type', 'file');
              input.setAttribute('accept', 'image/*');
              input.onchange = function() {
                var file = this.files[0];
                
                var reader = new FileReader();
                reader.onload = function () {
          
                  var id = 'blobid' + (new Date()).getTime();
                  var blobCache =  tinymce.activeEditor.editorUpload.blobCache;
                  var base64 = reader.result.split(',')[1];
                  var blobInfo = blobCache.create(id, file, base64);
                  blobCache.add(blobInfo);
                  cb(blobInfo.blobUri(), { title: file.name });
                };
                reader.readAsDataURL(file);
              };
              
              input.click();
            }
          });
</script>
    <script>
            $( document ).ready(function() {
                $('#datepicker').datepicker({
                    autoclose: true
                  })
              
            });
    </script>
@stop