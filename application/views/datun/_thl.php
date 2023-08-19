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
</script>
<script type="text/javascript">
$( document ).ready(function() {
    var table = $('#example1').DataTable();

    $.fn.datepicker.defaults.format = "dd/mm/yyyy";
    $("#input-periode").datepicker({
        viewMode: "months", 
        minViewMode: "months",
        format: 'MM-yyyy',
    });
    $('#error').html(" ");

    $('#form-submit').on('click', function (e) {
        e.preventDefault();

        $.ajax({
            type: "POST",
            url: "<?=site_url('Datun/datun_add');?>", 
            data: $("#form").serialize(),
            dataType: "json",
            beforeSend : function(xhr, opts){
                $('#form-submit').text('Loading...').prop("disabled", true);
            },
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

    $('#form input').on('keyup', function () { 
        $(this).removeClass('is-invalid').addClass('is-valid');
        $(this).parents('.form-group').find('#error').html(" ");
    });

    $('#form').find('select#kategori').on('change', function(e) {
        e.preventDefault();
        var valueId = $(this).val(); //$(this).find(":selected").val();
        console.log(valueId, '_valueId');

        $.get("<?=site_url('Datun/datun_kegiatan');?>/" + valueId, function(data, status){
            console.log(data, "data");
            $('#form').find('#kegiatan option').remove();
            $('#form').find('#kegiatan').append(data);
        });   
    });

    $('.btnNote').on('click', function (e) {
        e.preventDefault();
        var dataId = $(this).attr("data-id");
        // console.log(dataId, '_dataId');
        $('#formNote input[name=id]').val(dataId);

        $.get("<?=site_url('Datun/datun_detail');?>/" + dataId, function(data, status){
            console.log(data.data, "data");
            $('#formNote').find('#input-kajari_note').val(data.data.kajari_note);
        });        
    });

    $('#formNote').submit(function (e) {
        e.preventDefault();

        $.ajax({
            type: "POST",
            url: "<?=site_url('Datun/datun_note');?>", 
            data: $("#formNote").serialize(),
            dataType: "json",  
            beforeSend : function(xhr, opts){
                $('#formNote').text('Loading...').prop("disabled", true);
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

        $.get("<?=site_url('Datun/datun_detail');?>/" + dataId, function(data, status){
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
            $.post("<?=site_url('Datun/datun_remove');?>/", {id: dataId}, function(result){
                console.log(result, "_result");
            });
        };
    });
});
</script>