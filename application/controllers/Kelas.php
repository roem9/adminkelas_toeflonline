<?php

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
defined('BASEPATH') OR exit('No direct script access allowed');
 
class Kelas extends MY_Controller {
    public function aktif(){
        // navbar and sidebar
        $data['menu'] = "Kelas";
        $data['dropdown'] = "listKelasAktif";
 
        // for title and header 
        $data['title'] = "List Kelas Aktif";
        $data['status'] = "aktif";
 
        // for modal 
        $data['modal'] = [
            "modal_kelas",
            "modal_setting",
        ];
        
        // javascript 
        $data['js'] = [
            "ajax.js",
            "function.js",
            "helper.js",
            "setting.js",
            "load_data/kelas_reload.js",
            "modules/kelas.js",
        ];

        $this->load->view("pages/kelas/list", $data);
    }
    
    public function nonaktif(){
        // navbar and sidebar
        $data['menu'] = "Kelas";
        $data['dropdown'] = "listKelasNonaktif";
 
        // for title and header 
        $data['title'] = "List Kelas Nonaktif";
        $data['status'] = "nonaktif";
 
        // for modal 
        $data['modal'] = [
            "modal_kelas",
            "modal_setting"
        ];
        
        // javascript 
        $data['js'] = [
            "ajax.js",
            "function.js",
            "helper.js",
            "setting.js",
            "load_data/kelas_reload.js",
            "modules/kelas.js",
        ];

        $this->load->view("pages/kelas/list", $data);
    }

    public function wl(){
        // navbar and sidebar
        $data['menu'] = "Kelas";
        $data['dropdown'] = "listWl";
 
        // for title and header 
        $data['title'] = "List Waiting List";
 
        // for modal 
        $data['modal'] = [
            "modal_kelas",
            "modal_setting"
        ];
        
        // javascript 
        $data['js'] = [
            "ajax.js",
            "function.js",
            "helper.js",
            "setting.js",
            "load_data/wl_reload.js",
            "modules/wl.js",
        ];

        $this->load->view("pages/kelas/wl", $data);
    }

    public function inbox($id_kelas){
        $data['kelas'] = $this->kelas->get_one("kelas", ["md5(id_kelas)" => $id_kelas]);
 
        // for title and header 
        $data['menu'] = "ruangDiskusi";
        $data['title'] = "Ruang Diskusi " . $data['kelas']['nama_kelas'];
        
        $this->db->from("kelas_member as a");
        $this->db->join("member as b", "a.id_member = b.id_member");
        $this->db->where(["a.hapus" => "0", "md5(id_kelas)" => $id_kelas]);
        $data['member'] = $this->db->get()->result_array();
        
        // javascript 
        $data['js'] = [
            "ajax.js",
            "function.js",
            "helper.js",
            "setting.js",
            // "load_data/wl_reload.js",
            // "modules/wl.js",
        ];

        $this->load->view("pages/kelas/inbox", $data);
    }

    public function inbox_peserta($id_kelas, $id_member){
        $data['member'] = $this->kelas->get_one("member", ["md5(id_member)" => $id_member]);
        $data['kelas'] = $this->kelas->get_one("kelas", ["md5(id_kelas)" => $id_kelas]);

        $data['menu'] = "ruangDiskusi";
        $data['title'] = $data['member']['nama'] . " | " . $data['kelas']['nama_kelas'];

        // edit baca member = 1
        $this->kelas->edit_data("kelas_member", ["md5(id_member)" => $id_member, "md5(id_kelas)" => $id_kelas], ["baca_admin" => 1, "refresh_admin" => 1]);

        $data['modal'] = [
            "modal_inbox"
        ];

        $data['js'] = [
            "ajax.js",
            "function.js",
            "helper.js",
            "modules/inbox.js",
            "load_data/inbox_reload.js",
        ];

        $this->load->view("pages/kelas/inbox_peserta", $data);
    }

    public function get_all_inbox(){
        $data = $this->kelas->get_all_inbox();
        echo json_encode($data);
    }

    public function input_inbox(){
        $data = $this->kelas->input_inbox();
        echo json_encode($data);
    }

