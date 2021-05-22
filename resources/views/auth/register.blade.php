@extends('layout')
@section('title') Register @endsection

@section('content')
<section class="section">
  <div class="is-flex is-justify-content-center py-6">
    <div class="has-background-light p-5">
      <form action="" class="" method="POST">
        @csrf
        <div class="control">
          <label class="label is-small">Username</label>
          <input class="input" type="text" name="name" placeholder="Username" autocomplete="off" required>
        </div>
        <div class="control">
          <label class="label is-small">Password</label>
          <input class="input" type="password" name="password" placeholder="Password" autocomplete="off" required>
        </div>
        <div class="control">
          <label class="label is-small">Repeat Password</label>
          <input class="input" type="password" name="password_confirmation" placeholder="Repeat password" autocomplete="off" required>
        </div>
        <div class="control">
          <label class="label"></label>
          <input class="input button is-link" type="submit" value="Register">
        </div>
      </form>
      @if ($errors->any())
        @foreach ($errors->all() as $error)
            {{$error}}
        @endforeach
      @endif
    </div>

  </div>
</section>

@endsection