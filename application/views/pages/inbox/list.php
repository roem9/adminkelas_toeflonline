<?php $this->load->view("_partials/header")?>
    <div class="wrapper">
        <div class="sticky-top">
            <?php $this->load->view("_partials/navbar-header")?>
            <?php $this->load->view("_partials/navbar")?>
        </div>
        <div class="page-wrapper">
            <div class="container-xl">
                <!-- Page title -->
                <div class="page-header d-print-none">
                    <div class="row align-items-center">
                        <div class="col">
                        <h2 class="page-title">
                            <?= $title?>
                        </h2>
                        </div>
                    </div>
                </div>
            </div>
            <div class="page-body">
                <div class="container-xl">
                    <div class="card shadow mb-4">
                        <div class="card-body">
                            <table id="dataTable" class="table card-table table-vcenter text-nowrap text-dark">
                                <thead>
                                    <tr>
                                        <th class="text-dark desktop w-1" style="font-size: 11px">Waktu</th>
                                        <th class="text-dark desktop mobile-l mobile-p tablet-l tablet-p" style="font-size: 11px">Nama Member</th>
                                        <th class="text-dark desktop" style="font-size: 11px">Program</th>
                                        <th class="text-dark desktop w-1" style="font-size: 11px">Chat</th>
                                        <!-- <th class="text-dark desktop w-1" style="font-size: 11px">Menu</th> -->
                                    </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                </div>
 
            </div>
            <?php $this->load->view("_partials/footer-bar")?>
        </div>
    </div>
 
    <script>
        $("#<?= $menu?>").addClass("active")
    </script>
 
    <!-- load javascript -->
    <?php  
        if(isset($js)) :
            foreach ($js as $i => $js) :?>
                <script src="<?= base_url()?>assets/myjs/<?= $js?>"></script>
                <?php 
            endforeach;
        endif;    
    ?>

    <script>
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
            ajax: {"url": url_base+"inbox/load_inbox", "type": "POST"},
            columns: [
                {"data": "tgl_input"},
                {"data": "nama"},
                {"data": "program"},
                {
                    "data": "baca_admin",
                    render: function(row, data, iDisplayIndex){
                        if(iDisplayIndex.baca_admin == 0){
                            return `
                                <a href="${iDisplayIndex.link}" target="_blank" class="btn btn-success blink_me openChat" data-link="${iDisplayIndex.link}" data-idKelas="${iDisplayIndex.id_kelas}" data-idMember="${iDisplayIndex.id_member}">
                                    Chat
                                </a>
                            `
                        } else {
                            return `
                                <a href="${iDisplayIndex.link}" target="_blank" class="btn btn-success">
                                    Chat
                                </a>
                            `
                        }
                    }
                }
                // {"data": "peserta", render : function(row, data, iDisplayIndex){
                //     return "<center>"+iDisplayIndex.sertifikat_peserta+"/"+iDisplayIndex.peserta+"</center>"
                // }},
                // {"data": "menu", render : function (data) {
                //     if(jQuery.browser.mobile == true) return data
                //     else return "<center>"+data+"</center>"
                // }},
            ],
            order: [[3, 'asc'], [0, 'asc']],
            rowCallback: function(row, data, iDisplayIndex) {
                var info = this.fnPagingInfo();
                var page = info.iPage;
                var length = info.iLength;
                $('td:eq(0)', row).html();
            },
            "columnDefs": [
            { "searchable": false, "targets": "" },  // Disable search on first and last columns
            // { "targets": [4, 5], "orderable": false},
            ],
            "rowReorder": {
                "selector": 'td:nth-child(0)'
            },
            "responsive": true,
        });

        $(document).on("click", ".openChat", function(){
            let link = $(this).data("link");
            let id_kelas = $(this).data("idkelas");
            let id_member = $(this).data("idmember");

            formData = {
                id_kelas: id_kelas,
                id_member: id_member
            };
            
            let result = ajax(url_base+`inbox/markread`, "POST", formData);
            loadData();
            // if(result == 1){
            //     loadData();
            //     window.open(link, '_blank');
            // }
        })
    </script>
    
<?php $this->load->view("_partials/footer")?>