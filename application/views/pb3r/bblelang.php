<div class="msg" style="display:none;">
  <?php echo @$this->session->flashdata('msg'); ?>
</div>

<div class="panel panel-default">
  <div class="panel-body">
    <canvas id="myChart"></canvas>
  </div>
</div>

<div class="panel panel-default">
    <div class="panel-heading">
        <h4 class="pull-left"><?=@$judul; ?></h4>
        <div class="pull-right">
            <button type="button" class="btn btn-info" data-toggle="modal" data-target="#myModalInkracth"><i class="glyphicon glyphicon-plus"></i> Tambah Data</button>
        </div>
        <div class="clearfix"></div>
    </div>
    <div class="panel-body">
        <?php include_once('_list_bblelang.php'); ?>
    </div>
</div>

<?php
// $newArra = [];
foreach($dataInkracth as $row) {
  $newArra[] = array('tahun' => $row->tahun, 'jml' => $row->jml, 'hasil' => preg_replace('/[^0-9\s]/', '', $row->hasil));
}
// echo json_encode($newArra);
?>

<script src="<?= base_url(); ?>assets/plugins/chartjs/v4.3.3/Chart.min.js"></script>
<script>
  const ctx = document.getElementById('myChart');

  const data = <?=json_encode($newArra);?>;

  new Chart(ctx, {
    type: 'bar',
    data: {
      labels: data.map(row => row.tahun),
      datasets: [{
        label: 'Hasil (Rp)',
        data: data.map(row => row.hasil),
        borderWidth: 1
      }]
    },
    options: {
      scales: {
        y: {
          beginAtZero: true
        }
      }
    }
  });
</script>