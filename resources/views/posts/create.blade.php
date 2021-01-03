@extends('layouts.app')
@section('title', 'Create a post')

@section('content')
<div class="container">
	<div class="row">
	    <div class="col-md-8 col-md-offset-2">
    		<h1>Create post</h1>
			<form action="/posts" method="POST" enctype="multipart/form-data">
				@csrf
    		    <div class="form-group">
    		        <label for="title">Title of your post<span class="require">*</span></label>
    		        <input type="text" class="form-control" name="title" />
    		    </div>
    		    
    		    <div class="form-group">
    		        <label for="body">Tell the world what you know<span class="require">*</span></label>
    		        <textarea rows="5" class="form-control" name="body"></textarea>
				</div>
				
				<div class="form-group">
					@csrf
					<div class="row">
						<div class="col-md-6">
							<input type="file" name="image" class="form-control">
						</div>
					</div>
				</div class="form-group">
    		    
    		    <div class="form-group">
    		        <p><span class="require">*</span> - required fields</p>
    		    </div>
    		    
    		    <div class="form-group">
    		        <button type="submit" class="btn btn-primary">
    		            Create
    		        </button>
    		    </div>
				@if ($errors->any())
				<div class="alert alert-danger">
					<ul>
						@foreach ($errors->all() as $error)
						   <li>{{ $error }}</li>
					  	@endforeach
				   </ul>
				</div>
				@endif
    		</form>
		</div>
	</div>
</div>
@endsection