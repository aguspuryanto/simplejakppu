<div class="table-responsive">
    <table id="example1" class="table table-striped table-bordered" style="width:100%">
        <thead>
            <?=get_header_table_inkracth($model, array('pekating_pn'), '<th>CATATAN KAJARI</th>
            <th>TINDAK LANJUT</th>
            <th>DOKUMEN</th>
            <th>#</th>');?>
        </thead>
        <tbody>
            <?php
            if($dataPidum) :
                $id=1;
                foreach($dataPidum as $row) {
                    $dokUrl = ($row->dokumen) ? '<a target="_blank" href="'.base_url('Pidum/download/') . $row->dokumen.'" class="btn btn-link btn-block">Dokumen</a>' : '#';

                    echo '<tr>
                        <td>'.$id.'</td>
                        <td>'.$row->pulbaket_no.'</td>
                        <td>'.$row->penyelidik_no.'</td>
                        <td>'.$row->penyidikan_no.'</td>
                        <td>'.$row->instansi_asal.'</td>
                        <td>'.$row->nama_tsk.'</td>
                        <td>'.$row->pasal_tsk.'</td>
                        <td>'.$row->jenis_perkara.'</td>
                        <td>'.$row->tahap_1.'</td>
                        <td>'.tahap1_type($row->tahap_1_tipe) . '<br>' . $row->tahap_1_proses.'</td>
                        <td>'.$row->tahap_2.'</td>
                        <td>'.$row->limpah_pn.'</td>
                        <td>'.$row->putus_pn.'</td>
                        <td>'.$row->banding_pn.'</td>
                        <td>'.$row->kasasi_pn.'</td>
                        <td>'.$row->eksekusi_pn.'</td>
                        <td>'.$row->grasi_pn.'</td>
                        <td>'.$row->pk_pn.'</td>
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

<?php include_once('_modal_perkara.php'); ?>
<?php include_once('_modal_note.php'); ?>