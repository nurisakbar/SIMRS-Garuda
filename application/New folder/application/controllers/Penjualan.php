<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Penjualan extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        is_login();
        $this->load->model('Tbl_penjualan_obat_alkes_bhp_model');
        $this->load->library('form_validation');
    }

    public function index()
    {
        $q = urldecode($this->input->get('q', TRUE));
        $start = intval($this->input->get('start'));
        
        if ($q <> '') {
            $config['base_url'] = base_url() . 'penjualan/index.html?q=' . urlencode($q);
            $config['first_url'] = base_url() . 'penjualan/index.html?q=' . urlencode($q);
        } else {
            $config['base_url'] = base_url() . 'penjualan/index.html';
            $config['first_url'] = base_url() . 'penjualan/index.html';
        }

        $config['per_page'] = 10;
        $config['page_query_string'] = TRUE;
        $config['total_rows'] = $this->Tbl_penjualan_obat_alkes_bhp_model->total_rows($q);
        $penjualan = $this->Tbl_penjualan_obat_alkes_bhp_model->get_limit_data($config['per_page'], $start, $q);
        $config['full_tag_open'] = '<ul class="pagination pagination-sm no-margin pull-right">';
        $config['full_tag_close'] = '</ul>';
        $this->load->library('pagination');
        $this->pagination->initialize($config);

        $data = array(
            'penjualan_data' => $penjualan,
            'q' => $q,
            'pagination' => $this->pagination->create_links(),
            'total_rows' => $config['total_rows'],
            'start' => $start,
        );
        $this->template->load('template','penjualan/tbl_penjualan_obat_alkes_bhp_list', $data);
    }

    public function read($id) 
    {
        $row = $this->Tbl_penjualan_obat_alkes_bhp_model->get_by_id($id);
        if ($row) {
            $data = array(
		'no_faktur' => $row->no_faktur,
		'tanggal' => $row->tanggal,
		'kode_supplier' => $row->kode_supplier,
	    );
            $data['sql'] ="SELECT tb2.kode_barang,tb2.nama_barang,tb1.harga,tb1.qty,tb1.id_penjualan
                FROM tbl_penjualan_detail as tb1, tbl_obat_alkes_bhp as tb2
                WHERE tb1.kode_barang=tb2.kode_barang and tb1.no_faktur='$id'";
            $this->template->load('template','penjualan/tbl_penjualan_obat_alkes_bhp_read', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('penjualan'));
        }
    }

    public function create() 
    {
        $data = array(
            'button' => 'Simpan Transaksi',
            'action' => site_url('penjualan/create_action'),
	    'no_faktur' => set_value('no_faktur'),
	    'tanggal' => set_value('tanggal'),
	    'kode_supplier' => set_value('kode_supplier'),
	);
        $this->template->load('template','penjualan/tbl_penjualan_obat_alkes_bhp_form', $data);
    }
    
    function getKodeSupplier($namaSupplier){
        $this->db->where('nama_supplier',$namaSupplier);
        $data = $this->db->get('tbl_supplier')->row_array();
        return $data['kode_supplier'];
    }
    
    public function create_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            $data = array(
                'no_faktur'=>$this->input->post('no_faktur',TRUE),
		'tanggal' => $this->input->post('tanggal',TRUE)
	    );

            $this->Tbl_penjualan_obat_alkes_bhp_model->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success 2');
            redirect(site_url('penjualan'));
        }
    }
    
    public function update($id) 
    {
        $row = $this->Tbl_penjualan_obat_alkes_bhp_model->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('penjualan/update_action'),
		'no_faktur' => set_value('no_faktur', $row->no_faktur),
		'tanggal' => set_value('tanggal', $row->tanggal),
		'kode_supplier' => set_value('kode_supplier', $row->kode_supplier),
	    );
            $this->template->load('template','penjualan/tbl_penjualan_obat_alkes_bhp_form', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('penjualan'));
        }
    }
    
    public function update_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('no_faktur', TRUE));
        } else {
            $data = array(
		'tanggal' => $this->input->post('tanggal',TRUE),
		'kode_supplier' => $this->input->post('kode_supplier',TRUE),
	    );

            $this->Tbl_penjualan_obat_alkes_bhp_model->update($this->input->post('no_faktur', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('penjualan'));
        }
    }
    
    public function delete($id) 
    {
        $row = $this->Tbl_penjualan_obat_alkes_bhp_model->get_by_id($id);

        if ($row) {
            $this->Tbl_penjualan_obat_alkes_bhp_model->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('penjualan'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('penjualan'));
        }
    }

    public function _rules() 
    {
	$this->form_validation->set_rules('tanggal', 'tanggal', 'trim|required');
	//$this->form_validation->set_rules('kode_supplier', 'kode supplier', 'trim|required');

	$this->form_validation->set_rules('no_faktur', 'no_faktur', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }
    
    
    function add_ajax(){
        $NamaBarang = $this->input->get('barang');
        $qty    =  $this->input->get('qty');
        $faktur =  $this->input->get('faktur');
        // mencari kode barang berdasarkan nama barang
        $barang = $this->db->get_where('tbl_obat_alkes_bhp',
                array('nama_barang'=>$NamaBarang))->row_array();
        
        $data = array(
            'kode_barang'   =>  $barang['kode_barang'],
            'qty'           =>  $qty,
            'no_faktur'     =>  $faktur);
        $this->db->insert('tbl_penjualan_detail',$data);
    }
    
    function list_penjualan(){
        $faktur = $_GET['faktur'];
        echo "<table class='table table-bordered'>
                <tr><th>NO</th><th>NAMA BARANG</th><th>QTY</th><th>HARGA</th></tr>";
        $sql = "SELECT tb2.kode_barang,tb2.nama_barang,tb2.harga,tb1.qty,tb1.id_penjualan
                FROM tbl_penjualan_detail as tb1, tbl_obat_alkes_bhp as tb2
                WHERE tb1.kode_barang=tb2.kode_barang and tb1.no_faktur='$faktur'";
        
        $list = $this->db->query($sql)->result();
        $no=1;
        foreach ($list as $row){
            echo "<tr>
                <td width='10'>$no</td>
                <td>$row->nama_barang</td>
                <td width='20'>$row->qty</td>
                <td width='100'>$row->harga</td>
                <td width='100' onClick='hapus($row->id_penjualan)'><button class='btn btn-danger btn-sm'>Hapus</button></td>
                </tr>";
            $no++;
        }
        echo" </table>";
    }
    
    function hapus_ajax(){
        $id_penjualan = $_GET['id_penjualan'];
        $this->db->where('id_penjualan',$id_penjualan);
        $this->db->delete('tbl_penjualan_detail');
    }

}

/* End of file Pengadaan.php */
/* Location: ./application/controllers/Pengadaan.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2017-12-10 02:07:42 */
/* http://harviacode.com */