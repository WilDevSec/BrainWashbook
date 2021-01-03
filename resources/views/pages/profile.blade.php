@extends('layouts.app')


@section('title', 'Your profile')

@section('content')

<div>
    <div>
        <h1 style="margin-left:4%;display:in-line;">{{$user->name}}'s Profile</h1>
        <h3 style="margin-left:4%;disply:in-line;">
            @if($user->created_at != null)
                Joined on {{$user->created_at->format('M d,Y \a\t h:i a') }}
            @endif
        </h3>
    </div>
    <div>
        @foreach($posts as $post)
        <hr>
        <div class="card bg-light mb-3" style="margin:min(2%);width:95%;box-shadow: 3px 3px 3px 3px grey;" >
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
    </div>
</div>
@endsection