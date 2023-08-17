<div class="table-responsive">
    <table id="example1" class="table table-striped table-bordered" style="width:100%">
        <thead>
            <?=get_header_table($model, '<th>CATATAN KAJARI</th>
                <th>#</th>'
            );?>
        </thead>
        <tbody>
            <?php
            if($dataSptugas) :
                $id=1;
                foreach($dataSptugas as $row) {
                    echo '<tr>
                        <td>'.$id.'</td>
                        <td>'.$row->sumber_info.'</td>
                        <td>'.$row->sp_tugas.'</td>
                        <td>'.$row->objek_tugas.'</td>
                        <td>'.$row->kasus_posisi.'</td>
                        <td>'.$row->permasalahan.'</td>
                        <td>'.$row->potensi_aght.'</td>
                        <td>'.$row->tahapan.'</td>
                        <td>'.$row->keterangan.'</td>
                        <td>'.$row->kajari_note.'</td>
                        <td style="min-width:115px">
                            <p>
                                <button type="button" data-id="'.$row->id.'" class="btn btn-info btn-block btnNote" data-toggle="modal" data-target="#myModalNote">Tambah Note</button>
                            </p>
                            <div class="btn-group" role="group">
                                <button type="button" data-id="'.$row->id.'" class="btn btn-default btnEdit" data-toggle="modal" data-target="#myModalPerkara">Edit</button>
                                <button type="button" data-id="'.$row->id.'" class="btn btn-danger btnRemove">Hapus</button>
                            </div>
                        </td>
                    </tr>';
                    $id++;
                }
            endif;
            ?>
        </tbody>
    </table>
</div>

<?php include_once('_modal_op_intelijen.php'); ?>
<?php include_once('_modal_note.php'); ?>