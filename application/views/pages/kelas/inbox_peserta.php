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
                    <div class="d-flex justify-content-between">
                        <div>
                            <a href="<?= base_url()?>kelas/inbox/<?= md5($kelas['id_kelas'])?>">Ruang Diskusi</a> > TOEFL STRUCTURE 1 AGUSTUS 2022 | Muhammad Rum
                        </div>
                        <a href="javascript:void(0)" class="btn btn-sm btn-primary btnReportLatihan .modal-body" data-bs-toggle="modal" data-bs-target="#reportLatihan">
                            <?= tablerIcon("file-analytics");?>
                        </a>
                    </div>
                    <!-- <center><h3><?= $title?></h3></center> -->
                </div>
                <!-- Page title actions -->
                </div>
            </div>
            </div>
            <div class="page-body">
                <div class="container-xl">
                    
                    <div class="row g-2 mb-3">
                        <input type="hidden" name="tabel" value="admin">
                        <input type="hidden" name="id_member" value="<?= $member['id_member']?>">
                        <input type="hidden" name="id_kelas" value="<?= $kelas['id_kelas']?>">

                        <div class="col">
                            <textarea name="text" id="text" class="form-control" data-bs-toggle="autosize" placeholder="Type something…" style="overflow: hidden; overflow-wrap: break-word; resize: none; height: 55.9886px;"></textarea>
                        </div>
                        <div class="col-auto">
                            <a href="javascript:void(0)" class="btn btn-white btn-icon btnSendMessage" aria-label="Button">
                            <!-- Download SVG icon from http://tabler-icons.io/i/search -->
                                <?= tablerIcon("send")?>
                            </a>
                        </div>
                    </div>

                    <div id="dataAjax"></div>

                </div>

            </div>
            <?php $this->load->view("_partials/footer-bar")?>
        </div>
    </div>

    <!-- load modal -->
    <?php 
        if(isset($modal)) :
            foreach ($modal as $i => $modal) {
                $this->load->view("_partials/modal/".$modal);
            }
        endif;
    ?>

    <script>
        var id_kelas = "<?= $kelas['id_kelas']?>"
        var id_member = "<?= $member['id_member']?>"
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
        $(".btnReportLatihan").click(function(){
            let form = "#reportLatihan .modal-body";
            let data = {id_kelas: id_kelas, id_member:id_member};
            let result = ajax(url_base+"kelas/get_report_latihan", "POST", data);

            if(result.length > 0){
                let html = "";
                result.forEach((data, i) => {
                    html += `<li class="list-group-item d-flex justify-content-between">
                                <span>
                                    `+data.nama_pertemuan+`<br>
                                </span>
                                <span>
                                    <a href="`+url_base+`kelas/latihan/`+id_kelas+`/`+data.id_pertemuan+`/`+id_member+`" target="_blank" class="btn btn-sm btn-info">`+data.nilai+`</a>
                                </span>
                            </li>`;
                });

                $(form).html(html);
            } else {
                $(form).html(`
                    <div class="alert alert-important alert-warning alert-dismissible" role="alert">
                        <div class="d-flex">
                            <div>
                                `+icon("alert-circle", "me-2", 20)+`
                            </div>
                            <div>
                                Report Latiha Kosong
                            </div>
                        </div>
                    </div>`);
            }
        })
    </script>
<?php $this->load->view("_partials/footer")?>