<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Datasatuan extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        is_login();
        $this->load->model('Tbl_satuan_barang_model');
        $this->load->library('form_validation');        
	$this->load->library('datatables');
    }

    public function index()
    {
        $this->template->load('template','datasatuan/tbl_satuan_barang_list');
    } 
    
    public function json() {
        header('Content-Type: application/json');
        echo $this->Tbl_satuan_barang_model->json();
    }

    public function read($id) 
    {
        $row = $this->Tbl_satuan_barang_model->get_by_id($id);
        if ($row) {
            $data = array(
		'id_satuan' => $row->id_satuan,
		'nama_satuan' => $row->nama_satuan,
	    );
            $this->template->load('template','datasatuan/tbl_satuan_barang_read', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('datasatuan'));
        }
    }

    public function create() 
    {
        $data = array(
            'button' => 'Create',
            'action' => site_url('datasatuan/create_action'),
	    'id_satuan' => set_value('id_satuan'),
	    'nama_satuan' => set_value('nama_satuan'),
	);
        $this->template->load('template','datasatuan/tbl_satuan_barang_form', $data);
    }
    
    public function create_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            $data = array(
		'nama_satuan' => $this->input->post('nama_satuan',TRUE),
	    );

            $this->Tbl_satuan_barang_model->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success 2');
            redirect(site_url('datasatuan'));
        }
    }
    
    public function update($id) 
    {
        $row = $this->Tbl_satuan_barang_model->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('datasatuan/update_action'),
		'id_satuan' => set_value('id_satuan', $row->id_satuan),
		'nama_satuan' => set_value('nama_satuan', $row->nama_satuan),
	    );
            $this->template->load('template','datasatuan/tbl_satuan_barang_form', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('datasatuan'));
        }
    }
    
    public function update_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('id_satuan', TRUE));
        } else {
            $data = array(
		'nama_satuan' => $this->input->post('nama_satuan',TRUE),
	    );

            $this->Tbl_satuan_barang_model->update($this->input->post('id_satuan', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('datasatuan'));
        }
    }
    
    public function delete($id) 
    {
        $row = $this->Tbl_satuan_barang_model->get_by_id($id);

        if ($row) {
            $this->Tbl_satuan_barang_model->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('datasatuan'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('datasatuan'));
        }
    }

    public function _rules() 
    {
	$this->form_validation->set_rules('nama_satuan', 'nama satuan', 'trim|required');

	$this->form_validation->set_rules('id_satuan', 'id_satuan', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

    public function excel()
    {
        $this->load->helper('exportexcel');
        $namaFile = "tbl_satuan_barang.xls";
        $judul = "tbl_satuan_barang";
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
	xlsWriteLabel($tablehead, $kolomhead++, "Nama Satuan");

	foreach ($this->Tbl_satuan_barang_model->get_all() as $data) {
            $kolombody = 0;

            //ubah xlsWriteLabel menjadi xlsWriteNumber untuk kolom numeric
            xlsWriteNumber($tablebody, $kolombody++, $nourut);
	    xlsWriteLabel($tablebody, $kolombody++, $data->nama_satuan);

	    $tablebody++;
            $nourut++;
        }

        xlsEOF();
        exit();
    }

    public function word()
    {
        header("Content-type: application/vnd.ms-word");
        header("Content-Disposition: attachment;Filename=tbl_satuan_barang.doc");

        $data = array(
            'tbl_satuan_barang_data' => $this->Tbl_satuan_barang_model->get_all(),
            'start' => 0
        );
        
        $this->load->view('datasatuan/tbl_satuan_barang_doc',$data);
    }

}

/* End of file Datasatuan.php */
/* Location: ./application/controllers/Datasatuan.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2017-12-09 11:17:21 */
/* http://harviacode.com */