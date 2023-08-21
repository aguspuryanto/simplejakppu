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
        <?=form_open('papan-kontrol/pidum_pnbp', array('id' => 'formPnbp', 'role' => 'form'));?>
            
            <?php
            foreach($model->rules() as $key => $val) {
              // unset
              if($val['field'] == 'jenis_module') continue;

              echo get_form_input($model, $val['field']);
            }
            ?>

            <?= form_hidden(array('jenis_module' => 'bin_pnbp')); ?>            
            <?=form_hidden('id', ''); ?>

            <button type="submit" class="btn btn-primary" id="form-pnbp">Simpan Data</button>
            <button type="reset" class="btn btn-default">Kosongkan Data</button>
        <?=form_close();?>
      </div>
    </div>

  </div>
</div>