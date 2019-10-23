"use strict";

class Tahap
{
    /** 
     * source format example 'json_grid'
     * formAction format example 'add'
     * tahap format example 2
     * rules format an array from rules each tahap
    */
    constructor(source, formAction, tahap, rules, tipe)
    {
        this.ajaxSource = baseUrl+source;
        this.formAction = formAction;
        this.datatable = '';
        this.tableTarget = '#table1';
        this.laddaButton = '';
        this.idKota = '';
        this.tahap = tahap;
        this.rules = rules;
        this.tipe = tipe;
    }

    load_table(fase='')
    {
        const tahap = this.tahap;
        const rules = this.rules;
        const tipe  = this.tipe;
        let panjang = rules.length;

        const warna = [
            'm-badge--primary',
            'm-badge--brand',
            'm-badge--warning',
            'm-badge--info',
            'm-badge--success',
            'm-badge--danger'
        ];

        this.datatable = $(this.tableTarget).DataTable({
            "bDestroy": true,
            "processing": true,
            "serverSide": true,
            "ajax":{
                url: this.ajaxSource,
                type: "GET",
                data:{
                    fase:fase
                },
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
            },
            "sPaginationType": "full_numbers",
            "aoColumns": [
            { "mData": "id_lokasi" },
            { "mData": "nama_lokasi" },
            { "mData": null },
            { "mData": 'path_file' },
            { "mData": "id_lokasi" }
            ],
            "aaSorting": [[1, 'asc']],
            "lengthMenu": [ 10, 25, 50, 75, 100 ],
            "pageLength": 10,
            "aoColumnDefs": [
            {
                "aTargets": [0],
                "mData":"id_lokasi",
                "mRender": (data, type, full, draw) => {
                    var row = draw.row;
                    var start = draw.settings._iDisplayStart;
                    var length = draw.settings._iDisplayLength;

                    var counter = (start  + 1 + row);

                    return counter;
                }
            },
            {
                "aTargets": [2],
                "mRender": data => {
                    let fase = '';
                    let kelas = '';
                    let temp = '';
                    for (let i=0; i<panjang; i++) {
                        temp = rules[i];
                        
                        if (data[temp] != null) {
                            fase = tipe[i+1];
                            kelas = 'm-badge--primary';
                            if (fase == null) {
                                fase = tipe[i];
                                
                            }
                        } else {
                            fase = tipe[i];
                            kelas = 'm-badge--brand';
                            console.log(tipe);
                            break;
                        }
                    }

                    if (tahap == 1) {
                        if (data.t1_status_persetujuan_kadis == false) {
                            fase = 'Ditolak';
                            kelas = 'm-badge--danger';
                        } else {
                            fase = 'Disetujui';
                            kelas = 'm-badge--success';
                        }
                    }

                    // if (full.t1_tgl_panitia_penetapan != null) {
                    //     if (full.t1_tgl_kadis != null) {
                    //         if (full.t1_tgl_walikota != null) {
                    //             if (full.t1_tgl_persetujuan_kadis != null) {
                    //                 if (full.t1_status_persetujuan_kadis == false) {
                    //                     fase = 'Ditolak';
                    //                     kelas = 'm-badge--danger';
                    //                 } else {
                    //                     fase = 'Disetujui';
                    //                     kelas = 'm-badge--success';
                    //                 }
                    //             } else {
                    //                 fase = 'Persetujuan KADIS';
                    //                 kelas = 'm-badge--info';
                    //             }
                    //         } else {
                    //             fase = 'Walikota';
                    //             kelas = 'm-badge--warning';
                    //         }
                    //     } else {
                    //         fase = 'KADIS';
                    //         kelas = 'm-badge--brand';
                    //     }
                    // } else {
                    //     fase = 'Panitia Penetapan';
                    //     kelas = 'm-badge--primary';
                    // }
                    
                    return '<span class="m-badge '+kelas+' m-badge--wide">'+fase+'</span>';
                }
            },
            {
                "aTargets": [3],
                "mRender": (data, type, full) => {
                    const url = baseUrl+'/foto/view?id='+full.id_lokasi+'&file=' + data;
                    const btn_action = '\
                    <a href="'+url+'" target="_blank" class="fancybox">'+data+'</a>\
                    ';

                    return btn_action;
                }
            },
            {
                "aTargets": [4],
                "mRender": data => {
                    const url = baseUrl+'/'+tahap+'/kajian/'+data;
                    const btn_action = '\
                    <a href="'+url+'" class="btn btn-outline-warning m-btn m-btn--icon m-btn--icon-only m-btn--outline-2x m-btn--pill m-btn--air" data-skin="dark" data-placement="top" data-toggle="m-tooltip" title="Kajian" data-original-title="Kajian"><i class="fa fa-book"></i></a>\
                    ';

                    return btn_action;
                }
            }
            ],
            "fnHeaderCallback": ( nHead, aData, iStart, iEnd, aiDisplay ) => {
                $(nHead).children('th').addClass('text-center');
            },
            "fnFooterCallback": ( nFoot, aData, iStart, iEnd, aiDisplay ) => {
                $(nFoot).children('th').addClass('text-center');
            },
            "fnRowCallback": ( nRow, aData, iDisplayIndex, iDisplayIndexFull ) => {
                $(nRow).children('td:nth-child(1),td:nth-child(2),td:nth-child(3),td:nth-child(4),td:nth-child(5)').addClass('text-center');
                $('[data-toggle="m-tooltip"]').tooltip();
            },
        });
    }

