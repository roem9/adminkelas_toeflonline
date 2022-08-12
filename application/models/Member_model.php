<?php


defined('BASEPATH') OR exit('No direct script access allowed');

class Member_model extends MY_Model {

    public function username($tgl){
        $bulan = date("m", strtotime($tgl));
        $tahun = date("Y", strtotime($tgl));

        $this->db->select("substr(username, 5, 4) as id");
        $this->db->from("member");
        $this->db->where("YEAR(tgl_masuk) = $tahun");
        $this->db->order_by("id", "DESC");
        $username = $this->db->get()->row_array();

        if($username){
            $id = $username['id'] + 1;
        } else {
            $id = 1;
        }

        if($id >= 1 && $id < 10){
            $user = date('ym', strtotime($tgl))."000".$id;
        } else if($id >= 10 && $id < 100){
            $user = date('ym', strtotime($tgl))."00".$id;
        } else if($id >= 100 && $id < 1000){
            $user = date('ym', strtotime($tgl))."0".$id;
        } else {
            $user = date('ym', strtotime($tgl)).$id;
        }
        return $user;
    }
    
    public function add_member(){
        $data = [];
        foreach ($_POST as $key => $value) {
            $data[$key] = $this->input->post($key);
        }

        $username = $this->username($_POST['tgl_masuk']);

        $data['username'] = $username;
        $data['konfirm'] = 1;

        $query = $this->add_data("member", $data);

        if($query) return 1;
        else return 0;
    }

    public function edit_member(){
        $id_member = $this->input->post("id_member");
        unset($_POST['id_member']);

        $data = [];
        foreach ($_POST as $key => $value) {
            $data[$key] = $this->input->post($key);
        }

        $query = $this->edit_data("member", ["id_member" => $id_member], $data);
        if($query) return 1;
        else return 0;
    }

    public function get_member(){
        $id_member = $this->input->post("id_member");
        $data = $this->get_one("member", ["id_member" => $id_member]);
        return $data;
    }

    public function get_all_member(){
        $member = $this->get_all("member", "", "nama_member");
        return $data;
    }

