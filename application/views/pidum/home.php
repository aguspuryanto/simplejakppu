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
        <!-- <canvas id="data-posisi" style="height:250px"></canvas> -->
        <div class="chart">
          <canvas id="barChart" style="height:250px"></canvas>
        </div>
      </div>
    </div>
  </div>

  <div class="col-lg-5 col-xs-12">
    <div class="box box-primary">
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
        <canvas id="data-pnbp" style="height:250px"></canvas>
      </div>
    </div>
  </div>
</div>

<?php
$labels = json_encode(['Spdp', 'Pratut', 'Tut', 'Eksekusi', 'Banding', 'Kasasi', 'PK', 'Lain-lain']);
$labels_data = json_encode([65, 59, 80, 81, 56, 55, 40, 27]);
?>

<script src="<?php echo base_url(); ?>assets/plugins/chartjs/Chart.min.js"></script>
<script>
  //data posisi
  // var pieChartCanvas = $("#data-posisi").get(0).getContext("2d");
  // var pieChart = new Chart(pieChartCanvas);
  // var PieData = <?php echo $data_perkara; ?>;

  // var pieOptions = {
  //   segmentShowStroke: true,
  //   segmentStrokeColor: "#fff",
  //   segmentStrokeWidth: 2,
  //   percentageInnerCutout: 50,
  //   animationSteps: 100,
  //   animationEasing: "easeOutBounce",
  //   animateRotate: true,
  //   animateScale: false,
  //   responsive: true,
  //   maintainAspectRatio: true,
  //   legendTemplate: "<ul class=\"<%=name.toLowerCase()%>-legend\"><% for (var i=0; i<segments.length; i++){%><li><span style=\"background-color:<%=segments[i].fillColor%>\"></span><%if(segments[i].label){%><%=segments[i].label%><%}%></li><%}%></ul>"
  // };

  // pieChart.Doughnut(PieData, pieOptions);

  //data kota
  var pieChartCanvas = $("#data-pnbp").get(0).getContext("2d");
  var pieChart = new Chart(pieChartCanvas);
  var PieData = <?php echo $data_pnbp; ?>;

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
    labels  : JSON.parse(<?= json_encode($labels); ?>), //['Spdp', 'Pratut', 'Tut', 'Eksekusi', 'Banding', 'Kasasi', 'PK', 'Lain-lain'],
    datasets: [
      {
        // label               : 'Electronics',
        fillColor           : 'rgba(210, 214, 222, 1)',
        strokeColor         : 'rgba(210, 214, 222, 1)',
        pointColor          : 'rgba(210, 214, 222, 1)',
        pointStrokeColor    : '#c1c7d1',
        pointHighlightFill  : '#fff',
        pointHighlightStroke: 'rgba(220,220,220,1)',
        data                : JSON.parse(<?= json_encode($labels_data); ?>)
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
</script>