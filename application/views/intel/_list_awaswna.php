<div class="table-responsive">
    <table id="example1" class="table table-striped table-bordered" style="width:100%">
        <thead>
            <?php //$except = array('jenis_module'); ?>
            <?=get_header_table($model, '<th>CATATAN KAJARI</th>
                <th>#</th>'
            );?>
        </thead>
        <tbody>
            <?php
            if($dataProvider) :
                $id=1;
                foreach($dataProvider as $row) {
                    echo '<tr>
                        <td>'.$id.'</td>
                        <td>'.$row->asal_wna.'</td>
                        <td>'.$row->pnduduk_wna.'</td>
                        <td>'.$row->tnaga_kerja.'</td>
                        <td>'.$row->plajar.'</td>
                        <td>'.$row->pneliti.'</td>
                        <td>'.$row->kluarga.'</td>
                        <td>'.$row->rohaniwan.'</td>
                        <td>'.$row->ilegal.'</td>
                        <td>'.$row->usaha.'</td>
                        <td>'.$row->sosbud.'</td>
                        <td>'.$row->wisata.'</td>
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

<?php include_once('_modal_awaswna.php'); ?>
<?php include_once('_modal_note.php'); ?>