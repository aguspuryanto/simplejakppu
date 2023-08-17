<div class="msg" style="display:none;">
  <?php echo @$this->session->flashdata('msg'); ?>
</div>

<div class="panel panel-default">
  <div class="panel-body">
    <canvas id="myChart"></canvas>
  </div>
</div>

<div class="panel panel-default">
  <div class="panel-body m0">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h4 class="pull-left">DATA PNBP</h4>
                <div class="pull-right">
                    <button type="button" class="btn btn-info" data-toggle="modal" data-target="#myModalPnbp"><i class="glyphicon glyphicon-plus"></i> Tambah Data</button>
                </div>
                <div class="clearfix"></div>
            </div>
            <div class="panel-body">
                <?php include_once('_list_pnbp.php'); ?>
            </div>
        </div>
  </div>
</div>

<?php
// $newArra = [];
foreach($dataPnbp as $row) {
    $newArra[] = array('jenis_pnpb' => $row->jenis_pnpb, 'jumlah_pnpb' => $row->jumlah_pnpb);
    $collectedData[] = array('$row->jenis_pnpb' => 0);

    $jenis_pnpb = strtolower($row->jenis_pnpb);
    if (!isset($collectedData[$jenis_pnpb])) {
        $collectedData[$row->jenis_pnpb] = $row->jumlah_pnpb;
    } else {
        $collectedData[$row->jenis_pnpb] += $row->jumlah_pnpb;
    }
}
// echo json_encode($newArra);
?>


<script>
  const ctx = document.getElementById('myChart');
  const data = <?=json_encode($newArra);?>;

  new Chart(ctx, {
    type: 'bar',
    data: {
      labels: data.map(row => row.jenis_pnpb),
      datasets: [{
        label: 'Jumlah PNPB',
        data: data.map(row => row.jumlah_pnpb),
        backgroundColor: [
            'rgba(54, 162, 235, 0.2)',
            'rgba(153, 102, 255, 0.2)',
        ],
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
<script>
$(document).ready(function () {
    $('#example1').DataTable();
});
</script>