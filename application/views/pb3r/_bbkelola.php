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
$yearArr = [];
$collectedData = ['dikembalikan' => 0, 'dirampas' => 0, 'dimusnahkan' => 0];
foreach($dataInkracth as $row) {
  // $newArra[] = array('year' => $row->tahun, 'bb' => $row->jmlbb, 'perkara' => $row->jmlperkara);

  if (!in_array($row->tahun, $yearArr)) {
    $yearArr['year'] = $row->tahun;
  }

  if ($row->eksekusi == 'dikembalikan' && !isset($collectedData[$row->eksekusi])) {
    $collectedData['dikembalikan'] = 0;
  } else {
    $collectedData['dikembalikan'] += 1;
  }

  if ($row->eksekusi == 'dirampas' && !isset($collectedData[$row->eksekusi])) {
    $collectedData['dirampas'] = 0;
  } else {
    $collectedData['dirampas'] += 1;
  }

  if ($row->eksekusi == 'dimusnahkan' && !isset($collectedData[$row->eksekusi])) {
    $collectedData['dimusnahkan'] = 0;
  } else {
    $collectedData['dimusnahkan'] += 1;
  }
  
}

$newArra = array_merge($yearArr, $collectedData);
echo json_encode($newArra);
// echo json_encode($yearArr);
// echo json_encode($collectedData);
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
        label: 'Di Kembalikan',
        data: data.map(row => {
          return (row.eksekusi == 'dikembalikan') ? 1 : 0
        }),
        borderWidth: 1
      }, {
        label: 'Di Rampas',
        data: data.map(row => {
          return (row.eksekusi === 'dirampas') ? 1 : 0
        }),
        borderWidth: 1
      }, {
        label: 'Di Musnahkan',
        data: data.map(row => {
          return (row.eksekusi === 'dimusnahkan') ? 1 : 0
        }),
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