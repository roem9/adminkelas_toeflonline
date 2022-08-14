$("#addMember .btnTambah").click(function(){
    Swal.fire({
        icon: 'question',
        text: 'Yakin akan menambahkan member baru?',
        showCloseButton: true,
        showCancelButton: true,
        confirmButtonText: 'Ya',
        cancelButtonText: 'Tidak'
    }).then(function (result) {
        if (result.value) {

            let form = "#addMember";
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
                let result = ajax(url_base+"member/add_member", "POST", formData);

                if(result == 1){
                    loadData();
                    $("#formAddMember").trigger("reset");
                    $(form).modal("hide");

                    Swal.fire({
                        position: 'center',
                        icon: 'success',
                        text: 'Berhasil menambahkan data member',
                        showConfirmButton: false,
                        timer: 1500
                    })
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: 'terjadi kesalahan, silahkan mulai ulang halaman'
                    })
                }
            }
        }
    })
})

$(document).on("click",".detailMember", function(){
    let form = "#detailMember";
    let id_member = $(this).data("id");

    let data = {id_member: id_member};
    let result = ajax(url_base+"member/get_member", "POST", data);
    
    $(form+" .modal-title").html(result.nama);

    $.each(result, function(key, value){
        $(form+" [name='"+key+"']").val(value)
    })

    detail_kelas(result.id_member)
})

// menyimpan hasil edit data
$("#tabs-profil .btnEdit").click(function(){
    Swal.fire({
        icon: 'question',
        text: 'Yakin akan mengubah data member?',
        showCloseButton: true,
        showCancelButton: true,
        confirmButtonText: 'Ya',
        cancelButtonText: 'Tidak'
    }).then(function (result) {
        if (result.value) {
            let form = "#tabs-profil";
            
            let formData = {};
            $(form+" .form").each(function(){
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
                let result = ajax(url_base+"member/edit_member", "POST", formData);

                if(result == 1){
                    loadData();

                    Swal.fire({
                        position: 'center',
                        icon: 'success',
                        text: 'Berhasil mengubah data member',
                        showConfirmButton: false,
                        timer: 1500
                    })

                    $("#detailMember .modal-title").html(formData.nama);
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: 'terjadi kesalahan, silahkan mulai ulang halaman'
                    })
                }
            }
        }
    })
})

function detail_kelas(id_member){
    let data = {id_member: id_member};
    let result = ajax(url_base+"member/get_kelas_member", "POST", data);

    if(result.kelas){
        let html = "";
        result.kelas.forEach((user, i) => {
            if(user.detail.status == "aktif") btnDelete = `<a href="javascript:void(0)" id="delete_kelas" data-id="`+user.id+`|`+user.detail.nama_kelas+`|`+user.id_member+`" class="btn btn-sm btn-danger ms-3">`+icon("trash")+`</a>`
            else btnDelete = ''

            html += `<li class="list-group-item d-flex justify-content-between">
                <span>
                    `+user.detail.nama_kelas+`<br>
                </span>
                <span>
                    <div class="d-flex justify-content-start">
                        <a href="`+url_member+`/kelas/sertifikat/`+user.link+`" target="_blank" class="btn btn-sm btn-warning">`+icon("award", "", 20)+`</a>
                        `+btnDelete+`
                    </div>
                </span>
            </li>`;
        });
        $("#list-kelas").html(html);
        $("#btnHapus").show();
    } else {
        $("#list-kelas").html(`
            <div class="alert alert-important alert-warning alert-dismissible" role="alert">
                <div class="d-flex">
                    <div>
                        `+icon("alert-circle", "me-2", 20)+`
                    </div>
                    <div>
                        Kelas Kosong
                    </div>
                </div>
            </div>`);
        $("#btnHapus").hide();
    }
}


