<div class="content-wrapper">

    <section class="content">
        <div class="box box-warning box-solid">
            <div class="box-header with-border">
                <h3 class="box-title">FORM INPUT DATA PASIEN BARU</h3>
            </div>

            <div class="row" style="margin-top: 10px;">
                <div class="col-lg-6">
                    <table class="table table-bordered">
                        <tr><td>NO KTP/ NIK</td><td><input type="text" name="no_ktp" placeholder="Masukan No KTP" class="form-control" value=""></td></tr>
                        <tr><td>NO BPJS/ KIS</td><td><input type="text" name="no_bpjs" placeholder="Masukan No BPJS" class="form-control" value=""></td></tr>
                        <tr><td width='200'>No Rekemedis <?php echo form_error('no_rekemedis') ?></td><td><input type="text" class="form-control" id="no_rekamedis" placeholder="No Rekemedis" name="no_rekamedis" value="<?php echo $no_rekamedis ?>" /> </td></tr>
                        <tr><td width='200'>Nama Pasien <?php echo form_error('nama_pasien') ?></td><td><input type="text" class="form-control" name="nama_pasien" id="nama_pasien" placeholder="Nama Pasien" value="<?php echo $nama_pasien; ?>" /></td></tr>
                        <tr><td width='200'>Tempat, Tanggal Lahir <?php echo form_error('tempat_lahir') ?></td><td>
                                <div class="row">
                                    <div class="col-md-7"><input type="text" class="form-control" name="tempat_lahir" id="tempat_lahir" placeholder="Tempat Lahir" value="<?php echo $tempat_lahir; ?>" /></div>
                                    <div class="col-md-5"><input type="text" id="datepicker" class="form-control" name="tanggal_lahir" id="tanggal_lahir" placeholder="Tgl Lahir" value="<?php echo $tanggal_lahir; ?>" /></div>
                                </div>
                            </td></tr>

                        <tr><td width='200'>Nama Ibu <?php echo form_error('nama_ibu') ?></td><td><input type="text" class="form-control" name="nama_ibu" id="nama_ibu" placeholder="Nama Ibu" value="<?php echo $nama_ibu; ?>" /></td></tr>
                        <tr><td width='200'>Jenis Kelamin <?php echo form_error('jenis_kelamin') ?></td><td>
                                <?php echo form_dropdown('jenis_kelamin', array('L' => 'LAKI LAKI', 'P' => 'PEREMPUAN'), $jenis_kelamin, array('class' => 'form-control')); ?>
                        <tr><td width='200'>Golongan Darah <?php echo form_error('golongan_darah') ?></td><td>
                                <?php echo form_dropdown('golongan_darah', array('A' => 'A', 'B' => 'B'), $golongan_darah, array('class' => 'form-control')); ?>
                        <tr><td width='200'>Agama <?php echo form_error('id_agama') ?></td><td>
                                <?php echo cmb_dinamis('id_agama', 'tbl_agama', 'agama', 'id_agama', $id_agama) ?>

                        <tr><td></td><td>
                                <button type="submit" class="btn btn-danger"><i class="fa fa-floppy-o"></i> <?php echo $button ?></button> 
                                <a href="<?php echo site_url('pasien') ?>" class="btn btn-info"><i class="fa fa-sign-out"></i> Kembali</a></td></tr>
                    </table>
                </div>
                <div class="col-lg-6">
                    <table class="table table-bordered">
                        <tr><td width='200'>Alamat <?php echo form_error('alamat') ?></td><td> <input type="text" class="form-control"name="alamat" id="alamat" placeholder="Alamat" value="<?php echo $alamat; ?>"></td></tr>
                        <tr><td>Kecamatan</td><td><input type="text" name="kecamatan" class="form-control" placeholder="Nama Kecamatan"></td></tr>
                        <tr><td>Kabupaten</td><td><input type="text" name="kabupaten" class="form-control" placeholder="Nama Kabupaten"></td></tr>
                        <tr><td width='200'>Pendidikan <?php echo form_error('id_pekerjaan') ?></td><td>
                                <?php echo cmb_dinamis('id_pekerjaan', 'tbl_pekerjaan', 'nama_pekerjaan', 'id_pekerjaan', $id_pekerjaan); ?>
                            <!--<input type="text" class="form-control" name="id_pekerjaan" id="id_pekerjaan" placeholder="Id Pekerjaan" value="<?php echo $id_pekerjaan; ?>" />--></td></tr>

          
                        <tr><td width='200'>Pekerjaan <?php echo form_error('id_pekerjaan') ?></td><td>
                                <?php echo cmb_dinamis('id_pekerjaan', 'tbl_pekerjaan', 'nama_pekerjaan', 'id_pekerjaan', $id_pekerjaan); ?>
                            <!--<input type="text" class="form-control" name="id_pekerjaan" id="id_pekerjaan" placeholder="Id Pekerjaan" value="<?php echo $id_pekerjaan; ?>" />--></td></tr>

                        <tr><td width='200'>Status menikah <?php echo form_error('status_menikah') ?></td><td>
                                <?php echo cmb_dinamis('status_menikah', 'tbl_status_menikah', 'status_menikah', 'id_status_menikah', $status_menikah); ?>
                        <tr><td width='200'>No Hp <?php echo form_error('no_hp') ?></td><td><input type="text" class="form-control" name="no_hp" id="no_hp" placeholder="No Hp" value="<?php echo $no_hp; ?>" /></td></tr>
                    </table>
                </div>
            </div

            </form>        
        </div>
    </section>
</div>
</div>