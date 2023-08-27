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
                    <button type="button" class="btn btn-info" data-toggle="modal" data-target="#myModalPerkara"><i class="glyphicon glyphicon-plus"></i> Tambah Data</button>
                </div>
                <div class="clearfix"></div>
            </div>
            <div class="panel-body">

<?php
$Urladd = base_url('Pembinaan/pnbp_add');
$Urldetail = base_url('Pembinaan/pnbp_detail');
$Urlnote = base_url('Pembinaan/pnbp_note');
$Urlremove = base_url('Pembinaan/pnbp_remove');
$Urltinjut = base_url('Pembinaan/pnbp_tinjut');
$Urldokumen = base_url('Pembinaan/pnbp_dokumen');
?>
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

$jenis_pnpb = array_count_values(array_column($dataPnbp, 'jenis_pnpb'));
// echo json_encode($kegiatan);
$pnpb_labels = array_keys($jenis_pnpb);
$pnpb_data = array_values($jenis_pnpb);
?>

<script src="<?= base_url(); ?>assets/plugins/chartjs/v4.3.3/Chart.min.js"></script>
<script>
  const ctx = document.getElementById('myChart');
  const data = <?=json_encode($newArra);?>;

  new Chart(ctx, {
    type: 'bar',
    data: {
      labels: <?=json_encode($pnpb_labels);?>,
      datasets: [{
        // label: 'Jumlah PNPB',
        data: <?=json_encode($pnpb_data);?>,
        order: 2,
        borderWidth: 1
      }, {
        // label: 'Tun',
        data: <?=json_encode($pnpb_data);?>,
        type: 'line',
        // this dataset is drawn on top
        order: 1,
        borderWidth: 1
    }]
    },
    options: {
        plugins: {
            legend: {
                display: false
            }
        },
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
    var table = $('#example1').DataTable();
    // $(".datepicker").datepicker();
    $('#error').html(" ");

    $('#form-pnbp').on('click', function (e) {
        e.preventDefault();

        $.ajax({
            type: "POST",
            url: "<?=$Urladd;?>", 
            data: $("#formPnbp").serialize(),
            dataType: "json",  
            success: function(data){
                console.log(data, "data");
                if(data.success == true){
                    setTimeout(function(){
                        window.location.reload();
                    }, 3000);
                } else {
                    $.each(data, function(key, value) {
                        $('#input-' + key).addClass('is-invalid');
                        $('#input-' + key).parents('.form-group').find('#error').html(value);
                    });
                }
            }
        });
    });

    $('#formPnbp input').on('keyup', function () { 
        $(this).removeClass('is-invalid').addClass('is-valid');
        $(this).parents('.form-group').find('#error').html(" ");
    });

    $(document).on('click', '.btnNote', function (e){
        e.preventDefault();
        var dataId = $(this).attr("data-id");
        // console.log(dataId, '_dataId');
        $('#formNote input[name=id]').val(dataId);

        $.get("<?=$Urldetail;?>/" + dataId, function(data, status){
            console.log(data.data, "data");
            $('#formNote').find('#input-kajari_note').val(data.data.kajari_note);
        });        
    });

    $('#formNote').submit(function (e) {
        e.preventDefault();

        $.ajax({
            type: "POST",
            url: "<?=$Urlnote;?>", 
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

    $(document).on('click', '.btnEdit', function (e) {
        e.preventDefault();
        var dataId = $(this).attr("data-id");
        console.log(dataId, '_dataId');

        $('#form input[name=id]').val(dataId);

        $.get("<?=$Urldetail;?>/" + dataId, function(data, status){
            $.each(data.data, function(key, value) {
                $('#input-' + key).val(value);
            });
        });
    });

    $(document).on('click', '.btnRemove', function (e) {
        e.preventDefault();
        var dataId = $(this).attr("data-id");
        console.log(dataId, '_dataId');

        if (confirm("Apakah anda yakin ingin menghapus data ini?")==true){
            // $(this).closest("tr").remove();
            table.row( $(this).parents('tr') ).remove().draw();
            $.post("<?=$Urlremove;?>/", {id: dataId}, function(result){
                console.log(result, "_result");
            });
        };
    });

});
</script>