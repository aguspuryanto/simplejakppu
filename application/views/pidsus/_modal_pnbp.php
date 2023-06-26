<!-- Modal -->
<div id="myModalPnbp" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Tambah Data</h4>
      </div>
      <div class="modal-body">
        <?php
        $CI =& get_instance();
        $CI->load->model('M_pnbp');
        $model = $CI->M_pnbp;
        // echo json_encode($model->rules());
        ?>

        <?=form_open('papan-kontrol/pidum_pnbp', array('id' => 'formPnbp', 'role' => 'form'));?>
            <div class="form-group">
                <label>NAMA TERPIDANA</label>
                <?=form_input('nama_tsk', '', array('class' => 'form-control', 'id' => 'input-nama_tsk'));?>
                <div id="error"></div>
            </div>
            <div class="form-group">
                <label>JENIS PERKARA</label>
                <?=form_input('jenis_perkara', '', array('class' => 'form-control', 'id' => 'input-jenis_perkara'));?>
                <div id="error"></div>
            </div>
            <div class="form-group">
                <label>PUTUSAN INKRACHT</label>
                <?=form_input('putusan_perkara', '', array('class' => 'form-control', 'id' => 'input-putusan_perkara'));?>
                <div id="error"></div>
            </div>
            <div class="form-group">
                <label>PASAL TERBUKTI</label>
                <?=form_input('pasal_terbukti', '', array('class' => 'form-control', 'id' => 'input-pasal_terbukti'));?>
                <div id="error"></div>
            </div>
            <div class="form-group">
                <label>JENIS PNBP</label>
                <?=form_input('jenis_pnpb', '', array('class' => 'form-control', 'id' => 'input-jenis_pnpb'));?>
                <div id="error"></div>
            </div>
            <div class="form-group">
                <label>JUMLAH</label>
                <?=form_input('jumlah_pnpb', '', array('class' => 'form-control', 'id' => 'input-jumlah_pnpb'));?>
                <div id="error"></div>
            </div>
            <div class="form-group">
                <label>BUKTI SETOR</label>
                <?=form_input('bukti_pnpb', '', array('class' => 'form-control', 'id' => 'input-bukti_pnpb'));?>
                <div id="error"></div>
            </div>
            <div class="form-group">
                <label>KETERANGAN</label>
                <?=form_input('description', '', array('class' => 'form-control', 'id' => 'input-description'));?>
                <div id="error"></div>
            </div>
            
            <?= form_hidden(array('jenis_module' => 'pidsus')); ?>

            <button type="submit" class="btn btn-primary" id="form-pnbp">Simpan Data</button>
            <button type="reset" class="btn btn-default">Kosongkan Data</button>
        <?=form_close();?>
      </div>
    </div>

  </div>
</div>