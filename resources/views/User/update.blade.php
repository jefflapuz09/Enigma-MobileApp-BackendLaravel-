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
                <h3>User</h3>
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
            <form action="{{ url('/user/update/id='.$post->id) }}" method="post">

                {{ csrf_field() }}
                
                    <div class="form-group">
                    <label for="">Name:</label>
                    <input type="text" placeholder="Name" value="{{$post->name}}" class="form-control" name="name">
                    </div>
                    <div class="form-group">
                            <label for="sel1">Gender:</label>              
                            <select required class="select2 form-control" name="gender" id="sel1">
                            <option @if($post->gender == 1) selected = "selected" @endif value='1'>Male</option>
                            <option @if($post->gender == 2) selected = "selected" @endif value='2'>Female</option>
                            </select>
                    </div>
                    <div class="form-group">
                    <label for="">Email:</label>
                    <input type="email" required placeholder="Email" value="{{$post->email}}" class="form-control" name="email">
                    </div>
                    <div class="form-group">
                    <label for="">Password:</label>
                    <input type="password" required placeholder="Password" value="" class="form-control" name="password">
                    </div>
                    <div class="form-group">
                    <label for="">Confirm Password:</label>
                    <input type="password" required placeholder="Confirm Password" value="" class="form-control" name="password_confirmation">
                    </div>
               
        </div>
        <div class="col-sm-6">
                <div class="form-group">
                <b><label for="">Description</label></b>
                <textarea class="form-control" rows="12" name="description" id="details"><?php echo $post->description ?></textarea>
                </div>
            </div>
            <div class="pull-right" style="margin-right:15px;">
                <button type="reset" class="btn btn-success">Clear</button>
                <button type="submit" class="btn btn-primary">Submit</button>
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
@stop