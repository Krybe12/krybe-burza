@extends('layout')
@section('title') Trade @endsection

@section('content')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<section class="section">
  <div class="columns is-variable" style="max-height: 84vh;">
    <div class="column is-three-fifths has-background-success">
      <canvas id="myChart" width="400" height="400"></canvas>
    </div>
    <div class="column has-background-warning has-text-centered is-flex is-justify-content-center" style="max-height: 84vh;overflow-y: auto;">
      <table class="table is-hoverable is-striped is-fullwidth">
        <thead>
          <tr>
            <th>material</th>
            <th>cena</th>
            <th>zmena</th>
          </tr>
        </thead>
        <tbody id="test">
          <tr>
            <th>gold</th>
            <th>cena</th>
            <th>+150</th>
          </tr>
          <tr>
            <th>gold</th>
            <th>cena</th>
            <th>+150</th>
          </tr>
          <tr>
            <th>gold</th>
            <th>cena</th>
            <th>+150</th>
          </tr>
          <tr>
            <th>gold</th>
            <th>cena</th>
            <th>+150</th>
          </tr>
          <tr>
            <th>gold</th>
            <th>cena</th>
            <th>+150</th>
          </tr>
          <tr>
            <th>gold</th>
            <th>cena</th>
            <th>+150</th>
          </tr>
          <tr>
            <th>gold</th>
            <th>cena</th>
            <th>+150</th>
          </tr>
          <tr>
            <th>gold</th>
            <th>cena</th>
            <th>+150</th>
          </tr>
          <tr>
            <th>gold</th>
            <th>cena</th>
            <th>+150</th>
          </tr>
          <tr>
            <th>gold</th>
            <th>cena</th>
            <th>+150</th>
          </tr>
          <tr>
            <th>gold</th>
            <th>cena</th>
            <th>+150</th>
          </tr>
          <tr>
            <th>gold</th>
            <th>cena</th>
            <th>+150</th>
          </tr>
          <tr>
            <th>gold</th>
            <th>cena</th>
            <th>+150</th>
          </tr>
          <tr>
            <th>gold</th>
            <th>cena</th>
            <th>+150</th>
          </tr>
          <tr>
            <th>gold</th>
            <th>cena</th>
            <th>+150</th>
          </tr>
          <tr>
            <th>gold</th>
            <th>cena</th>
            <th>+150</th>
          </tr>
          <tr>
            <th>gold</th>
            <th>cena</th>
            <th>+150</th>
          </tr>
          <tr>
            <th>gold</th>
            <th>cena</th>
            <th>+150</th>
          </tr>
        </tbody>
      </table>
    </div>
  </div>
</section>
<script>
  var ctx = document.getElementById('myChart').getContext('2d');

var ctx = document.getElementById('myChart');
var myChart = new Chart(ctx, {
    type: 'line',
    data: {
        labels: ["po", "ut", "st", "ct", "pa", "so"],
        datasets: [{
            label: 'price',
            data: [12, 19, 3, 5, 2, 3],
            backgroundColor: [
                'rgba(0, 0, 0)',
                'rgba(54, 162, 235)',
                'rgba(255, 206, 86)',
                'rgba(75, 192, 192)',
                'rgba(153, 102, 255)',
                'rgba(255, 159, 64)'
            ],
            borderColor: [
                'rgba(255, 255, 255)',
                'rgba(0, 0, 0)',
            ],
            borderWidth: 5
        }]
    },
    options: {
        scales: {
            y: {
                beginAtZero: true
            }
        },
        maintainAspectRatio: false
    }
});
</script>
@endsection