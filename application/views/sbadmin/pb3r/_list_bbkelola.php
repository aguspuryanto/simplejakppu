<?php
// echo json_encode($model->rules());
// unset
?>
<div class="table-responsive">
    <table id="example1" class="table table-striped table-bordered" style="width:100%">
        <thead>
            <?//=get_header_table($model);?>
            <tr>
                <th>No</th>
                <th>Tahun</th>
                <th>Jumlah BB</th>
                <th>Jumlah Perkara</th>
                <th>Keterangan</th>
            </tr>
        </thead>
        <tbody>
            <?php
            // echo json_encode($dataInkracth);
            if($dataInkracth) :
                $id=1;
                foreach($dataInkracth as $row) {
                    echo '<tr>
                        <td>'.$id.'</td>
                        <td>'.$row->tahun.'</td>
                        <td>'.$row->jmlbb.'</td>
                        <td>'.$row->jmlperkara.'</td>
                        <td>'.$row->keterangan.'</td>
                    </tr>';
                    $id++;
                }
            endif;
            ?>
        </tbody>
    </table>
</div>

<?php //include_once('_modal_kembali.php'); ?>
<!-- Modal -->
<div class="modal fade" id="myModalInkracth" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Tambah Data</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <?=form_open('', array('id' => 'formInkracth', 'role' => 'form'));?>
            <?=get_form_input($model, 'tahun'); ?>

            <?=get_form_input($model, 'jmlbb'); ?>

            <?=get_form_input($model, 'jmlperkara'); ?>      

            <div class="form-group">
                <label>KETERANGAN</label>
                <?=form_input('keterangan', '', array('class' => 'form-control', 'id' => 'input-keterangan'));?>
                <div id="error"></div>
            </div>

            <!-- one field -->
            <?=form_hidden('jenis_module', 'bbkembali'); ?>

            <button type="submit" class="btn btn-primary" id="formInkracth">Simpan Data</button>
            <button type="reset" class="btn btn-default">Kosongkan Data</button>
        <?=form_close();?>
      </div>
      <div class="modal-footer d-none">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div>
    </div>
  </div>
</div>

<script type="text/javascript">
$( document ).ready(function() {
    $.fn.datepicker.defaults.format = "dd/mm/yyyy";
    $(".datepicker").datepicker();
    $('#error').html(" ");

    // $('#example1').DataTable();
    // var table = $('#example1').DataTable({
    //     "bFilter": false, //hide Search bar
    //     "bInfo": false, //Dont display info e.g. "Showing 1 to 4 of 4 entries"
    //     "paging": false,//Dont want paging                
    //     "bPaginate": false,//Dont want paging
    // });

    $('button#formInkracth').on('click', function (e) {
        e.preventDefault();

        $.ajax({
            type: "POST",
            url: "<?=site_url('pb3r/bbkelola_add');?>", 
            data: $("#formInkracth").serialize(),
            dataType: "json",  
            success: function(data){
                console.log(data, "data");
                if(data.success == true){
                    setTimeout(function(){
                        window.location.reload();
                    }, 1500);
                } else {
                    $('#error').html(data.message);
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