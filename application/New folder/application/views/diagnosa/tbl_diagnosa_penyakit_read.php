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
        <h2 style="margin-top:0px">Tbl_diagnosa_penyakit Read</h2>
        <table class="table">
	    <tr><td>Nama Penyakit</td><td><?php echo $nama_penyakit; ?></td></tr>
	    <tr><td>Ciri Ciri Penyakit</td><td><?php echo $ciri_ciri_penyakit; ?></td></tr>
	    <tr><td>Keterangan</td><td><?php echo $keterangan; ?></td></tr>
	    <tr><td>Ciri Ciri Umum</td><td><?php echo $ciri_ciri_umum; ?></td></tr>
	    <tr><td></td><td><a href="<?php echo site_url('diagnosa') ?>" class="btn btn-default">Cancel</a></td></tr>
	</table>
        </body>
</html>