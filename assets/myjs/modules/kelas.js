
// ketika menekan tombol simpan pada modal tambah kelas 
$("#addKelas .btnTambah").click(function(){
    Swal.fire({
        icon: 'question',
        text: 'Yakin akan menambahkan kelas baru?',
        showCloseButton: true,
        showCancelButton: true,
        confirmButtonText: 'Ya',
        cancelButtonText: 'Tidak'
    }).then(function (result) {
        if (result.value) {
            let form = "#addKelas";
            let formData = {};
            $(form+" .form").each(function(index){
                formData = Object.assign(formData, {[$(this).attr("name")]: $(this).val()})
            })

            let eror = required(form);

            if( eror == 1){
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'lengkapi isi form terlebih dahulu'
                })
            } else {
                // data = {nama_kelas: nama_kelas, tgl_pembuatan: tgl_pembuatan, catatan: catatan}
                let result = ajax(url_base+"kelas/add_kelas", "POST", formData);

                if(result == 1){
                    loadData();
                    $("#formAddKelas").trigger("reset");
                    $(form).modal("hide");

                    Swal.fire({
                        position: 'center',
                        icon: 'success',
                        text: 'Berhasil menambahkan data kelas',
                        showConfirmButton: false,
                        timer: 1500
                    })
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: 'terjadi kesalahan, ulangi input kelas'
                    })
                }
            }
        }
    })
})

// ketika menekan tombol edit kelas 
$(document).on("click",".detailKelas", function(){
    let form = "#detailKelas";
    let id_kelas = $(this).data("id");
    let data = {id_kelas: id_kelas};
    let result = ajax(url_base+"kelas/get_kelas", "POST", data);

    $.each(result, function(key, value){
        $(form+" [name='"+key+"']").val(value);
    })

    $(form+" .modal-title").html(result.nama_kelas)

    peserta_kelas(result.id_kelas);
})

// ketika menyimpan hasil edit kelas 
$("#detailKelas .btnEdit").click(function(){
    Swal.fire({
        icon: 'question',
        text: 'Yakin akan mengubah data kelas?',
        showCloseButton: true,
        showCancelButton: true,
        confirmButtonText: 'Ya',
        cancelButtonText: 'Tidak'
    }).then(function (result) {
        if (result.value) {
            let form = "#detailKelas";

            let formData = {};
            $(form+" .form").each(function(index){
                formData = Object.assign(formData, {[$(this).attr("name")]: $(this).val()})
            })

            let eror = required(form);

            if( eror == 1){
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'lengkapi isi form terlebih dahulu'
                })
            } else {
                let result = ajax(url_base+"kelas/edit_kelas", "POST", formData);

                if(result == 1){
                    loadData();

                    peserta_kelas(formData.id_kelas);

                    Swal.fire({
                        position: 'center',
                        icon: 'success',
                        text: 'Berhasil mengubah data kelas',
                        showConfirmButton: false,
                        timer: 1500
                    })

                    $(form+" .modal-title").html(formData.nama_kelas)
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: 'terjadi kesalahan'
                    })
                }
            }
        }
    })
})

$("#list-peserta").on("click", "#btnSaveNilai", function(){
    let id = $(this).data("id");
    let nilai = $("#nilai"+id).val();
    
    data = {id:id, nilai:nilai};

    let result = ajax(url_base+"member/edit_nilai_sertifikat", "POST", data);

    if(result == 1){
        $("#msg-"+id).html(`<small class="form-text text-success msg-nilai">berhasil menginputkan nilai</small>`)
    } else {
        $("#msg-"+id).html(`<small class="form-text text-success msg-nilai">gagal menginputkan nilai</small>`)
    }
})

