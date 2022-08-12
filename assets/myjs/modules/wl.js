// ketika menekan tombol simpan pada modal tambah kelas 
$(document).on("click", ".deleteWl", function(){
    let data = $(this).data("id");
    data = data.split("|");

    let id = data[0];
    let nama = data[1];
    let program = data[2];

    Swal.fire({
        icon: 'question',
        text: 'Yakin akan menghapus waiting list '+nama+' program '+program+'?',
        showCloseButton: true,
        showCancelButton: true,
        confirmButtonText: 'Ya',
        cancelButtonText: 'Tidak'
    }).then(function (result) {
        if (result.value) {
            // data = {nama_kelas: nama_kelas, tgl_pembuatan: tgl_pembuatan, catatan: catatan}
            let result = ajax(url_base+"kelas/delete_wl", "POST", {id:id});

            if(result == 1){
                loadData();
                Swal.fire({
                    position: 'center',
                    icon: 'success',
                    text: 'Berhasil menghapus waiting list',
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
    })
})

// ketika menekan tombol edit kelas 
$(document).on("click",".inputKelas", function(){
    let form = "#inputKelas";
    let id = $(this).data("id");
    let data = {id: id};
    let result = ajax(url_base+"kelas/get_wl", "POST", data);

    $.each(result, function(key, value){
        $(form+" [name='"+key+"']").val(value);
    })

    listKelas(result.program);
})

$("#inputKelas .btnTambah").click(function(){
    Swal.fire({
        icon: 'question',
        text: 'Yakin akan memasukkan peserta ke kelas?',
        showCloseButton: true,
        showCancelButton: true,
        confirmButtonText: 'Ya',
        cancelButtonText: 'Tidak'
    }).then(function (result) {
        if (result.value) {
            let form = "#inputKelas";
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
                let result = ajax(url_base+"kelas/input_kelas", "POST", formData);

                if(result == 1){
                    loadData();
                    $(form).modal("hide");

                    Swal.fire({
                        position: 'center',
                        icon: 'success',
                        text: 'Berhasil memasukkan peserta ke kelas',
                        showConfirmButton: false,
                        timer: 1500
                    })
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: 'terjadi kesalahan, silakan refresh ulang halaman'
                    })
                }
            }
        }
    })
})

function listKelas(program){
    let result = ajax(url_base+"kelas/list_kelas", "POST", {program:program});

    let option = `<option value="">Pilih Kelas</option>`;
    $.each(result, function(i){
        option += `<option value="`+result[i].id_kelas+`">[`+result[i].peserta+`] `+result[i].nama_kelas+`</option>`
    })

    $("[name='id_kelas']").html(option);
}