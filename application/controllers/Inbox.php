<?php

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
defined('BASEPATH') OR exit('No direct script access allowed');
 
class Inbox extends MY_Controller {
    public function index(){
        // navbar and sidebar
        $data['menu'] = "Inbox";
        $data['dropdown'] = "listKelasAktif";
 
        // for title and header 
        $data['title'] = "List Inbox";
        
        // javascript 
        $data['js'] = [
            "ajax.js",
            "function.js",
            "helper.js",
            "setting.js",
        ];

        $this->load->view("pages/inbox/list", $data);
    }

    public function load_inbox(){
        header('Content-Type: application/json');
        $output = $this->inbox->load_inbox();
        echo $output;
    }

    public function markread(){
        $id_kelas = $this->input->post("id_kelas");
        $id_member = $this->input->post("id_member");

        $this->db->where(["id_kelas" => $id_kelas, "id_member" => $id_member, "hapus" => 0]);
        $this->db->update("kelas_member", ["baca_admin" => 1]);
        return $this->db->affected_rows();
    }
}