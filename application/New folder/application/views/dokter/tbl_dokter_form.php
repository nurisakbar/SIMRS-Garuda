<div class="content-wrapper">

    <section class="content">
        <div class="box box-warning box-solid">
            <div class="box-header with-border">
                <h3 class="box-title">INPUT DATA DOKTER</h3>
            </div>
            <form action="<?php echo $action; ?>" method="post">

                <table class='table table-bordered>'        
                        <tr><td width='200'>Kode Dokter <?php echo form_error('kode_dokter') ?></td><td><input type="text" class="form-control" name="kode_dokter" id="kode_dokter" placeholder="Kode Dokter" value="<?php echo $kode_dokter; ?>" /></td></tr>
                       <tr><td width='200'>Nama Dokter <?php echo form_error('nama_dokter') ?></td><td><input type="text" class="form-control" name="nama_dokter" id="nama_dokter" placeholder="Nama Dokter" value="<?php echo $nama_dokter; ?>" /></td></tr>
                    <tr><td width='200'>Jenis Kelamin <?php echo form_error('jenis_kelamin') ?></td><td>
                            <?php echo form_dropdown('jenis_kelamin', array('L' => 'LAKI LAKI', 'P' => 'PEREMPUAN'), $jenis_kelamin, array('class' => 'form-control')); ?>
                            <!--<input type="text" class="form-control" name="jenis_kelamin" id="jenis_kelamin" placeholder="Jenis Kelamin" value="<?php echo $jenis_kelamin; ?>" />--></td></tr>
                    <tr><td width='200'>Tempat Lahir <?php echo form_error('tempat_lahir') ?></td><td><input type="text" class="form-control" name="tempat_lahir" id="tempat_lahir" placeholder="Tempat Lahir" value="<?php echo $tempat_lahir; ?>" /></td></tr>
                    <tr><td width='200'>Tanggal Lahir <?php echo form_error('tanggal_lahir') ?></td><td><input type="date" class="form-control" name="tanggal_lahir" id="tanggal_lahir" placeholder="Tanggal Lahir" value="<?php echo $tanggal_lahir; ?>" /></td></tr>
                    <tr><td width='200'>Agama <?php echo form_error('id_agama') ?></td><td>
                            <?php echo cmb_dinamis('id_agama', 'tbl_agama', 'agama', 'id_agama', $id_agama) ?>
                            <!--<input type="text" class="form-control" name="id_agama" id="id_agama" placeholder="Id Agama" value="<?php echo $id_agama; ?>" />--></td></tr>

                    <tr><td width='200'>Alamat Tinggal <?php echo form_error('alamat_tinggal') ?></td><td> <textarea class="form-control" rows="3" name="alamat_tinggal" id="alamat_tinggal" placeholder="Alamat Tinggal"><?php echo $alamat_tinggal; ?></textarea></td></tr>
                    <tr><td width='200'>No Hp <?php echo form_error('no_hp') ?></td><td><input type="text" class="form-control" name="no_hp" id="no_hp" placeholder="No Hp" value="<?php echo $no_hp; ?>" /></td></tr>
                    <tr><td width='200'>Status Menikah <?php echo form_error('id_status_menikah') ?></td><td>
                            <?php echo cmb_dinamis('id_status_menikah', 'tbl_status_menikah', 'status_menikah', 'id_status_menikah', $id_status_menikah) ?>
                            <!--<input type="text" class="form-control" name="id_status_menikah" id="id_status_menikah" placeholder="Id Status Menikah" value="<?php echo $id_status_menikah; ?>" />--></td></tr>
                    <tr><td width='200'>Spesialis <?php echo form_error('id_spesialis') ?></td><td>
                            <?php echo cmb_dinamis('id_spesialis', 'tbl_spesialis', 'spesialis', 'id_spesialis', $id_spesialis) ?>
                            <!--<input type="text" class="form-control" name="id_spesialis" id="id_spesialis" placeholder="Id Spesialis" value="<?php echo $id_spesialis; ?>" />--></td></tr>
                    <tr><td width='200'>No Izin Praktek <?php echo form_error('no_izin_praktek') ?></td><td><input type="text" class="form-control" name="no_izin_praktek" id="no_izin_praktek" placeholder="No Izin Praktek" value="<?php echo $no_izin_praktek; ?>" /></td></tr>
                    <tr><td width='200'>Golongan Darah <?php echo form_error('golongan_darah') ?></td><td>
                            <?php echo form_dropdown('golongan_darah', array('A' => 'A', 'AB' => 'AB', 'C' => 'C'), $golongan_darah, array('class' => 'form-control')); ?>

<!--<input type="text" class="form-control" name="golongan_darah" id="golongan_darah" placeholder="Golongan Darah" value="<?php echo $golongan_darah; ?>" />--></td></tr>
                    <tr><td width='200'>Alumni <?php echo form_error('alumni') ?></td><td><input type="text" class="form-control" name="alumni" id="alumni" placeholder="Alumni" value="<?php echo $alumni; ?>" /></td></tr>
                    <tr><td></td><td>
                            <!--<input type="hidden" name="kode_dokter" value="<?php echo $kode_dokter; ?>" /> -->
                            <button type="submit" class="btn btn-danger"><i class="fa fa-floppy-o"></i> <?php echo $button ?></button> 
                            <a href="<?php echo site_url('dokter') ?>" class="btn btn-info"><i class="fa fa-sign-out"></i> Kembali</a></td></tr>
                </table></form>        </div>
</div>
</div>