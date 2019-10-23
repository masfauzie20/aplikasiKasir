var datatable,
tableTarget = '#table1',
ajaxUrl = baseUrl+'/master/user/',
ajaxSource = ajaxUrl+'json_grid',
laddaButton, formAction='add', idUser
;

function load_table() {
    datatable = $(tableTarget).mDatatable({
        /* datasource definition */
        data: {
            type: 'remote',
            source: {
                read: {
                    // sample GET method 
                    method: 'GET',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    url: ajaxSource,
                    map: function(raw) {
                        /* sample data mapping */
                        var dataSet = raw;
                        if (typeof raw.data !== 'undefined') {
                            dataSet = raw.data;
                        }
                        return dataSet;
                    },
                },
            },
            pageSize: 10,
            saveState: {
                cookie: false,
                webstorage: false
            },
            serverPaging: true,
            serverFiltering: true,
            serverSorting: true,
        },

        /* layout definition */
        layout: {
            scroll: false,
            footer: false
        },

        /* column sorting */
        sortable: true,

        pagination: true,

        toolbar: {
            /* toolbar items */
            items: {
                /* pagination */
                pagination: {
                    /* page size select */
                    pageSizeSelect: [10, 20, 30, 50, 100],
                },
            },
        },

        search: {
            input: $('#generalSearch'),
        },

        /* columns definition */
        columns: [
        {
            field: 'id_user',
            title: '#',
            sortable: false, /* disable sort for this column */
            width: 40,
            selector: false,
            textAlign: 'center',
            template: function (row, index, datatable) {
                var page = datatable.getCurrentPage() - 1;
                var pageSize = datatable.getPageSize();

                var counter = (page * pageSize) + (index + 1);

                return counter;
            },
        },
        {
            field: 'name',
            title: 'Nama',
            sortable: 'asc', /* default sort */
            filterable: false, /* disable or enable filtering */
            width: 150,
        },
        {
            field: 'username',
            title: 'Username',
            sortable: true, /* default sort */
            filterable: false, /* disable or enable filtering */
            width: 75,
        },
        {
            field: 'role',
            title: 'Role',
            sortable: true, /* default sort */
            filterable: false, /* disable or enable filtering */
            width: 50,
            overflow: 'visible',
            template: function (row, index, datatable) {
                var arr_role = {1: 'Administrator', 2 : 'Supervisor'};

                return arr_role[row.role];
            }
        },
        {
            field: 'aktif',
            width: 110,
            title: 'Status',
            sortable: true,
            overflow: 'visible',
            template: function (row, index, datatable) {
                var status = row.aktif == 1? 'Aktif' : 'Tidak Aktif';

                return status;
            }
        },
        {
            field: 'Actions',
            width: 110,
            title: 'Aksi',
            sortable: false,
            overflow: 'visible',
            template: function (row, index, datatable) {
                return '\
                <button type="button" class="btn btn-outline-primary m-btn m-btn--icon m-btn--icon-only m-btn--outline-2x m-btn--pill m-btn--air" data-toggle="tooltip" title="Edit" onclick="edit('+row.id_user+')">\
                <i class="fa fa-edit"></i>\
                </button>\
                ';
            },
        }],
        translate: {
            records: {
                processing: 'Sedang memuat....',
                noRecords: 'Data tidak tersedia'
            },
            toolbar: {
                pagination: {
                    items: {
                        default: {
                            first: 'Pertama',
                            prev: 'Sebelumnya',
                            next: 'Selanjutnya',
                            last: 'Terakhir',
                            more: 'Perbanyak halaman',
                            input: 'Halaman',
                            select: 'Pilih jumlah perhalaman'
                        },
                        info: 'Menampilkan {{start}} - {{end}} dari {{total}} data'
                    }
                }
            }
        }

    });

    $('#m_form_status').on('change', function() {
        datatable.search($(this).val().toLowerCase(), 'Status');
    });

    $('#m_form_type').on('change', function() {
        datatable.search($(this).val().toLowerCase(), 'Type');
    });

    $('#m_form_status, #m_form_type').selectpicker();

    setTimeout(function() {
        // initTooltips();
    },3000);
}

function tambah() {
    reset_form();
    $('#id_user').val('');
    $('#action').val('add');
    $('#btn_save').html('Tambah');
    $('#modal_form .modal-title').html('Tambah User');
    $('#modal_form').modal('show');
    $('#loading_modal_form').hide();
}

function edit(id_user='') {
    reset_form();
    $('#id_user').val(id_user);
    $('#action').val('edit');
    $('#btn_save').html('Simpan');
    $('#modal_form .modal-title').html('Edit User');
    $('#modal_form').modal('show');

     $.ajax({
        type:"GET",
        url: ajaxUrl+"json_get/"+id_user,
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
                $('#nama_user').val(obj.data.user['user']);
                if(obj.data.user.aktif == 1){
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

function reset_form(method='') {
    $('#loading_modal_form').html('memuat');
    $('#loading_modal_form').show();
    $('#id_user').val('');
    $('#id_user').change();
    $('#nama_user').val('');
    $('#nama_user').change();

    $('#status').prop('checked', true);
    $('#status').change();
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

$(document).ready(function() {
    // initTooltips();
    load_table();

    datatable.on('m-datatable--on-ajax-done m-datatable--on-layout-updated', function() {
        $('[data-toggle=tooltip]').tooltip();
    })
});

$('#btn_save').click(function(e){
    e.preventDefault();
    laddaButton = Ladda.create(this);
    laddaButton.start();
    $('#loading_modal_form').html('menyimpan');
    $('#loading_modal_form').show();

    formAction = $('#action').val();
    idUser = $('#id_user').val();

    simpan();
});