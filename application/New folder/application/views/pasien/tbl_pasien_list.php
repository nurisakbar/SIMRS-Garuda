<div class="content-wrapper">
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box box-warning box-solid">

                    <div class="box-header">
                        <h3 class="box-title">KELOLA DATA PASIEN</h3>
                    </div>

                    <div class="box-body">
                        <div class='row'>
                            <div class='col-md-9'>
                                <div style="padding-bottom: 10px;"'>
                                    <?php echo anchor(site_url('pasien/create'), '<i class="fa fa-wpforms" aria-hidden="true"></i> Tambah Data', 'class="btn btn-danger btn-sm"'); ?></div>
                            </div>
                            <div class='col-md-3'>
                                <form action="<?php echo site_url('pasien/index'); ?>" class="form-inline" method="get">
                                    <div class="input-group">
                                        <input type="text" class="form-control" name="q" value="<?php echo $q; ?>">
                                        <span class="input-group-btn">
                                            <?php
                                            if ($q <> '') {
                                                ?>
                                                <a href="<?php echo site_url('pasien'); ?>" class="btn btn-default">Reset</a>
                                                <?php
                                            }
                                            ?>
                                            <button class="btn btn-primary" type="submit">Search</button>
                                        </span>
                                    </div>
                                </form>
                            </div>
                        </div>


                        <div class="row" style="margin-bottom: 10px">
                            <div class="col-md-4 text-center">
                                <div style="margin-top: 8px" id="message">
                                    <?php echo $this->session->userdata('message') <> '' ? $this->session->userdata('message') : ''; ?>
                                </div>
                            </div>
                            <div class="col-md-1 text-right">
                            </div>
                            <div class="col-md-3 text-right">

                            </div>
                        </div>
                        <table class="table table-bordered" style="margin-bottom: 10px">
                            <tr>
                                <th>No RM</th>
                                <th>Nama Pasien</th>
                                <th>Gender</th>
                                <th>Gol Darah</th>
                                <th>Tempat Lahir</th>
                                <th>Tanggal Lahir</th>
                                <th>Nama Ibu</th>
  
                                <th>Status Menikah</th>
                                <th>Action</th>
                            </tr><?php
                                    foreach ($pasien_data as $pasien) {
                                        ?>
                                <tr>
                                    <td><?php echo $pasien->no_rekamedis ?></td>
                                    <td><?php echo $pasien->nama_pasien ?></td>
                                    <td><?php echo $pasien->jenis_kelamin=='P'?'Perempuan':'laki Laki'; ?></td>
                                    <td><?php echo $pasien->golongan_darah ?></td>
                                    <td><?php echo $pasien->tempat_lahir ?></td>
                                    <td><?php echo $pasien->tanggal_lahir ?></td>
                                    <td><?php echo $pasien->nama_ibu ?></td>
                                    <td><?php echo $pasien->status_menikah ?></td>
                                    <td style="text-align:center" width="130px">
    <?php
    echo anchor(site_url('pasien/read/' . $pasien->no_rekamedis), '<i class="fa fa-eye" aria-hidden="true"></i>', 'class="btn btn-danger btn-sm"');
    echo '  ';
    echo anchor(site_url('pasien/update/' . $pasien->no_rekamedis), '<i class="fa fa-pencil-square-o" aria-hidden="true"></i>', 'class="btn btn-danger btn-sm"');
    echo '  ';
    echo anchor(site_url('pasien/delete/' . $pasien->no_rekamedis), '<i class="fa fa-trash-o" aria-hidden="true"></i>', 'class="btn btn-danger btn-sm" Delete', 'onclick="javasciprt: return confirm(\'Are You Sure ?\')"');
    ?>
                                    </td>
                                </tr>
    <?php
}
?>
                        </table>
                        <div class="row">
                            <div class="col-md-6">

                            </div>
                            <div class="col-md-6 text-right">
<?php echo $pagination ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>