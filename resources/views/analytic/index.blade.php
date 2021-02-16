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
              <hr />
              <table id="grid" class="table table-bordered table-hover">
                <thead>
                <tr>
                  <th>id</th>
                  <th>Username</th>
                  <th>Tweet</th>
                  <th>Tgl. Tweet</th>
                  <th>Sentimen</th>
                  <th>Skor</th>
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
        ajax: 'analytic/lists',
        columns: [
            { data: 'id', name: 'id' },
            { data: 'username', name: 'username' },
            { data: 'tweettext', name: 'tweettext' },
            { data: 'tweetdate', name: 'tweetdate' },
            { data: 'tweetdecision', name: 'tweetdecision' },
            { data: 'tweetscorepos', name: 'tweetscorepos' }
        ]
    });

      // $('#startDate').datepicker({
      //   format:{
      //     toDisplay:function (date, format, language) {
      //       return moment(date).format("Y-MM-DD");
      //     },
      //     toValue: function (date, format, language) {
      //       return moment(date).format("Y-MM-DD");
      //     }
      //   },
      //   endDate: new Date(),
      //   clearBtn: true,
      // });

      // $("#startDate").on("change",function(){
      //   let selected = $("#startDate").datepicker('getFormattedDate')
      //   let inputEndDate = $("#endDate").val();
      //   let addMonth = new Date(selected)

      //   $("#endDate").datepicker("destroy")
      //   selectedDate = addMonth.setMonth( addMonth.getMonth() + 1)
      //   $('#endDate').datepicker({
      //     format:{
      //       toDisplay:function (date, format, language) {
      //         return moment(date).format("Y-MM-DD");
      //       },
      //       toValue: function (date, format, language) {
      //         return moment(date).format("Y-MM-DD");
      //       }
      //     },
      //     startDate: new Date(selected),
      //     endDate: new Date(selectedDate),
      //     orientation: "bottom"
      //   });

      //   $("#endDate").datepicker('setDate', new Date(selected));
      //   selected != null && inputEndDate != null 
      //    ? $("#submitBtn").removeClass("d-none")
      //    : $("#submitBtn").addClass("d-none")

      // });

      // $('#endDate').on("change",function(){
      //   let selected = $("#endDate").datepicker('getFormattedDate')
      //   let inputStartDate = $("#startDate").val();

      //   selected != null && inputStartDate != null 
      //    ? $("#submitBtn").removeClass("d-none")
      //    : $("#submitBtn").addClass("d-none")
      // });

      // $('#submitBtn').on('click',function(){
      //   hiddenButton()
      //   $('#formTarik').submit();
      // });
    });
  </script>
@endsection