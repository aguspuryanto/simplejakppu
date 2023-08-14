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
    <?php include_once('_list_bbkelola.php'); ?>
  </div>
</div>

<?php
// $newArra = [];
foreach($dataInkracth as $row) {
  $newArra[] = array('year' => $row->tahun, 'bb' => $row->jmlbb, 'perkara' => $row->jmlperkara);
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
      labels: data.map(row => row.year),
      datasets: [{
        label: 'Barang Bukti',
        data: data.map(row => row.bb),
        borderWidth: 1
      }, {
        label: 'Perkara',
        data: data.map(row => row.perkara),
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