<div class="msg" style="display:none;">
  <?php echo @$this->session->flashdata('msg'); ?>
</div>

<div class="panel panel-default">
  <div class="panel-body m0">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h4 class="pull-left"><?=@$judul; ?></h4>
                <div class="pull-right">
                    <button type="button" class="btn btn-info" data-toggle="modal" data-target="#myModalPerkara"><i class="glyphicon glyphicon-plus"></i> Tambah Data</button>
                </div>
                <div class="clearfix"></div>
            </div>
            <div class="panel-body">
                <?php include_once('_list_perkara.php'); ?>
            </div>
        </div>    
  </div>
</div>

<script type="text/javascript">
$( document ).ready(function() {
    var table = $('#example1').DataTable();
    $('#error').html(" ");

    $('#form-submit').on('click', function (e) {
        e.preventDefault();

        $.ajax({
            type: "POST",
            url: "<?php echo site_url('Pidsus/pidsus_add');?>", 
            data: $("#form").serialize(),
            dataType: "json",  
            beforeSend : function(xhr, opts){
                // $('#form-submit').text('Loading...').prop("disabled", true);
            },
            success: function(data){
                console.log(data, "data");
                if(data.success == true){
                    window.location.reload();
                } else {
                    // $("#form").find('#showError').html(data.message);
                    $.each(data, function(key, value) {
                        console.log(key, '_key');
                        $("#form").find('#input-' + key).addClass('is-invalid');
                        $("#form").find('#input-' + key).parents('.form-group').find('#error').html(value);
                    });
                    $("#myModalPerkara").animate({ scrollTop: 0 }, "slow");
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

        $.get("<?=site_url('Pidsus/pidsus_detail');?>/" + dataId, function(data, status){
            console.log(data.data, "data");
            $('#formNote').find('#input-kajari_note').val(data.data.kajari_note);
        });        
    });

    $('#formNote').submit(function (e) {
        e.preventDefault();

        $.ajax({
            type: "POST",
            url: "<?=site_url('Pidsus/pidsus_note');?>", 
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

        $.get("<?=site_url('Pidsus/pidsus_detail');?>/" + dataId, function(data, status){
            $.each(data.data, function(key, value) {
                $('#form').find('#input-' + key).val(value);
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
            $.post("<?=site_url('Pidsus/pidsus_remove');?>/", {id: dataId}, function(result){
                console.log(result, "_result");
            });
        };
    });
});
</script>