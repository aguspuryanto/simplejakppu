<div class="table-responsive">
    <table id="example1" class="table table-striped table-bordered" style="width:100%">
        <thead>
            <tr>
                <th>NO</th>
                <th>SURAT PERMOHONAN/ SKK</th>
                <th>KEGIATAN</th>
                <th>PENGGUGAT/ PEMOHON/PELAWAN</th>
                <th>TERGUGAT/ TERMOHON/TERLAWAN</th>
                <th>SEKSI</th>
                <th>SP/SK TIM JPN</th>
                <th>POSISI KASUS</th>
                <th>TAHAP</th>
                <th>KET.</th>
            </tr>
            <!-- <tr>
                <th>Penggugat/ Pemohon/Pelawan</th>
                <th>Tergugat/ Termohon/Terlawan</th>
            </tr> -->
        </thead>
        <tbody>
            <?php
            // echo json_encode($dataDatun);
            if($dataDatun) :
                foreach($dataDatun as $row) {
                    echo '<tr>
                        <td>'.$row->id.'</td>
                        <td>'.$row->skk.'</td>
                        <td>'.$row->kegiatan.'</td>
                        <td>'.$row->penggugat.'</td>
                        <td>'.$row->tergugat.'</td>
                        <td>'.$row->seksi.'</td>
                        <td>'.$row->sk_tim.'</td>
                        <td>'.$row->posisi_kasus.'</td>
                        <td>'.$row->tahap.'</td>
                        <td>'.$row->keterangan.'</td>
                    </tr>';
                }
            endif;
            ?>
        </tbody>
    </table>
</div>

<?php include_once('_modal_perkara.php'); ?>

<script type="text/javascript">
$( document ).ready(function() {
    $.fn.datepicker.defaults.format = "dd/mm/yyyy";
    $("#input-periode").datepicker({
        viewMode: "months", 
        minViewMode: "months",
        format: 'mm-yyyy',
    });
    $('#error').html(" ");

    $('#form-submit').on('click', function (e) {
        e.preventDefault();

        $.ajax({
            type: "POST",
            url: "<?=site_url('Datun/datun_add');?>", 
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