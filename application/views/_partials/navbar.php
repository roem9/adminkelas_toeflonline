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
            </ul>
        </div>
        </div>
    </div>
</div>