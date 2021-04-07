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
            <h3>{{$data->card['totalTweet']}}</h3>
            <p>Jumlah Tweet</p>
          </div>
          <div class="icon"><ion-icon name=""></ion-icon>
            <i class="ion ion-chatbubbles"></i>
          </div>
          <!-- <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a> -->
        </div>
      </div>
      <!-- ./col -->
      <div class="col-lg-3 col-6">
        <!-- small box -->
        <div class="small-box bg-success">
          <div class="inner">
            <h3>{{$data->card['totalPositif']}}</h3>
            <p>Sentimen Positif</p>
          </div>
          <div class="icon">
            <i class="ion ion-happy"></i>
          </div>
          <!-- <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a> -->
        </div>
      </div>
      <!-- ./col -->
      <div class="col-lg-3 col-6">
        <!-- small box -->
        <div class="small-box bg-warning">
          <div class="inner">
            <h3>{{$data->card['totalNetral']}}</h3>
            <p>Sentimen Netral</p>
          </div>
          <div class="icon">
            <i class="ion ion-heart"></i>
          </div>
          <!-- <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a> -->
        </div>
      </div>
      <!-- ./col -->
      <div class="col-lg-3 col-6">
        <!-- small box -->
        <div class="small-box bg-danger">
          <div class="inner">
            <h3>{{$data->card['totalNegatif']}}</h3>
            <p>Sentimen Negatif</p>
          </div>
          <div class="icon">
            <i class="ion ion-sad"></i>
          </div>
          <!-- <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a> -->
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
      var bln = "{!! $data->chartBulan !!}";
      var neg = "{!! $data->chartNegatif !!}";
      var net = "{!! $data->chartNetral !!}";
      var pos = "{!! $data->chartPositif !!}";
      var ctx = document.getElementById("lineChart").getContext('2d');
      var myChart = new Chart(ctx, {
        type: 'line',
        data: {
          labels: bln.split(','),
          datasets: [{
            label: 'Positif',
            data: pos.split(','),
            fill: false,
            borderColor: '#28A745',
            backgroundColor: '#28A745', 
            borderWidth: 1
          },{
            label: 'Negatif',
              data: neg.split(','),
              fill: false,
              borderColor: '#ff0000',
              backgroundColor: '#b22222',
              borderWidth: 1
          },{
            label: 'Netral',
              data: net.split(','),
              fill: false,
              borderColor: '#FFFF00',
              backgroundColor: '#CCCC00',
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