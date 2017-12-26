<div class="content-wrapper">

    <section class="content">
        <div class="box box-warning box-solid">
            <div class="box-header with-border">
                <h3 class="box-title">PROFIL RUMAH SAKIT</h3>
            </div>
            <form enctype="multipart/form-data" action="<?php echo $action; ?>" method="post">

                <table class='table table-bordered>'        

                       <tr><td width='200'>Nama Rumah Sakit <?php echo form_error('nama_rumah_sakit') ?></td><td><input type="text" class="form-control" name="nama_rumah_sakit" id="nama_rumah_sakit" placeholder="Nama Rumah Sakit" value="<?php echo $nama_rumah_sakit; ?>" /></td>
                        <td rowspan="5" width="300">
                            <p>Logo Rumah Sakit</p>
                            <img src="<?php echo base_url()?>assets\foto_profil/<?php echo $logo;?>" width="250px" borde="1">
                        </td></tr>

                    <tr><td width='200'>Alamat <?php echo form_error('alamat') ?></td><td> <textarea class="form-control" rows="3" name="alamat" id="alamat" placeholder="Alamat"><?php echo $alamat; ?></textarea></td></tr>
                    <tr><td width='200'>Propinsi <?php echo form_error('propinsi') ?></td><td><input type="text" class="form-control" name="propinsi" id="propinsi" placeholder="Propinsi" value="<?php echo $propinsi; ?>" /></td></tr>
                    <tr><td width='200'>Kabupaten <?php echo form_error('kabupaten') ?></td><td><input type="text" class="form-control" name="kabupaten" id="kabupaten" placeholder="Kabupaten" value="<?php echo $kabupaten; ?>" /></td></tr>
                    <tr><td width='200'>No Telpon <?php echo form_error('no_telpon') ?></td><td><input type="text" class="form-control" name="no_telpon" id="no_telpon" placeholder="No Telpon" value="<?php echo $no_telpon; ?>" /></td></tr>

                    <tr><td width='200'>Logo <?php echo form_error('logo') ?></td><td> 
                            <input type="file" name="logo">
                           </td></tr>
                    <tr><td></td><td><input type="hidden" name="id" value="<?php echo $id; ?>" /> 
                            <button type="submit" class="btn btn-danger"><i class="fa fa-floppy-o"></i> <?php echo $button ?></button> 
                            <a href="<?php echo site_url('profile') ?>" class="btn btn-info"><i class="fa fa-sign-out"></i> Kembali</a></td></tr>
                </table></form>        </div>
</div>
</div>