<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Supplier extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        is_login();
        $this->load->model('Tbl_supplier_model');
        $this->load->library('form_validation');        
	$this->load->library('datatables');
    }

    public function index()
    {
        $this->template->load('template','supplier/tbl_supplier_list');
    } 
    
    public function json() {
        header('Content-Type: application/json');
        echo $this->Tbl_supplier_model->json();
    }

    public function read($id) 
    {
        $row = $this->Tbl_supplier_model->get_by_id($id);
        if ($row) {
            $data = array(
		'kode_supplier' => $row->kode_supplier,
		'nama_supplier' => $row->nama_supplier,
		'alamat' => $row->alamat,
		'no_telpon' => $row->no_telpon,
	    );
            $this->template->load('template','supplier/tbl_supplier_read', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('supplier'));
        }
    }

    public function create() 
    {
        $data = array(
            'button' => 'Create',
            'action' => site_url('supplier/create_action'),
	    'kode_supplier' => set_value('kode_supplier'),
	    'nama_supplier' => set_value('nama_supplier'),
	    'alamat' => set_value('alamat'),
	    'no_telpon' => set_value('no_telpon'),
	);
        $this->template->load('template','supplier/tbl_supplier_form', $data);
    }
    
    public function create_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            $data = array(
                'kode_supplier' => $this->input->post('kode_supplier',TRUE),
		'nama_supplier' => $this->input->post('nama_supplier',TRUE),
		'alamat' => $this->input->post('alamat',TRUE),
		'no_telpon' => $this->input->post('no_telpon',TRUE),
	    );

            $this->Tbl_supplier_model->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success 2');
            redirect(site_url('supplier'));
        }
    }
    
    public function update($id) 
    {
        $row = $this->Tbl_supplier_model->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('supplier/update_action'),
		'kode_supplier' => set_value('kode_supplier', $row->kode_supplier),
		'nama_supplier' => set_value('nama_supplier', $row->nama_supplier),
		'alamat' => set_value('alamat', $row->alamat),
		'no_telpon' => set_value('no_telpon', $row->no_telpon),
	    );
            $this->template->load('template','supplier/tbl_supplier_form', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('supplier'));
        }
    }
    
    public function update_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('kode_supplier', TRUE));
        } else {
            $data = array(
		'nama_supplier' => $this->input->post('nama_supplier',TRUE),
		'alamat' => $this->input->post('alamat',TRUE),
		'no_telpon' => $this->input->post('no_telpon',TRUE),
	    );

            $this->Tbl_supplier_model->update($this->input->post('kode_supplier', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('supplier'));
        }
    }
    
    public function delete($id) 
    {
        $row = $this->Tbl_supplier_model->get_by_id($id);

        if ($row) {
            $this->Tbl_supplier_model->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('supplier'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('supplier'));
        }
    }

    public function _rules() 
    {
	$this->form_validation->set_rules('nama_supplier', 'nama supplier', 'trim|required');
	$this->form_validation->set_rules('alamat', 'alamat', 'trim|required');
	$this->form_validation->set_rules('no_telpon', 'no telpon', 'trim|required');

	$this->form_validation->set_rules('kode_supplier', 'kode_supplier', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

    public function excel()
    {
        $this->load->helper('exportexcel');
        $namaFile = "tbl_supplier.xls";
        $judul = "tbl_supplier";
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
	xlsWriteLabel($tablehead, $kolomhead++, "Nama Supplier");
	xlsWriteLabel($tablehead, $kolomhead++, "Alamat");
	xlsWriteLabel($tablehead, $kolomhead++, "No Telpon");

	foreach ($this->Tbl_supplier_model->get_all() as $data) {
            $kolombody = 0;

            //ubah xlsWriteLabel menjadi xlsWriteNumber untuk kolom numeric
            xlsWriteNumber($tablebody, $kolombody++, $nourut);
	    xlsWriteLabel($tablebody, $kolombody++, $data->nama_supplier);
	    xlsWriteLabel($tablebody, $kolombody++, $data->alamat);
	    xlsWriteLabel($tablebody, $kolombody++, $data->no_telpon);

	    $tablebody++;
            $nourut++;
        }

        xlsEOF();
        exit();
    }

    public function word()
    {
        header("Content-type: application/vnd.ms-word");
        header("Content-Disposition: attachment;Filename=tbl_supplier.doc");

        $data = array(
            'tbl_supplier_data' => $this->Tbl_supplier_model->get_all(),
            'start' => 0
        );
        
        $this->load->view('supplier/tbl_supplier_doc',$data);
    }
    
    function autocomplate(){
        autocomplate_json('tbl_supplier', 'nama_supplier');
    }

}

/* End of file Supplier.php */
/* Location: ./application/controllers/Supplier.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2017-12-11 17:19:48 */
/* http://harviacode.com */