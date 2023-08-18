<div class="table-responsive">
    <table id="example1" class="table table-striped table-bordered" style="width:100%">
        <thead>
            <tr>
                <th>NO</th>
                <th>NAMA TERPIDANA</th>
                <th>JENIS PERKARA</th>
                <th>PUTUSAN INKRACHT</th>
                <th>PASAL TERBUKTI</th>
                <th>JENIS PNBP</th>
                <th>JUMLAH</th>
                <th>BUKTI SETOR</th>
                <th>KET.</th>
                <th>CATATAN KAJARI</th>
                <th>#</th>
            </tr>
        </thead>
        <tbody>
            <?php
            if($dataPnbp) : 
                foreach($dataPnbp as $row) {
                    echo '<tr>
                        <td>'.$row->id.'</td>
                        <td>'.$row->nama_tsk.'</td>
                        <td>'.$row->jenis_perkara.'</td>
                        <td>'.$row->putusan_perkara.'</td>
                        <td>'.$row->pasal_terbukti.'</td>
                        <td>'.$row->jenis_pnpb.'</td>
                        <td>'.number_format($row->jumlah_pnpb).'</td>
                        <td>'.$row->bukti_pnpb.'</td>
                        <td>'.$row->keterangan.'</td>
                        <td>'.$row->kajari_note.'</td>
                        '. get_header_table_admin($row, $userdata) . '
                    </tr>';
                }
            endif;
            ?>
        </tbody>
    </table>
</div>

<?php include_once('_modal_pnbp.php'); ?>
<?php include_once('_modal_note.php'); ?>