$(document).on("click", ".addMateri, #addMateri .btnBack", function(){
    let form = "#addMateri";

    let html = `
        <div class="mb-3">
            <label class="form-label">Pilih Materi</label>
            <div class="form-selectgroup form-selectgroup-boxes d-flex flex-column">
                <label class="form-selectgroup-item flex-fill">
                    <input type="radio" name="item" value="petunjuk" class="form-selectgroup-input">
                    <div class="form-selectgroup-label d-flex align-items-center p-3">
                        <div class="me-3">
                            <span class="form-selectgroup-check"></span>
                        </div>
                        <div>
                            Tambah Teks
                        </div>
                    </div>
                </label>
                <label class="form-selectgroup-item flex-fill">
                    <input type="radio" name="item" value="video" class="form-selectgroup-input">
                    <div class="form-selectgroup-label d-flex align-items-center p-3">
                        <div class="me-3">
                            <span class="form-selectgroup-check"></span>
                        </div>
                        <div>
                            Tambah Video
                        </div>
                    </div>
                </label>
                <label class="form-selectgroup-item flex-fill">
                    <input type="radio" name="item" value="video pembahasan" class="form-selectgroup-input">
                    <div class="form-selectgroup-label d-flex align-items-center p-3">
                        <div class="me-3">
                            <span class="form-selectgroup-check"></span>
                        </div>
                        <div>
                            Tambah Video Pembahasan
                        </div>
                    </div>
                </label>
                <label class="form-selectgroup-item flex-fill">
                    <input type="radio" name="item" value="audio" class="form-selectgroup-input">
                    <div class="form-selectgroup-label d-flex align-items-center p-3">
                        <div class="me-3">
                            <span class="form-selectgroup-check"></span>
                        </div>
                        <div>
                            Tambah Audio
                        </div>
                    </div>
                </label>
                <label class="form-selectgroup-item flex-fill">
                    <input type="radio" name="item" value="gambar" class="form-selectgroup-input">
                    <div class="form-selectgroup-label d-flex align-items-center p-3">
                        <div class="me-3">
                            <span class="form-selectgroup-check"></span>
                        </div>
                        <div>
                            Tambah Gambar
                        </div>
                    </div>
                </label>
            </div>
        </div>`;

    $(form+" .modal-body").html(html);

    $(form+" .modal-footer").addClass(`d-flex justify-content-end`);
    $(form+" .modal-footer").removeClass(`d-flex justify-content-between`)
    $(form+" .modal-footer").html(`
        <div class="d-flex justify-content-end">
            <button type="button" class="btn me-3" data-bs-dismiss="modal">Tutup</button>
            <button type="button" class="btn btn-success btnNext">
                Next 
                <svg width="18" height="18">
                    <use xlink:href="`+url_base+`assets/tabler-icons-1.39.1/tabler-sprite.svg#tabler-arrow-right" />
                </svg> 
            </button>
        </div>
    `)
})

var count_choice = 0;

