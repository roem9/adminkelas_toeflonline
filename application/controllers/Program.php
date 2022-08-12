<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Program extends MY_Controller {

    public function index(){
        $data['title'] = 'List Program';
        $data['menu'] = "Program";
        $data['modal'] = ["modal_program"];
        $data['js'] = [
            "ajax.js",
            "function.js",
            "helper.js",
            "load_data/program_reload.js",
            "modules/program.js",
        ];

        $this->load->view("pages/program/list", $data);
    }

    public function detail($id_program){
        $program = $this->program->get_one("program", ['md5(id_program)' => $id_program]);
        $data['id_program'] = $program['id_program'];

        $data['title'] = 'List Pertemuan ' . $program['nama_program'];
        $data['menu'] = "Program";
        $data['modal'] = ["modal_pertemuan"];
        $data['js'] = [
            "ajax.js",
            "function.js",
            "helper.js",
            "load_data/pertemuan_reload.js",
            "modules/pertemuan.js",
        ];

        $this->load->view("pages/pertemuan/list", $data);
    }

    public function detailPertemuan($id_pertemuan){
        $pertemuan = $this->program->get_one("pertemuan", ['md5(id_pertemuan)' => $id_pertemuan]);
        $program = $this->program->get_one("program", ['id_program' => $pertemuan['id_program']]);
        $data['id_program'] = $program['id_program'];
        $data['id_pertemuan'] = $pertemuan['id_pertemuan'];

        $data['title'] = 'List Materi ' . $pertemuan['nama_pertemuan'] . ' (' . $program['nama_program'] . ')';
        $data['menu'] = "Materi";
        $data['modal'] = ["modal_materi"];
        $data['js'] = [
            "ajax.js",
            "function.js",
            "helper.js",
            "load_data/materi_reload.js",
            "modules/materi.js",
        ];

        $this->load->view("pages/pertemuan/list_materi", $data);
    }

    public function detailLatihan($id_pertemuan){
        $pertemuan = $this->program->get_one("pertemuan", ['md5(id_pertemuan)' => $id_pertemuan]);
        $program = $this->program->get_one("program", ['id_program' => $pertemuan['id_program']]);
        $data['id_program'] = $program['id_program'];
        $data['id_pertemuan'] = $pertemuan['id_pertemuan'];
        $data['latihan'] = $pertemuan['latihan'];

        $data['title'] = 'List Soal Latihan ' . $pertemuan['nama_pertemuan'] . ' (' . $program['nama_program'] . ')';
        $data['menu'] = "Latihan";
        $data['modal'] = ["modal_latihan"];
        $data['js'] = [
            "ajax.js",
            "function.js",
            "helper.js",
            "load_data/latihan_reload.js",
            "modules/latihan.js",
        ];

        $this->load->view("pages/pertemuan/list_latihan", $data);
    }

    public function add_program(){
        $data = $this->program->add_program();
        echo json_encode($data);
    }

    public function get_program(){
        $data = $this->program->get_program();
        echo json_encode($data);
    }

    public function get_all_program(){
        $data = $this->program->get_all_program();
        echo json_encode($data);
    }

    public function edit_program(){
        $data = $this->program->edit_program();
        echo json_encode($data);
    }

    public function load_program(){
        header('Content-Type: application/json');
        $output = $this->program->load_program();
        echo $output;
    }

    public function add_pertemuan(){
        $data = $this->program->add_pertemuan();
        echo json_encode($data);
    }

    public function get_pertemuan(){
        $data = $this->program->get_pertemuan();
        echo json_encode($data);
    }

    public function edit_pertemuan(){
        $data = $this->program->edit_pertemuan();
        echo json_encode($data);
    }

    public function load_pertemuan(){
        header('Content-Type: application/json');
        $output = $this->program->load_pertemuan();
        echo $output;
    }

    // materi pertemuan
    public function add_materi_pertemuan(){
        $id_pertemuan = $this->input->post("id_pertemuan");
        $item = $this->program->get_one("materi_pertemuan", ["id_pertemuan" => $id_pertemuan], "urutan", "DESC");
        if($item) {
            $urutan = $item['urutan'] + 1;
        } else {
            $urutan = 1;
        }

        if($_POST['item'] == "gambar" || $_POST['item'] == "audio"){
            $data = [
                "id_pertemuan" => $id_pertemuan,
                "item" => $this->input->post("item"),
                "data" => "media",
                "penulisan" => $this->input->post("penulisan"),
                "urutan" => $urutan,
            ];

            $query = $this->program->add_data("materi_pertemuan", $data);

            $data = $this->upload_media($query, $_FILES, "materi");

            echo json_encode($data);
        } else {
            $data = [
                "id_pertemuan" => $id_pertemuan,
                "item" => $this->input->post("item"),
                "data" => $this->input->post("data"),
                "penulisan" => $this->input->post("penulisan"),
                "urutan" => $urutan,
            ];

            $query = $this->program->add_data("materi_pertemuan", $data);
            if($query){
                echo json_encode(1);
            } else {
                echo json_encode(0);
            }
        }

    }

    public function get_materi_pertemuan(){
        $data = $this->program->get_materi_pertemuan();
        echo json_encode($data);
    }

    public function edit_materi_pertemuan(){
        $data = $this->program->edit_materi_pertemuan();
        echo json_encode($data);
    }

    public function edit_urutan_materi_pertemuan(){
        $data = $this->program->edit_urutan_materi_pertemuan();
        echo json_encode($data);
    }

    public function get_all_materi_pertemuan(){
        $id_pertemuan = $this->input->post("id_pertemuan");

        $materi = $this->program->get_all("materi_pertemuan", ["id_pertemuan" => $id_pertemuan], "urutan", "ASC");
        $data['item'] = [];

        $j = 1;
        foreach ($materi as $i => $materi) {
            $data['item'][$i] = $materi;
        }

        echo json_encode($data);
    }

    public function hapus_materi_pertemuan(){
        $id_materi = $this->input->post("id_materi");

        $item = $this->program->get_one("materi_pertemuan", ["id_materi" => $id_materi]);

        if($item['item'] == "gambar" || $item['item'] == "audio"){
            unlink('./assets/media/'.$item['data']);
        }

        $id_pertemuan = $item['id_pertemuan'];
        $urutan = $item['urutan'];

        $all_item = $this->program->get_all("materi_pertemuan", ["id_pertemuan" => $id_pertemuan, "urutan > ", $urutan]);
        foreach ($all_item as $item) {
            $urutan = $item['urutan'] - 1;
            $this->program->edit_data("materi_pertemuan", ["id_materi" => $item['id_materi']], ["urutan" => $urutan]);
        }

        $data = $this->program->delete_data("materi_pertemuan", ["id_materi" => $id_materi]);
        if($data){
            echo json_encode("1");
        } else {
            echo json_encode("0");
        }
    }
    // materi pertemuan

    //latihan pertemuan
    public function get_all_latihan_pertemuan(){
        $id_pertemuan = $this->input->post("id_pertemuan");

        $item = $this->program->get_all("latihan_pertemuan", ["id_pertemuan" => $id_pertemuan], "urutan", "ASC");
        $data['item'] = [];

        $j = 1;
        foreach ($item as $i => $soal) {
            if($soal['item'] == "soal"){

                $string = trim(preg_replace('/\s+/', ' ', $soal['data']));
                $txt_soal = json_decode($string, true );

                if($soal['penulisan'] == "RTL"){
                    $no = $this->program->angka_arab($j).". ";
                    $tes['soal'] = str_replace("{no}", $no, $txt_soal['soal']);
                } else {
                    $no = $j.". ";
                    $tes['soal'] = str_replace("{no}", $no, $txt_soal['soal']);
                }

                $data['item'][$i]['id_item'] = $soal['id_item'];
                $data['item'][$i]['item'] = $soal['item'];
                $data['item'][$i]['data']['soal'] = $tes['soal'];
                $data['item'][$i]['data']['pilihan'] = $txt_soal['pilihan'];
                $data['item'][$i]['data']['jawaban'] = $txt_soal['jawaban'];
                $data['item'][$i]['penulisan'] = $soal['penulisan'];
                
                $j++;

            } else if($soal['item'] == "soal esai"){

                // from json to array 
                // var_dump($soal);
                $string = trim(preg_replace('/\s+/', ' ', $soal['data']));
                // $txt_soal = json_decode( preg_replace('/[\x00-\x1F\x80-\xFF]/', '', $soal['data']), true );
                $txt_soal = json_decode($string, true );
                
                
                // var_dump($txt_soal);

                if($soal['penulisan'] == "RTL"){
                    $no = $this->program->angka_arab($j).". ";
                    $tes['soal'] = str_replace("{no}", $no, $txt_soal['soal']);
                } else {
                    $no = $j.". ";
                    $tes['soal'] = str_replace("{no}", $no, $txt_soal['soal']);
                }

                $data['item'][$i]['id_item'] = $soal['id_item'];
                $data['item'][$i]['item'] = $soal['item'];
                $data['item'][$i]['data']['soal'] = $tes['soal'];
                $data['item'][$i]['data']['jawaban'] = $txt_soal['jawaban'];
                $data['item'][$i]['penulisan'] = $soal['penulisan'];
                
                $j++;

            } else if($soal['item'] == "petunjuk" || $soal['item'] == "audio" || $soal['item'] == "gambar"){
                $data['item'][$i] = $soal;
            } else if($soal['item'] == "kosa kata"){

                $string = trim(preg_replace('/\s+/', ' ', $soal['data']));
                $txt_soal = json_decode($string, true );

                $data['item'][$i] = $soal;
                $data['item'][$i]['data'] = $j.".<p>Kata Indo : " . $txt_soal['kata_indo'] . "</p><p>Kata Asing : " . $txt_soal['kata_asing'] . "</p><p>Penulisan : " . $soal['penulisan'] . "</p>";
                
                $j++;

            }
        }

        echo json_encode($data);
    }

    public function add_item_latihan(){
        $id_pertemuan = $this->input->post("id_pertemuan");
        $pertemuan = $this->program->get_one("pertemuan", ["id_pertemuan" => $id_pertemuan]);

        $item = $this->program->get_one("latihan_pertemuan", ["id_pertemuan" => $id_pertemuan], "urutan", "DESC");
        if($item) {
            $urutan = $item['urutan'] + 1;
        } else {
            $urutan = 1;
        }

        if($_POST['item'] == "gambar" || $_POST['item'] == "audio"){
            $data = [
                "id_pertemuan" => $pertemuan['id_pertemuan'],
                "item" => $this->input->post("item"),
                "data" => "gambar",
                "penulisan" => $this->input->post("penulisan"),
                "urutan" => $urutan,
            ];

            $query = $this->program->add_data("latihan_pertemuan", $data);

            $this->upload_media($query, $_FILES, "latihan");

            if($query){
                echo json_encode(1);
            } else {
                echo json_encode(0);
            }
        } else {
            $data = [
                "id_pertemuan" => $pertemuan['id_pertemuan'],
                "item" => $this->input->post("item"),
                "data" => trim($this->input->post("data_soal")),
                "penulisan" => $this->input->post("penulisan"),
                "urutan" => $urutan,
            ];

            $query = $this->program->add_data("latihan_pertemuan", $data);
            if($query){
                echo json_encode(1);
            } else {
                echo json_encode(0);
            }
        }

    }

    public function hapus_item(){
        $id_item = $this->input->post("id_item");

        $item = $this->program->get_one("latihan_pertemuan", ["id_item" => $id_item]);

        if($item['item'] == "gambar" || $item['item'] == "audio"){
            unlink('./assets/media/'.$item['data']);
        }

        $id_pertemuan = $item['id_pertemuan'];
        $urutan = $item['urutan'];

        $all_item = $this->program->get_all("latihan_pertemuan", ["id_pertemuan" => $id_pertemuan, "urutan > ", $urutan]);
        foreach ($all_item as $item) {
            $urutan = $item['urutan'] - 1;
            $this->program->edit_data("latihan_pertemuan", ["id_item" => $item['id_item']], ["urutan" => $urutan]);
        }

        $data = $this->program->delete_data("latihan_pertemuan", ["id_item" => $id_item]);
        if($data){
            echo json_encode("1");
        } else {
            echo json_encode("0");
        }
    }

    public function get_item_latihan(){
        $id_item = $this->input->post("id_item");
        $item = $this->program->get_one("latihan_pertemuan", ["id_item" => $id_item]);
        
        if($item['item'] == "soal"){
            $data = $item;

            // $item = explode("###", $item['data']);
            // from json to array 
            $string = trim(preg_replace('/\s+/', ' ', $item['data']));
            // $txt_soal = json_decode( preg_replace('/[\x00-\x1F\x80-\xFF]/', '', $soal['data']), true );
            $item = json_decode($string, true );
            // $item = json_decode( preg_replace('/[\x00-\x1F\x80-\xFF]/', '', $item['data']), true );

            $data['soal'] = $item['soal'];
            // $data['soal'] = $item[0];
            // $pilihan = explode("///", $item[1]);

            // $data['pilihan_a'] = $pilihan[0];
            // $data['pilihan_b'] = $pilihan[1];
            // $data['pilihan_c'] = $pilihan[2];
            $data['pilihan'] = $item['pilihan'];
            $data['jawaban'] = $item['jawaban'];
        } else if($item['item'] == "soal esai"){
            $data = $item;

            // $item = explode("###", $item['data']);
            // from json to array 
            $string = trim(preg_replace('/\s+/', ' ', $item['data']));
            // $txt_soal = json_decode( preg_replace('/[\x00-\x1F\x80-\xFF]/', '', $soal['data']), true );
            $item = json_decode($string, true );
            // $item = json_decode( preg_replace('/[\x00-\x1F\x80-\xFF]/', '', $item['data']), true );

            $data['soal'] = $item['soal'];
            $data['jawaban'] = $item['jawaban'];
        } else if($item['item'] == "petunjuk"){
            $data = $item;
        } else if($item['item'] == "kosa kata"){

            $string = trim(preg_replace('/\s+/', ' ', $item['data']));
            $txt_soal = json_decode($string, true );

            $data = $item;
            $data['kata_indo'] = $txt_soal['kata_indo'];
            $data['kata_asing'] = $txt_soal['kata_asing'];
            // $data['item'][$i]['data'] = $j.".<p>Kata Indo : " . $txt_soal['kata_indo'] . "</p><p>Kata Asing : " . $txt_soal['kata_asing'] . "</p>";
        }

        echo json_encode($data);
    }

    public function edit_item_latihan(){
        $id_item = $this->input->post("id_item");

        $data = [
            "data" => $this->input->post("data_soal"),
            "penulisan" => $this->input->post("penulisan"),
        ];

        $query = $this->program->edit_data("latihan_pertemuan", ["id_item" => $id_item], $data);
        if($query){
            echo json_encode(1);
        } else {
            echo json_encode(0);
        }
    }

    public function edit_urutan_latihan_pertemuan(){
        $data = $this->program->edit_urutan_latihan_pertemuan();
        echo json_encode($data);
    }
    //latihan pertemuan

    
    public function upload_media($id, $file, $tipe){
        if(isset($file['file']['name'])) {

            $nama_file = $_FILES['file'] ['name']; // Nama Audio
            $size        = $_FILES['file'] ['size'];// Size Audio
            $error       = $_FILES['file'] ['error'];
            $tipe_audio  = $_FILES['file'] ['type']; //tipe audio untuk filter
            $folder      = "./assets/media/";
            $valid       = array('jpg','png','gif','jpeg', 'JPG', 'PNG', 'GIF', 'JPEG', 'mp3', 'MP3');
            
            if(strlen($nama_file)){   
                 // Perintah untuk mengecek format gambar
                 
                 list($txt, $ext) = explode(".", $nama_file);
                 if(in_array($ext,$valid)){   

                     // Perintah untuk mengupload file dan memberi nama baru
                    switch ($tipe_audio) {
                        case 'image/jpeg':
                            $tipe_audio = "jpg";
                            break;
                        case 'image/png':
                            $tipe_audio = "png";
                            break;
                        case 'image/gif':
                            $tipe_audio = "gif";
                            break;
                        case 'audio/mpeg':
                            $tipe_audio = "mp3";
                            break;
                        default:
                            break;
                    }

                    $namaFile = $tipe."-".$id.".".$tipe_audio;

                     $tmp = $file['file']['tmp_name'];
                    
                     
                    if(move_uploaded_file($tmp, $folder.$namaFile)){

                        if($tipe == "materi"){
                            $this->program->edit_data("materi_pertemuan", ["id_materi" => $id], ["data" => $namaFile]);
                        } else if($tipe == "latihan"){
                            $this->program->edit_data("latihan_pertemuan", ["id_item" => $id], ["data" => $namaFile]);
                        }

                        return 1;
                        
                    } else { // Jika Audio Gagal Di upload 
                        return 0;
                    }
                 } else{ 
                    return 2;
                }
        
            }
            
        }
    }

    public function materi_latihan(){
        $id_pertemuan = $this->input->post("pertemuan");
        $materi_latihan = $this->input->post("materi_latihan");

        if($materi_latihan == "detailPertemuan"){
            redirect(base_url()."program/detailPertemuan/".md5($id_pertemuan));
        } else if($materi_latihan == "detailLatihan"){
            redirect(base_url()."program/detailLatihan/".md5($id_pertemuan));
        }
    }
}

/* End of file Program.php */
