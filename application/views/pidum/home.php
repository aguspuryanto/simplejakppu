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

  <div class="col-lg-7 col-xs-12">
    <div class="box box-info">
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
        <div class="chart" style="height:300px">
          <canvas id="barChart" style="height:290px"></canvas>
        </div>
      </div>
    </div>
  </div>

  <div class="col-lg-5 col-xs-12">
    <div class="box box-primary">
      <div class="box-header with-border">
        <i class="fa fa-briefcase"></i>
        <h3 class="box-title">Statistik Jenis Perkara</h3>

        <div class="box-tools pull-right">
          <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
          </button>
          <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
        </div>
      </div>
      <div class="box-body">
        <div class="chart" style="height:300px">
          <canvas id="data-pnbp" style="height:290px"></canvas>
        </div>
      </div>
    </div>
  </div>

  <div class="col-lg-7 col-xs-12">
    <div class="box box-primary">
      <div class="box-header with-border">
        <i class="fa fa-briefcase"></i>
        <h3 class="box-title">Statistik Tersangka, Terdakwa dan Terpidana</h3>

        <div class="box-tools pull-right">
          <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
          </button>
          <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
        </div>
      </div>
      <div class="box-body">
        <div class="chart" style="height:300px">
          <canvas id="barPerkara" style="height:290px"></canvas>
        </div>
      </div>
    </div>
  </div>
  <div class="col-lg-5 col-xs-12"></div>
</div>

<?php
// echo json_encode($data_statistik);
foreach($data_statistik as $key => $stat) {
  $labels[] = $key;
  $labels_data[] = $stat;
}

// tersangka, terdakwa, terpidana
// echo json_encode($data_statistik_pidana);
foreach($data_statistik_pidana as $key => $stat) {
  $labels_pidana[] = $stat->tot_tsk;
  $labels_pidana_data[] = $stat->tottsk;
}
?>

<script src="<?php echo base_url(); ?>assets/plugins/chartjs/Chart.min.js"></script>
<script>
  //data kota
  var pieChartCanvas = $("#data-pnbp").get(0).getContext("2d");
  var pieChart = new Chart(pieChartCanvas);
  var PieData = <?= json_encode($data_statistik_perkara); ?>;

  var pieOptions = {
    segmentShowStroke: true,
    segmentStrokeColor: "#fff",
    segmentStrokeWidth: 2,
    percentageInnerCutout: 50,
    animationSteps: 100,
    animationEasing: "easeOutBounce",
    animateRotate: true,
    animateScale: false,
    responsive: true,
    maintainAspectRatio: true,
    legendTemplate: "<ul class=\"<%=name.toLowerCase()%>-legend\"><% for (var i=0; i<segments.length; i++){%><li><span style=\"background-color:<%=segments[i].fillColor%>\"></span><%if(segments[i].label){%><%=segments[i].label%><%}%></li><%}%></ul>"
  };

  pieChart.Doughnut(PieData, pieOptions);

  //-------------
  //- BAR CHART -
  //-------------
  var areaChartData = {
    labels  : <?= json_encode($labels); ?>, //['Spdp', 'Pratut', 'Tut', 'Eksekusi', 'Banding', 'Kasasi', 'PK', 'Lain-lain'],
    datasets: [
      {
        // label               : 'Electronics',
        fillColor           : 'rgba(210, 214, 222, 1)',
        strokeColor         : 'rgba(210, 214, 222, 1)',
        pointColor          : 'rgba(210, 214, 222, 1)',
        pointStrokeColor    : '#c1c7d1',
        pointHighlightFill  : '#fff',
        pointHighlightStroke: 'rgba(220,220,220,1)',
        data                : <?= json_encode($labels_data); ?>
      },
      // {
      //   label               : 'Digital Goods',
      //   fillColor           : 'rgba(60,141,188,0.9)',
      //   strokeColor         : 'rgba(60,141,188,0.8)',
      //   pointColor          : '#3b8bba',
      //   pointStrokeColor    : 'rgba(60,141,188,1)',
      //   pointHighlightFill  : '#fff',
      //   pointHighlightStroke: 'rgba(60,141,188,1)',
      //   data                : [28, 48, 40, 19, 86, 27, 90, 18]
      // }
    ]
  }

  var barChartCanvas                   = $('#barChart').get(0).getContext('2d')
  var barChart                         = new Chart(barChartCanvas)
  var barChartData                     = areaChartData
  barChartData.datasets[0].fillColor   = '#00a65a'
  barChartData.datasets[0].strokeColor = '#00a65a'
  barChartData.datasets[0].pointColor  = '#00a65a'
  var barChartOptions                  = {
    //Boolean - Whether the scale should start at zero, or an order of magnitude down from the lowest value
    scaleBeginAtZero        : true,
    //Boolean - Whether grid lines are shown across the chart
    scaleShowGridLines      : true,
    //String - Colour of the grid lines
    scaleGridLineColor      : 'rgba(0,0,0,.05)',
    //Number - Width of the grid lines
    scaleGridLineWidth      : 1,
    //Boolean - Whether to show horizontal lines (except X axis)
    scaleShowHorizontalLines: true,
    //Boolean - Whether to show vertical lines (except Y axis)
    scaleShowVerticalLines  : true,
    //Boolean - If there is a stroke on each bar
    barShowStroke           : true,
    //Number - Pixel width of the bar stroke
    barStrokeWidth          : 2,
    //Number - Spacing between each of the X value sets
    barValueSpacing         : 5,
    //Number - Spacing between data sets within X values
    barDatasetSpacing       : 1,
    //String - A legend template
    legendTemplate          : '<ul class="<%=name.toLowerCase()%>-legend"><% for (var i=0; i<datasets.length; i++){%><li><span style="background-color:<%=datasets[i].fillColor%>"></span><%if(datasets[i].label){%><%=datasets[i].label%><%}%></li><%}%></ul>',
    //Boolean - whether to make the chart responsive
    responsive              : true,
    maintainAspectRatio     : true
  }

  barChartOptions.datasetFill = false
  barChart.Bar(barChartData, barChartOptions)

//-------------
//- TERSANGKA CHART -
//-------------
var areaChartTersangka = {
  labels  : <?= json_encode($labels_pidana); ?>,
  datasets: [
    {
      // label               : 'Electronics',
      fillColor           : 'rgba(60,141,188,0.9)',
      strokeColor         : 'rgba(60,141,188,0.8)',
      pointColor          : '#3b8bba',
      pointStrokeColor    : 'rgba(60,141,188,1)',
      pointHighlightFill  : '#fff',
      pointHighlightStroke: 'rgba(60,141,188,1)',
      data                : <?= json_encode($labels_pidana_data); ?>
    }
  ]
}

var barChartCanvas2                   = $('#barPerkara').get(0).getContext('2d')
var barChart2                         = new Chart(barChartCanvas2)
var barChartData2                     = areaChartTersangka
barChartData2.datasets[0].fillColor   = '#3b8bba'
barChartData2.datasets[0].strokeColor = '#3b8bba'
barChartData2.datasets[0].pointColor  = '#3b8bba'
barChart2.Bar(barChartData2, barChartOptions)
</script>