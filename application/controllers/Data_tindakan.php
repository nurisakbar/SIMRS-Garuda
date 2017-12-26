<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Data_tindakan extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        is_login();
        $this->load->model('Tbl_tindakan_model');
        $this->load->library('form_validation');        
	$this->load->library('datatables');
    }

    public function index()
    {
        $this->template->load('template','data_tindakan/tbl_tindakan_list');
    } 
    
    public function json() {
        header('Content-Type: application/json');
        echo $this->Tbl_tindakan_model->json();
    }

    public function read($id) 
    {
        $row = $this->Tbl_tindakan_model->get_by_id($id);
        if ($row) {
            $data = array(
		'kode_tindakan' => $row->kode_tindakan,
		'jenis_tindakan' => $row->jenis_tindakan,
		'nama_tindakan' => $row->nama_tindakan,
		'kode_kategori_tindakan' => $row->kode_kategori_tindakan,
		'tarif' => $row->tarif,
		'tindakan_oleh' => $row->tindakan_oleh,
		'id_poliklinik' => $row->id_poliklinik,
	    );
            $this->template->load('template','data_tindakan/tbl_tindakan_read', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('data_tindakan'));
        }
    }

    public function create() 
    {
        $data = array(
            'button' => 'Create',
            'action' => site_url('data_tindakan/create_action'),
	    'kode_tindakan' => set_value('kode_tindakan'),
	    'jenis_tindakan' => set_value('jenis_tindakan'),
	    'nama_tindakan' => set_value('nama_tindakan'),
	    'kode_kategori_tindakan' => set_value('kode_kategori_tindakan'),
	    'tarif' => set_value('tarif'),
	    'tindakan_oleh' => set_value('tindakan_oleh'),
	    'id_poliklinik' => set_value('id_poliklinik'),
	);
        $this->template->load('template','data_tindakan/tbl_tindakan_form', $data);
    }
    
    public function create_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            $data = array(
                'kode_tindakan'=>  $this->input->post('kode_tindakan',TRUE),
		'jenis_tindakan' => $this->input->post('jenis_tindakan',TRUE),
		'nama_tindakan' => $this->input->post('nama_tindakan',TRUE),
		'kode_kategori_tindakan' => $this->input->post('kode_kategori_tindakan',TRUE),
		'tarif' => $this->input->post('tarif',TRUE),
		'tindakan_oleh' => $this->input->post('tindakan_oleh',TRUE),
		'id_poliklinik' => $this->input->post('id_poliklinik',TRUE),
	    );

            $this->Tbl_tindakan_model->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success 2');
            redirect(site_url('data_tindakan'));
        }
    }
    
    public function update($id) 
    {
        $row = $this->Tbl_tindakan_model->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('data_tindakan/update_action'),
		'kode_tindakan' => set_value('kode_tindakan', $row->kode_tindakan),
		'jenis_tindakan' => set_value('jenis_tindakan', $row->jenis_tindakan),
		'nama_tindakan' => set_value('nama_tindakan', $row->nama_tindakan),
		'kode_kategori_tindakan' => set_value('kode_kategori_tindakan', $row->kode_kategori_tindakan),
		'tarif' => set_value('tarif', $row->tarif),
		'tindakan_oleh' => set_value('tindakan_oleh', $row->tindakan_oleh),
		'id_poliklinik' => set_value('id_poliklinik', $row->id_poliklinik),
	    );
            $this->template->load('template','data_tindakan/tbl_tindakan_form', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('data_tindakan'));
        }
    }
    
    public function update_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('kode_tindakan', TRUE));
        } else {
            $data = array(
		'jenis_tindakan' => $this->input->post('jenis_tindakan',TRUE),
		'nama_tindakan' => $this->input->post('nama_tindakan',TRUE),
		'kode_kategori_tindakan' => $this->input->post('kode_kategori_tindakan',TRUE),
		'tarif' => $this->input->post('tarif',TRUE),
		'tindakan_oleh' => $this->input->post('tindakan_oleh',TRUE),
		'id_poliklinik' => $this->input->post('id_poliklinik',TRUE),
	    );

            $this->Tbl_tindakan_model->update($this->input->post('kode_tindakan', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('data_tindakan'));
        }
    }
    
    public function delete($id) 
    {
        $row = $this->Tbl_tindakan_model->get_by_id($id);

        if ($row) {
            $this->Tbl_tindakan_model->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('data_tindakan'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('data_tindakan'));
        }
    }

    public function _rules() 
    {
	$this->form_validation->set_rules('jenis_tindakan', 'jenis tindakan', 'trim|required');
	$this->form_validation->set_rules('nama_tindakan', 'nama tindakan', 'trim|required');
	$this->form_validation->set_rules('kode_kategori_tindakan', 'kode kategori tindakan', 'trim|required');
	$this->form_validation->set_rules('tarif', 'tarif', 'trim|required');
	$this->form_validation->set_rules('tindakan_oleh', 'tindakan oleh', 'trim|required');
	$this->form_validation->set_rules('id_poliklinik', 'id poliklinik', 'trim|required');

	$this->form_validation->set_rules('kode_tindakan', 'kode_tindakan', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }
    
    
    function autocomplate(){
        autocomplate_json('tbl_tindakan', 'nama_tindakan');
    }

}

/* End of file Data_tindakan.php */
/* Location: ./application/controllers/Data_tindakan.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2017-12-17 18:17:58 */
/* http://harviacode.com */