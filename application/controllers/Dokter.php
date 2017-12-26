<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Dokter extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        is_login();
        $this->load->model('Tbl_dokter_model');
        $this->load->library('form_validation');        
	$this->load->library('datatables');
    }

    public function index()
    {
        $this->template->load('template','dokter/tbl_dokter_list');
    } 
    
    public function json() {
        header('Content-Type: application/json');
        echo $this->Tbl_dokter_model->json();
    }

    public function read($id) 
    {
        $row = $this->Tbl_dokter_model->get_by_id($id);
        if ($row) {
            $data = array(
		'kode_dokter' => $row->kode_dokter,
		'nama_dokter' => $row->nama_dokter,
		'jenis_kelamin' => $row->jenis_kelamin,
		'tempat_lahir' => $row->tempat_lahir,
		'tanggal_lahir' => $row->tanggal_lahir,
		'id_agama' => $row->id_agama,
		'alamat_tinggal' => $row->alamat_tinggal,
		'no_hp' => $row->no_hp,
		'id_status_menikah' => $row->id_status_menikah,
		'id_spesialis' => $row->id_spesialis,
		'no_izin_praktek' => $row->no_izin_praktek,
		'golongan_darah' => $row->golongan_darah,
		'alumni' => $row->alumni,
	    );
            $this->template->load('template','dokter/tbl_dokter_read', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('dokter'));
        }
    }

    public function create() 
    {
        $data = array(
            'button' => 'Create',
            'action' => site_url('dokter/create_action'),
	    'kode_dokter' => set_value('kode_dokter'),
	    'nama_dokter' => set_value('nama_dokter'),
	    'jenis_kelamin' => set_value('jenis_kelamin'),
	    'tempat_lahir' => set_value('tempat_lahir'),
	    'tanggal_lahir' => set_value('tanggal_lahir'),
	    'id_agama' => set_value('id_agama'),
	    'alamat_tinggal' => set_value('alamat_tinggal'),
	    'no_hp' => set_value('no_hp'),
	    'id_status_menikah' => set_value('id_status_menikah'),
	    'id_spesialis' => set_value('id_spesialis'),
	    'no_izin_praktek' => set_value('no_izin_praktek'),
	    'golongan_darah' => set_value('golongan_darah'),
	    'alumni' => set_value('alumni'),
	);
        $this->template->load('template','dokter/tbl_dokter_form', $data);
    }
    
    public function create_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            $data = array(
                'kode_dokter' => $this->input->post('kode_dokter',TRUE),
		'nama_dokter' => $this->input->post('nama_dokter',TRUE),
		'jenis_kelamin' => $this->input->post('jenis_kelamin',TRUE),
		'tempat_lahir' => $this->input->post('tempat_lahir',TRUE),
		'tanggal_lahir' => $this->input->post('tanggal_lahir',TRUE),
		'id_agama' => $this->input->post('id_agama',TRUE),
		'alamat_tinggal' => $this->input->post('alamat_tinggal',TRUE),
		'no_hp' => $this->input->post('no_hp',TRUE),
		'id_status_menikah' => $this->input->post('id_status_menikah',TRUE),
		'id_spesialis' => $this->input->post('id_spesialis',TRUE),
		'no_izin_praktek' => $this->input->post('no_izin_praktek',TRUE),
		'golongan_darah' => $this->input->post('golongan_darah',TRUE),
		'alumni' => $this->input->post('alumni',TRUE),
	    );

            $this->Tbl_dokter_model->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success 2');
            redirect(site_url('dokter'));
        }
    }
    
    public function update($id) 
    {
        $row = $this->Tbl_dokter_model->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('dokter/update_action'),
		'kode_dokter' => set_value('kode_dokter', $row->kode_dokter),
		'nama_dokter' => set_value('nama_dokter', $row->nama_dokter),
		'jenis_kelamin' => set_value('jenis_kelamin', $row->jenis_kelamin),
		'tempat_lahir' => set_value('tempat_lahir', $row->tempat_lahir),
		'tanggal_lahir' => set_value('tanggal_lahir', $row->tanggal_lahir),
		'id_agama' => set_value('id_agama', $row->id_agama),
		'alamat_tinggal' => set_value('alamat_tinggal', $row->alamat_tinggal),
		'no_hp' => set_value('no_hp', $row->no_hp),
		'id_status_menikah' => set_value('id_status_menikah', $row->id_status_menikah),
		'id_spesialis' => set_value('id_spesialis', $row->id_spesialis),
		'no_izin_praktek' => set_value('no_izin_praktek', $row->no_izin_praktek),
		'golongan_darah' => set_value('golongan_darah', $row->golongan_darah),
		'alumni' => set_value('alumni', $row->alumni),
	    );
            $this->template->load('template','dokter/tbl_dokter_form', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('dokter'));
        }
    }
    
    public function update_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('kode_dokter', TRUE));
        } else {
            $data = array(
		'nama_dokter' => $this->input->post('nama_dokter',TRUE),
		'jenis_kelamin' => $this->input->post('jenis_kelamin',TRUE),
		'tempat_lahir' => $this->input->post('tempat_lahir',TRUE),
		'tanggal_lahir' => $this->input->post('tanggal_lahir',TRUE),
		'id_agama' => $this->input->post('id_agama',TRUE),
		'alamat_tinggal' => $this->input->post('alamat_tinggal',TRUE),
		'no_hp' => $this->input->post('no_hp',TRUE),
		'id_status_menikah' => $this->input->post('id_status_menikah',TRUE),
		'id_spesialis' => $this->input->post('id_spesialis',TRUE),
		'no_izin_praktek' => $this->input->post('no_izin_praktek',TRUE),
		'golongan_darah' => $this->input->post('golongan_darah',TRUE),
		'alumni' => $this->input->post('alumni',TRUE),
	    );

            $this->Tbl_dokter_model->update($this->input->post('kode_dokter', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('dokter'));
        }
    }
    
    public function delete($id) 
    {
        $row = $this->Tbl_dokter_model->get_by_id($id);

        if ($row) {
            $this->Tbl_dokter_model->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('dokter'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('dokter'));
        }
    }

    public function _rules() 
    {
        $this->form_validation->set_rules('kode_dokter', 'kode dokter', 'trim|required');
	$this->form_validation->set_rules('nama_dokter', 'nama dokter', 'trim|required');
	$this->form_validation->set_rules('jenis_kelamin', 'jenis kelamin', 'trim|required');
	$this->form_validation->set_rules('tempat_lahir', 'tempat lahir', 'trim|required');
	$this->form_validation->set_rules('tanggal_lahir', 'tanggal lahir', 'trim|required');
	$this->form_validation->set_rules('id_agama', 'id agama', 'trim|required');
	$this->form_validation->set_rules('alamat_tinggal', 'alamat tinggal', 'trim|required');
	$this->form_validation->set_rules('no_hp', 'no hp', 'trim|required');
	$this->form_validation->set_rules('id_status_menikah', 'id status menikah', 'trim|required');
	$this->form_validation->set_rules('id_spesialis', 'id spesialis', 'trim|required');
	$this->form_validation->set_rules('no_izin_praktek', 'no izin praktek', 'trim|required');
	$this->form_validation->set_rules('golongan_darah', 'golongan darah', 'trim|required');
	//$this->form_validation->set_rules('alumni', 'alumni', 'trim|required');
	//$this->form_validation->set_rules('kode_dokter', 'kode_dokter', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }
    
    

    public function excel()
    {
        $this->load->helper('exportexcel');
        $namaFile = "tbl_dokter.xls";
        $judul = "tbl_dokter";
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
	xlsWriteLabel($tablehead, $kolomhead++, "Nama Dokter");
	xlsWriteLabel($tablehead, $kolomhead++, "Jenis Kelamin");
	xlsWriteLabel($tablehead, $kolomhead++, "Tempat Lahir");
	xlsWriteLabel($tablehead, $kolomhead++, "Tanggal Lahir");
	xlsWriteLabel($tablehead, $kolomhead++, "Id Agama");
	xlsWriteLabel($tablehead, $kolomhead++, "Alamat Tinggal");
	xlsWriteLabel($tablehead, $kolomhead++, "No Hp");
	xlsWriteLabel($tablehead, $kolomhead++, "Id Status Menikah");
	xlsWriteLabel($tablehead, $kolomhead++, "Id Spesialis");
	xlsWriteLabel($tablehead, $kolomhead++, "No Izin Praktek");
	xlsWriteLabel($tablehead, $kolomhead++, "Golongan Darah");
	xlsWriteLabel($tablehead, $kolomhead++, "Alumni");

	foreach ($this->Tbl_dokter_model->get_all() as $data) {
            $kolombody = 0;

            //ubah xlsWriteLabel menjadi xlsWriteNumber untuk kolom numeric
            xlsWriteNumber($tablebody, $kolombody++, $nourut);
	    xlsWriteLabel($tablebody, $kolombody++, $data->nama_dokter);
	    xlsWriteLabel($tablebody, $kolombody++, $data->jenis_kelamin);
	    xlsWriteLabel($tablebody, $kolombody++, $data->tempat_lahir);
	    xlsWriteLabel($tablebody, $kolombody++, $data->tanggal_lahir);
	    xlsWriteNumber($tablebody, $kolombody++, $data->id_agama);
	    xlsWriteLabel($tablebody, $kolombody++, $data->alamat_tinggal);
	    xlsWriteLabel($tablebody, $kolombody++, $data->no_hp);
	    xlsWriteNumber($tablebody, $kolombody++, $data->id_status_menikah);
	    xlsWriteNumber($tablebody, $kolombody++, $data->id_spesialis);
	    xlsWriteLabel($tablebody, $kolombody++, $data->no_izin_praktek);
	    xlsWriteLabel($tablebody, $kolombody++, $data->golongan_darah);
	    xlsWriteLabel($tablebody, $kolombody++, $data->alumni);

	    $tablebody++;
            $nourut++;
        }

        xlsEOF();
        exit();
    }

    public function word()
    {
        header("Content-type: application/vnd.ms-word");
        header("Content-Disposition: attachment;Filename=tbl_dokter.doc");

        $data = array(
            'tbl_dokter_data' => $this->Tbl_dokter_model->get_all(),
            'start' => 0
        );
        
        $this->load->view('dokter/tbl_dokter_doc',$data);
    }
    
    function autocomplate(){
        autocomplate_json('tbl_dokter', 'nama_dokter');
    }

}

/* End of file Dokter.php */
/* Location: ./application/controllers/Dokter.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2017-11-27 18:45:56 */
/* http://harviacode.com */