$("#addPertemuan .btnTambah").click(function(){
    let form = "#addPertemuan";
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
        Swal.fire({
            icon: 'question',
            text: 'Yakin akan menambahkan pertemuan baru?',
            showCloseButton: true,
            showCancelButton: true,
            confirmButtonText: 'Ya',
            cancelButtonText: 'Tidak'
        }).then(function (result) {
            if (result.value) {
                let result = ajax(url_base+"program/add_pertemuan", "POST", formData);
    
                if(result == 1){
                    loadData();
                    $("#formAddPertemuan").trigger("reset");
                    $(form).modal("hide");
    
                    Swal.fire({
                        position: 'center',
                        icon: 'success',
                        text: 'Berhasil menambahkan data pertemuan',
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
    }
})

$(document).on("click",".detailPertemuan", function(){
    let form = "#detailPertemuan";
    let id_pertemuan = $(this).data("id");

    let data = {id_pertemuan: id_pertemuan};
    let result = ajax(url_base+"program/get_pertemuan", "POST", data);

    // console.log(result)
    
    if(result.latihan == "Koreksi Otomatis"){
        $("[name='poin']").addClass("required");
        $("[name='poin']").val(0);
        $(".poin").show();
        
        $("[name='text_soal_indo']").removeClass("required");
        $("[name='text_soal_indo']").val("");
        $(".text_soal_indo").hide();

        $("[name='text_soal_asing']").removeClass("required");
        $("[name='text_soal_asing']").val("");
        $(".text_soal_asing").hide();

        $("[name='jumlah_soal']").removeClass("required");
        $("[name='jumlah_soal']").val("");
        $(".jumlah_soal").hide();

        $("[name='pembahasan']").addClass("required");
        $("[name='pembahasan']").val("");
        $(".pembahasan").show();
    } else if(result.latihan == "Latihan Kosa Kata"){
        $("[name='poin']").removeClass("required");
        $("[name='poin']").val("");
        $(".poin").hide();

        $("[name='text_soal_indo']").addClass("required");
        $("[name='text_soal_indo']").val("");
        $(".text_soal_indo").show();

        $("[name='text_soal_asing']").addClass("required");
        $("[name='text_soal_asing']").val("");
        $(".text_soal_asing").show();

        $("[name='jumlah_soal']").addClass("required");
        $("[name='jumlah_soal']").val("");
        $(".jumlah_soal").show();

        $("[name='pembahasan']").addClass("required");
        $("[name='pembahasan']").val("");
        $(".pembahasan").show();
    } else if(result.latihan == "Koreksi Manual" || result.latihan == "" || result.latihan == "Tidak Ada Latihan" || result.latihan == "Input Manual"){
        $("[name='poin']").removeClass("required");
        $("[name='poin']").val("");
        $(".poin").hide();
        
        $("[name='text_soal_indo']").removeClass("required");
        $("[name='text_soal_indo']").val("");
        $(".text_soal_indo").hide();

        $("[name='text_soal_asing']").removeClass("required");
        $("[name='text_soal_asing']").val("");
        $(".text_soal_asing").hide();

        $("[name='jumlah_soal']").removeClass("required");
        $("[name='jumlah_soal']").val("");
        $(".jumlah_soal").hide();

        $("[name='pembahasan']").removeClass("required");
        $("[name='pembahasan']").val("");
        $(".pembahasan").hide();
    } else {
        $("[name='poin']").removeClass("required");
        $("[name='poin']").val("");
        $(".poin").hide();
        
        $("[name='text_soal_indo']").removeClass("required");
        $("[name='text_soal_indo']").val("");
        $(".text_soal_indo").hide();

        $("[name='text_soal_asing']").removeClass("required");
        $("[name='text_soal_asing']").val("");
        $(".text_soal_asing").hide();

        $("[name='jumlah_soal']").removeClass("required");
        $("[name='jumlah_soal']").val("");
        $(".jumlah_soal").hide();

        $("[name='pembahasan']").removeClass("required");
        $("[name='pembahasan']").val("");
        $(".pembahasan").hide();
    }

    $.each(result, function(key, value){
        $(form+" [name='"+key+"']").val(value)
    })

})

// menyimpan hasil edit data
$("#detailPertemuan .btnEdit").click(function(){
    Swal.fire({
        icon: 'question',
        text: 'Yakin akan mengubah data pertemuan?',
        showCloseButton: true,
        showCancelButton: true,
        confirmButtonText: 'Ya',
        cancelButtonText: 'Tidak'
    }).then(function (result) {
        if (result.value) {
            let form = "#detailPertemuan";
            
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
                let result = ajax(url_base+"program/edit_pertemuan", "POST", formData);

                if(result == 1){
                    loadData();

                    Swal.fire({
                        position: 'center',
                        icon: 'success',
                        text: 'Berhasil mengubah data pertemuan',
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


$(".btnTambahPertemuan").click(function(){
    $("[name='poin']").removeClass("required");
    $("[name='poin']").val("");
    $(".poin").hide();
    
    $("[name='text_soal_indo']").removeClass("required");
    $("[name='text_soal_indo']").val("");
    $(".text_soal_indo").hide();

    $("[name='text_soal_asing']").removeClass("required");
    $("[name='text_soal_asing']").val("");
    $(".text_soal_asing").hide();

    $("[name='jumlah_soal']").removeClass("required");
    $("[name='jumlah_soal']").val("");
    $(".jumlah_soal").hide();

    $("[name='pembahasan']").removeClass("required");
    $("[name='pembahasan']").val("");
    $(".pembahasan").hide();
})

$("[name='latihan']").change(function(){
    let value = $(this).val();

    // console.log(value)
    
    if(value == "Koreksi Otomatis"){
        $("[name='poin']").addClass("required");
        $("[name='poin']").val(0);
        $(".poin").show();
        
        $("[name='text_soal_indo']").removeClass("required");
        $("[name='text_soal_indo']").val("");
        $(".text_soal_indo").hide();

        $("[name='text_soal_asing']").removeClass("required");
        $("[name='text_soal_asing']").val("");
        $(".text_soal_asing").hide();

        $("[name='jumlah_soal']").removeClass("required");
        $("[name='jumlah_soal']").val("");
        $(".jumlah_soal").hide();

        $("[name='pembahasan']").addClass("required");
        $("[name='pembahasan']").val("");
        $(".pembahasan").show();
    } else if(value == "Latihan Kosa Kata"){
        $("[name='poin']").removeClass("required");
        $("[name='poin']").val("");
        $(".poin").hide();

        $("[name='text_soal_indo']").addClass("required");
        $("[name='text_soal_indo']").val("");
        $(".text_soal_indo").show();

        $("[name='text_soal_asing']").addClass("required");
        $("[name='text_soal_asing']").val("");
        $(".text_soal_asing").show();

        $("[name='jumlah_soal']").addClass("required");
        $("[name='jumlah_soal']").val("");
        $(".jumlah_soal").show();

        $("[name='pembahasan']").addClass("required");
        $("[name='pembahasan']").val("");
        $(".pembahasan").show();
    } else if(value == "Koreksi Manual" || value == "" || value == "Tidak Ada Latihan" || value == "Input Manual"){
        $("[name='poin']").removeClass("required");
        $("[name='poin']").val("");
        $(".poin").hide();
        
        $("[name='text_soal_indo']").removeClass("required");
        $("[name='text_soal_indo']").val("");
        $(".text_soal_indo").hide();

        $("[name='text_soal_asing']").removeClass("required");
        $("[name='text_soal_asing']").val("");
        $(".text_soal_asing").hide();

        $("[name='jumlah_soal']").removeClass("required");
        $("[name='jumlah_soal']").val("");
        $(".jumlah_soal").hide();

        $("[name='pembahasan']").removeClass("required");
        $("[name='pembahasan']").val("");
        $(".pembahasan").hide();
    }
})

// $("[]")