$("#list-peserta").on("click", "#remove_peserta", function(){
    let data = $(this).data("id");
    data = data.split("|");
    id = data[0];
    nama = data[1];
    id_member = data[2];
    kelas = $("#nama_kelas").val();
    id_kelas = $("#id_kelas").val();
    program = $("#program").val();

    Swal.fire({
        icon: 'question',
        text: 'Yakin akan mengeluarkan '+nama+' dari kelas '+kelas+'?',
        showCloseButton: true,
        showCancelButton: true,
        confirmButtonText: 'Ya',
        cancelButtonText: 'Tidak'
    }).then(function (result) {
        if (result.value) {
            let result = ajax(url_base+"kelas/remove_peserta", "POST", {id: id});

            if(result == 1){
                loadData();

                Swal.fire({
                    position: 'center',
                    icon: 'success',
                    text: 'Berhasil mengeluarkan member',
                    showConfirmButton: false,
                    timer: 1500
                })

                peserta_kelas(id_kelas);

            } else {
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'terjadi kesalahan, silahkan mulai ulang halaman'
                })
            }
        }
    })
})

$("#list-wl").on("click", "#remove_wl", function(){
    let data = $(this).data("id");
    data = data.split("|");
    id = data[0];
    nama = data[1];
    id_member = data[2];
    kelas = $("#nama_kelas").val();
    id_kelas = $("#id_kelas").val();
    program = $("#program").val();

    Swal.fire({
        icon: 'question',
        text: 'Yakin akan menghapus '+nama+' dari waiting list program '+program+'?',
        showCloseButton: true,
        showCancelButton: true,
        confirmButtonText: 'Ya',
        cancelButtonText: 'Tidak'
    }).then(function (result) {
        if (result.value) {
            let result = ajax(url_base+"member/delete_wl", "POST", {id: id});

            if(result == 1){
                loadData();

                Swal.fire({
                    position: 'center',
                    icon: 'success',
                    text: 'Berhasil menghapus waiting list',
                    showConfirmButton: false,
                    timer: 1500
                })

                peserta_kelas(id_kelas);

            } else {
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'terjadi kesalahan, silahkan mulai ulang halaman'
                })
            }
        }
    })
})

$("#list-wl").on("click", "#input_kelas", function(){
    let data = $(this).data("id");
    data = data.split("|");
    id = data[0];
    nama = data[1];
    id_member = data[2];
    kelas = $("#nama_kelas").val();
    id_kelas = $("#id_kelas").val();
    program = $("#program").val();

    Swal.fire({
        icon: 'question',
        text: 'Yakin akan memasukkan '+nama+' ke kelas '+kelas+'?',
        showCloseButton: true,
        showCancelButton: true,
        confirmButtonText: 'Ya',
        cancelButtonText: 'Tidak'
    }).then(function (result) {
        if (result.value) {
            let result = ajax(url_base+"kelas/input_kelas", "POST", {id: id, id_kelas: id_kelas});

            if(result == 1){
                loadData();

                Swal.fire({
                    position: 'center',
                    icon: 'success',
                    text: 'Berhasil menambahkan member kelas',
                    showConfirmButton: false,
                    timer: 1500
                })

                peserta_kelas(id_kelas);

            } else {
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'terjadi kesalahan, silahkan mulai ulang halaman'
                })
            }
        }
    })
})

function peserta_kelas(id_kelas){
    let result = ajax(url_base+"kelas/get_peserta_kelas", "POST", {id_kelas:id_kelas});

    if(result.length > 0){
        let html = "";
        result.forEach((user, i) => {
            btnDelete = `<a href="javascript:void(0)" id="remove_peserta" data-id="`+user.id+`|`+user.nama+`|`+user.id_member+`" class="btn btn-sm ms-3 btn-danger">`+icon("trash")+`</a>`

            html += `<li class="list-group-item d-flex justify-content-between">
                        <span>
                            `+user.nama+`<br>
                        </span>
                        <span>
                            <div class="d-flex justify-content-start">
                                <a href="`+url_member+`/kelas/sertifikat/`+user.link+`" target="_blank" class="btn btn-sm btn-warning">`+icon("award", "", 20)+`</a>
                                `+btnDelete+`
                            </div>
                        </span>
                    </li>`;
        });
        $("#list-peserta").html(html);
        $("#btnHapus").show();
    } else {
        $("#list-peserta").html(`
            <div class="alert alert-important alert-warning alert-dismissible" role="alert">
                <div class="d-flex">
                    <div>
                        `+icon("alert-circle", "me-2", 20)+`
                    </div>
                    <div>
                        Peserta Kosong
                    </div>
                </div>
            </div>`);
        $("#btnHapus").hide();
    }
}