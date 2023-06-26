<div class="table-responsive">
    <table id="example1" class="table table-striped table-bordered" style="width:100%">
        <thead>
            <tr>
                <th>NO</th>
                <th>NAMA TERPIDANA</th>
                <th>JENIS PERKARA</th>
                <th>PUTUSAN INKRACHT</th>
                <th>PASAL TERBUKTI</th>
                <th>JENIS PNBP</th>
                <th>JUMLAH</th>
                <th>BUKTI SETOR</th>
                <th>KET.</th>
            </tr>
        </thead>
        <tbody>
            <?php
            if($dataPnbp) : 
                foreach($dataPnbp as $row) {
                    echo '<tr>
                        <td>'.$row->id.'</td>
                        <td>'.$row->nama_tsk.'</td>
                        <td>'.$row->jenis_perkara.'</td>
                        <td>'.$row->putusan_perkara.'</td>
                        <td>'.$row->pasal_terbukti.'</td>
                        <td>'.$row->jenis_pnpb.'</td>
                        <td>'.$row->jumlah_pnpb.'</td>
                        <td>'.$row->bukti_pnpb.'</td>
                        <td>'.$row->keterangan.'</td>
                    </tr>';
                }
            endif;
            ?>
        </tbody>
    </table>
</div>

<?php include_once('_modal_pnbp.php'); ?>

<script type="text/javascript">
$( document ).ready(function() {
    // $(".datepicker").datepicker();
    $('#error').html(" ");

    $('#form-pnbp').on('click', function (e) {
        e.preventDefault();

        $.ajax({
            type: "POST",
            url: "<?=site_url('papan-kontrol/pidum_pnbp');?>", 
            data: $("#formPnbp").serialize(),
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

    $('#formPnbp input').on('keyup', function () { 
        $(this).removeClass('is-invalid').addClass('is-valid');
        $(this).parents('.form-group').find('#error').html(" ");
    });

});
</script>