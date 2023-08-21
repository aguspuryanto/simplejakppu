<div class="msg" style="display:none;">
  <?php echo @$this->session->flashdata('msg'); ?>
</div>

<div class="panel panel-default">
  <div class="panel-body m0">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h4 class="pull-left">DATA PERKARA INKRACHT</h4>
                <div class="pull-right">
                    <button type="button" class="btn btn-info" data-toggle="modal" data-target="#myModalInkracth"><i class="glyphicon glyphicon-plus"></i> Tambah Data</button>
                </div>
                <div class="clearfix"></div>
            </div>
            <div class="panel-body">
                <?php include_once('_list_inkracth.php'); ?>
            </div>
        </div>    
  </div>
</div>

<?php
$inkracth_add = base_url('Pidum/pidum_inkracth_add');
$inkracth_detail = base_url('Pidum/inkracth_detail');
$inkracth_note = base_url('Pidum/inkracth_note');
$inkracth_remove = base_url('Pidum/inkracth_remove');
$inkracth_tinjut = base_url('Pidum/inkracth_tinjut');
$inkracth_dokumen = base_url('Pidum/inkracth_dokumen');
?>

<script type="text/javascript">
$( document ).ready(function() {
    $.fn.datepicker.defaults.format = "dd/mm/yyyy";
    $(".datepicker").datepicker();

    var table = $('#example1').DataTable();
    $('#error').html(" ");

    $('button#formInkracth').on('click', function (e) {
        e.preventDefault();

        $.ajax({
            type: "POST",
            url: "<?=site_url('Pidum/pidum_inkracth_add');?>", 
            data: $("#formInkracth").serialize(),
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

    $('#formInkracth input').on('keyup', function () { 
        $(this).removeClass('is-invalid').addClass('is-valid');
        $(this).parents('.form-group').find('#error').html(" ");
    });

    $(document).on('click', '.btnNote', function (e){
        e.preventDefault();
        var dataId = $(this).attr("data-id");
        // console.log(dataId, '_dataId');
        $('#formNote input[name=id]').val(dataId);

        $.get("<?=site_url('Pidum/inkracth_detail');?>/" + dataId, function(data, status){
            console.log(data.data, "data");
            $('#formNote').find('#input-kajari_note').val(data.data.kajari_note);
        });        
    });

    $('#formNote').submit(function (e) {
        e.preventDefault();

        $.ajax({
            type: "POST",
            url: "<?=site_url('Pidum/inkracth_note');?>", 
            data: $("#formNote").serialize(),
            dataType: "json",  
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

        $.get("<?=site_url('Pidum/inkracth_detail');?>/" + dataId, function(data, status){
            // console.log("Data: " + data + "\nStatus: " + status);
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
            $.post("<?=site_url('Pidum/inkracth_remove');?>/", {id: dataId}, function(result){
                console.log(result, "_result");
                $(this).closest("tr").remove();
            })
        };
    });

    // Tindak Lanjut Id
    var formTinjut = $('#formTinjut');
    $(document).on('click', '.btnTinjut', function (e) {
        e.preventDefault();
        var dataId = $(this).attr("data-id");
        // console.log(dataId, '_dataId');
        $(formTinjut).find('input[name=id]').val(dataId);

        $.get("<?=$inkracth_detail;?>/" + dataId, function(data, status){
            console.log(data.data, "data");
            $(formTinjut).find('#input-tindak_lanjut').val(data.data.tindak_lanjut);
        });        
    });

    // Tindak Lanjut Submit
    $('form#formTinjut').submit(function (e) {
        e.preventDefault();

        $.ajax({
            type: "POST",
            url: "<?=$inkracth_tinjut;?>", 
            data: $(formTinjut).serialize(),
            dataType: "json",  
            beforeSend : function(xhr, opts){
                $(formTinjut).text('Loading...').prop("disabled", true);
            },
            success: function(data){
                console.log(data, "data");
                if(data.success) {
                    $('#myModalTinjut').modal('hide'); 
                    setTimeout(function(){
                        window.location.reload();
                    }, 1000);
                }
            }
        });
    });

    // Unggah Dokumen
    var formDokumen = $('#formDokumen');
    $('form#formDokumen').submit(function (e) {
        e.preventDefault();

        var fd = new FormData();
        var files = $('#input-dokumen')[0].files[0];
        fd.append('file',files);

        $.ajax({
            type: "POST",
            url: "<?=$inkracth_dokumen;?>", 
            data: fd,
            contentType: false,
            processData: false,
            beforeSend : function(xhr, opts){
                $(formDokumen).text('Loading...').prop("disabled", true);
            },
            success: function(data){
                console.log(data, "data");
                if(data.success) {
                    $('#myModalDokumen').modal('hide'); 
                    setTimeout(function(){
                        window.location.reload();
                    }, 1000);
                }
            }
        });
    });
});
</script>