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
        <?=form_open('', array('id' => 'form', 'role' => 'form'));?>
            <div class="form-group">
                <label>PULBAKET NO/ TGL/NAMA JAKSA</label>
                <?=form_input('pulbaket_no', '', array('class' => 'form-control', 'id' => 'input-pulbaket_no'));?>
                <div id="error"></div>
            </div>
            <div class="form-group">
                <label>PENYELIDIKAN NO/ TGL/NAMA JAKSA</label>
                <?=form_input('penyelidik_no', '', array('class' => 'form-control', 'id' => 'input-penyelidik_no'));?>
                <div id="error"></div>
            </div>
            <div class="form-group">
                <label>PENYIDIKAN SPDP & P-16 NO/ TGL/NAMA JAKSA</label>
                <?=form_input('penyidikan_no', '', array('class' => 'form-control', 'id' => 'input-penyidikan_no'));?>
                <div id="error"></div>
            </div>
            <div class="form-group">
                <label>INSTANSI ASAL</label>
                <?=form_input('instansi_asal', '', array('class' => 'form-control', 'id' => 'input-instansi_asal'));?>
                <div id="error"></div>
            </div>
            <div class="form-group">
                <label>NAMA TSK/TDKW/TPDANA</label>
                <?=form_input('nama_tsk', '', array('class' => 'form-control', 'id' => 'input-nama_tsk'));?>
                <div id="error"></div>
            </div>
            <div class="form-group">
                <label>PASAL DISANGKA/DIDAKWA/DITUNTUT/TERBUKTI</label>
                <?=form_input('pasal_tsk', '', array('class' => 'form-control', 'id' => 'input-pasal_tsk'));?>
                <div id="error"></div>
            </div>
            <div class="form-group">
                <label>JENIS PERKARA/ PERMASALAHAN</label>
                <?=form_input('jenis_perkara', '', array('class' => 'form-control', 'id' => 'input-jenis_perkara'));?>
                <div id="error"></div>
            </div>
            <div class="form-group">
                <label>TAHAP I</label>
                <?=form_input('tahap_1', '', array('class' => 'form-control', 'id' => 'input-tahap_1'));?>
                <div id="error"></div>
            </div>
            <div class="form-group">
                <div class = "row">
                    <div class = "col-xs-12 col-md-3">
                        <label>TAHAP</label>
                        <?php $options = array('' => 'Pilih Tahap', 'P-18' => 'P-18', 'P-19' => 'P-19', 'P-21' => 'P-21'); ?>
                        <?=form_dropdown('tahap_1_tipe', $options, '', array('class' => 'form-control', 'id' => 'input-tahap_1_tipe'));?>
                        <div id="error"></div>
                    </div>
                    <div class = "col-xs-12 col-md-7">
                        <label>P-18/P-19/P-21</label>
                        <?=form_input('tahap_1_proses', '', array('class' => 'form-control datepicker', 'id' => 'input-tahap_1_proses'));?>
                        <div id="error"></div>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <label>TAHAP II & P-16A NO/TGL/NAMA JAKSA</label>
                <?=form_input('tahap_2', '', array('class' => 'form-control', 'id' => 'input-tahap_2'));?>
                <div id="error"></div>
            </div>
            <div class="form-group">
                <label>LIMPAH PN</label>
                <?=form_input('limpah_pn', '', array('class' => 'form-control', 'id' => 'input-limpah_pn'));?>
                <div id="error"></div>
            </div>
            <div class="form-group">
                <label>PUTUS PN</label>
                <?=form_input('putus_pn', '', array('class' => 'form-control', 'id' => 'input-putus_pn'));?>
                <div id="error"></div>
            </div>
            <div class="form-group">
                <label>BANDING</label>
                <?=form_input('banding_pn', '', array('class' => 'form-control', 'id' => 'input-banding_pn'));?>
                <div id="error"></div>
            </div>
            <div class="form-group">
                <label>KASASI</label>
                <?=form_input('kasasi_pn', '', array('class' => 'form-control', 'id' => 'input-kasasi_pn'));?>
                <div id="error"></div>
            </div>
            <div class="form-group">
                <label>EKSEKUSI</label>
                <?=form_input('eksekusi_pn', '', array('class' => 'form-control', 'id' => 'input-eksekusi_pn'));?>
                <div id="error"></div>
            </div>
            <div class="form-group">
                <label>GRASI</label>
                <?=form_input('grasi_pn', '', array('class' => 'form-control', 'id' => 'input-grasi_pn'));?>
                <div id="error"></div>
            </div>
            <div class="form-group">
                <label>PK</label>
                <?=form_input('pk_pn', '', array('class' => 'form-control', 'id' => 'input-pk_pn'));?>
                <div id="error"></div>
            </div>
            <div class="form-group">
                <label>PEKATING</label>
                <?=form_input('pekating_pn', '', array('class' => 'form-control', 'id' => 'input-pekating_pn'));?>
                <div id="error"></div>
            </div>
            <div class="form-group">
                <label>KETERANGAN</label>
                <?=form_input('keterangan', '', array('class' => 'form-control', 'id' => 'input-keterangan'));?>
                <div id="error"></div>
            </div>

            <?=form_hidden('id', ''); ?>

            <button type="submit" class="btn btn-primary" id="form-submit">Simpan Data</button>
            <button type="reset" class="btn btn-default">Kosongkan Data</button>
        <?=form_close();?>
      </div>
      <!-- <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div> -->
    </div>

  </div>
</div>