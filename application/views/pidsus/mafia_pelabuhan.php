<div class="msg" style="display:none;">
  <?php echo @$this->session->flashdata('msg'); ?>
</div>

<div class="panel panel-default">
  <div class="panel-body m0">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h4 class="pull-left">Data <?=@$judul; ?></h4>
                <div class="pull-right">
                    <button type="button" class="btn btn-info" data-toggle="modal" data-target="#myModalPerkara"><i class="glyphicon glyphicon-plus"></i> Tambah Data</button>
                </div>
                <div class="clearfix"></div>
            </div>
            <div class="panel-body">
                <?php include_once('_list_mafia.php'); ?>
            </div>
        </div>
  </div>
</div>

<?php
$Urladd = base_url('Pidsus/berantasmafia_add');
$Urldetail = base_url('Pidsus/mafia_detail');
$Urlnote = base_url('Pidsus/mafia_note');
$Urlremove = base_url('Pidsus/mafia_remove');
$Urltinjut = base_url('Pidsus/mafia_tinjut');
$Urldokumen = base_url('Pidsus/mafia_dokumen');
?>

<script type="text/javascript">
$( document ).ready(function() {
    var table = $('#example1').DataTable();

    // $(".datepicker").datepicker();
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
            },
            complete: function() {
                $('#form-submit').prop("disabled", false);
            },
        });
    });

    $('#form input').on('keyup', function () { 
        $(this).removeClass('is-invalid').addClass('is-valid');
        $(this).parents('.form-group').find('#error').html(" ");
    });

    // Tambah Note Id
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

    // Tambah Note Submit
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

    // Edit
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

    // Remove
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