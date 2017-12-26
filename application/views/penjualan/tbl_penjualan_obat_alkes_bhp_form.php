<div class="content-wrapper">

    <section class="content">
        <div class="box box-warning box-solid">
            <div class="box-header with-border">
                <h3 class="box-title">FORM PENJUALAN OBAT ALKES BHP</h3>
            </div>
            <form action="<?php echo $action; ?>" method="post">

                <table class='table table-bordered>'        
                       <tr><td>No Faktur</td><td><input id="nofaktur" onKeyup="load()" placeholder="Masukan No Faktur" class="form-control" type="text" name="no_faktur" value="<?php echo $no_faktur; ?>" /> </td></tr>
                    <tr><td width='200'>Tanggal <?php echo form_error('tanggal') ?></td><td><input type="date" class="form-control" name="tanggal" id="tanggal" placeholder="Tanggal" value="<?php echo $tanggal; ?>" /></td></tr>
                    
                    <tr><td>Cari Barang</td><td>
                            <div class="row">
                                <div class=" col-xs-7">
                                    <input type="text" id="barang" placeholder="Masukan Nama Barang" class="form-control">
                                </div>
                                <!--<div class=" col-xs-2"><input type="text" id="harga" placeholder="harga" class="form-control"></div>-->
                                <div class=" col-xs-1"><input type="text" id="qty" placeholder="Qty" value="1" class="form-control"></div>
                            </div>
                        </td></tr>
                    <tr><td></td><td>
                            <button type="button" class="btn btn-danger" onclick="add()">Add Barang</button>
                            <button type="submit" class="btn btn-danger"><i class="fa fa-floppy-o"></i> <?php echo $button ?></button> 
                            <a href="<?php echo site_url('penjualan') ?>" class="btn btn-info"><i class="fa fa-sign-out"></i> Kembali</a></td></tr>
                </table></form>        </div>
        <div class="box box-warning box-solid">
            <div class="box-header with-border">
                <h3 class="box-title">DAFTAR ITEM YANG DIBELI </h3>
            </div>
            <div id="list">

            </div>


        </div>
</div>
</div>

<script src="<?php echo base_url('assets/js/jquery-1.11.2.min.js') ?>"></script>
<script src="<?php echo base_url('assets/datatables/jquery.dataTables.js') ?>"></script>
<script src="<?php echo base_url('assets/datatables/dataTables.bootstrap.js') ?>"></script>

<script type="text/javascript">
    $(function() {
        //autocomplete
        $("#barang").autocomplete({
            source: "<?php echo base_url() ?>/index.php/dataobat/autocomplate",
            minLength: 1
        });				
    });
</script>

<script type="text/javascript">
    function add(){
        var barang = $("#barang").val();
        var harga = $("#harga").val();
        var qty = $("#qty").val();
        var faktur = $("#nofaktur").val();
        $.ajax({
            url:"<?php echo base_url() ?>index.php/penjualan/add_ajax",
            data:"barang=" + barang + "&qty="+ qty+"&harga=" + harga + "&faktur="+ faktur ,
            success: function(html)
            {
                load();
            }
        });
    
    }
    
    function load(){
    var faktur = $("#nofaktur").val();
        $.ajax({
            url:"<?php echo base_url() ?>index.php/penjualan/list_penjualan",
            data:"faktur="+faktur ,
            success: function(html)
            {
                $("#list").html(html);
            }
        });
    }
        
    function hapus(id){
        $.ajax({
            url:"<?php echo base_url() ?>index.php/penjualan/hapus_ajax",
            data:"id_penjualan=" + id ,
            success: function(html)
            {
                load();
            }
        });
    }

</script>

<script type="text/javascript">
    $(document).ready(function(){
        //load();             
    });
</script>

<script type="text/javascript">
    $(function() {
        //autocomplete
        $("#kode_supplier").autocomplete({
            source: "<?php echo base_url() ?>index.php/supplier/autocomplate",
            minLength: 1
        });				
    });
</script>