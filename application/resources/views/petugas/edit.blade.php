@extends('layouts.app') 

@section('content') 

<div class="main-content">
    <div class="container-fluid">
        <h3 class="page-title">Petugas</h3>
        <div class="row">
            <div class="col-md-12">
                <!-- INPUTS -->
                <div class="panel">
                    <div class="panel-heading">
                        <h3 class="panel-title">Edit Data Petugas</h3>
                    </div>
                    @foreach($data as $datas)
                        <div class="panel-body">
                            <form action="{{ url('petugas/update', $datas->id) }}" method="post" enctype="multipart/form-data">
                                @csrf {{ csrf_field() }} {{method_field('PUT')}}
                                <div class="form-group">
                                    <h4><label for="name">Nama Petugas</label></h4>
                                    <input type="text" class="form-control" id="name" name="name" placeholder="Masukkan Nama Pegawai" style="height: 45px" value="{{ $datas->name }}" onkeypress="return hanyaHuruf(event)" required>
                                </div>
                                <div class="form-group">
                                    <h4><label for="jabatan">Jabatan</label></h4>
                                    <input type="text" class="form-control" id="jabatan" name="jabatan" placeholder="Masukkan Jabatan" style="height: 45px" value="{{$datas->jabatan}}" onkeypress="return hanyaHuruf2(event)" required>
                                </div>
                                <div class="form-group">
                                    <h4><label for="exampleFormControlFile1">Upload Foto</label></h4>
                                    <label for="exampleFormControlFile1">Foto Lama</label></h4><br>
                                    <img src="{{ url('uploads/file/'.$datas->file) }}" style="width: 250px; height: 150px; margin-bottom:10px;">
                                    <input type="file" accept="image/*" class="form-control-file" id="file" name="file" value="{{$datas->file}}" >
                                </div>
                                <br>
                                <button type="submit" class="btn btn-primary">Submit</button>
                                <a href="{{url('petugas')}}" class="btn btn-danger">Cancel</a> 
                            </form>
                        </div>
                    @endforeach
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