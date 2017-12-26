<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Pasien extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        is_login();
        $this->load->model('Tbl_pasien_model');
        $this->load->library('form_validation');
    }

    public function index()
    {
        $q = urldecode($this->input->get('q', TRUE));
        $start = intval($this->input->get('start'));
        
        if ($q <> '') {
            $config['base_url'] = base_url() . 'pasien/index.html?q=' . urlencode($q);
            $config['first_url'] = base_url() . 'pasien/index.html?q=' . urlencode($q);
        } else {
            $config['base_url'] = base_url() . 'pasien/index.html';
            $config['first_url'] = base_url() . 'pasien/index.html';
        }

        $config['per_page'] = 10;
        $config['page_query_string'] = TRUE;
        $config['total_rows'] = $this->Tbl_pasien_model->total_rows($q);
        $pasien = $this->Tbl_pasien_model->get_limit_data($config['per_page'], $start, $q);
        $config['full_tag_open'] = '<ul class="pagination pagination-sm no-margin pull-right">';
        $config['full_tag_close'] = '</ul>';
        $this->load->library('pagination');
        $this->pagination->initialize($config);

        $data = array(
            'pasien_data' => $pasien,
            'q' => $q,
            'pagination' => $this->pagination->create_links(),
            'total_rows' => $config['total_rows'],
            'start' => $start,
        );
        $this->template->load('template','pasien/tbl_pasien_list', $data);
    }

    public function read($id) 
    {
        $row = $this->Tbl_pasien_model->get_by_id($id);
        if ($row) {
            $data = array(
		'no_rekamedis' => $row->no_rekamedis,
		'nama_pasien' => $row->nama_pasien,
		'jenis_kelamin' => $row->jenis_kelamin,
		'golongan_darah' => $row->golongan_darah,
		'tempat_lahir' => $row->tempat_lahir,
		'tanggal_lahir' => $row->tanggal_lahir,
		'nama_ibu' => $row->nama_ibu,
		'alamat' => $row->alamat,
		'id_agama' => $row->id_agama,
		'status_menikah' => $row->status_menikah,
		'no_hp' => $row->no_hp,
		'id_pekerjaan' => $row->id_pekerjaan,
	    );
            $this->template->load('template','pasien/tbl_pasien_read', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('pasien'));
        }
    }

    public function create() 
    {
        $noRekbaru = noRekemedisOtomatis();
        $data = array(
            'button' => 'Create',
            'action' => site_url('pasien/create_action'),
	    'no_rekamedis' => set_value('no_rekamedis',$noRekbaru),
	    'nama_pasien' => set_value('nama_pasien'),
	    'jenis_kelamin' => set_value('jenis_kelamin'),
	    'golongan_darah' => set_value('golongan_darah'),
	    'tempat_lahir' => set_value('tempat_lahir'),
	    'tanggal_lahir' => set_value('tanggal_lahir'),
	    'nama_ibu' => set_value('nama_ibu'),
	    'alamat' => set_value('alamat'),
	    'id_agama' => set_value('id_agama'),
	    'status_menikah' => set_value('status_menikah'),
	    'no_hp' => set_value('no_hp'),
	    'id_pekerjaan' => set_value('id_pekerjaan'),
	);
        $this->template->load('template','pasien/tbl_pasien_form', $data);
    }
    
    public function create_action() 
    {
        
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            
            $this->create();
        } else {
            $data = array(
                'no_rekamedis' => $this->input->post('no_rekamedis',TRUE),
		'nama_pasien' => $this->input->post('nama_pasien',TRUE),
		'jenis_kelamin' => $this->input->post('jenis_kelamin',TRUE),
		'golongan_darah' => $this->input->post('golongan_darah',TRUE),
		'tempat_lahir' => $this->input->post('tempat_lahir',TRUE),
		'tanggal_lahir' => $this->input->post('tanggal_lahir',TRUE),
		'nama_ibu' => $this->input->post('nama_ibu',TRUE),
		'alamat' => $this->input->post('alamat',TRUE),
		'id_agama' => $this->input->post('id_agama',TRUE),
		'status_menikah' => $this->input->post('status_menikah',TRUE),
		'no_hp' => $this->input->post('no_hp',TRUE),
		'id_pekerjaan' => $this->input->post('id_pekerjaan',TRUE),
	    );

            $this->Tbl_pasien_model->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success 2');
            redirect(site_url('pasien'));
        }
    }
    
    public function update($id) 
    {
        $row = $this->Tbl_pasien_model->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('pasien/update_action'),
		'no_rekamedis' => set_value('no_rekamedis', $row->no_rekamedis),
		'nama_pasien' => set_value('nama_pasien', $row->nama_pasien),
		'jenis_kelamin' => set_value('jenis_kelamin', $row->jenis_kelamin),
		'golongan_darah' => set_value('golongan_darah', $row->golongan_darah),
		'tempat_lahir' => set_value('tempat_lahir', $row->tempat_lahir),
		'tanggal_lahir' => set_value('tanggal_lahir', $row->tanggal_lahir),
		'nama_ibu' => set_value('nama_ibu', $row->nama_ibu),
		'alamat' => set_value('alamat', $row->alamat),
		'id_agama' => set_value('id_agama', $row->id_agama),
		'status_menikah' => set_value('status_menikah', $row->status_menikah),
		'no_hp' => set_value('no_hp', $row->no_hp),
		'id_pekerjaan' => set_value('id_pekerjaan', $row->id_pekerjaan),
	    );
            $this->template->load('template','pasien/tbl_pasien_form', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('pasien'));
        }
    }
    
    public function update_action() 
    {
        
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('no_rekamedis', TRUE));
        } else {
            $data = array(
		'nama_pasien' => $this->input->post('nama_pasien',TRUE),
		'jenis_kelamin' => $this->input->post('jenis_kelamin',TRUE),
		'golongan_darah' => $this->input->post('golongan_darah',TRUE),
		'tempat_lahir' => $this->input->post('tempat_lahir',TRUE),
		'tanggal_lahir' => $this->input->post('tanggal_lahir',TRUE),
		'nama_ibu' => $this->input->post('nama_ibu',TRUE),
		'alamat' => $this->input->post('alamat',TRUE),
		'id_agama' => $this->input->post('id_agama',TRUE),
		'status_menikah' => $this->input->post('status_menikah',TRUE),
		'no_hp' => $this->input->post('no_hp',TRUE),
		'id_pekerjaan' => $this->input->post('id_pekerjaan',TRUE),
	    );

            $this->Tbl_pasien_model->update($this->input->post('no_rekamedis', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('pasien'));
        }
    }
    
    public function delete($id) 
    {
        $row = $this->Tbl_pasien_model->get_by_id($id);

        if ($row) {
            $this->Tbl_pasien_model->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('pasien'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('pasien'));
        }
    }

    public function _rules() 
    {
	$this->form_validation->set_rules('nama_pasien', 'nama pasien', 'trim|required');
	$this->form_validation->set_rules('jenis_kelamin', 'jenis kelamin', 'trim|required');
	$this->form_validation->set_rules('golongan_darah', 'golongan darah', 'trim|required');
	$this->form_validation->set_rules('tempat_lahir', 'tempat lahir', 'trim|required');
	$this->form_validation->set_rules('tanggal_lahir', 'tanggal lahir', 'trim|required');
	$this->form_validation->set_rules('nama_ibu', 'nama ibu', 'trim|required');
	$this->form_validation->set_rules('alamat', 'alamat', 'trim|required');
	$this->form_validation->set_rules('id_agama', 'id agama', 'trim|required');
	$this->form_validation->set_rules('status_menikah', 'status menikah', 'trim|required');
	$this->form_validation->set_rules('no_hp', 'no hp', 'trim|required');
	$this->form_validation->set_rules('id_pekerjaan', 'id pekerjaan', 'trim|required');

	$this->form_validation->set_rules('no_rekamedis', 'no_rekamedis', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

}

/* End of file Pasien.php */
/* Location: ./application/controllers/Pasien.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2017-12-03 15:02:10 */
/* http://harviacode.com */