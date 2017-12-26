<!doctype html>
<html>
    <head>
        <title>harviacode.com - codeigniter crud generator</title>
        <link rel="stylesheet" href="<?php echo base_url('assets/bootstrap/css/bootstrap.min.css') ?>"/>
        <style>
            body{
                padding: 15px;
            }
        </style>
    </head>
    <body>
        <h2 style="margin-top:0px">Tbl_profil_rumah_sakit Read</h2>
        <table class="table">
	    <tr><td>Nama Rumah Sakit</td><td><?php echo $nama_rumah_sakit; ?></td></tr>
	    <tr><td>Alamat</td><td><?php echo $alamat; ?></td></tr>
	    <tr><td>Propinsi</td><td><?php echo $propinsi; ?></td></tr>
	    <tr><td>Kabupaten</td><td><?php echo $kabupaten; ?></td></tr>
	    <tr><td>No Telpon</td><td><?php echo $no_telpon; ?></td></tr>
	    <tr><td>Logo</td><td><?php echo $logo; ?></td></tr>
	    <tr><td></td><td><a href="<?php echo site_url('profile') ?>" class="btn btn-default">Cancel</a></td></tr>
	</table>
        </body>
</html>