    public function get_report_latihan(){
        $id_kelas = $this->input->post("id_kelas");
        $id_member = $this->input->post("id_member");

        $this->db->select("id, a.id_kelas, a.id_member, a.id_pertemuan, nama_pertemuan, nilai, latihan");
        $this->db->from("latihan_member as a");
        $this->db->join("pertemuan as b", "a.id_pertemuan = b.id_pertemuan");
        $this->db->where(["id_kelas" => $id_kelas, "id_member" => $id_member]);
        $result = $this->db->get()->result_array();

        $data = [];

        foreach ($result as $i => $result) {
            $data[$i] = $result;
            if($result['latihan'] == "Pre / Mid Test Listening" || $result['latihan'] == "Post Test Listening"){
                $data[$i]['nilai'] = "{$result['nilai']}/" . poin_toefl("Listening", jumlah_soal($result['id_pertemuan']));
            } else if($result['latihan'] == "Pre / Mid Test Structure" || $result['latihan'] == "Post Test Structure"){
                $data[$i]['nilai'] = "{$result['nilai']}/" . poin_toefl("Structure", jumlah_soal($result['id_pertemuan']));
            } else if($result['latihan'] == "Pre / Mid Test Reading" || $result['latihan'] == "Post Test Reading"){
                $data[$i]['nilai'] = "{$result['nilai']}/" . poin_toefl("Reading", jumlah_soal($result['id_pertemuan']));
            } else {
                $data[$i]['nilai'] = "{$result['nilai']}/" . jumlah_soal($result['id_pertemuan']);
            }
        }

        echo json_encode($data);
    }

    public function check_msg(){
        $id_kelas = $this->input->post("id_kelas");
        $id_member = $this->input->post("id_member");

        $msg = $this->kelas->get_one("kelas_member", ["id_kelas" => $id_kelas, "id_member" => $id_member]);
        if($msg['refresh_admin'] == 0){
            $this->kelas->edit_data("kelas_member", ["id_kelas" => $id_kelas, "id_member" => $id_member], ["refresh_admin" => 1, "baca_admin" => 1]);
            echo json_encode(1);
        } else {
            echo json_encode(0);
        }
    }
    
    public function load_kelas(){
        header('Content-Type: application/json');
        $output = $this->kelas->load_kelas();
        echo $output;
    }

    public function load_wl(){
        header('Content-Type: application/json');
        $output = $this->kelas->load_wl();
        echo $output;
    }
 
    public function add_kelas(){
        $data = $this->kelas->add_kelas();
        echo json_encode($data);
    }
    
    public function get_kelas(){
        $data = $this->kelas->get_kelas();
        echo json_encode($data);
    }
 
    public function edit_kelas(){
        $data = $this->kelas->edit_kelas();
        echo json_encode($data);
    }
 
    public function change_status(){
        $data = $this->kelas->change_status();
        echo json_encode($data);
    }
 
    public function hapus_kelas(){
        $data = $this->kelas->hapus_kelas();
        echo json_encode($data);
    }

    public function delete_wl(){
        $data = $this->kelas->delete_wl();
        echo json_encode($data);
    }

    public function get_wl(){
        $data = $this->kelas->get_wl();
        echo json_encode($data);
    }

    public function list_kelas(){
        $data = $this->kelas->list_kelas();
        echo json_encode($data);
    }

    public function input_kelas(){
        $data = $this->kelas->input_kelas();
        echo json_encode($data);
    }

    public function get_peserta_kelas(){
        $data = $this->kelas->get_peserta_kelas();
        echo json_encode($data);
    }

    public function get_peserta_wl(){
        $data = $this->kelas->get_peserta_wl();
        echo json_encode($data);
    }

    public function remove_peserta(){
        $data = $this->kelas->remove_peserta();
        echo json_encode($data);
    }

    public function get_config(){
        $data = $this->kelas->get_config();
        echo json_encode($data);
    }

    public function edit_config(){
        $data = $this->kelas->edit_config();
        echo json_encode($data);
    }

