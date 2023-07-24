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
        <?=form_open_multipart('Profile/useradd', array('id' => 'formAdd', 'role' => 'form'));?>
            <?=get_form_input($model, 'username'); ?>

            <?=get_form_input($model, 'password', array('placeholder'=>'Enter your password', 'type'=>'password', 'name'=>'password')); ?>

            <?=get_form_input($model, 'nama'); ?>

            <?=get_form_input($model, 'foto', array('type'=>'file', 'name'=>'foto')); ?>

            <?php //echo get_form_input($model, 'rule'); ?>
            <div class="row">
              <div class="col-md-6">
                <div class="form-group">
                  <label>RULE</label>
                  <?php
                  $options = array(
                    // 'kajari' => 'Kajari',
                    'kasi' => 'Kasi',
                    'staff' => 'Staff',
                  );
                  
                  echo form_dropdown('rule', $options, '', array('class' => 'form-control', 'id' => 'input-rule'));
                  ?>
                  <div id="error"></div>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <label>AREA KERJA</label>
                  <?php
                  $options = array(
                    '*' => 'Semua Area',
                    'pidum' => 'Tindak Pidana Umum (Pidum)',
                    'pidsus' => 'Tindak Pidana Khusus (Pidsus)',
                    'intel' => 'Intelijen',
                    'datun' => 'Bidang Perdata dan Tata Usaha Negara (Datun)',
                    'bin' => 'Pembinaan',
                    'pb3r' => 'PB3R',
                  );
                  
                  echo form_dropdown('area_kerja', $options, '', array('class' => 'form-control', 'id' => 'input-rule'));
                  ?>
                  <div id="error"></div>
                </div>
              </div>
            </div>

            <button type="submit" class="btn btn-primary" id="form-submit"><i class="fa fa-circle-o-notch icon spinner" aria-hidden="true"></i> Simpan Data</button>
            <button type="reset" class="btn btn-default">Kosongkan Data</button>
        <?=form_close();?>
      </div>
    </div>

  </div>
</div>