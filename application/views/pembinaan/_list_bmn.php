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
            if($dataPnbp) : 
                $id=1;
                foreach($dataPnbp as $row) {
                    $dokUrl = ($row->dokumen) ? '<a target="_blank" href="'.base_url('Pidum/download/') . $row->dokumen.'" class="btn btn-link btn-block">Dokumen</a>' : '#';

                    echo '<tr>
                        <td>'.$id.'</td>
                        <td>'.$row->kelompok.'</td>
                        <td>'.$row->kode_barang.'</td>
                        <td>'.$row->nama_barang.'</td>
                        <td>'.$row->nup.'</td>
                        <td>'.$row->kondisi.'</td>
                        <td>'.$row->merk_tipe.'</td>
                        <td>'.date('Y-m-d', strtotime($row->tgl_perolehan)).'</td>
                        <td>'.$row->nilai_perolehan.'</td>
                        <td>'.$row->kuantiti.'</td>
                        <td>'.$row->status_kelola.'</td>
                        <td>'.$row->no_psp.'</td>
                        <td>'.date('Y-m-d', strtotime($row->tgl_psp)).'</td>
                        <td>'.$row->nobpkb.'</td>
                        <td>'.$row->nopol.'</td>
                        <td>'.$row->pemakai.'</td>
                        <td>'.$row->jml_kib.'</td>
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

<?php include_once('_modal_bmn.php'); ?>
<?php include_once('_modal_note.php'); ?>