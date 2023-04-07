<?php
 
 
defined('BASEPATH') OR exit('No direct script access allowed');
 
class Inbox_model extends MY_Model { 
    public function load_inbox(){
        $this->datatables->select('b.nama, a.id_member, a.id_kelas, a.program, a.baca_admin, 
        (SELECT MAX(tgl_input) FROM inbox_kelas WHERE id_member = a.id_member AND id_kelas = a.id_kelas) as tgl_input');
        $this->datatables->from('kelas_member as a');
        $this->datatables->join('member as b', "a.id_member = b.id_member");
        $this->datatables->where('a.hapus', 0);
        $this->datatables->add_column('link',base_url().'kelas/inbox_peserta/$1/$2', 'md5(id_kelas), md5(id_member)');
        return $this->datatables->generate();
    }

    public function get_all_inbox(){
        $id_member = $this->input->post("id_member");
        $id_kelas = $this->input->post("id_kelas");
        
        $data = $this->get_all("inbox_kelas", ["id_kelas" => $id_kelas, "id_member" => $id_member], "id", "DESC");

        return $data;
    }

    function waktuInbox($id_member, $id_kelas){
        $CI =& get_instance();
        $CI->db->from("inbox_kelas");
        $CI->db->where(["id_member" => $id_member, "id_kelas" => $id_kelas], "DESC");
        
        $time = $CI->db->get()->row_array();

        if($time) return date("h:i d-m-y", strtotime($time['tgl_input']));
        else return "-";
    }
}
 
/* End of file Kelas_model.php */