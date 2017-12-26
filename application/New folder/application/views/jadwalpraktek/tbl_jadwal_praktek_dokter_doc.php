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
        <h2>Tbl_jadwal_praktek_dokter List</h2>
        <table class="word-table" style="margin-bottom: 10px">
            <tr>
                <th>No</th>
		<th>Kode Dokter</th>
		<th>Hari</th>
		<th>Jam Mulai</th>
		<th>Jam Selesai</th>
		<th>Id Poliklinik</th>
		
            </tr><?php
            foreach ($jadwalpraktek_data as $jadwalpraktek)
            {
                ?>
                <tr>
		      <td><?php echo ++$start ?></td>
		      <td><?php echo $jadwalpraktek->kode_dokter ?></td>
		      <td><?php echo $jadwalpraktek->hari ?></td>
		      <td><?php echo $jadwalpraktek->jam_mulai ?></td>
		      <td><?php echo $jadwalpraktek->jam_selesai ?></td>
		      <td><?php echo $jadwalpraktek->id_poliklinik ?></td>	
                </tr>
                <?php
            }
            ?>
        </table>
    </body>
</html>