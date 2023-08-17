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
                <th>CATATAN KAJARI</th>
                <th>#</th>
            </tr>
            <?//=get_header_table($model);?>
        </thead>
        <tbody>
            <?php
            if($dataPidum) :
                $id=1;
                foreach($dataPidum as $row) {
                    echo '<tr>
                        <td>'.$id.'</td>
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
                        <td>'.$row->kajari_note.'</td>
                        <td style="min-width:115px">
                            <p>
                                <button type="button" data-id="'.$row->id.'" class="btn btn-info btn-block btnNote" data-toggle="modal" data-target="#myModalNote">Tambah Note</button>
                            </p>
                            <div class="btn-group" role="group">
                                <button type="button" data-id="'.$row->id.'" class="btn btn-default btnEdit" data-toggle="modal" data-target="#myModalPerkara">Edit</button>
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

<?php include_once('_modal_perkara.php'); ?>

<!-- Modal -->
<div id="myModalNote" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Catatan Kajari</h4>
      </div>
      <div class="modal-body">
        <?=form_open('', array('id' => 'formNote', 'role' => 'form'));?>

            <div class="form-group">
                <!-- <label>Catatan Kajari</label> -->
                <?=form_textarea('kajari_note', '', array('class' => 'form-control', 'id' => 'input-kajari_note', 'rows' => '4', 'cols' => '40'));?>
                <div id="error"></div>
            </div>

            <?=form_hidden('id', ''); ?>

            <button type="submit" class="btn btn-primary" id="formNote">Simpan Data</button>
            <button type="reset" class="btn btn-default">Kosongkan Data</button>
        <?=form_close();?>
      </div>
    </div>

  </div>
</div>

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
        var dataId = $(this).attr("data-id");
        // console.log(dataId, '_dataId');
        $('#formNote input[name=id]').val(dataId);
    });

    $('#formNote').on('click', function (e) {
        e.preventDefault();

        $.ajax({
            type: "POST",
            url: "<?=site_url('Pidum/kajari_note');?>", 
            data: $("#formNote").serialize(),
            dataType: "json",  
            success: function(data){
                console.log(data, "data");
                if(data.success) {
                    $('#myModalNote').modal('hide');
                    setTimeout(function(){
                        window.location.reload();
                    }, 3000);
                }
            }
        });
    });

    $('.btnEdit').on('click', function (e) {
        e.preventDefault();
        var dataId = $(this).attr("data-id");
        console.log(dataId, '_dataId');

        $('#form input[name=id]').val(dataId);

        $.get("<?=site_url('Pidum/pidum_detail');?>/" + dataId, function(data, status){
            // console.log("Data: " + data + "\nStatus: " + status);
            $.each(data.data, function(key, value) {
                $('#input-' + key).val(value);
            });
        });
    });

    $('.btnRemove').on('click', function (e) {
        e.preventDefault();
        var dataId = $(this).attr("data-id");
        console.log(dataId, '_dataId');

        if (confirm("Apakah anda yakin ingin menghapus data ini?")==true){
            $.post("<?=site_url('Pidum/pidum_remove');?>/", {id: dataId}, function(result){
                console.log(result, "_result");
                $(this).closest("tr").remove();
            })
        };
    });
});
</script>