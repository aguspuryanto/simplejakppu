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
        <?=form_open('Intel/sp_tugas', array('id' => 'form', 'role' => 'form'));?>
            <?=get_form_input($model, 'identitas'); ?>

            <?=get_form_input($model, 'srt_mohon'); ?>

            <?=get_form_input($model, 'kasus_posisi', array('type' => 'textarea', 'rows' => '3', 'cols' => '10')); ?>

            <?=get_form_input($model, 'kepja_no'); ?>

            <div class="row">
              <div class="col-md-6">
                <?=get_form_input($model, 'tgl_mulai', array('class' => 'form-control datepicker')); ?>
              </div>
              <div class="col-md-6">
                <?=get_form_input($model, 'tgl_akhir', array('class' => 'form-control datepicker')); ?>
              </div>
            </div>

            <div class="form-group">
                <label>KETERANGAN</label>
                <?=form_input('keterangan', '', array('class' => 'form-control', 'id' => 'input-keterangan'));?>
                <div id="error"></div>
            </div>
            
            <?=form_hidden('jenis_module', 'opintelijen'); ?>

            <button type="submit" class="btn btn-primary" id="form-submit">Simpan Data</button>
            <button type="reset" class="btn btn-default">Kosongkan Data</button>
        <?=form_close();?>
      </div>
    </div>

  </div>
</div>