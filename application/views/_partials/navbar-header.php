<header class="navbar navbar-expand-md navbar-light sticky-top d-print-none">
    <div class="container-xl">
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbar-menu">
        <span class="navbar-toggler-icon"></span>
    </button>
    <h1 class="navbar-brand navbar-brand-autodark d-none-navbar-horizontal pe-0 pe-md-3">
        <a href="#">
        <img src="<?= base_url()?>assets/static/logo.png" width="110" height="32" alt="Tabler" class="navbar-brand-image">
        </a>
    </h1>
    <div class="navbar-nav flex-row order-md-last">
        <?php if($menu == "Materi" || $menu == "Latihan") :?>
            <div class="nav-item dropdown d-md-flex me-1">
                <?php if($menu == "Materi") :?>
                    <a href="#addMateri" class="nav-link px-0 addMateri" data-bs-toggle="modal" tabindex="-1" aria-label="Show notifications">
                <?php elseif($menu == "Latihan") :?>
                    <a href="#addItem" class="nav-link px-0 addItem" data-bs-toggle="modal" tabindex="-1" aria-label="Show notifications">
                <?php endif;?>
                    <svg width="24" height="24">
                        <use xlink:href="<?= base_url()?>assets/tabler-icons-1.39.1/tabler-sprite.svg#tabler-plus" />
                    </svg>
                </a>
            </div>
            <div class="nav-item dropdown d-md-flex me-3">
                <a href="javascript:void(0)" class="nav-link px-0 saveUrutan" tabindex="-1" aria-label="Show notifications">
                    <svg width="24" height="24" id="saveButton">
                        <use xlink:href="<?= base_url()?>assets/tabler-icons-1.39.1/tabler-sprite.svg#tabler-device-floppy" />
                    </svg>
                </a>
            </div>
        <?php endif;?>
        <div class="nav-item dropdown">
        <a href="#" class="nav-link d-flex lh-1 text-reset p-0" data-bs-toggle="dropdown" aria-label="Open user menu">
            <img src="<?= base_url()?>assets/tabler-icons-1.39.1/icons/user.svg" class="rounded" alt="Górą ty" width="30" height="30">
            <div class="d-none d-xl-block ps-2">
            <!-- <div>Paweł Kuna</div> -->
            <div class="mt-1 small text-muted"><?= ucwords($this->session->userdata('level'))?></div>
            </div>
        </a>
        <div class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
            <a href="<?= base_url()?>auth/logout" class="dropdown-item"><?= tablerIcon("logout", "me-1")?>Logout</a>
        </div>
        </div>
    </div>
    </div>
</header>