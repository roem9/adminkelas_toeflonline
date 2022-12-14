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
                            <a href="<?= base_url()?>kelas/laporan_bulanan?>" class="btn btn-success d-none d-sm-inline-block">
                                <!-- Download SVG icon from http://tabler-icons.io/i/plus -->
                                <?= tablerIcon("refresh");?>
                                Segarkan
                            </a>
                            <a href="<?= base_url()?>kelas/laporan_bulanan?>" class="btn btn-success d-sm-none btn-icon" aria-label="Create new report">
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
                        <table class="table card-table table-vcenter text-nowrap text-dark">
                            <tr>
                                <th>Periode</th>
                                <th class="w-1">Kelas</th>
                                <th class="w-1">Peserta</th>
                                <th class="w-1">Sertifikat</th>
                                <th class="w-1">Cetak</th>
                            </tr>
                            <?php
                                if($laporan) :
                                    foreach ($laporan as $laporan) :?>
                                        <tr>
                                            <td><?= $laporan['periode']?></td>
                                            <td><center><?= $laporan['class']?></center></td>
                                            <td><center><?= $laporan['student']?></center></td>
                                            <td><center><?= $laporan['certificate']?></center></td>
                                            <td><center><a target="_blank" href="<?= base_url()?>kelas/cetak_laporan_bulanan/<?= $laporan['month']?>/<?= $laporan['year']?>"><?= tablerIcon("printer");?></a></center></td>
                                        </tr>
                                <?php 
                                    endforeach;
                                endif;?>
                            
                        </table>
                    </div>
                </div>
 
            </div>
            <?php $this->load->view("_partials/footer-bar")?>
        </div>
    </div>
 
    <script>
        $("#<?= $menu?>").addClass("active")
        $("#<?= $dropdown?>").addClass("active")
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