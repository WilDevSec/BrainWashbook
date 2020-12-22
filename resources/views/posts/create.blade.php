@extends('layouts.app')
@section('title', 'Create a post')

@section('content')
<div class="container">
	<div class="row">
	    <div class="col-md-8 col-md-offset-2">
    		<h1>Create post</h1>
			<form action="/posts" method="POST">
				@csrf
    		    
    		    <div class="form-group">
    		        <label for="title">Title of your post</label>
    		        <input type="text" class="form-control" name="title" />
    		    </div>
    		    
    		    <div class="form-group">
    		        <label for="body">Tell the world what you know<span class="require">*</span></label>
    		        <textarea rows="5" class="form-control" name="body"></textarea>
    		    </div>
    		    
    		    <div class="form-group">
    		        <p><span class="require">*</span> - required fields</p>
    		    </div>
    		    
    		    <div class="form-group">
    		        <button type="submit" class="btn btn-primary">
    		            Create
    		        </button>
    		        <button class="btn btn-default">
    		            Cancel
    		        </button>
    		    </div>
    		    
    		</form>
		</div>
	</div>
</div>
@endsection