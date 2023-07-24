<?php
// echo json_encode($model->rules());
// unset
?>
<div class="table-responsive">
    <table id="example1" class="table table-striped table-bordered" style="width:100%">
        <thead>
            <?//=get_header_table($model);?>
            <tr>
                <th>No</th>
                <th>Tahun</th>
                <th>Jumlah BB</th>
                <th>Jumlah Perkara</th>
                <th>Keterangan</th>
            </tr>
        </thead>
        <tbody>
            <?php
            // echo json_encode($dataInkracth);
            if($dataInkracth) :
                $id=1;
                foreach($dataInkracth as $row) {
                    echo '<tr>
                        <td>'.$id.'</td>
                        <td>'.$row->tahun.'</td>
                        <td>'.$row->jmlbb.'</td>
                        <td>'.$row->jmlperkara.'</td>
                        <td>'.$row->keterangan.'</td>
                    </tr>';
                    $id++;
                }
            endif;
            ?>
        </tbody>
    </table>
</div>

<?php include_once('_modal_kembali.php'); ?>

<script type="text/javascript">
$( document ).ready(function() {
    $.fn.datepicker.defaults.format = "dd/mm/yyyy";
    $(".datepicker").datepicker();
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
                    // setTimeout(function(){
                        // window.location.reload();
                    // }, 3000);
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