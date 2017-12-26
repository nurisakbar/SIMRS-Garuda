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
        <h2>Tbl_pendaftaran List</h2>
        <table class="word-table" style="margin-bottom: 10px">
            <tr>
                <th>No</th>
		<th>No Registrasi</th>
		<th>No Rekamedis</th>
		<th>Cara Masuk</th>
		<th>Tanggal Daftar</th>
		<th>Kode Dokter Penanggung Jawab</th>
		<th>Id Poli</th>
		<th>Nama Penanggung Jawab</th>
		<th>Hubungan Dengan Penanggung Jawab</th>
		<th>Alamat Penanggung Jawab</th>
		<th>Id Jenis Bayar</th>
		<th>Asal Rujukan</th>
		
            </tr><?php
            foreach ($pendaftaran_data as $pendaftaran)
            {
                ?>
                <tr>
		      <td><?php echo ++$start ?></td>
		      <td><?php echo $pendaftaran->no_registrasi ?></td>
		      <td><?php echo $pendaftaran->no_rekamedis ?></td>
		      <td><?php echo $pendaftaran->cara_masuk ?></td>
		      <td><?php echo $pendaftaran->tanggal_daftar ?></td>
		      <td><?php echo $pendaftaran->kode_dokter_penanggung_jawab ?></td>
		      <td><?php echo $pendaftaran->id_poli ?></td>
		      <td><?php echo $pendaftaran->nama_penanggung_jawab ?></td>
		      <td><?php echo $pendaftaran->hubungan_dengan_penanggung_jawab ?></td>
		      <td><?php echo $pendaftaran->alamat_penanggung_jawab ?></td>
		      <td><?php echo $pendaftaran->id_jenis_bayar ?></td>
		      <td><?php echo $pendaftaran->asal_rujukan ?></td>	
                </tr>
                <?php
            }
            ?>
        </table>
    </body>
</html>