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
        <h2 style="margin-top:0px">Tbl_dokter Read</h2>
        <table class="table">
	    <tr><td>Nama Dokter</td><td><?php echo $nama_dokter; ?></td></tr>
	    <tr><td>Jenis Kelamin</td><td><?php echo $jenis_kelamin; ?></td></tr>
	    <tr><td>Tempat Lahir</td><td><?php echo $tempat_lahir; ?></td></tr>
	    <tr><td>Tanggal Lahir</td><td><?php echo $tanggal_lahir; ?></td></tr>
	    <tr><td>Id Agama</td><td><?php echo $id_agama; ?></td></tr>
	    <tr><td>Alamat Tinggal</td><td><?php echo $alamat_tinggal; ?></td></tr>
	    <tr><td>No Hp</td><td><?php echo $no_hp; ?></td></tr>
	    <tr><td>Id Status Menikah</td><td><?php echo $id_status_menikah; ?></td></tr>
	    <tr><td>Id Spesialis</td><td><?php echo $id_spesialis; ?></td></tr>
	    <tr><td>No Izin Praktek</td><td><?php echo $no_izin_praktek; ?></td></tr>
	    <tr><td>Golongan Darah</td><td><?php echo $golongan_darah; ?></td></tr>
	    <tr><td>Alumni</td><td><?php echo $alumni; ?></td></tr>
	    <tr><td></td><td><a href="<?php echo site_url('dokter') ?>" class="btn btn-default">Cancel</a></td></tr>
	</table>
        </body>
</html>