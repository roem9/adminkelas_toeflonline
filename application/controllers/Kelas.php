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

        $data['title'] = $data['member']['nama'] . " | " . $data['kelas']['nama_kelas'];

        // edit baca member = 1
        $this->kelas->edit_data("kelas_member", ["md5(id_member)" => $id_member, "md5(id_kelas)" => $id_kelas], ["baca_admin" => 1, "refresh_admin" => 1]);

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
}
 
/* End of file Kelas.php */