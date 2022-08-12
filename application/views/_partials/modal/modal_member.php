<div class="modal modal-blur fade" id="addMember" data-bs-backdrop="static" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Tambah Member</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form class="user" id="formAddMember">
                    <div class="form-floating mb-3">
                        <input type="date" name="tgl_masuk" class="form form-control form-control-sm required">
                        <label class="col-form-label">Tgl Masuk</label>
                    </div>
                    <div class="form-floating mb-3">
                        <input type="text" name="nama" class="form form-control form-control-sm required">
                        <label class="col-form-label">Nama Member</label>
                    </div>
                    <div class="form-floating mb-3">
                        <input type="text" name="t4_lahir" class="form form-control form-control-sm required">
                        <label class="col-form-label">Tempat Lahir</label>
                    </div>
                    <div class="form-floating mb-3">
                        <input type="date" name="tgl_lahir" class="form form-control form-control-sm required">
                        <label class="col-form-label">Tanggal Lahir</label>
                    </div>
                    <div class="form-floating mb-3">
                        <input type="text" name="no_hp" class="form form-control form-control-sm required number">
                        <label class="col-form-label">No WA</label>
                        <small class="text-danger">* Harap mengisi nomor whatsapp dengan kode negara, contoh : 6281xxxxx</small>
                    </div>
                    <div class="form-floating mb-3">
                        <input type="text" name="email" class="form form-control form-control-sm required">
                        <label class="col-form-label">Email</label>
                    </div>
                    <div class="form-floating mb-3">
                        <textarea name="alamat" class="form form-control required" style="height: 100px"></textarea>
                        <label for="" class="col-form-label">Alamat</label>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <div class="d-flex justify-content-end">
                    <button type="button" class="btn me-3" data-bs-dismiss="modal">Tutup</button>
                    <button type="button" class="btn btn-primary btnTambah">Tambah</button>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal modal-blur fade" id="detailMember" data-bs-backdrop="static" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Detail Member</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="card">
                    <ul class="nav nav-tabs nav-fill" data-bs-toggle="tabs">
                        <li class="nav-item">
                            <a href="#tabs-profil" class="nav-link active" data-bs-toggle="tab"><?= tablerIcon("user","me-1")?>Profil</a>
                        </li>
                        <li class="nav-item">
                            <a href="#tabs-kelas" class="nav-link" data-bs-toggle="tab"><?= tablerIcon("school","me-1")?>Kelas</a>
                        </li>
                        <li class="nav-item">
                            <a href="#tabs-add-kelas" class="nav-link" data-bs-toggle="tab"><?= tablerIcon("plus","me-1")?>Tambah Kelas</a>
                        </li>
                    </ul>
                    <div class="card-body">
                        <div class="tab-content">
                            <div class="tab-pane show active" id="tabs-profil">
                                <input type="hidden" name="id_member" class="form required">
                                <div class="form-floating mb-3">
                                    <input type="date" name="tgl_masuk" class="form form-control form-control-sm required">
                                    <label class="col-form-label">Tgl Masuk</label>
                                </div>
                                <div class="form-floating mb-3">
                                    <input type="text" name="nama" class="form form-control form-control-sm required">
                                    <label class="col-form-label">Nama Member</label>
                                </div>
                                <div class="form-floating mb-3">
                                    <input type="text" name="t4_lahir" class="form form-control form-control-sm required">
                                    <label class="col-form-label">Tempat Lahir</label>
                                </div>
                                <div class="form-floating mb-3">
                                    <input type="date" name="tgl_lahir" class="form form-control form-control-sm required">
                                    <label class="col-form-label">Tanggal Lahir</label>
                                </div>
                                <div class="form-floating mb-3">
                                    <textarea name="alamat" class="form form-control required" style="height: 100px"></textarea>
                                    <label for="" class="col-form-label">Alamat</label>
                                </div>
                                <div class="form-floating mb-3">
                                    <input type="text" name="no_hp" class="form form-control form-control-sm required number">
                                    <label class="col-form-label">No WA</label>
                                    <small class="text-danger">* Harap mengisi nomor whatsapp dengan kode negara, contoh : 6281xxxxx</small>
                                </div>
                                <div class="form-floating mb-3">
                                    <input type="text" name="email" class="form form-control form-control-sm required">
                                    <label class="col-form-label">Email</label>
                                </div>
                                <div class="d-flex justify-content-end">
                                    <button type="button" class="btn me-3" data-bs-dismiss="modal">Tutup</button>
                                    <button type="button" class="btn btn-success btnEdit">Ubah</button>
                                </div>
                            </div>
                            <div class="tab-pane" id="tabs-kelas">
                                <div class="tab-content">
                                    <div class="tab-pane show active" id="tabs-kelas-user">
                                        <div id="list-kelas"></div>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane" id="tabs-add-kelas">
                                <input type="hidden" name="id_member" class="form required">
                                <div class="form-floating mb-3">
                                    <select name="program" class="form form-control form-control-sm required">
                                        <option value="">Pilih Program</option>
                                        <?php
                                            $program = listProgram();
                                            foreach ($program as $program) :?>
                                            <option value="<?= $program['nama_program']?>"><?= $program['nama_program']?></option>
                                        <?php endforeach;?>
                                    </select>
                                    <label class="col-form-label">Program</label>
                                </div>
                                <div class="form-floating mb-3">
                                    <select name="id_kelas" class="form form-control form-control-sm required">
                                        <option value="">Pilih Kelas</option>
                                        <?php
                                            $kelas = listKelas();
                                            foreach ($kelas as $kelas) :?>
                                            <option value="<?= $kelas['id_kelas']?>">[<?= $kelas['member'] . "] " . $kelas['nama_kelas']?></option>
                                        <?php endforeach;?>
                                    </select>
                                    <label class="col-form-label">Kelas</label> 
                                </div>
                                <div class="d-flex justify-content-end">
                                    <button type="button" class="btn me-3" data-bs-dismiss="modal">Tutup</button>
                                    <button type="button" class="btn btn-primary btnAddKelas">Tambah Kelas</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>