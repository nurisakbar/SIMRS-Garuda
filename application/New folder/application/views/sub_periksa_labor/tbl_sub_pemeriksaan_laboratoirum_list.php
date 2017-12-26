<div class="content-wrapper">
    <section class="content">
        <div class="row">

            <div class="col-xs-12">
                <div class="box box-warning box-solid">
                    <div class="box-header">
                        <h3 class="box-title">DATA PEMERIKSAAN LABORATOIRUM</h3>
                    </div>

                    <table class="table table-bordered">
                        <tr><td width="200px">Kode Periksa</td><td> : <?php echo $periksa_labor['kode_periksa']?></td></tr>
                        <tr><td>Nama Periksa</td><td> : <?php echo $periksa_labor['nama_periksa']?></td></tr>
                        <tr><td>Biaya</td><td> : <?php echo $periksa_labor['tarif']?></td></tr>
                    </table>
                </div>
            </div>

            <div class="col-xs-12">
                <div class="box box-warning box-solid">

                    <div class="box-header">
                        <h3 class="box-title">DATA SUB PEMERIKSAAN LABORATOIRUM</h3>
                    </div>

                    <div class="box-body">


                        <div class='row'>
                            <div class='col-md-9'>
                                <div style="padding-bottom: 10px;"'>
                                    <?php echo anchor(site_url('sub_periksa_labor/create/'.$this->uri->segment(3)), '<i class="fa fa-wpforms" aria-hidden="true"></i> Tambah Data', 'class="btn btn-danger btn-sm"'); ?>
                                    <?php //echo anchor(site_url('sub_periksa_labor/excel'), '<i class="fa fa-file-excel-o" aria-hidden="true"></i> Export Ms Excel', 'class="btn btn-success btn-sm"'); ?>
                                    <?php //echo anchor(site_url('sub_periksa_labor/word'), '<i class="fa fa-file-word-o" aria-hidden="true"></i> Export Ms Word', 'class="btn btn-primary btn-sm"'); ?></div>
                            </div>
                            <div class='col-md-3'>
                                <form action="<?php echo site_url('sub_periksa_labor/index'); ?>" class="form-inline" method="get">
                                    <div class="input-group">
                                        <input type="text" class="form-control" name="q" value="<?php echo $q; ?>">
                                        <span class="input-group-btn">
                                            <?php
                                            if ($q <> '') {
                                                ?>
                                                <a href="<?php echo site_url('sub_periksa_labor'); ?>" class="btn btn-default">Reset</a>
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
                                <th>Kode Sub Periksa</th>
                                <th>Nama Pemeriksaan</th>
                                <th>Satuan</th>
                                <th>Nilai Rujukan</th>
                                <th width="100px">Action</th>
                            </tr><?php
                                    foreach ($sub_periksa_labor_data as $sub_periksa_labor) {
                                        ?>
                                <tr>
                                    <td width="10px"><?php echo++$start ?></td>
                                    <td><?php echo $sub_periksa_labor->kode_sub_periksa ?></td>
                                    <td><?php echo $sub_periksa_labor->nama_pemeriksaan ?></td>
                                    <td><?php echo $sub_periksa_labor->satuan ?></td>
                                    <td><?php echo $sub_periksa_labor->nilai_rujukan ?></td>
                                    <td style="text-align:center" width="100px">
                                        <?php
                                        //echo anchor(site_url('sub_periksa_labor/read/' . $sub_periksa_labor->kode_sub_periksa), '<i class="fa fa-eye" aria-hidden="true"></i>', 'class="btn btn-danger btn-sm"');
                                        //echo '  ';
                                        echo anchor(site_url('sub_periksa_labor/update/' . $sub_periksa_labor->kode_sub_periksa), '<i class="fa fa-pencil-square-o" aria-hidden="true"></i>', 'class="btn btn-danger btn-sm"');
                                        echo '  ';
                                        echo anchor(site_url('sub_periksa_labor/delete/' . $sub_periksa_labor->kode_sub_periksa), '<i class="fa fa-trash-o" aria-hidden="true"></i>', 'class="btn btn-danger btn-sm" Delete', 'onclick="javasciprt: return confirm(\'Are You Sure ?\')"');
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