<div class="msg" style="display:none;">
  <?php echo @$this->session->flashdata('msg'); ?>
</div>

<!-- <div class="panel panel-default">
  <div class="panel-body">
    <canvas id="myChart"></canvas>
  </div>
</div> -->

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

  if (!isset($collectedData[$row->eksekusi])) {
    if($row->eksekusi == 'dikembalikan') $collectedData['dikembalikan'] = 0;
  } else {
    if($row->eksekusi == 'dikembalikan') $collectedData['dikembalikan'] += 1;
  }

  if ($row->eksekusi == 'dirampas' && !isset($collectedData[$row->eksekusi])) {
    if($row->eksekusi == 'dirampas') $collectedData['dirampas'] = 0;
  } else {
    if($row->eksekusi == 'dirampas') $collectedData['dirampas'] += 1;
  }

  if ($row->eksekusi == 'dimusnahkan' && !isset($collectedData[$row->eksekusi])) {
    if($row->eksekusi == 'dimusnahkan') $collectedData['dimusnahkan'] = 0;
  } else {
    if($row->eksekusi == 'dimusnahkan') $collectedData['dimusnahkan'] += 1;
  }
  
}

$newArra[] = array_merge($yearArr, $collectedData);
?>


<script>
  const ctx = document.getElementById('myChart');

  const data = <?=json_encode($newArra);?>;

  new Chart(ctx, {
    type: 'bar',
    data: {
      labels: data.map(row => row.year),
      datasets: [{
        label: 'Di Kembalikan',
        data: data.map(row => row.dikembalikan),
        borderWidth: 1
      }, {
        label: 'Di Rampas',
        data: data.map(row => row.dirampas),
        borderWidth: 1
      }, {
        label: 'Di Musnahkan',
        data: data.map(row => row.dimusnahkan),
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

<script type="text/javascript">
$( document ).ready(function() {
    $.fn.datepicker.defaults.format = "dd/mm/yyyy";
    $(".datepicker").datepicker();
    $('#error').html(" ");

    // $('#example1').DataTable();
    // var table = $('#example1').DataTable({
    //     "bFilter": false, //hide Search bar
    //     "bInfo": false, //Dont display info e.g. "Showing 1 to 4 of 4 entries"
    //     "paging": false,//Dont want paging                
    //     "bPaginate": false,//Dont want paging
    // });

    $('button#formInkracth').on('click', function (e) {
        e.preventDefault();

        $.ajax({
            type: "POST",
            url: "<?=site_url('pb3r/bbkelola_add');?>", 
            data: $("#formInkracth").serialize(),
            dataType: "json",  
            success: function(data){
                console.log(data, "data");
                if(data.success == true){
                    setTimeout(function(){
                        window.location.reload();
                    }, 1500);
                } else {
                    $('#error').html(data.message);
                    $.each(data, function(key, value) {
                        $('#input-' + key).addClass('is-invalid');
                        $('#input-' + key).parents('.form-group').find('#error').html(value);
                    });
                }
            }
        });
    });

    $('#form input').on('keyup', function () { 
        $(this).removeClass('is-invalid').addClass('is-valid');
        $(this).parents('.form-group').find('#error').html(" ");
    });

    $('.btnNote').on('click', function (e) {
        e.preventDefault();
        var dataId = $(this).attr("data-id");
        // console.log(dataId, '_dataId');
        $('#formNote input[name=id]').val(dataId);

        $.get("<?=site_url('pb3r/bbkelola_detail');?>/" + dataId, function(data, status){
            console.log(data.data, "data");
            $('#formNote').find('#input-kajari_note').val(data.data.kajari_note);
        });        
    });

    $('#formNote').submit(function (e) {
        e.preventDefault();

        $.ajax({
            type: "POST",
            url: "<?=site_url('pb3r/bbkelola_note');?>", 
            data: $("#formNote").serialize(),
            dataType: "json",  
            beforeSend : function(xhr, opts){
                $('#form-submit').text('Loading...').prop("disabled", true);
            },
            success: function(data){
                console.log(data, "data");
                if(data.success) {
                    $('#myModalNote').modal('hide'); 
                    setTimeout(function(){
                        window.location.reload();
                    }, 1000);
                }
            }
        });
    });

    $('.btnEdit').on('click', function (e) {
        e.preventDefault();
        var dataId = $(this).attr("data-id");
        console.log(dataId, '_dataId');

        $('#form input[name=id]').val(dataId);

        $.get("<?=site_url('pb3r/bbkelola_detail');?>/" + dataId, function(data, status){
            $.each(data.data, function(key, value) {
                $('#input-' + key).val(value);
            });
        });
    });

    $('.btnRemove').on('click', function (e) {
        e.preventDefault();
        var dataId = $(this).attr("data-id");
        console.log(dataId, '_dataId');

        if (confirm("Apakah anda yakin ingin menghapus data ini?")==true){
            // $(this).closest("tr").remove();
            table.row( $(this).parents('tr') ).remove().draw();
            $.post("<?=site_url('pb3r/bbkelola_remove');?>/", {id: dataId}, function(result){
                console.log(result, "_result");
            });
        };
    });
});
</script>