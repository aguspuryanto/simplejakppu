<!-- Modal -->
<div id="myModalInkracth" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Tambah Data</h4>
      </div>
      <div class="modal-body">
        <?=form_open('', array('id' => 'formInkracth', 'role' => 'form'));?>
            <?=get_form_input($model, 'nama_terdakwa'); ?>

            <?=get_form_input($model, 'p48_no_tgl'); ?>

            <?=get_form_input($model, 'putusan_no_tgl'); ?>

            <?=get_form_input($model, 'putusan_amar', array('type' => 'textarea', 'rows' => '3', 'cols' => '10')); ?>

            <?=get_form_input($model, 'pasal_terbukti'); ?>

            <?=get_form_input($model, 'barang_bukti', array('type' => 'textarea', 'rows' => '3', 'cols' => '10')); ?>
            <?php
            // $data = array(
            //   'name'        => 'barang_bukti',
            //   'id'          => 'input-barang_bukti',
            //   // 'value'       => '',
            //   'rows'        => '3',
            //   'cols'        => '10',
            //   'class'       => 'form-control'
            // );
        
            // echo form_textarea($data);
            ?>            

            <div class="form-group">
                <label>KETERANGAN</label>
                <?=form_input('keterangan', '', array('class' => 'form-control', 'id' => 'input-keterangan'));?>
                <div id="error"></div>
            </div>

            <?=get_form_input($model, 'ba20_pengembalin'); ?>

            <?=get_form_input($model, 'alamat_bb'); ?>

            <?=get_form_input($model, 'no_telp'); ?>

            <!-- one field -->
            <?=form_hidden('jenis_module', 'inkracth'); ?>

            <button type="submit" class="btn btn-primary" id="formInkracth">Simpan Data</button>
            <button type="reset" class="btn btn-default">Kosongkan Data</button>
        <?=form_close();?>
      </div>
    </div>

  </div>
</div>