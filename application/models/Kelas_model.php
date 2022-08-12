<?php
 
 
defined('BASEPATH') OR exit('No direct script access allowed');
 
class Kelas_model extends MY_Model {
 
    public function add_kelas(){
        $data = [];
        foreach ($_POST as $key => $value) {
            $data[$key] = $this->input->post($key);
        }
 
        $query = $this->add_data("kelas", $data);
 
        if($query) return 1;
        else return 0;
    }
 
    public function edit_kelas(){
        $id_kelas = $this->input->post("id_kelas");
        unset($_POST['id_kelas']);
 
        $data = [];
        foreach ($_POST as $key => $value) {
            $data[$key] = $this->input->post($key);
        }
 
        $query = $this->edit_data("kelas", ["id_kelas" => $id_kelas], $data);
        if($query) return 1;
        else return 0;
    }
 
    public function get_kelas(){
        $id_kelas = $this->input->post("id_kelas");
        $data = $this->get_one("kelas", ["id_kelas" => $id_kelas]);
        return $data;
    }
 
    public function get_all_kelas(){
        $kelas = $this->get_all("kelas", "", "nama_kelas");
 
        return $data;
    }
 
    public function load_kelas(){
        $status = $this->input->post("status");
        $this->datatables->select('a.id_kelas, a.status, DATE_FORMAT(tgl_mulai, "%d %M %Y") as tgl_mulai, nama_kelas, program,
            (select COUNT(id) from kelas_member where a.id_kelas = id_kelas AND hapus = 0) as peserta');
        $this->datatables->from('kelas as a');
        $this->datatables->where('a.status', $status);
        $this->datatables->add_column('menu','
            <span class="dropdown">
            <button class="btn dropdown-toggle align-text-top" data-bs-boundary="viewport" data-bs-toggle="dropdown">
                '.tablerIcon("menu-2", "me-1").'
                Menu
            </button>
            <div class="dropdown-menu dropdown-menu-end">
                <a class="dropdown-item detailKelas" data-bs-toggle="modal" href="#detailKelas" data-id="$1">
                    '.tablerIcon("info-circle", "me-1").'
                    Detail Kelas
                </a>
            </div>
            </span>', 'id_kelas');
        return $this->datatables->generate();
    }

    public function load_wl(){
        $this->datatables->select('id, a.id_member, DATE_FORMAT(a.tgl_input, "%d %M %Y") as tgl_input, a.nama, program, username');
        $this->datatables->from('kelas_member as a');
        $this->datatables->join('member as b', 'a.id_member = b.id_member');
        $this->datatables->where(['a.hapus' => 0, 'id_kelas' => NULL, 'b.username <>' => '']);
        $this->datatables->add_column('menu','
            <span class="dropdown">
            <button class="btn dropdown-toggle align-text-top" data-bs-boundary="viewport" data-bs-toggle="dropdown">
                '.tablerIcon("menu-2", "me-1").'
                Menu
            </button>
            <div class="dropdown-menu dropdown-menu-end">
                <a class="dropdown-item inputKelas" data-bs-toggle="modal" href="#inputKelas" data-id="$1">
                    '.tablerIcon("book", "me-1").'
                    Input Kelas
                </a>
                <a class="dropdown-item deleteWl" href="javascript:void(0)" data-id="$1|$2|$3">
                    '.tablerIcon("trash", "me-1").'
                    Hapus
                </a>
            </div>
            </span>', 'id, nama, program');
        return $this->datatables->generate();
    }

    public function delete_wl(){
        $id = $this->input->post("id");
        $data = $this->edit_data("kelas_member", ["id" => $id], ["hapus" => 1]);
        $data = $this->edit_data("closing_member", ["id_kelas_member" => $id], ["hapus" => 1]);

        if($data) return 1;
        else return 0;
    }

    public function get_wl(){
        $id = $this->input->post("id");
        $data = $this->get_one("kelas_member", ["id" => $id]);

        return $data;
    }

    public function list_kelas(){
        $program = $this->input->post("program");
        $kelas = $this->get_all("kelas", ["program" => $program, "hapus" => 0, "status" => "aktif"]);
        $data = [];

        foreach ($kelas as $i => $kelas) {
            $data[$i] = $kelas;
            $data[$i]['peserta'] = COUNT($this->get_all("kelas_member", ["id_kelas" => $kelas['id_kelas'], "hapus" => 0]));
        }

        return $data;
    }

    public function input_kelas(){
        $id = $this->input->post("id");
        $id_kelas = $this->input->post("id_kelas");

        $query = $this->edit_data("kelas_member", ["id" => $id], ["id_kelas" => $id_kelas]);
        if($query) return 1;
        else return 0;
    }

    public function get_peserta_kelas(){
        $id_kelas = $this->input->post("id_kelas");

        $data = [];

        $this->db->from("kelas_member as a");
        $this->db->join("member as b", "a.id_member = b.id_member");
        $this->db->where(["id_kelas" => $id_kelas, "a.hapus" => 0]);
        $this->db->order_by("b.nama");
        $peserta = $this->db->get()->result_array();
        
        foreach ($peserta as $i => $peserta) {
            $data[$i] = $peserta;
            $data[$i]['link'] = md5($peserta['id']);
        }

        return $data;
    }

    public function get_peserta_wl(){
        $program = $this->input->post("program");

        $this->db->select("id, a.id_member, program, a.nama, nilai");
        $this->db->from("kelas_member as a");
        $this->db->join("member as b", "a.id_member = b.id_member");
        $this->db->where(["program" => $program, 'id_kelas' => NULL, "a.hapus" => 0, "b.username <>" => ""]);
        $this->db->order_by("a.nama");
        return $this->db->get()->result_array();
    }

    public function remove_peserta(){
        $id = $this->input->post("id");

        $query = $this->edit_data("kelas_member", ["id" => $id], ["id_kelas" => NULL]);
        if($query) return 1;
        else return 0;
    }

    public function get_config(){
        $id = $this->input->post("id");
        $config = $this->get_one("config", ["id" => $id]);
        return $config;
    }

    public function edit_config(){
        $id = $this->input->post("id");
        $value = $this->input->post("value");

        $data = $this->edit_data("config", ["id" => $id], ["value" => $value]);
        return $data;
    }
}
 
/* End of file Kelas_model.php */