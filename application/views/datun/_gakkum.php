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
                <h4 class="pull-left">DATA PERKARA</h4>
                <div class="pull-right">
                    <button type="button" class="btn btn-info" data-toggle="modal" data-target="#myModalPerkara"><i class="glyphicon glyphicon-plus"></i> Tambah Data</button>
                </div>
                <div class="clearfix"></div>
            </div>
            <div class="panel-body">
                <?php include_once('_list_bankum.php'); ?>
            </div>
        </div>    
  </div>
</div>

<?php
// $newArra = [];
$yearArr = [];
$collectedData = ['perdata' => 0, 'tun' => 0];
foreach($dataDatun as $row) {
    //   $newArra[] = array('tahun' => $row->tahun, 'perkara' => $row->perkara, 'hasil' => preg_replace('/[^0-9\s]/', '', $row->hasil));
    if (!in_array($row->created_at, $yearArr)) {
        $yearArr['year'] = date('Y', strtotime($row->created_at));
    }

    $jenis_perkara = strtolower($row->jenis_perkara);
    if (!isset($collectedData[$jenis_perkara])) {
        if($jenis_perkara == 'perdata') $collectedData['perdata'] = 0;
    } else {
        if($jenis_perkara == 'perdata') $collectedData['perdata'] += 1;
    }

    if (!isset($collectedData[$jenis_perkara])) {
        if($jenis_perkara == 'tun') $collectedData['tun'] = 0;
    } else {
        if($jenis_perkara == 'tun') $collectedData['tun'] += 1;
    }
}

$newArra[] = array_merge($yearArr, $collectedData);
// echo json_encode($newArra);
?>

<script src="<?= base_url(); ?>assets/plugins/chartjs/v4.3.3/Chart.min.js"></script>
<script>
    const ctx = document.getElementById('myChart');

    Chart.defaults.font.family = "Teko";
    Chart.defaults.font.size = 22;
    Chart.defaults.color = "black";

    const data = <?=json_encode($newArra);?>;
    
    let barChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: data.map(row => row.year),
            datasets: [{
                label: 'Perdata',
                data: data.map(row => row.perdata),
                borderWidth: 1
            }, {
                label: 'Tun',
                data: data.map(row => row.tun),
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

    // let densityData = {
    //     label: 'Density of Planets (kg/m3)',
    //     data: [5427, 5243, 5514, 3933, 1326, 687, 1271, 1638]
    // };

    // let barChart = new Chart(ctx, {
    //     type: 'bar',
    //     data: {
    //         labels: ["Mercury", "Venus", "Earth", "Mars", "Jupiter", "Saturn", "Uranus", "Neptune"],
    //         datasets: [densityData]
    //     }
    // });
  
    $(document).ready(function () {
        $('#example1').DataTable();
    });
</script>