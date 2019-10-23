@extends('layouts.app') 

@section('content')
<meta name="csrf-token" content="{{ csrf_token() }}">
<div class="main-content">
    <div class="container-fluid">
        <h3 class="page-title">Petugas</h3>
        <div class="row">
            <div class="col-md-12">
                <!-- TABLE HOVER -->
                <div class="panel">
                    <div class="panel-heading">
                        <h3 class="panel-title">Tabel Petugas</h3>
                        <hr>
                    </div>
                    
                    @php 
                        $no = 1; 
                    @endphp
                    
                    <div class="panel-body" style="margin-top:-32px;">
                        <a href="{{ url('petugas/create') }}" class="btn btn-primary pull-right" style="margin-top: -64px;">
                            <span>
                                <i class="lnr lnr-plus-circle">
                                    Tambah Data
                                 </i>
                            </span>
                        </a>
                        @if($data->count())
                        <table id="data" class="table table-bordered" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>NO</th>
                                    <th>Nama Petugas</th>
                                    <th>Jabatan</th>
                                    <th>Foto</th>
                                    <th>Opsi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    @foreach($data as $datas)
                                    <td>{{ $no++ }}</td>
                                    <td>{{ $datas->name }}</td>
                                    <td>{{ $datas->jabatan }}</td>
                                    <td><img src="{{ url('uploads/file/'.$datas->file) }}" style="width: 250px; height: 150px;"></td>
                                    <td>
                                        <form action="{{ url('petugas/delete', $datas->id) }}" method="post">
                                            {{ csrf_field() }} {{ method_field('DELETE') }}
                                            <a href="{{ url('petugas/edit',$datas->id) }}" class=" btn btn-sm btn-primary">Edit</a>
                                            <button class="btn btn-sm btn-danger" type="submit" onclick="return confirm('Yakin ingin menghapus data?')">Delete</button>
                                        </form>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        @else
                        <i class="fa fa-exclamation-triangle"></i> Data Tidak Tersedia
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
    
<script>
    $(document).ready(function() {
        $('#data').DataTable();
    });
</script>

<!-- END MAIN CONTENT -->
@endsection