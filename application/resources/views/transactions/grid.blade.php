@extends('layouts.app') 

@section('content')
<meta name="csrf-token" content="{{ csrf_token() }}">
    <div class="main-content">
        <div class="container-fluid">
            <h3 class="page-title">Transaksi</h3>
            <div class="row">
                <div class="col-md-12">
                    <!-- TABLE HOVER -->
                    <div class="panel">
                        <div class="panel-heading">
                            <h3 class="panel-title">Tabel Transaksi</h3>
                            <hr>
                        </div>

                        @php 
                            $no = 1; 
                            // dd($data);
                        @endphp

                        <div class="panel-body" style="margin-top:-32px;">
                            <a href="{{ url('transactions/create') }}" class="btn btn-primary pull-right" style="margin-top: -64px;">
                                <span>
                                    <span class="lnr lnr-plus-circle">
                                        Buat Transaksi
                                    </span>
                                </span>
                            </a>

                            <table id="data" class="table table-bordered" width="100%" cellspacing="0">
                                @if($data->count())
                                <thead>
                                    <tr>
                                        <th class="v-middle" scope="row">No</th>
                                        <th>Nama barang</th>
                                        <th>Total Harga</th>
                                        <th class="v-middle" scope="row">Tools</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        @foreach($data as $datas)
                                        <td>{{ $no++ }}</td>
                                        <td>
                                            @foreach ($datas->details as $detail)
                                            {{ ($detail->barang->nama_barang) }}
                                            @endforeach
                                        </td>
                                        <td>{{ ($datas->total_harga) }}</td>
                                        <td>
                                            <a href="{{ route('transactions.detail') }}" class="btn btn-sm btn-info">
                                                <i class="fa fa-info-circle"></i>
                                            </a>
                                            <a class="btn btn-sm btn-danger" 
                                                href="{{route('transactions.delete', $datas->id)}}" 
                                                onclick="return confirm('Yakin ingin menghapus data?')"><i 
                                                class="fa fa-trash"></i>
                                            </a>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            @else
                            <table id="data-table" class="table table-bordered" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th class="v-middle" scope="row">No</th>
                                            <th>Nama barang</th>
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
    
    <div class="col-md-12">
        <!-- TABLE HOVER -->
        <div class="panel">
            <div class="panel-heading">
                <h3 class="panel-title">History Transaksi</h3>
                <hr>
            </div>

            @php 
                $no = 1; 
            @endphp

            <div class="panel-body" style="margin-top:-32px;">
                <table id="data" class="table table-bordered" width="100%" cellspacing="0">
                    @if($delete->count())
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Barang</th>
                            <th>Jumlah Beli</th>
                            <th>Total Harga</th>
                            <th>Dibuat Pada</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            @foreach($delete as $datas)
                            
                            <td>{{ $no++ }}</td>
                            <td>
                                @foreach ($datas->details as $detail)
                                    {{ ($detail->barang->nama_barang) }}
                                @endforeach
                            </td>
                            <td>{{ $datas->jumlah_beli }}</td>
                            <td>{{ $datas->total_harga }}</td>
                            <td>{{ $datas->created_at->format('Y-m-d:H:m:s') }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                @else
                <table id="data-table" class="table table-bordered" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th class="v-middle" scope="row">No</th>
                            <th>Nama barang</th>
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
<script>
    $(document).ready(function() {
        $('#data-table').DataTable();
    });
</script>

@endsection