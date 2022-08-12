var url = window.location.href;
var id_program = url.substring(url.indexOf("detail/") + 7);

var datatable = $('#dataTable').DataTable({ 
    initComplete: function() {
        var api = this.api();
        $('#mytable_filter input')
            .off('.DT')
            .on('input.DT', function() {
                api.search(this.value).draw();
        });
    },
    oLanguage: {
    sProcessing: "loading..."
    },
    processing: true,
    serverSide: true,
    ajax: {"url": url_base+"program/load_pertemuan", "type": "POST", "data" : {id_program:id_program}},
    columns: [
        {"data": "urutan"},
        {"data": "hapus", render : function(data){
            if(data == 0) return "Aktif";
            else return "Nonaktif";
        }},
        {"data": "nama_pertemuan"},
        {"data": "latihan", render : function(data){
            if(data == "") return "<center>-</center>";
            else return data;
        }},
        {"data": "presensi", render : function(data){
            return "<center>"+data+"</center>";
        }},
        {"data": "menu"},
    ],
    order: [[0, 'asc']],
    rowCallback: function(row, data, iDisplayIndex) {
        var info = this.fnPagingInfo();
        var page = info.iPage;
        var length = info.iLength;
        $('td:eq(0)', row).html();
    },
    "columnDefs": [
    { "searchable": false, "targets": [""] },  // Disable search on first and last columns
    { "targets": [5], "orderable": false},
    ],
    "rowReorder": {
        "selector": 'td:nth-child(0)'
    },
    "responsive": true,
});