<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Diagnosa extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        is_login();
        $this->load->model('Tbl_diagnosa_penyakit_model');
        $this->load->library('form_validation');        
	$this->load->library('datatables');
    }

    public function index()
    {
        $this->template->load('template','diagnosa/tbl_diagnosa_penyakit_list');
    } 
    
    public function json() {
        header('Content-Type: application/json');
        echo $this->Tbl_diagnosa_penyakit_model->json();
    }

    public function read($id) 
    {
        $row = $this->Tbl_diagnosa_penyakit_model->get_by_id($id);
        if ($row) {
            $data = array(
		'kode_diagnosa' => $row->kode_diagnosa,
		'nama_penyakit' => $row->nama_penyakit,
		'ciri_ciri_penyakit' => $row->ciri_ciri_penyakit,
		'keterangan' => $row->keterangan,
		'ciri_ciri_umum' => $row->ciri_ciri_umum,
	    );
            $this->template->load('template','diagnosa/tbl_diagnosa_penyakit_read', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('diagnosa'));
        }
    }

    public function create() 
    {
        $data = array(
            'button' => 'Create',
            'action' => site_url('diagnosa/create_action'),
	    'kode_diagnosa' => set_value('kode_diagnosa'),
	    'nama_penyakit' => set_value('nama_penyakit'),
	    'ciri_ciri_penyakit' => set_value('ciri_ciri_penyakit'),
	    'keterangan' => set_value('keterangan'),
	    'ciri_ciri_umum' => set_value('ciri_ciri_umum'),
	);
        $this->template->load('template','diagnosa/tbl_diagnosa_penyakit_form', $data);
    }
    
    public function create_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            $data = array(
                'kode_diagnosa' => $this->input->post('kode_diagnosa',TRUE),
		'nama_penyakit' => $this->input->post('nama_penyakit',TRUE),
		'ciri_ciri_penyakit' => $this->input->post('ciri_ciri_penyakit',TRUE),
		'keterangan' => $this->input->post('keterangan',TRUE),
		'ciri_ciri_umum' => $this->input->post('ciri_ciri_umum',TRUE),
	    );

            $this->Tbl_diagnosa_penyakit_model->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success 2');
            redirect(site_url('diagnosa'));
        }
    }
    
    public function update($id) 
    {
        $row = $this->Tbl_diagnosa_penyakit_model->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('diagnosa/update_action'),
		'kode_diagnosa' => set_value('kode_diagnosa', $row->kode_diagnosa),
		'nama_penyakit' => set_value('nama_penyakit', $row->nama_penyakit),
		'ciri_ciri_penyakit' => set_value('ciri_ciri_penyakit', $row->ciri_ciri_penyakit),
		'keterangan' => set_value('keterangan', $row->keterangan),
		'ciri_ciri_umum' => set_value('ciri_ciri_umum', $row->ciri_ciri_umum),
	    );
            $this->template->load('template','diagnosa/tbl_diagnosa_penyakit_form', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('diagnosa'));
        }
    }
    
    public function update_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('kode_diagnosa', TRUE));
        } else {
            $data = array(
		'nama_penyakit' => $this->input->post('nama_penyakit',TRUE),
		'ciri_ciri_penyakit' => $this->input->post('ciri_ciri_penyakit',TRUE),
		'keterangan' => $this->input->post('keterangan',TRUE),
		'ciri_ciri_umum' => $this->input->post('ciri_ciri_umum',TRUE),
	    );

            $this->Tbl_diagnosa_penyakit_model->update($this->input->post('kode_diagnosa', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('diagnosa'));
        }
    }
    
    public function delete($id) 
    {
        $row = $this->Tbl_diagnosa_penyakit_model->get_by_id($id);

        if ($row) {
            $this->Tbl_diagnosa_penyakit_model->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('diagnosa'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('diagnosa'));
        }
    }

    public function _rules() 
    {
	$this->form_validation->set_rules('nama_penyakit', 'nama penyakit', 'trim|required');
	$this->form_validation->set_rules('ciri_ciri_penyakit', 'ciri ciri penyakit', 'trim|required');
	$this->form_validation->set_rules('keterangan', 'keterangan', 'trim|required');
	$this->form_validation->set_rules('ciri_ciri_umum', 'ciri ciri umum', 'trim|required');

	$this->form_validation->set_rules('kode_diagnosa', 'kode_diagnosa', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

    public function excel()
    {
        $this->load->helper('exportexcel');
        $namaFile = "tbl_diagnosa_penyakit.xls";
        $judul = "tbl_diagnosa_penyakit";
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
	xlsWriteLabel($tablehead, $kolomhead++, "Nama Penyakit");
	xlsWriteLabel($tablehead, $kolomhead++, "Ciri Ciri Penyakit");
	xlsWriteLabel($tablehead, $kolomhead++, "Keterangan");
	xlsWriteLabel($tablehead, $kolomhead++, "Ciri Ciri Umum");

	foreach ($this->Tbl_diagnosa_penyakit_model->get_all() as $data) {
            $kolombody = 0;

            //ubah xlsWriteLabel menjadi xlsWriteNumber untuk kolom numeric
            xlsWriteNumber($tablebody, $kolombody++, $nourut);
	    xlsWriteLabel($tablebody, $kolombody++, $data->nama_penyakit);
	    xlsWriteLabel($tablebody, $kolombody++, $data->ciri_ciri_penyakit);
	    xlsWriteLabel($tablebody, $kolombody++, $data->keterangan);
	    xlsWriteLabel($tablebody, $kolombody++, $data->ciri_ciri_umum);

	    $tablebody++;
            $nourut++;
        }

        xlsEOF();
        exit();
    }

    public function word()
    {
        header("Content-type: application/vnd.ms-word");
        header("Content-Disposition: attachment;Filename=tbl_diagnosa_penyakit.doc");

        $data = array(
            'tbl_diagnosa_penyakit_data' => $this->Tbl_diagnosa_penyakit_model->get_all(),
            'start' => 0
        );
        
        $this->load->view('diagnosa/tbl_diagnosa_penyakit_doc',$data);
    }

}

/* End of file Diagnosa.php */
/* Location: ./application/controllers/Diagnosa.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2017-12-14 19:12:14 */
/* http://harviacode.com */