@extends('layouts.app') 

@section('content')
<meta name="csrf-token" content="{{ csrf_token() }}">
    <div class="main-content">
        <div class="container-fluid">
            <h3 class="page-title">Barang</h3>
            <div class="row">
                <div class="col-md-12">
                    <!-- TABLE HOVER -->
                    <div class="panel">
                        <div class="panel-heading">
                            <h3 class="panel-title">Tabel Barang</h3>
                            <hr>
                        </div>

                        @php 
                            $no = 1; 
                        @endphp

                        <div class="panel-body" style="margin-top:-32px;">
                            <a href="{{ url('barang/create') }}" class="btn btn-primary pull-right" style="margin-top: -64px;">
                                <i class="lnr lnr-plus-circle">
                                   Tambah Data
                                </i>
                            </a>

                            <table id="data" class="table table-bordered" width="100%" cellspacing="0">
                                @if($data->count())
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Nama Pegawai</th>
                                        <th>Nama Barang</th>
                                        <th>Jumlah</th>
                                        <th>Harga</th>
                                        <th style="width:145px">Opsi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        @foreach($data as $datas)
                                        <td>{{ $no++ }}</td>
                                        <td>{{ $datas->name }}</td>
                                        <td>{{ $datas->nama_barang }}</td>
                                        <td>{{ $datas->jumlah }}</td>
                                        <td>{{ $datas->harga }}</td>
                                        <td>
                                            <div class="btn-group">
                                                <form action="{{ route('barang-delete', $datas->id_barang) }}" method="post">
                                                    {{ csrf_field() }} {{ method_field('DELETE') }}
                                                    <a href="{{ url('barang/edit',$datas->id_barang) }}" class="btn btn-sm btn-primary">Edit</a>
                                                    <button class="btn btn-sm btn-danger" type="submit" onclick="return confirm('Yakin ingin menghapus data?')">Delete</button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
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
            </div>
        </div>

        <div class="row">
            <div class="col-md-6">
            </div>
            <div class="col-md-6">
            </div>
        </div>
    </div>
    
    <script>
        $(document).ready(function() {
            $('#data').DataTable();
        });
    </script>
@endsection