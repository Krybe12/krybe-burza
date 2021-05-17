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
      <td class="is-unselectable is-clickable">{{$material->name}}</td>
      <td class="is-unselectable is-clickable">{{$material->price}}</td>
      <td class="is-unselectable is-clickable">{{$material->price_change}}</td>
    </tr>
  @endforeach
  </tbody>
</table>