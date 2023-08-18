<div class="table-responsive">
    <table id="example1" class="table table-striped table-bordered" style="width:100%">
        <thead>
            <?php //$except = array('jenis_module'); ?>
            <?=get_header_table($model, '<th>CATATAN KAJARI</th><th>#</th>');?>
        </thead>
        <tbody>
            <?php
            if($dataProvider) :
                $id=1;
                foreach($dataProvider as $row) {
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