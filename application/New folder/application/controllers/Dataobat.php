<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Dataobat extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        is_login();
        $this->load->model('Tbl_obat_alkes_bhp_model');
        $this->load->library('form_validation');
    }
    
    function autocomplate(){
        // autocomplate untuk pencarian obat
        $this->db->like('nama_barang', $_GET['term']);
        $this->db->select('nama_barang');
        $products = $this->db->get('tbl_obat_alkes_bhp')->result();
        foreach ($products as $product) {
            $return_arr[] = $product->nama_barang;
        }

        echo json_encode($return_arr);
    }

    public function index()
    {
        $q = urldecode($this->input->get('q', TRUE));
        $start = intval($this->input->get('start'));
        
        if ($q <> '') {
            $config['base_url'] = base_url() . 'dataobat/index.html?q=' . urlencode($q);
            $config['first_url'] = base_url() . 'dataobat/index.html?q=' . urlencode($q);
        } else {
            $config['base_url'] = base_url() . 'dataobat/index.html';
            $config['first_url'] = base_url() . 'dataobat/index.html';
        }

        $config['per_page'] = 10;
        $config['page_query_string'] = TRUE;
        $config['total_rows'] = $this->Tbl_obat_alkes_bhp_model->total_rows($q);
        $dataobat = $this->Tbl_obat_alkes_bhp_model->get_limit_data($config['per_page'], $start, $q);
        $config['full_tag_open'] = '<ul class="pagination pagination-sm no-margin pull-right">';
        $config['full_tag_close'] = '</ul>';
        $this->load->library('pagination');
        $this->pagination->initialize($config);

        $data = array(
            'dataobat_data' => $dataobat,
            'q' => $q,
            'pagination' => $this->pagination->create_links(),
            'total_rows' => $config['total_rows'],
            'start' => $start,
        );
        $this->template->load('template','dataobat/tbl_obat_alkes_bhp_list', $data);
    }

    public function read($id) 
    {
        $row = $this->Tbl_obat_alkes_bhp_model->get_by_id($id);
        if ($row) {
            $data = array(
		'kode_barang' => $row->kode_barang,
		'nama_barang' => $row->nama_barang,
		'id_kategori_barang' => $row->id_kategori_barang,
		'id_satuan_barang' => $row->id_satuan_barang,
		'harga' => $row->harga,
	    );
            $this->template->load('template','dataobat/tbl_obat_alkes_bhp_read', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('dataobat'));
        }
    }

    public function create() 
    {
        $data = array(
            'button' => 'Create',
            'action' => site_url('dataobat/create_action'),
	    'kode_barang' => set_value('kode_barang'),
	    'nama_barang' => set_value('nama_barang'),
	    'id_kategori_barang' => set_value('id_kategori_barang'),
	    'id_satuan_barang' => set_value('id_satuan_barang'),
	    'harga' => set_value('harga'),
	);
        $this->template->load('template','dataobat/tbl_obat_alkes_bhp_form', $data);
    }
    
    public function create_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            $data = array(
                'kode_barang'=>$this->input->post('kode_barang',TRUE),
		'nama_barang' => $this->input->post('nama_barang',TRUE),
		'id_kategori_barang' => $this->input->post('id_kategori_barang',TRUE),
		'id_satuan_barang' => $this->input->post('id_satuan_barang',TRUE),
		'harga' => $this->input->post('harga',TRUE),
	    );

            $this->Tbl_obat_alkes_bhp_model->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success 2');
            redirect(site_url('dataobat'));
        }
    }
    
    public function update($id) 
    {
        $row = $this->Tbl_obat_alkes_bhp_model->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('dataobat/update_action'),
		'kode_barang' => set_value('kode_barang', $row->kode_barang),
		'nama_barang' => set_value('nama_barang', $row->nama_barang),
		'id_kategori_barang' => set_value('id_kategori_barang', $row->id_kategori_barang),
		'id_satuan_barang' => set_value('id_satuan_barang', $row->id_satuan_barang),
		'harga' => set_value('harga', $row->harga),
	    );
            $this->template->load('template','dataobat/tbl_obat_alkes_bhp_form', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('dataobat'));
        }
    }
    
    public function update_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('kode_barang', TRUE));
        } else {
            $data = array(
		'nama_barang' => $this->input->post('nama_barang',TRUE),
		'id_kategori_barang' => $this->input->post('id_kategori_barang',TRUE),
		'id_satuan_barang' => $this->input->post('id_satuan_barang',TRUE),
		'harga' => $this->input->post('harga',TRUE),
	    );

            $this->Tbl_obat_alkes_bhp_model->update($this->input->post('kode_barang', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('dataobat'));
        }
    }
    
    public function delete($id) 
    {
        $row = $this->Tbl_obat_alkes_bhp_model->get_by_id($id);

        if ($row) {
            $this->Tbl_obat_alkes_bhp_model->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('dataobat'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('dataobat'));
        }
    }

    public function _rules() 
    {
	$this->form_validation->set_rules('nama_barang', 'nama barang', 'trim|required');
	$this->form_validation->set_rules('id_kategori_barang', 'id kategori barang', 'trim|required');
	$this->form_validation->set_rules('id_satuan_barang', 'id satuan barang', 'trim|required');
	$this->form_validation->set_rules('harga', 'harga', 'trim|required');

	$this->form_validation->set_rules('kode_barang', 'kode_barang', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

    public function excel()
    {
        $this->load->helper('exportexcel');
        $namaFile = "tbl_obat_alkes_bhp.xls";
        $judul = "tbl_obat_alkes_bhp";
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
	xlsWriteLabel($tablehead, $kolomhead++, "Nama Barang");
	xlsWriteLabel($tablehead, $kolomhead++, "Id Kategori Barang");
	xlsWriteLabel($tablehead, $kolomhead++, "Id Satuan Barang");
	xlsWriteLabel($tablehead, $kolomhead++, "Harga");

	foreach ($this->Tbl_obat_alkes_bhp_model->get_all() as $data) {
            $kolombody = 0;

            //ubah xlsWriteLabel menjadi xlsWriteNumber untuk kolom numeric
            xlsWriteNumber($tablebody, $kolombody++, $nourut);
	    xlsWriteLabel($tablebody, $kolombody++, $data->nama_barang);
	    xlsWriteNumber($tablebody, $kolombody++, $data->id_kategori_barang);
	    xlsWriteNumber($tablebody, $kolombody++, $data->id_satuan_barang);
	    xlsWriteNumber($tablebody, $kolombody++, $data->harga);

	    $tablebody++;
            $nourut++;
        }

        xlsEOF();
        exit();
    }

    public function word()
    {
        header("Content-type: application/vnd.ms-word");
        header("Content-Disposition: attachment;Filename=tbl_obat_alkes_bhp.doc");

        $data = array(
            'tbl_obat_alkes_bhp_data' => $this->Tbl_obat_alkes_bhp_model->get_all(),
            'start' => 0
        );
        
        $this->load->view('dataobat/tbl_obat_alkes_bhp_doc',$data);
    }

}

/* End of file Dataobat.php */
/* Location: ./application/controllers/Dataobat.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2017-12-09 11:24:01 */
/* http://harviacode.com */