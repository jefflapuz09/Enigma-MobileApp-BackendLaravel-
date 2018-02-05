@extends('admin.index')

@section('style')
<link href="{{ asset('css/toastr.css') }}" rel="stylesheet">
@stop

@section('content')

<script src="{{ asset('js/jquery.min.js') }}"></script>
<script src="{{  asset('js/toastr.js')  }}"></script>

<div class="panel panel-primary">
        <div class="panel-heading">Category</div>
        @if(session('success'))
        <script type="text/javascript">
            toastr.success(' <?php echo session('success'); ?>', 'Success!')
        </script>
        @endif
        @if(session('error'))
            <script type="text/javascript">
                toastr.error(' <?php echo session('error'); ?>', "There's something wrong!")
            </script>
        @endif
        <div class="panel-body">
                <div class="pull-right" style="margin-bottom:15px;"> 
                        <a href="{{ url('/post/create') }}" type="button" class="btn btn-success btn-sm" data-toggle="tooltip" data-placement="top" title="New record">
                            New Record
                        </a>
                    </div>
            <table id="example" class="display" cellspacing="0" width="100%">
                        <thead>
                            <tr>
                                <th>Title</th>
                                <th>Image</th>
                                <th>Admin</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                           @foreach($post as $posts)
                                <tr>
                                    <td>{{$posts->title}}</td>
                                    <td><img src="{{ asset($posts->image) }}" class="img-fluid" style="max-width:200px;"></td>
                                    <td>{{$posts->admin}}</td>
                                    <td>
                                        <a href="{{ url('/post/reactivate/id='.$posts->id) }}" onclick="return reacForm()" type="button" class="btn btn-danger btn-sm" data-toggle="tooltip" data-placement="left" title="Reactivate record">
                                            <i class="fa fa-recycle" aria-hidden="true"></i>
                                        </a>  
                                    </td>
                                </tr>
                          @endforeach
                        </tbody>
                </table>
                <div class="form-group pull-right">
                        <label class="checkbox-inline"><input type="checkbox"  onclick="document.location='{{ url('/post') }}';" id="showDeactivated"> Show records</label>
                </div>
        </div>
</div>

@endsection

@section('script')
<script>
        
    function reacForm(){
        var x = confirm("Are you sure you want to reactivate this record?");
        if (x)
          return true;
        else
          return false;
     }

</script>
@stop