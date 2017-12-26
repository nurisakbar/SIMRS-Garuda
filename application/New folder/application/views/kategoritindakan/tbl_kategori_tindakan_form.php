<div class="content-wrapper">

    <section class="content">
        <div class="box box-warning box-solid">
            <div class="box-header with-border">
                <h3 class="box-title">INPUT DATA KATEGORI TINDAKAN</h3>
            </div>
            <form action="<?php echo $action; ?>" method="post">

                <table class='table table-bordered>'        
                       <tr><td>Kode Kategori</td><td><input type="text" class="form-control" placeholder="Kode Kategori Tindakan" name="kode_kategori_tindakan" value="<?php echo $kode_kategori_tindakan; ?>" /></td></tr>
                    <tr><td width='200'>Kategori Tindakan <?php echo form_error('kategori_tindakan') ?></td><td><input type="text" class="form-control" name="kategori_tindakan" id="kategori_tindakan" placeholder="Kategori Tindakan" value="<?php echo $kategori_tindakan; ?>" /></td></tr>
                    
                    <tr><td></td><td> 
                            <button type="submit" class="btn btn-danger"><i class="fa fa-floppy-o"></i> <?php echo $button ?></button> 
                            <a href="<?php echo site_url('kategoritindakan') ?>" class="btn btn-info"><i class="fa fa-sign-out"></i> Kembali</a></td></tr>
                </table></form>        </div>
</div>
</div>