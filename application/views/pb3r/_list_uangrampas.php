<?php
// echo json_encode($model->rules());
// unset
?>
<div class="table-responsive">
    <table id="example1" class="table table-striped table-bordered" style="width:100%">
        <thead>
            <?//=get_header_table($model);?>
            <tr>
                <th>Tahun</th>
                <th>Perkara</th>
                <th>Jumlah (Rp)</th>
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
                        <td>'.$row->tahun.'</td>
                        <td>'.$row->perkara.'</td>
                        <td>'.$row->hasil.'</td>
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
<div id="myModalInkracth" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Tambah Data</h4>
      </div>
      <div class="modal-body">
        <?=form_open('', array('id' => 'formInkracth', 'role' => 'form'));?>
            <?=get_form_input($model, 'tahun'); ?>

            <?=get_form_input($model, 'perkara'); ?>

            <?=get_form_input($model, 'hasil'); ?>      

            <div class="form-group">
                <label>KETERANGAN</label>
                <?=form_input('keterangan', '', array('class' => 'form-control', 'id' => 'input-keterangan'));?>
                <div id="error"></div>
            </div>

            <!-- one field -->
            <?=form_hidden('jenis_module', 'uangrampas'); ?>

            <button type="submit" class="btn btn-primary" id="formInkracth">Simpan Data</button>
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
            url: "<?=site_url('pb3r/uangdenda_add');?>", 
            data: $("#formInkracth").serialize(),
            dataType: "json",  
            success: function(data){
                console.log(data, "data");
                if(data.success == true){
                    setTimeout(function(){
                        window.location.reload();
                    }, 1500);
                } else {
                    // $('#error').html(data.message);
                    $.each(data, function(key, value) {
                        $('#input-' + key).addClass('is-invalid');
                        $('#input-' + key).parents('.form-group').find('#error').html(value);
                    });

                    $('#myModalInkracth').modal('hide');
                    Notification.requestPermission().then((permission) => {
                        if (permission === "granted") {
                            new Notification("Warning!", {
                                body: data.message,
                                icon: "",
                            });
                        }
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