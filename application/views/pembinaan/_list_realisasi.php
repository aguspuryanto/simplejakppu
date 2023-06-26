<div class="table-responsive">
    <table id="example1" class="table table-striped table-bordered" style="width:100%">
        <thead>
            <tr>
                <th>NO</th>
                <th>KODE | NAMA KEGIATAN</th>
                <th>PAGU</th>
                <th>S/D PERIODE LALU</th>
                <th>PERIODE INI</th>
                <th>TOTAL S/D PERIODE</th>
                <th>PRESENTASE</th>
                <th>SISA ANGGARAN</th>
            </tr>
            <!-- <tr>
                <th>Penggugat/ Pemohon/Pelawan</th>
                <th>Tergugat/ Termohon/Terlawan</th>
            </tr> -->
        </thead>
        <tbody>
            <?php
            // echo json_encode($dataRealisasi);
            if($dataRealisasi) :
                $id=1;
                foreach($dataRealisasi as $row) {
                    echo '<tr>
                        <td>'.$id.'</td>
                        <td>'.$row->kode_nama_kegiatan.'</td>
                        <td>'.$row->pagu.'</td>
                        <td>'.$row->periode_lalu.'</td>
                        <td>'.$row->periode_lalu.'</td>
                        <td>'.$row->periode_total.'</td>
                        <td>'.$row->periode_persen.'</td>
                        <td>'.$row->sisa_anggaran.'</td>
                    </tr>';
                    $id++;
                }
            endif;
            ?>
        </tbody>
    </table>
</div>

<?php include_once('_modal_realisasi.php'); ?>

<script type="text/javascript">
$( document ).ready(function() {
    $(".datepicker").datepicker();
    $('#error').html(" ");

    $('#form-submit').on('click', function (e) {
        e.preventDefault();

        $.ajax({
            type: "POST",
            url: "<?=site_url('Pembinaan/realisasi_add');?>", 
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