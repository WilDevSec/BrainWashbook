@extends('layouts.app')

@section('content')

<div class="container">
  <form>
    <fieldset>
      <legend>Login</legend>
      <div class="form-group">
        <label for="exampleInputEmail1">Email address</label>
        <input style="width: 20%" type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter email">
        <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
      </div>
      <div class="form-group">
        <label for="exampleInputPassword1">Password</label>
        <input style="width: 20%" type="password" class="form-control"  id="exampleInputPassword1" placeholder="Password">
      </div>
      <button type="submit" class="btn btn-primary">Submit</button>
    </fieldset>
  </form>
</div>

  @endsection