<div class="table-responsive">
    <table id="example1" class="table table-striped table-bordered" style="width:100%">
        <thead>
            <tr>
                <th>NO</th>
                <th>NAMA TERSANGKA/TERDAKWA/TERPIDANA</th>
                <th>JENIS KELAMIN</th>
                <th>JENIS PERKARA/PERMASALAHAN</th>
                <th>PASAL DISANGKAKAN/ DIDAKWAKAN/ DITUNTUTAN/ TERBUKTI</th>
                <th>SURAT PERINTAH PENAHANAN/JENIS PENAHANAN</th>
                <th>LOKASI PENAHANAN</th>
                <th>KEADAAN TAHANAN</th>
                <th>TAHAP PERKARA</th>
                <th>KET.</th>
            </tr>
        </thead>
        <tbody>

        <?php
            if($dataPenahanan) : 
                foreach($dataPenahanan as $row) {
                    echo '<tr>
                        <td>'.$row->id.'</td>
                        <td>'.$row->nama_tsk.'</td>
                        <td>'.$row->jenis_kelamin.'</td>
                        <td>'.$row->jenis_perkara.'</td>
                        <td>'.$row->pasal_tsk.'</td>
                        <td>'.$row->sp_tahap.'</td>
                        <td>'.$row->lokasi_tahan.'</td>
                        <td>'.$row->keadaan_tahan.'</td>
                        <td>'.$row->tahap_perkara.'</td>
                        <td>'.$row->keterangan.'</td>
                    </tr>';
                }
            endif;
            ?>
        </tbody>
    </table>
</div>

<?php include_once('_modal_tahan.php'); ?>

<script type="text/javascript">
$( document ).ready(function() {
    // $.fn.datepicker.defaults.format = "dd/mm/yyyy";
    // $(".datepicker").datepicker();
    $('#error').html(" ");

    $('#formPenahanan').on('click', function (e) {
        e.preventDefault();

        $.ajax({
            type: "POST",
            url: "<?=site_url('Pidum/pidum_tahan');?>", 
            data: $("#formPenahanan").serialize(),
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

    $('#formPenahanan input').on('keyup', function () { 
        $(this).removeClass('is-invalid').addClass('is-valid');
        $(this).parents('.form-group').find('#error').html(" ");
    });

});
</script>