$("#list-kelas").on("click", "#delete_kelas", function(){
    let data = $(this).data("id");
    data = data.split("|");
    id = data[0];
    kelas = data[1];
    id_member = data[2];

    Swal.fire({
        icon: 'question',
        text: 'Yakin akan mengeluarkan member dari kelas '+kelas+'?',
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
                    text: 'Berhasil mengeluarkan member',
                    showConfirmButton: false,
                    timer: 1500
                })
                detail_kelas(id_member);

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

$("#list-wl").on("click", "#delete_wl", function(){
    let data = $(this).data("id");
    data = data.split("|");
    id = data[0];
    program = data[1];
    id_member = data[2];

    Swal.fire({
        icon: 'question',
        text: 'Yakin akan menghapus waiting list '+program+'?',
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
                detail_kelas(id_member);

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

$("#tabs-add-kelas .btnAddKelas").click(function(){
    Swal.fire({
        icon: 'question',
        text: 'Yakin akan menambahkan kelas/wl baru?',
        showCloseButton: true,
        showCancelButton: true,
        confirmButtonText: 'Ya',
        cancelButtonText: 'Tidak'
    }).then(function (result) {
        if (result.value) {

            let form = "#tabs-add-kelas";
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
                let result = ajax(url_base+"member/add_kelas_member", "POST", formData);

                if(result == 1){
                    loadData();
                    $("[name='program']").val("");
                    $("[name='id_kelas']").val("");
                    $("[name='biaya']").val("");
                    $("[name='tgl_closing']").val("");
                    $("[name='sumber']").val("");
                    $("[name='sumber_closing']").val("");
                    let id_member = $(form + " [name='id_member']").val();

                    detail_kelas(id_member);

                    Swal.fire({
                        position: 'center',
                        icon: 'success',
                        text: 'Berhasil menambahkan kelas/wl baru',
                        showConfirmButton: false,
                        timer: 1500
                    })
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: 'terjadi kesalahan, silahkan mulai ulang halaman'
                    })
                }
            }
        }
    })
})

$(document).on("click", ".konfirmasiMember", function(){
    let data = $(this).data("id");
    data = data.split("|");
    id_member = data[0];
    nama = data[1];

    Swal.fire({
        icon: 'question',
        text: 'Yakin akan mengkonfirmasi '+nama+'?',
        showCloseButton: true,
        showCancelButton: true,
        confirmButtonText: 'Ya',
        cancelButtonText: 'Tidak'
    }).then(function (result) {
        if (result.value) {
            let result = ajax(url_base+"member/konfirmasi_member", "POST", {id_member: id_member});

            if(result == 1){
                loadData();

                Swal.fire({
                    position: 'center',
                    icon: 'success',
                    text: 'Berhasil mengkonfirmasi member',
                    showConfirmButton: false,
                    timer: 1500
                })

            } else if(result == 0) {
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'terjadi kesalahan, silahkan mulai ulang halaman'
                })
            } else if(result == 2){
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'tambahkan wl atau kelas untuk member terlebih dahulu'
                })
            }
        }
    })
})

$(document).on("click", ".deleteMember", function(){
    let data = $(this).data("id");
    data = data.split("|");
    id_member = data[0];
    nama = data[1];

    Swal.fire({
        icon: 'question',
        text: 'Yakin akan menghapus '+nama+'?',
        showCloseButton: true,
        showCancelButton: true,
        confirmButtonText: 'Ya',
        cancelButtonText: 'Tidak'
    }).then(function (result) {
        if (result.value) {
            let result = ajax(url_base+"member/hapus_member", "POST", {id_member: id_member});

            if(result == 1){
                loadData();

                Swal.fire({
                    position: 'center',
                    icon: 'success',
                    text: 'Berhasil menghapus member',
                    showConfirmButton: false,
                    timer: 1500
                })

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

$(document).on("click", ".detailClosing", function(){
    let id = $(this).data("id");

    detail_closing(id);
})

function detail_closing(id){
    let result = ajax(url_base+"member/get_sumber_closing", "POST");
    html = `<option value="">Pilih Sumber Closing</option>`;
    result.forEach((sumber, i) => {
        html += `<option value="`+sumber.sumber+`">`+sumber.sumber+`</option>`;
    });
    html += `<option value="Lainnya">Lainnya</option>`;
    $("[name='sumber']").html(html);
    
    let form = "#detailClosing";
    
    result = ajax(url_base+"member/get_detail_closing", "POST", {id: id});
    $.each(result, function(key, value){
        if(key == "biaya"){
            $(form+" [name='"+key+"']").val(formatRupiah(value, ""))
        } else {
            $(form+" [name='"+key+"']").val(value)
        }
    })
    
    $(form+" [name='sumber_lainnya']").val("");
    $(form+" [name='sumber_lainnya']").prop('readonly', true);
    $(form+" [name='sumber_lainnya']").removeClass('required');
}

$(document).on("click", "#detailClosing .btnEdit", function(){
    form = "#detailClosing";

    let eror = required(form);

    if( eror == 1){
        Swal.fire({
            icon: 'error',
            title: 'Oops...',
            text: 'lengkapi isi form terlebih dahulu'
        })
    } else {
        Swal.fire({
            icon: 'question',
            text: 'Yakin akan mengubah data closing?',
            showCloseButton: true,
            showCancelButton: true,
            confirmButtonText: 'Ya',
            cancelButtonText: 'Tidak'
        }).then(function (result) {
            if (result.value) {
                let id = $(form+" [name='id']").val();
                let biaya = $(form+" [name='biaya']").val();
                let sumber = $(form+" [name='sumber']").val();
                let sumber_lainnya = $(form+" [name='sumber_lainnya']").val();
                
                result = ajax(url_base+"member/edit_closing", "POST", {id: id, biaya: biaya, sumber: sumber, sumber_lainnya: sumber_lainnya});
                
                if(result == 1){
                    Swal.fire({
                        position: 'center',
                        icon: 'success',
                        text: 'Berhasil mengubah data closing',
                        showConfirmButton: false,
                        timer: 1500
                    })
                    
                    detail_closing(id);
                    loadData();
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: 'Data Closing tidak berubah'
                    })
                }
            }
        })
    }
})