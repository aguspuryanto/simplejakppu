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
            if($dataProvider) :
                $id=1;
                foreach($dataProvider as $row) {
                    $dokUrl = ($row->dokumen) ? '<a target="_blank" href="'.base_url('Pidum/download/') . $row->dokumen.'" class="btn btn-link btn-block">Dokumen</a>' : '#';

                    echo '<tr>
                        <td>'.$id.'</td>
                        <td>'.$row->sumber_info.'</td>
                        <td>'.$row->lokasi.'</td>
                        <td>'.$row->pemilik.'</td>
                        <td>'.$row->bukti.'</td>
                        <td>'.$row->luas.'</td>
                        <td>'.$row->ksus_posisi.'</td>
                        <td>'.$row->prmasalahan.'</td>
                        <td>'.$row->potensi_mafia.'</td>
                        <td>'.$row->tahapan.'</td>
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

<?php include_once('_modal_mafia.php'); ?>
<?php include_once('_modal_note.php'); ?>