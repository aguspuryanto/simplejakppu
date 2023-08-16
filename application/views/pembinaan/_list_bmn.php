<div class="table-responsive">
    <table id="example1" class="table table-striped table-bordered" style="width:100%">
        <thead>
            <tr>
                <th>NO</th>
                <?php
                foreach($model->rules() as $key => $val) {
                    echo '<th>'.$val['label'].'</th>';
                }
                ?>
            </tr>
        </thead>
        <tbody>
            <?php
            if($dataPnbp) : 
                $id=1;
                foreach($dataPnbp as $row) {
                    echo '<tr>
                        <td>'.$id.'</td>
                        <td>'.$row->kelompok.'</td>
                        <td>'.$row->kode_barang.'</td>
                        <td>'.$row->nama_barang.'</td>
                        <td>'.$row->nup.'</td>
                        <td>'.$row->kondisi.'</td>
                        <td>'.$row->merk_tipe.'</td>
                        <td>'.$row->tgl_perolehan.'</td>
                        <td>'.$row->nilai_perolehan.'</td>
                        <td>'.$row->kuantiti.'</td>
                        <td>'.$row->status_kelola.'</td>
                        <td>'.$row->no_psp.'</td>
                        <td>'.$row->tgl_psp.'</td>
                        <td>'.$row->nobpkb.'</td>
                        <td>'.$row->nopol.'</td>
                        <td>'.$row->pemakai.'</td>
                        <td>'.$row->jml_kib.'</td>
                    </tr>';
                    $id++;
                }
            endif;
            ?>
        </tbody>
    </table>
</div>

<?php include_once('_modal_bmn.php'); ?>

<script type="text/javascript">
$( document ).ready(function() {
    $(".datepicker").datepicker();
    $('#error').html(" ");

    $('#form-pnbp').on('click', function (e) {
        e.preventDefault();

        $.ajax({
            type: "POST",
            url: $('#formPnbp').attr('action'),
            data: $("#formPnbp").serialize(),
            dataType: "json",  
            success: function(data){
                console.log(data, "data");
                if(data.success == true){
                    setTimeout(function(){ window.location.reload(); }, 3000);
                } else {
                    $.each(data, function(key, value) {
                        $('#input-' + key).addClass('is-invalid');
                        $('#input-' + key).parents('.form-group').find('#error').html(value);
                    });
                }
            }
        });
    });

    $('#formPnbp input').on('keyup', function () { 
        $(this).removeClass('is-invalid').addClass('is-valid');
        $(this).parents('.form-group').find('#error').html(" ");
    });

});
</script>