<div class="content-wrapper">
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box box-warning box-solid">
                    <div class="box-header">
                        <h3 class="box-title">BIODATA PASIEN</h3>
                    </div>

                    <div class="box-body">
                        <table class="table table-bordered" style="margin-bottom: 10px">
                            <tr><td width="200">No Rawat</td><td><?php echo $pendaftaran['no_rawat'] ?></td></tr>
                            <tr><td>No Rekamedis</td><td><?php echo $pendaftaran['no_rekamedis'] ?></td></tr>
                            <tr><td>Nama Pasien</td><td><?php echo $pendaftaran['nama_pasien'] ?></td></tr>
                        </table>


                        <!-- untuk input Tindakan!>
                        
                        <!-- Button trigger modal -->
                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal">
                            Input Tindakan
                        </button>

                        <!-- Trigger the modal with a button -->
                        <button type="button" class="btn btn-info" data-toggle="modal" data-target="#inputObat">Input Obat</button>


                        <button type="button" class="btn btn-info" data-toggle="modal" data-target="#inputLabor">Pemeriksaan Laboratorium</button>
                        <?php echo anchor('pendaftaran/cetak_riwayat_labor/'.$no_rawat,'Cetak Laporan Pemeriksaan Laboratorium',"class='btn btn-danger' target='new'")?>

                        <!-- Modal -->
                        <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                            <div class="modal-dialog modal-lg" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                        <h4 class="modal-title" id="myModalLabel">Input Tindakan</h4>
                                    </div>
                                    <div class="modal-body">
                                        <?php echo form_open('pendaftaran/periksa_action') ?>
                                        <table class="table table-bordered">
                                            <input value="<?php echo $no_rawat; ?>" type="hidden" name="no_rawat">
                                            <tr><td width="200">Dilakukan Oleh</td><td>
                                                    <?php echo form_dropdown('tindakan_oleh', array('dokter' => 'Dokter', 'petugas' => 'Petugas', 'dokter_dan_petugas' => 'Dokter Dan petugas'), null, array('class' => 'form-control', 'id' => 'tindakan_oleh', 'onChange' => 'pemberi_tindakan()')); ?>

                                                </td></tr>
                                            <tr><td>Nama Tindakan</td><td>
                                                    <input type="text" id='txt_cari_tindakan' required   placeholder="Masukan Nama Tindakan" name="nama_tindakan" class="form-control ui-autocomplete-input">
                                                </td>
                                            </tr>
                                            <tr><td>Hasil Periksa</td><td><input type="text" required name="hasil_periksa" placeholder="masukan hasil Periksa" class="form-control"></td></tr>
                                            <tr><td>Perkembangan</td><td><input type="text" required name="perkembangan" placeholder="masukan perkembangan sekarang" class="form-control"></td></tr>
                                        </table>
                                        <div class="tindakan_by">
                                            <table class="table table-bordered">
                                                <tr><td width="200">Masukan Nama Dokter</td><td><input required onkeyup="cari_dokter()" type="text" id="txt_nama_dokter" name="nama_dokter" placeholder="Masukan Nama Dokter" class="form-control"></td></tr>
                                            </table>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
                                        <button type="submit" class="btn btn-primary">Simpan Data</button>
                                    </div>
                                    </form>
                                </div>
                            </div>
                        </div>




                        <!-- Form Input Obat -->

                        <!-- Modal -->
                        <div id="inputObat" class="modal fade" role="dialog">
                            <div class="modal-dialog modal-lg">

                                <!-- Modal content-->
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                        <h4 class="modal-title">Form Pemberian Obat</h4>
                                    </div>
                                    <?php echo form_open('pendaftaran/beriobat_action'); ?>
                                    <div class="modal-body">
                                        <input value="<?php echo $no_rawat; ?>" type="hidden" name="no_rawat">
                                        <table class="table table-bordered">
                                            <tr><td>Cari Obat</td><td><input type="text" name="nama_obat" id="txt_nama_obat" onkeyup="cari_obat()" placeholder="Cari obat" class="form-control"></td></tr>
                                            <tr><td>Qty</td><td><input type="text" name="qty" placeholder="Qty" class="form-control"></td></tr>
                                        </table>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                        <button type="submit" class="btn btn-danger">Simpan</button>
                                    </div>
                                </div>
                                </form>

                            </div>
                        </div>






                        <!-- Form Input Labor -->

                        <!-- Modal -->
                        <div id="inputLabor" class="modal fade" role="dialog">
                            <div class="modal-dialog modal-lg">

                                <!-- Modal content-->
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                        <h4 class="modal-title">Form Input Hasil Pemeriksaan Laboratorium</h4>
                                    </div>
                                    <?php echo form_open('pendaftaran/periksa_labor_action'); ?>
                                     <input value="<?php echo $no_rawat; ?>" type="hidden" name="no_rawat">
                                    <div class="modal-body">
                                        <input value="<?php echo $no_rawat; ?>" type="hidden" name="no_rawat">
                                        <table class="table table-bordered">
                                            <tr><td>Pemeriksaan</td><td><input type="text" name="nama_periksa" id="txt_periksa_labor" onkeyup="periksa_labor()" placeholder="Masukan Nama Pemeriksaan" class="form-control"></td></tr>

                                        </table>
                                        <div id="sub_periksa_labor">

                                        </div>
                                    </div>

                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                        <button type="submit" class="btn btn-danger">Simpan</button>
                                    </div>
                                </div>
                                </form>

                            </div>
                        </div>










                    </div>
                </div>
            </div>


            <div class="col-xs-12">
                <div class="box box-warning box-solid">
                    <div class="box-header">
                        <h3 class="box-title">RIWAYAT TINDAKAN</h3>

                    </div>

                    <div class="box-body">
                        <table class="table table-bordered" style="margin-bottom: 10px">
                            <tr><th>NO</th><th>Tindakan</th><th>Hasil Periksa</th>
                                <th>Perkembangan</th><th>Tanggal</th><th>tarif</th></tr>
                            <?php
                            $no = 1;
                            $total_tarif = 0;
                            foreach ($tindakan as $t) {
                                echo "<tr>
                                    <td>$no</td>
                                    <td>$t->nama_tindakan</td>
                                    <td>$t->hasil_periksa</td>
                                    <td>$t->perkembangan</td>
                                    <td>$t->tanggal</td>
                                    <td>$t->tarif</td></tr>";
                                $no++;
                                $total_tarif = $total_tarif + $t->tarif;
                            }
                            ?>
                            <tr><td colspan="5" align="right">Total</td><td><b><?php echo $total_tarif; ?></b></td></tr>
                        </table>
                    </div>
                </div>
            </div>



            <div class="col-xs-12">
                <div class="box box-warning box-solid">
                    <div class="box-header">
                        <h3 class="box-title">RIWAYAT PEMBERIAN OBAT</h3>

                    </div>

                    <div class="box-body">
                        <table class="table table-bordered" style="margin-bottom: 10px">
                            <tr><th>NO</th>
                                <th>Nama Obat Dan Alat Kesehatan</th>
                                <th>Tanggal</th>
                                <th>Jumlah</th>
                                <th>Harga</th>
                                <th>Subtotal</th>
                            </tr>
                            <?php
                            $no = 1;
                            $total_biaya_obat = 0;
                            foreach ($riwayat_obat as $r) {
                                echo "<tr>
                                    <td>$no</td>
                                    <td>$r->nama_barang</td>
                                    <td>$r->tanggal</td>
                                    <td>$r->jumlah</td>
                                    <td>$r->harga</td>
                                    <td>" . $r->harga * $r->jumlah . "</td>
                                        </tr>";
                                $no++;
                                $total_biaya_obat = $total_biaya_obat + ($r->harga * $r->jumlah);
                            }
                            ?>
                            <tr><td colspan="5" align="right">Total</td><td><b><?php echo $total_biaya_obat; ?></b></td></tr>
                        </table>
                    </div>
                </div>
            </div>

            <div class="col-xs-12">
                <div class="box box-warning box-solid">
                    <div class="box-header">
                        <h3 class="box-title">RIWAYAT PEMERIKSAAN LABORATORIUM</h3>

                    </div>

                    <div class="box-body">
                        <table class="table table-bordered" style="margin-bottom: 10px">
                            <tr><th>NO</th>
                                <th>Nama Pemeriksaan</th>
                                <th>Satuan</th>
                                <th>Hasil</th>
                                <th>Kerangan</th>
                                <th>Biaya</th>
                            </tr>
                            <?php
                            $no = 1;
                            $total_periksa_labor = 0;
                            foreach ($riwayat_labor as $r) {
                                echo "<tr>
                                    <td>$no</td>
                                    <td>$r->nama_periksa</td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td>$r->tarif</td>
                                    </tr>";
                                
                                $sub_periksa_sql = "SELECT ts.nama_pemeriksaan,ts.satuan,ts.nilai_rujukan,td.hasil,td.keterangan 
                                                FROM tbl_sub_pemeriksaan_laboratoirum  as ts, tbl_riwayat_pemeriksaan_laboratorium_detail as td
                                                WHERE td.kode_sub_periksa=ts.kode_sub_periksa 
                                                and td.id_rawat=$r->id_riwayat";
                                $sub_periksa = $this->db->query($sub_periksa_sql)->result();
                                foreach ($sub_periksa as $s){                                                              
                                    echo "<tr>
                                    <td></td><td>$s->nama_pemeriksaan</td>
                                        
                                    <td>$s->satuan</td>
                                    <td>$s->hasil</td>
                                    <td>$s->keterangan</td>
                                    <td></td>
                                    </tr>";
                                }
                                
                                $no++;
                                $total_periksa_labor = $total_periksa_labor + $r->tarif;
                            }
                            ?>
                            <tr><td colspan="5" align="right">Total</td><td><b><?php echo $total_periksa_labor; ?></b></td></tr>
                        </table>
                    </div>
                </div>
            </div>


        </div>
    </section>
