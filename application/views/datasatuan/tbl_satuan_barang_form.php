<div class="content-wrapper">
    
    <section class="content">
        <div class="box box-warning box-solid">
            <div class="box-header with-border">
                <h3 class="box-title">INPUT DATA SATUAN BARANG</h3>
            </div>
            <form action="<?php echo $action; ?>" method="post">
            
<table class='table table-bordered>'        

	    <tr><td width='200'>Nama Satuan <?php echo form_error('nama_satuan') ?></td><td><input type="text" class="form-control" name="nama_satuan" id="nama_satuan" placeholder="Nama Satuan" value="<?php echo $nama_satuan; ?>" /></td></tr>
	    <tr><td></td><td><input type="hidden" name="id_satuan" value="<?php echo $id_satuan; ?>" /> 
	    <button type="submit" class="btn btn-danger"><i class="fa fa-floppy-o"></i> <?php echo $button ?></button> 
	    <a href="<?php echo site_url('datasatuan') ?>" class="btn btn-info"><i class="fa fa-sign-out"></i> Kembali</a></td></tr>
	</table></form>        </div>
</div>
</div>