@extends('layout.index')

@section('breadcumb')
  <div class="col-sm-6">
    <h1 class="m-0">Analisa Sentimen</h1>
  </div>
  <div class="col-sm-6">
    <ol class="breadcrumb float-sm-right">
      <li class="breadcrumb-item"><a href="#">Home</a></li>
      <li class="breadcrumb-item active">Analisa Sentimen</li>
    </ol>
  </div>
@endsection

@section('content-body')
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-12">
        <div class="card card-primary">
          <!-- <div class="card-header">
            <h3 class="card-title">Analisa Sentimen</h3>
          </div> -->
          <form id="formTarik" action="" class="form-horizontal" method="GET" autocomplete="off" novalidate>
            <div class="card-body">
              <a href="{{ url('/user/edit') }}" type="button" class="btn btn-success">Tambah Baru</a>
              <hr />
              <table id="grid" class="table table-bordered table-hover">
                <thead>
                <tr>
                  <th>Nama</th>
                  <th>Email</th>
                  <th>Jabatan</th>
                </tr>
                </thead>
                <tbody>
                </tbody>
              </table>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
@endsection

@section('content-js')
  <script type="text/javascript">
    let selectedDate;

    function hiddenButton(){
      $("#submitBtn").addClass("d-none")
      $("#loadingBtn").removeClass("d-none")
    }

    function showButton(){
      $("#submitBtn").removeClass("d-none")
      $("#loadingBtn").addClass("d-none")
    }

    $(function () {
      $('#grid').DataTable({
        processing: true,
        serverSide: true,
        ajax: 'user/grid',
        columns: [
            { data: null,
            render: function(data, type, full, meta){
              return '<a href="user/edit/' + data.id +'">' + data.name + '</a>'
            },
              name: 'name' },
            { data: 'email', name: 'email' },
            { data: 'role', name: 'role' },

        ]
    });
    });
  </script>
@endsection