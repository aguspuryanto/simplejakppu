<div class="table-responsive">
    <table id="example1" class="table table-striped table-bordered" style="width:100%">
        <thead>
            <tr>
                <th>NO</th>
                <th>NAMA TERSANGKA/TERDAKWA/TERPIDANA</th>
                <th>JENIS KELAMIN</th>
                <th>JENIS PERKARA/PERMASALAHAN</th>
                <th>PASAL DISANGKAKAN/ DIDAKWAKAN/ DITUNTUTAN/ TERBUKTI</th>
                <th>SURAT PERINTAH PENAHANAN/JENIS PENAHANAN</th>
                <th>LOKASI PENAHANAN</th>
                <th>KEADAAN TAHANAN</th>
                <th>TAHAP PERKARA</th>
                <th>KET.</th>
                <th>CATATAN KAJARI</th>
                <th>#</th>
            </tr>
        </thead>
        <tbody>

        <?php
            if($dataPenahanan) : 
                foreach($dataPenahanan as $row) {
                    echo '<tr>
                        <td>'.$row->id.'</td>
                        <td>'.$row->nama_tsk.'</td>
                        <td>'.$row->jenis_kelamin.'</td>
                        <td>'.$row->jenis_perkara.'</td>
                        <td>'.$row->pasal_tsk.'</td>
                        <td>'.$row->sp_tahap.'</td>
                        <td>'.$row->lokasi_tahan.'</td>
                        <td>'.$row->keadaan_tahan.'</td>
                        <td>'.$row->tahap_perkara.'</td>
                        <td>'.$row->keterangan.'</td>
                        <td>'.$row->kajari_note.'</td>
                        '. get_header_table_admin($row, $userdata) . '
                    </tr>';
                }
            endif;
            ?>
        </tbody>
    </table>
</div>

<?php include_once('_modal_tahan.php'); ?>

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
                <!-- <label>Catatan Kajari</label> -->
                <?=form_textarea('kajari_note', '', array('class' => 'form-control', 'id' => 'input-kajari_note', 'rows' => '4', 'cols' => '40'));?>
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