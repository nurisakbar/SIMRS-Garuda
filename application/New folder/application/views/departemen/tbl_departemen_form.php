<div class="content-wrapper">
    
    <section class="content">
        <div class="box box-warning box-solid">
            <div class="box-header with-border">
                <h3 class="box-title">INPUT DATA DEPARTEMEN</h3>
            </div>
            <form action="<?php echo $action; ?>" method="post">
            
<table class='table table-bordered>'        

	    <tr><td width='200'>Nama Departemen <?php echo form_error('nama_departemen') ?></td><td><input type="text" class="form-control" name="nama_departemen" id="nama_departemen" placeholder="Nama Departemen" value="<?php echo $nama_departemen; ?>" /></td></tr>
	    <tr><td></td><td><input type="hidden" name="id_departemen" value="<?php echo $id_departemen; ?>" /> 
	    <button type="submit" class="btn btn-danger"><i class="fa fa-floppy-o"></i> <?php echo $button ?></button> 
	    <a href="<?php echo site_url('departemen') ?>" class="btn btn-info"><i class="fa fa-sign-out"></i> Kembali</a></td></tr>
	</table></form>        </div>
</div>
</div>