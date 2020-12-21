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
        </ul>
    </div>
    
</div>
@endsection