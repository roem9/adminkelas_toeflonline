<?php

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
defined('BASEPATH') OR exit('No direct script access allowed');

class Member extends MY_Controller {

    public function index(){
        $data['title'] = 'List Member';
        $data['menu'] = "Member";
        $data['menu_dropdown'] = "listMember";
        $data['modal'] = ["modal_member", "modal_setting"];
        $data['js'] = [
            "ajax.js",
            "function.js",
            "helper.js",
            "setting.js",
            "load_data/member_reload.js",
            "modules/member.js",
        ];

        $this->load->view("pages/member/list", $data);
    }

    public function konfirmasi(){
        $data['title'] = 'List Konfirmasi Member';
        $data['menu'] = "Member";
        $data['menu_dropdown'] = "listMemberKonfirmasi";
        $data['modal'] = ["modal_member", "modal_setting"];
        $data['js'] = [
            "ajax.js",
            "function.js",
            "helper.js",
            "setting.js",
            "load_data/member_konfirmasi_reload.js",
            "modules/member.js",
        ];

        $this->load->view("pages/member/konfirmasi", $data);
    }

    public function closing(){
        $data['title'] = 'List Closing Member';
        $data['menu'] = "Member";
        $data['menu_dropdown'] = "listClosing";
        $data['modal'] = ["modal_member", "modal_setting"];
        $data['js'] = [
            "ajax.js",
            "function.js",
            "helper.js",
            "setting.js",
            "load_data/closing_reload.js",
            "modules/member.js",
        ];

        $this->load->view("pages/member/list-closing", $data);
    }

    public function load_member(){
        header('Content-Type: application/json');
        $output = $this->member->load_member();
        echo $output;
    }

    public function load_member_konfirmasi(){
        header('Content-Type: application/json');
        $output = $this->member->load_member_konfirmasi();
        echo $output;
    }

    public function load_closing(){
        header('Content-Type: application/json');
        $output = $this->member->load_closing();
        echo $output;
    }

    public function add_member(){
        $data = $this->member->add_member();
        echo json_encode($data);
    }
    
    public function get_member(){
        $id_member = $this->input->post("id_member");
 
        $data = $this->member->get_one("member", ["id_member" => $id_member]);
        echo json_encode($data);
    }
 
    public function edit_member(){
        $data = $this->member->edit_member();
        echo json_encode($data);
    }

    public function get_kelas_member(){
        $data = $this->member->get_kelas_member();
        echo json_encode($data);
    }

    public function edit_nilai_sertifikat(){
        $data = $this->member->edit_nilai_sertifikat();
        echo json_encode($data);
    }

    public function delete_wl(){
        $data = $this->member->delete_wl();
        echo json_encode($data);
    }

    public function add_kelas_member(){
        $data = $this->member->add_kelas_member();
        echo json_encode($data);
    }

    public function sertifikat($id){
        // $member = $this->member->get_one("kelas_member", ["md5(id)" => $id]);
        $this->db->from("kelas_member as a");
        $this->db->join("member as b", "a.id_member = b.id_member");
        $this->db->where("md5(id)", $id);
        $member = $this->db->get()->row_array();
        
        $defaultFontConfig = (new Mpdf\Config\FontVariables())->getDefaults();
        $fontData = $defaultFontConfig['fontdata'];
        
        $mpdf = new \Mpdf\Mpdf(['mode' => 'utf-8', 'format' => [148, 210], 'orientation' => 'L',
        // , 'margin_top' => '43', 'margin_left' => '25', 'margin_right' => '25', 'margin_bottom' => '35',
            'fontdata' => $fontData + [
                'rockb' => [
                    'R' => 'ROCKB.TTF',
                ],'rock' => [
                    'R' => 'ROCK.TTF',
                ],
                'arial' => [
                    'R' => 'arial.ttf',
                    'useOTL' => 0xFF,
                    'useKashida' => 75,
                ],
                'bodoni' => [
                    'R' => 'BOD_R.TTF',
                ],
                'calibri' => [
                    'R' => 'CALIBRI.TTF',
                ],
                'cambria' => [
                    'R' => 'CAMBRIAB.TTF',
                ],
                'montserrat' => [
                    'R' => 'Montserrat-Regular.ttf',
                ]
            ], 
        ]);

        $mpdf->SetTitle("{$member['nama']}");
        $mpdf->WriteHTML($this->load->view('pages/kelas/sertifikat', $member, TRUE));
        $mpdf->Output("{$member['nama']}.pdf", "I");
    }

    public function konfirmasi_member(){
        $data = $this->member->konfirmasi_member();
        echo json_encode($data);
    }

    public function hapus_member(){
        $data = $this->member->hapus_member();
        echo json_encode($data);
    }

    public function get_sumber_closing(){
        $data = $this->member->get_sumber_closing();
        echo json_encode($data);
    }

    public function get_detail_closing(){
        $data = $this->member->get_detail_closing();
        echo json_encode($data);
    }

    public function edit_closing(){
        $data = $this->member->edit_closing();
        echo json_encode($data);
    }

    public function print_data_closing(){
        $tgl_awal = $this->input->post("tgl_awal");
        $tgl_akhir = $this->input->post("tgl_akhir");

        $file_name = 'LIST CLOSING MEMBER ' . date('d-m-Y', strtotime($tgl_awal)) . " s.d " . date('d-m-Y', strtotime($tgl_akhir));
        
        $spreadsheet = new Spreadsheet;

        $spreadsheet->setActiveSheetIndex(0)
                    ->setCellValue('A1', 'LIST CLOSING MEMBER ' . date('d-m-Y', strtotime($tgl_awal)) . " s.d " . date('d-m-Y', strtotime($tgl_akhir)))
                    ->setCellValue('A2', 'No')
                    ->setCellValue('B2', 'Tgl. Closing')
                    ->setCellValue('C2', 'Nama')
                    ->setCellValue('D2', 'TTL')
                    ->setCellValue('E2', 'Alamat')
                    ->setCellValue('F2', 'Program')
                    ->setCellValue('G2', 'No. Handphone')
                    ->setCellValue('H2', 'Biaya')
                    ->setCellValue('I2', 'Sumber Closing');

        $spreadsheet->getActiveSheet()->mergeCells('A1:I1');

        $data_closing = $this->member->get_all("closing_member", "hapus = 0 AND (tgl_closing BETWEEN '" . $tgl_awal . "' AND '" . $tgl_akhir . "')");

        $kolom = 3;
        $nomor = 1;
        foreach($data_closing as $member) {
            $spreadsheet->setActiveSheetIndex(0)
                        ->setCellValue('A' . $kolom, $nomor)
                        ->setCellValue('B' . $kolom, $member['tgl_closing'])
                        ->setCellValue('C' . $kolom, $member['nama'])
                        ->setCellValue('D' . $kolom, $member['t4_lahir'] . ", " . tgl_indo($member['tgl_lahir']))
                        ->setCellValue('E' . $kolom, $member['alamat'])
                        ->setCellValue('F' . $kolom, $member['program'])
                        ->setCellValue('G' . $kolom, "'".$member['no_hp'])
                        ->setCellValue('H' . $kolom, $member['biaya'])
                        ->setCellValue('I' . $kolom, $member['sumber']);

            $kolom++;
            $nomor++;
        }

        foreach(range('A','I') as $columnID) {
            $spreadsheet->getActiveSheet()->getColumnDimension($columnID)
                ->setAutoSize(true);
        }

        $writer = new Xlsx($spreadsheet);

        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename="'.$file_name.'.xlsx"');
        header('Cache-Control: max-age=0');

        $writer->save('php://output');
    }
}

?>