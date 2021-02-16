@extends('layout.index')

@section('breadcumb')
  <div class="col-sm-6">
    <h1 class="m-0">Beranda</h1>
  </div>
  <div class="col-sm-6">
    <ol class="breadcrumb float-sm-right">
      <li class="breadcrumb-item active">Beranda</li>
    </ol>
  </div>
@endsection

@section('content-body')
  <div class="container-fluid">
    <!-- Small boxes (Stat box) -->
    <div class="row">
      <div class="col-lg-3 col-6">
        <!-- small box -->
        <div class="small-box bg-info">
          <div class="inner">
            <h3>{{$card['totalTweet']}}</h3>
            <p>Jumlah Tweet</p>
          </div>
          <div class="icon"><ion-icon name=""></ion-icon>
            <i class="ion ion-chatbubbles"></i>
          </div>
          <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
        </div>
      </div>
      <!-- ./col -->
      <div class="col-lg-3 col-6">
        <!-- small box -->
        <div class="small-box bg-success">
          <div class="inner">
            <h3>{{$card['totalPositif']}}</h3>
            <p>Sentimen Positif</p>
          </div>
          <div class="icon">
            <i class="ion ion-happy"></i>
          </div>
          <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
        </div>
      </div>
      <!-- ./col -->
      <div class="col-lg-3 col-6">
        <!-- small box -->
        <div class="small-box bg-warning">
          <div class="inner">
            <h3>{{$card['totalNetral']}}</h3>
            <p>Sentimen Netral</p>
          </div>
          <div class="icon">
            <i class="ion ion-heart"></i>
          </div>
          <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
        </div>
      </div>
      <!-- ./col -->
      <div class="col-lg-3 col-6">
        <!-- small box -->
        <div class="small-box bg-danger">
          <div class="inner">
            <h3>{{$card['totalNegatif']}}</h3>
            <p>Sentimen Negatif</p>
          </div>
          <div class="icon">
            <i class="ion ion-sad"></i>
          </div>
          <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
        </div>
      </div>
    </div>
    <div class="row">
      <section class="col-lg-12 connectedSortable">
        <div class="card">
          <div class="card-header">
            <h3 class="card-title">
              <i class="fas fa-chart-pie mr-1"></i>
              Chart Sentimen
            </h3>
          </div><!-- /.card-header -->
          <div class="card-body">
            <div class="tab-content p-0">
              <div class="chart tab-pane active" id="revenue-chart"
                    style="position: relative; height: 300px;">
                    <canvas id="lineChart" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
                </div>
            </div>
          </div>
        </div>
      </section>
    </div>
  </div>
@endsection


@section('content-js')
<script>
    $(document).ready(function (){
      var ctx = document.getElementById("lineChart").getContext('2d');
      var myChart = new Chart(ctx, {
        type: 'line',
        data: {
          labels: ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'],
          datasets: [{
            label: 'Series 1',
            data: [500,	50,	2424,	14040,	14141,	4111,	4544,	47,	5555, 6811],
            fill: false,
            borderColor: '#2196f3',
            backgroundColor: '#2196f3', 
            borderWidth: 1
          },{
            label: 'Series 2',
              data: [300,	150,	2124,	2314,	12141,	3111,	2544,	147,	4555, 9811],
              fill: false,
              borderColor: '#2193d3',
              backgroundColor: '#2196f3',
              borderWidth: 1
          }]},
        options: {
          responsive: true, // Instruct chart js to respond nicely.
          maintainAspectRatio: false, // Add to prevent default behaviour of full-width/height 
        }
      });
      
    });
</script>
@endsection