<div class="content-wrapper">
    
    <section class="content">
        <div class="box box-warning box-solid">
            <div class="box-header with-border">
                <h3 class="box-title">INPUT DATA JABATAN</h3>
            </div>
            <form action="<?php echo $action; ?>" method="post">
            
<table class='table table-bordered>'        

	    <tr><td width='200'>Nama Jabatan <?php echo form_error('nama_jabatan') ?></td><td><input type="text" class="form-control" name="nama_jabatan" id="nama_jabatan" placeholder="Nama Jabatan" value="<?php echo $nama_jabatan; ?>" /></td></tr>
	    <tr><td></td><td><input type="hidden" name="id_jabatan" value="<?php echo $id_jabatan; ?>" /> 
	    <button type="submit" class="btn btn-danger"><i class="fa fa-floppy-o"></i> <?php echo $button ?></button> 
	    <a href="<?php echo site_url('jabatan') ?>" class="btn btn-info"><i class="fa fa-sign-out"></i> Kembali</a></td></tr>
	</table></form>        </div>
</div>
</div>