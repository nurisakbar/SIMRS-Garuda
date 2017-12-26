<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Pendaftaran extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        is_login();
        $this->load->model('Tbl_pendaftaran_model');
        $this->load->library('form_validation');
    }

    public function index()
    {
        $cara_masuk_url = $this->uri->segment(3);
        if($cara_masuk_url=='ralan'){
            $cara_masuk = "RAWAT JALAN";
        }else{
            $cara_masuk = "RAWAT INAP";
        }
        $q = urldecode($this->input->get('q', TRUE));
        $start = intval($this->input->get('start'));
        
        if ($q <> '') {
            $config['base_url'] = base_url() . 'index.php/pendaftaran/index?q=' . urlencode($q);
            $config['first_url'] = base_url() . 'index.php/pendaftaran/index?q=' . urlencode($q);
        } else {
            $config['base_url'] = base_url() . 'index.php/pendaftaran/index';
            $config['first_url'] = base_url() . 'index.php/pendaftaran/index';
        }

        $config['per_page'] = 10;
        $config['page_query_string'] = TRUE;
        $config['total_rows'] = $this->Tbl_pendaftaran_model->total_rows($q);
        $pendaftaran = $this->Tbl_pendaftaran_model->get_limit_data($config['per_page'], $start, $q,$cara_masuk);
        $config['full_tag_open'] = '<ul class="pagination pagination-sm no-margin pull-right">';
        $config['full_tag_close'] = '</ul>';
        $this->load->library('pagination');
        $this->pagination->initialize($config);

        $data = array(
            'pendaftaran_data' => $pendaftaran,
            'q' => $q,
            'pagination' => $this->pagination->create_links(),
            'total_rows' => $config['total_rows'],
            'start' => $start,
        );
        $this->template->load('template','pendaftaran/tbl_pendaftaran_list', $data);
    }
    
    function autocomplate_dokter(){
        autocomplate_json('tbl_dokter', 'nama_dokter');
    }
    
    
    function autocomplate_no_rekemedis(){
         $this->db->like('no_rekamedis', $_GET['term']);
        $this->db->select('no_rekamedis');
        $dataPasien = $this->db->get('tbl_pasien')->result();
        foreach ($dataPasien as $pasien) {
            $return_arr[] = $pasien->no_rekamedis;
        }

        echo json_encode($return_arr);
    }
    
    function autofill(){
        $no_rekamedis = $_GET['no_rekamedis'];
        $this->db->where('no_rekamedis',$no_rekamedis);
        $pasien = $this->db->get('tbl_pasien')->row_array();
        $data = array(
                    'nama_pasien'      =>  $pasien['nama_pasien'],
                    'tanggal_lahir'   =>  $pasien['tanggal_lahir']);
         echo json_encode($data);
    }
    
    function detail(){
        $no_rawat = substr($this->uri->uri_string(3),19);
        $sql_daftar = "SELECT pd.no_rekamedis,pd.no_rawat,ps.nama_pasien FROM 
                        tbl_pendaftaran as pd,tbl_pasien as ps
                        WHERE pd.no_rekamedis=ps.no_rekamedis and pd.no_rawat='$no_rawat'"; 
        $sql_tindakan = "SELECT tt.*,tr.hasil_periksa,tr.tanggal,tr.perkembangan 
                        FROM tbl_riwayat_tindakan as tr,tbl_tindakan as tt
                        WHERE tr.kode_tindakan=tt.kode_tindakan and tr.no_rawat='$no_rawat'";
        $sql_obat     = "SELECT ta.kode_barang,ta.nama_barang,ta.harga,tp.tanggal,tp.jumlah
                        FROM tbl_riwayat_pemberian_obat as tp, tbl_obat_alkes_bhp as ta 
                        WHERE tp.kode_barang=ta.kode_barang and tp.no_rawat='$no_rawat'";
        
        $sql_labor    = "SELECT tp.*,tr.tanggal,tr.id_riwayat 
                        FROM tbl_pemeriksaan_laboratorium as tp, tbl_riwayat_pemeriksaan_laboratorium as  tr
                        WHERE tr.kode_periksa=tp.kode_periksa and tr.no_rawat='$no_rawat'";
        $data['pendaftaran']=  $this->db->query($sql_daftar)->row_array();
        $data['no_rawat'] = $no_rawat;
        $data['riwayat_obat'] = $this->db->query($sql_obat)->result();
        $data['tindakan'] = $this->db->query($sql_tindakan)->result();
        $data['riwayat_labor'] = $this->db->query($sql_labor)->result();
        $this->template->load('template','pendaftaran/detail',$data);
    }

    public function read() 
    {
        $this->template->load('template','pendaftaran/tbl_pendaftaran_list');
        //$this->template->load('template','pendaftaran/detail');
        
        
        
        die;
        $row = $this->Tbl_pendaftaran_model->get_by_id($id);
        if ($row) {
            $data = array(
		'no_registrasi' => $row->no_registrasi,
		'no_rawat' => $row->no_rawat,
		'no_rekamedis' => $row->no_rekamedis,
		'cara_masuk' => $row->cara_masuk,
		'tanggal_daftar' => $row->tanggal_daftar,
		'kode_dokter_penanggung_jawab' => $row->kode_dokter_penanggung_jawab,
		'id_poli' => $row->id_poli,
		'nama_penanggung_jawab' => $row->nama_penanggung_jawab,
		'hubungan_dengan_penanggung_jawab' => $row->hubungan_dengan_penanggung_jawab,
		'alamat_penanggung_jawab' => $row->alamat_penanggung_jawab,
		'id_jenis_bayar' => $row->id_jenis_bayar,
		'asal_rujukan' => $row->asal_rujukan,
	    );
            $this->template->load('template','pendaftaran/tbl_pendaftaran_read', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('pendaftaran'));
        }
    }

    public function create() 
    {
        $data = array(
            'button' => 'Create',
            'action' => site_url('pendaftaran/create_action'),
	    'no_registrasi' => set_value('no_registrasi'),
	    'no_rawat' => set_value('no_rawat'),
	    'no_rekamedis' => set_value('no_rekamedis'),
	    'cara_masuk' => set_value('cara_masuk'),
	    'tanggal_daftar' => set_value('tanggal_daftar'),
	    'kode_dokter_penanggung_jawab' => set_value('kode_dokter_penanggung_jawab'),
	    'id_poli' => set_value('id_poli'),
	    'nama_penanggung_jawab' => set_value('nama_penanggung_jawab'),
	    'hubungan_dengan_penanggung_jawab' => set_value('hubungan_dengan_penanggung_jawab'),
	    'alamat_penanggung_jawab' => set_value('alamat_penanggung_jawab'),
	    'id_jenis_bayar' => set_value('id_jenis_bayar'),
	    'asal_rujukan' => set_value('asal_rujukan'),
	);
        $this->template->load('template','pendaftaran/tbl_pendaftaran_form', $data);
    }
    
    function getKodeDokter($namaDokter){
        $this->db->where('nama_dokter',$namaDokter);
        $dokter = $this->db->get('tbl_dokter')->row_array();
        return $dokter['kode_dokter'];
    }
    
    public function create_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            $data = array(
                'no_rawat'=>  $this->input->post('no_rawat',TRUE),
		'no_registrasi' => $this->input->post('no_registrasi',TRUE),
		'no_rekamedis' => $this->input->post('no_rekamedis',TRUE),
		'cara_masuk' => $this->input->post('cara_masuk',TRUE),
		'tanggal_daftar' => $this->input->post('tanggal_daftar',TRUE),
		'kode_dokter_penanggung_jawab' =>  $this->getKodeDokter($this->input->post('kode_dokter_penanggung_jawab',TRUE)),
		'id_poli' => $this->input->post('id_poli',TRUE),
		'nama_penanggung_jawab' => $this->input->post('nama_penanggung_jawab',TRUE),
		'hubungan_dengan_penanggung_jawab' => $this->input->post('hubungan_dengan_penanggung_jawab',TRUE),
		'alamat_penanggung_jawab' => $this->input->post('alamat_penanggung_jawab',TRUE),
		'id_jenis_bayar' => $this->input->post('id_jenis_bayar',TRUE),
		'asal_rujukan' => $this->input->post('asal_rujukan',TRUE),
	    );
            
            // script ini digunakan untuk menyimpan data rawat inap
            $cara_masuk = $this->input->post('cara_masuk',TRUE);
            if($cara_masuk=='RAWAT INAP'){
                $data_ranap = array(
                    'no_rawat'              =>  $this->input->post('no_rawat',TRUE),
                    'tanggal_masuk'         =>  $this->input->post('tanggal_daftar',TRUE),
                    'tanggal_keluar'        =>  '0000-00-00',
                    'kode_tempat_tidur'=>$this->input->post('kode_tempat_tidur',TRUE));
                $this->db->insert('tbl_rawat_inap',$data_ranap);
                
                // update status tempat tidur
                
                $this->db->where('kode_tempat_tidur',$this->input->post('kode_tempat_tidur',TRUE));
                $this->db->update('tbl_tempat_tidur',array('status'=>'diisi'));
            }

            $this->Tbl_pendaftaran_model->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success 2');
            redirect(site_url('pendaftaran'));
        }
    }
    
    public function update($id) 
    {
        $row = $this->Tbl_pendaftaran_model->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('pendaftaran/update_action'),
		'no_registrasi' => set_value('no_registrasi', $row->no_registrasi),
		'no_rawat' => set_value('no_rawat', $row->no_rawat),
		'no_rekamedis' => set_value('no_rekamedis', $row->no_rekamedis),
		'cara_masuk' => set_value('cara_masuk', $row->cara_masuk),
		'tanggal_daftar' => set_value('tanggal_daftar', $row->tanggal_daftar),
		'kode_dokter_penanggung_jawab' => set_value('kode_dokter_penanggung_jawab', $row->kode_dokter_penanggung_jawab),
		'id_poli' => set_value('id_poli', $row->id_poli),
		'nama_penanggung_jawab' => set_value('nama_penanggung_jawab', $row->nama_penanggung_jawab),
		'hubungan_dengan_penanggung_jawab' => set_value('hubungan_dengan_penanggung_jawab', $row->hubungan_dengan_penanggung_jawab),
		'alamat_penanggung_jawab' => set_value('alamat_penanggung_jawab', $row->alamat_penanggung_jawab),
		'id_jenis_bayar' => set_value('id_jenis_bayar', $row->id_jenis_bayar),
		'asal_rujukan' => set_value('asal_rujukan', $row->asal_rujukan),
	    );
            $this->template->load('template','pendaftaran/tbl_pendaftaran_form', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('pendaftaran'));
        }
    }
    
    public function update_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('no_rawat', TRUE));
        } else {
            $data = array(
		'no_registrasi' => $this->input->post('no_registrasi',TRUE),
		'no_rekamedis' => $this->input->post('no_rekamedis',TRUE),
		'cara_masuk' => $this->input->post('cara_masuk',TRUE),
		'tanggal_daftar' => $this->input->post('tanggal_daftar',TRUE),
		'kode_dokter_penanggung_jawab' => $this->input->post('kode_dokter_penanggung_jawab',TRUE),
		'id_poli' => $this->input->post('id_poli',TRUE),
		'nama_penanggung_jawab' => $this->input->post('nama_penanggung_jawab',TRUE),
		'hubungan_dengan_penanggung_jawab' => $this->input->post('hubungan_dengan_penanggung_jawab',TRUE),
		'alamat_penanggung_jawab' => $this->input->post('alamat_penanggung_jawab',TRUE),
		'id_jenis_bayar' => $this->input->post('id_jenis_bayar',TRUE),
		'asal_rujukan' => $this->input->post('asal_rujukan',TRUE),
	    );

            $this->Tbl_pendaftaran_model->update($this->input->post('no_rawat', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('pendaftaran'));
        }
    }
    
    public function delete($id) 
    {
        $row = $this->Tbl_pendaftaran_model->get_by_id($id);

        if ($row) {
            $this->Tbl_pendaftaran_model->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('pendaftaran'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('pendaftaran'));
        }
    }

    public function _rules() 
    {
	$this->form_validation->set_rules('no_registrasi', 'no registrasi', 'trim|required');
	$this->form_validation->set_rules('no_rekamedis', 'no rekamedis', 'trim|required');
	$this->form_validation->set_rules('cara_masuk', 'cara masuk', 'trim|required');
	$this->form_validation->set_rules('tanggal_daftar', 'tanggal daftar', 'trim|required');
	$this->form_validation->set_rules('kode_dokter_penanggung_jawab', 'kode dokter penanggung jawab', 'trim|required');
	$this->form_validation->set_rules('id_poli', 'id poli', 'trim|required');
	$this->form_validation->set_rules('nama_penanggung_jawab', 'nama penanggung jawab', 'trim|required');
	$this->form_validation->set_rules('hubungan_dengan_penanggung_jawab', 'hubungan dengan penanggung jawab', 'trim|required');
	$this->form_validation->set_rules('alamat_penanggung_jawab', 'alamat penanggung jawab', 'trim|required');
	$this->form_validation->set_rules('id_jenis_bayar', 'id jenis bayar', 'trim|required');
	$this->form_validation->set_rules('asal_rujukan', 'asal rujukan', 'trim|required');

	$this->form_validation->set_rules('no_rawat', 'no_rawat', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

    public function excel()
    {
        $this->load->helper('exportexcel');
        $namaFile = "tbl_pendaftaran.xls";
        $judul = "tbl_pendaftaran";
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
	xlsWriteLabel($tablehead, $kolomhead++, "No Registrasi");
	xlsWriteLabel($tablehead, $kolomhead++, "No Rekamedis");
	xlsWriteLabel($tablehead, $kolomhead++, "Cara Masuk");
	xlsWriteLabel($tablehead, $kolomhead++, "Tanggal Daftar");
	xlsWriteLabel($tablehead, $kolomhead++, "Kode Dokter Penanggung Jawab");
	xlsWriteLabel($tablehead, $kolomhead++, "Id Poli");
	xlsWriteLabel($tablehead, $kolomhead++, "Nama Penanggung Jawab");
	xlsWriteLabel($tablehead, $kolomhead++, "Hubungan Dengan Penanggung Jawab");
	xlsWriteLabel($tablehead, $kolomhead++, "Alamat Penanggung Jawab");
	xlsWriteLabel($tablehead, $kolomhead++, "Id Jenis Bayar");
	xlsWriteLabel($tablehead, $kolomhead++, "Asal Rujukan");

	foreach ($this->Tbl_pendaftaran_model->get_all() as $data) {
            $kolombody = 0;

            //ubah xlsWriteLabel menjadi xlsWriteNumber untuk kolom numeric
            xlsWriteNumber($tablebody, $kolombody++, $nourut);
	    xlsWriteLabel($tablebody, $kolombody++, $data->no_registrasi);
	    xlsWriteLabel($tablebody, $kolombody++, $data->no_rekamedis);
	    xlsWriteLabel($tablebody, $kolombody++, $data->cara_masuk);
	    xlsWriteLabel($tablebody, $kolombody++, $data->tanggal_daftar);
	    xlsWriteNumber($tablebody, $kolombody++, $data->kode_dokter_penanggung_jawab);
	    xlsWriteNumber($tablebody, $kolombody++, $data->id_poli);
	    xlsWriteLabel($tablebody, $kolombody++, $data->nama_penanggung_jawab);
	    xlsWriteLabel($tablebody, $kolombody++, $data->hubungan_dengan_penanggung_jawab);
	    xlsWriteLabel($tablebody, $kolombody++, $data->alamat_penanggung_jawab);
	    xlsWriteNumber($tablebody, $kolombody++, $data->id_jenis_bayar);
	    xlsWriteLabel($tablebody, $kolombody++, $data->asal_rujukan);

	    $tablebody++;
            $nourut++;
        }

        xlsEOF();
        exit();
    }

    public function word()
    {
        header("Content-type: application/vnd.ms-word");
        header("Content-Disposition: attachment;Filename=tbl_pendaftaran.doc");

        $data = array(
            'tbl_pendaftaran_data' => $this->Tbl_pendaftaran_model->get_all(),
            'start' => 0
        );
        
        $this->load->view('pendaftaran/tbl_pendaftaran_doc',$data);
    }
    
    function pemberi_tindakan_ajax(){
        $tindakan_oleh = $_GET['tindakan_oleh'];
        echo "<table class='table table-bordered'>";
        if($tindakan_oleh=='petugas'){
            echo "<tr><td width='200'>Nama Petugas</td><td><input required type='text' onkeyup='cari_petugas()' id='txt_nama_petugas' name='nama_petugas' placeholder='Masukan Nama Petugas' class='form-control'></td></tr>";
        }elseif($tindakan_oleh=='dokter'){
            echo "<tr><td width='200'>Nama Dokter</td><td><input required onkeyup='cari_dokter()' id='txt_nama_dokter' type='text' name='nama_dokter' placeholder='Masukan Nama Dokter' class='form-control'></td></tr>";
        }else{
             echo "<tr><td width='200'>Nama Petugas</td><td><input required onkeyup='cari_petugas()' id='txt_nama_petugas' type='text' name='nama_petugas' placeholder='Masukan Nama Petugas' class='form-control'></td></tr>";
             echo "<tr><td>Nama Dokter</td><td><input required type='text' onkeyup='cari_dokter()' id='txt_nama_dokter' name='nama_dokter' placeholder='Masukan Nama Dokter' class='form-control'></td></tr>";
        }
        echo "</table>";
        
    }
    
    function periksa_action(){
        $nama_tindakan  = $this->input->post('nama_tindakan');
        $tindakan       = $this->db->get_where('tbl_tindakan',array('nama_tindakan'=>$nama_tindakan))->row_array();
        $hasil_periksa  = $this->input->post('hasil_periksa');
        $perkembangan   = $this->input->post('perkembangan');
        $no_rawat       = $this->input->post('no_rawat');
        
        $data = array(  'no_rawat'      =>  $no_rawat,
                        'hasil_periksa' =>  $hasil_periksa,
                        'perkembangan'  =>  $perkembangan,
                        'kode_tindakan' =>  $tindakan['kode_tindakan'],
                        'tanggal'       =>  date('Y-m-d'));
         $this->db->insert('tbl_riwayat_tindakan',$data);
         
         $id_riwayat_tindakan = $this->db->insert_id();
         // insert history yang memberi tindakan
         $tindakan_oleh = $this->input->post('tindakan_oleh');
         if($tindakan_oleh=='dokter'){
             $nama_dokter = $this->input->post('nama_dokter');
             $dokter      = $this->db->get_where('tbl_dokter',array('nama_dokter'=>$nama_dokter))->row_array();
             $data = array(
                 'kode_pj'              =>  $dokter['kode_dokter'],
                 'keterangan'           =>  'dokter',
                 'id_riwayat_tindakan'  =>  $id_riwayat_tindakan);
             $this->db->insert('tbl_pj_riwayat_tindakan',$data);
         }elseif($tindakan_oleh=='petugas'){
             $nama_pegawai = $this->input->post('nama_petugas');
             $pegawai = $this->db->get_where('tbl_pegawai',array('nama_pegawai'=>$nama_pegawai))->row_array();
             $data = array(
                 'kode_pj'              =>  $pegawai['nik'],
                 'keterangan'           =>  'petugas',
                 'id_riwayat_tindakan'  =>  $id_riwayat_tindakan);
             $this->db->insert('tbl_pj_riwayat_tindakan',$data);
         }else{
             // data dokter
             $nama_dokter = $this->input->post('nama_dokter');
             $dokter      = $this->db->get_where('tbl_dokter',array('nama_dokter'=>$nama_dokter))->row_array();
             $data_dokter = array(
                 'kode_pj'              =>  $dokter['kode_dokter'],
                 'keterangan'           =>  'dokter',
                 'id_riwayat_tindakan'  =>  $id_riwayat_tindakan);
             $this->db->insert('tbl_pj_riwayat_tindakan',$data_dokter);
             
             // data petugas
             $nama_pegawai = $this->input->post('nama_petugas');
             $pegawai = $this->db->get_where('tbl_pegawai',array('nama_pegawai'=>$nama_pegawai))->row_array();
             $data_pegawai = array(
                 'kode_pj'              =>  $pegawai['nik'],
                 'keterangan'           =>  'petugas',
                 'id_riwayat_tindakan'  =>  $id_riwayat_tindakan);
             $this->db->insert('tbl_pj_riwayat_tindakan',$data_pegawai);
         }
         
         redirect('pendaftaran/detail/'.$no_rawat);
    }
    
    function beriobat_action(){
        $nama_barang    = $this->input->post('nama_obat');
        $kode_barang    = getFieldValue('tbl_obat_alkes_bhp', 'kode_barang', 'nama_barang', $nama_barang);
        $no_rawat       = $this->input->post('no_rawat');
        $tanggal        = date('Y-m-d');
        $jumlah         = $this->input->post('qty');
        $data = array(
            'no_rawat'      =>  $no_rawat,
            'kode_barang'   =>  $kode_barang,
            'tanggal'       =>  $tanggal,
            'jumlah'        =>  $jumlah);
        $this->db->insert('tbl_riwayat_pemberian_obat',$data);
        redirect('pendaftaran/detail/'.$no_rawat);
    }
    
    function sub_periksa_labor_ajax(){
        $nama_periksa = $_GET['nama_periksa'];
        $kode_periksa = getFieldValue('tbl_pemeriksaan_laboratorium', 'kode_periksa', 'nama_periksa', $nama_periksa); 
        echo "<table class='table table-bordered'>
            <tr>
            <th>Nama Pemeriksaan</th>
            <th>Satuan</th>
            <th>Nilai Rujukan</th>
            <th>Hasil</th>
            <th>Keterangan</th></tr>";
        $this->db->where('kode_periksa',$kode_periksa);
        $sub_periksa = $this->db->get('tbl_sub_pemeriksaan_laboratoirum')->result();
        foreach ($sub_periksa as $row){
            echo "
            <tr>
            <td>$row->nama_pemeriksaan</td>
            <td>$row->satuan</td>
            <td>$row->nilai_rujukan</td>
            <td><input type='text' name='hasil-$row->kode_sub_periksa' placeholder='hasil' class='form-control'></td>
            <td><input type='text' name='keterangan-$row->kode_sub_periksa' placeholder='Keterangan' class='form-control'></td>
            </tr>";
        }

        echo"</table>";
    }
    
    function periksa_labor_action(){
        $nama_periksa = $this->input->post('nama_periksa');
        $kode_periksa = getFieldValue('tbl_pemeriksaan_laboratorium', 'kode_periksa', 'nama_periksa', $nama_periksa); 
        // insert tabel riwaway pemeriksaan laboratorium
        
        $riwayat_labor = array(
            'no_rawat'      =>  $this->input->post('no_rawat'),
            'tanggal'       =>  date('Y-m-d'),
            'kode_periksa'  =>  $kode_periksa);
        $this->db->insert('tbl_riwayat_pemeriksaan_laboratorium',$riwayat_labor);
        
        $id_rawat = $this->db->insert_id();

        $this->db->where('kode_periksa',$kode_periksa);
        $sub_periksa = $this->db->get('tbl_sub_pemeriksaan_laboratoirum')->result();
        foreach ($sub_periksa as $row){
            $hasil      = $this->input->post('hasil-'.$row->kode_sub_periksa);
            $keterangan = $this->input->post('keterangan-'.$row->kode_sub_periksa);
            $no_rawat   = $this->input->post('no_rawat');
            $data = array(
                        'hasil'             =>  $hasil,
                        'keterangan'        =>  $keterangan,
                        'id_rawat'          =>  $id_rawat,
                        'kode_sub_periksa'  =>  $row->kode_sub_periksa);
            $this->db->insert('tbl_riwayat_pemeriksaan_laboratorium_detail',$data);
        }
        redirect('pendaftaran/detail/'.$no_rawat);
    }
    
    function cetak_riwayat_labor(){
        $no_rawat = substr($this->uri->uri_string(3),32);
        $sql_daftar = "SELECT pd.no_rekamedis,pd.no_rawat,ps.nama_pasien,td.nama_dokter 
                        FROM 
                        tbl_pendaftaran as pd,tbl_pasien as ps, tbl_dokter as td
                        WHERE pd.no_rekamedis=ps.no_rekamedis and td.kode_dokter=pd.kode_dokter_penanggung_jawab and pd.no_rawat='$no_rawat'";         
        
        $sql_labor    = "SELECT tp.*,tr.tanggal,tr.id_riwayat 
                        FROM tbl_pemeriksaan_laboratorium as tp, tbl_riwayat_pemeriksaan_laboratorium as  tr
                        WHERE tr.kode_periksa=tp.kode_periksa and tr.no_rawat='$no_rawat'";
        $this->load->library('pdf');
        $pdf = new FPDF('l', 'mm', 'A5');
        // membuat halaman baru
        $pdf->AddPage();
        // setting jenis font yang akan digunakan
        $pdf->SetFont('Arial', 'B', 16);
        
        $pdf->Image(base_url().'assets/foto_profil/'.  getInfoRS('logo'),8,0,35);
        //$pdf->Image($file, $x, $y, $w, $h)
        
        // mencetak string 
        $pdf->Cell(190, 7, getInfoRS('nama_rumah_sakit'), 0, 1, 'C');
        $pdf->SetFont('Arial', '', 12);
        $pdf->Cell(190, 7, 'Jl Pesantren Km 2, Cibabat, Cimahi Utara', 0, 1, 'C');
        $pdf->Cell(190, 7, 'No Telpon : +62896232323  Email : rspurwokerto@gmail.com', 0, 1, 'C');
        $pdf->Line(20, 35, 210-20, 35); 
        $pdf->Line(20, 36, 210-20, 36);
        $pdf->Cell(8, 8, '',0,1);
        $pdf->Cell(190, 7, 'HASIL PEMERIKSAAN LABORATORIUM', 0, 1, 'C');
        
        // data pasien
        
         $pasien = $this->db->query($sql_daftar)->row_array();
        
         $pdf->Cell(30, 7, 'NO RM', 0, 0, 'l');
         $pdf->Cell(50, 7, ': '.$pasien['no_rekamedis'], 0, 0, 'l');
         
         $pdf->Cell(50, 7, 'Penanggung Jawab', 0, 0, 'l');
         $pdf->Cell(30, 7, ': '.$pasien['nama_dokter'], 0, 1, 'l');
        
         
         $pdf->Cell(30, 7, 'Nama Pasien', 0, 0, 'l');
         $pdf->Cell(50, 7, ': '.$pasien['nama_pasien'], 0, 0, 'l');
         
         $pdf->Cell(50, 7, 'Dokter Pengirim', 0, 0, 'l');
         $pdf->Cell(30, 7, ': -', 0, 1, 'l');
         
         $pdf->Cell(10,10,'',0,1);
         
         // tabel hasil pemeriksaan
         $pdf->Cell(50, 7, 'Pemeriksaan', 1, 0, 'C');
         $pdf->Cell(20, 7, 'Hasil', 1, 0, 'C');
         $pdf->Cell(20, 7, 'Satuan', 1, 0, 'C');
         $pdf->Cell(50, 7, 'Nilai Rujukan', 1, 0, 'C');
         $pdf->Cell(50, 7, 'Keterangan', 1, 1, 'C');
         
         $pemeriksaan = $this->db->query($sql_labor)->result();
         foreach ($pemeriksaan as $p){
            $pdf->Cell(50, 7, $p->nama_periksa, 1, 0, 'L');
            $pdf->Cell(20, 7, '', 1, 0, 'C');
            $pdf->Cell(20, 7, '', 1, 0, 'C');
            $pdf->Cell(50, 7, '', 1, 0, 'C');
            $pdf->Cell(50, 7, '', 1, 1, 'C');
            
            // sub pemeriksaan
            $sub_periksa_sql = "SELECT ts.nama_pemeriksaan,ts.satuan,ts.nilai_rujukan,td.hasil,td.keterangan 
                                FROM tbl_sub_pemeriksaan_laboratoirum  as ts, tbl_riwayat_pemeriksaan_laboratorium_detail as td
                                WHERE td.kode_sub_periksa=ts.kode_sub_periksa 
                                 and td.id_rawat=$p->id_riwayat";
            $sub_periksa = $this->db->query($sub_periksa_sql)->result();
            foreach ($sub_periksa as $s){
                $pdf->Cell(50, 7, ' - '.$s->nama_pemeriksaan, 1, 0, 'L');
                $pdf->Cell(20, 7, $s->hasil, 1, 0, 'C');
                $pdf->Cell(20, 7, $s->satuan, 1, 0, 'C');
                $pdf->Cell(50, 7, $s->nilai_rujukan, 1, 0, 'C');
                $pdf->Cell(50, 7, $s->keterangan, 1, 1, 'C');
                
            
            }
         }
         

         
         $pdf->Cell(10,7,'',0,1);
         $pdf->Cell(120,7,'',0,0);
         $pdf->Cell(50,7,'Tanggal Cetak : '.date('Y-m-d H:i:s'),0,1,'C');
         $pdf->Cell(120,7,'',0,0);
         $pdf->Cell(50,7,'Petugas Laboratorium',0,1,'C');
         
         $pdf->Cell(10,15,'',0,1);
         
         $pdf->Cell(120,7,'',0,0);
         $pdf->Cell(50,7,'Nuris Akbar',0,1,'C');
        
        $pdf->Output();
    }
    
    function catak_rekamedis(){
        $this->load->library('pdf');
        $pdf = new FPDF('p', 'mm', 'A4');
        // membuat halaman baru
        $pdf->AddPage();
        // setting jenis font yang akan digunakan
        $pdf->SetFont('Arial', '', 13);
        $pdf->Cell(130,7,'',0,0);
        $pdf->Cell(30,7,'Cara bayar : -',0,1);
        
        $pdf->SetFont('Arial', 'B', 16);
        $pdf->Cell(190,30,'',1,1);
        $pdf->Image(base_url().'assets/foto_profil/'.  getInfoRS('logo'),15,18,30);
        $pdf->Text(50, 24, getInfoRS('nama_rumah_sakit'));
        $pdf->SetFont('Arial', '', 13);
        $pdf->Text(50, 31, getInfoRS('alamat'));
        $pdf->Text(50, 37, 'No Telpon : '.getInfoRS('no_telpon').' Email : rslangsa@gmail.com');
        // mencetak string 
        
        $pdf->SetFont('Arial', '', 12);
        $pdf->Cell(190, 7, 'IDENTITAS PASIEN', 1, 1, 'C');
        $pdf->SetFont('Arial', '', 13);
        $pdf->Cell(60, 14, 'NOMOR REKAM MEDIK', 1, 0, 'l');
        $pdf->SetFont('Arial', 'B', 22);
        $pdf->Cell(130, 14, '    000002', 1, 1, 'l');
        
        $pdf->SetFont('Arial', '', 11);
        $pdf->Cell(190, 7, 'NAMA PASIEN    : Alia Jamilah               
                               NAMA IBU : Jamilah', 1, 1, 'l');
        
        $pdf->Cell(130, 7, 'No Identitas         : 1235678901234', 1, 0, 'l');
        $pdf->Cell(60, 7, 'KTP / SIM/ PASPOR', 1, 1, 'l');
         
        $pdf->Cell(130, 7, 'Agama                 : Islam', 1, 0, 'l');
        $pdf->Cell(60, 7, 'Tanggal Lahir : 24-08-1992', 1, 1, 'l');
        $pdf->Cell(130, 7, 'Status                  : Menikah', 1, 0, 'l');
        $pdf->Cell(60, 7, 'Jenis Kelamin : P', 1, 1, 'l');
        $pdf->Cell(130, 7, 'Pekerjaan            : Dosen', 1, 0, 'l');
        $pdf->Cell(60, 7, 'Pendidikan      : S2', 1, 1, 'l');
        $pdf->Cell(190, 7, 'Alamat                 : KP CITAMAN RT 04 RW 16, KEL CIBABAT, KAB CIMAHI UTARA ', 1, 1, 'l');
        $pdf->Cell(40, 14, 'Bila Ada Sesuatu', 1,0, 'l');
        $pdf->Cell(150, 7, 'Nama      : Desi Handayani', 1, 1, 'l');
        $pdf->Cell(40,7,'',0,0);
        $pdf->Cell(150, 7, 'Alamat     : Kp Citaman Rt 01/16, Kel Cibabat, Kec Cimahi Utara - Kota Cimahi', 1, 1, 'l');
        $pdf->Cell(190,7,'*) Lingkari yang sesuai',1,1);
        
        
        $pdf->Cell(22, 7, 'Tanggal', 1, 0, 'l');
        $pdf->Cell(30, 7, 'Poliklinik Tujuan', 1, 0, 'l');
        $pdf->Cell(67, 7, 'Riwayat penyakit / Pemeriksaan', 1, 0, 'l');
        $pdf->Cell(23, 7, 'Diagnosa', 1, 0, 'l');
        $pdf->Cell(35, 7, 'Obat Terapi', 1, 0, 'l');
        $pdf->Cell(13, 7, 'Paraf', 1, 1, 'l');
        
        
        $pdf->Cell(22, 57, '', 1, 0, 'l');
        $pdf->Cell(30, 57, '', 1, 0, 'l');
        $pdf->Cell(67, 57, '', 1, 0, 'l');
        $pdf->Cell(23, 57, '', 1, 0, 'l');
        $pdf->Cell(35, 57, '', 1, 0, 'l');
        $pdf->Cell(13, 57, '', 1, 0, 'l');
        
        $pdf->Output();
    }

}

/* End of file Pendaftaran.php */
/* Location: ./application/controllers/Pendaftaran.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2017-12-04 08:39:11 */
/* http://harviacode.com */