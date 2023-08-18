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
        <?=form_open('Pembinaan/realisasi_add', array('id' => 'form', 'role' => 'form'));?>
            
            <?php
            foreach($model->rules() as $key => $val) {
              // unset
              // if($val['field'] == 'jenis_module') continue;
              if(in_array($val['field'], array('tgl', 'periode_persen', 'sisa_anggaran'))) continue;

              echo get_form_input($model, $val['field']);
            }
            ?>

            <div class="row">
              <div class="form-group col-md-5">
                  <label><?=form_label($model->rules()[6]['label']); ?></label>
                  <?=form_input('periode_persen', '', array('class' => 'form-control', 'id' => 'input-periode_persen'));?>
                  <div id="error"></div>
              </div>
              <div class="form-group col-md-7">
                  <label><?=form_label($model->rules()[7]['label']); ?></label>
                  <?=form_input('sisa_anggaran', '', array('class' => 'form-control', 'id' => 'input-sisa_anggaran'));?>
                  <div id="error"></div>
              </div>
            </div>
            
            <?//=form_field($model, 'sisa_anggaran'); ?>
            <?=form_hidden('id', ''); ?>

            <button type="submit" class="btn btn-primary" id="form-submit">Simpan Data</button>
            <button type="reset" class="btn btn-default">Kosongkan Data</button>
        <?=form_close();?>
      </div>
    </div>

  </div>
</div>