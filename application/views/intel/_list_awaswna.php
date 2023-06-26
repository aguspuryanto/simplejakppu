<div class="table-responsive">
    <table id="example1" class="table table-striped table-bordered" style="width:100%">
        <thead>
            <?=get_header_table($model);?>
        </thead>
        <tbody>
            <?php
            if($dataSptugas) :
                $id=1;
                foreach($dataSptugas as $row) {
                    echo '<tr>
                        <td>'.$id.'</td>
                        <td>'.$row->identitas.'</td>
                        <td>'.$row->srt_mohon.'</td>
                        <td>'.$row->kasus_posisi.'</td>
                        <td>'.$row->kepja_no.'</td>
                        <td>'.$row->tgl_mulai.'</td>
                        <td>'.$row->tgl_akhir.'</td>
                        <td>'.$row->keterangan.'</td>
                    </tr>';
                    $id++;
                }
            endif;
            ?>
        </tbody>
    </table>
</div>

<?php include_once('_modal_awaswna.php'); ?>

<script type="text/javascript">
$( document ).ready(function() {
    $(".datepicker").datepicker();
    $('#error').html(" ");

    $('#form-submit').on('click', function (e) {
        e.preventDefault();

        $.ajax({
            type: "POST",
            url: "<?=site_url('Intel/awaswna_add');?>", 
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