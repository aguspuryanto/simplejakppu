<div class="msg" style="display:none;">
  <?php echo @$this->session->flashdata('msg'); ?>
</div>

<div class="panel panel-default">
    <div class="panel-heading">
        <h4 class="pull-left"><?=@$judul; ?></h4>
        <div class="pull-right">
            <button type="button" class="btn btn-info btnAdd" data-toggle="modal" data-target="#myModalPerkara"><i class="glyphicon glyphicon-plus"></i> Tambah Data</button>
        </div>
        <div class="clearfix"></div>
    </div>
  <div class="panel-body m0">
        <?php include_once('_list_perkara.php'); ?>
  </div>
</div>

<?php
$Urladd = base_url('Pidum/pidum_add');
$Urldetail = base_url('Pidum/pidum_detail');
$Urlnote = base_url('Pidum/kajari_note');
$Urlremove = base_url('Pidum/pidum_remove');
$Urltinjut = base_url('Pidum/pidum_tinjut');
$Urldokumen = base_url('Pidum/pidum_dokumen');
?>

<script type="text/javascript">
$( document ).ready(function() {
    $.fn.datepicker.defaults.format = "dd/mm/yyyy";
    $(".datepicker").datepicker();
    $('#error').html(" ");
    var table = $('#example1').DataTable();

    $('#form-submit').on('click', function (e) {
        e.preventDefault();

        $.ajax({
            type: "POST",
            url: "<?=$Urladd;?>", 
            data: $("#form").serialize(),
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
                    $("#myModalPerkara").animate({ scrollTop: 0 }, "slow");
                }
            }
        });
    });

    $('#formInkracth input').on('keyup', function () { 
        $(this).removeClass('is-invalid').addClass('is-valid');
        $(this).parents('.form-group').find('#error').html(" ");
    });

    $(document).on('click', '.btnAdd', function (e){
        e.preventDefault();
        $('#formInkracth')[0].reset();
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
            // console.log("Data: " + data + "\nStatus: " + status);
            $.each(data.data, function(key, value) {
                if(key == 'dokumen') return;
                $('#input-' + key).val(value);
            });
        });
    });

    $(document).on('click', '.btnRemove', function (e) {
        e.preventDefault();
        var dataId = $(this).attr("data-id");
        console.log(dataId, '_dataId');

        if (confirm("Apakah anda yakin ingin menghapus data ini?")==true){
            $.post("<?=$Urlremove;?>/", {id: dataId}, function(result){
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

        $.get("<?=$Urldetail;?>/" + dataId, function(data, status){
            console.log(data.data, "data");
            $(formTinjut).find('#input-tindak_lanjut').val(data.data.tindak_lanjut);
        });        
    });

    // Tindak Lanjut Submit
    $('form#formTinjut').submit(function (e) {
        e.preventDefault();

        $.ajax({
            type: "POST",
            url: "<?=$Urltinjut;?>", 
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
    $(document).on('click', '.btnDokumen', function (e) {
        e.preventDefault();
        var dataId = $(this).attr("data-id");
        // console.log(dataId, '_dataId');
        $(formDokumen).find('input[name=id]').val(dataId);
    });

    $('form#formDokumen').submit(function (e) {
        e.preventDefault();

        var fd = new FormData();
        var files = $('#input-dokumen')[0].files[0];
        fd.append('file',files);

        $.ajax({
            type: "POST",
            url: "<?=$Urldokumen;?>", 
            // data: fd,
            data:new FormData(this),
            contentType: false,
            processData: false,
            cache: false,
            async: false,
            beforeSend : function(xhr, opts){
                // $(formDokumen).text('Loading...').prop("disabled", true);
            },
            success: function(data){
                console.log(data, "data");
                if(data.success) {
                    $('#myModalDokumen').modal('hide'); 
                    setTimeout(function(){
                        window.location.reload();
                    }, 1000);
                } else {
                    $('<p class="text-danger">' + data.message + '</p>').insertBefore('#formDokumen');
                }
            }
        });
    });
});
</script>