<div class="content-wrapper">

    <section class="content">
        <div class="col-md-6">
            <div class="box box-warning box-solid">
                <div class="box-header with-border">
                    <h3 class="box-title">DATA PENDAFTARAN</h3>
                </div>
                <form action="<?php echo $action; ?>" method="post">

                    <table class='table table-bordered>'        

                           <tr><td width='200'>No Registrasi <?php echo form_error('no_registrasi') ?></td><td><input type="text" class="form-control" name="no_registrasi" id="no_registrasi" readonly="" placeholder="No Registrasi" value="<?php echo noRegOtomatis(); ?>" /></td></tr>
                        <tr><td width='200'>No Rawat <?php echo form_error('no_rawat') ?></td><td><input type="text" class="form-control" name="no_rawat" placeholder="No Rawat" readonly="" value="<?php echo date('Y/m/d/') . noRegOtomatis(); ?>" /></td></tr>
                        <!--<tr><td width='200'>No Rekamedis <?php echo form_error('no_rekamedis') ?></td><td><input type="text" class="form-control" name="no_rekamedis" id="no_rekamedis" placeholder="No Rekamedis" value="<?php echo $no_rekamedis; ?>" /></td></tr>-->
                        <tr><td width='200'>Cara Masuk <?php echo form_error('cara_masuk') ?></td><td>

                                <?php echo form_dropdown('cara_masuk', array('RAWAT JALAN' => 'RAWAT JALAN', 'RAWAT INAP' => 'RAWAT INAP', 'UDG' => 'UGD'), $cara_masuk, array('class' => 'form-control')); ?>
