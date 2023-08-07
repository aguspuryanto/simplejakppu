<?php
// echo json_encode($model->rules());
// unset
?>
<div class="table-responsive">
    <table id="example1" class="table table-striped table-bordered" style="width:100%">
        <thead>
            <?=get_header_table_inkracth($model);?>
        </thead>
        <tbody>
            <?php
            // echo json_encode($dataInkracth);
            if($dataInkracth) :
                $id=1;
                foreach($dataInkracth as $row) {
                    echo '<tr>
                        <td>'.$id.'</td>
                        <td>'.$row->nama_terdakwa.'</td>
                        <td>'.$row->p48_no_tgl.'</td>
                        <td>'.$row->putusan_no_tgl.'</td>
                        <td>'.$row->putusan_amar.'</td>
                        <td>'.$row->pasal_terbukti.'</td>
                        <td>'.$row->barang_bukti.'</td>
                        <td>'.$row->keterangan.'</td>
                        <td>'.$row->ba20_pengembalin.'</td>
                        <td>'.$row->alamat_bb.'</td>
                        <td>'.$row->no_telp.'</td>
                        <td style="min-width:115px">
                            <p>
                                <button type="button" data-id="'.$row->id.'" class="btn btn-info btn-block btnNote">Tambah Note</button>
                            </p>
                            <div class="btn-group" role="group">
                                <button type="button" data-id="'.$row->id.'" class="btn btn-default btnEdit" data-toggle="modal" data-target="#myModalInkracth">Edit</button>
                                <button type="button" data-id="'.$row->id.'" class="btn btn-danger btnRemove">Hapus</button>
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

<?php include_once('_modal_inkracth.php'); ?>

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

    $('.btnNote').on('click', function (e) {
        e.preventDefault();

    });

    $('.btnEdit').on('click', function (e) {
        e.preventDefault();
        var dataId = $(this).attr("data-id");
        console.log(dataId, '_dataId');

        $('#formInkracth input[name=id]').val(dataId);
    });

    $('.btnRemove').on('click', function (e) {
        e.preventDefault();

    });

});
</script>