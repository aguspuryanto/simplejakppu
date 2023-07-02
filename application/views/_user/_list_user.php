<div class="table-responsive">
    <table id="example1" class="table table-striped table-bordered" style="width:100%">
        <thead>
            <?=get_header_table_custom($model, array('password'), 'false');?>
        </thead>
        <tbody>
            <?php
            if($dataProvider) :
                foreach($dataProvider as $row) {
                    echo '<tr>
                        <td>'.$row->id.'</td>
                        <td>'.$row->username.'</td>
                        <td>'.$row->nama.'</td>
                        <td>'.$row->foto.'</td>
                        <td>'.$row->area_kerja.'</td>
                        <td>'.$row->rule.'</td>
                    </tr>';
                }
            endif;
            ?>
        </tbody>
    </table>
</div>

<?php include_once('_modal_user.php'); ?>

<script type="text/javascript">
$( document ).ready(function() {
    $(".datepicker").datepicker();
    $('#error').html(" ");

    $('#form-submit').on('click', function (e) {
        e.preventDefault();
        var form_data = new FormData($('#formAdd')[0]);

        $.ajax({
            type: "POST",
            url: "<?=site_url('Profile/useradd');?>",
            data: form_data,
            processData: false,
            contentType: false,
            cache: false,
            beforeSend : function(xhr, opts){
                $('#form-submit').text('Loading...').prop("disabled", true);
            },
            success: function(data){
                $('#form-submit').text('Simpan Data').prop("disabled", false);
                console.log(data, "data");
                if(data.success == true){
                    setTimeout(function(){
                        window.location.reload();
                    }, 3000);
                } else {
                    if(data.error) {
                        $('#input-foto').addClass('is-invalid');
                        $('#input-foto').parents('.form-group').find('#error').html(data.error).addClass('text-danger');
                    }
                }
            }
        });
    });

    $('#form input').on('keyup', function () { 
        $(this).removeClass('is-invalid').addClass('is-valid');
        $(this).parents('.form-group').find('#error').html(" ");
    });

});
</script>