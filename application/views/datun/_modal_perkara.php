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
        <?=form_open('Datun/datun_add', array('id' => 'form', 'role' => 'form'));?>
            <div class="form-group">
                <label><?=form_label($model->rules()[0]['label']); ?></label>
                <?=form_input('skk', '', array('class' => 'form-control', 'id' => 'input-skk'));?>
                <div id="error"></div>
            </div>
            <div class="form-group">
                <label><?=form_label($model->rules()[1]['label']); ?></label>
                <?=form_input('kegiatan', '', array('class' => 'form-control', 'id' => 'input-kegiatan'));?>
                <div id="error"></div>
            </div>
            <div class="form-group">
                <label><?=form_label($model->rules()[2]['label']); ?></label>
                <?=form_input('penggugat', '', array('class' => 'form-control', 'id' => 'input-penggugat'));?>
                <div id="error"></div>
            </div>
            <div class="form-group">
                <label><?=form_label($model->rules()[3]['label']); ?></label>
                <?=form_input('tergugat', '', array('class' => 'form-control', 'id' => 'input-tergugat'));?>
                <div id="error"></div>
            </div>
            <div class="form-group">
                <label><?=form_label($model->rules()[4]['label']); ?></label>
                <?=form_input('seksi', '', array('class' => 'form-control', 'id' => 'input-seksi'));?>
                <div id="error"></div>
            </div>
            <div class="form-group">
                <label><?=form_label($model->rules()[5]['label']); ?></label>
                <?=form_input('sk_tim', '', array('class' => 'form-control', 'id' => 'input-sk_tim'));?>
                <div id="error"></div>
            </div>
            <div class="form-group">
                <label><?=form_label($model->rules()[6]['label']); ?></label>
                <?=form_input('posisi_kasus', '', array('class' => 'form-control', 'id' => 'input-posisi_kasus'));?>
                <div id="error"></div>
            </div>
            <div class="form-group">
                <label><?=form_label($model->rules()[7]['label']); ?></label>
                <?=form_input('tahap', '', array('class' => 'form-control', 'id' => 'input-tahap'));?>
                <div id="error"></div>
            </div>
            <div class="form-group">
                <label><?=form_label($model->rules()[8]['label']); ?></label>
                <?=form_input('description', '', array('class' => 'form-control', 'id' => 'input-description'));?>
                <div id="error"></div>
            </div>
            <button type="submit" class="btn btn-primary" id="form-submit">Simpan Data</button>
            <button type="reset" class="btn btn-default">Kosongkan Data</button>
        <?=form_close();?>
      </div>
    </div>

  </div>
</div>