<div class="content-wrapper">
    
    <section class="content">
        <div class="box box-warning box-solid">
            <div class="box-header with-border">
                <h3 class="box-title">INPUT DATA GEDUNG RAWAT INAP</h3>
            </div>
            <form action="<?php echo $action; ?>" method="post">
            
<table class='table table-bordered>'        

	    <tr><td width='200'>Nama Gedung <?php echo form_error('nama_gedung') ?></td><td><input type="text" class="form-control" name="nama_gedung" id="nama_gedung" placeholder="Nama Gedung" value="<?php echo $nama_gedung; ?>" /></td></tr>
	    <tr><td></td><td><input type="hidden" name="kode_gedung_rawat_inap" value="<?php echo $kode_gedung_rawat_inap; ?>" /> 
	    <button type="submit" class="btn btn-danger"><i class="fa fa-floppy-o"></i> <?php echo $button ?></button> 
	    <a href="<?php echo site_url('gedung') ?>" class="btn btn-info"><i class="fa fa-sign-out"></i> Kembali</a></td></tr>
	</table></form>        </div>
</div>
</div>