    public function latihan($id_kelas, $id_pertemuan, $id_member){
        ini_set('xdebug.var_display_max_depth', 10);
        ini_set('xdebug.var_display_max_children', 256);
        ini_set('xdebug.var_display_max_data', 1024);

        $data['js'] = [
            "ajax.js",
            "function.js",
            "helper.js"
        ];

        $pertemuan = $this->kelas->get_one("pertemuan", ["id_pertemuan" => $id_pertemuan]);
        $kelas = $this->kelas->get_one("kelas", ["id_kelas" => $id_kelas]);

        $data['menu'] = "reviewPeserta";
        $data['title'] = "Latihan {$kelas['program']} <br> {$pertemuan['nama_pertemuan']}";
        $data['kelas'] = $kelas;
        $data['pertemuan'] = $pertemuan;
        $data['member'] = $this->kelas->get_one("member", ["id_member" => $id_member]);

        $data['web_admin'] = $this->kelas->get_one("config", ["field" => "web_admin"]);
        
        // latihan koreksi otomatis 
        if($pertemuan['latihan'] == "Koreksi Otomatis"){
            $jawaban = $this->kelas->get_one("latihan_member", ["id_kelas" => $id_kelas, "id_pertemuan" => $id_pertemuan, "id_member" => $id_member]);
            if(!empty($jawaban) && $pertemuan['perulangan'] == "Sekali"){
                $number = 1;
                $string = trim(preg_replace('/\s+/', ' ', $jawaban['data']));
                $data_soal = json_decode($string, true);
                foreach ($data_soal as $j => $soal) {
                    if($soal['item'] == "soal"){
                        $no = $number.". ";
                        $soal['data']['soal'] = str_replace("{no}", $no, $soal['data']['soal']);
    
                        $data['soal'][$j]['item'] = $soal['item'];
                        $data['soal'][$j]['data']['soal'] = $soal['data']['soal'];
                        $data['soal'][$j]['data']['pilihan'] = $soal['data']['pilihan'];
                        $data['soal'][$j]['data']['jawaban'] = $soal['data']['jawaban'];
                        $data['soal'][$j]['data']['status'] = $soal['data']['status'];
                        $data['soal'][$j]['data']['key'] = $soal['data']['key'];
                        $data['soal'][$j]['penulisan'] = $soal['penulisan'];
                        
                        $number++;
            
                    } else if($soal['item'] == "soal esai"){
                        $no = $number.". ";
                        $soal['data']['soal'] = str_replace("{no}", $no, $soal['data']['soal']);
    
                        $data['soal'][$j]['item'] = $soal['item'];
                        $data['soal'][$j]['data']['soal'] = $soal['data']['soal'];
                        $data['soal'][$j]['data']['jawaban'] = $soal['data']['jawaban'];
                        $data['soal'][$j]['data']['status'] = $soal['data']['status'];
                        $data['soal'][$j]['data']['key'] = $soal['data']['key'];
                        $data['soal'][$j]['penulisan'] = $soal['penulisan'];
                        
                        $number++;
    
                    } else if($soal['item'] == "petunjuk" || $soal['item'] == "audio" || $soal['item'] == "gambar"){
                        $data['soal'][$j] = $soal;
                    }
                }

                $data['jawaban'] = $jawaban;
                $data['pertemuan'] = $this->kelas->get_one("pertemuan", ["id_pertemuan" => $id_pertemuan]);
                $data['kelas'] = $this->kelas->get_one("kelas", ["id_kelas" => $id_kelas]);

                $this->load->view("pages/latihan/koreksi-otomatis-pembahasan-sekali", $data);
            } else if($pertemuan['pembahasan'] == "Ya" && $this->session->flashdata("pesan")){
                $number = 1;
                $string = trim(preg_replace('/\s+/', ' ', $jawaban['data']));
                $data_soal = json_decode($string, true);
                foreach ($data_soal as $j => $soal) {
                    if($soal['item'] == "soal"){
                        $no = $number.". ";
                        $soal['data']['soal'] = str_replace("{no}", $no, $soal['data']['soal']);
    
                        $data['soal'][$j]['item'] = $soal['item'];
                        $data['soal'][$j]['data']['soal'] = $soal['data']['soal'];
                        $data['soal'][$j]['data']['pilihan'] = $soal['data']['pilihan'];
                        $data['soal'][$j]['data']['jawaban'] = $soal['data']['jawaban'];
                        $data['soal'][$j]['data']['status'] = $soal['data']['status'];
                        $data['soal'][$j]['data']['key'] = $soal['data']['key'];
                        $data['soal'][$j]['penulisan'] = $soal['penulisan'];
                        
                        $number++;
            
                    } else if($soal['item'] == "soal esai"){
                        $no = $number.". ";
                        $soal['data']['soal'] = str_replace("{no}", $no, $soal['data']['soal']);
    
                        $data['soal'][$j]['item'] = $soal['item'];
                        $data['soal'][$j]['data']['soal'] = $soal['data']['soal'];
                        $data['soal'][$j]['data']['jawaban'] = $soal['data']['jawaban'];
                        $data['soal'][$j]['data']['status'] = $soal['data']['status'];
                        $data['soal'][$j]['data']['key'] = $soal['data']['key'];
                        $data['soal'][$j]['penulisan'] = $soal['penulisan'];
                        
                        $number++;
    
                    } else if($soal['item'] == "petunjuk" || $soal['item'] == "audio" || $soal['item'] == "gambar"){
                        $data['soal'][$j] = $soal;
                    }
                }

                $data['jawaban'] = $jawaban;
                $data['pertemuan'] = $this->kelas->get_one("pertemuan", ["id_pertemuan" => $id_pertemuan]);
                $data['kelas'] = $this->kelas->get_one("kelas", ["id_kelas" => $id_kelas]);

                $this->load->view("pages/latihan/koreksi-otomatis-pembahasan", $data);
            } else {
                $soal = $this->kelas->get_all("latihan_pertemuan", ["id_pertemuan" => $id_pertemuan], "urutan", "asc");
                $number = 1;
                foreach ($soal as $j => $soal) {
                    if($soal['item'] == "soal"){
                        // from json to array 
                        $string = trim(preg_replace('/\s+/', ' ', $soal['data']));
                        $txt_soal = json_decode($string, true );

                        $no = $number.". ";
                        $txt_soal['soal'] = str_replace("{no}", $no, $txt_soal['soal']);
            
                        $data['soal'][$j]['id_item'] = $soal['id_item'];
                        $data['soal'][$j]['item'] = $soal['item'];
                        $data['soal'][$j]['data']['soal'] = $txt_soal['soal'];
                        $data['soal'][$j]['data']['pilihan'] = $txt_soal['pilihan'];
                        $data['soal'][$j]['data']['jawaban'] = $txt_soal['jawaban'];
                        $data['soal'][$j]['penulisan'] = $soal['penulisan'];
                        
                        $number++;
            
                    } else if($soal['item'] == "soal esai"){
                        // from json to array 
                        $string = trim(preg_replace('/\s+/', ' ', $soal['data']));
                        $txt_soal = json_decode($string, true );
                        
                        $no = $number.". ";
                        $txt_soal['soal'] = str_replace("{no}", $no, $txt_soal['soal']);
    
                        $data['soal'][$j]['id_item'] = $soal['id_item'];
                        $data['soal'][$j]['item'] = $soal['item'];
                        $data['soal'][$j]['data']['soal'] = $txt_soal['soal'];
                        $data['soal'][$j]['data']['jawaban'] = $txt_soal['jawaban'];
                        $data['soal'][$j]['penulisan'] = $soal['penulisan'];
                        
                        $number++;
    
                    } else if($soal['item'] == "petunjuk" || $soal['item'] == "audio" || $soal['item'] == "gambar"){
                        $data['soal'][$j] = $soal;
                    }
                }
                $this->load->view("pages/latihan/koreksi-otomatis", $data);
            }
        } else if($pertemuan['latihan'] == "Latihan Kosa Kata"){
            if($pertemuan['pembahasan'] == "Ya" && $this->session->userdata("pesan")){
                    $jawaban = $this->kelas->get_one("latihan_member", ["id_kelas" => $id_kelas, "id_pertemuan" => $id_pertemuan, "id_member" => $id_member]);
                    $string = trim(preg_replace('/\s+/', ' ', $jawaban['data']));
                    $data_soal = json_decode($string, true);
                    foreach ($data_soal as $i => $soal) {
                        $data['soal'][$i]['data']['soal'] = $soal['data']['soal'];
                        $data['soal'][$i]['data']['pilihan'] = $soal['data']['pilihan'];
                        $data['soal'][$i]['data']['jawaban'] = $soal['data']['jawaban'];
                        $data['soal'][$i]['data']['key'] = $soal['data']['key'];
                        $data['soal'][$i]['data']['status'] = $soal['data']['status'];
                        $data['soal'][$i]['penulisan'] = $soal['penulisan'];
                        $data['soal'][$i]['bahasa'] = $soal['bahasa'];
                    }
                
                $this->load->view("pages/latihan/kosakata-pembahasan", $data);
            } else {
                $soal = $this->kelas->get_all("latihan_pertemuan", ["id_pertemuan" => $id_pertemuan], "urutan", "asc");
                shuffle($soal);
    
                $pilihan_indo = [];
                $pilihan_asing = [];
                
                if(COUNT($soal) >= $pertemuan['jumlah_soal']){
                    $loop = $pertemuan['jumlah_soal'];
                } else {
                    $loop = COUNT($soal);
                }
    
                for ($i=0; $i < $loop; $i++) { 
                    $string = trim(preg_replace('/\s+/', ' ', $soal[$i]['data']));
                    $txt_soal = json_decode($string, true );
                    array_push($pilihan_indo, $txt_soal['kata_indo']);
                    array_push($pilihan_asing, $txt_soal['kata_asing']);
                }
    
                for ($i=0; $i < $loop; $i++) { 
                    $string = trim(preg_replace('/\s+/', ' ', $soal[$i]['data']));
                    $txt_soal = json_decode($string, true );
                    $number = $i + 1;
                    $no = $number.". ";
                    
                    if($i % 2 == 0){
                        $data_pilihan = $pilihan_asing;
                        shuffle($data_pilihan);
    
                        foreach (array_keys($data_pilihan, $txt_soal['kata_asing'], true) as $key) {
                            unset($data_pilihan[$key]);
                        }
    
                        $data_pilihan = array_values($data_pilihan);
                        $array_pilihan = [$txt_soal['kata_asing'], $data_pilihan[0], $data_pilihan[1], $data_pilihan[2]];
                        shuffle($array_pilihan);
    
                        $data['soal'][$i]['data']['bahasa'] = "Indonesia";
                        $data['soal'][$i]['data']['soal'] = $no."{$pertemuan['text_soal_indo']} &quot;".$txt_soal['kata_indo']."&quot;";
                        $data['soal'][$i]['data']['pilihan'] = $array_pilihan;
                        $data['soal'][$i]['data']['jawaban'] = $txt_soal['kata_asing'];
                        $data['soal'][$i]['penulisan'] = $soal[$i]['penulisan'];
                        $data['soal'][$i]['soal'] = htmlspecialchars('{"bahasa":"'.$data['soal'][$i]['data']['bahasa'].'","penulisan":"'.$soal[$i]["penulisan"].'","data":{"soal":"'.$data['soal'][$i]['data']['soal'].'","pilihan":["'.$array_pilihan[0].'","'.$array_pilihan[1].'","'.$array_pilihan[2].'","'.$array_pilihan[3].'"],"jawaban":"'.$data['soal'][$i]['data']['jawaban'].'",');
                    } else {
                        $data_pilihan = $pilihan_indo;
                        shuffle($data_pilihan);
    
                        foreach (array_keys($data_pilihan, $txt_soal['kata_indo'], true) as $key) {
                            unset($data_pilihan[$key]);
                        }
    
                        $data_pilihan = array_values($data_pilihan);
                        $array_pilihan = [$txt_soal['kata_indo'], $data_pilihan[0], $data_pilihan[1], $data_pilihan[2]];
                        shuffle($array_pilihan);
    
                        $data['soal'][$i]['data']['bahasa'] = "Asing";
                        $data['soal'][$i]['data']['soal'] = $no."{$pertemuan['text_soal_asing']} &quot;".$txt_soal['kata_asing']."&quot;";
                        $data['soal'][$i]['data']['pilihan'] = $array_pilihan;
                        $data['soal'][$i]['data']['jawaban'] = $txt_soal['kata_indo'];
                        $data['soal'][$i]['penulisan'] = $soal[$i]['penulisan'];
                        $data['soal'][$i]['soal'] = htmlspecialchars('{"bahasa":"'.$data['soal'][$i]['data']['bahasa'].'","penulisan":"'.$soal[$i]["penulisan"].'","data":{"soal":"'.$data['soal'][$i]['data']['soal'].'","pilihan":["'.$array_pilihan[0].'","'.$array_pilihan[1].'","'.$array_pilihan[2].'","'.$array_pilihan[3].'"],"jawaban":"'.$data['soal'][$i]['data']['jawaban'].'",');
                    }
                }
                $this->load->view("pages/latihan/kosakata", $data);
            }
        } else if($pertemuan['latihan'] == "Koreksi Manual"){
            $data['btn_save'] = true;
            $soal = $this->kelas->get_all("latihan_pertemuan", ["id_pertemuan" => $id_pertemuan], "urutan", "asc");
            $number = 1;
            foreach ($soal as $j => $soal) {
                if($soal['item'] == "soal"){
                    // from json to array 
                    $string = trim(preg_replace('/\s+/', ' ', $soal['data']));
                    $txt_soal = json_decode($string, true );

                    $no = $number.". ";
                    $txt_soal['soal'] = str_replace("{no}", $no, $txt_soal['soal']);
        
                    $data['soal'][$j]['id_item'] = $soal['id_item'];
                    $data['soal'][$j]['item'] = $soal['item'];
                    $data['soal'][$j]['data']['soal'] = $txt_soal['soal'];
                    $data['soal'][$j]['data']['pilihan'] = $txt_soal['pilihan'];
                    $data['soal'][$j]['data']['jawaban'] = $txt_soal['jawaban'];
                    $data['soal'][$j]['penulisan'] = $soal['penulisan'];
                    
                    $number++;
        
                } else if($soal['item'] == "soal esai"){
                    // from json to array 
                    $string = trim(preg_replace('/\s+/', ' ', $soal['data']));
                    $txt_soal = json_decode($string, true );
                    
                    $no = $number.". ";
                    $txt_soal['soal'] = str_replace("{no}", $no, $txt_soal['soal']);

                    $data['soal'][$j]['id_item'] = $soal['id_item'];
                    $data['soal'][$j]['item'] = $soal['item'];
                    $data['soal'][$j]['data']['soal'] = $txt_soal['soal'];
                    $data['soal'][$j]['data']['jawaban'] = $txt_soal['jawaban'];
                    $data['soal'][$j]['penulisan'] = $soal['penulisan'];
                    
                    $number++;

                } else if($soal['item'] == "petunjuk" || $soal['item'] == "audio" || $soal['item'] == "gambar"){
                    $data['soal'][$j]['id_item'] = $soal['id_item'];
                    $data['soal'][$j] = $soal;
                }
            }

            // $data['periksa']['text'] = "";
            // $data['periksa']['status'] = "";
            $jawaban = $this->kelas->get_one("latihan_member", ["id_kelas" => $id_kelas, "id_pertemuan" => $id_pertemuan, "id_member" => $id_member]);
            $data['readonly'] = "";

            if($jawaban){
                $data['latihan'] = $jawaban;
                $string = trim(preg_replace('/\s+/', ' ', $jawaban['data']));
                $data_soal = json_decode($string, true);
                $data['jawaban'] = $data_soal;
                // var_dump($data['jawaban']);
                // exit();
                if($jawaban['periksa'] == "mengisi") {
                    $data['periksa']['status'] = "mengisi";
                    $data['periksa']['text'] = "tekan tombol &quot;kumpulkan jawaban&quot; untuk mengumpulkan jawaban Kamu";
                } else if($jawaban['periksa'] == "mengumpul"){
                    $data['readonly'] = "readonly";
                    unset($data['btn_save']);
                    $data['periksa']['status'] = "mengumpul";
                    $data['periksa']['text'] = "Kamu telah mengumpulkan jawaban. Jawaban Kamu akan segera diperiksa. Jika ingin mengubah jawaban silakan tekan tombol &quot;edit jawaban&quot;";
                } else if($jawaban['periksa'] == "memeriksa"){
                    $data['readonly'] = "readonly";
                    unset($data['btn_save']);
                    $data['periksa']['status'] = "memeriksa";
                    $data['periksa']['text'] = "Jawaban Kamu sedang diperiksa";
                } else if($jawaban['periksa'] == "selesai"){
                    $data['readonly'] = "readonly";
                    unset($data['btn_save']);
                    $data['periksa']['status'] = "selesai";
                    $data['periksa']['text'] = "";
                }
            } else {
                $data['periksa']['status'] = "mengisi";
                $data['periksa']['text'] = "tekan tombol &quot;kumpulkan jawaban&quot; untuk mengumpulkan jawaban Kamu";
            }

            if($data['periksa']['status'] == "selesai"){
                $this->load->view("pages/latihan/koreksi-manual-pembahasan", $data);
            } else {
                $this->load->view("pages/latihan/koreksi-manual", $data);
            }
        } else if($pertemuan['latihan'] == "Pre / Mid Test Listening" || $pertemuan['latihan'] == "Post Test Listening" || $pertemuan['latihan'] == "Pre / Mid Test Structure" || $pertemuan['latihan'] == "Post Test Structure" || $pertemuan['latihan'] == "Pre / Mid Test Reading" || $pertemuan['latihan'] == "Post Test Reading"){
            $jawaban = $this->kelas->get_one("latihan_member", ["id_kelas" => $id_kelas, "id_pertemuan" => $id_pertemuan, "id_member" => $id_member]);
            if(!empty($jawaban) && $pertemuan['perulangan'] == "Sekali"){
                $number = 1;
                $string = trim(preg_replace('/\s+/', ' ', $jawaban['data']));
                $data_soal = json_decode($string, true);
                foreach ($data_soal as $j => $soal) {
                    if($soal['item'] == "soal"){
                        $no = $number.". ";
                        $soal['data']['soal'] = str_replace("{no}", $no, $soal['data']['soal']);
    
                        $data['soal'][$j]['item'] = $soal['item'];
                        $data['soal'][$j]['data']['soal'] = $soal['data']['soal'];
                        $data['soal'][$j]['data']['pilihan'] = $soal['data']['pilihan'];
                        $data['soal'][$j]['data']['jawaban'] = $soal['data']['jawaban'];
                        $data['soal'][$j]['data']['status'] = $soal['data']['status'];
                        $data['soal'][$j]['data']['key'] = $soal['data']['key'];
                        $data['soal'][$j]['penulisan'] = $soal['penulisan'];
                        
                        $number++;
            
                    } else if($soal['item'] == "soal esai"){
                        $no = $number.". ";
                        $soal['data']['soal'] = str_replace("{no}", $no, $soal['data']['soal']);
    
                        $data['soal'][$j]['item'] = $soal['item'];
                        $data['soal'][$j]['data']['soal'] = $soal['data']['soal'];
                        $data['soal'][$j]['data']['jawaban'] = $soal['data']['jawaban'];
                        $data['soal'][$j]['data']['status'] = $soal['data']['status'];
                        $data['soal'][$j]['data']['key'] = $soal['data']['key'];
                        $data['soal'][$j]['penulisan'] = $soal['penulisan'];
                        
                        $number++;
    
                    } else if($soal['item'] == "petunjuk" || $soal['item'] == "audio" || $soal['item'] == "gambar"){
                        $data['soal'][$j] = $soal;
                    }
                }

                $data['jawaban'] = $jawaban;
                $data['pertemuan'] = $this->kelas->get_one("pertemuan", ["id_pertemuan" => $id_pertemuan]);
                $data['kelas'] = $this->kelas->get_one("kelas", ["id_kelas" => $id_kelas]);

                $this->load->view("pages/latihan/koreksi-test-pembahasan-sekali", $data);
            } else if($pertemuan['pembahasan'] == "Ya" && $this->session->flashdata("pesan")){
                $number = 1;
                $string = trim(preg_replace('/\s+/', ' ', $jawaban['data']));
                $data_soal = json_decode($string, true);
                foreach ($data_soal as $j => $soal) {
                    if($soal['item'] == "soal"){
                        $no = $number.". ";
                        $soal['data']['soal'] = str_replace("{no}", $no, $soal['data']['soal']);
    
                        $data['soal'][$j]['item'] = $soal['item'];
                        $data['soal'][$j]['data']['soal'] = $soal['data']['soal'];
                        $data['soal'][$j]['data']['pilihan'] = $soal['data']['pilihan'];
                        $data['soal'][$j]['data']['jawaban'] = $soal['data']['jawaban'];
                        $data['soal'][$j]['data']['status'] = $soal['data']['status'];
                        $data['soal'][$j]['data']['key'] = $soal['data']['key'];
                        $data['soal'][$j]['penulisan'] = $soal['penulisan'];
                        
                        $number++;
            
                    } else if($soal['item'] == "soal esai"){
                        $no = $number.". ";
                        $soal['data']['soal'] = str_replace("{no}", $no, $soal['data']['soal']);
    
                        $data['soal'][$j]['item'] = $soal['item'];
                        $data['soal'][$j]['data']['soal'] = $soal['data']['soal'];
                        $data['soal'][$j]['data']['jawaban'] = $soal['data']['jawaban'];
                        $data['soal'][$j]['data']['status'] = $soal['data']['status'];
                        $data['soal'][$j]['data']['key'] = $soal['data']['key'];
                        $data['soal'][$j]['penulisan'] = $soal['penulisan'];
                        
                        $number++;
    
                    } else if($soal['item'] == "petunjuk" || $soal['item'] == "audio" || $soal['item'] == "gambar"){
                        $data['soal'][$j] = $soal;
                    }
                }

                $data['jawaban'] = $jawaban;
                $data['pertemuan'] = $this->kelas->get_one("pertemuan", ["id_pertemuan" => $id_pertemuan]);
                $data['kelas'] = $this->kelas->get_one("kelas", ["id_kelas" => $id_kelas]);

                $this->load->view("pages/latihan/koreksi-test-pembahasan-sekali", $data);
            } else {
                $soal = $this->kelas->get_all("latihan_pertemuan", ["id_pertemuan" => $id_pertemuan], "urutan", "asc");
                $number = 1;
                foreach ($soal as $j => $soal) {
                    if($soal['item'] == "soal"){
                        // from json to array 
                        $string = trim(preg_replace('/\s+/', ' ', $soal['data']));
                        $txt_soal = json_decode($string, true );

                        $no = $number.". ";
                        $txt_soal['soal'] = str_replace("{no}", $no, $txt_soal['soal']);
            
                        $data['soal'][$j]['id_item'] = $soal['id_item'];
                        $data['soal'][$j]['item'] = $soal['item'];
                        $data['soal'][$j]['data']['soal'] = $txt_soal['soal'];
                        $data['soal'][$j]['data']['pilihan'] = $txt_soal['pilihan'];
                        $data['soal'][$j]['data']['jawaban'] = $txt_soal['jawaban'];
                        $data['soal'][$j]['penulisan'] = $soal['penulisan'];
                        
                        $number++;
            
                    } else if($soal['item'] == "soal esai"){
                        // from json to array 
                        $string = trim(preg_replace('/\s+/', ' ', $soal['data']));
                        $txt_soal = json_decode($string, true );
                        
                        $no = $number.". ";
                        $txt_soal['soal'] = str_replace("{no}", $no, $txt_soal['soal']);
    
                        $data['soal'][$j]['id_item'] = $soal['id_item'];
                        $data['soal'][$j]['item'] = $soal['item'];
                        $data['soal'][$j]['data']['soal'] = $txt_soal['soal'];
                        $data['soal'][$j]['data']['jawaban'] = $txt_soal['jawaban'];
                        $data['soal'][$j]['penulisan'] = $soal['penulisan'];
                        
                        $number++;
    
                    } else if($soal['item'] == "petunjuk" || $soal['item'] == "audio" || $soal['item'] == "gambar"){
                        $data['soal'][$j] = $soal;
                    }
                }
                $this->load->view("pages/latihan/koreksi-test", $data);
            }
        }
    }
}
 
/* End of file Kelas.php */