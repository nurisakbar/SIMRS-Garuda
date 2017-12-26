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
        <h2>Tbl_dokter List</h2>
        <table class="word-table" style="margin-bottom: 10px">
            <tr>
                <th>No</th>
		<th>Nama Dokter</th>
		<th>Jenis Kelamin</th>
		<th>Tempat Lahir</th>
		<th>Tanggal Lahir</th>
		<th>Id Agama</th>
		<th>Alamat Tinggal</th>
		<th>No Hp</th>
		<th>Id Status Menikah</th>
		<th>Id Spesialis</th>
		<th>No Izin Praktek</th>
		<th>Golongan Darah</th>
		<th>Alumni</th>
		
            </tr><?php
            foreach ($dokter_data as $dokter)
            {
                ?>
                <tr>
		      <td><?php echo ++$start ?></td>
		      <td><?php echo $dokter->nama_dokter ?></td>
		      <td><?php echo $dokter->jenis_kelamin ?></td>
		      <td><?php echo $dokter->tempat_lahir ?></td>
		      <td><?php echo $dokter->tanggal_lahir ?></td>
		      <td><?php echo $dokter->id_agama ?></td>
		      <td><?php echo $dokter->alamat_tinggal ?></td>
		      <td><?php echo $dokter->no_hp ?></td>
		      <td><?php echo $dokter->id_status_menikah ?></td>
		      <td><?php echo $dokter->id_spesialis ?></td>
		      <td><?php echo $dokter->no_izin_praktek ?></td>
		      <td><?php echo $dokter->golongan_darah ?></td>
		      <td><?php echo $dokter->alumni ?></td>	
                </tr>
                <?php
            }
            ?>
        </table>
    </body>
</html>