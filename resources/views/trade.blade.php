@extends('layout')
@section('title') Trade @endsection

@section('content')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<div id="test" class="pt-5 is-flex is-justify-content-center">
</div>
<div class="is-flex is-justify-content-center">
  @if (session('status'))
  <div class="notification is-primary mt-3">
    <button class="delete"></button>
    {{ session('status') }}
  </div>
  @endif
</div>
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
class Graph{
  constructor(){
    this.chart;
    this.ctx = document.getElementById('myChart').getContext('2d');
  }

  get(id){
    getButtons(id);
    getData(`assets/graph/${id}`).then(data => {
      this.data = JSON.parse(data);
      this.create();
    });
  }

  create(){
    if (this.chart) this.chart.destroy();
    this.data.colors[0] = 'rgba(0, 0, 0)';
    this.chart = new Chart(this.ctx, {
      type: 'line',
      data: {
          labels: this.data.shortDates,
          datasets: [{
              label: this.data.materialName,
              data: this.data.prices,
              backgroundColor: [
              ],
              borderColor: this.data.colors,
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
                return this.data.fullDates[i];
              },
            }
          }
        }
      }
    });
  }
}

class Table{
  constructor(div){
    this.tableDiv = div;
  }
  async get(){
    await getData('assets/tradetable').then(data => this.tableDiv.innerHTML = data);
    this.addEventListener()
    try {
      document.querySelectorAll('span')[3].parentElement.style.display = 'none'; //endora inner reklama
    } catch (error) {}
  }
  addEventListener(){
    const tbody = document.getElementById('matBody').getElementsByTagName('tr');
    [...tbody].forEach(row => {
      row.addEventListener('click', async e => {
        let target = e.currentTarget;
        let id = target.dataset.id;
        await table.sendRowClick(id, target);
      });
    });
  }
  async sendRowClick(id, target){
    if(this.controller) {
      this.controller.abort();
    }
    this.controller = new AbortController();
    const signal = this.controller.signal;

    let data = new FormData();
    data.append('_token', "{{csrf_token()}}")
    this.selectRow(target);
    await fetch(`assets/tradetable/${id}`, {
      method: 'POST',
      body: data,
      signal: signal
    }).then(data => {
      graph.get(id);
    })
    .catch(err => {
      console.warn(err);
    });
  }
  selectRow(element){
    const selected = document.getElementsByClassName('is-selected');
    [...selected].forEach(element => {
      element.classList.remove('is-selected');
    })
    element.classList.add('is-selected');
  }
}
let graph = new Graph();
let table = new Table(document.getElementById('tbl'));
onReload();
async function onReload(){
  await table.get();
  checkIfSelected();
  setInterval(table.get.bind(table), 100000);
}
function checkIfSelected(){
  let selectedRow = document.getElementsByClassName('is-selected');
  if (!selectedRow.length) return;
  graph.get([...selectedRow][0].dataset.id);
}
async function getData(path){
  const response = await fetch(path);
  const data = await response.text();
  return data;
}
function getButtons(id){
  getData(`assets/tradebuttons/${id}`).then(data => {
      document.getElementById('test').innerHTML = data;
    });
}
</script>
@endsection