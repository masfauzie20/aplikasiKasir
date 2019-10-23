@extends('layouts.app') @section('content')

<!-- MAIN CONTENT -->
<div class="main-content">
    <div class="container-fluid">
        <center>
            <h3 class="page-title" style="margin-top: 180px;">Selamat Datang!</h3>
        </center>
        {{-- <div class="row">
            <div class="col-md-12">
                <div class="panel">
                    <div class="panel-heading">
                        <select id="year" name="year" class="select form-control">
                            <option value="" hidden="">Pilih Tahun</option>
                            {{-- @foreach($tahun as $datas)
                            <option id="chooseYear" value="{{$datas->tahun}}">{{$datas->tahun}}</option>
                            @endforeach
                        </select>
                    </div>
                     @if($terlambat->count())
                    {!! $chart->html() !!}
                </div>
                <hr>
                 @else
                        &nbsp&nbsp&nbsp<i class="fa fa-exclamation-triangle"></i> Data Tidak Tersedia
                 @endif
            </div> --}}
            <!-- END MAIN CONTENT -->
            {{-- {!! Charts::scripts() !!} {!! $chart->script() !!} --}}
<script>
$(document).ready(function () {
    $('select').find('option').click(function (e) {
        e.preventDefault();
        year = e.currentTarget.getAttribute('value');

        window.location.href = "{{ route('dashboard') }}?year=" + year
    })
})

$(".select option").val(function(idx, val) {
    $(this).siblings('[value="' + val + '"]').remove();
    return val;
});

</script>
@endsection
