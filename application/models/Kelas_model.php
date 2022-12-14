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
            (select COUNT(id) from kelas_member where a.id_kelas = id_kelas AND hapus = 0) as peserta,
            (select COUNT(id) from kelas_member where a.id_kelas = id_kelas AND hapus = 0 AND no_doc != "") as sertifikat_peserta');
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
                <a class="dropdown-item detailKelas" href="'.base_url().'kelas/inbox/$2" target="_blank">
                    '.tablerIcon("send", "me-1").'
                    Ruang Diskusi
                </a>
            </div>
            </span>', 'id_kelas, md5(id_kelas)');
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

    public function get_all_inbox(){
        $id_member = $this->input->post("id_member");
        $id_kelas = $this->input->post("id_kelas");
        
        $data = $this->get_all("inbox_kelas", ["id_kelas" => $id_kelas, "id_member" => $id_member], "id", "DESC");

        return $data;
    }

    public function input_inbox(){
        $data = [
            "id_member" => $this->input->post("id_member"),
            "id_kelas" => $this->input->post("id_kelas"),
            "text" => $this->input->post("text"),
            "tabel" => $this->input->post("tabel")
        ];

        $this->edit_data("kelas_member", ["id_member" => $data['id_member'], "id_kelas" => $data['id_kelas']], [
            "baca_member" => 0,
            "baca_admin" => 1,
            "refresh_member" => 0,
            "refresh_admin" => 1
        ]);

        $query = $this->add_data("inbox_kelas", $data);
        if($query) return 1;
        else return 0;
    }

    function laporan_bulanan(){
        $this->db->select("MONTH(tgl_mulai) as month, YEAR(tgl_mulai) as year");
        $this->db->from("kelas");
        $this->db->group_by("MONTH(tgl_mulai), YEAR(tgl_mulai)");
        $this->db->order_by("tgl_mulai", "DESC");
        $periode = $this->db->get()->result_array();

        $classes = [];
        foreach ($periode as $i => $periode) {
            $classes[$i]['month'] = $periode['month'];
            $classes[$i]['year'] = $periode['year'];
            $classes[$i]['periode'] = date("F", mktime(0, 0, 0, $periode['month'] , 10)). " " . $periode['year'];
            $this->db->from("kelas");
            $this->db->where(["MONTH(tgl_mulai)" => $periode['month'], "YEAR(tgl_mulai)" => $periode['year'], "hapus" => 0]);
            $class = $this->db->get()->result_array();

            $classes[$i]['class'] = COUNT($class);
            $classes[$i]['student'] = 0;
            $classes[$i]['certificate'] = 0;
            
            foreach ($class as $class) {
                $this->db->from("kelas_member");
                $this->db->where(["id_kelas" => $class['id_kelas'], "hapus" => 0]);
                $peserta = COUNT($this->db->get()->result_array());

                $classes[$i]['student'] += $peserta;
                
                $this->db->from("kelas_member");
                $this->db->where(["id_kelas" => $class['id_kelas'], "no_doc !=" => "", "hapus" => 0]);
                $sertifikat = COUNT($this->db->get()->result_array());
                $classes[$i]['certificate'] += $sertifikat;
            }
        }

        return $classes;
    }
}
 
/* End of file Kelas_model.php */