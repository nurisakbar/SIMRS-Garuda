<div class="content-wrapper">
    
    <section class="content">
        <div class="box box-warning box-solid">
            <div class="box-header with-border">
                <h3 class="box-title">INPUT DATA BIDANG</h3>
            </div>
            <form action="<?php echo $action; ?>" method="post">
            
<table class='table table-bordered>'        

	    <tr><td width='200'>Nama Bidang <?php echo form_error('nama_bidang') ?></td><td><input type="text" class="form-control" name="nama_bidang" id="nama_bidang" placeholder="Nama Bidang" value="<?php echo $nama_bidang; ?>" /></td></tr>
	    <tr><td></td><td><input type="hidden" name="id_bidang" value="<?php echo $id_bidang; ?>" /> 
	    <button type="submit" class="btn btn-danger"><i class="fa fa-floppy-o"></i> <?php echo $button ?></button> 
	    <a href="<?php echo site_url('bidang') ?>" class="btn btn-info"><i class="fa fa-sign-out"></i> Kembali</a></td></tr>
	</table></form>        </div>
</div>
</div>