<!doctype html>
<html>
    <head>
        <title>harviacode.com - codeigniter crud generator</title>
        <link rel="stylesheet" href="<?php echo base_url('assets/bootstrap/css/bootstrap.min.css') ?>"/>
        <style>
            .word-table {
                border:1px solid black !important; 
                border-collapse: collapse !important;
                width: 100%;
            }
            .word-table tr th, .word-table tr td{
                border:1px solid black !important; 
                padding: 5px 10px;
            }
        </style>
    </head>
    <body>
        <h2>Tbl_obat_alkes_bhp List</h2>
        <table class="word-table" style="margin-bottom: 10px">
            <tr>
                <th>No</th>
		<th>Nama Barang</th>
		<th>Id Kategori Barang</th>
		<th>Id Satuan Barang</th>
		<th>Harga</th>
		
            </tr><?php
            foreach ($dataobat_data as $dataobat)
            {
                ?>
                <tr>
		      <td><?php echo ++$start ?></td>
		      <td><?php echo $dataobat->nama_barang ?></td>
		      <td><?php echo $dataobat->id_kategori_barang ?></td>
		      <td><?php echo $dataobat->id_satuan_barang ?></td>
		      <td><?php echo $dataobat->harga ?></td>	
                </tr>
                <?php
            }
            ?>
        </table>
    </body>
</html>