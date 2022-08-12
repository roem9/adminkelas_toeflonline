<div class="modal modal-blur fade" id="addPengajar" data-bs-backdrop="static" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Tambah Pengajar</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form class="user" id="formAddPengajar">
                    <div class="form-floating mb-3">
                        <input type="date" name="tgl_masuk" class="form form-control form-control-sm required">
                        <label class="col-form-label">Tgl Masuk</label>
                    </div>
                    <div class="form-floating mb-3">
                        <input type="text" name="nama_pengajar" class="form form-control form-control-sm required">
                        <label class="col-form-label">Nama Pengajar</label>
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
                        <input type="text" name="no_hp" class="form form-control form-control-sm required">
                        <label class="col-form-label">No WA</label>
                        <small class="text-danger">* Harap mengisi nomor whatsapp dengan kode negara, contoh : 6281xxxxx</small>
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

<div class="modal modal-blur fade" id="detailPengajar" data-bs-backdrop="static" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Detail Pengajar</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form class="user" id="formEditPengajar">
                    <input type="hidden" name="id_pengajar" class="form required">
                    <div class="form-floating mb-3">
                        <select name="status" class="form form-control form-control-sm required">
                            <option value="">Pilih Status</option>
                            <option value="aktif">Aktif</option>
                            <option value="nonaktif">Nonaktif</option>
                        </select>
                        <label class="col-form-label">Status</label>
                    </div>
                    <div class="form-floating mb-3">
                        <input type="date" name="tgl_masuk" class="form form-control form-control-sm required">
                        <label class="col-form-label">Tgl Masuk</label>
                    </div>
                    <div class="form-floating mb-3">
                        <input type="text" name="nama_pengajar" class="form form-control form-control-sm required">
                        <label class="col-form-label">Nama Pengajar</label>
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
                        <input type="text" name="no_hp" class="form form-control form-control-sm required">
                        <label class="col-form-label">No WA</label>
                        <small class="text-danger">* Harap mengisi nomor whatsapp dengan kode negara, contoh : 6281xxxxx</small>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <div class="d-flex justify-content-end">
                    <button type="button" class="btn me-3" data-bs-dismiss="modal">Tutup</button>
                    <button type="button" class="btn btn-success btnEdit">Ubah</button>
                </div>
            </div>
        </div>
    </div>
</div>