<!--<input type="text" class="form-control" name="cara_masuk" id="cara_masuk" placeholder="Cara Masuk" value="<?php echo $cara_masuk; ?>" /></td></tr>-->
                        <tr><td>Ruangan Dirawat</td><td><input type="text" name="kode_tempat_tidur" placeholder="Masukan Kode Tempat Tidur" class="form-control"></td></tr>
                        <tr><td width='200'>Tanggal Daftar <?php echo form_error('tanggal_daftar') ?></td><td><input type="date" class="form-control" name="tanggal_daftar" id="tanggal_daftar" placeholder="Tanggal Daftar" value="<?php echo date('Y-m-d'); ?>" /></td></tr>
                        <tr><td width='200'>Dokter Penanggung Jawab <?php echo form_error('kode_dokter_penanggung_jawab') ?></td><td><input type="text" class="form-control" name="kode_dokter_penanggung_jawab" id="kode_dokter_penanggung_jawab" placeholder="Masukan Nama Dokter" value="<?php echo $kode_dokter_penanggung_jawab; ?>" /></td></tr>
                        <tr><td width='200'>Poliklinik Tujuan <?php echo form_error('id_poli') ?></td><td>
                                <?php echo cmb_dinamis('id_poli', 'tbl_poliklinik', 'nama_poliklinik', 'id_poliklinik', $id_poli) ?>
                                <!--<input type="text" class="form-control" name="id_poli" id="id_poli" placeholder="Id Poli" value="<?php echo $id_poli; ?>" /></td></tr>-->
                        <!--<tr><td width='200'>Nama Penanggung Jawab <?php echo form_error('nama_penanggung_jawab') ?></td><td><input type="text" class="form-control" name="nama_penanggung_jawab" id="nama_penanggung_jawab" placeholder="Nama Penanggung Jawab" value="<?php echo $nama_penanggung_jawab; ?>" /></td></tr>
                        <tr><td width='200'>Hubungan Dengan Penanggung Jawab <?php echo form_error('hubungan_dengan_penanggung_jawab') ?></td><td><input type="text" class="form-control" name="hubungan_dengan_penanggung_jawab" id="hubungan_dengan_penanggung_jawab" placeholder="Hubungan Dengan Penanggung Jawab" value="<?php echo $hubungan_dengan_penanggung_jawab; ?>" /></td></tr>

                        <tr><td width='200'>Alamat Penanggung Jawab <?php echo form_error('alamat_penanggung_jawab') ?></td><td> <textarea class="form-control" rows="3" name="alamat_penanggung_jawab" id="alamat_penanggung_jawab" placeholder="Alamat Penanggung Jawab"><?php echo $alamat_penanggung_jawab; ?></textarea></td></tr>-->
                        <tr><td width='200'>Jenis Bayar <?php echo form_error('id_jenis_bayar') ?></td><td>
                                <?php echo cmb_dinamis('id_jenis_bayar', 'tbl_jenis_bayar', 'jenis_bayar', 'id_jenis_bayar', $id_jenis_bayar) ?>
                                <!--<input type="text" class="form-control" name="id_jenis_bayar" id="id_jenis_bayar" placeholder="Id Jenis Bayar" value="<?php echo $id_jenis_bayar; ?>" />--></td></tr>
                        <tr><td width='200'>Asal Rujukan <?php echo form_error('asal_rujukan') ?></td><td><input type="text" class="form-control" name="asal_rujukan" id="asal_rujukan" placeholder="Asal Rujukan" value="<?php echo $asal_rujukan; ?>" /></td></tr>
                        <tr><td></td><td>
                                <button type="submit" class="btn btn-danger"><i class="fa fa-floppy-o"></i> <?php echo $button ?></button> 
                                <a href="<?php echo site_url('pendaftaran') ?>" class="btn btn-info"><i class="fa fa-sign-out"></i> Kembali</a></td></tr>
                    </table>        </div>

        </div>
        <div class="col-md-6">
            <div class="box box-warning box-solid">
                <div class="box-header with-border">
                    <h3 class="box-title">DATA PASIEN</h3>
                </div>
                <form action="<?php echo $action; ?>" method="post">

                    <table class='table table-bordered>'        


                           <tr><td width='200'>No Rekamedis <?php echo form_error('no_rekamedis') ?></td><td><input type="text" class="form-control" name="no_rekamedis" onkeyup="autocomplate_norekmedis()" id="no_rekamedis" placeholder="Masukan No Rekamedis" value="<?php echo $no_rekamedis; ?>" /></td></tr>
                           <!--<tr><td width='200'>Cara Masuk <?php echo form_error('cara_masuk') ?></td><td><input type="text" class="form-control" name="cara_masuk" id="cara_masuk" placeholder="Cara Masuk" value="<?php echo $cara_masuk; ?>" /></td></tr>-->
                           <!--<tr><td width='200'>Tanggal Daftar <?php echo form_error('tanggal_daftar') ?></td><td><input type="text" class="form-control" name="tanggal_daftar" id="tanggal_daftar" placeholder="Tanggal Daftar" value="<?php echo $tanggal_daftar; ?>" /></td></tr>
                           <tr><td width='200'>Kode Dokter Penanggung Jawab <?php echo form_error('kode_dokter_penanggung_jawab') ?></td><td><input type="text" class="form-control" name="kode_dokter_penanggung_jawab" id="kode_dokter_penanggung_jawab" placeholder="Kode Dokter Penanggung Jawab" value="<?php echo $kode_dokter_penanggung_jawab; ?>" /></td></tr>
                           <tr><td width='200'>Id Poli <?php echo form_error('id_poli') ?></td><td><input type="text" class="form-control" name="id_poli" id="id_poli" placeholder="Id Poli" value="<?php echo $id_poli; ?>" /></td></tr>-->

                        <tr><td>Nama pasien</td><td><input type="text" name="nama" id="nama_pasien" class="form-control" placeholder="nama pasien"></td></tr>
                        <tr><td>Tanggal Lahir</td><td><input type="text" name="tanggal_lahir" id="tanggal_lahir" placeholder="tanggal lahir" class="form-control"></td></tr>

                        <tr><td width='200'>Nama Penanggung Jawab <?php echo form_error('nama_penanggung_jawab') ?></td><td><input type="text" class="form-control" name="nama_penanggung_jawab" id="nama_penanggung_jawab" placeholder="Nama Penanggung Jawab" value="<?php echo $nama_penanggung_jawab; ?>" /></td></tr>
                        <tr><td width='200'>Hubungan Dengan Penanggung Jawab <?php echo form_error('hubungan_dengan_penanggung_jawab') ?></td><td>
                                <?php echo form_dropdown('hubungan_dengan_penanggung_jawab', array('saudara kandung' => 'saudara kandung', 'orang tua' => 'orang tua'), $hubungan_dengan_penanggung_jawab, array('class' => 'form-control')) ?>
                                <!--<input type="text" class="form-control" name="hubungan_dengan_penanggung_jawab" id="hubungan_dengan_penanggung_jawab" placeholder="Hubungan Dengan Penanggung Jawab" value="<?php echo $hubungan_dengan_penanggung_jawab; ?>" />--></td></tr>

                        <tr><td width='200'>Alamat Penanggung Jawab <?php echo form_error('alamat_penanggung_jawab') ?></td><td> <textarea class="form-control" rows="3" name="alamat_penanggung_jawab" id="alamat_penanggung_jawab" placeholder="Alamat Penanggung Jawab"><?php echo $alamat_penanggung_jawab; ?></textarea></td></tr>
                        <!--<tr><td width='200'>Id Jenis Bayar <?php echo form_error('id_jenis_bayar') ?></td><td><input type="text" class="form-control" name="id_jenis_bayar" id="id_jenis_bayar" placeholder="Id Jenis Bayar" value="<?php echo $id_jenis_bayar; ?>" /></td></tr>
                        <tr><td width='200'>Asal Rujukan <?php echo form_error('asal_rujukan') ?></td><td><input type="text" class="form-control" name="asal_rujukan" id="asal_rujukan" placeholder="Asal Rujukan" value="<?php echo $asal_rujukan; ?>" /></td></tr>-->

                    </table></form>        </div>
        </div>

</div>
</div>
<script src="<?php echo base_url('assets/js/jquery-1.11.2.min.js') ?>"></script>
<script src="<?php echo base_url('assets/datatables/jquery.dataTables.js') ?>"></script>
<script src="<?php echo base_url('assets/datatables/dataTables.bootstrap.js') ?>"></script>


<script type="text/javascript">
    $(function() {
        //autocomplete
        $("#kode_dokter_penanggung_jawab").autocomplete({
            source: "<?php echo base_url() ?>index.php/pendaftaran/autocomplate_dokter",
            minLength: 1
        });				
    });
</script>

<script type="text/javascript">
    
    function autocomplate_norekmedis(){
        //autocomplete
        $("#no_rekamedis").autocomplete({
            source: "<?php echo base_url() ?>index.php/pendaftaran/autocomplate_no_rekemedis",
            minLength: 1
        });
        autoFill();
    }
    
    function autoFill(){
        var no_rekamedis = $("#no_rekamedis").val();
        $.ajax({
            url: "<?php echo base_url() ?>index.php/pendaftaran/autofill",
            data:"no_rekamedis="+no_rekamedis ,
        }).success(function (data) {
            var json = data,
            obj = JSON.parse(json);
            $('#nama_pasien').val(obj.nama_pasien);
            $('#tanggal_lahir').val(obj.tanggal_lahir);
            //$('#alamat').val(obj.alamat);
        });
    }
</script>