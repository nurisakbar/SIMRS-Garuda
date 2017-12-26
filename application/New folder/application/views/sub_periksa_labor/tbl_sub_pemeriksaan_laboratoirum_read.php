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
        <h2 style="margin-top:0px">Tbl_sub_pemeriksaan_laboratoirum Read</h2>
        <table class="table">
	    <tr><td>Kode Periksa</td><td><?php echo $kode_periksa; ?></td></tr>
	    <tr><td>Nama Pemeriksaan</td><td><?php echo $nama_pemeriksaan; ?></td></tr>
	    <tr><td>Satuan</td><td><?php echo $satuan; ?></td></tr>
	    <tr><td>Nilai Rujukan</td><td><?php echo $nilai_rujukan; ?></td></tr>
	    <tr><td></td><td><a href="<?php echo site_url('sub_periksa_labor') ?>" class="btn btn-default">Cancel</a></td></tr>
	</table>
        </body>
</html>