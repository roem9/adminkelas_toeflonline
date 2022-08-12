<div class="modal modal-blur fade" id="addPertemuan" data-bs-backdrop="static" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Tambah Pertemuan</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form class="user" id="formAddPertemuan">
                    <input type="hidden" name="id_program" class="form required" value="<?= $id_program?>">
                    <div class="form-floating mb-3">
                        <input type="date" name="tgl_pembuatan" class="form form-control form-control-sm required">
                        <label class="col-form-label">Tgl Pembuatan</label>
                    </div>
                    <div class="form-floating mb-3">
                        <input type="text" name="nama_pertemuan" class="form form-control form-control-sm required">
                        <label class="col-form-label">Nama Pertemuan</label>
                    </div>
                    <div class="form-floating mb-3">
                        <select name="presensi" class="form form-control form-control-sm required">
                            <option value="">Pilih</option>
                            <option value="Ya">Ya</option>
                            <option value="Tidak">Tidak</option>
                        </select>
                        <label>Berikan Presensi?</label>
                    </div>
                    <div class="form-floating mb-3">
                        <select name="latihan" class="form form-control form-control-sm required">
                            <option value="">Pilih Tipe Latihan</option>
                            <!-- <option value="Tidak Ada Latihan">Tidak Ada Latihan</option> -->
                            <option value="Koreksi Otomatis">Koreksi Otomatis</option>
                            <!-- <option value="Koreksi Manual">Koreksi Manual</option> -->
                            <option value="Latihan Kosa Kata">Latihan Kosa Kata</option>
                            <option value="Pre / Mid Test Listening">Pre / Mid Test Listening</option>
                            <option value="Post Test Listening">Post Test Listening</option>
                            <option value="Pre / Mid Test Structure">Pre / Mid Test Structure</option>
                            <option value="Post Test Structure">Post Test Structure</option>
                            <option value="Pre / Mid Test Reading">Pre / Mid Test Reading</option>
                            <option value="Post Test Reading">Post Test Reading</option>
                            <!-- <option value="Input Manual">Input Manual</option> -->
                        </select>
                        <label>Tipe Latihan</label>
                    </div>
                    <div class="form-floating mb-3">
                        <select name="perulangan" class="form form-control form-control-sm required">
                            <option value="">Pilih Perulangan</option>
                            <option value="Sekali">Sekali</option>
                            <option value="Berkali-kali">Berkali-kali</option>
                        </select>
                        <label>Perulangan Latihan</label>
                    </div>
                    <div class="form-floating mb-3 text_soal_indo" style="display:none">
                        <textarea name="text_soal_indo" class="form form-control form-control-sm" data-bs-toggle="autosize"></textarea>
                        <label for="">Text Soal Bahasa Indonesia</label>
                    </div>
                    <div class="form-floating mb-3 text_soal_asing" style="display:none">
                        <textarea name="text_soal_asing" class="form form-control form-control-sm" data-bs-toggle="autosize"></textarea>
                        <label for="">Text Soal Bahasa Asing</label>
                    </div>
                    <div class="form-floating mb-3 jumlah_soal" style="display:none">
                        <input type="text" name="jumlah_soal" class="form form-control form-control-sm number">
                        <label class="col-form-label">Jumlah Soal</label>
                    </div>
                    <div class="form-floating mb-3 poin" style="display:none">
                        <input type="text" name="poin" class="form form-control form-control-sm number">
                        <label class="col-form-label">Poin Persoal</label>
                    </div>
                    <div class="form-floating mb-3 pembahasan" style="display:none">
                        <select name="pembahasan" class="form form-control form-control-sm required">
                            <option value="">Pilih</option>
                            <option value="Ya">Ya</option>
                            <option value="Tidak">Tidak</option>
                        </select>
                        <label>Tampilkan Pembahasan Latihan?</label>
                    </div>
                    <div class="form-floating mb-3">
                        <textarea name="catatan" class="form form-control form-control-sm" data-bs-toggle="autosize"></textarea>
                        <label for="">Catatan Materi</label>
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

