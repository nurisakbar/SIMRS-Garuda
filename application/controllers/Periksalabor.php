<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Periksalabor extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        is_login();
        $this->load->model('Tbl_pemeriksaan_laboratorium_model');
        $this->load->library('form_validation');        
	$this->load->library('datatables');
    }

    public function index()
    {
        $this->template->load('template','periksalabor/tbl_pemeriksaan_laboratorium_list');
    } 
    
    public function json() {
        header('Content-Type: application/json');
        echo $this->Tbl_pemeriksaan_laboratorium_model->json();
    }
    
    function autocomplate(){
        echo autocomplate_json('tbl_pemeriksaan_laboratorium', 'nama_periksa');
    }

    public function read($id) 
    {
        $row = $this->Tbl_pemeriksaan_laboratorium_model->get_by_id($id);
        if ($row) {
            $data = array(
		'kode_periksa' => $row->kode_periksa,
		'nama_periksa' => $row->nama_periksa,
		'tarif' => $row->tarif,
	    );
            $this->template->load('template','periksalabor/tbl_pemeriksaan_laboratorium_read', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('periksalabor'));
        }
    }

    public function create() 
    {
        $data = array(
            'button' => 'Create',
            'action' => site_url('periksalabor/create_action'),
	    'kode_periksa' => set_value('kode_periksa'),
	    'nama_periksa' => set_value('nama_periksa'),
	    'tarif' => set_value('tarif'),
	);
        $this->template->load('template','periksalabor/tbl_pemeriksaan_laboratorium_form', $data);
    }
    
    public function create_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            $data = array(
                'kode_periksa'=>  $this->input->post('kode_periksa',TRUE),
		'nama_periksa' => $this->input->post('nama_periksa',TRUE),
		'tarif' => $this->input->post('tarif',TRUE),
	    );

            $this->Tbl_pemeriksaan_laboratorium_model->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success 2');
            redirect(site_url('periksalabor'));
        }
    }
    
    public function update($id) 
    {
        $row = $this->Tbl_pemeriksaan_laboratorium_model->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('periksalabor/update_action'),
		'kode_periksa' => set_value('kode_periksa', $row->kode_periksa),
		'nama_periksa' => set_value('nama_periksa', $row->nama_periksa),
		'tarif' => set_value('tarif', $row->tarif),
	    );
            $this->template->load('template','periksalabor/tbl_pemeriksaan_laboratorium_form', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('periksalabor'));
        }
    }
    
    public function update_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('kode_periksa', TRUE));
        } else {
            $data = array(
		'nama_periksa' => $this->input->post('nama_periksa',TRUE),
		'tarif' => $this->input->post('tarif',TRUE),
	    );

            $this->Tbl_pemeriksaan_laboratorium_model->update($this->input->post('kode_periksa', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('periksalabor'));
        }
    }
    
    public function delete($id) 
    {
        $row = $this->Tbl_pemeriksaan_laboratorium_model->get_by_id($id);

        if ($row) {
            $this->Tbl_pemeriksaan_laboratorium_model->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('periksalabor'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('periksalabor'));
        }
    }

    public function _rules() 
    {
	$this->form_validation->set_rules('nama_periksa', 'nama periksa', 'trim|required');
	$this->form_validation->set_rules('tarif', 'tarif', 'trim|required');

	$this->form_validation->set_rules('kode_periksa', 'kode_periksa', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

    public function excel()
    {
        $this->load->helper('exportexcel');
        $namaFile = "tbl_pemeriksaan_laboratorium.xls";
        $judul = "tbl_pemeriksaan_laboratorium";
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
	xlsWriteLabel($tablehead, $kolomhead++, "Nama Periksa");
	xlsWriteLabel($tablehead, $kolomhead++, "Tarif");

	foreach ($this->Tbl_pemeriksaan_laboratorium_model->get_all() as $data) {
            $kolombody = 0;

            //ubah xlsWriteLabel menjadi xlsWriteNumber untuk kolom numeric
            xlsWriteNumber($tablebody, $kolombody++, $nourut);
	    xlsWriteLabel($tablebody, $kolombody++, $data->nama_periksa);
	    xlsWriteNumber($tablebody, $kolombody++, $data->tarif);

	    $tablebody++;
            $nourut++;
        }

        xlsEOF();
        exit();
    }

    public function word()
    {
        header("Content-type: application/vnd.ms-word");
        header("Content-Disposition: attachment;Filename=tbl_pemeriksaan_laboratorium.doc");

        $data = array(
            'tbl_pemeriksaan_laboratorium_data' => $this->Tbl_pemeriksaan_laboratorium_model->get_all(),
            'start' => 0
        );
        
        $this->load->view('periksalabor/tbl_pemeriksaan_laboratorium_doc',$data);
    }

}

/* End of file Periksalabor.php */
/* Location: ./application/controllers/Periksalabor.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2017-12-16 17:53:32 */
/* http://harviacode.com */