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
                <h3>Frequently Asked Questions</h3>
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
            <form action="{{ url('/faqs/post') }}" method="post" enctype="multipart/form-data">

                {{ csrf_field() }}
                    <div class="form-group">
                        <label for="">Question:</label>
                        <input type="text" placeholder="Title" value="" class="form-control" name="question">
                    </div>

                    <div class="form-group">
                        <label for="">Answer</label>
                        <textarea class="form-control" rows="10" placeholder="Description" name="answer" id="details"></textarea>
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