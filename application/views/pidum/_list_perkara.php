<div class="table-responsive">
    <table id="example1" class="table table-striped table-bordered" style="width:100%">
        <thead>
            <tr>
                <th>NO</th>
                <th>NO P16/ TGL/NAMA JAKSA</th>
                <th>INSTANSI ASAL</th>
                <th>NAMA TSK/TDKW/TPDANA</th>
                <th>PASAL DISANGKA, DIDAKWA, DITUNTUT, TERBUKTI</th>
                <th>JENIS PERKARA/ PERMA-SALAHAN</th>
                <th>TAHAP I</th>
                <th>P-18 /P-19 /P-21</th>
                <th>TAHAP II & P-16A NO/TGL/NAMA JAKSA</th>
                <th>LIMPAH PN</th>
                <th>PUTUS PN</th>
                <th>BANDING</th>
                <th>KASASI</th>
                <th>EKSEKUSI</th>
                <th>GRASI</th>
                <th>PK</th>
                <th>PEKATING</th>
                <th>KET.</th>
                <th>#</th>
            </tr>
            <?//=get_header_table($model);?>
        </thead>
        <tbody>
            <?php
            if($dataPidum) :
                foreach($dataPidum as $row) {
                    echo '<tr>
                        <td>'.$row->id.'</td>
                        <td>'.$row->penyidikan_no.'</td>
                        <td>'.$row->instansi_asal.'</td>
                        <td>'.$row->nama_tsk.'</td>
                        <td>'.$row->pasal_tsk.'</td>
                        <td>'.$row->jenis_perkara.'</td>
                        <td>'.$row->tahap_1.'</td>
                        <td>'.tahap1_type($row->tahap_1_tipe) . '<br>' . $row->tahap_1_proses.'</td>
                        <td>'.$row->tahap_2.'</td>
                        <td>'.$row->limpah_pn.'</td>
                        <td>'.$row->putus_pn.'</td>
                        <td>'.$row->banding_pn.'</td>
                        <td>'.$row->kasasi_pn.'</td>
                        <td>'.$row->eksekusi_pn.'</td>
                        <td>'.$row->grasi_pn.'</td>
                        <td>'.$row->pk_pn.'</td>
                        <td>'.$row->pekating_pn.'</td>
                        <td>'.$row->keterangan.'</td>
                        <td style="min-width:115px">
                            <p>
                                <button type="button" data-id="'.$row->id.'" class="btn btn-info btn-block btnNote">Tambah Note</button>
                            </p>
                            <div class="btn-group" role="group">
                                <button type="button" data-id="'.$row->id.'" class="btn btn-default btnEdit" data-toggle="modal" data-target="#myModalPerkara">Edit</button>
                                <button type="button" data-id="'.$row->id.'" class="btn btn-danger btnRemove">Hapus</button>
                            </div>
                        </td>
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
    $(".datepicker").datepicker();
    $('#error').html(" ");
    $('#example1').DataTable();

    $('#form-submit').on('click', function (e) {
        e.preventDefault();

        $.ajax({
            type: "POST",
            url: "<?=site_url('Pidum/pidum_add');?>", 
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

        $.get("demo_test.asp", function(data, status){
            // alert("Data: " + data + "\nStatus: " + status);
        });
    });

    $('.btnRemove').on('click', function (e) {
        e.preventDefault();

    });

});
</script>