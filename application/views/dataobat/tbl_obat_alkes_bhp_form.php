<div class="content-wrapper">

    <section class="content">
        <div class="box box-warning box-solid">
            <div class="box-header with-border">
                <h3 class="box-title">INPUT DATA OBAT ALKES BHP</h3>
            </div>
            <form action="<?php echo $action; ?>" method="post">

                <table class='table table-bordered>'        
                       <tr><td>Kode Barang</td><td><input type="text" placeholder="Kode Barang" name="kode_barang" value="<?php echo $kode_barang; ?>" class="form-control" /> </td></tr>
                       <tr><td width='200'>Nama Barang <?php echo form_error('nama_barang') ?></td><td><input type="text" class="form-control" name="nama_barang" id="nama_barang" placeholder="Nama Barang" value="<?php echo $nama_barang; ?>" /></td></tr>
                    <tr><td width='200'>Kategori Barang <?php echo form_error('id_kategori_barang') ?></td><td>
                            <?php echo cmb_dinamis('id_kategori_barang', 'tbl_kategori_barang', 'nama_kategori', 'id_kategori_barang',$id_kategori_barang)?>
                            <!--<input type="text" class="form-control" name="id_kategori_barang" id="id_kategori_barang" placeholder="Id Kategori Barang" value="<?php echo $id_kategori_barang; ?>" />--></td></tr>
                    <tr><td width='200'>Satuan Barang <?php echo form_error('id_satuan_barang') ?></td><td>
                            <?php echo cmb_dinamis('id_satuan_barang', 'tbl_satuan_barang', 'nama_satuan', 'id_satuan',$id_satuan_barang)?>
                            <!--<input type="text" class="form-control" name="id_satuan_barang" id="id_satuan_barang" placeholder="Id Satuan Barang" value="<?php echo $id_satuan_barang; ?>" />--></td></tr>
                    <tr><td width='200'>Harga <?php echo form_error('harga') ?></td><td><input type="text" class="form-control" name="harga" id="harga" placeholder="Harga" value="<?php echo $harga; ?>" /></td></tr>
                    <tr><td></td><td>
                            <button type="submit" class="btn btn-danger"><i class="fa fa-floppy-o"></i> <?php echo $button ?></button> 
                            <a href="<?php echo site_url('dataobat') ?>" class="btn btn-info"><i class="fa fa-sign-out"></i> Kembali</a></td></tr>
                </table></form>        </div>
</div>
</div>