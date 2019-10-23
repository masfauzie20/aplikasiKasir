@extends('layouts.app') 

@section('content')
    <div class="main-content">
        <div class="container-fluid">
            <h3 class="page-title">Pegawai</h3>
            <div class="row">
                <div class="col-md-12">
                    <!-- INPUTS -->
                    <div class="panel">
                        <div class="panel-heading">
                            <h3 class="panel-title">Tambah Data Petugas</h3>
                        </div>
                        <div class="panel-body">
                            <form action="{{ url('petugas/store') }}" method="post" enctype="multipart/form-data">
                                @csrf
                                <div class="form-group">
                                    <h4><label for="name">Nama Petugas</label></h4>
                                    <input type="text" class="form-control" id="name" name="name" placeholder="Masukkan Nama Petugas" style="height: 45px" onkeypress="return hanyaHuruf(event)" required>
                                </div>
                                <div class="form-group">
                                    <h4><label for="jabatan">Jabatan</label></h4>
                                    <input type="text" class="form-control" id="jabatan" name="jabatan" placeholder="Masukkan Jabatan" style="height: 45px" onkeypress="return hanyaHuruf2(event)" required>
                                </div>
                                <div class="form-group">
                                    <h4><label for="exampleFormControlFile1">Upload Foto</label></h4>
                                    <input type="file" accept="image/*" class="form-control-file" id="file" name="file" required>
                                </div>
                                <br>
                                <button type="submit" class="btn btn-primary">Submit</button>
                                <a href="{{url('petugas')}}" class="btn btn-danger">Cancel</a>
                            </form>
                        </div>
                    </div>
                    <!-- END INPUTS -->
                </div>
            </div>
        </div>
    </div>
@endsection

<script type="text/javascript">
    function hanyaHuruf(evt) {
    var charCode = (evt.which) ? evt.which : event.keyCode
         if (charCode != 46 && charCode != 32 && (charCode < 65 || charCode > 90) && (charCode < 97 || charCode > 122))
         return false;       
         return true;
}
function hanyaHuruf2(evt){
         var charCode = (evt.which) ? evt.which : event.keyCode
          if ( charCode != 32 && (charCode < 65 || charCode > 90) && (charCode < 97 || charCode > 122)) 
         return false;         
         return true;
      }
</script>