    runTooltip()
    {
        this.datatable.on('m-datatable--on-ajax-done m-datatable--on-layout-updated', function() {
			$('[data-toggle="m-tooltip"]').tooltip();
		});
    }
    
    tambah() {
        reset_form();
        $('#id_kota').val('');
        $('#action').val('add');
        $('#btn_save').html('Tambah');
        $('#modal_form .modal-title').html('Tambah Kota');
        $('#modal_form').modal('show');
        $('#loading_modal_form').hide();
    }
    
    edit(id_kota='') {
        reset_form();
        $('#id_kota').val(id_kota);
        $('#action').val('edit');
        $('#btn_save').html('Simpan');
        $('#modal_form .modal-title').html('Edit Kota');
        $('#modal_form').modal('show');
    
         $.ajax({
            type:"GET",
            url: ajaxUrl+"json_get/"+id_kota,
            beforeSend: function() {
                preventLeaving();
                $('.btn_close_modal').addClass('hide');
                // $('#loading_modal_form').html('menyimpan');
                // $('#loading_modal_form').removeClass('hide');
            },
            success:function(response){
                window.onbeforeunload = false;
                $('.btn_close_modal').removeClass('hide');
                // $('#loading_modal_form').addClass('hide');
    
                var obj = response;
    
                if(obj.status == "OK"){
                    $('#nama_kota').val(obj.data.kota['kota']);
                    if(obj.data.kota.aktif == 1){
                        $('#status').prop('checked', true);
                    }else{
                        $('#status').prop('checked', false);
                    }
                } else {
                    swal('Pemberitahuan', obj.message, 'warning');
                }
    
                $('#loading_modal_form').hide();
            },
            error: function(response) {
                var head = 'Maaf', message = 'Terjadi kesalahan koneksi', type = 'error';
                window.onbeforeunload = false;
                var obj = JSON.parse(response['responseText']);
                $('#loading_modal_form').hide();
    
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
    
    reset_form(method='') {
        $('#loading_modal_form').html('memuat');
        $('#loading_modal_form').show();
        $('#id_kota').val('');
        $('#id_kota').change();
        $('#nama_kota').val('');
        $('#nama_kota').change();
    
        $('#status').prop('checked', true);
        $('#status').change();
    }
    
    simpan() {
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
                $('.btn_close_modal').addClass('hide');
                // $('#loading_modal_form').html('menyimpan');
                // $('#loading_modal_form').removeClass('hide');
            },
            success:function(response){
                laddaButton.stop();
                window.onbeforeunload = false;
                $('.btn_close_modal').removeClass('hide');
                // $('#loading_modal_form').addClass('hide');
    
                var obj = response;
    
                if(obj.status == "OK"){
                    datatable.reload();
                    swal('Ok', obj.message, 'success');
                    $('#modal_form').modal('hide');
                } else {
                    swal('Pemberitahuan', obj.message, 'warning');
                }
    
                $('#loading_modal_form').hide();
            },
            error: function(response) {
                var head = 'Maaf', message = 'Terjadi kesalahan koneksi', type = 'error';
                laddaButton.stop();
                window.onbeforeunload = false;
                $('.btn_close_modal').removeClass('hide');
                $('#loading_modal_form').hide();
    
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
}