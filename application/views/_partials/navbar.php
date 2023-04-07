<div class="navbar-expand-md">
    <div class="collapse navbar-collapse" id="navbar-menu">
        <div class="navbar navbar-light">
        <div class="container-xl">
            <ul class="navbar-nav">
                <li class="nav-item" id="Program">
                    <a class="nav-link" href="<?= base_url()?>program" role="button" aria-expanded="false" >
                        <span class="nav-link-icon d-md-none d-lg-inline-block">
                            <svg width="24" height="24" class="me-3">
                                <use xlink:href="<?= base_url()?>assets/tabler-icons-1.39.1/tabler-sprite.svg#tabler-book" />
                            </svg> 
                        </span>
                        <span class="nav-link-title">
                            Program
                        </span>
                    </a>
                </li>
                <li class="nav-item" id="Member">
                    <a class="nav-link" href="<?= base_url()?>member" role="button" aria-expanded="false" >
                        <span class="nav-link-icon d-md-none d-lg-inline-block">
                            <svg width="24" height="24" class="me-3">
                                <use xlink:href="<?= base_url()?>assets/tabler-icons-1.39.1/tabler-sprite.svg#tabler-users" />
                            </svg> 
                        </span>
                        <span class="nav-link-title">
                            Member
                        </span>
                    </a>
                </li>
                <li class="nav-item dropdown" id="Kelas">
                    <a class="nav-link dropdown-toggle" href="#navbar-base" data-bs-toggle="dropdown" role="button" aria-expanded="false" >
                        <span class="nav-link-icon d-md-none d-lg-inline-block">
                            <svg width="24" height="24" class="me-3">
                                <use xlink:href="<?= base_url()?>assets/tabler-icons-1.39.1/tabler-sprite.svg#tabler-book" />
                            </svg> 
                        </span>
                        <span class="nav-link-title">
                            Kelas
                        </span>
                    </a>
                    <div class="dropdown-menu">
                        <a class="dropdown-item" id="listKelasAktif" href="<?= base_url()?>kelas/aktif">
                            List Kelas Aktif
                        </a>
                        <a class="dropdown-item" id="listKelasNonaktif" href="<?= base_url()?>kelas/nonaktif">
                            List Kelas Nonaktif
                        </a>
                    </div>
                </li>
                <li class="nav-item" id="Inbox">
                    <a class="nav-link" href="<?= base_url()?>inbox" role="button" aria-expanded="false" >
                        <span class="nav-link-icon d-md-none d-lg-inline-block">
                            <svg width="24" height="24" class="me-3">
                                <use xlink:href="<?= base_url()?>assets/tabler-icons-1.39.1/tabler-sprite.svg#tabler-book" />
                            </svg> 
                        </span>
                        <span class="nav-link-title">
                            Inbox
                        </span>
                    </a>
                </li>
                <li class="nav-item dropdown" id="Laporan">
                    <a class="nav-link dropdown-toggle" href="#navbar-base" data-bs-toggle="dropdown" role="button" aria-expanded="false" >
                        <span class="nav-link-icon d-md-none d-lg-inline-block">
                            <svg width="24" height="24" class="me-3">
                                <use xlink:href="<?= base_url()?>assets/tabler-icons-1.39.1/tabler-sprite.svg#tabler-report" />
                            </svg> 
                        </span>
                        <span class="nav-link-title">
                            Laporan
                        </span>
                    </a>
                    <div class="dropdown-menu">
                        <a class="dropdown-item" href="<?= base_url()?>kelas/laporan_peserta">
                            Laporan Peserta
                        </a>
                        <a class="dropdown-item" href="<?= base_url()?>kelas/laporan_sertifikat">
                            Laporan Sertifikat
                        </a>
                        <a class="dropdown-item" id="laporanBulanan" href="<?= base_url()?>kelas/laporan_bulanan">
                            Laporan Bulanan
                        </a>
                    </div>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#navbar-base" data-bs-toggle="dropdown" role="button" aria-expanded="false" >
                        <span class="nav-link-icon d-md-none d-lg-inline-block">
                            <svg width="24" height="24" class="me-3">
                                <use xlink:href="<?= base_url()?>assets/tabler-icons-1.39.1/tabler-sprite.svg#tabler-users" />
                            </svg> 
                        </span>
                        <span class="nav-link-title">
                            Total Peserta
                        </span>
                    </a>
                    <div class="dropdown-menu">
                        <a class="dropdown-item" href="javascript:void()">
                            Total Peserta = <?= totalPeserta();?>
                        </a>
                        <a class="dropdown-item" href="javascript:void()">
                            Total Sertifikat = <?= totalSertifikat();?>
                        </a>
                    </div>
                </li>
            </ul>
        </div>
        </div>
    </div>
</div>