<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Gedung extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        is_login();
        $this->load->model('Tbl_gedung_rawat_inap_model');
        $this->load->library('form_validation');        
	$this->load->library('datatables');
    }

    public function index()
    {
        $this->template->load('template','gedung/tbl_gedung_rawat_inap_list');
    } 
    
    public function json() {
        header('Content-Type: application/json');
        echo $this->Tbl_gedung_rawat_inap_model->json();
    }

    public function read($id) 
    {
        $row = $this->Tbl_gedung_rawat_inap_model->get_by_id($id);
        if ($row) {
            $data = array(
		'kode_gedung_rawat_inap' => $row->kode_gedung_rawat_inap,
		'nama_gedung' => $row->nama_gedung,
	    );
            $this->template->load('template','gedung/tbl_gedung_rawat_inap_read', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('gedung'));
        }
    }

    public function create() 
    {
        $data = array(
            'button' => 'Create',
            'action' => site_url('gedung/create_action'),
	    'kode_gedung_rawat_inap' => set_value('kode_gedung_rawat_inap'),
	    'nama_gedung' => set_value('nama_gedung'),
	);
        $this->template->load('template','gedung/tbl_gedung_rawat_inap_form', $data);
    }
    
    public function create_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            $data = array(
		'nama_gedung' => $this->input->post('nama_gedung',TRUE),
	    );

            $this->Tbl_gedung_rawat_inap_model->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success 2');
            redirect(site_url('gedung'));
        }
    }
    
    public function update($id) 
    {
        $row = $this->Tbl_gedung_rawat_inap_model->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('gedung/update_action'),
		'kode_gedung_rawat_inap' => set_value('kode_gedung_rawat_inap', $row->kode_gedung_rawat_inap),
		'nama_gedung' => set_value('nama_gedung', $row->nama_gedung),
	    );
            $this->template->load('template','gedung/tbl_gedung_rawat_inap_form', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('gedung'));
        }
    }
    
    public function update_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('kode_gedung_rawat_inap', TRUE));
        } else {
            $data = array(
		'nama_gedung' => $this->input->post('nama_gedung',TRUE),
	    );

            $this->Tbl_gedung_rawat_inap_model->update($this->input->post('kode_gedung_rawat_inap', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('gedung'));
        }
    }
    
    public function delete($id) 
    {
        $row = $this->Tbl_gedung_rawat_inap_model->get_by_id($id);

        if ($row) {
            $this->Tbl_gedung_rawat_inap_model->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('gedung'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('gedung'));
        }
    }

    public function _rules() 
    {
	$this->form_validation->set_rules('nama_gedung', 'nama gedung', 'trim|required');

	$this->form_validation->set_rules('kode_gedung_rawat_inap', 'kode_gedung_rawat_inap', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

    public function excel()
    {
        $this->load->helper('exportexcel');
        $namaFile = "tbl_gedung_rawat_inap.xls";
        $judul = "tbl_gedung_rawat_inap";
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
	xlsWriteLabel($tablehead, $kolomhead++, "Nama Gedung");

	foreach ($this->Tbl_gedung_rawat_inap_model->get_all() as $data) {
            $kolombody = 0;

            //ubah xlsWriteLabel menjadi xlsWriteNumber untuk kolom numeric
            xlsWriteNumber($tablebody, $kolombody++, $nourut);
	    xlsWriteLabel($tablebody, $kolombody++, $data->nama_gedung);

	    $tablebody++;
            $nourut++;
        }

        xlsEOF();
        exit();
    }

    public function word()
    {
        header("Content-type: application/vnd.ms-word");
        header("Content-Disposition: attachment;Filename=tbl_gedung_rawat_inap.doc");

        $data = array(
            'tbl_gedung_rawat_inap_data' => $this->Tbl_gedung_rawat_inap_model->get_all(),
            'start' => 0
        );
        
        $this->load->view('gedung/tbl_gedung_rawat_inap_doc',$data);
    }

}

/* End of file Gedung.php */
/* Location: ./application/controllers/Gedung.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2017-11-30 19:41:15 */
/* http://harviacode.com */