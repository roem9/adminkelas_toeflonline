<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Pengajar extends MY_Controller {

    public function index(){
        $data['title'] = 'List Pengajar';
        $data['menu'] = "Pengajar";
        $data['modal'] = ["modal_pengajar", "modal_setting"];
        $data['js'] = [
            "ajax.js",
            "function.js",
            "helper.js",
            "setting.js",
            "load_data/pengajar_reload.js",
            "modules/pengajar.js",
        ];

        $this->load->view("pages/pengajar/list", $data);
    }

    public function load_pengajar(){
        header('Content-Type: application/json');
        $output = $this->pengajar->load_pengajar();
        echo $output;
    }

    public function add_pengajar(){
        $data = $this->pengajar->add_pengajar();
        echo json_encode($data);
    }
    
    public function get_pengajar(){
        $id_pengajar = $this->input->post("id_pengajar");
 
        $data = $this->pengajar->get_one("pengajar", ["id_pengajar" => $id_pengajar]);
        echo json_encode($data);
    }
 
    public function edit_pengajar(){
        $data = $this->pengajar->edit_pengajar();
        echo json_encode($data);
    }
}

?>