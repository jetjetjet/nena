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
            <div class="card-body">
              <form autocomplete="off" method="post" action="{{ url('user') }}" class="form" role="form">
                <div class="form-group">
                  <label for="uname1">Nama</label> 
                  <input type="hidden" name="_token" id="token" value="{{ csrf_token() }}" />
                  <input class="form-check-input" type="hidden" name="id" value="{{ isset($data->id) ? $data->id : null }}"> 
                  <input type="text" class="form-control" id="uname1" name="name" value="{{ old('name', $data->name) }}">
                </div>
                <div class="form-group">
                  <label for="email">Email</label> 
                  <input type="text" class="form-control" id="email" name="email" value="{{ old('email', $data->email) }}">
                </div>
                @if(!isset($data->id) || session('role') == 'admin')
                  <div class="form-group">
                    <label>Password</label> 
                    <input type="password" name="password" class="form-control" id="pwd1" required="" >
                  </div>
                @endif
                <div class="form-group">
                  <label>Jabatan</label> 
                  <select name="role" class="form-control">
                    <option value="user" {{ $data->role == 'user' ? 'selected' : '' }}>User</option>
                    <option value="admin" {{ $data->role == 'admin' ? 'selected' : '' }}>Admin</option>
                  </select> 
                </div>
                @if(isset($data->id))
                  <div class="float-left">
                    <button id="delete" class="btn btn-danger btn-md" type="button">Hapus</button>
                  </div>
                @endif
                <button class="btn btn-success btn-md float-right" type="submit">{{ isset($data->id) ? 'Ubah' : 'Simpan' }}</button>
              </form>
            </div>
        </div>
      </div>
    </div>
  </div>
@endsection

@section('content-js')
  <script type="text/javascript">
    $(function () {
      @if(isset($data->id))
      $('#delete').on('click', function(){
        var r = confirm("User akan dihapus! lanjutkan?");
        if (r == true) {
          $.ajax({
            url: "{{ url('user') . '/' . $data->id }}",
            headers: {
              'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            type: "delete",
            success: function(result){
             if(result == 'ok'){
              window.location = "{{ url('user') }}";
             }
            }
          })
        }
      });
      @endif
    });
  </script>
@endsection