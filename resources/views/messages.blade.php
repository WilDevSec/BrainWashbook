
@if ($message = Session::get('message'))
<div class="alert alert-success alert-block" role="alert">
    <button type="button" class="close" data-dismiss="alert">×</button>    
    <strong>{{$message}}</strong>
</div>
@endif