$(document).on("click", "#addMateri .btnNext", function(){
    let form = "#addMateri";
    let item = $(form+" input[name='item']:checked").val()

    if($(form+" input[name='item']:checked").length == 0){
        Swal.fire({
            icon: 'error',
            title: 'Oops...',
            text: 'pilih item terlebih dahulu'
        })
    } else {
        
        let html = `<input type="hidden" name="item" value="`+item+`">`;

        if(item == "video" || item == "video pembahasan"){
            html += `
            <div class="form-floating mb-3">
                <textarea name="link" class="form form-control required" data-bs-toggle="autosize" style="height: 100px" placeholder="Type something…"></textarea>
                <label for="" class="col-form-label">Link Video</label>
            </div>`;

            $(form+" .modal-body").html(html);

        } else if(item == "petunjuk"){
            html += `
            <div class="mb-3">
                <textarea name="soal" class='ckeditor' id='form-text'></textarea>
            </div>
            <div class="form-floating mb-3">
                <select name="penulisan" class="form-control required">
                    <option value="">Pilih Arah Penulisan</option>
                    <option value="LTR">LTR (Left To Right)</option>
                    <option value="RTL">RTL (Right To Left)</option>
                </select>
                <label for="">Penulisan</label>
            </div>`;

            $(form+" .modal-body").html(html);
            CKEDITOR.replace('form-text');

        } else if(item == "audio"){
            html += `
            <label for="">Upload Audio</label>
            <div class="form-floating mb-3">
                <input type="file" name="file" id="file" class="form form-control required">\
            </div>`;

            $(form+" .modal-body").html(html);
        } else if(item == "gambar"){
            html += `
            <label for="">Upload Gambar</label>
            <div class="form-floating mb-3">
                <input type="file" name="file" id="file" class="form form-control required">\
            </div>`;

            $(form+" .modal-body").html(html);
        }

    
        $(form+" .modal-footer").removeClass(`d-flex justify-content-end`);
        $(form+" .modal-footer").addClass(`d-flex justify-content-between`)
        $(form+" .modal-footer").html(`
            <div>
                <button type="button" class="btn btn-success btnBack">
                    <svg width="18" height="18">
                        <use xlink:href="`+url_base+`assets/tabler-icons-1.39.1/tabler-sprite.svg#tabler-arrow-left" />
                    </svg> 
                    Back 
                </button>
            </div>
            <div>
                <button type="button" class="btn mr-3" data-bs-dismiss="modal">Tutup</button>
                <button type="button" class="btn btn-success btnAdd">
                    <svg width="18" height="18">
                        <use xlink:href="`+url_base+`assets/tabler-icons-1.39.1/tabler-sprite.svg#tabler-plus" />
                    </svg> 
                    Tambah
                </button>
            </div>
        `)
    }
})

