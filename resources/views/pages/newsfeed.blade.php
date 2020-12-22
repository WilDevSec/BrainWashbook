@extends('layouts.app')
@section('title', 'Post Feed')

@section('content')

<div class="card mb-4">
    <h5 class="display-3" style="margin:auto;width:8em;">Recent Posts</h5>
    <div class="list-group list-group-flush" style="text-align:center">
        <div style="width:1700px;padding-left:min(20%)">
        @if(count($posts)>0)
            @foreach($posts as $post)
            <h1>
            </h1>
            <div class="card text-white bg-secondary mb-3" style="max-width: 60%;">
                <div class="card-header">{{$post->title}}</div>
                <div class="card-body">
                    <h6 href="#" class="card-title">{{$post->body}}</h6>
                    <p class="card-text">{{$post->user->name}} - {{$post->created_at}}</p>
                    
                </div>
            </div>
                    {{-- <div class="col-md-4">
                        <div class="card">
                          <a href="{{url('detail/'.Str::slug($post->title).'/'.$post->id)}}"><img src="{{asset('imgs/thumb/'.$post->thumb)}}" class="card-img-top" alt="{{$post->title}}" /></a>
                          <div class="card-body">
                            <h5 class="card-title"><a href="{{url('detail/'.Str::slug($post->title).'/'.$post->id)}}">{{$post->title}}</a></h5>
                          </div>
                        </div>
                    </div> --}}
                
            @endforeach
        @endif
        </div>
    </div>
</div>
{{$posts->links()}}
@endsection