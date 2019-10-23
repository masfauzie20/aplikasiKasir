var ajaxUrl = baseUrl+'/proyek/',
ajaxUrlKategori = baseUrl+'/master/kategori/',
ajaxUrlKota = baseUrl+'/master/kota/',
laddaButton
;

function load_kategori() {
    var proses = parseInt($('#proses').val());
    $('#proses').val(proses + 1);
    $.ajax({
        type:"GET",
        url: ajaxUrlKategori+"json_grid?ridiculousPagingStart=-1&ridiculousPagination=fake&ridiculousToken=Gjh8Hu76fVHvhtIgYTFGVHhdbhbsh-snjndjwJJdjJDBhjGCGSCh",
        success:function(response){
            var proses = parseInt($('#proses').val());
            $('#proses').val(proses - 1);

            var obj = response,
            template= "<option value=''>-- Pilih Kategori --</option>";

            for (var i = 0; i < obj.data.length; i++) {
                template += "<option value='"+obj.data[i]['id_kategori']+"'>"+obj.data[i]['kategori']+"</option>";
            }

            $('#kategori').html(template);

            $('#kategori').val(idKategori);

            var proses = parseInt($('#proses').val());
            if(proses == 0){
                $('#loading_form').hide();
            }
        },
        error: function(response) {
            var head = 'Maaf', message = 'Terjadi kesalahan koneksi', type = 'error';
            // swal('Maaf', 'Terjadi kesalahan koneksi.', 'error');
            var obj = JSON.parse(response['responseText']);
            $('#loading_form').hide();

            if(!$.isEmptyObject(obj.message)){
                if(obj.code > 400){
                    head = 'Maaf';
                    message = obj.message;
                    type = 'error';
                }else{
                    head = 'Pemberitahuan';
                    message = obj.message;
                    type = 'warning';
                }
            }

            swal(head, message, type);
        }
    });
}

function load_kota() {
    var proses = parseInt($('#proses').val());
    $('#proses').val(proses + 1);
    $.ajax({
        type:"GET",
        url: ajaxUrlKota+"json_grid?ridiculousPagingStart=-1&ridiculousPagination=fake&ridiculousToken=GjKTh8Hu76fVHvhtIgYTFGVHhdbhbsh-snjndjwJJdjJDBhjGCGSCh",
        success:function(response){
            var proses = parseInt($('#proses').val());
            $('#proses').val(proses - 1);

            var obj = response,
            template= "<option value=''>-- Pilih Kota --</option>";

            for (var i = 0; i < obj.data.length; i++) {
                template += "<option value='"+obj.data[i]['id_kota']+"'>"+obj.data[i]['kota']+"</option>";
            }

            $('#kota').html(template);

            $('#kota').val(idKota);

            var proses = parseInt($('#proses').val());
            if(proses == 0){
                $('#loading_form').hide();
            }
        },
        error: function(response) {
            var head = 'Maaf', message = 'Terjadi kesalahan koneksi', type = 'error';
            var obj = JSON.parse(response['responseText']);
            $('#loading_form').hide();

            if(!$.isEmptyObject(obj.message)){
                if(obj.code > 400){
                    head = 'Maaf';
                    message = obj.message;
                    type = 'error';
                }else{
                    head = 'Pemberitahuan';
                    message = obj.message;
                    type = 'warning';
                }
            }

            swal(head, message, type);
        }
    });
}

function reset_form(method='') {
    $('#loading_form').html('memuat');
    $('#loading_form').show();
    $('#nama_proyek').val('');
    $('#nama_proyek').change();
    $('#lokasi').val('');
    $('#lokasi').change();
    $('#nilai_kontrak').val('');
    $('#nilai_kontrak').change();
    $('#tgl_kontrak').val('');
    $('#tgl_kontrak').change();
    $('#metode').val('');
    $('#metode').change();
    $('#siklus_pembayaran').val('');
    $('#siklus_pembayaran').change();
    $('#no_kontrak').val('');
    $('#no_kontrak').change();

    load_kategori();
    load_kota();
}

function simpan() {
    // var file = new FormData($("#form1")[0]);
    var data = $("#form1").serializeArray();
    $.ajax({
        type:"POST",
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        url: ajaxUrl+"json_save",
        data:data,
        // contentType: false,
        // cache: false,
        // processData:false,
        beforeSend: function() {
            preventLeaving();
            $('.btn_cancel').addClass('hide');
        },
        success:function(response){
            laddaButton.stop();
            window.onbeforeunload = false;
            $('.btn_cancel').removeClass('hide');

            var obj = response;

            if(obj.status == "OK"){
                swal('Ok', obj.message, 'success');
                // setTimeout(function() {
                    reset_form();
                // }, 1000);

                setTimeout(function() {
                    window.location = ajaxUrl;
                }, 3000);
            } else {
                swal('Pemberitahuan', obj.message, 'warning');
            }

            $('#loading_form').hide();
        },
        error: function(response) {
            var head = 'Maaf', message = 'Terjadi kesalahan koneksi', type = 'error';
            laddaButton.stop();
            window.onbeforeunload = false;
            $('.btn_cancel').removeClass('hide');
            $('#loading_form').hide();

            var obj = JSON.parse(response['responseText']);

            if(!$.isEmptyObject(obj.message)){
                if(obj.code > 400){
                    head = 'Maaf';
                    message = obj.message;
                    type = 'error';
                }else{
                    head = 'Pemberitahuan';
                    message = obj.message;
                    type = 'warning';
                }
            }

            swal(head, message, type);
        }
    });
}

$(document).ready(function() {
    $('#loading_form').html('memuat');
    load_kategori();
    load_kota();

    $("#kota").select2();

    $("#nilai_kontrak").inputmask('IDR 999.999.999.999.999.999,99', {
        numericInput: true
    });

    $('#tgl_kontrak').datepicker({
        todayHighlight: true,
        orientation: "bottom left",
        templates: {
            leftArrow: '<i class="la la-angle-left"></i>',
            rightArrow: '<i class="la la-angle-right"></i>'
        }
    });

    $("#siklus_pembayaran").inputmask('9999', {
        numericInput: true
    });
});

$('#btn_save').click(function(e){
    e.preventDefault();
    laddaButton = Ladda.create(this);
    laddaButton.start();
    $('#loading_form').html('menyimpan');
    $('#loading_form').show();

    simpan();
});