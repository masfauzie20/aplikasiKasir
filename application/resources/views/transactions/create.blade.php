@extends('layouts.app') 

@section('content')
    <div class="main-content">
        <div class="container-fluid">
            <h3 class="page-title">Transactions</h3>
            <div class="row">
                <div class="col-md-12">
                    <!-- INPUTS -->
                    <div class="panel">
                        <div class="panel-heading">
                            <h3 class="panel-title">Buat Transaksi</h3>
                        </div>
                        <div class="panel-body">
                            <form action="{{ url('cart/create') }}" name="transactions" method="post" enctype="multipart/form-data">
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
                                    <label for="recipient-name" class="form-control-label">Nama Barang :</label>
                                    <select class="form-control" id="nama_barang" name="nama_barang" style="width: 100%; height: 45px;" required>
                                        <option value="" hidden="">Pilih Barang</option>
                                        @foreach($data_barang as $datas)
                                        <option name="nama_barang" harga="{{$datas->harga}}" value="{{$datas->id}}">{{ $datas->nama_barang}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <h4><label for="jumlah">Jumlah</label></h4>
                                    <input type="text" class="form-control" id="jumlah" name="jumlah" maxlength="5" placeholder="Masukkan Jumlah barang" style="height: 45px" onkeypress="return hanyaAngka(event)" required>
                                </div>
                                <div class="form-group">
                                    <h4><label for="harga">Harga</label></h4>
                                        <input type="text" class="form-control" id="harga" name="harga" placeholder="Harga Barang" style="height: 45px" onkeypress="return hanyaAngka(event)"required>
                                </div>
                                <div class="form-group">
                                        <h4><label for="jumlah">Total Harga</label></h4>
                                        <input type="text" class="form-control" id="total" name="total" placeholder="Total Harga" style="height: 45px" readonly>
                                    </div>
                                    <button type="submit" class="btn btn-md btn-primary" style="height: 34px;"><i class="fa fa-plus">&nbsp;Add to Cart</i></button>
                                <a href="{{ route('transactions') }}" class="btn btn-md btn-danger">Cancel</a>
                            </form>
                        </div>
                    </div>
                    <!-- END INPUTS -->
                </div>

                <div class="col-md-12">
                    <!-- TABLE HOVER -->
                    <div class="panel">
                        <div class="panel-heading">
                            <h3 class="panel-title">Cart</h3>
                            <hr>
                        </div>
                
                        @php 
                        $no = 1; 
                        @endphp
                
                        <div class="panel-body" style="margin-top:-32px;">
                            <form action="{{ url('transactions/store') }}" method="POST">
                                @csrf
                                <table id="data" class="table table-bordered" width="100%" cellspacing="0">
                                    @if($data->count())
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Nama Barang</th>
                                            <th>Jumlah Beli</th>
                                            <th>Total Harga</th>
                                            <th>Opsi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            @foreach($cart as $datas)
                                            <td>{{ $no++ }}</td>
                                            <td>
                                                {{ $datas->barang->nama_barang }}
                                                <input type="text" name="nama_barang[]" value="{{ $datas->barang->id_barang }}" hidden>
                                            </td>
                                            <td>
                                                {{ $datas->jumlah_beli }}
                                                <input type="number" name="jumlah[]" value="{{ $datas->jumlah_beli }}" hidden>
                                            </td>
                                            <td>
                                                {{ $datas->total_harga }}
                                                <input type="number" name="total[]" value="{{ $datas->total_harga }}" hidden>
                                            </td>
                                            <td width="150">
                                                <button type="submit" name="actions" class="btn btn-sm btn-primary" value="Create">Beli</button>
                                                <a href="{{route('cart.delete', $datas->id)}}" name="actions" class="btn btn-sm btn-danger" value="Delete">Batal</a>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </form>
                            </table>
                            @else
                            <table id="data" class="table table-bordered" width="100%" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th class="v-middle" scope="row">No</th>
                                        <th>Nama barang</th>
                                        <th>Jumlah Beli</th>
                                        <th>Total Harga</th>
                                        <th class="v-middle" scope="row">Tools</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td style="border-right-color: rgb(255, 255, 255);"></td>
                                        <td style="border-right-color: rgb(255, 255, 255);"></td>
                                        <td style="border-right-color: rgb(255, 255, 255);"><i class="fa fa-exclamation-triangle"></i> Data Tidak Tersedia</td>
                                        <td></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
@push('js')
    <script>
        $(document).on('change', '#nama_barang', function(){
            var harga = $(this).find(':selected').attr('harga');
            $('#harga').val(harga);
        });

        $('#jumlah').keyup(function(){
            var harga = $('#harga').val();
            var jumlah = $('#jumlah').val();
            var total = harga * jumlah;
            $('#total').val(total);
        })
    </script>
@endpush
<script type="text/javascript">
    function hanyaAngka(evt) {
        var charCode = (evt.which) ? evt.which : event.keyCode
        if (charCode > 31 && (charCode < 48 || charCode > 57))
    
        return false;
        return true;
    }
</script>