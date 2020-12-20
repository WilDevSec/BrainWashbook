@extends('layouts.app')

@section('content')

<h1>Posts</h1>
@foreach($data as $post)
    <h4>{{$post->title}}</h4>
    <p>
        

@endsection