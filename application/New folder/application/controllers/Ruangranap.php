<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Ruangranap extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        is_login();
        $this->load->model('Tbl_ruang_rawat_inap_model');
        $this->load->library('form_validation');        
	$this->load->library('datatables');
    }

    public function index()
    {
        $this->template->load('template','ruangranap/tbl_ruang_rawat_inap_list');
    } 
    
    public function json() {
        header('Content-Type: application/json');
        echo $this->Tbl_ruang_rawat_inap_model->json();
    }

    public function read($id) 
    {
        $row = $this->Tbl_ruang_rawat_inap_model->get_by_id($id);
        if ($row) {
            $data = array(
		'kode_ruang_rawat_inap' => $row->kode_ruang_rawat_inap,
		'kode_gedung_rawat_inap' => $row->kode_gedung_rawat_inap,
		'nama_ruangan' => $row->nama_ruangan,
		'kelas' => $row->kelas,
		'tarif' => $row->tarif,
	    );
            $this->template->load('template','ruangranap/tbl_ruang_rawat_inap_read', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('ruangranap'));
        }
    }

    public function create() 
    {
        $data = array(
            'button' => 'Create',
            'action' => site_url('ruangranap/create_action'),
	    'kode_ruang_rawat_inap' => set_value('kode_ruang_rawat_inap'),
	    'kode_gedung_rawat_inap' => set_value('kode_gedung_rawat_inap'),
	    'nama_ruangan' => set_value('nama_ruangan'),
	    'kelas' => set_value('kelas'),
	    'tarif' => set_value('tarif'),
	);
        $this->template->load('template','ruangranap/tbl_ruang_rawat_inap_form', $data);
    }
    
    public function create_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            $data = array(
                'kode_ruang_rawat_inap'=>  $this->input->post('kode_ruang_rawat_inap'),
		'kode_gedung_rawat_inap' => $this->input->post('kode_gedung_rawat_inap',TRUE),
		'nama_ruangan' => $this->input->post('nama_ruangan',TRUE),
		'kelas' => $this->input->post('kelas',TRUE),
		'tarif' => $this->input->post('tarif',TRUE),
	    );

            $this->Tbl_ruang_rawat_inap_model->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success 2');
            redirect(site_url('ruangranap'));
        }
    }
    
    public function update($id) 
    {
        $row = $this->Tbl_ruang_rawat_inap_model->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('ruangranap/update_action'),
		'kode_ruang_rawat_inap' => set_value('kode_ruang_rawat_inap', $row->kode_ruang_rawat_inap),
		'kode_gedung_rawat_inap' => set_value('kode_gedung_rawat_inap', $row->kode_gedung_rawat_inap),
		'nama_ruangan' => set_value('nama_ruangan', $row->nama_ruangan),
		'kelas' => set_value('kelas', $row->kelas),
		'tarif' => set_value('tarif', $row->tarif),
	    );
            $this->template->load('template','ruangranap/tbl_ruang_rawat_inap_form', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('ruangranap'));
        }
    }
    
    public function update_action() 
    {
        

        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('kode_ruang_rawat_inap', TRUE));
        } else {
            $data = array(
		'kode_gedung_rawat_inap' => $this->input->post('kode_gedung_rawat_inap',TRUE),
		'nama_ruangan' => $this->input->post('nama_ruangan',TRUE),
		'kelas' => $this->input->post('kelas',TRUE),
		'tarif' => $this->input->post('tarif',TRUE),
	    );

            $this->Tbl_ruang_rawat_inap_model->update($this->input->post('kode_ruang_rawat_inap', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('ruangranap'));
        }
    }
    
    public function delete($id) 
    {
        $row = $this->Tbl_ruang_rawat_inap_model->get_by_id($id);

        if ($row) {
            $this->Tbl_ruang_rawat_inap_model->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('ruangranap'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('ruangranap'));
        }
    }

    public function _rules() 
    {
	$this->form_validation->set_rules('kode_gedung_rawat_inap', 'kode gedung rawat inap', 'trim|required');
	$this->form_validation->set_rules('nama_ruangan', 'nama ruangan', 'trim|required');
	$this->form_validation->set_rules('kelas', 'kelas', 'trim|required');
	$this->form_validation->set_rules('tarif', 'tarif', 'trim|required');

	$this->form_validation->set_rules('kode_ruang_rawat_inap', 'kode_ruang_rawat_inap', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

    public function excel()
    {
        $this->load->helper('exportexcel');
        $namaFile = "tbl_ruang_rawat_inap.xls";
        $judul = "tbl_ruang_rawat_inap";
        $tablehead = 0;
        $tablebody = 1;
        $nourut = 1;
        //penulisan header
        header("Pragma: public");
        header("Expires: 0");
        header("Cache-Control: must-revalidate, post-check=0,pre-check=0");
        header("Content-Type: application/force-download");
        header("Content-Type: application/octet-stream");
        header("Content-Type: application/download");
        header("Content-Disposition: attachment;filename=" . $namaFile . "");
        header("Content-Transfer-Encoding: binary ");

        xlsBOF();

        $kolomhead = 0;
        xlsWriteLabel($tablehead, $kolomhead++, "No");
	xlsWriteLabel($tablehead, $kolomhead++, "Kode Gedung Rawat Inap");
	xlsWriteLabel($tablehead, $kolomhead++, "Nama Ruangan");
	xlsWriteLabel($tablehead, $kolomhead++, "Kelas");
	xlsWriteLabel($tablehead, $kolomhead++, "Tarif");

	foreach ($this->Tbl_ruang_rawat_inap_model->get_all() as $data) {
            $kolombody = 0;

            //ubah xlsWriteLabel menjadi xlsWriteNumber untuk kolom numeric
            xlsWriteNumber($tablebody, $kolombody++, $nourut);
	    xlsWriteLabel($tablebody, $kolombody++, $data->kode_gedung_rawat_inap);
	    xlsWriteLabel($tablebody, $kolombody++, $data->nama_ruangan);
	    xlsWriteLabel($tablebody, $kolombody++, $data->kelas);
	    xlsWriteNumber($tablebody, $kolombody++, $data->tarif);

	    $tablebody++;
            $nourut++;
        }

        xlsEOF();
        exit();
    }

    public function word()
    {
        header("Content-type: application/vnd.ms-word");
        header("Content-Disposition: attachment;Filename=tbl_ruang_rawat_inap.doc");

        $data = array(
            'tbl_ruang_rawat_inap_data' => $this->Tbl_ruang_rawat_inap_model->get_all(),
            'start' => 0
        );
        
        $this->load->view('ruangranap/tbl_ruang_rawat_inap_doc',$data);
    }

}

/* End of file Ruangranap.php */
/* Location: ./application/controllers/Ruangranap.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2017-11-30 19:44:55 */
/* http://harviacode.com */