<div class="content-wrapper">

    <section class="content">
        <div class="box box-warning box-solid">
            <div class="box-header with-border">
                <h3 class="box-title">INPUT DATA PEMERIKSAAN LABORATORIUM</h3>
            </div>
            <form action="<?php echo $action; ?>" method="post">

                <table class='table table-bordered>'        
                       <tr><td>Kode Periksa</td><td><input type="text" placeholder="Kode Periksa" class="form-control" name="kode_periksa" value="<?php echo $kode_periksa; ?>" /> </td></tr>
                       <tr><td width='200'>Nama Periksa <?php echo form_error('nama_periksa') ?></td><td><input type="text" class="form-control" name="nama_periksa" id="nama_periksa" placeholder="Nama Periksa" value="<?php echo $nama_periksa; ?>" /></td></tr>
                    <tr><td width='200'>Tarif <?php echo form_error('tarif') ?></td><td><input type="text" class="form-control" name="tarif" id="tarif" placeholder="Tarif" value="<?php echo $tarif; ?>" /></td></tr>
                    <tr><td></td><td> 
                            <button type="submit" class="btn btn-danger"><i class="fa fa-floppy-o"></i> <?php echo $button ?></button> 
                            <a href="<?php echo site_url('periksalabor') ?>" class="btn btn-info"><i class="fa fa-sign-out"></i> Kembali</a></td></tr>
                </table></form>        </div>
</div>
</div>