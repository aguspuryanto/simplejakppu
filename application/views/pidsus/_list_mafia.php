<div class="table-responsive">
    <table id="example1" class="table table-striped table-bordered" style="width:100%">
        <thead>
            <?php //$except = array('jenis_module'); ?>
            <?=get_header_table($model);?>
        </thead>
        <tbody>
            <?php
            if($dataProvider) :
                $id=1;
                foreach($dataProvider as $row) {
                    echo '<tr>
                        <td>'.$id.'</td>
                        <td>'.$row->sumber_info.'</td>
                        <td>'.$row->lokasi.'</td>
                        <td>'.$row->pemilik.'</td>
                        <td>'.$row->bukti.'</td>
                        <td>'.$row->luas.'</td>
                        <td>'.$row->ksus_posisi.'</td>
                        <td>'.$row->prmasalahan.'</td>
                        <td>'.$row->potensi_mafia.'</td>
                        <td>'.$row->tahapan.'</td>
                        <td>'.$row->keterangan.'</td>
                        <td style="min-width:115px">
                            <div class="btn-group" role="group">
                                <button type="button" class="btn btn-default">Edit</button>
                                <button type="button" class="btn btn-danger">Hapus</button>
                            </div>
                        </td>
                    </tr>';
                    $id++;
                }
            endif;
            ?>
        </tbody>
    </table>
</div>

<?php include_once('_modal_brantasmafia.php'); ?>

<script type="text/javascript">
$( document ).ready(function() {
    $(".datepicker").datepicker();
    $('#error').html(" ");

    $('#form-submit').on('click', function (e) {
        e.preventDefault();

        $.ajax({
            type: "POST",
            url: "<?=site_url('Intel/berantasmafia_add');?>", 
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

});
</script>