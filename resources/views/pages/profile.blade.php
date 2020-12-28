@extends('layouts.app')


@section('title', 'Your profile')

@section('content')

<div>
    <h1 style="margin-left:4%;">{{$user->name}}'s Profile</h1>
    <div class="tab-content col-md-12" 
        style="	width:600px;
        box-shadow: 3px 3px 3px 3px grey;
        margin-right:4%;
        margin-left:4%;">
        <ul class ="list-group">
            <li class="list-group-item">
                Joined on {{$user->created_at->format('M d,Y \a\t h:i a') }}
            </li>
            @foreach($posts as $post)
            <div class="card bg-light mb-3" style="max-width: 60%;padding:4em;margin:min(2%);">
                <div class="card-header">{{$post->title}}</div>
                <div class="card-body">
                    <h6 href="#" class="card-title">{{$post->body}}</h6>
                    <p class="card-text">{{$post->user->name}} - {{$post->created_at}}</p>
                    
                </div>
            </div>
            <hr>
            @endforeach
        </ul>
    </div>
    
</div>
@endsection