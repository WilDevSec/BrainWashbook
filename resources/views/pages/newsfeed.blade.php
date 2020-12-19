@extends('layouts.app')

@section('content')

    @each('posts/show', $posts, 'post')

@endsection