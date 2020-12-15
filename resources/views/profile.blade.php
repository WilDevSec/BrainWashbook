@extends('layouts.app')


@section('title', 'Your profile')


@section('content')

    $posts = Post::where('postOwner','user')->get();
    
@endsection