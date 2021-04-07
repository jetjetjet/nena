@extends('layout.index')

@section('breadcumb')
  <div class="col-sm-6">
    <h1 class="m-0">Ekspor Tweet</h1>
  </div>
  <div class="col-sm-6">
    <ol class="breadcrumb float-sm-right">
      <li class="breadcrumb-item"><a href="#">Home</a></li>
      <li class="breadcrumb-item active">Ekspor Tweet</li>
    </ol>
  </div>
@endsection

@section('content-body')
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-12">
        <div class="card card-primary">
          <div class="card-header">
            <h3 class="card-title">Ekspor Tweet</h3>
          </div>
          <form id="formTarik" action="{{ url('/export-tweet') }}" class="form-horizontal" method="GET" autocomplete="off" novalidate>
            <div class="card-body">
            @if(session()->has('error'))
              <div class="alert alert-danger alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <h5><i class="icon fas fa-ban"></i> Kesalahan!</h5>
                {{ session('error') }}
              </div>
            @endif
            @if(session()->has('success'))
              <div class="alert alert-success alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <h5><i class="icon fas fa-check"></i> Sukses!</h5>
                {{ session('success') }}
              </div>
            @endif
              <div class="row">
                <div class="col-md-6">
                  <div class="form-group">
                    <label>Tanggal Awal</label>
                    <div class="input-group date" id="startDate">
                        <input type="text" name="startDate" class="form-control" readonly="readonly" />
                        <div class="input-group-append">
                            <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                        </div>
                    </div>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label>Tanggal Akhir</label>
                    <div class="input-group date" id="endDate">
                        <input type="text" name="endDate" class="form-control" readonly="readonly" />
                        <div class="input-group-append">
                            <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                        </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="card-footer">
              <a type="button" id="submitBtn" class="btn btn-primary d-none">Ekspor</a>
              <a type="button" id="loadingBtn" style="pointer-events: none;" class="btn btn-primary d-none">
                <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                Loading...
              </a>
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
      $('#example2').DataTable({
        "paging": true,
        "lengthChange": false,
        "searching": false,
        "ordering": true,
        "info": true,
        "autoWidth": false,
        "responsive": true,
      });
      $('#startDate').datepicker({
        format:{
          toDisplay:function (date, format, language) {
            return moment(date).format("Y-MM-DD");
          },
          toValue: function (date, format, language) {
            return moment(date).format("Y-MM-DD");
          }
        },
        endDate: new Date(),
        clearBtn: true,
      });

      $("#startDate").on("change",function(){
        let selected = $("#startDate").datepicker('getFormattedDate')
        let inputEndDate = $("#endDate").val();
        let addMonth = new Date(selected)

        $("#endDate").datepicker("destroy")
        selectedDate = addMonth.setMonth( addMonth.getMonth() + 1)
        $('#endDate').datepicker({
          format:{
            toDisplay:function (date, format, language) {
              return moment(date).format("Y-MM-DD");
            },
            toValue: function (date, format, language) {
              return moment(date).format("Y-MM-DD");
            }
          },
          startDate: new Date(selected),
          endDate: new Date(selectedDate),
          orientation: "bottom"
        });

        $("#endDate").datepicker('setDate', new Date(selected));
        selected != null && inputEndDate != null 
         ? $("#submitBtn").removeClass("d-none")
         : $("#submitBtn").addClass("d-none")

      });

      $('#endDate').on("change",function(){
        let selected = $("#endDate").datepicker('getFormattedDate')
        let inputStartDate = $("#startDate").val();

        selected != null && inputStartDate != null 
         ? $("#submitBtn").removeClass("d-none")
         : $("#submitBtn").addClass("d-none")
      });

      $('#submitBtn').on('click',function(){
        // hiddenButton()
        $('#formTarik').submit();
      });
    });
  </script>
@endsection