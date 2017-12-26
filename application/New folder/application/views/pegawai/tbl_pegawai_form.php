<div class="content-wrapper">

    <section class="content">
        <div class="box box-warning box-solid">
            <div class="box-header with-border">
                <h3 class="box-title">INPUT DATA TBL_PEGAWAI</h3>
            </div>
            <form action="<?php echo $action; ?>" method="post">

                <table class='table table-bordered>'        
                       <tr><td>NIK</td><td><input type="text" placeholder="NIK" name="nik" value="<?php echo $nik; ?>" class="form-control" /> </td></tr>
                       <tr><td width='200'>Nama Pegawai <?php echo form_error('nama_pegawai') ?></td><td><input type="text" class="form-control" name="nama_pegawai" id="nama_pegawai" placeholder="Nama Pegawai" value="<?php echo $nama_pegawai; ?>" /></td></tr>
                    <tr><td width='200'>Jenis Kelamin <?php echo form_error('jenis_kelamin') ?></td><td>
                            <?php echo form_dropdown('jenis_kelamin', array('L' => 'LAKI LAKI', 'P' => 'PEREMPUAN'), $jenis_kelamin, array('class' => 'form-control')); ?>
                            <!--<input type="text" class="form-control" name="jenis_kelamin" id="jenis_kelamin" placeholder="Jenis Kelamin" value="<?php echo $jenis_kelamin; ?>" />--></td></tr>
                    <tr><td width='200'>Npwp <?php echo form_error('npwp') ?></td><td><input type="text" class="form-control" name="npwp" id="npwp" placeholder="Npwp" value="<?php echo $npwp; ?>" /></td></tr>
                    <tr><td width='200'>Jenjang Pendidikan <?php echo form_error('id_jenjang_pendidikan') ?></td><td>
                            <?php echo cmb_dinamis('id_jenjang_pendidikan', 'tbl_jenjang_pendidikan', 'jenjang_pendidikan','id_jenjang_pendidikan', $id_jenjang_pendidikan)?>
                            <!--<input type="text" class="form-control" name="id_jenjang_pendidikan" id="id_jenjang_pendidikan" placeholder="Id Jenjang Pendidikan" value="<?php echo $id_jenjang_pendidikan; ?>" />--></td></tr>
                    <tr><td width='200'>Tempat Lahir <?php echo form_error('tempat_lahir') ?></td><td><input type="text" class="form-control" name="tempat_lahir" id="tempat_lahir" placeholder="Tempat Lahir" value="<?php echo $tempat_lahir; ?>" /></td></tr>
                    <tr><td width='200'>Tanggal Lahir <?php echo form_error('tanggal_lahir') ?></td><td><input type="date" class="form-control" name="tanggal_lahir" id="tanggal_lahir" placeholder="Tanggal Lahir" value="<?php echo $tanggal_lahir; ?>" /></td></tr>
                    <tr><td width='200'>Jabatan <?php echo form_error('id_jabatan') ?></td><td>
                            <?php echo cmb_dinamis('id_jabatan', 'tbl_jabatan', 'nama_jabatan','id_jabatan', $id_jabatan)?>
                            <!--<input type="text" class="form-control" name="id_jabatan" id="id_jabatan" placeholder="Id Jabatan" value="<?php echo $id_jabatan; ?>" />--></td></tr>
                    <tr><td width='200'>Jenjang <?php echo form_error('kode_jenjang') ?></td><td>
                            <?php echo cmb_dinamis('kode_jenjang', 'tbl_jenjang', 'nama_jenjang','kode_jenjang', $kode_jenjang)?>
                            <!--<input type="text" class="form-control" name="kode_jenjang" id="kode_jenjang" placeholder="Kode Jenjang" value="<?php echo $kode_jenjang; ?>" />--></td></tr>
                    <tr><td width='200'>Departemen <?php echo form_error('id_departemen') ?></td><td>
                            <?php echo cmb_dinamis('id_departemen', 'tbl_departemen', 'nama_departemen','id_departemen', $id_departemen)?>
                            <!--<input type="text" class="form-control" name="id_departemen" id="id_departemen" placeholder="Id Departemen" value="<?php echo $id_departemen; ?>" />--></td></tr>
                    <tr><td width='200'>Bidang <?php echo form_error('id_bidang') ?></td><td>
                            <?php echo cmb_dinamis('id_bidang', 'tbl_bidang', 'nama_bidang','id_bidang', $id_bidang)?>
                            <!--<input type="text" class="form-control" name="id_bidang" id="id_bidang" placeholder="Id Bidang" value="<?php echo $id_bidang; ?>" />--></td></tr>
                    <tr><td></td><td><input type="hidden" name="nik" value="<?php echo $nik; ?>" /> 
                            <button type="submit" class="btn btn-danger"><i class="fa fa-floppy-o"></i> <?php echo $button ?></button> 
                            <a href="<?php echo site_url('pegawai') ?>" class="btn btn-info"><i class="fa fa-sign-out"></i> Kembali</a></td></tr>
                </table></form>        </div>
</div>
</div>