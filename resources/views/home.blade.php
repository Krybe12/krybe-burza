@extends('layout')
@section('title') Home @endsection

@section('content')
<section class="section has-text-centered">
  <h1 class='title'>Welcome to Burza!</h1>
</section>
<section class="section">
  <div class="columns has-text-centered">
    <div class="column has-background-warning">
      <h2 class="title">most expensive</h2>
        <table class="table is-fullwidth is-striped">
          <thead>
            <tr>
              <th>Name</th>
              <th>Price</th>
            </tr>
          </thead>
          <tbody>
            @foreach ($mats as $mat)
              <tr>
                <td> {{ $mat->name }} </td>
                <td> {{ $mat->price }} </td>
              </tr>
            @endforeach
          </tbody>
        </table>
    </div>
    <div class="column">

    </div>
  </div>
</section>
@endsection