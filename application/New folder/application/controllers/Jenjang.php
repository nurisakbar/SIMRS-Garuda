<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Jenjang extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        is_login();
        $this->load->model('Tbl_jenjang_model');
        $this->load->library('form_validation');        
	$this->load->library('datatables');
    }

    public function index()
    {
        $this->template->load('template','jenjang/tbl_jenjang_list');
    } 
    
    public function json() {
        header('Content-Type: application/json');
        echo $this->Tbl_jenjang_model->json();
    }

    public function read($id) 
    {
        $row = $this->Tbl_jenjang_model->get_by_id($id);
        if ($row) {
            $data = array(
		'kode_jenjang' => $row->kode_jenjang,
		'nama_jenjang' => $row->nama_jenjang,
	    );
            $this->template->load('template','jenjang/tbl_jenjang_read', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('jenjang'));
        }
    }

    public function create() 
    {
        $data = array(
            'button' => 'Create',
            'action' => site_url('jenjang/create_action'),
	    'kode_jenjang' => set_value('kode_jenjang'),
	    'nama_jenjang' => set_value('nama_jenjang'),
	);
        $this->template->load('template','jenjang/tbl_jenjang_form', $data);
    }
    
    public function create_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            $data = array(
                'kode_jenjang' => $this->input->post('kode_jenjang',TRUE),
		'nama_jenjang' => $this->input->post('nama_jenjang',TRUE),
	    );

            $this->Tbl_jenjang_model->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success 2');
            redirect(site_url('jenjang'));
        }
    }
    
    public function update($id) 
    {
        $row = $this->Tbl_jenjang_model->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('jenjang/update_action'),
		'kode_jenjang' => set_value('kode_jenjang', $row->kode_jenjang),
		'nama_jenjang' => set_value('nama_jenjang', $row->nama_jenjang),
	    );
            $this->template->load('template','jenjang/tbl_jenjang_form', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('jenjang'));
        }
    }
    
    public function update_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('kode_jenjang', TRUE));
        } else {
            $data = array(
		'nama_jenjang' => $this->input->post('nama_jenjang',TRUE),
	    );

            $this->Tbl_jenjang_model->update($this->input->post('kode_jenjang', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('jenjang'));
        }
    }
    
    public function delete($id) 
    {
        $row = $this->Tbl_jenjang_model->get_by_id($id);

        if ($row) {
            $this->Tbl_jenjang_model->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('jenjang'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('jenjang'));
        }
    }

    public function _rules() 
    {
	$this->form_validation->set_rules('nama_jenjang', 'nama jenjang', 'trim|required');

	$this->form_validation->set_rules('kode_jenjang', 'kode_jenjang', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

    public function excel()
    {
        $this->load->helper('exportexcel');
        $namaFile = "tbl_jenjang.xls";
        $judul = "tbl_jenjang";
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
	xlsWriteLabel($tablehead, $kolomhead++, "Nama Jenjang");

	foreach ($this->Tbl_jenjang_model->get_all() as $data) {
            $kolombody = 0;

            //ubah xlsWriteLabel menjadi xlsWriteNumber untuk kolom numeric
            xlsWriteNumber($tablebody, $kolombody++, $nourut);
	    xlsWriteLabel($tablebody, $kolombody++, $data->nama_jenjang);

	    $tablebody++;
            $nourut++;
        }

        xlsEOF();
        exit();
    }

    public function word()
    {
        header("Content-type: application/vnd.ms-word");
        header("Content-Disposition: attachment;Filename=tbl_jenjang.doc");

        $data = array(
            'tbl_jenjang_data' => $this->Tbl_jenjang_model->get_all(),
            'start' => 0
        );
        
        $this->load->view('jenjang/tbl_jenjang_doc',$data);
    }

}

/* End of file Jenjang.php */
/* Location: ./application/controllers/Jenjang.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2017-11-28 11:46:20 */
/* http://harviacode.com */