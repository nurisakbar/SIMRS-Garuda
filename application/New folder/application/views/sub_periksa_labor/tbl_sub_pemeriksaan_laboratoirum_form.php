<div class="content-wrapper">

    <section class="content">
        <div class="box box-warning box-solid">
            <div class="box-header with-border">
                <h3 class="box-title">INPUT DATA SUB PEMERIKSAAN LABORATOIRUM</h3>
            </div>
            <form action="<?php echo $action; ?>" method="post">

                <table class='table table-bordered>'        
                       <tr><td>Kode Sub Pemeriksaan</td><td> <input type="text" placeholder="Masukan Kode Sub Pemeriksaan" class="form-control" name="kode_sub_periksa" value="<?php echo $kode_sub_periksa; ?>" /> </td></tr>
                    <tr><td width='200'>Nama Periksa <?php echo form_error('kode_periksa') ?></td><td><input type="text" readonly="" class="form-control" name="kode_periksa" id="kode_periksa" placeholder="Kode Periksa" value="<?php echo $kode_periksa; ?>" /></td></tr>
                    <tr><td width='200'>Nama Sub Pemeriksaan <?php echo form_error('nama_pemeriksaan') ?></td><td><input type="text" class="form-control" name="nama_pemeriksaan" id="nama_pemeriksaan" placeholder="Nama Pemeriksaan" value="<?php echo $nama_pemeriksaan; ?>" /></td></tr>
                    <tr><td width='200'>Satuan <?php echo form_error('satuan') ?></td><td><input type="text" class="form-control" name="satuan" id="satuan" placeholder="Satuan" value="<?php echo $satuan; ?>" /></td></tr>
                    <tr><td width='200'>Nilai Rujukan <?php echo form_error('nilai_rujukan') ?></td><td><input type="text" class="form-control" name="nilai_rujukan" id="nilai_rujukan" placeholder="Nilai Rujukan" value="<?php echo $nilai_rujukan; ?>" /></td></tr>
                    <tr><td></td><td>
                            <button type="submit" class="btn btn-danger"><i class="fa fa-floppy-o"></i> <?php echo $button ?></button> 
                            <a href="<?php echo site_url('sub_periksa_labor/index/'.$this->uri->segment(3)) ?>" class="btn btn-info"><i class="fa fa-sign-out"></i> Kembali</a></td></tr>
                </table></form>        </div>
</div>
</div>