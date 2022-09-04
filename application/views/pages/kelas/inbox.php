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
                        <div class="col-auto ms-auto d-print-none">
                            <div class="btn-list">
                            <a href="<?= base_url()?>kelas/inbox/<?= md5($kelas['id_kelas'])?>" class="btn btn-success d-none d-sm-inline-block">
                                <!-- Download SVG icon from http://tabler-icons.io/i/plus -->
                                <?= tablerIcon("refresh");?>
                                Segarkan
                            </a>
                            <a href="<?= base_url()?>kelas/inbox/<?= md5($kelas['id_kelas'])?>" class="btn btn-success d-sm-none btn-icon" aria-label="Create new report">
                                <!-- Download SVG icon from http://tabler-icons.io/i/plus -->
                                <?= tablerIcon("refresh");?>
                            </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="page-body">
                <div class="container-xl">
                    <div class="card shadow mb-4">
                    <div class="card-body card-body-scrollable card-body-scrollable-shadow">
                        <div class="divide-y">
                            <?php
                                foreach ($member as $member) :?>
                                <div>
                                    <div class="row">
                                        <div class="col-auto">
                                            <a href="<?= base_url()?>kelas/inbox_peserta/<?= md5($member['id_kelas'])?>/<?= md5($member['id_member'])?>">
                                                <span class="avatar"><?= tablerIcon("user")?></span>
                                            </a>
                                        </div>
                                        <div class="col">
                                            <a href="<?= base_url()?>kelas/inbox_peserta/<?= md5($member['id_kelas'])?>/<?= md5($member['id_member'])?>">
                                                <div class="text-truncate">
                                                    <strong><?= $member['nama']?></strong>
                                                </div>
                                                <div class="text-muted"><?= waktuInbox($member['id_member'], $member['id_kelas'])?></div>
                                            </a>
                                        </div>
                                        <?php if($member['baca_admin'] == 0) :?>
                                            <div class="col-auto align-self-center blink_me">
                                                <div class="badge bg-primary"></div>
                                            </div>
                                        <?php endif;?>
                                    </div>
                                </div>
                            <?php endforeach;?>
                        </div>
                    </div>
                </div>
 
            </div>
            <?php $this->load->view("_partials/footer-bar")?>
        </div>
    </div>
 
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