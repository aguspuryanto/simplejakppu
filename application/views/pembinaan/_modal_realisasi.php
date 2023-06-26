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
            <div class="form-group">
                <label><?=form_label($model->rules()[0]['label']); ?></label>
                <?=form_input('tgl', '', array('class' => 'form-control', 'id' => 'input-kode_nama_kegiatan'));?>
                <div id="error"></div>
            </div>
            <div class="form-group">
                <label><?=form_label($model->rules()[1]['label']); ?></label>
                <?=form_input('kode_nama_kegiatan', '', array('class' => 'form-control', 'id' => 'input-kode_nama_kegiatan'));?>
                <div id="error"></div>
            </div>
            <div class="form-group">
                <label><?=form_label($model->rules()[2]['label']); ?></label>
                <?=form_input('pagu', '', array('class' => 'form-control', 'id' => 'input-pagu'));?>
                <div id="error"></div>
            </div>
            <div class="form-group">
                <label><?=form_label($model->rules()[3]['label']); ?></label>
                <?=form_input('periode_lalu', '', array('class' => 'form-control', 'id' => 'input-periode_lalu'));?>
                <div id="error"></div>
            </div>
            <div class="form-group">
                <label><?=form_label($model->rules()[4]['label']); ?></label>
                <?=form_input('periode_ini', '', array('class' => 'form-control', 'id' => 'input-periode_ini'));?>
                <div id="error"></div>
            </div>
            <div class="form-group">
                <label><?=form_label($model->rules()[5]['label']); ?></label>
                <?=form_input('periode_total', '', array('class' => 'form-control', 'id' => 'input-periode_total'));?>
                <div id="error"></div>
            </div>
            <div class="form-group">
                <label><?=form_label($model->rules()[6]['label']); ?></label>
                <?=form_input('periode_persen', '', array('class' => 'form-control', 'id' => 'input-periode_persen'));?>
                <div id="error"></div>
            </div>
            <div class="form-group">
                <label><?=form_label($model->rules()[7]['label']); ?></label>
                <?=form_input('sisa_anggaran', '', array('class' => 'form-control', 'id' => 'input-sisa_anggaran'));?>
                <div id="error"></div>
            </div>
            <?//=form_field($model, 'sisa_anggaran'); ?>
            <button type="submit" class="btn btn-primary" id="form-submit">Simpan Data</button>
            <button type="reset" class="btn btn-default">Kosongkan Data</button>
        <?=form_close();?>
      </div>
    </div>

  </div>
</div>