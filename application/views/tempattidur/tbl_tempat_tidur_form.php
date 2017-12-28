<div class="content-wrapper">

    <section class="content">
        <div class="box box-warning box-solid">
            <div class="box-header with-border">
                <h3 class="box-title">INPUT DATA TEMPAT TIDUR</h3>
            </div>
            <form action="<?php echo $action; ?>" method="post">
                
                <table class='table table-bordered>'        
                       <tr><td>Kode Tempat Tidur</td><td><input type="text" class="form-control" placeholder="Kode Tempat Tidur" name="kode_tempat_tidur" value="<?php echo $kode_tempat_tidur; ?>" /> </td></tr>
                    <tr><td>Nama Gedung</td><td><?php echo cmb_dinamis('kode_gedung_rawat_inap', 'tbl_gedung_rawat_inap', 'nama_gedung', 'kode_gedung_rawat_inap', $kode_gedung_rawat_inap, "id='kode_gedung' onChange='tampil_ruangan()'") ?></td></tr>
                    <tr><td width='200'>Nama Ruang Rawat Inap <?php echo form_error('kode_ruang_rawat_inap') ?></td><td>

                            <div id="ruangan">
                               
                                    <?php
                                    $jenis_form = $this->uri->segment(2);
                                    if ($jenis_form == 'create') {
                                        echo "<input type='hidden' name='id' value=''>";
                                        echo ' <select name="kode_ruang_rawat_inap" class="form-control">
                                            <option value="">- Pilih Gedung -</option>
                                            </option>';
                                    } else {
                                        echo "<input type='hidden' name='id' value='".$this->uri->segment(3)."'>";
                                        //$kode_gedung = $_GET['kode_gedung'];
                                        $this->db->where('kode_gedung_rawat_inap', $kode_gedung_rawat_inap);
                                        $data_ruangan = $this->db->get('tbl_ruang_rawat_inap')->result();
                                        echo  '<select name="kode_ruang_rawat_inap" class="form-control">';
                                        foreach ($data_ruangan as $ruangan) {
                                            echo "<option value='$ruangan->kode_ruang_rawat_inap'>$ruangan->nama_ruangan</option>";
                                        }
                                        echo "</select>";
                                    }
                                    ?>
                                </select>
                            </div>
                            <?php //echo datalist_dinamis('kode_ruang_rawat_inap', 'tbl_ruang_rawat_inap', 'nama_ruangan', $kode_ruang_rawat_inap); ?>
                            <!--<input type="text" class="form-control" name="kode_ruang_rawat_inap" id="kode_ruang_rawat_inap" placeholder="Kode Ruang Rawat Inap" value="<?php echo $kode_ruang_rawat_inap; ?>" />--></td></tr>
                    <tr><td width='200'>Status <?php echo form_error('status') ?></td><td><input type="text" readonly="" class="form-control" name="status" id="status" placeholder="Status" value="kosong" /></td></tr>
                    <tr><td></td><td>
                            <button type="submit" class="btn btn-danger"><i class="fa fa-floppy-o"></i> <?php echo $button ?></button> 
                            <a href="<?php echo site_url('tempattidur') ?>" class="btn btn-info"><i class="fa fa-sign-out"></i> Kembali</a></td></tr>
                </table></form>        </div>
</div>
</div>


<script type="text/javascript">
    function tampil_ruangan(){
        var kode_gedung = $("#kode_gedung").val();
        $.ajax({
            url:"<?php echo base_url(); ?>index.php/ruangranap/ajax_list_ruangan",
            data:"kode_gedung="+ kode_gedung,
            success: function(html)
            {
                $("#ruangan").html(html);
            }
        });
    }
</script>