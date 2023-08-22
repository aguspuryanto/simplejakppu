<div class="table-responsive">
    <table id="example1" class="table table-striped table-bordered display" style="width:100%">
        <thead>
            <!-- <tr>
                <th>NO</th>
                <th>KODE | NAMA KEGIATAN</th>
                <th>PAGU</th>
                <th>S/D PERIODE LALU</th>
                <th>PERIODE INI</th>
                <th>TOTAL S/D PERIODE</th>
                <th>PRESENTASE</th>
                <th>SISA ANGGARAN</th>
                <th>CATATAN KAJARI</th>
                <th>#</th>
            </tr> -->
            <?=get_header_table_inkracth($model, ['tgl'], '<th>CATATAN KAJARI</th>
            <th>TINDAK LANJUT</th>
            <th>DOKUMEN</th>
            <th>#</th>');?>
        </thead>
        <tbody>
            <?php
            // echo json_encode($dataRealisasi);
            if($dataRealisasi) :
                $id=1;
                foreach($dataRealisasi as $row) {
                    $dokUrl = ($row->dokumen) ? '<a target="_blank" href="'.base_url('Pidum/download/') . $row->dokumen.'" class="btn btn-link btn-block">Dokumen</a>' : '#';

                    echo '<tr>
                        <td>'.$id.'</td>
                        <td>'.$row->kode_nama_kegiatan.'</td>
                        <td>'.number_format($row->pagu, 0).'</td>
                        <td>'.number_format($row->periode_lalu, 0).'</td>
                        <td>'.number_format($row->periode_lalu, 0).'</td>
                        <td>'.number_format($row->periode_total, 0).'</td>
                        <td>'.$row->periode_persen.'%</td>
                        <td>'.number_format($row->sisa_anggaran, 0).'</td>
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
        <tfoot>
            <tr>
                <th colspan="2" style="text-align:right">Total</th>
                <th></th>
                <th></th>
                <th></th>
                <th></th>
                <th></th>
                <th></th>
                <th></th>
                <th></th>
            </tr>
        </tfoot>
    </table>
</div>

<?php include_once('_modal_realisasi.php'); ?>
<?php include_once('_modal_note.php'); ?>