</div>

<script src="<?php echo base_url('assets/js/jquery-1.11.2.min.js') ?>"></script>
<script src="<?php echo base_url('assets/datatables/jquery.dataTables.js') ?>"></script>
<script src="<?php echo base_url('assets/datatables/dataTables.bootstrap.js') ?>"></script>


<script type="text/javascript">

    function cari_dokter(){
        

        // autocomplate untuk nama dokter
        $("#txt_nama_dokter").autocomplete({
            source: "<?php echo base_url() ?>/index.php/dokter/autocomplate",
            minLength: 1
        });
    }
    
    function cari_petugas(){
        // autocomplate untuk nama petugas
        $("#txt_nama_petugas").autocomplete({
            source: "<?php echo base_url() ?>/index.php/pegawai/autocomplate",
            minLength: 1
        });
    }
    
    function cari_obat(){
        // autocomplate untuk nama petugas
        $("#txt_nama_obat").autocomplete({
            source: "<?php echo base_url() ?>/index.php/dataobat/autocomplate",
            minLength: 1
        });
    }
    
    function pemberi_tindakan(){
        var tindakan_oleh = $('#tindakan_oleh').val();
        $.ajax({
            url:"<?php echo base_url(); ?>index.php/pendaftaran/pemberi_tindakan_ajax",
            data:"tindakan_oleh="+tindakan_oleh ,
            success: function(html)
            {
                $(".tindakan_by").html(html);
            }
        });
    }
    
    function periksa_labor(){
        //autocomplete tindakan
        $("#txt_periksa_labor").autocomplete({
            source: "<?php echo base_url() ?>/index.php/periksalabor/autocomplate",
            minLength: 1
        });
        sub_periksa_labor();
    }
    
    function sub_periksa_labor(){
        var nama_periksa_labor = $("#txt_periksa_labor").val();
        $.ajax({
            url:"<?php echo base_url(); ?>index.php/pendaftaran/sub_periksa_labor_ajax",
            data:"nama_periksa="+ nama_periksa_labor,
            success: function(html)
            {
                $("#sub_periksa_labor").html(html);
            }
        });
    }
</script>

<script type="text/javascript">
    $(function() {
        //autocomplete tindakan
        $("#txt_cari_tindakan").autocomplete({
            source: "<?php echo base_url() ?>/index.php/data_tindakan/autocomplate",
            minLength: 1
        });
    });
</script>
