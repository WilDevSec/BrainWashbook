@extends('layouts.app')
@section('title', 'Post Feed')

@section('content')

<div class="card mb-4">
    <h5 class="card-header">Recent Posts</h5>
    <div class="list-group list-group-flush">
        @if(count($posts)>0)
            @foreach($posts as $post)
                <a href="#" class="list-group-item">{{$post->title}}</a>
                
            @endforeach
        @endif
    </div>
</div>

@endsection