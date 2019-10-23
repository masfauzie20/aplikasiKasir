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
                        <h3 class="panel-title">Tambah Data Barang</h3>
                    </div>
                    <div class="panel-body">
                        <form action="{{ url('barang/store') }}" method="POST">
                            @csrf
                                <div class="form-group">
                                    <label for="recipient-name" class="form-control-label">Nama Petugas :</label>
                                    <select class="form-control" id="nama_pegawai" name="nama_pegawai" style="width: 100%; height: 45px;" required>
                                        <option value="" hidden="">Pilih Nama Petugas</option>
                                        @foreach($data as $datas)
                                        <option id="nama_pegawai" name="nama_pegawai" value="{{$datas->id}}">{{ $datas->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="nama_barang" class="form-control-label">Nama Barang</label>
                                    <input type="text" class="form-control" id="nama_barang" name="nama_barang" autocomplete="off" placeholder="Masukkan Nama Barang" style="height: 45px" required>
                                </div>
                                <div class="form-group">
                                    <label for="jumlah" class="form-control-label">Jumlah Barang :</label>
                                    <input type="text" class="form-control" id="jumlah" name="jumlah" autocomplete="off" maxlength="4" onkeypress="return hanyaAngka(event)" placeholder="Masukkan Jumlah" style="height: 45px" required>
                                </div>

                                <div class="form-group">
                                    <label for="harga" class="form-control-label">Harga :</label>
                                    <input type="text" class="form-control" id="harga" name="harga" autocomplete="off" maxlength="6" onkeypress="return hanyaAngka(event)" placeholder="Masukkan Harga Barang" style="height: 45px" required>
                                </div>
                                <br>
                                <button type="submit" class="btn btn-primary">Submit</button>
                                <a href="{{ url('barang') }}" class="btn btn-danger">Cancel</a>
                        </form>
                    </div>
                </div>
                <!-- END INPUTS -->
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    
    function hanyaAngka(evt) {
    var charCode = (evt.which) ? evt.which : event.keyCode
    if (charCode > 31 && (charCode < 48 || charCode > 57))
 
    return false;
    return true;
}
</script>
@endsection