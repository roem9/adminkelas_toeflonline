<?php
    function tablerIcon($icon, $margin = ""){
        return '
            <svg width="24" height="24" class="'.$margin.'">
                <use xlink:href="'.base_url().'assets/tabler-icons-1.39.1/tabler-sprite.svg#tabler-'.$icon.'" />
            </svg>';
    }

    function passwordGuru($tgl){
        return date('dmY', strtotime($tgl));
    }

    function jumlah_kelas($id_member){
        $CI =& get_instance();
        $CI->db->select("COUNT(id) as jumlah_kelas");
        $CI->db->from("kelas_member as a");
        $CI->db->where(["id_member" => $id_member, "id_kelas <>" => NULL, "hapus" => 0]);
        $data = $CI->db->get()->row_array();
        return $data['jumlah_kelas'];
    }

    function jumlah_wl($id_member){
        $CI =& get_instance();
        $CI->db->select("COUNT(id) as jumlah_kelas");
        $CI->db->from("kelas_member as a");
        $CI->db->where(["id_member" => $id_member, "id_kelas" => NULL, "hapus" => 0]);
        $data = $CI->db->get()->row_array();
        return $data['jumlah_kelas'];
    }

    function listProgram(){
        $CI =& get_instance();
        $CI->db->from("program");
        $CI->db->where(["hapus" => 0]);
        $CI->db->order_by("nama_program");
        $data = $CI->db->get()->result_array();
        return $data;
    }

    function listPengajar(){
        $CI =& get_instance();
        $CI->db->from("pengajar");
        $CI->db->where(["status" => "aktif"]);
        $CI->db->order_by("nama_pengajar");
        $data = $CI->db->get()->result_array();
        return $data;
    }

    function listKelas(){
        $CI =& get_instance();
        $CI->db->select("id_kelas, nama_kelas, status, hapus, (select count(id) from kelas_member where a.id_kelas = id_kelas AND hapus = 0) as member");
        $CI->db->from("kelas as a");
        $CI->db->where(["hapus" => 0, "status" => "aktif"]);
        $CI->db->order_by("nama_kelas");
        $data = $CI->db->get()->result_array();
        return $data;
    }

    function rupiah_to_int($value){
        $value = str_replace("Rp. ", "", $value);
        $value = str_replace(".", "", $value);
        return $value;
    }

    function tgl_indo($tgl, $lengkap = ""){
        $data = explode("-", $tgl);
        $hari = $data[2];
        $bulan = $data[1];
        $tahun = $data[0];

        if($bulan == "01") $bulan = "Januari";
        if($bulan == "02") $bulan = "Februari";
        if($bulan == "03") $bulan = "Maret";
        if($bulan == "04") $bulan = "April";
        if($bulan == "05") $bulan = "Mei";
        if($bulan == "06") $bulan = "Juni";
        if($bulan == "07") $bulan = "Juli";
        if($bulan == "08") $bulan = "Agustus";
        if($bulan == "09") $bulan = "September";
        if($bulan == "10") $bulan = "Oktober";
        if($bulan == "11") $bulan = "November";
        if($bulan == "12") $bulan = "Desember";

        if($lengkap == "lengkap"){
            return hari_ini(date("D", strtotime($tgl))) . ", " . $hari . " " . $bulan . " " . $tahun;
        } else {
            return $hari . " " . $bulan . " " . $tahun;
        }
    }

    function pertemuan_program($id_program){
        $CI =& get_instance();
        $CI->db->from("pertemuan");
        $CI->db->where(["id_program" => $id_program, "hapus" => 0]);
        $CI->db->order_by("urutan");
        
        $program = $CI->db->get()->result_array();

        return $program;
    }

    function link_config($link){
        $CI =& get_instance();
        $CI->db->from("config");
        $CI->db->where(["field" => $link]);
        
        $link = $CI->db->get()->row_array();

        return $link['value'];
    }

    function waktuInbox($id_member, $id_kelas){
        $CI =& get_instance();
        $CI->db->from("inbox_kelas");
        $CI->db->where(["id_member" => $id_member, "id_kelas" => $id_kelas]);
        $CI->db->order_by("tgl_input", "DESC");
        
        $time = $CI->db->get()->row_array();

        if($time) return date("h:i d-m-y", strtotime($time['tgl_input']));
        else return "-";
    }

    function jumlah_soal($id_pertemuan){
        $CI =& get_instance();
        $CI->db->from("latihan_pertemuan");
        $CI->db->where("id_pertemuan = '$id_pertemuan' AND (item = 'soal' OR item = 'soal esai')");
        
        $soal = $CI->db->get()->result_array();
        return COUNT($soal);
    }

    function poin_toefl($tipe, $soal){
        $CI =& get_instance();
        $CI->db->from("nilai_toefl");
        $CI->db->where(["tipe" => $tipe, "soal" => $soal]);
        $data = $CI->db->get()->row_array();
        return $data['poin'];
    }

    function totalPeserta(){
        $CI =& get_instance();
        $CI->db->from("kelas_member");
        $CI->db->where(["hapus" => 0]);
        $data = $CI->db->get()->result_array();
        return count($data);
    }

    function totalSertifikat(){
        $CI =& get_instance();
        $CI->db->from("kelas_member");
        $CI->db->where(["hapus" => 0, "no_doc !=" => ""]);
        $data = $CI->db->get()->result_array();
        return count($data);
    }