<div class="content-wrapper">

    <section class="content">
        <div class="box box-warning box-solid">
            <div class="box-header with-border">
                <h3 class="box-title">INPUT DATA PASIEN</h3>
            </div>
            <form action="<?php echo $action; ?>" method="post">

                <table class='table table-bordered>'        
                       <tr><td width='200'>No Rekemedis <?php echo form_error('no_rekemedis') ?></td><td><input type="text" class="form-control" id="no_rekamedis" placeholder="No Rekemedis" name="no_rekamedis" value="<?php echo $no_rekamedis?>" /> </td></tr>
                    <tr><td width='200'>Nama Pasien <?php echo form_error('nama_pasien') ?></td><td><input type="text" class="form-control" name="nama_pasien" id="nama_pasien" placeholder="Nama Pasien" value="<?php echo $nama_pasien; ?>" /></td></tr>
                    <tr><td width='200'>Jenis Kelamin <?php echo form_error('jenis_kelamin') ?></td><td>
                             <?php echo form_dropdown('jenis_kelamin', array('L' => 'LAKI LAKI', 'P' => 'PEREMPUAN'), $jenis_kelamin, array('class' => 'form-control')); ?>
                            
                            <!--<input type="text" class="form-control" name="jenis_kelamin" id="jenis_kelamin" placeholder="Jenis Kelamin" value="<?php echo $jenis_kelamin; ?>" />--></td></tr>
                    <tr><td width='200'>Golongan Darah <?php echo form_error('golongan_darah') ?></td><td>
                            <?php echo form_dropdown('golongan_darah', array('A' => 'A', 'B' => 'B'), $golongan_darah, array('class' => 'form-control')); ?>

                            <!--<input type="text" class="form-control" name="golongan_darah" id="golongan_darah" placeholder="Golongan Darah" value="<?php echo $golongan_darah; ?>" />--></td></tr>
                    <tr><td width='200'>Tempat Lahir <?php echo form_error('tempat_lahir') ?></td><td><input type="text" class="form-control" name="tempat_lahir" id="tempat_lahir" placeholder="Tempat Lahir" value="<?php echo $tempat_lahir; ?>" /></td></tr>
                    <tr><td width='200'>Tanggal Lahir <?php echo form_error('tanggal_lahir') ?></td><td><input type="date" class="form-control" name="tanggal_lahir" id="tanggal_lahir" placeholder="Tanggal Lahir" value="<?php echo $tanggal_lahir; ?>" /></td></tr>
                    <tr><td width='200'>Nama Ibu <?php echo form_error('nama_ibu') ?></td><td><input type="text" class="form-control" name="nama_ibu" id="nama_ibu" placeholder="Nama Ibu" value="<?php echo $nama_ibu; ?>" /></td></tr>

                    <tr><td width='200'>Alamat <?php echo form_error('alamat') ?></td><td> <textarea class="form-control" rows="3" name="alamat" id="alamat" placeholder="Alamat"><?php echo $alamat; ?></textarea></td></tr>
                    <tr><td width='200'>Agama <?php echo form_error('id_agama') ?></td><td>
                            <?php echo cmb_dinamis('id_agama', 'tbl_agama', 'agama', 'id_agama',$id_agama)?>
                            <!--<input type="text" class="form-control" name="id_agama" id="id_agama" placeholder="Id Agama" value="<?php echo $id_agama; ?>" /></td></tr>
                    <tr><td width='200'>Status Menikah <?php echo form_error('status_menikah') ?></td><td><input type="text" class="form-control" name="status_menikah" id="status_menikah" placeholder="Status Menikah" value="<?php echo $status_menikah; ?>" />--></td></tr>
                    <tr><td width='200'>No Hp <?php echo form_error('no_hp') ?></td><td><input type="text" class="form-control" name="no_hp" id="no_hp" placeholder="No Hp" value="<?php echo $no_hp; ?>" /></td></tr>
                    <tr><td width='200'>Pekerjaan <?php echo form_error('id_pekerjaan') ?></td><td>
                            <?php echo cmb_dinamis('id_pekerjaan', 'tbl_pekerjaan', 'nama_pekerjaan', 'id_pekerjaan',$id_pekerjaan);?>
                            <!--<input type="text" class="form-control" name="id_pekerjaan" id="id_pekerjaan" placeholder="Id Pekerjaan" value="<?php echo $id_pekerjaan; ?>" />--></td></tr>
                    
                    <tr><td width='200'>Status menikah <?php echo form_error('status_menikah') ?></td><td>
                            <?php echo cmb_dinamis('status_menikah', 'tbl_status_menikah', 'status_menikah', 'id_status_menikah',$status_menikah);?>
                            
                    <tr><td></td><td>
                            <button type="submit" class="btn btn-danger"><i class="fa fa-floppy-o"></i> <?php echo $button ?></button> 
                            <a href="<?php echo site_url('pasien') ?>" class="btn btn-info"><i class="fa fa-sign-out"></i> Kembali</a></td></tr>
                </table></form>        </div>
</div>
</div>