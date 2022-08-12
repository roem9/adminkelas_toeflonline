<?php


defined('BASEPATH') OR exit('No direct script access allowed');

class Pengajar_model extends MY_Model {

    public function get_username_terakhir($tgl){
        $bulan = date("m", strtotime($tgl));
        $tahun = date("Y", strtotime($tgl));

        $this->db->select("substr(username, 5, 4) as id");
        $this->db->from("pengajar");
        $this->db->where("MONTH(tgl_masuk) = $bulan AND YEAR(tgl_masuk) = $tahun");
        $this->db->order_by("id", "DESC");
        return $this->db->get()->row_array();
    }

    public function add_pengajar(){
        $data = [];
        foreach ($_POST as $key => $value) {
            $data[$key] = $this->input->post($key);
        }

        $username = $this->get_username_terakhir($_POST['tgl_masuk']);
        if($username){
            $id = $username['id'] + 1;
        } else {
            $id = 1;
        }

        if($id >= 1 && $id < 10){
            $user = date('ym', strtotime($_POST['tgl_masuk']))."000".$id;
        } else if($id >= 10 && $id < 100){
            $user = date('ym', strtotime($_POST['tgl_masuk']))."00".$id;
        } else if($id >= 100 && $id < 1000){
            $user = date('ym', strtotime($_POST['tgl_masuk']))."0".$id;
        } else {
            $user = date('ym', strtotime($_POST['tgl_masuk'])).$id;
        }

        $data['username'] = $user;
        $data['status'] = "aktif";

        $query = $this->add_data("pengajar", $data);

        if($query) return 1;
        else return 0;
    }

    public function edit_pengajar(){
        $id_pengajar = $this->input->post("id_pengajar");
        unset($_POST['id_pengajar']);

        $data = [];
        foreach ($_POST as $key => $value) {
            $data[$key] = $this->input->post($key);
        }

        $query = $this->edit_data("pengajar", ["id_pengajar" => $id_pengajar], $data);
        if($query) return 1;
        else return 0;
    }

    public function get_pengajar(){
        $id_pengajar = $this->input->post("id_pengajar");
        $data = $this->get_one("pengajar", ["id_pengajar" => $id_pengajar]);
        return $data;
    }

    public function get_all_pengajar(){
        $pengajar = $this->get_all("pengajar", "", "nama_pengajar");

        return $data;
    }

    public function load_pengajar(){
        $config = $this->get_all("config");
        
        $this->datatables->select('id_pengajar, status, username, nama_pengajar, no_hp, tgl_lahir');
        $this->datatables->from('pengajar');
        $this->datatables->add_column('menu','
            <span class="dropdown">
            <button class="btn dropdown-toggle align-text-top" data-bs-boundary="viewport" data-bs-toggle="dropdown">
                '.tablerIcon("menu-2", "me-1").'
                Menu
            </button>
            <div class="dropdown-menu dropdown-menu-end">
                <a class="dropdown-item detailPengajar" data-bs-toggle="modal" href="#detailPengajar" data-id="$1">
                    '.tablerIcon("info-circle", "me-1").'
                    Detail Pengajar
                </a>
                <a class="dropdown-item detailPengajar" target="_blank" href="https://api.whatsapp.com/send?phone=$2&text=Link%20:%20'.$config[0]['value'].'%0AUsername%20:%20$3%0APassword%20:%20$4">
                    '.tablerIcon("info-circle", "me-1").'
                    Data Login
                </a>
            </div>
            </span>', 'id_pengajar, no_hp, username, passwordGuru(tgl_lahir)');
        return $this->datatables->generate();
    }
}

/* End of file Program_model.php */
