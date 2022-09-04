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
                    <a href="<?= base_url()?>kelas/inbox/<?= md5($kelas['id_kelas'])?>">Ruang Diskusi</a> > TOEFL STRUCTURE 1 AGUSTUS 2022 | Muhammad Rum
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

    
<?php $this->load->view("_partials/footer")?>