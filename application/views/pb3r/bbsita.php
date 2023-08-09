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
        <?php include_once('_list_bbsita.php'); ?>
    </div>
</div>

<?php
// $newArra = [];
foreach($dataInkracth as $row) {
  $newArra[] = array('year' => $row->tahun, 'ba20' => $row->ba20, 'ba23' => $row->ba23);
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
        label: 'BA20',
        data: data.map(row => row.ba20),
        borderWidth: 1
      }, {
        label: 'BA23',
        data: data.map(row => row.ba23),
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