<!-- Modal -->
<div id="myModalNote" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Catatan Kajari</h4>
      </div>
      <div class="modal-body">
        <?=form_open('', array('id' => 'formNote', 'role' => 'form'));?>

            <div class="form-group">
                <?=form_textarea('kajari_note', '', array('class' => 'form-control', 'id' => 'input-kajari_note', 'rows' => '4', 'cols' => '20'));?>
                <div id="error"></div>
            </div>

            <?=form_hidden('id', ''); ?>

            <button type="submit" class="btn btn-primary" id="formNote">Simpan Data</button>
            <button type="reset" class="btn btn-default">Kosongkan Data</button>
        <?=form_close();?>
      </div>
    </div>

  </div>
</div>

<!-- Modal -->
<div id="myModalTinjut" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Tindak Lanjut</h4>
      </div>
      <div class="modal-body">
        <?=form_open('', array('id' => 'formTinjut', 'role' => 'form'));?>

            <div class="form-group">
                <?=form_textarea('tindak_lanjut', '', array('class' => 'form-control', 'id' => 'input-tindak_lanjut', 'rows' => '4', 'cols' => '20'));?>
                <div id="error"></div>
            </div>

            <?=form_hidden('id', ''); ?>

            <button type="submit" class="btn btn-primary" id="formTinjut">Simpan Data</button>
            <button type="reset" class="btn btn-default">Kosongkan Data</button>
        <?=form_close();?>
      </div>
    </div>

  </div>
</div>

<!-- Modal -->
<div id="myModalDokumen" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Dokumen</h4>
      </div>
      <div class="modal-body">
        <?=form_open_multipart('', array('id' => 'formDokumen', 'role' => 'form'));?>

            <div class="form-group">
                <input type="file" name="dokumen" id="input-dokumen" class="form-control" />
                <div id="error"></div>
            </div>

            <?=form_hidden('id', ''); ?>

            <button type="submit" class="btn btn-primary" id="formDokumen">Simpan Data</button>
            <!-- <button type="reset" class="btn btn-default">Kosongkan Data</button> -->
        <?=form_close();?>
      </div>
    </div>

  </div>
</div>