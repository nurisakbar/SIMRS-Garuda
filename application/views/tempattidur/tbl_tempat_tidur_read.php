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
        <h2 style="margin-top:0px">Tbl_tempat_tidur Read</h2>
        <table class="table">
	    <tr><td>Kode Ruang Rawat Inap</td><td><?php echo $kode_ruang_rawat_inap; ?></td></tr>
	    <tr><td>Status</td><td><?php echo $status; ?></td></tr>
	    <tr><td></td><td><a href="<?php echo site_url('tempattidur') ?>" class="btn btn-default">Cancel</a></td></tr>
	</table>
        </body>
</html>