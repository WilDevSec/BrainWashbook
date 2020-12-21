@extends('layouts.app')
@section('title', 'Post Feed')

@section('content')

<div class="card mb-4">
    <h5 class="card-header">Recent Posts</h5>
    <div class="list-group list-group-flush">
        @if(count($posts)>0)
            @foreach($posts as $post)
            <div class="col-md-6">
                <div class="card">
                    <a href="#" class="list-group-item">{{$post->title}}</a>
                    <p>{{$post->body}}</p>
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
{{$posts->links()}}
@endsection