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
        <h2 style="margin-top:0px">Tbl_pegawai Read</h2>
        <table class="table">
	    <tr><td>Nama Pegawai</td><td><?php echo $nama_pegawai; ?></td></tr>
	    <tr><td>Jenis Kelamin</td><td><?php echo $jenis_kelamin; ?></td></tr>
	    <tr><td>Npwp</td><td><?php echo $npwp; ?></td></tr>
	    <tr><td>Id Jenjang Pendidikan</td><td><?php echo $id_jenjang_pendidikan; ?></td></tr>
	    <tr><td>Tempat Lahir</td><td><?php echo $tempat_lahir; ?></td></tr>
	    <tr><td>Tanggal Lahir</td><td><?php echo $tanggal_lahir; ?></td></tr>
	    <tr><td>Id Jabatan</td><td><?php echo $id_jabatan; ?></td></tr>
	    <tr><td>Kode Jenjang</td><td><?php echo $kode_jenjang; ?></td></tr>
	    <tr><td>Id Departemen</td><td><?php echo $id_departemen; ?></td></tr>
	    <tr><td>Id Bidang</td><td><?php echo $id_bidang; ?></td></tr>
	    <tr><td></td><td><a href="<?php echo site_url('pegawai') ?>" class="btn btn-default">Cancel</a></td></tr>
	</table>
        </body>
</html>