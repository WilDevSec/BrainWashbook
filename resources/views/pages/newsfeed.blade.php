@extends('layouts.app')
@section('title', 'Post Feed')

@section('content')
<div class="card mb-4">
    <h5 class="display-3" style="margin:auto;width:5.3em;">Recent Posts</h5>
    <div class="list-group list-group-flush">
        <div style="width:110em;">
        @if(count($posts)>0)
            @foreach($posts as $post)
            <div class="card bg-light mb-3" style="padding:4em;margin:min(2%);">
                <div class="card-header">{{$post->title}}</div>
                    <div class="card-body">
                        <h6 class="card-title">{{$post->body}}</h6>
                        <p class="card-text">{{$post->user->name}} - {{$post->created_at}}</p>
                        <a href="/posts/{{$post->id}}">View Post</a>
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