$(document).on("click", "#addMateri .btnAdd", function(){
    let form = "#addMateri";
    let item = $(form+" input[name='item']").val();

    if(item == "video" || item == "video pembahasan"){
        Swal.fire({
            icon: 'question',
            text: 'Yakin akan menambahkan video baru?',
            showCloseButton: true,
            showCancelButton: true,
            confirmButtonText: 'Ya',
            cancelButtonText: 'Tidak'
        }).then(function (result) {
            if (result.value) {
    
                let id_pertemuan = $(form+" input[name='id_pertemuan']").val()

                let link = $(form+" textarea[name='link']").val();
    
                let eror = required(form);
                
                if( eror == 1){
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: 'lengkapi isi form terlebih dahulu'
                    })
                } else {
                    let data = {id_pertemuan:id_pertemuan, item:item, data:link, penulisan:""};
                    let result = ajax(url_base+"program/add_materi_pertemuan", "POST", data);
                    if(result == 1){
                        Swal.fire({
                            position: 'center',
                            icon: 'success',
                            text: 'Berhasil menambahkan video',
                            showConfirmButton: false,
                            timer: 1500
                        })

                        $("#addMateri").modal("hide");
                        load_item(id)
                    } else {
                        Swal.fire({
                            position: 'center',
                            icon: 'error',
                            text: 'Gagal menambahkan video, silahkan coba refresh page terlebih dahulu',
                            showConfirmButton: false,
                            timer: 1500
                        })
                    }
                }
            }
        })
    } else if(item == "petunjuk"){
        Swal.fire({
            icon: 'question',
            text: 'Yakin akan menambahkan teks baru?',
            showCloseButton: true,
            showCancelButton: true,
            confirmButtonText: 'Ya',
            cancelButtonText: 'Tidak'
        }).then(function (result) {
            if (result.value) {
    
                let id_pertemuan = $(form+" input[name='id_pertemuan']").val();
                let teks = CKEDITOR.instances['form-text'].getData();
                let penulisan = $(form+" select[name='penulisan']").val();
    
                let eror = required(form);
    
                if(teks == "") eror = 1;
                
                if( eror == 1){
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: 'lengkapi isi form terlebih dahulu'
                    })
                } else {
                    let data = {id_pertemuan:id_pertemuan, item:item, data:teks, penulisan:penulisan};
                    let result = ajax(url_base+"program/add_materi_pertemuan", "POST", data);
                    if(result == 1){
                        Swal.fire({
                            position: 'center',
                            icon: 'success',
                            text: 'Berhasil menambahkan teks',
                            showConfirmButton: false,
                            timer: 1500
                        })

                        $("#addMateri").modal("hide");
                        load_item(id)
                    } else {
                        Swal.fire({
                            position: 'center',
                            icon: 'error',
                            text: 'Gagal menambahkan teks, silahkan coba refresh page terlebih dahulu',
                            showConfirmButton: false,
                            timer: 1500
                        })
                    }
                }
                // console.log(id_sub, tipe_soal, item, soal, pilihan_a, pilihan_b, pilihan_c, pilihan_d, jawaban, penulisan);
            }
        })
    } else if(item == "audio"){
        let form = "#addMateri";

        var fd = new FormData();
        var files = $('#file')[0].files;
        
        // Check file selected or not
        if(files.length > 0 ){
            Swal.fire({
                icon: 'question',
                text: 'Yakin akan menambahkan audio baru?',
                showCloseButton: true,
                showCancelButton: true,
                confirmButtonText: 'Ya',
                cancelButtonText: 'Tidak'
            }).then(function (result) {
                if (result.value) {
                    fd.append('file',files[0]);
                    fd.append('id_pertemuan', $(form+" input[name='id_pertemuan']").val());
                    fd.append('penulisan', "");
                    fd.append('item', item);

                    let eror = required(form);
                
                    if( eror == 1){
                        Swal.fire({
                            icon: 'error',
                            title: 'Oops...',
                            text: 'lengkapi isi form terlebih dahulu'
                        })
                    } else {
                        $.ajax({
                            url: url_base+'program/add_materi_pertemuan',
                            type: 'post',
                            data: fd,
                            contentType: false,
                            processData: false,
                            success: function(response){

                                if(response == 1){
                                    
                                    Swal.fire({
                                        position: 'center',
                                        icon: 'success',
                                        text: 'Berhasil mengupload file',
                                        showConfirmButton: false,
                                        timer: 1500
                                    })
                                } else if(response == 2){
                                    Swal.fire({
                                        position: 'center',
                                        icon: 'error',
                                        text: 'Gagal mengupload file. Format file harus mp3',
                                        showConfirmButton: false,
                                        timer: 1500
                                    })
                                } else if(response == 0){
                                    Swal.fire({
                                        position: 'center',
                                        icon: 'error',
                                        text: 'Gagal mengupload file',
                                        showConfirmButton: false,
                                        timer: 1500
                                    })
                                }
                                
                                $("#addMateri").modal("hide");
                                load_item(id)
                            },
                        });
                    }
                }
            })
        }else{
            Swal.fire({
                position: 'center',
                icon: 'error',
                text: 'Pilih file terlebih dahulu',
                showConfirmButton: false,
                timer: 1500
            })
        }
    } else if(item == "gambar"){
        let form = "#addMateri";

        var fd = new FormData();
        var files = $('#file')[0].files;
        
        // Check file selected or not
        if(files.length > 0 ){
            Swal.fire({
                icon: 'question',
                text: 'Yakin akan menambahkan gambar baru?',
                showCloseButton: true,
                showCancelButton: true,
                confirmButtonText: 'Ya',
                cancelButtonText: 'Tidak'
            }).then(function (result) {
                if (result.value) {
                    fd.append('file',files[0]);
                    fd.append('id_pertemuan', $(form+" input[name='id_pertemuan']").val());
                    fd.append('penulisan', "");
                    fd.append('item', item);

                    let eror = required(form);
                
                    if( eror == 1){
                        Swal.fire({
                            icon: 'error',
                            title: 'Oops...',
                            text: 'lengkapi isi form terlebih dahulu'
                        })
                    } else {
                        $.ajax({
                            url: url_base+'program/add_materi_pertemuan',
                            type: 'post',
                            data: fd,
                            contentType: false,
                            processData: false,
                            success: function(response){

                                if(response == 1){
                                    
                                    Swal.fire({
                                        position: 'center',
                                        icon: 'success',
                                        text: 'Berhasil mengupload file',
                                        showConfirmButton: false,
                                        timer: 1500
                                    })
                                } else if(response == 2){
                                    Swal.fire({
                                        position: 'center',
                                        icon: 'error',
                                        text: 'Gagal mengupload file',
                                        showConfirmButton: false,
                                        timer: 1500
                                    })
                                } else if(response == 0){
                                    Swal.fire({
                                        position: 'center',
                                        icon: 'error',
                                        text: 'Gagal mengupload file',
                                        showConfirmButton: false,
                                        timer: 1500
                                    })
                                }
                                
                                $("#addMateri").modal("hide");
                                load_item(id)

                            },
                        });
                    }
                }
            })
        }else{
            Swal.fire({
                position: 'center',
                icon: 'error',
                text: 'Pilih file terlebih dahulu',
                showConfirmButton: false,
                timer: 1500
            })
        }
    }
})

