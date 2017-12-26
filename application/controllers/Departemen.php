<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Departemen extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        is_login();
        $this->load->model('Tbl_departemen_model');
        $this->load->library('form_validation');        
	$this->load->library('datatables');
    }

    public function index()
    {
        $this->template->load('template','departemen/tbl_departemen_list');
    } 
    
    public function json() {
        header('Content-Type: application/json');
        echo $this->Tbl_departemen_model->json();
    }

    public function read($id) 
    {
        $row = $this->Tbl_departemen_model->get_by_id($id);
        if ($row) {
            $data = array(
		'id_departemen' => $row->id_departemen,
		'nama_departemen' => $row->nama_departemen,
	    );
            $this->template->load('template','departemen/tbl_departemen_read', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('departemen'));
        }
    }

    public function create() 
    {
        $data = array(
            'button' => 'Create',
            'action' => site_url('departemen/create_action'),
	    'id_departemen' => set_value('id_departemen'),
	    'nama_departemen' => set_value('nama_departemen'),
	);
        $this->template->load('template','departemen/tbl_departemen_form', $data);
    }
    
    public function create_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            $data = array(
		'nama_departemen' => $this->input->post('nama_departemen',TRUE),
	    );

            $this->Tbl_departemen_model->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success 2');
            redirect(site_url('departemen'));
        }
    }
    
    public function update($id) 
    {
        $row = $this->Tbl_departemen_model->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('departemen/update_action'),
		'id_departemen' => set_value('id_departemen', $row->id_departemen),
		'nama_departemen' => set_value('nama_departemen', $row->nama_departemen),
	    );
            $this->template->load('template','departemen/tbl_departemen_form', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('departemen'));
        }
    }
    
    public function update_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('id_departemen', TRUE));
        } else {
            $data = array(
		'nama_departemen' => $this->input->post('nama_departemen',TRUE),
	    );

            $this->Tbl_departemen_model->update($this->input->post('id_departemen', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('departemen'));
        }
    }
    
    public function delete($id) 
    {
        $row = $this->Tbl_departemen_model->get_by_id($id);

        if ($row) {
            $this->Tbl_departemen_model->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('departemen'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('departemen'));
        }
    }

    public function _rules() 
    {
	$this->form_validation->set_rules('nama_departemen', 'nama departemen', 'trim|required');

	$this->form_validation->set_rules('id_departemen', 'id_departemen', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

    public function excel()
    {
        $this->load->helper('exportexcel');
        $namaFile = "tbl_departemen.xls";
        $judul = "tbl_departemen";
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
	xlsWriteLabel($tablehead, $kolomhead++, "Nama Departemen");

	foreach ($this->Tbl_departemen_model->get_all() as $data) {
            $kolombody = 0;

            //ubah xlsWriteLabel menjadi xlsWriteNumber untuk kolom numeric
            xlsWriteNumber($tablebody, $kolombody++, $nourut);
	    xlsWriteLabel($tablebody, $kolombody++, $data->nama_departemen);

	    $tablebody++;
            $nourut++;
        }

        xlsEOF();
        exit();
    }

    public function word()
    {
        header("Content-type: application/vnd.ms-word");
        header("Content-Disposition: attachment;Filename=tbl_departemen.doc");

        $data = array(
            'tbl_departemen_data' => $this->Tbl_departemen_model->get_all(),
            'start' => 0
        );
        
        $this->load->view('departemen/tbl_departemen_doc',$data);
    }

}

/* End of file Departemen.php */
/* Location: ./application/controllers/Departemen.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2017-11-28 15:42:22 */
/* http://harviacode.com */