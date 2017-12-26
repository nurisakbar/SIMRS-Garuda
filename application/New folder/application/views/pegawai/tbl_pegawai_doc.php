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
        <h2>Tbl_pegawai List</h2>
        <table class="word-table" style="margin-bottom: 10px">
            <tr>
                <th>No</th>
		<th>Nama Pegawai</th>
		<th>Jenis Kelamin</th>
		<th>Npwp</th>
		<th>Id Jenjang Pendidikan</th>
		<th>Tempat Lahir</th>
		<th>Tanggal Lahir</th>
		<th>Id Jabatan</th>
		<th>Kode Jenjang</th>
		<th>Id Departemen</th>
		<th>Id Bidang</th>
		
            </tr><?php
            foreach ($pegawai_data as $pegawai)
            {
                ?>
                <tr>
		      <td><?php echo ++$start ?></td>
		      <td><?php echo $pegawai->nama_pegawai ?></td>
		      <td><?php echo $pegawai->jenis_kelamin ?></td>
		      <td><?php echo $pegawai->npwp ?></td>
		      <td><?php echo $pegawai->id_jenjang_pendidikan ?></td>
		      <td><?php echo $pegawai->tempat_lahir ?></td>
		      <td><?php echo $pegawai->tanggal_lahir ?></td>
		      <td><?php echo $pegawai->id_jabatan ?></td>
		      <td><?php echo $pegawai->kode_jenjang ?></td>
		      <td><?php echo $pegawai->id_departemen ?></td>
		      <td><?php echo $pegawai->id_bidang ?></td>	
                </tr>
                <?php
            }
            ?>
        </table>
    </body>
</html>