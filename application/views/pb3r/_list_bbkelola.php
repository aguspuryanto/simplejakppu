<?php
// echo json_encode($model->rules());
// unset
?>
<div class="table-responsive">
    <table id="example1" class="table table-striped table-bordered" style="width:100%">
        <thead>
            <?=get_header_table_inkracth($model, ['dokumen'], '<th>CATATAN KAJARI</th>
            <th>TINDAK LANJUT</th>
            <th>DOKUMEN</th>
            <th>#</th>');?>
        </thead>
        <tbody>
            <?php
            // echo json_encode($dataInkracth);
            if($dataInkracth) :
                $id=1;
                foreach($dataInkracth as $row) {
                    $dokUrl = ($row->dokumen) ? '<a target="_blank" href="'.base_url('Pidum/download/') . $row->dokumen.'" class="btn btn-link btn-block">Dokumen</a>' : '#';

                    echo '<tr>
                        <td>'.$row->nama_terdakwa.'</td>
                        <td>'.$row->reg_bb.'</td>
                        <td>'.$row->pasal_disangka.'</td>
                        <td>'.$row->bb.'</td>
                        <td>'.$row->pasal_terbukti.'</td>
                        <td>'.$row->putusan.'</td>
                        <td>'.$row->eksekusi.'</td>
                        <td>'.$row->dokumen.'</td>
                        <td>'.$row->petunjuk.'</td>
                        <td>'.$row->kajari_note.'</td>
                        <td>'.$row->tindak_lanjut.'</td>
                        <td>'.$dokUrl.'</td>
                        '. get_header_table_admin($row, $userdata) . '
                    </tr>';
                    $id++;
                }
            endif;
            ?>
        </tbody>
    </table>
</div>

<?php //include_once('_modal_kembali.php'); ?>
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
        <?=form_open('', array('id' => 'formInkracth', 'role' => 'form'));?>
            <?//=get_form_input($model, 'tahun'); ?>

            <?//=get_form_input($model, 'jmlbb'); ?>

            <?//=get_form_input($model, 'jmlperkara'); ?>      

            <!-- <div class="form-group">
                <label>KETERANGAN</label>
                <?=form_input('keterangan', '', array('class' => 'form-control', 'id' => 'input-keterangan'));?>
                <div id="error"></div>
            </div> -->

            <!-- one field -->
            <?//=form_hidden('jenis_module', 'bbkembali'); ?>

            <?=get_form_input($model, 'nama_terdakwa'); ?>     
            <?=get_form_input($model, 'reg_bb'); ?>     
            <?=get_form_input($model, 'pasal_disangka'); ?>     
            <?=get_form_input($model, 'bb', array('type' => 'textarea', 'rows' => '3', 'cols' => '10')); ?>     
            <?=get_form_input($model, 'pasal_terbukti'); ?>     
            
            <?//=get_form_input($model, 'putusan'); ?>
            <?//=get_form_input($model, 'eksekusi'); ?> 
            <div class="form-group">
                <label>Putusan</label>
                <?php
                $options = [
                    'dikembalikan'  => 'Di Kembalikan',
                    'dirampas'    => 'Di Rampas',
                    'dimusnahkan'  => 'Di Musnahkan',
                    'dikelola'  => 'Dalam Pengelolaan',
                ];

                echo form_dropdown('putusan', $options, '', 'id="input-putusan" class="form-control"');
                ?>
            </div>

            <div class="form-group">
                <label>Eksekusi</label>
                <?=form_dropdown('eksekusi', $options, '', 'id="input-eksekusi" class="form-control"'); ?>
            </div>

            <?=get_form_input($model, 'dokumen'); ?>     

            <div class="form-group">
                <label>Petunjuk Kajari</label>
                <?=form_input('petunjuk', '', array('class' => 'form-control', 'id' => 'input-petunjuk'));?>
                <div id="error"></div>
            </div>
            
            <?=form_hidden('id', ''); ?>

            <button type="submit" class="btn btn-primary" id="formInkracth">Simpan Data</button>
            <button type="reset" class="btn btn-default">Kosongkan Data</button>
        <?=form_close();?>
      </div>
    </div>

  </div>
</div>

<?php include_once('_modal_note.php'); ?>