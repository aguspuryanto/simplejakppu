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
            <?php
            $options = array(
              'kasi' => 'Kasi',
              'staff' => 'Staff',
            );      
            echo form_dropdown('rule', $options, '');
            ?>

            <button type="submit" class="btn btn-primary" id="form-submit">Simpan Data</button>
            <button type="reset" class="btn btn-default">Kosongkan Data</button>
        <?=form_close();?>
      </div>
    </div>

  </div>
</div>