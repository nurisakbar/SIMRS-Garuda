<div class="content-wrapper">
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box box-warning box-solid">
    
                    <div class="box-header">
                        <h3 class="box-title">LAPORAN PENDAFTARAN</h3>
                    </div>
        
        <div class="box-body">
            <div class='row'>
            <div class='col-md-9'>
            <div style="padding-bottom: 10px;"'>
        <?php echo anchor(site_url('pendaftaran/create'), '<i class="fa fa-wpforms" aria-hidden="true"></i> Tambah Data', 'class="btn btn-danger btn-sm"'); ?>
		<?php echo anchor(site_url('pendaftaran/excel'), '<i class="fa fa-file-excel-o" aria-hidden="true"></i> Export Ms Excel', 'class="btn btn-success btn-sm"'); ?>
		<?php echo anchor(site_url('pendaftaran/word'), '<i class="fa fa-file-word-o" aria-hidden="true"></i> Export Ms Word', 'class="btn btn-primary btn-sm"'); ?></div>
            </div>
            <div class='col-md-3'>
            <form action="<?php echo site_url('pendaftaran/index'); ?>" class="form-inline" method="get">
                    <div class="input-group">
                        <input type="text" class="form-control" name="q" value="<?php echo $q; ?>">
                        <span class="input-group-btn">
                            <?php 
                                if ($q <> '')
                                {
                                    ?>
                                    <a href="<?php echo site_url('pendaftaran'); ?>" class="btn btn-default">Reset</a>
                                    <?php
                                }
                            ?>
                          <button class="btn btn-primary" type="submit">Search</button>
                        </span>
                    </div>
                </form>
            </div>
            </div>
        
   
        <div class="row" style="margin-bottom: 10px">
            <div class="col-md-4 text-center">
                <div style="margin-top: 8px" id="message">
                    <?php echo $this->session->userdata('message') <> '' ? $this->session->userdata('message') : ''; ?>
                </div>
            </div>
            <div class="col-md-1 text-right">
            </div>
            <div class="col-md-3 text-right">
                
            </div>
        </div>
        <table class="table table-bordered" style="margin-bottom: 10px">
		<th>No Reg</th>
                <th>No Rawat</th>
		<th>No Rekmed</th>
                <th>Nama pasien</th>
		<th>Cara Masuk</th>
		<th>Dokter Penanggung Jawab</th>
                <?php
                if($this->uri->segment(3)=='ralan'){
                            echo "<th>Poliklinik</th>";
                        }else{
                            echo "<th>Nama Ruangan</th>";
                        }
                ?>
		
		<th>Jenis Bayar</th>
		<th>Action</th>
            </tr><?php
            foreach ($pendaftaran_data as $pendaftaran)
            {
                ?>
                <tr>
			<td><?php echo $pendaftaran->no_registrasi ?></td>
                        <td><?php echo $pendaftaran->no_rawat ?></td>
			<td><?php echo $pendaftaran->no_rekamedis ?></td>
                        <td><?php echo $pendaftaran->nama_pasien ?></td>
			<td><?php echo $pendaftaran->cara_masuk ?></td>
			<td><?php echo $pendaftaran->nama_dokter ?></td>
			<td><?php
                        
                        if($this->uri->segment(3)=='ralan'){
                            echo $pendaftaran->nama_poliklinik;
                        }else{
                            // cari data rawat inap
                            $ranap = $this->db->get_where('tbl_rawat_inap',array('no_rawat'=>$pendaftaran->no_rawat))->row_array();
                            $kodeTempatTidur = $ranap['kode_tempat_tidur'];
                            $sqlRuangRanap = "SELECT ri.nama_ruangan 
                                                FROM tbl_tempat_tidur as tt,tbl_ruang_rawat_inap as ri 
                                                WHERE tt.kode_ruang_rawat_inap=ri.kode_ruang_rawat_inap
                                                and tt.kode_tempat_tidur=$kodeTempatTidur";
                            $bed = $this->db->query($sqlRuangRanap)->row_array();
                            echo $bed['nama_ruangan'];
                        }
                         ?></td>
			<td><?php echo $pendaftaran->jenis_bayar ?></td>
			<td style="text-align:center" width="160px">
				<?php 
				echo anchor(site_url('pendaftaran/detail/'.$pendaftaran->no_rawat),'<i class="fa fa-eye" aria-hidden="true"></i>','class="btn btn-danger btn-sm"'); 
				echo '  '; 
				echo anchor(site_url('pendaftaran/update/'.$pendaftaran->no_rawat),'<i class="fa fa-pencil-square-o" aria-hidden="true"></i>','class="btn btn-danger btn-sm"'); 
				echo '  '; 
				echo anchor(site_url('pendaftaran/delete/'.$pendaftaran->no_rawat),'<i class="fa fa-trash-o" aria-hidden="true"></i>','class="btn btn-danger btn-sm" Delete','onclick="javasciprt: return confirm(\'Are You Sure ?\')"'); 
				?>
			</td>
		</tr>
                <?php
            }
            ?>
        </table>
        <div class="row">
            <div class="col-md-6">
                
	    </div>
            <div class="col-md-6 text-right">
                <?php echo $pagination ?>
            </div>
        </div>
        </div>
                    </div>
            </div>
            </div>
    </section>
</div>