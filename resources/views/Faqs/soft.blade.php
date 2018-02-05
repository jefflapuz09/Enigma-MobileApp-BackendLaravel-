@extends('admin.index')

@section('style')
<link href="{{ asset('css/toastr.css') }}" rel="stylesheet">
@stop

@section('content')

<script src="{{ asset('js/jquery.min.js') }}"></script>
<script src="{{  asset('js/toastr.js')  }}"></script>

<div class="panel panel-primary">
        <div class="panel-heading">Frequently Asked Questions</div>
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
                        <a href="{{ url('/faqs/create') }}" type="button" class="btn btn-success btn-sm" data-toggle="tooltip" data-placement="top" title="New record">
                            New Record
                        </a>
                    </div>
            <table id="example" class="display" cellspacing="0" width="100%">
                        <thead>
                            <tr>
                                <th>Question</th>
                                <th>Answer</th>
                                <th  width="100px">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                           @foreach($post as $posts)
                                <tr>
                                    <td>{{$posts->question}}</td>
                                    <td><?php echo $posts->answer?></td>
                                    <td>
                                        <a href="{{ url('/faqs/reactivate/id='.$posts->id) }}" onclick="return reacForm()" type="button" class="btn btn-danger btn-sm" data-toggle="tooltip" data-placement="left" title="Reactivate record">
                                            <i class="fa fa-recycle" aria-hidden="true"></i>
                                        </a>  
                                    </td>
                                </tr>
                          @endforeach
                        </tbody>
                </table>
                <div class="form-group pull-right">
                        <label class="checkbox-inline"><input type="checkbox"  onclick="document.location='{{ url('/faqs') }}';" id="showDeactivated"> Show records</label>
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