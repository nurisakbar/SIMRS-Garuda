<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Kategoribarang extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        is_login();
        $this->load->model('Tbl_kategori_barang_model');
        $this->load->library('form_validation');        
	$this->load->library('datatables');
    }

    public function index()
    {
        $this->template->load('template','kategoribarang/tbl_kategori_barang_list');
    } 
    
    public function json() {
        header('Content-Type: application/json');
        echo $this->Tbl_kategori_barang_model->json();
    }

    public function read($id) 
    {
        $row = $this->Tbl_kategori_barang_model->get_by_id($id);
        if ($row) {
            $data = array(
		'id_kategori_barang' => $row->id_kategori_barang,
		'nama_kategori' => $row->nama_kategori,
	    );
            $this->template->load('template','kategoribarang/tbl_kategori_barang_read', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('kategoribarang'));
        }
    }

    public function create() 
    {
        $data = array(
            'button' => 'Create',
            'action' => site_url('kategoribarang/create_action'),
	    'id_kategori_barang' => set_value('id_kategori_barang'),
	    'nama_kategori' => set_value('nama_kategori'),
	);
        $this->template->load('template','kategoribarang/tbl_kategori_barang_form', $data);
    }
    
    public function create_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            $data = array(
		'nama_kategori' => $this->input->post('nama_kategori',TRUE),
	    );

            $this->Tbl_kategori_barang_model->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success 2');
            redirect(site_url('kategoribarang'));
        }
    }
    
    public function update($id) 
    {
        $row = $this->Tbl_kategori_barang_model->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('kategoribarang/update_action'),
		'id_kategori_barang' => set_value('id_kategori_barang', $row->id_kategori_barang),
		'nama_kategori' => set_value('nama_kategori', $row->nama_kategori),
	    );
            $this->template->load('template','kategoribarang/tbl_kategori_barang_form', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('kategoribarang'));
        }
    }
    
    public function update_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('id_kategori_barang', TRUE));
        } else {
            $data = array(
		'nama_kategori' => $this->input->post('nama_kategori',TRUE),
	    );

            $this->Tbl_kategori_barang_model->update($this->input->post('id_kategori_barang', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('kategoribarang'));
        }
    }
    
    public function delete($id) 
    {
        $row = $this->Tbl_kategori_barang_model->get_by_id($id);

        if ($row) {
            $this->Tbl_kategori_barang_model->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('kategoribarang'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('kategoribarang'));
        }
    }

    public function _rules() 
    {
	$this->form_validation->set_rules('nama_kategori', 'nama kategori', 'trim|required');

	$this->form_validation->set_rules('id_kategori_barang', 'id_kategori_barang', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

    public function excel()
    {
        $this->load->helper('exportexcel');
        $namaFile = "tbl_kategori_barang.xls";
        $judul = "tbl_kategori_barang";
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
	xlsWriteLabel($tablehead, $kolomhead++, "Nama Kategori");

	foreach ($this->Tbl_kategori_barang_model->get_all() as $data) {
            $kolombody = 0;

            //ubah xlsWriteLabel menjadi xlsWriteNumber untuk kolom numeric
            xlsWriteNumber($tablebody, $kolombody++, $nourut);
	    xlsWriteLabel($tablebody, $kolombody++, $data->nama_kategori);

	    $tablebody++;
            $nourut++;
        }

        xlsEOF();
        exit();
    }

    public function word()
    {
        header("Content-type: application/vnd.ms-word");
        header("Content-Disposition: attachment;Filename=tbl_kategori_barang.doc");

        $data = array(
            'tbl_kategori_barang_data' => $this->Tbl_kategori_barang_model->get_all(),
            'start' => 0
        );
        
        $this->load->view('kategoribarang/tbl_kategori_barang_doc',$data);
    }

}

/* End of file Kategoribarang.php */
/* Location: ./application/controllers/Kategoribarang.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2017-12-09 11:12:11 */
/* http://harviacode.com */