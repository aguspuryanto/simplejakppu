<!-- Modal -->
<div id="myModalPerkara" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Tambah Data</h4>
      </div>
      <div class="modal-body">
        <?=form_open('Pembinaan/add_bmn', array('id' => 'formPnbp', 'role' => 'form'));?>
            <?php
            foreach($model->rules() as $key => $val) {
              if($val['field'] == 'tgl_perolehan' || $val['field'] == 'tgl_psp') {
                echo get_form_input($model, $val['field'], array('class' => 'form-control datepicker'));
              }
              else {
                echo get_form_input($model, $val['field']);
              }
            }
            ?>

            <button type="submit" class="btn btn-primary" id="form-pnbp">Simpan Data</button>
            <button type="reset" class="btn btn-default">Kosongkan Data</button>
        <?=form_close();?>
      </div>
    </div>

  </div>
</div>