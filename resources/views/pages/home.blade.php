@extends('layouts.app')
@section('title','Home Page')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    {{ __('You are logged in!') }}
                </div>
            </div>
        </div>
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
    </div>
</div>

@endsection