// ketika menghapus item 
$(document).on("click", ".hapusMateri", function(){
    let id_materi = $(this).data("id");

    Swal.fire({
        icon: 'question',
        text: 'Yakin akan menghapus item ini?',
        showCloseButton: true,
        showCancelButton: true,
        confirmButtonText: 'Ya',
        cancelButtonText: 'Tidak'
    }).then(function (result) {
        if (result.value) {
            data = {id_materi: id_materi}
            let result = ajax(url_base+"program/hapus_materi_pertemuan", "POST", data);

            if(result == 1){
                load_item(id);
                // ???
                Swal.fire({
                    position: 'center',
                    icon: 'success',
                    text: 'Berhasil menghapus materi',
                    showConfirmButton: false,
                    timer: 1500
                })
            } else {
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'terjadi kesalahan, gagal menghapus materi'
                })
            }
        }
    })
})

$(document).on("click", ".editMateri", function(){
    let form = "#editMateri";
    
    let id_materi = $(this).data("id");
    let data = {id_materi:id_materi}
    let result = ajax(url_base+"program/get_materi_pertemuan", "POST", data);
    
    $(form+" input[name='id_materi']").val(id_materi);
    $(form+" input[name='item']").val(result.item);

    if(result.item == "petunjuk"){
        if(result.penulisan == "RTL") {
            rtl = "selected";
            ltr = "";
        }
        if(result.penulisan == "LTR") {
            rtl = "";
            ltr = "selected";
        }

        html = `
            <div class="mb-3">
                <textarea name="soal" class='ckeditor' id='form-text-edit'>`+result.data+`</textarea>
            </div>
            <div class="form-floating mb-3">
                <select name="penulisan" class="form-control required">
                    <option value="">Pilih Arah Penulisan</option>
                    <option value="LTR" `+ltr+`>LTR (Left To Right)</option>
                    <option value="RTL" `+rtl+`>RTL (Right To Left)</option>
                </select>
                <label for="">Penulisan</label>
            </div>`;

        $(form+" .modal-body").html(html);
        CKEDITOR.replace('form-text-edit');
    } else if(result.item == "video" || result.item == "video pembahasan"){
        html = `
        <div class="form-floating mb-3">
            <textarea name="link" class="form form-control required" data-bs-toggle="autosize" placeholder="Type something…">`+result.data+`</textarea>
            <label for="" class="col-form-label">Link Video</label>
        </div>
        `
        $(form+" .modal-body").html(html);
    }

    $(form+" .modal-footer").addClass(`d-flex justify-content-end`);
    $(form+" .modal-footer").html(`
        <div>
            <button type="button" class="btn mr-3" data-bs-dismiss="modal">Tutup</button>
            <button type="button" class="btn btn-success btnEdit">
                Edit 
            </button>
        </div>
    `)
})

