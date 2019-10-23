$(document).ready(function(){
    AmCharts.makeChart("m_amcharts_3", {
        "theme": "light",
        "type": "serial",
        "legend": {
                "useGraphSettings": true,
                "markerSize": 12,
                "valueWidth": 0,
                "verticalGap": 0
            },
        "dataProvider": [{
            "proyek": "Jembatan",
            "rencana": 80,
            "realisasi": 70
        }, {
            "proyek": "Gedung",
            "rencana": 76,
            "realisasi": 60
        }, {
            "proyek": "Tol",
            "rencana": 90,
            "realisasi": 95
        }, {
            "proyek": "Penggalian",
            "rencana": 77,
            "realisasi": 80,
        }, {
            "proyek": "Power Plan",
            "rencana": 55,
            "realisasi": 50
        }, {
            "proyek": "PLTP",
            "rencana": 38,
            "realisasi": 50
        }, {
            "proyek": "PLTG",
            "rencana": 65,
            "realisasi": 80
        }, {
            "proyek": "Hotel",
            "rencana": 53,
            "realisasi": 30
        }, {
            "proyek": "Precast",
            "rencana": 32,
            "realisasi": 40
        }, {
            "proyek": "Groundbreaking",
            "rencana": 49,
            "realisasi": 66
        }],
        "valueAxes": [{
            "position": "left",
            "title": "Rencana dan Realisasi Proyek",
        }],
        "startDuration": 1,
        "graphs": [{
            "fillColors": "#ff2e4c",
            "balloonText": "Rencana [[category]] : <b>[[value]]</b>",
            "fillAlphas": 0.9,
            "lineAlpha": 0.2,
            "title": "Rencana",
            "type": "column",
            "valueField": "rencana"
        }, {
            "fillColors": "#fcd77f",
            "balloonText": "Realisasi [[category]] : <b>[[value]]</b>",
            "fillAlphas": 0.9,
            "lineAlpha": 0.2,
            "title": "Realisasi",
            "type": "column",
            "clustered": false,
            "columnWidth": 0.5,
            "valueField": "realisasi"
        }],
        "plotAreaFillAlphas": 0.1,
        "categoryField": "proyek",
        "categoryAxis": {
            "gridPosition": "start"
            // "labelRotation": 45
        },
        "export": {
            "enabled": true
        }
    });

    AmCharts.makeChart("m_amcharts_4", {
        "theme": "light",
        "type": "serial",
        "dataProvider": [{
            "proyek": "Jembatan",
            "jumlah": 100
        }, {
            "proyek": "Gedung",
            "jumlah":102
        }, {
            "proyek": "Tol",
            "jumlah": 80
        }, {
            "proyek": "Penggalian",
            "jumlah": 69
        }, {
            "proyek": "Power Plant",
            "jumlah": 29
        }, {
            "proyek": "PLTP",
            "jumlah": 10
        }, {
            "proyek": "PLTG",
            "jumlah": 120
        }, {
            "proyek": "Hotel",
            "jumlah": 44
        }, {
            "proyek": "Precast",
            "jumlah": 200
        }, {
            "proyek": "Groundbreaking",
            "jumlah": 210
        }],
        "valueAxes": [{
            "stackType": "3d",
            "position": "left",
            "title": "Jumlah Pegawai Dalam Suatu Proyek",
        }],
        "startDuration": 1,
        "graphs": [{
            "fillColors": "#dd0a35",
            "balloonText": "Proyek [[category]]: <b>[[value]]</b>",
            "fillAlphas": 0.9,
            "lineAlpha": 0.2,
            "title": "2005",
            "type": "column",
            "valueField": "jumlah"
        }],
        "plotAreaFillAlphas": 0.1,
        "depth3D": 60,
        "angle": 30,
        "categoryField": "proyek",
        "categoryAxis": {
            "gridPosition": "start"
        },
        "export": {
            "enabled": true
        }
    });
});

