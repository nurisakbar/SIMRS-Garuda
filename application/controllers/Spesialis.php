<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Spesialis extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        is_login();
        $this->load->model('Tbl_spesialis_model');
        $this->load->library('form_validation');        
	$this->load->library('datatables');
    }

    public function index()
    {
        $this->template->load('template','spesialis/tbl_spesialis_list');
    } 
    
    public function json() {
        header('Content-Type: application/json');
        echo $this->Tbl_spesialis_model->json();
    }

    public function read($id) 
    {
        $row = $this->Tbl_spesialis_model->get_by_id($id);
        if ($row) {
            $data = array(
		'id_spesialis' => $row->id_spesialis,
		'spesialis' => $row->spesialis,
	    );
            $this->template->load('template','spesialis/tbl_spesialis_read', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('spesialis'));
        }
    }

    public function create() 
    {
        $data = array(
            'button' => 'Create',
            'action' => site_url('spesialis/create_action'),
	    'id_spesialis' => set_value('id_spesialis'),
	    'spesialis' => set_value('spesialis'),
	);
        $this->template->load('template','spesialis/tbl_spesialis_form', $data);
    }
    
    public function create_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            $data = array(
		'spesialis' => $this->input->post('spesialis',TRUE),
	    );

            $this->Tbl_spesialis_model->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success 2');
            redirect(site_url('spesialis'));
        }
    }
    
    public function update($id) 
    {
        $row = $this->Tbl_spesialis_model->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('spesialis/update_action'),
		'id_spesialis' => set_value('id_spesialis', $row->id_spesialis),
		'spesialis' => set_value('spesialis', $row->spesialis),
	    );
            $this->template->load('template','spesialis/tbl_spesialis_form', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('spesialis'));
        }
    }
    
    public function update_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('id_spesialis', TRUE));
        } else {
            $data = array(
		'spesialis' => $this->input->post('spesialis',TRUE),
	    );

            $this->Tbl_spesialis_model->update($this->input->post('id_spesialis', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('spesialis'));
        }
    }
    
    public function delete($id) 
    {
        $row = $this->Tbl_spesialis_model->get_by_id($id);

        if ($row) {
            $this->Tbl_spesialis_model->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('spesialis'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('spesialis'));
        }
    }

    public function _rules() 
    {
	$this->form_validation->set_rules('spesialis', 'spesialis', 'trim|required');

	$this->form_validation->set_rules('id_spesialis', 'id_spesialis', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

    public function excel()
    {
        $this->load->helper('exportexcel');
        $namaFile = "tbl_spesialis.xls";
        $judul = "tbl_spesialis";
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
	xlsWriteLabel($tablehead, $kolomhead++, "Spesialis");

	foreach ($this->Tbl_spesialis_model->get_all() as $data) {
            $kolombody = 0;

            //ubah xlsWriteLabel menjadi xlsWriteNumber untuk kolom numeric
            xlsWriteNumber($tablebody, $kolombody++, $nourut);
	    xlsWriteLabel($tablebody, $kolombody++, $data->spesialis);

	    $tablebody++;
            $nourut++;
        }

        xlsEOF();
        exit();
    }

    public function word()
    {
        header("Content-type: application/vnd.ms-word");
        header("Content-Disposition: attachment;Filename=tbl_spesialis.doc");

        $data = array(
            'tbl_spesialis_data' => $this->Tbl_spesialis_model->get_all(),
            'start' => 0
        );
        
        $this->load->view('spesialis/tbl_spesialis_doc',$data);
    }

}

/* End of file Spesialis.php */
/* Location: ./application/controllers/Spesialis.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2017-11-27 18:34:40 */
/* http://harviacode.com */