<div class="modal modal-blur fade" id="detailPertemuan" data-bs-backdrop="static" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Detail Pertemuan</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form class="user" id="formEditPertemuan">
                    <input type="hidden" name="id_pertemuan" class="form required">
                    <div class="form-floating mb-3">
                        <input type="date" name="tgl_pembuatan" class="form form-control form-control-sm required">
                        <label class="col-form-label">Tgl Pembuatan</label>
                    </div>
                    <div class="form-floating mb-3">
                        <select name="hapus" class="form form-control form-control-sm required">
                            <option value="">Pilih Status</option>
                            <option value="0">Aktif</option>
                            <option value="1">Nonaktif</option>
                        </select>
                        <label class="col-form-label">Status</label>
                    </div>
                    <div class="form-floating mb-3">
                        <input type="text" name="urutan" class="form form-control form-control-sm required">
                        <label class="col-form-label">Urutan</label>
                    </div>
                    <div class="form-floating mb-3">
                        <input type="text" name="nama_pertemuan" class="form form-control form-control-sm required">
                        <label class="col-form-label">Nama Pertemuan</label>
                    </div>
                    <div class="form-floating mb-3">
                        <select name="presensi" class="form form-control form-control-sm required">
                            <option value="">Pilih</option>
                            <option value="Ya">Ya</option>
                            <option value="Tidak">Tidak</option>
                        </select>
                        <label>Berikan Presensi?</label>
                    </div>
                    <div class="form-floating mb-3">
                        <select name="latihan" class="form form-control form-control-sm required">
                            <option value="">Pilih Tipe Latihan</option>
                            <!-- <option value="Tidak Ada Latihan">Tidak Ada Latihan</option> -->
                            <option value="Koreksi Otomatis">Koreksi Otomatis</option>
                            <!-- <option value="Koreksi Manual">Koreksi Manual</option> -->
                            <option value="Latihan Kosa Kata">Latihan Kosa Kata</option>
                            <option value="Pre / Mid Test Listening">Pre / Mid Test Listening</option>
                            <option value="Post Test Listening">Post Test Listening</option>
                            <option value="Pre / Mid Test Structure">Pre / Mid Test Structure</option>
                            <option value="Post Test Structure">Post Test Structure</option>
                            <option value="Pre / Mid Test Reading">Pre / Mid Test Reading</option>
                            <option value="Post Test Reading">Post Test Reading</option>
                            <!-- <option value="Input Manual">Input Manual</option> -->
                        </select>
                        <label>Tipe Latihan</label>
                    </div>
                    <div class="form-floating mb-3">
                        <select name="perulangan" class="form form-control form-control-sm required">
                            <option value="">Pilih Perulangan</option>
                            <option value="Sekali">Sekali</option>
                            <option value="Berkali-kali">Berkali-kali</option>
                        </select>
                        <label>Perulangan Latihan</label>
                    </div>
                    <div class="form-floating mb-3 text_soal_indo" style="display:none">
                        <textarea name="text_soal_indo" class="form form-control form-control-sm" data-bs-toggle="autosize"></textarea>
                        <label for="">Text Soal Bahasa Indonesia</label>
                    </div>
                    <div class="form-floating mb-3 text_soal_asing" style="display:none">
                        <textarea name="text_soal_asing" class="form form-control form-control-sm" data-bs-toggle="autosize"></textarea>
                        <label for="">Text Soal Bahasa Asing</label>
                    </div>
                    <div class="form-floating mb-3 jumlah_soal" style="display:none">
                        <input type="text" name="jumlah_soal" class="form form form-control form-control-sm required number">
                        <label class="col-form-label">Jumlah Soal</label>
                    </div>
                    <div class="form-floating mb-3 poin" style="display:none">
                        <input type="text" name="poin" class="form form-control form-control-sm required number">
                        <label class="col-form-label">Poin Persoal</label>
                    </div>
                    <div class="form-floating mb-3 pembahasan" style="display:none">
                        <select name="pembahasan" class="form form-control form-control-sm required">
                            <option value="">Pilih</option>
                            <option value="Ya">Ya</option>
                            <option value="Tidak">Tidak</option>
                        </select>
                        <label>Tampilkan Pembahasan Latihan?</label>
                    </div>
                    <div class="form-floating mb-3">
                        <textarea name="catatan" class="form form-control form-control-sm" style="height: 100px" data-bs-toggle="autosize"></textarea>
                        <label for="">Catatan Materi</label>
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