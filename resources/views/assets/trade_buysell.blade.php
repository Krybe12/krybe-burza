<nav class="level">
@isset($storage)
  <div class="level-item has-text-centered px-2">
    <h2>you own {{$storage->amount}} <b>{{$storage->material->name}}</b></h2>
  </div>
  <div class="level-item has-text-centered px-2">
    <form action="/trade/sell/{{$id}}" method="POST">
      @csrf
      <input class="" name="amount" type="number" min="1" max="100" required>
      <input class="button is-small" type="submit" value="SELL">
    </form>
  </div>
@else
  <div class="level-item has-text-centered px-2">
    <h2>you don't own this material</h2>
  </div>
@endisset
<div class="level-item has-text-centered px-2">
  <form action="/trade/buy/{{$id}}" method="POST">
    @csrf
    <input class="" name="amount" type="number" min="1" max="100" required>
    <input class="button is-small" type="submit" value="BUY">
  </form>
</div>
</nav>