<!-- Modal -->
<div id="myModalTahan" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Tambah Data</h4>
      </div>
      <div class="modal-body">
        <?=form_open('papan-kontrol/pidum_tahan', array('id' => 'formPenahanan', 'role' => 'form'));?>
            <div class="form-group">
                <label>NAMA TSK/TDKW/TPDANA</label>
                <?=form_input('nama_tsk', '', array('class' => 'form-control', 'id' => 'input-nama_tsk'));?>
                <div id="error"></div>
            </div>
            <div class="form-group">
                <label>JENIS KELAMIN</label>
                <?php 
                $options = array('L' => 'Laki-laki', 'P' => 'Perempuan');
                echo form_dropdown('jenis_kelamin', $options, '', array('class' => 'form-control', 'id' => 'input-jenis_kelamin'));?>
                <div id="error"></div>
            </div>
            <div class="form-group">
                <label>JENIS PERKARA/ PERMASALAHAN</label>
                <?=form_input('jenis_perkara', '', array('class' => 'form-control', 'id' => 'input-jenis_perkara'));?>
                <div id="error"></div>
            </div>
            <div class="form-group">
                <label>PASAL DISANGKA/DIDAKWA/DITUNTUT/TERBUKTI</label>
                <?=form_input('pasal_tsk', '', array('class' => 'form-control', 'id' => 'input-pasal_tsk'));?>
                <div id="error"></div>
            </div>
            <div class="form-group">
                <label>SURAT PERINTAH PENAHANAN/JENIS PENAHANAN</label>
                <?=form_input('sp_tahap', '', array('class' => 'form-control', 'id' => 'input-sp_tahap'));?>
                <div id="error"></div>
            </div>
            <div class="form-group">
                <label>LOKASI PENAHANAN</label>
                <?=form_input('lokasi_tahan', '', array('class' => 'form-control', 'id' => 'input-lokasi_tahan'));?>
                <div id="error"></div>
            </div>
            <div class="form-group">
                <label>KEADAAN TAHANAN</label>
                <?=form_input('keadaan_tahan', '', array('class' => 'form-control', 'id' => 'input-keadaan_tahan'));?>
                <div id="error"></div>
            </div>
            <div class="form-group">
                <label>TAHAP PERKARA</label>
                <?=form_input('tahap_perkara', '', array('class' => 'form-control', 'id' => 'input-tahap_perkara'));?>
                <div id="error"></div>
            </div>
            <div class="form-group">
                <label>KETERANGAN</label>
                <?=form_input('description', '', array('class' => 'form-control', 'id' => 'input-keterangan'));?>
                <div id="error"></div>
            </div>
            
            <?= form_hidden(array('jenis_module' => 'pidsus')); ?>

            <button type="submit" class="btn btn-primary" id="formPenahanan">Simpan Data</button>
            <button type="reset" class="btn btn-default">Kosongkan Data</button>
        <?=form_close();?>
      </div>
    </div>

  </div>
</div>