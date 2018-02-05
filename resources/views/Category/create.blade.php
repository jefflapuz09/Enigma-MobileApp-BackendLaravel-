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
                <h3>Category</h3>
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
            <form action="{{ url('/category/post') }}" method="post">

                {{ csrf_field() }}
                    <div class="form-group">
                        <label for="">Name:</label>
                        <input type="text" placeholder="Name" value="" class="form-control" name="name">
                    </div>
                    <div class="form-group">
                        <label for="">Description</label>
                        <textarea class="form-control" rows="12" placeholder="Description" name="description" id="details"></textarea>
                    </div>
                    <div class="pull-right" style="margin-right:15px;">
                        <button type="reset" class="btn btn-success">Clear</button>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </form>     
        </div>
   
    </div>
@endsection

@section('script')

@stop