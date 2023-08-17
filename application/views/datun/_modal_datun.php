
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
            <!-- <div class="form-group">
                <label><?=form_label($model->rules()[0]['label']); ?></label>
                <?=form_input('kegiatan', '', array('class' => 'form-control', 'id' => 'input-kegiatan'));?>
                <div id="error"></div>
            </div>
            <div class="form-group">
                <label><?=form_label($model->rules()[1]['label']); ?></label>
                <?=form_input('pemohon', '', array('class' => 'form-control', 'id' => 'input-penggugat'));?>
                <div id="error"></div>
            </div>
            <div class="form-group">
                <label><?=form_label($model->rules()[2]['label']); ?></label>
                <?=form_input('jenis_perkara', '', array('class' => 'form-control', 'id' => 'input-penggugat'));?>
                <div id="error"></div>
            </div>
            <div class="form-group">
                <label><?=form_label($model->rules()[3]['label']); ?></label>
                <?=form_input('skk', '', array('class' => 'form-control', 'id' => 'input-skk'));?>
                <div id="error"></div>
            </div>
            <div class="form-group">
                <label><?=form_label($model->rules()[4]['label']); ?></label>
                <?=form_input('kasus_posisi', '', array('class' => 'form-control', 'id' => 'input-tergugat'));?>
                <div id="error"></div>
            </div>
            <div class="form-group">
                <label><?=form_label($model->rules()[5]['label']); ?></label>
                <?=form_input('dok_sp1', '', array('class' => 'form-control', 'id' => 'input-seksi'));?>
                <div id="error"></div>
            </div>
            <div class="form-group">
                <label><?=form_label($model->rules()[6]['label']); ?></label>
                <?=form_input('dok_telaah', '', array('class' => 'form-control', 'id' => 'input-sk_tim'));?>
                <div id="error"></div>
            </div>
            <div class="form-group">
                <label><?=form_label($model->rules()[7]['label']); ?></label>
                <?=form_input('dok_sp2', '', array('class' => 'form-control', 'id' => 'input-posisi_kasus'));?>
                <div id="error"></div>
            </div>
            <div class="form-group">
                <label><?=form_label($model->rules()[8]['label']); ?></label>
                <?=form_input('tahap', '', array('class' => 'form-control', 'id' => 'input-tahap'));?>
                <div id="error"></div>
            </div>
            <div class="form-group">
                <label><?=form_label($model->rules()[9]['label']); ?></label>
                <?=form_input('laporan_kegiatan', '', array('class' => 'form-control', 'id' => 'input-tahap'));?>
                <div id="error"></div>
            </div>
            <div class="form-group">
                <label><?=form_label($model->rules()[10]['label']); ?></label>
                <?=form_input('uang_selamat', '', array('class' => 'form-control', 'id' => 'input-tahap'));?>
                <div id="error"></div>
            </div>
            <div class="form-group">
                <label><?=form_label($model->rules()[11]['label']); ?></label>
                <?=form_input('uang_dipulihkan', '', array('class' => 'form-control', 'id' => 'input-tahap'));?>
                <div id="error"></div>
            </div>
            <div class="form-group">
                <label><?=form_label($model->rules()[12]['label']); ?></label>
                <?=form_input('petunjuk_kajari', '', array('class' => 'form-control', 'id' => 'input-tahap'));?>
                <div id="error"></div>
            </div>
            <div class="form-group">
                <label><?=form_label($model->rules()[13]['label']); ?></label>
                <?=form_input('saran_kasi', '', array('class' => 'form-control', 'id' => 'input-tahap'));?>
                <div id="error"></div>
            </div>
            <div class="form-group">
                <label><?=form_label($model->rules()[14]['label']); ?></label>
                <?=form_input('keterangan', '', array('class' => 'form-control', 'id' => 'input-keterangan'));?>
                <div id="error"></div>
            </div> -->
            
            <?php
            foreach($model->rules() as $key => $val) {
                // unset
                // if($val['field'] == 'jenis_module') continue;
                echo get_form_input($model, $val['field']);
            }
            ?>

            <?=form_hidden('id', ''); ?>

            <button type="submit" class="btn btn-primary" id="form-submit">Simpan Data</button>
            <button type="reset" class="btn btn-default">Kosongkan Data</button>
        <?=form_close();?>
      </div>
    </div>

  </div>
</div>