<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Sub_periksa_labor extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        is_login();
        $this->load->model('Tbl_sub_pemeriksaan_laboratoirum_model');
        $this->load->library('form_validation');
    }

    public function index()
    {
        $q = urldecode($this->input->get('q', TRUE));
        $start = intval($this->input->get('start'));
        
        if ($q <> '') {
            $config['base_url'] = base_url() . 'sub_periksa_labor/index.html?q=' . urlencode($q);
            $config['first_url'] = base_url() . 'sub_periksa_labor/index.html?q=' . urlencode($q);
        } else {
            $config['base_url'] = base_url() . 'sub_periksa_labor/index.html';
            $config['first_url'] = base_url() . 'sub_periksa_labor/index.html';
        }
        $kode_periksa = $this->uri->segment(3);
        $config['per_page'] = 10;
        $config['page_query_string'] = TRUE;
        $config['total_rows'] = $this->Tbl_sub_pemeriksaan_laboratoirum_model->total_rows($q);
        $sub_periksa_labor = $this->Tbl_sub_pemeriksaan_laboratoirum_model->get_limit_data($kode_periksa,$config['per_page'], $start, $q);
        $config['full_tag_open'] = '<ul class="pagination pagination-sm no-margin pull-right">';
        $config['full_tag_close'] = '</ul>';
        $this->load->library('pagination');
        //$data['periksa_labor'] = $this->db->get_where('tbl_pemeriksaan_laboratorium',array('kode_periksa'=>$kode_periksa))->row_array();
        $this->pagination->initialize($config);

        $data = array(
            'sub_periksa_labor_data' => $sub_periksa_labor,
            'q' => $q,
            'pagination' => $this->pagination->create_links(),
            'total_rows' => $config['total_rows'],
            'start' => $start,
            'periksa_labor'=>$this->db->get_where('tbl_pemeriksaan_laboratorium',array('kode_periksa'=>$kode_periksa))->row_array(),
        );
        $this->template->load('template','sub_periksa_labor/tbl_sub_pemeriksaan_laboratoirum_list', $data);
    }

    public function read($id) 
    {
        $row = $this->Tbl_sub_pemeriksaan_laboratoirum_model->get_by_id($id);
        if ($row) {
            $data = array(
		'kode_sub_periksa' => $row->kode_sub_periksa,
		'kode_periksa' => $row->kode_periksa,
		'nama_pemeriksaan' => $row->nama_pemeriksaan,
		'satuan' => $row->satuan,
		'nilai_rujukan' => $row->nilai_rujukan,
	    );
            $this->template->load('template','sub_periksa_labor/tbl_sub_pemeriksaan_laboratoirum_read', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('sub_periksa_labor'));
        }
    }

    public function create() 
    {
        $periksa_labor = $this->db->get_where('tbl_pemeriksaan_laboratorium',array('kode_periksa'=>  $this->uri->segment(3)))->row_array();
        $data = array(
            'button' => 'Create',
            'action' => site_url('sub_periksa_labor/create_action'),
	    'kode_sub_periksa' => set_value('kode_sub_periksa'),
	    'kode_periksa' => set_value('kode_periksa',$periksa_labor['nama_periksa']),
	    'nama_pemeriksaan' => set_value('nama_pemeriksaan'),
	    'satuan' => set_value('satuan'),
	    'nilai_rujukan' => set_value('nilai_rujukan'),
	);
        $this->template->load('template','sub_periksa_labor/tbl_sub_pemeriksaan_laboratoirum_form', $data);
    }
    
    function getKodePeriksa($nama_periksa){
        $this->db->where('nama_periksa',$nama_periksa);
        $data = $this->db->get_where('tbl_pemeriksaan_laboratorium')->row_array();
        return $data['kode_periksa'];
    }
    
    public function create_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            $kode_periksa = $this->getKodePeriksa($this->input->post('kode_periksa',TRUE));
            $data = array(
                'kode_sub_periksa' =>  $this->input->post('kode_sub_periksa',TRUE),
		'kode_periksa' => $kode_periksa,
		'nama_pemeriksaan' => $this->input->post('nama_pemeriksaan',TRUE),
		'satuan' => $this->input->post('satuan',TRUE),
		'nilai_rujukan' => $this->input->post('nilai_rujukan',TRUE),
	    );

            $this->Tbl_sub_pemeriksaan_laboratoirum_model->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success 2');
            redirect(site_url('sub_periksa_labor/index/'.$kode_periksa));
        }
    }
    
    public function update($id) 
    {
        $row = $this->Tbl_sub_pemeriksaan_laboratoirum_model->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('sub_periksa_labor/update_action'),
		'kode_sub_periksa' => set_value('kode_sub_periksa', $row->kode_sub_periksa),
		'kode_periksa' => set_value('kode_periksa', $row->kode_periksa),
		'nama_pemeriksaan' => set_value('nama_pemeriksaan', $row->nama_pemeriksaan),
		'satuan' => set_value('satuan', $row->satuan),
		'nilai_rujukan' => set_value('nilai_rujukan', $row->nilai_rujukan),
	    );
            $this->template->load('template','sub_periksa_labor/tbl_sub_pemeriksaan_laboratoirum_form', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('sub_periksa_labor'));
        }
    }
    
    public function update_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('kode_sub_periksa', TRUE));
        } else {
            $data = array(
		'kode_periksa' => $this->input->post('kode_periksa',TRUE),
		'nama_pemeriksaan' => $this->input->post('nama_pemeriksaan',TRUE),
		'satuan' => $this->input->post('satuan',TRUE),
		'nilai_rujukan' => $this->input->post('nilai_rujukan',TRUE),
	    );

            $this->Tbl_sub_pemeriksaan_laboratoirum_model->update($this->input->post('kode_sub_periksa', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('sub_periksa_labor'));
        }
    }
    
    public function delete($id) 
    {
        $row = $this->Tbl_sub_pemeriksaan_laboratoirum_model->get_by_id($id);

        if ($row) {
            $this->Tbl_sub_pemeriksaan_laboratoirum_model->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('sub_periksa_labor'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('sub_periksa_labor'));
        }
    }

    public function _rules() 
    {
	$this->form_validation->set_rules('kode_periksa', 'kode periksa', 'trim|required');
	$this->form_validation->set_rules('nama_pemeriksaan', 'nama pemeriksaan', 'trim|required');
	$this->form_validation->set_rules('satuan', 'satuan', 'trim|required');
	$this->form_validation->set_rules('nilai_rujukan', 'nilai rujukan', 'trim|required');

	$this->form_validation->set_rules('kode_sub_periksa', 'kode_sub_periksa', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

    public function excel()
    {
        $this->load->helper('exportexcel');
        $namaFile = "tbl_sub_pemeriksaan_laboratoirum.xls";
        $judul = "tbl_sub_pemeriksaan_laboratoirum";
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
	xlsWriteLabel($tablehead, $kolomhead++, "Kode Periksa");
	xlsWriteLabel($tablehead, $kolomhead++, "Nama Pemeriksaan");
	xlsWriteLabel($tablehead, $kolomhead++, "Satuan");
	xlsWriteLabel($tablehead, $kolomhead++, "Nilai Rujukan");

	foreach ($this->Tbl_sub_pemeriksaan_laboratoirum_model->get_all() as $data) {
            $kolombody = 0;

            //ubah xlsWriteLabel menjadi xlsWriteNumber untuk kolom numeric
            xlsWriteNumber($tablebody, $kolombody++, $nourut);
	    xlsWriteLabel($tablebody, $kolombody++, $data->kode_periksa);
	    xlsWriteLabel($tablebody, $kolombody++, $data->nama_pemeriksaan);
	    xlsWriteLabel($tablebody, $kolombody++, $data->satuan);
	    xlsWriteNumber($tablebody, $kolombody++, $data->nilai_rujukan);

	    $tablebody++;
            $nourut++;
        }

        xlsEOF();
        exit();
    }

    public function word()
    {
        header("Content-type: application/vnd.ms-word");
        header("Content-Disposition: attachment;Filename=tbl_sub_pemeriksaan_laboratoirum.doc");

        $data = array(
            'tbl_sub_pemeriksaan_laboratoirum_data' => $this->Tbl_sub_pemeriksaan_laboratoirum_model->get_all(),
            'start' => 0
        );
        
        $this->load->view('sub_periksa_labor/tbl_sub_pemeriksaan_laboratoirum_doc',$data);
    }

}

/* End of file Sub_periksa_labor.php */
/* Location: ./application/controllers/Sub_periksa_labor.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2017-12-16 18:03:54 */
/* http://harviacode.com */