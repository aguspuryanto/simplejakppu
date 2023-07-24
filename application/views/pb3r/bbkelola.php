<div class="msg" style="display:none;">
  <?php echo @$this->session->flashdata('msg'); ?>
</div>

<div class="panel panel-default">
  <div class="panel-body m0">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h4 class="pull-left"><?=@$judul; ?></h4>
                <div class="pull-right">
                    <button type="button" class="btn btn-info" data-toggle="modal" data-target="#myModalInkracth"><i class="glyphicon glyphicon-plus"></i> Tambah Data</button>
                </div>
                <div class="clearfix"></div>
            </div>
            <div class="panel-body">
                <?php include_once('_list_bbkelola.php'); ?>
            </div>
        </div>    
  </div>
</div>

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
            <?=get_form_input($model, 'tahun'); ?>

            <?=get_form_input($model, 'p48_no_tgl'); ?>

            <?=get_form_input($model, 'putusan_no_tgl'); ?>

            <?=get_form_input($model, 'putusan_amar', array('type' => 'textarea', 'rows' => '3', 'cols' => '10')); ?>

            <?=get_form_input($model, 'pasal_terbukti'); ?>

            <?=get_form_input($model, 'barang_bukti', array('type' => 'textarea', 'rows' => '3', 'cols' => '10')); ?>         

            <div class="form-group">
                <label>KETERANGAN</label>
                <?=form_input('keterangan', '', array('class' => 'form-control', 'id' => 'input-keterangan'));?>
                <div id="error"></div>
            </div>

            <?=get_form_input($model, 'ba20_pengembalin'); ?>

            <?=get_form_input($model, 'alamat_bb'); ?>

            <?=get_form_input($model, 'no_telp'); ?>

            <!-- one field -->
            <?=form_hidden('jenis_module', 'bbkembali'); ?>

            <button type="submit" class="btn btn-primary" id="formInkracth">Simpan Data</button>
            <button type="reset" class="btn btn-default">Kosongkan Data</button>
        <?=form_close();?>
      </div>
    </div>

  </div>
</div>

<script>
$(document).ready(function () {
    $('#example1').DataTable();
});
</script>