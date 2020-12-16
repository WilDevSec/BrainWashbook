@extends('layouts.app')


@section('title', 'Your profile')


@section('content')

    @if(count($posts > 0))
        <ul>
            @foreach($posts as $post)
                <li>{{$post}}</li>
            @endforeach
        </ul>
    @endif

@endsection