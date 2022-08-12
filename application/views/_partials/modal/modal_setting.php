<div class="modal modal-blur fade" id="pesanRegistrasi" data-bs-backdrop="static" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Pesan Registrasi</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <input type="hidden" name="id" class="form">
                <div class="form-floating mb-3">
                    <textarea name="value" class="form form-control required" data-bs-toggle="autosize"></textarea>
                    <label for="" class="col-form-label">Pesan</label>
                    <small class="text-danger mt-3">*pesan ini yang akan tampil setelah peserta telah mengisi data di formulir pendaftaran</small>
                </div>
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

<div class="modal modal-blur fade" id="pesanPresensi" data-bs-backdrop="static" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Notifikasi Presensi Peserta</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <input type="hidden" name="id" class="form">
                <div class="form-floating mb-3">
                    <textarea name="value" class="form form-control required" data-bs-toggle="autosize" style="height: 150px"></textarea>
                    <label for="" class="col-form-label">Notifikasi</label>
                    <small class="text-danger mt-3">*Notifikasi yang akan dikirim kepada peserta untuk mengingatkan pengisian presensi</small>
                    <small>
                        <p>
                            <b>Variabel Yang Dapat Digunakan</b><br>
                            nama_peserta = Nama Peserta <br>
                            nama_kelas = Nama Kelas <br>
                            nama_pertemuan = Nama Pertemuan <br>
                            link_member = Link Member Area <br>
                        </p>
                    </small>
                </div>
                <div class="form-floating mb-3">
                    <textarea name="" class="form-control" data-bs-toggle="autosize" readonly style="height: 150px">*ABSEN*%0A*tanbih*%20kak%20nama_peserta%20belum%20mengisi%20kehadiran%20di%20kelas%20nama_kelas%20nama_pertemuan%2C%20silahkan%20segera%20mengisi%20kehadiran%20kakak%20melalui%20member%20area%20pada%20link%20link_member</textarea>
                    <label for="" class="col-form-label">Contoh Notifikasi</label>
                    <small>
                        <p>
                            Untuk Membuat Notifikasi Silakan Kunjungi Link : <a href="https://bukuwarung.com/link-whatsapp/" target="_blank">Berikut</a>
                        </p>
                    </small>
                </div>
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

<div class="modal modal-blur fade" id="pesanLatihan" data-bs-backdrop="static" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Notifikasi Latihan Peserta</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <input type="hidden" name="id" class="form">
                <div class="form-floating mb-3">
                    <textarea name="value" class="form form-control required" data-bs-toggle="autosize" style="height: 150px"></textarea>
                    <label for="" class="col-form-label">Notifikasi</label>
                    <small class="text-danger mt-3">*Notifikasi yang akan dikirim kepada peserta untuk mengingatkan pengerjaan latihan</small>
                    <small>
                        <p>
                            <b>Variabel Yang Dapat Digunakan</b><br>
                            nama_peserta = Nama Peserta <br>
                            nama_kelas = Nama Kelas <br>
                            nama_pertemuan = Nama Pertemuan <br>
                            link_member = Link Member Area <br>
                        </p>
                    </small>
                </div>
                <div class="form-floating mb-3">
                    <textarea name="" class="form-control" data-bs-toggle="autosize" readonly style="height: 150px">*Tugas%2Flatihan*%0A*Tanbih*%0Akk%20nama_peserta%20belum%20mengerjakan%20latihan%20di%20kelas%20nama_kelas%20nama_pertemuan.%20Silahkan%20untuk%20segera%20dikerjakan%20ya%20kak</textarea>
                    <label for="" class="col-form-label">Contoh Notifikasi</label>
                    <small>
                        <p>
                            Untuk Membuat Notifikasi Silakan Kunjungi Link : <a href="https://bukuwarung.com/link-whatsapp/" target="_blank">Berikut</a>
                        </p>
                    </small>
                </div>
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