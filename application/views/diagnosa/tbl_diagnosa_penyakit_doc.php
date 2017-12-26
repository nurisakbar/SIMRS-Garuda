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
        <h2>Tbl_diagnosa_penyakit List</h2>
        <table class="word-table" style="margin-bottom: 10px">
            <tr>
                <th>No</th>
		<th>Nama Penyakit</th>
		<th>Ciri Ciri Penyakit</th>
		<th>Keterangan</th>
		<th>Ciri Ciri Umum</th>
		
            </tr><?php
            foreach ($diagnosa_data as $diagnosa)
            {
                ?>
                <tr>
		      <td><?php echo ++$start ?></td>
		      <td><?php echo $diagnosa->nama_penyakit ?></td>
		      <td><?php echo $diagnosa->ciri_ciri_penyakit ?></td>
		      <td><?php echo $diagnosa->keterangan ?></td>
		      <td><?php echo $diagnosa->ciri_ciri_umum ?></td>	
                </tr>
                <?php
            }
            ?>
        </table>
    </body>
</html>