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
                    <form action="<?= base_url()?>program/materi_latihan" method="POST" class="mb-3">
                        <div class="row">
                            <div class="col-md-3 col-sm-12">
                                <div class="form-floating mb-3">
                                    <select name="pertemuan" class="form form-control form-control-sm" required>
                                        <option value="">Pilih Pertemuan</option>
                                        <?php
                                            $pertemuan = pertemuan_program($id_program);
                                            foreach ($pertemuan as $pertemuan) :?>
                                            <option value="<?= $pertemuan['id_pertemuan']?>"><?= $pertemuan['nama_pertemuan']?></option>
                                        <?php endforeach;?>
                                    </select>
                                    <label>Pertemuan</label>
                                </div>
                            </div>
                            <div class="col-md-3 col-sm-12">
                                <div class="form-floating mb-3">
                                    <select name="materi_latihan" class="form form-control form-control-sm" required>
                                        <option value="">Pilih Materi / Latihan</option>
                                        <option value="detailPertemuan">List Materi</option>
                                        <option value="detailLatihan">List Latihan</option>
                                    </select>
                                    <label>Materi / Latihan</label>
                                </div>
                            </div>
                        </div>
                        <div>
                            <div class="col-md-3 col-sm-12">
                                <button type="submit" class="btn btn-md btn-success">Pindah</button>
                            </div>
                        </div>
                    </form>
                    <div class="row align-items-center">
                        <div class="col">
                            <h2 class="page-title">
                                <?= $title?>
                            </h2>
                        </div>
                        <!-- Page title actions -->
                        <div class="col-auto ms-auto d-print-none">
                        <div class="btn-list">
                            <a href="javascript:void(0)" class="btn btn-primary d-none d-sm-inline-block addItem" data-id="istima" data-bs-toggle="modal" data-bs-target="#addItem">
                            <!-- Download SVG icon from http://tabler-icons.io/i/plus -->
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><line x1="12" y1="5" x2="12" y2="19" /><line x1="5" y1="12" x2="19" y2="12" /></svg>
                            Tambahkan Item
                            </a>
                            <a href="javascript:void(0)" class="btn btn-primary d-sm-none btn-icon addItem" data-id="istima" data-bs-toggle="modal" data-bs-target="#addItem" aria-label="Create new report">
                            <!-- Download SVG icon from http://tabler-icons.io/i/plus -->
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><line x1="12" y1="5" x2="12" y2="19" /><line x1="5" y1="12" x2="19" y2="12" /></svg>
                            </a>
                        </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="page-body">
                <div class="container-xl">
                    
                    <div class="row row-cards FieldContainer" data-masonry='{"percentPosition": true }' id="dataAjax">
                        
                    </div>

                </div>

            </div>
            <?php $this->load->view("_partials/footer-bar")?>
        </div>
    </div>
    
    <script>
        let id = "<?= $id_pertemuan?>";
    </script>

    <!-- load modal -->
    <?php 
        if(isset($modal)) :
            foreach ($modal as $i => $modal) {
                $this->load->view("_partials/modal/".$modal);
            }
        endif;
    ?>

    <!-- load javascript -->
    <script>
        let latihan = "<?= $latihan?>"

        console.log(latihan)
    </script>

    <?php  
        if(isset($js)) :
            foreach ($js as $i => $js) :?>
                <script src="<?= base_url()?>assets/myjs/<?= $js?>"></script>
                <?php 
            endforeach;
        endif;    
    ?>

    <script>
        activeMenu("<?= $menu?>");
        
        $( function() {
            $( "#sortable" ).sortable();
            $( "#sortable" ).disableSelection();
        } );
    </script>
    
<?php $this->load->view("_partials/footer")?>