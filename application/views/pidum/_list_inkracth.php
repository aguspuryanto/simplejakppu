<?php
// echo json_encode($model->rules());
// unset
?>
<div class="table-responsive">
    <table id="example1" class="table table-striped table-bordered" style="width:100%">
        <thead>
            <?=get_header_table_inkracth($model, '', '<th>CATATAN KAJARI</th>
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
                        <td>'.$id.'</td>
                        <td>'.$row->nama_terdakwa.'</td>
                        <td>'.$row->p48_no_tgl.'</td>
                        <td>'.$row->putusan_no_tgl.'</td>
                        <td>'.$row->putusan_amar.'</td>
                        <td>'.$row->pasal_terbukti.'</td>
                        <td>'.$row->barang_bukti.'</td>
                        <td>'.$row->keterangan.'</td>
                        <td>'.$row->ba20_pengembalin.'</td>
                        <td>'.$row->alamat_bb.'</td>
                        <td>'.$row->no_telp.'</td>
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

<?php include_once('_modal_inkracth.php'); ?>
<?php include_once('_modal_note.php'); ?>