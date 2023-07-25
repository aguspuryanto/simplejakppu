<div class="table-responsive">
    <table id="example1" class="table table-striped table-bordered" style="width:100%">
        <thead>
            <tr>
                <th>NO</th>
                <th>NAMA BARANG</th>
                <th>TIPE/JENIS</th>
                <th>KONDISI</th>
                <th>TH PEROLEHAN</th>
                <th>NILAI PEROLEHAN</th>
                <th>ASAL</th>
                <th>PENANGGUNG JAWAB</th>
            </tr>
        </thead>
        <tbody>
            <?php
            // echo json_encode($dataDatun);
            if($dataAsset) :
                $id=1;
                foreach($dataAsset as $row) {
                    echo '<tr>
                        <td>'.$id.'.</td>
                        <td>'.$row->nama_barang.'</td>
                        <td>'.$row->tipe_barang.'</td>
                        <td>'.$row->kondisi_barang.'</td>
                        <td>'.$row->tahun_barang.'</td>
                        <td>'.number_format($row->nilai_barang).'</td>
                        <td>'.$row->asal_barang.'</td>
                        <td>'.$row->pj_barang.'</td>
                    </tr>';
                    $id++;
                }
            endif;
            ?>
        </tbody>
    </table>
</div>

<?php include_once('_modal_rumdinas.php'); ?>

<script type="text/javascript">
$( document ).ready(function() {
    $(".datepicker").datepicker();
    $('#error').html(" ");

    $('#example1').DataTable({
        info: false,
        ordering: false,
        paging: false,
        searching: false,
    });

    $('#form-submit').on('click', function (e) {
        e.preventDefault();

        $.ajax({
            type: "POST",
            url: "<?=site_url('Pembinaan/asset_add');?>", 
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