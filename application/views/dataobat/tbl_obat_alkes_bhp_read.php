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
        <h2 style="margin-top:0px">Tbl_obat_alkes_bhp Read</h2>
        <table class="table">
	    <tr><td>Nama Barang</td><td><?php echo $nama_barang; ?></td></tr>
	    <tr><td>Id Kategori Barang</td><td><?php echo $id_kategori_barang; ?></td></tr>
	    <tr><td>Id Satuan Barang</td><td><?php echo $id_satuan_barang; ?></td></tr>
	    <tr><td>Harga</td><td><?php echo $harga; ?></td></tr>
	    <tr><td></td><td><a href="<?php echo site_url('dataobat') ?>" class="btn btn-default">Cancel</a></td></tr>
	</table>
        </body>
</html>