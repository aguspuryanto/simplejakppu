<div class="msg" style="display:none;">
  <?php echo @$this->session->flashdata('msg'); ?>
</div>

<?php include_once('_statistik.php'); ?>

<div class="panel panel-default">
    <div class="panel-heading">
        <h4 class="pull-left">DATA PERKARA</h4>
        <div class="pull-right">
            <button type="button" class="btn btn-info bntAdd" data-toggle="modal" data-target="#myModalPerkara"><i class="glyphicon glyphicon-plus"></i> Tambah Data</button>
        </div>
        <div class="clearfix"></div>
    </div>
  <div class="panel-body m0">
        <?php
        $Urladd = base_url('Datun/datun_add');
        $Urldetail = base_url('Datun/datun_detail');
        $Urlnote = base_url('Datun/datun_note');
        $Urlremove = base_url('Datun/datun_remove');
        $Urltinjut = base_url('Datun/datun_tinjut');
        $Urldokumen = base_url('Datun/datun_dokumen');
        
        include_once('_list_bankum.php');
        ?>
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

$kegiatan = array_count_values(array_column($dataDatun, 'kegiatan'));
// echo json_encode($kegiatan);
$kegiatan_labels = array_keys($kegiatan);
$kegiatan_data = array_values($kegiatan);

$jenis_perkara = array_count_values(array_column($dataDatun, 'jenis_perkara'));
$perkara_labels = array_keys($jenis_perkara);
$perkara_data = array_values($jenis_perkara);
?>

<script src="<?= base_url(); ?>assets/plugins/chartjs/v4.3.3/Chart.min.js"></script>
<script>
    const ctx = document.getElementById('myChart');
    const ctxperkara = document.getElementById('myChart2');
    // const data = <?=json_encode($newArra);?>;

    Chart.defaults.font.family = "Teko";
    Chart.defaults.font.size = 22;
    Chart.defaults.color = "black";
    
    let barChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: <?=json_encode($kegiatan_labels);?>,
            datasets: [{
                // label: 'Perdata',
                data: <?=json_encode($kegiatan_data);?>,
                // this dataset is drawn below
                order: 2,
                borderWidth: 1
            }, {
                // label: 'Tun',
                data: <?=json_encode($kegiatan_data);?>,
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
    });
</script>
<script type="text/javascript">
$( document ).ready(function() {
    var table = $('#example1').DataTable();

    // $.fn.datepicker.defaults.format = "dd/mm/yyyy";
    // $("#input-periode").datepicker({
    //     viewMode: "months", 
    //     minViewMode: "months",
    //     format: 'MM-yyyy',
    // });
    
    $('#error').html(" ");

    $('#form-submit').on('click', function (e) {
        e.preventDefault();

        $.ajax({
            type: "POST",
            url: "<?=$Urladd;?>", 
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

    $(document).on('click', '.btnAdd', function (e){
        e.preventDefault();
        $('#form')[0].reset();
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

    $(document).on('click', '.btnEdit', function (e) {
        e.preventDefault();
        var dataId = $(this).attr("data-id");
        console.log(dataId, '_dataId');

        $('#form input[name=id]').val(dataId);

        let promise = new Promise(function(resolve, reject) {
            // resolve(dataId);
        });

        $.get("<?=$Urldetail;?>/" + dataId, function(data, status){
            console.log(data, "data");
            $.each(data.data, function(key, value) {
                if(key == 'kategori') {
                    $('#kategori').val(value).change();
                } else {
                    $('#input-' + key).val(value);
                }
            });

            $('#form input[name=kegiatan]').val(data.data.kegiatan);
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