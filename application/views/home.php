<div class="row">
  <div class="col-lg-4 col-xs-6">
    <div class="small-box bg-aqua">
      <div class="inner">
        <p>Total Perkara</p>
        <h3><?php echo $jml_perkara; ?></h3>
      </div>
      <div class="icon">
        <i class="ion ion-ios-contact"></i>
      </div>
      <!-- <a href="<?php echo base_url('Pegawai') ?>" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a> -->
    </div>
  </div>
  <div class="col-lg-4 col-xs-6">
    <div class="small-box bg-green">
      <div class="inner">
        <p>Total Penahanan</p>
        <h3><?php echo $jml_penahanan; ?></h3>
      </div>
      <div class="icon">
        <i class="ion ion-ios-briefcase-outline"></i>
      </div>
      <!-- <a href="<?php echo base_url('Posisi') ?>" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a> -->
    </div>
  </div>
  <div class="col-lg-4 col-xs-6">
    <div class="small-box bg-yellow">
      <div class="inner">
        <p>Total PNBP</p>
        <h3>Rp. <?php echo $jml_pnbp; ?></h3>
      </div>
      <div class="icon">
        <i class="ion ion-location"></i>
      </div>
      <!-- <a href="<?php echo base_url('Kota') ?>" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a> -->
    </div>
  </div>

  <div class="col-lg-8 col-xs-12">
    <div class="box box-info">
      <div class="box-header with-border">
        <i class="fa fa-briefcase"></i>
        <h3 class="box-title">Statistik Data PNBP</h3>

        <div class="box-tools pull-right">
          <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
          </button>
          <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
        </div>
      </div>
      <div class="box-body">
        <canvas id="myChart"></canvas>
      </div>
    </div>
  </div>

  <div class="col-lg-4 col-xs-12">
    <div class="box box-primary">
      <div class="box-header with-border">
        <i class="fa fa-briefcase"></i>
        <h3 class="box-title">Statistik Data Perkara</h3>

        <div class="box-tools pull-right">
          <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
          </button>
          <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
        </div>
      </div>
      <div class="box-body">
        <canvas id="myChart2"></canvas>
      </div>
    </div>
  </div>
</div>

<?php
// $newArra = [];
// foreach($data_pnbp as $row) {
//   $newArra[] = array('label' => $row['label'], 'value' => $row['value']);
// }
// echo json_encode($newArra);

$pnbp_labels = array_map(function($item) {
  return strtoupper($item['label']);
}, $data_pnbp);

$pnbp_data = array_map(function($item) {
  return ($item['value']);
}, $data_pnbp);


// echo json_encode($data_perkara);
$perkara_labels = array_map(function($item) {
  return strtoupper($item['label']);
}, $data_perkara);

$perkara_data = array_map(function($item) {
  return ($item['value']);
}, $data_perkara);
?>

<script src="<?= base_url(); ?>assets/plugins/chartjs/v4.3.3/Chart.min.js"></script>
<script type="text/javascript">
  const ctxpnbp = document.getElementById('myChart');
  const ctxperkara = document.getElementById('myChart2');

  const perkara = new Chart(ctxpnbp, {
    type: 'bar',
    data: {
      datasets: [{
        label: 'Data PNBP',
        data: <?=json_encode($pnbp_data);?>,
        // this dataset is drawn below
        order: 2
      }, {
        label: 'Data PNBP',
        data: <?=json_encode($pnbp_data);?>,
        type: 'line',
        // this dataset is drawn on top
        order: 1
      }],
      labels: <?=json_encode($pnbp_labels);?>
    },
    options: {
      scales: {
        y: {
          beginAtZero: true
        }
      }
    }
  });

  const dataperkara = {
    labels: <?=json_encode($perkara_labels);?>,
    datasets: [{
      label: 'Data perkara',
      data: <?=json_encode($perkara_data);?>,
      backgroundColor: [
        'rgb(255, 99, 132)',
        'rgb(54, 162, 235)',
      ],
      hoverOffset: 4
    }]
  };

  const pieperkara = new Chart(ctxperkara, {
    type: 'pie',
    data: dataperkara
  })
</script>