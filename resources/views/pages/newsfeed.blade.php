@extends('layouts.app')
@section('title', 'Post Feed')

@section('content')

<div class="card mb-4">
    <h2 class="display-3" style="margin-left:4%;">Recent Posts</h2>
    <div class="list-group list-group-flush">
        <div style="width:110em;">
            @if ($errors->any())
				<div class="alert alert-danger">
					<ul>
						@foreach ($errors->all() as $error)
						   <li>{{ $error }}</li>
					  	@endforeach
				   </ul>
				</div>
			@endif
        @if(count($posts)>0)
            @foreach($posts as $post)
            <div class="card bg-light mb-3" style="width:85%;margin:4%;" >
                <div class="card-header"><h3>{{$post->title}}</h3></div>
                    <div class="card-body" style="padding:4em;margin:min(2%);">
                        <h6 class="card-title">{{$post->body}}</h6>
                        @if($post->image != null)
                            <img src="{{ asset('images/' . $post->image) }}" height="450" width="650"/>
                        @endif
                        <p class="card-text">{{$post->user->name}} - {{$post->created_at}}</p>
                        <form action="/posts/{{$post->id}}">
                            <button class="btn btn-primary">
                                View Post
                            </button>
                        </form>
                    </div>
                </div>
            </div>
            <hr>
            @endforeach
        @endif
        </div>
    </div>
</div>
{{$posts->links()}}
@endsection