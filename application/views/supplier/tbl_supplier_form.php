<div class="content-wrapper">

    <section class="content">
        <div class="box box-warning box-solid">
            <div class="box-header with-border">
                <h3 class="box-title">INPUT DATA SUPPLIER</h3>
            </div>
            <form action="<?php echo $action; ?>" method="post">

                <table class='table table-bordered>'        
                       <tr><td>Kode Supplier</td><td><input type="text" class="form-control" placeholder="Kode Supplier" name="kode_supplier" value="<?php echo $kode_supplier; ?>" /></td><tr>
                       <tr><td width='200'>Nama Supplier <?php echo form_error('nama_supplier') ?></td><td><input type="text" class="form-control" name="nama_supplier" id="nama_supplier" placeholder="Nama Supplier" value="<?php echo $nama_supplier; ?>" /></td></tr>

                    <tr><td width='200'>Alamat <?php echo form_error('alamat') ?></td><td> <textarea class="form-control" rows="3" name="alamat" id="alamat" placeholder="Alamat"><?php echo $alamat; ?></textarea></td></tr>
                    <tr><td width='200'>No Telpon <?php echo form_error('no_telpon') ?></td><td><input type="text" class="form-control" name="no_telpon" id="no_telpon" placeholder="No Telpon" value="<?php echo $no_telpon; ?>" /></td></tr>
                    <tr><td></td><td> 
                            <button type="submit" class="btn btn-danger"><i class="fa fa-floppy-o"></i> <?php echo $button ?></button> 
                            <a href="<?php echo site_url('supplier') ?>" class="btn btn-info"><i class="fa fa-sign-out"></i> Kembali</a></td></tr>
                </table></form>        </div>
</div>
</div>