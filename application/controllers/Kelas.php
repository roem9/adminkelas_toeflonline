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