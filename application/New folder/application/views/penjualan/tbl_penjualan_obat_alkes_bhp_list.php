<div class="content-wrapper">
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box box-warning box-solid">

                    <div class="box-header">
                        <h3 class="box-title">LAPORAN PENJUALAN OBAT ALKES BHP</h3>
                    </div>

                    <div class="box-body">
                        <div class='row'>
                            <div class='col-md-9'>
                                <div style="padding-bottom: 10px;"'>
                                    <?php echo anchor(site_url('penjualan/create'), '<i class="fa fa-wpforms" aria-hidden="true"></i> Tambah Data', 'class="btn btn-danger btn-sm"'); ?></div>
                            </div>
                            <div class='col-md-3'>
                                <form action="<?php echo site_url('penjualan/index'); ?>" class="form-inline" method="get">
                                    <div class="input-group">
                                        <input type="text" class="form-control" name="q" value="<?php echo $q; ?>">
                                        <span class="input-group-btn">
                                            <?php
                                            if ($q <> '') {
                                                ?>
                                                <a href="<?php echo site_url('penjualan'); ?>" class="btn btn-default">Reset</a>
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
                                <th>No</th>
                                <th>No Faktur</th>
                                <th>Tanggal</th>
                                <th>Action</th>
                            </tr><?php
                                    foreach ($penjualan_data as $penjualan) {
                                        ?>
                                <tr>
                                    <td width="10px"><?php echo++$start ?></td>
                                    <td><?php echo $penjualan->no_faktur ?></td>
                                    <td><?php echo $penjualan->tanggal ?></td>
                                    <td style="text-align:center" width="10px">
                                        <?php
                                        //echo anchor(site_url('penjualan/read/'.$penjualan->no_faktur),'<i class="fa fa-eye" aria-hidden="true"></i>','class="btn btn-danger btn-sm"'); 
                                        //echo '  '; 
                                        //echo anchor(site_url('penjualan/update/' . $penjualan->no_faktur), '<i class="fa fa-pencil-square-o" aria-hidden="true"></i>', 'class="btn btn-danger btn-sm"');
                                        //echo '  ';
                                        echo anchor(site_url('penjualan/delete/' . $penjualan->no_faktur), '<i class="fa fa-trash-o" aria-hidden="true"></i>', 'class="btn btn-danger btn-sm" Delete', 'onclick="javasciprt: return confirm(\'Are You Sure ?\')"');
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