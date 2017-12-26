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
        <h2 style="margin-top:0px">Tbl_jadwal_praktek_dokter Read</h2>
        <table class="table">
	    <tr><td>Kode Dokter</td><td><?php echo $kode_dokter; ?></td></tr>
	    <tr><td>Hari</td><td><?php echo $hari; ?></td></tr>
	    <tr><td>Jam Mulai</td><td><?php echo $jam_mulai; ?></td></tr>
	    <tr><td>Jam Selesai</td><td><?php echo $jam_selesai; ?></td></tr>
	    <tr><td>Id Poliklinik</td><td><?php echo $id_poliklinik; ?></td></tr>
	    <tr><td></td><td><a href="<?php echo site_url('jadwalpraktek') ?>" class="btn btn-default">Cancel</a></td></tr>
	</table>
        </body>
</html>