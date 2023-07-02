<div class="msg" style="display:none;">
  <?php echo @$this->session->flashdata('msg'); ?>
</div>

<div class="panel panel-default">
  <div class="panel-body m0">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h4 class="pull-left">DATA PERKARA</h4>
                <div class="pull-right">
                    <button type="button" class="btn btn-info" data-toggle="modal" data-target="#myModalPerkara"><i class="glyphicon glyphicon-plus"></i> Tambah Data</button>
                </div>
                <div class="clearfix"></div>
            </div>
            <div class="panel-body">
                Dasar Hukum : <br>
                <ol>
                    <li>Surat Jaksa Agung RI Nomor : B-151/A/SUJA/10/2019 tanggal 30 Oktober 2019, perihal : Petunjuk Dalam Rangka Optimalisasi Tugas, Fungsi dan Kewenangan Kejaksaan RI ;</li>
                    <li>Petunjuk Teknis Nomor : B-484/D/Dpp/03/2020 tanggal 12 Maret 2020 tentang Pelaksanaan Kegiatan Pengamanan Pembangunan Strategis ;</li>
                    <li>Surat Edaran Nomor : 1 Tanggal 21 Februari 2020 Tentang Pengamanan Program Pembangunan Perumahan Masyarakat Berpenghasilan Rendah Di Seluruh Indonesia ;</li>
                    <li>Surat Perintah Opearsi Intelijen Yustisial .....</li>
                    <li>L.IN.28.</li>
                </ol>
                
                <?php include_once('_list_proyek.php'); ?>

                Catatan : <br>
                Adminitrasi terkait : <br>
                <div class="row">
                    <div class="col-md-3">
                        1. Register Kerja Intelijen (R.IN.3) ;<br>
                        2. Telaahan Intelijen (L.IN.7) ;<br>
                        3. Analisa Sasaran (IN.4) ;<br>
                    </div>
                    <div class="col-md-3">
                        4. Analisa Tugas (IN.5) ;<br>
                        5. Surat Perintah Tugas (IN.1) ;<br>
                        6. Laporan Hasil Pelaksanaan Tugas (L.IN.4) ;<br>
                    </div>
                    <div class="col-md-3">
                        7. Surat Perintah Pengamanan Pembangunan Strategis (IN.2) ;<br>
                        8. Target Operasi (IN.6) ;<br>
                        9. Rencana Penyelidikan (IN.7) ;<br>
                    </div>
                    <div class="col-md-3">
                        10. Laporan Kegiatan Pengamanan Pembangunan Strategis ;<br>
                        11. Perkiraan Keadaan (KIRKA) Intelijen (L.IN.8).<br>
                    </div>
                </div>
            </div>
        </div>
  </div>
</div>


<script>
$(document).ready(function () {
    $('#example1').DataTable();
});
</script>