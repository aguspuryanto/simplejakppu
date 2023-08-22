<div class="table-responsive">
    <table id="example1" class="table table-striped table-bordered" style="width:100%">
        <thead>
            <?=get_header_table_inkracth($model, [], '<th>CATATAN KAJARI</th>
            <th>TINDAK LANJUT</th>
            <th>DOKUMEN</th>
            <th>#</th>');?>
        </thead>
        <tbody>

        <?php
            if($dataPenahanan) : 
              $id=1;
              foreach($dataPenahanan as $row) {
                $dokUrl = ($row->dokumen) ? '<a target="_blank" href="'.base_url('Pidum/download/') . $row->dokumen.'" class="btn btn-link btn-block">Dokumen</a>' : '#';

                echo '<tr>
                    <td>'.$id.'</td>
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

<?php include_once('_modal_tahan.php'); ?>
<?php include_once('_modal_note.php'); ?>