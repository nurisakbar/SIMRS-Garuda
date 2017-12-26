<div class="content-wrapper">

    <section class="content">
        <div class="box box-warning box-solid">
            <div class="box-header with-border">
                <h3 class="box-title">FORM PENGADAAN OBAT ALKES BHP</h3>
            </div>

            <table class='table table-bordered>'        
                   <tr><td>No Faktur</td><td><?php echo $no_faktur; ?></td></tr>
                <tr><td width='200'>Tanggal <?php echo form_error('tanggal') ?></td>
                    <td><?php echo $tanggal; ?></td></tr>
                <tr><td width='200'>Supplier <?php echo form_error('kode_supplier') ?></td>
                    <td><?php echo $kode_supplier; ?></td></tr>
                
                <tr><td></td><td>
                        <button type="button" class="btn btn-danger" onclick="add()">Cetak Laporan</button>
                        
                        <a href="<?php echo site_url('pengadaan') ?>" class="btn btn-info"><i class="fa fa-sign-out"></i> Kembali</a></td></tr>
            </table></form>        </div>
        <div class="box box-warning box-solid">
            <div class="box-header with-border">
                <h3 class="box-title">DAFTAR ITEM YANG DIBELI </h3>
            </div>
            <?php
            echo "<table class='table table-bordered'>
                <tr><th>NO</th><th>NAMA BARANG</th><th>QTY</th><th>HARGA</th></tr>";
        $list = $this->db->query($sql)->result();
        $no=1;
        foreach ($list as $row){
            echo "<tr>
                <td width='10'>$no</td>
                <td>$row->nama_barang</td>
                <td width='20'>$row->qty</td>
                <td width='100'>$row->harga</td>
                </td>
                </tr>";
            $no++;
        }
        echo" </table>";
            ?>


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
            url:"<?php echo base_url() ?>index.php/pengadaan/add_ajax",
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
            url:"<?php echo base_url() ?>index.php/pengadaan/list_pengadaan",
            data:"faktur="+faktur ,
            success: function(html)
            {
                $("#list").html(html);
            }
        });
    }
        
    function hapus(id){
        $.ajax({
            url:"<?php echo base_url() ?>index.php/pengadaan/hapus_ajax",
            data:"id_pengadaan=" + id ,
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