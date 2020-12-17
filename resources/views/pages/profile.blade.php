@extends('layouts.app')


@section('title', 'Your profile')


@section('content')

    @if(count($posts > 0))
        <ul>
            @foreach($posts as $post)
                <li>{{$post}}
                    {{-- #if(count($comments->where('post_id' == $post::get('post_id')) > 0)
                    
                    #endif --}}
                </li>

            @endforeach
        </ul>
    @endif

@endsection