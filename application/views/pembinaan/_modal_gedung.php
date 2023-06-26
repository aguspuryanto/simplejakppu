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
        <?=form_open('Pembinaan/asset_add', array('id' => 'form', 'role' => 'form'));?>
            <div class="form-group">
                <label><?=form_label($model->rules()[0]['label']); ?></label>
                <?=form_input('nama_barang', '', array('class' => 'form-control', 'id' => 'input-nama_barang'));?>
                <div id="error"></div>
            </div>
            <div class="form-group">
                <label><?=form_label($model->rules()[1]['label']); ?></label>
                <?=form_input('tipe_barang', '', array('class' => 'form-control', 'id' => 'input-tipe_barang'));?>
                <div id="error"></div>
            </div>
            <div class="form-group">
                <label><?=form_label($model->rules()[2]['label']); ?></label>
                <?=form_input('kondisi_barang', '', array('class' => 'form-control', 'id' => 'input-kondisi_barang'));?>
                <div id="error"></div>
            </div>
            <div class="form-group">
                <label><?=form_label($model->rules()[3]['label']); ?></label>
                <?=form_input('tahun_barang', '', array('class' => 'form-control', 'id' => 'input-tahun_barang'));?>
                <div id="error"></div>
            </div>
            <div class="form-group">
                <label><?=form_label($model->rules()[4]['label']); ?></label>
                <?=form_input('nilai_barang', '', array('class' => 'form-control', 'id' => 'input-nilai_barang'));?>
                <div id="error"></div>
            </div>
            <div class="form-group">
                <label><?=form_label($model->rules()[5]['label']); ?></label>
                <?=form_input('asal_barang', '', array('class' => 'form-control', 'id' => 'input-asal_barang'));?>
                <div id="error"></div>
            </div>
            <div class="form-group">
                <label><?=form_label($model->rules()[6]['label']); ?></label>
                <?=form_input('pj_barang', '', array('class' => 'form-control', 'id' => 'input-pj_barang'));?>
                <div id="error"></div>
            </div>
            <?php
            echo form_hidden(array('jenis_module' => 'gedung'));
            ?>
            <button type="submit" class="btn btn-primary" id="form-submit">Simpan Data</button>
            <button type="reset" class="btn btn-default">Kosongkan Data</button>
        <?=form_close();?>
      </div>
    </div>

  </div>
</div>