<table class="table is-hoverable is-striped is-fullwidth">
  <thead>
    <tr>
      <th>Material</th>
      <th>Price</th>
      <th>Price change</th>
    </tr>
  </thead>
  <tbody id="matBody">
  @foreach ($materials as $material)
    <tr data-id="{{$material->id}}" {{ session()->has('selectedID') && session('selectedID') == $material->id ? "class=is-selected" : ''}}>
      <td>{{$material->name}}</td>
      <td>{{$material->price}}</td>
      <td>{{$material->price_change}}</td>
    </tr>
  @endforeach
  </tbody>
</table>