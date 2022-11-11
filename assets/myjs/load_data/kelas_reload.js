var url = window.location.href;
var status_kelas = url.substring(url.indexOf("kelas/") + 6);

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
    ajax: {"url": url_base+"kelas/load_kelas", "type": "POST", "data": {"status": status_kelas}},
    columns: [
        {"data": "status"},
        {"data": "tgl_mulai"},
        {"data": "nama_kelas"},
        {"data": "program"},
        {"data": "peserta", render : function(row, data, iDisplayIndex){
            return "<center>"+iDisplayIndex.sertifikat_peserta+"/"+iDisplayIndex.peserta+"</center>"
        }},
        {"data": "menu", render : function (data) {
            if(jQuery.browser.mobile == true) return data
            else return "<center>"+data+"</center>"
        }},
    ],
    order: [[2, 'desc']],
    rowCallback: function(row, data, iDisplayIndex) {
        var info = this.fnPagingInfo();
        var page = info.iPage;
        var length = info.iLength;
        $('td:eq(0)', row).html();
    },
    "columnDefs": [
    { "searchable": false, "targets": "" },  // Disable search on first and last columns
    { "targets": [4, 5], "orderable": false},
    ],
    "rowReorder": {
        "selector": 'td:nth-child(0)'
    },
    "responsive": true,
});