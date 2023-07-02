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
                    <li>Keputusan Presiden Nomor : 11 Tahun 2021 tentang Satuan Tugas Percepatan Investasi ;</li>
                    <li>Keputusan Ketua Satuan Tugas Percepatan Investasi Nomor 121 Tahun 2021 Tentang Tim Pelaksana Satuan Tugas Percepatan Investasi.</li>
                </ol>

                <?php include_once('_list_investasi.php'); ?>

                Catatan : <br>
                Adminitrasi terkait : <br>
                <div class="row">
                    <div class="col-md-12">
                        a. Wakil Jaksa Agung sebagai Wakil Ketua I Satgas Investasi ;<br>
                        b. Koordinator Bidang Intelijen, Bidang Pidana Umum, Bidang Pidana Khusus dan Bidang Perdata dan TUN sebagai Anggota Bidang Penyelesaian Permasalahan Investasi <br>
                        c. Kasubdit Keuangan dan Kekayaan Negara pada JAMINTEL KEJAGUNG RI sebagai Anggota Bidang Percepatan Sektor Prioritas Untuk Mendapatkan Devisa/Pendapatan Negara <br>
                        d. Kepala Biro Hukum pada JAMBIN KEJAGUNG RI sebagai Anggota Bidang Hukum ;<br>
                        e. Kajati KALTIMTARA sebagai Tim Bidang Percepatan Investasi Kewilayahan KALTIMTARA.
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