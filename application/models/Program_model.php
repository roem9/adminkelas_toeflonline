<?php


defined('BASEPATH') OR exit('No direct script access allowed');

class Program_model extends MY_Model {

    public function add_program(){
        $data = [];
        foreach ($_POST as $key => $value) {
            $data[$key] = $this->input->post($key);
        }

        $query = $this->add_data("program", $data);

        if($query) return 1;
        else return 0;
    }

    public function edit_program(){
        $id_program = $this->input->post("id_program");
        unset($_POST['id_program']);

        $data = [];
        foreach ($_POST as $key => $value) {
            $data[$key] = $this->input->post($key);
        }

        $query = $this->edit_data("program", ["id_program" => $id_program], $data);
        if($query) return 1;
        else return 0;
    }

    public function get_program(){
        $id_program = $this->input->post("id_program");
        $data = $this->get_one("program", ["id_program" => $id_program]);
        return $data;
    }
    
    public function get_all_program(){
        $program = $this->get_all("program", "", "nama_program");

        return $data;
    }

    public function load_program(){
        $this->datatables->select('id_program, nama_program, tgl_pembuatan, hapus,
            (select count(id_pertemuan) from pertemuan where a.id_program = id_program) as pertemuan,
        ');
        $this->datatables->from('program as a');

        $this->datatables->add_column("tgl", "$1", "tgl_indo(tgl_pembuatan)");
        $this->datatables->add_column('menu','
            <span class="dropdown">
            <button class="btn dropdown-toggle align-text-top" data-bs-boundary="viewport" data-bs-toggle="dropdown">
                '.tablerIcon("menu-2", "me-1").'
                Menu
            </button>
            <div class="dropdown-menu dropdown-menu-end">
                <a class="dropdown-item detailProgram" data-bs-toggle="modal" href="#detailProgram" data-id="$1">
                    '.tablerIcon("info-circle", "me-1").'
                    Detail Program
                </a>
                <a class="dropdown-item" href="'.base_url().'program/detail/$2">
                    '.tablerIcon("circle-plus", "me-1").'
                    Kelola Pertemuan
                </a>
            </div>
            </span>', 'id_program, md5(id_program)');

        return $this->datatables->generate();
    }

    public function add_pertemuan(){
        // memberikan urutan 
            $id_program = $this->input->post("id_program");
            $pertemuan = $this->get_one("pertemuan", ["id_program" => $id_program], "urutan", "DESC");
            if($pertemuan) {
                $urutan = $pertemuan['urutan'] + 1;
            } else {
                $urutan = 1;
            }
        // memberikan urutan 

        $data = [];
        foreach ($_POST as $key => $value) {
            $data[$key] = $this->input->post($key);
        }
        $data['urutan'] = $urutan;

        $query = $this->add_data("pertemuan", $data);

        if($query) return 1;
        else return 0;
    }

    public function edit_pertemuan(){
        $id_pertemuan = $this->input->post("id_pertemuan");
        unset($_POST['id_pertemuan']);

        $data = [];
        foreach ($_POST as $key => $value) {
            $data[$key] = $this->input->post($key);
        }

        $query = $this->edit_data("pertemuan", ["id_pertemuan" => $id_pertemuan], $data);
        if($query) return 1;
        else return 0;
    }

    public function get_pertemuan(){
        $id_pertemuan = $this->input->post("id_pertemuan");
        $data = $this->get_one("pertemuan", ["id_pertemuan" => $id_pertemuan]);
        return $data;
    }

    public function load_pertemuan(){
        $id_program = $this->input->post("id_program");

        $this->datatables->select('id_pertemuan, nama_pertemuan, tgl_pembuatan, hapus, urutan, latihan, presensi');
        $this->datatables->from('pertemuan as a');
        $this->datatables->where("md5(id_program)", $id_program);

        $this->datatables->add_column("tgl", "$1", "tgl_indo(tgl_pembuatan)");
        $this->datatables->add_column('menu','
            <span class="dropdown">
            <button class="btn dropdown-toggle align-text-top" data-bs-boundary="viewport" data-bs-toggle="dropdown">
                '.tablerIcon("menu-2", "me-1").'
                Menu
            </button>
            <div class="dropdown-menu dropdown-menu-end">
                <a class="dropdown-item detailPertemuan" data-bs-toggle="modal" href="#detailPertemuan" data-id="$1">
                    '.tablerIcon("info-circle", "me-1").'
                    Detail Pertemuan
                </a>
                <a class="dropdown-item" target="_blank" href="'.base_url().'program/detailPertemuan/$2">
                    '.tablerIcon("circle-plus", "me-1").'
                    Kelola Materi
                </a>
                <a class="dropdown-item" target="_blank" href="'.base_url().'program/detailLatihan/$2">
                    '.tablerIcon("circle-plus", "me-1").'
                    Kelola Latihan
                </a>
            </div>
            </span>', 'id_pertemuan, md5(id_pertemuan)');

        return $this->datatables->generate();
    }

    public function get_materi_pertemuan(){
        $id_materi = $this->input->post("id_materi");
        $data = $this->get_one("materi_pertemuan", ["id_materi" => $id_materi]);
        return $data;
    }

    public function edit_materi_pertemuan(){
        $id_materi = $this->input->post("id_materi");
        unset($_POST['id_materi']);

        $data = [];
        foreach ($_POST as $key => $value) {
            $data[$key] = $this->input->post($key);
        }

        $query = $this->edit_data("materi_pertemuan", ["id_materi" => $id_materi], $data);
        if($query) return 1;
        else return 0;
    }

    public function edit_urutan_materi_pertemuan(){
        $id_materi = $this->input->post("id_materi");

        $i = 1;
        foreach ($id_materi as $id_materi) {
            $this->edit_data("materi_pertemuan", ["id_materi" => $id_materi], ["urutan" => $i]);
            $i++;
        }

        return 1;
    }

    public function edit_urutan_latihan_pertemuan(){
        $id_item = $this->input->post("id_item");

        $i = 1;
        foreach ($id_item as $id_item) {
            $this->edit_data("latihan_pertemuan", ["id_item" => $id_item], ["urutan" => $i]);
            $i++;
        }

        return 1;
    }
}

/* End of file Program_model.php */
