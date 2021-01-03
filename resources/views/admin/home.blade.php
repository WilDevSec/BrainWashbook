@extends('layouts.app')
@section('title','Home Page')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header"><h2>{{ __('Welcome to BrainWashBook') }}</h2></div>
                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    <h4 style="display: inline-block;">{{ __('You are logged in as admin') }}</h4>
                    <img style="margin:min(4%);" src="/images/Manipulation.jpeg" alt="Young man looking at computer screen in confusion">
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
