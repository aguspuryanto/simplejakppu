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
            <?=get_form_input($model, 'nama_pkerjaan'); ?>

            <?=get_form_input($model, 'instansi'); ?>

            <?=get_form_input($model, 'kontraktor'); ?>

            <?=get_form_input($model, 'nilai'); ?>

            <?=get_form_input($model, 'sumber'); ?>

            <?=get_form_input($model, 'wktu'); ?>

            <?=get_form_input($model, 'lokasi'); ?>

            <?=get_form_input($model, 'kdudukan'); ?>

            <?=get_form_input($model, 'potensi_aght'); ?>

            <?=get_form_input($model, 'tahapan'); ?>

            <div class="form-group">
                <label>KETERANGAN</label>
                <?=form_input('keterangan', '', array('class' => 'form-control', 'id' => 'input-keterangan'));?>
                <div id="error"></div>
            </div>
            
            <?//=form_hidden('jenis_module', 'opintelijen'); ?>

            <button type="submit" class="btn btn-primary" id="form-submit">Simpan Data</button>
            <button type="reset" class="btn btn-default">Kosongkan Data</button>
        <?=form_close();?>
      </div>
    </div>

  </div>
</div>