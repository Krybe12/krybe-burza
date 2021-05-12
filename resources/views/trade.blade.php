@extends('layout')
@section('title') Trade @endsection

@section('content')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<section class="section">
  <div class="columns is-variable" style="max-height: 84vh;">
    <div class="column is-three-fifths has-background-grey-light">
      <canvas id="myChart" width="400" height="400"></canvas>
    </div>
    <div id="tbl" class="column has-background-warning has-text-centered is-flex is-justify-content-center" style="max-height: 84vh;overflow-y: auto;">
      
    </div>
  </div>
</section>
<script>
const tableDiv = document.getElementById('tbl');
var ctx = document.getElementById('myChart').getContext('2d');
var ctx = document.getElementById('myChart');
var chart;
onReload();
async function onReload(){
  await getTable();
  checkIfSelected();
  setInterval(getTable, 10000);
}

async function getTable(){
  await getData('assets/tradetable').then(data => tableDiv.innerHTML = data);
  addTableEventListener()
  
}
function addTableEventListener(){
  const tbody = document.getElementById('matBody').childNodes;
  [...tbody].forEach(row => {
    row.addEventListener('click', async e => {
      const id = e.target.parentElement.dataset.id;
      data = new FormData();
      data.append('_token', "{{csrf_token()}}")
      selectRow(e.target.parentElement);
      await fetch(`assets/tradetable/${id}`, {
        method: 'POST',
        body: data
      });
      //getTable();
      getGraph(id);
    });
  });
}
var x
function checkIfSelected(){
  x = document.getElementsByClassName('is-selected');
  if (!x) return;
  getGraph([...x][0].dataset.id);
}
function getGraph(id){
  getData(`assets/graph/${id}`).then(data => {
    data = JSON.parse(data);
    createChart(data.shortDates, data.prices, data.fullDates, data.materialName, data.colors);
  });
}
function selectRow(element){
  const selected = document.getElementsByClassName('is-selected');
  [...selected].forEach(element => {
    element.classList.remove('is-selected');
  })
  element.classList.add('is-selected');
}
async function getData(path){
  const response = await fetch(path);
  const data = await response.text();
  return data;
}

function createChart(labels, prices, tooltip, materialName, colors){
  if (chart) chart.destroy();
  colors[0] = 'rgba(0, 0, 0)';
  chart = new Chart(ctx, {
    type: 'line',
    data: {
        labels: labels,
        datasets: [{
            label: materialName,
            data: prices,
            backgroundColor: [
            ],
            borderColor: colors,
            borderWidth: 5
        }]
    },
    options: {
        scales: {
            y: {
                beginAtZero: false
            }
        },
        maintainAspectRatio: false,

        plugins: {
        tooltip: {
          callbacks: {
            footer: (d) => {
              let i = d[0].dataIndex;
              return tooltip[i];
            },
          }
        }
      }
    }
  });
}
</script>
@endsection