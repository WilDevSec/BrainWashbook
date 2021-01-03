@extends('layouts.app')
@section('title', 'Post Feed')

@section('content')

<div class="card mb-4">
    <h5 class="display-3" style="margin:auto;width:5.3em;">Recent Posts</h5>
    <div class="list-group list-group-flush">
        <div style="width:110em;">
        @if(count($posts)>0)
            @foreach($posts as $post)
            <div class="card bg-light mb-3" >
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
            @endforeach
        @endif
        </div>
    </div>
</div>
{{$posts->links()}}
@endsection