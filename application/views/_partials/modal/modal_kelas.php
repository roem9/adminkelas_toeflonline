<div class="modal modal-blur fade" id="addKelas" data-bs-backdrop="static" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Tambah Kelas Baru</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form class="user" id="formAddKelas">
                    <div class="form-floating mb-3">
                        <input type="date" name="tgl_mulai" class="form form-control required">
                        <label for="">Tgl Mulai</label>
                    </div>
                    <div class="form-floating mb-3">
                        <input type="date" name="tgl_selesai" class="form form-control required">
                        <label for="">Tgl Selesai</label>
                    </div>
                    <div class="form-floating mb-3">
                        <select name="program" class="form form-control required">
                            <option value="">Pilih Program</option>
                            <?php $program = listProgram();?>
                            <?php foreach ($program as $program) :?>
                                <option value="<?= $program['nama_program']?>"><?= $program['nama_program']?></option>
                            <?php endforeach;?>
                        </select>
                        <label for="">Program Kelas</label>
                    </div>
                    <div class="form-floating mb-3">
                        <input type="text" name="nama_kelas" class="form form-control required">
                        <label for="">Nama Kelas</label>
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
 
<div class="modal modal-blur fade" id="detailKelas" data-bs-backdrop="static" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit Data Kelas</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="card">
                    <ul class="nav nav-tabs nav-fill" data-bs-toggle="tabs">
                        <li class="nav-item">
                            <a href="#tabs-data-kelas" class="nav-link active" data-bs-toggle="tab"><?= tablerIcon("database","me-1")?>Data Kelas</a>
                        </li>
                        <li class="nav-item">
                            <a href="#tabs-peserta" class="nav-link" data-bs-toggle="tab"><?= tablerIcon("users","me-1")?>Member</a>
                        </li>
                    </ul>
                    <div class="card-body">
                        <div class="tab-content">
                            <div class="tab-pane show active" id="tabs-data-kelas">
                                <input type="hidden" name="id_kelas" id="id_kelas" class="form">
                                <div class="form-floating mb-3">
                                    <input type="date" name="tgl_mulai" class="form form-control required">
                                    <label for="">Tgl Mulai</label>
                                </div>
                                <div class="form-floating mb-3">
                                    <input type="date" name="tgl_selesai" class="form form-control required">
                                    <label for="">Tgl Selesai</label>
                                </div>
                                <div class="form-floating mb-3">
                                    <select name="program" id="program" class="form form-control required">
                                        <option value="">Pilih Program</option>
                                        <?php $program = listProgram();?>
                                        <?php foreach ($program as $program) :?>
                                            <option value="<?= $program['nama_program']?>"><?= $program['nama_program']?></option>
                                        <?php endforeach;?>
                                    </select>
                                    <label for="">Program Kelas</label>
                                </div>
                                <div class="form-floating mb-3">
                                    <input type="text" name="nama_kelas" id="nama_kelas" class="form form-control required">
                                    <label for="">Nama Kelas</label>
                                </div>
                                <div class="d-flex justify-content-end">
                                    <button type="button" class="btn me-3" data-bs-dismiss="modal">Tutup</button>
                                    <button type="button" class="btn btn-success btnEdit">Ubah</button>
                                </div>
                            </div>
                            <div class="tab-pane" id="tabs-peserta">
                                <div id="list-peserta"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal modal-blur fade" id="inputKelas" data-bs-backdrop="static" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Input Kelas</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <input type="hidden" name="id" class="form">
                <div class="form-floating mb-3">
                    <input type="text" name="nama" class="form form-control" readonly>
                    <label for="">Nama Member</label>
                </div>
                <div class="form-floating mb-3">
                    <input type="text" name="program" class="form form-control" readonly>
                    <label for="">Program</label>
                </div>
                <div class="form-floating mb-3">
                    <select name="id_kelas" class="form form-control required">
                    </select>
                    <label for="">Kelas</label>
                </div>
            </div>
            <div class="modal-footer">
                <div class="d-flex justify-content-end">
                    <button type="button" class="btn me-3" data-bs-dismiss="modal">Tutup</button>
                    <button type="button" class="btn btn-primary btnTambah">Simpan</button>
                </div>
            </div>
        </div>
    </div>
</div>