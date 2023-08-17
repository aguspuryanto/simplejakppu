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
                <th>CATATAN KAJARI</th>
                <th>#</th>
            </tr>
        </thead>
        <tbody>

        <?php
            if($dataPenahanan) : 
                $id=1;
                foreach($dataPenahanan as $row) {
                    echo '<tr>
                        <td>'.$id.'</td>
                        <td>'.$row->nama_tsk.'</td>
                        <td>'.$row->jenis_kelamin.'</td>
                        <td>'.$row->jenis_perkara.'</td>
                        <td>'.$row->pasal_tsk.'</td>
                        <td>'.$row->sp_tahap.'</td>
                        <td>'.$row->lokasi_tahan.'</td>
                        <td>'.$row->keadaan_tahan.'</td>
                        <td>'.$row->tahap_perkara.'</td>
                        <td>'.$row->keterangan.'</td>
                        <td>'.$row->kajari_note.'</td>
                        <td style="min-width:115px">
                            <p>
                                <button type="button" data-id="'.$row->id.'" class="btn btn-info btn-block btnNote" data-toggle="modal" data-target="#myModalNote">Tambah Note</button>
                            </p>
                            <div class="btn-group" role="group">
                                <button type="button" data-id="'.$row->id.'" class="btn btn-default btnEdit" data-toggle="modal" data-target="#myModalTahan">Edit</button>
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

<?php include_once('_modal_tahan.php'); ?>

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

    $('.btnNote').on('click', function (e) {
        e.preventDefault();
        var dataId = $(this).attr("data-id");
        // console.log(dataId, '_dataId');
        $('#formNote input[name=id]').val(dataId);

        $.get("<?=site_url('Pidum/tahan_detail');?>/" + dataId, function(data, status){
            console.log(data.data, "data");
            $('#formNote').find('#input-kajari_note').val(data.data.kajari_note);
        });        
    });

    $('#formNote').submit(function (e) {
        e.preventDefault();

        $.ajax({
            type: "POST",
            url: "<?=site_url('Pidum/tahan_note');?>", 
            data: $("#formNote").serialize(),
            dataType: "json",  
            success: function(data){
                console.log(data, "data");
                if(data.success) {
                    $('#myModalNote').modal('hide'); 
                    setTimeout(function(){
                        window.location.reload();
                    }, 1000);
                }
            }
        });
    });

    $('.btnEdit').on('click', function (e) {
        e.preventDefault();
        var dataId = $(this).attr("data-id");
        console.log(dataId, '_dataId');

        $('#form input[name=id]').val(dataId);

        $.get("<?=site_url('Pidum/tahan_detail');?>/" + dataId, function(data, status){
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
            $.post("<?=site_url('Pidum/tahan_remove');?>/", {id: dataId}, function(result){
                console.log(result, "_result");
                // $('#myModalPerkara').modal('hide');
                setTimeout(function(){
                    window.location.reload();
                }, 3000);
            })
        };
    });
});
</script>