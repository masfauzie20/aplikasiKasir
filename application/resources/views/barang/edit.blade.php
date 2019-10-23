@extends('layouts.app') 

@section('content')
<div class="main-content">
    <div class="container-fluid">
        <h3 class="page-title">Barang</h3>
        <div class="row">
            <div class="col-md-12">
                <!-- INPUTS -->
                <div class="panel">
                    <div class="panel-heading">
                        <h3 class="panel-title">Edit Data Barang</h3>
                    </div>
                    @foreach($data as $datas)
                    <div class="panel-body">
                        <form action="{{ url('barang/update') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <input type="number" name="id_barang" style="display:none" value="{{$datas->id_barang}}">
                            <div class="form-group">
                                <label for="nama_pegawai" class="form-control-label">Nama Petugas :</label>
                                <select class="form-control" id="nama_pegawai" name="nama_pegawai" style="width: 100%; height: 45px;" required="">
                                    <option value="{{$datas->id}}">{{ $datas->name}}</option>
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="recipient-name" class="form-control-label">Nama Barang :</label>
                                <input type="text" class="form-control" id="nama_barang" name="nama_barang" autocomplete="off" placeholder="Masukkan Nama Barang" style="height: 45px" value="{{ $datas->nama_barang }}" required>
                            </div>

                            <div class="form-group">
                                <label for="recipient-name" class="form-control-label">Jumlah Barang :</label>
                                <input type="text" class="form-control" id="jumlah" name="jumlah" autocomplete="off" placeholder="Masukkan Jumlah Barang" style="height: 45px" value="{{ $datas->jumlah }}" required>
                            </div>

                            <div class="form-group">
                                <label for="recipient-name" class="form-control-label">Harga :</label>
                                <input type="text" class="form-control" id="harga" name="harga" autocomplete="off" maxlength="4" onkeypress="hanyaAngka(event)" placeholder="Masukkan Harga" style="height: 45px" value="{{ $datas->harga }}" required>
                            </div>
                            <br>
                            <button type="submit" class="btn btn-primary">Submit</button>
                            <a href="{{url('barang')}}" class="btn btn-danger">Cancel</a>
                        </form>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    $(document).ready(function() {
        $('#nama2').select2({
            theme: "bootstrap"
        });
    });
    $(".select option").val(function(idx, val) {
        $(this).siblings('[value="'+ val +'"]').remove();
    return val;
    });
     function hanyaAngka(evt) {
    var charCode = (evt.which) ? evt.which : event.keyCode
    if (charCode > 31 && (charCode < 48 || charCode > 57))
 
    return false;
    return true;
}
</script>
@endsection