$(document).on("click", "#editMateri .btnEdit", function(){
    let form = "#editMateri";
    let item = $(form+" input[name='item']").val();

    if(item == "petunjuk"){
        Swal.fire({
            icon: 'question',
            text: 'Yakin akan mengubah teks?',
            showCloseButton: true,
            showCancelButton: true,
            confirmButtonText: 'Ya',
            cancelButtonText: 'Tidak'
        }).then(function (result) {
            if (result.value) {
    
                let id_materi = $(form+" input[name='id_materi']").val();
                let teks = CKEDITOR.instances['form-text-edit'].getData();
                let penulisan = $(form+" select[name='penulisan']").val();
    
                let eror = required(form);
    
                if(teks == "") eror = 1;
                
                if( eror == 1){
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: 'lengkapi isi form terlebih dahulu'
                    })
                } else {
                    let data = {id_materi:id_materi, data:teks, penulisan:penulisan};
                    let result = ajax(url_base+"program/edit_materi_pertemuan", "POST", data);
                    if(result == 1){
                        Swal.fire({
                            position: 'center',
                            icon: 'success',
                            text: 'Berhasil mengubah item',
                            showConfirmButton: false,
                            timer: 1500
                        })

                        $("#addMateri").modal("hide");
                        load_item(id)
                    } else {
                        Swal.fire({
                            position: 'center',
                            icon: 'error',
                            text: 'Gagal mengubah item, silahkan coba refresh page terlebih dahulu',
                            showConfirmButton: false,
                            timer: 1500
                        })
                    }
                }
                // console.log(id_sub, tipe_soal, item, soal, pilihan_a, pilihan_b, pilihan_c, pilihan_d, jawaban, penulisan);
            }
        })
    } else if(item == "video" || item == "video pembahasan"){
        Swal.fire({
            icon: 'question',
            text: 'Yakin akan mengubah link video?',
            showCloseButton: true,
            showCancelButton: true,
            confirmButtonText: 'Ya',
            cancelButtonText: 'Tidak'
        }).then(function (result) {
            if (result.value) {
    
                let id_materi = $(form+" input[name='id_materi']").val()

                let link = $(form+" textarea[name='link']").val();
    
                let eror = required(form);
                
                if( eror == 1){
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: 'lengkapi isi form terlebih dahulu'
                    })
                } else {
                    let data = {id_materi:id_materi, data:link};
                    let result = ajax(url_base+"program/edit_materi_pertemuan", "POST", data);
                    if(result == 1){
                        Swal.fire({
                            position: 'center',
                            icon: 'success',
                            text: 'Berhasil mengubah link video',
                            showConfirmButton: false,
                            timer: 1500
                        })

                        $("#addMateri").modal("hide");
                        load_item(id)
                    } else {
                        Swal.fire({
                            position: 'center',
                            icon: 'error',
                            text: 'Gagal mengubah link video, silahkan coba refresh page terlebih dahulu',
                            showConfirmButton: false,
                            timer: 1500
                        })
                    }
                }
            }
        })
    }
})

$(document).on("click", ".saveUrutan", function(){
    // console.log("cek"
    Swal.fire({
        icon: 'question',
        text: 'Yakin akan mengubah urutan?',
        showCloseButton: true,
        showCancelButton: true,
        confirmButtonText: 'Ya',
        cancelButtonText: 'Tidak'
    }).then(function (result) {
        if (result.value) {
            id_materi = [];
            $("#dataAjax input[name='id_materi']").each(function(){
                id_materi.push($(this).val())
            })

            let data = {id_materi:id_materi};
            let result = ajax(url_base+"program/edit_urutan_materi_pertemuan", "POST", data)
            if(result == 1){
                load_item(id)
                Swal.fire({
                    position: 'center',
                    icon: 'success',
                    text: 'Berhasil merubah urutan',
                    showConfirmButton: false,
                    timer: 1500
                })
                $("#saveButton").addClass("text-dark");
            }
        }
    })
})
