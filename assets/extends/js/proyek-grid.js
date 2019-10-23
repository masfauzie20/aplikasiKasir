var datatable,
tableTarget = '#table1',
ajaxUrl = baseUrl+'/proyek/',
ajaxSource = ajaxUrl+'json_grid',
laddaButton, formAction='add', idProyek
;

function load_table() {
    datatable = $(tableTarget).mDatatable({
        /* datasource definition */
        data: {
            type: 'remote',
            source: {
                read: {
                    /* sample GET method */
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
            field: 'id_proyek',
            title: '#',
            sortable: false, /* disable sort for this column */
            width: 40,
            selector: false,
            textAlign: 'center',
            template: function (row, index, datatable) {
                var page = datatable.getCurrentPage() - 1;
                var pageSize = datatable.getPageSize();

                var counter = (page * pageSize) + (index + 1);

                console.log('counter : '+counter);

                return counter;
            },
        },
        {
            field: 'proyek',
            title: 'Nama Proyek',
            sortable: 'asc', /* default sort */
            filterable: false, /* disable or enable filtering */
            width: 150,
        },
        {
            field: 'lokasi',
            title: 'Lokasi',
            sortable: 'true', /* default sort */
            filterable: false, /* disable or enable filtering */
            width: 140,
        },
        {
            field: 'kota',
            title: 'Kota',
            sortable: 'true', /* default sort */
            filterable: false, /* disable or enable filtering */
            width: 100,
        },
        {
            field: 'kategori',
            title: 'Kategori',
            sortable: 'true', /* default sort */
            filterable: false, /* disable or enable filtering */
            width: 125,
        },
        {
            field: 'tgl_kontrak',
            title: 'Tanggal  Kontrak',
            sortable: 'true', /* default sort */
            filterable: false, /* disable or enable filtering */
            width: 110,
        },
        {
            field: 'metode',
            title: 'Metode',
            sortable: 'true', /* default sort */
            filterable: false, /* disable or enable filtering */
            width: 75,
            template: function (row, index, datatable) {

                var metode = {1: 'Bulanan', 2: 'Milestone'};

                return metode[row.metode];
            },
        },
        {
            field: 'no_kontrak',
            title: 'No Kontrak',
            sortable: 'true', /* default sort */
            filterable: false, /* disable or enable filtering */
            width: 100,
        },
        {
            field: 'aksi',
            width: 80,
            title: 'Aksi',
            sortable: false,
            overflow: 'visible',
            template: function (row, index, datatable) {
                var dropup = (datatable.getPageSize() - index) <= 4 ? 'dropup' : '';
                // <a href="#" class="btn m-btn m-btn--hover-accent m-btn--icon m-btn--icon-only m-btn--pill" data-toggle="dropdown">\
                var btn_dropdown ='\
                <div class="dropdown ' + dropup + '">\
                <button type="button" class="btn btn-outline-primary m-btn m-btn--hover-accent m-btn--icon m-btn--icon-only m-btn--outline-2x m-btn--pill m-btn--air" data-toggle="dropdown">\
                <i class="la la-ellipsis-h"></i>\
                </button>\
                <div class="dropdown-menu dropdown-menu-right">\
                <a class="dropdown-item" href="'+ajaxUrl+'edit/'+row.id_proyek+'"><i class="la la-edit"></i> Edit Details</a>\
                <a class="dropdown-item" href="'+baseUrl+'/termin/tambah/'+row.id_proyek+'"><i class="la la-money"></i> Termin</a>\
                </div>\
                </div>\
                ';

                var btn_edit = '\
                <a href="'+ajaxUrl+'edit/'+row.id_proyek+'" class="btn btn-outline-primary m-btn m-btn--icon m-btn--icon-only m-btn--outline-2x m-btn--pill m-btn--air" data-toggle="tooltip" title="Edit" onclick="edit('+row.id_proyek+')">\
                <i class="fa fa-edit"></i>\
                </a>\
                ';

                var btn_termin = '\
                <a href="'+baseUrl+'/termin/tambah/'+row.id_proyek+'" class="btn btn-outline-danger m-btn m-btn--icon m-btn--icon-only m-btn--outline-2x m-btn--pill m-btn--air" data-toggle="tooltip" title="Edit" onclick="edit('+row.id_proyek+')">\
                <i class="la la-money"></i>\
                </a>\
                ';

                return btn_edit+' '+btn_termin;
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

}

function edit(id_proyek) {
    window.location = ajaxUrl+'edit/'+id_proyek;
}


$(document).ready(function() {
    load_table();

    datatable.on('m-datatable--on-ajax-done m-datatable--on-layout-updated', function() {
        $('[data-toggle=tooltip]').tooltip();
    })
});