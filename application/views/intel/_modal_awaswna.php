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
            <?=get_form_input($model, 'asal_wna'); ?>

            <?=get_form_input($model, 'pnduduk_wna'); ?>

            <?=get_form_input($model, 'tnaga_kerja'); ?>

            <?=get_form_input($model, 'plajar'); ?>

            <?=get_form_input($model, 'pneliti'); ?>

            <?=get_form_input($model, 'kluarga'); ?>

            <?=get_form_input($model, 'rohaniwan'); ?>

            <?=get_form_input($model, 'ilegal'); ?>

            <?=get_form_input($model, 'usaha'); ?>

            <?=get_form_input($model, 'sosbud'); ?>

            <?=get_form_input($model, 'wisata'); ?>

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