    public function load_member(){
        $config = $this->get_all("config");
        
        $this->datatables->select('a.id_member, a.username, a.nama, a.no_hp, a.tgl_lahir,
            (select COUNT(id) from kelas_member as b where a.id_member = id_member AND b.hapus = 0 AND id_kelas IS NOT NULL) as kelas, 
            (select COUNT(id) from kelas_member as b where a.id_member = id_member AND b.hapus = 0 AND id_kelas IS NULL) as wl');
        $this->datatables->from('member as a');
        $this->datatables->where(['a.username <>' => "", "konfirm" => 1, "hapus" => 0]);
        // $this->datatables->add_column('kelas', '$1', 'jumlah_kelas(id_member)');
        // $this->datatables->add_column('wl', '$1', 'jumlah_wl(id_member)');
        $this->datatables->add_column('login', '<a class="btn btn-success" target="_blank" href="https://api.whatsapp.com/send?phone=$2&text=Link%20:%20'.$config[1]['value'].'%0AUsername%20:%20$3%0APassword%20:%20$4">
            '.tablerIcon("key", "p-0 m-0").'
        </a>', 'id_member, no_hp, username, passwordGuru(tgl_lahir)');

        $this->datatables->add_column('menu','
            <span class="dropdown">
            <button class="btn dropdown-toggle align-text-top" data-bs-boundary="viewport" data-bs-toggle="dropdown">
                '.tablerIcon("menu-2", "me-1").'
                Menu
            </button>
            <div class="dropdown-menu dropdown-menu-end">
                <a class="dropdown-item detailMember" data-bs-toggle="modal" href="#detailMember" data-id="$1">
                    '.tablerIcon("info-circle", "me-1").'
                    Detail Member
                </a>
            </div>
            </span>', 'id_member, no_hp, username, passwordGuru(tgl_lahir)');
        return $this->datatables->generate();
    }

    public function load_member_konfirmasi(){
        $config = $this->get_all("config");
        
        $this->datatables->select('a.id_member, a.username, a.nama, a.no_hp, a.tgl_lahir,
            (select COUNT(id) from kelas_member as b where a.id_member = id_member AND b.hapus = 0 AND id_kelas IS NOT NULL) as kelas, 
            (select COUNT(id) from kelas_member as b where a.id_member = id_member AND b.hapus = 0 AND id_kelas IS NULL) as wl');
        $this->datatables->from('member as a');
        $this->datatables->where(['a.username' => '', 'konfirm' => 0, "hapus" => 0]);
        // $this->datatables->add_column('kelas', '$1', 'jumlah_kelas(id_member)');
        // $this->datatables->add_column('wl', '$1', 'jumlah_wl(id_member)');
        $this->datatables->add_column('login', '<a class="btn btn-success" target="_blank" href="https://api.whatsapp.com/send?phone=$2&text=Link%20:%20'.$config[1]['value'].'%0AUsername%20:%20$3%0APassword%20:%20$4">
            '.tablerIcon("key", "p-0 m-0").'
        </a>', 'id_member, no_hp, username, passwordGuru(tgl_lahir)');

        $this->datatables->add_column('menu','
            <span class="dropdown">
            <button class="btn dropdown-toggle align-text-top" data-bs-boundary="viewport" data-bs-toggle="dropdown">
                '.tablerIcon("menu-2", "me-1").'
                Menu
            </button>
            <div class="dropdown-menu dropdown-menu-end">
                <a class="dropdown-item detailMember" data-bs-toggle="modal" href="#detailMember" data-id="$1">
                    '.tablerIcon("info-circle", "me-1").'
                    Detail Member
                </a>
                <a class="dropdown-item konfirmasiMember" href="javascript:void(0)" data-id="$1|$5">
                    '.tablerIcon("circle-check", "me-1").'
                    Konfirmasi Member
                </a>
                <a class="dropdown-item deleteMember" href="javascript:void(0)" data-id="$1|$5">
                    '.tablerIcon("trash", "me-1").'
                    Hapus Member
                </a>
            </div>
            </span>', 'id_member, no_hp, username, passwordGuru(tgl_lahir), nama');
        return $this->datatables->generate();
    }

    public function load_closing(){
        $config = $this->get_all("config");
        
        $this->datatables->select('id, tgl_closing, nama, program, no_hp, biaya, sumber');
        $this->datatables->from('closing_member as a');
        $this->datatables->where(["hapus" => 0]);
        $this->datatables->add_column('menu','
            <span class="dropdown">
            <button class="btn dropdown-toggle align-text-top" data-bs-boundary="viewport" data-bs-toggle="dropdown">
                '.tablerIcon("menu-2", "me-1").'
                Menu
            </button>
            <div class="dropdown-menu dropdown-menu-end">
                <a class="dropdown-item detailClosing" data-bs-toggle="modal" href="#detailClosing" data-id="$1">
                    '.tablerIcon("info-circle", "me-1").'
                    Detail Closing
                </a>
            </div>
            </span>', 'id');
        return $this->datatables->generate();
    }

    public function get_kelas_member(){
        $id_member = $this->input->post("id_member");
        $kelas = $this->get_all("kelas_member", ["id_member" => $id_member, "id_kelas <>" => NULL, "hapus" => 0], "id");
        $data = [];
        foreach ($kelas as $i => $kelas) {
            $data['kelas'][$i] = $kelas;
            $data['kelas'][$i]['link'] = md5($kelas['id']);
            $data['kelas'][$i]['detail'] = $this->get_one("kelas", ["id_kelas" => $kelas['id_kelas']]);
        }

        
        $kelas = $this->get_all("kelas_member", ["id_member" => $id_member, "id_kelas" => NULL, "hapus" => 0], "id");
        foreach ($kelas as $i => $kelas) {
            $data['wl'][$i] = $kelas;
        }

        return $data;
    }

    public function edit_nilai_sertifikat(){
        $id = $this->input->post("id");
        $nilai = $this->input->post("nilai");

        $data = $this->edit_data("kelas_member", ["id" => $id], ["nilai" => $nilai]);
        if($data) return 1;
        else return 0;
    }

    public function delete_wl(){
        $id = $this->input->post("id");

        $data = $this->edit_data("kelas_member", ["id" => $id], ["hapus" => 1]);
        if($data) return 1;
        else return 0;
    }

    public function add_kelas_member(){
        $data['id_member'] = $this->input->post("id_member");
        $data['id_kelas'] = $this->input->post("id_kelas");
        $data['program'] = $this->input->post("program");
        
        $id = $this->add_data("kelas_member", $data);

        // cari pertemuan pertama dari setiap program kemudian inputkan ke pertemuan kelas 
        $this->db->select("*");
        $this->db->from("pertemuan as a");
        $this->db->join("program as b", "a.id_program = b.id_program");
        $this->db->where(["urutan" => 1, "nama_program" => $data['program']]);
        $pertemuan = $this->db->get()->row_array();

        // tambahkan data pertemuan pertama (cek my_model.php)
        $query = $this->add_data("pertemuan_kelas_member", [
            "id_kelas" => $data['id_kelas'],
            "id_member" => $data['id_member'],
            "id_pertemuan" => $pertemuan['id_pertemuan'],
            "selesai" => "Belum Selesai"
        ]);

        $link_member = $this->get_one("config", ["field" => "web_member"]);
        $folder_member = $this->get_one("config", ["field" => "folder_member"]);
        
        $this->load->library('qrcode/ciqrcode'); //pemanggilan library QR CODE

        $config['cacheable']    = true; //boolean, the default is true
        $config['cachedir']     = "../".$folder_member['value']."/assets/"; //string, the default is application/cache/
        $config['errorlog']     = "../".$folder_member['value']."/assets/"; //string, the default is application/logs/
        $config['imagedir']     = "../".$folder_member['value']."/assets/qrcode/"; //direktori penyimpanan qr code
        $config['quality']      = true; //boolean, the default is true
        $config['size']         = '1024'; //interger, the default is 1024
        $config['black']        = array(224,255,255); // array, default is array(255,255,255)
        $config['white']        = array(70,130,180); // array, default is array(0,0,0)
        $this->ciqrcode->initialize($config);

        $image_name=$id.'.png'; //buat name dari qr code sesuai dengan nim

        $params['data'] = $link_member['value']."/sertifikat/no/".md5($id); //data yang akan di jadikan QR CODE
        $params['level'] = 'H'; //H=High
        $params['size'] = 10;
        $params['savename'] = FCPATH.$config['imagedir'].$image_name; //simpan image QR CODE ke folder assets/images/
        $this->ciqrcode->generate($params); // fungsi untuk generate QR CODE

        if($query) $result = 1;
        else $result = 0;

        return $result;
    }

    public function konfirmasi_member(){
        $id_member = $this->input->post("id_member");
        $member = $this->get_one("member", ["id_member" => $id_member]);

        $kelas_member = $this->get_all("kelas_member", ["id_member" => $id_member, "hapus" => 0]);
        if($kelas_member) {

            $username = $this->username($member['tgl_masuk']);
            
            $query = $this->edit_data("member", ["id_member" => $id_member], ["konfirm" => 1, "username" => $username]);
            if($query) return 1;
            else return 0;
        } else {
            return 2;
        }
    }

    public function hapus_member(){
        $id_member = $this->input->post("id_member");

        $data = $this->edit_data("member", ["id_member" => $id_member], ["hapus" => 1]);
        if($data) return 1;
        else return 0;
    }

    public function get_sumber_closing(){
        $data = $this->get_all("sumber_closing", "", "sumber");
        return $data;
    }

    public function get_detail_closing(){
        $id = $this->input->post("id");
        $data = $this->get_one("closing_member", ["id" => $id]);
        return $data;
    }

    public function edit_closing(){
        $id = $this->input->post("id");

        $biaya = rupiah_to_int($this->input->post("biaya"));
        $sumber = $this->input->post("sumber");
        $sumber_lainnya = $this->input->post("sumber_lainnya");

        if($sumber == "Lainnya") {
            $sumber = $sumber_lainnya;
            $this->add_data("sumber_closing", ["sumber" => $sumber]);
        }

        $query = $this->edit_data("closing_member", ["id" => $id], ["sumber" => $sumber, "biaya" => $biaya]);
        if($query) return 1;
        else return 0;
    }
}

/* End of file Program_model.php */
