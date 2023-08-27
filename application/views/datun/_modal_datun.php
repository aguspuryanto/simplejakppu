
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
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>KATEGORI</label>
                            <select class="form-control" name="kategori" id="kategori">
                                <option value="">Pilih Kategori</option>
                                <option value="1">GAKKUM</option>
                                <option value="2">TIMKUM</option>
                                <option value="3">BANKUM</option>
                                <option value="4">THL</option>
                                <option value="5">YANKUM</option>
                            </select>
                            <div id="error"></div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <?//=get_form_input($model, 'kegiatan'); ?>                        
                        <label>KEGIATAN</label>
                        <select class="form-control" name="kegiatan" id="kegiatan">
                            <option value="">Pilih Kegiatan</option>
                        </select>
                        <div id="error"></div>
                    </div>
                </div>
            </div>
            
            <?php
            foreach($model->rules() as $key => $val) {
                // unset
                // if($val['field'] == 'jenis_module') continue;
                if(in_array($val['field'], ['kegiatan', 'kajari_note'])) continue;

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