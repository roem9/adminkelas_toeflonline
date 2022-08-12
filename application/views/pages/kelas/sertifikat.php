<!DOCTYPE html>
<html lang="en"><head><meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <style>
        * {
            margin: 0;
            padding: 0;
        }

        @page :first {
            background-image: url("<?= base_url()?>assets/img/sertifikat.jpg");
            background-image-resize: 6;
        }

        .name {
            width: 500px;
            /* background-color: red; */
			position: absolute;
            left: 145px;
			top: 220px;
            font-size: 35px;
            word-spacing: 3px;
        }

        .narasi {
            width: 500px;
            /* background-color: red; */
			position: absolute;
            left: 145px;
			top: 280px;
            font-size: 12px;
            font-family: arial;
            word-spacing: 3px;
        }

        .qrcode{
            width: 210px;
			position: absolute;
            right: 20px;
			bottom: 97px;
            font-size: 35px;
            word-spacing: 3px;
        }
    </style>
</head>
<body>
    <div class="name" style="text-align: center">
        <b><?= $nama?></b>
    </div>
    <div class="qrcode">
        <img src="<?= base_url()?>assets/qrcode/<?= $id?>.png" width=90 alt="">
    </div>
    <div class="narasi" style="text-align: center">
        <span>Telah mengikuti dan menyelesaikan kursus program "<?= $program?>" di Lembaga Bahasa Indonesia dan mendapatkan nilai</span><br>
        <span style="font-size: 40px"><b><?= $nilai?></b></span>
    </div>
</body>
</html>