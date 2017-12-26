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
        <h2 style="margin-top:0px">Tbl_pasien Read</h2>
        <table class="table">
	    <tr><td>Nama Pasien</td><td><?php echo $nama_pasien; ?></td></tr>
	    <tr><td>Jenis Kelamin</td><td><?php echo $jenis_kelamin; ?></td></tr>
	    <tr><td>Golongan Darah</td><td><?php echo $golongan_darah; ?></td></tr>
	    <tr><td>Tempat Lahir</td><td><?php echo $tempat_lahir; ?></td></tr>
	    <tr><td>Tanggal Lahir</td><td><?php echo $tanggal_lahir; ?></td></tr>
	    <tr><td>Nama Ibu</td><td><?php echo $nama_ibu; ?></td></tr>
	    <tr><td>Alamat</td><td><?php echo $alamat; ?></td></tr>
	    <tr><td>Id Agama</td><td><?php echo $id_agama; ?></td></tr>
	    <tr><td>Status Menikah</td><td><?php echo $status_menikah; ?></td></tr>
	    <tr><td>No Hp</td><td><?php echo $no_hp; ?></td></tr>
	    <tr><td>Id Pekerjaan</td><td><?php echo $id_pekerjaan; ?></td></tr>
	    <tr><td></td><td><a href="<?php echo site_url('pasien') ?>" class="btn btn-default">Cancel</a></td></tr>
	</table>
        </body>
</html>