@extends('layouts.app') 

@section('content')
<meta name="csrf-token" content="{{ csrf_token() }}">
    <div class="main-content">
        <div class="container-fluid">
            <h3 class="page-title">
                <a href="{{ route('transactions') }}" class="btn btn-info">
                    <i class="fa fa-arrow-left">&nbsp; Back</i>
                </a>
            </h3>
            <div class="row">
                <div class="col-md-12">
                    <!-- TABLE HOVER -->
                    <div class="panel">
                        <div class="panel-heading">
                            <h3 class="panel-title">Detail Transaksi</h3>
                            <hr>
                        </div>

                        @php 
                            $no = 1; 
                            $sesi = Auth::User();
                            // dd($sesi);
                        @endphp

                        <div class="panel-body" style="margin-top:-32px;">
                            <table id="data" class="table table-bordered" width="100%" cellspacing="0">
                                @if($data->count())
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Nama Pegawai</th>
                                        <th>Nama barang</th>
                                        <th>Jumlah Beli</th>
                                        <th>Total Harga</th>
                                        <th>Dibuat Pada</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        @foreach($data as $datas)
                                        @foreach ($datas->details as $detail)
                                        <td>{{ $no++ }}</td>
                                        <td>{{ $sesi['username'] }}</td>
                                        <td>{{ ($detail->barang->nama_barang) }}</td>
                                        <td>{{ $datas->jumlah_beli }}</td>
                                        <td>{{ ($datas->total_harga) }}</td>
                                        <td>{{ $datas->created_at->format('Y-m-d:H:m:s') }}</td>
                                    </tr>
                                    @endforeach
                                    @endforeach
                                </tbody>
                            </table>
                            @else
                            <center>
                                <i class="fa fa-exclamation-triangle"></i> Data Tidak Tersedia
                            </center>
                        </div>
                        @endif
                    </div>
                </div>
                @endsection