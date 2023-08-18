<div class="table-responsive">
    <table id="example1" class="table table-striped table-bordered" style="width:100%">
        <thead>
            <tr>
                <th rowspan="2" class="text-center">NO</th>
                <th rowspan="2" class="text-center"><?=form_label($model->rules()[0]['label']); ?></th>
                <th rowspan="2" class="text-center"><?=form_label($model->rules()[1]['label']); ?></th>
                <th rowspan="2" class="text-center"><?=form_label($model->rules()[2]['label']); ?></th>
                <th rowspan="2" class="text-center"><?=form_label($model->rules()[3]['label']); ?></th>                
                <th rowspan="2" class="text-center"><?=form_label($model->rules()[4]['label']); ?></th>
                <th colspan="3" class="text-center">DOKUMEN ADMINISTRASI</th>
                <th rowspan="2" class="text-center"><?=form_label($model->rules()[8]['label']); ?></th>
                <th rowspan="2" class="text-center"><?=form_label($model->rules()[9]['label']); ?></th>
                <th rowspan="2" class="text-center"><?=form_label($model->rules()[10]['label']); ?></th>
                <th rowspan="2" class="text-center"><?=form_label($model->rules()[11]['label']); ?></th>
                <th rowspan="2" class="text-center"><?=form_label($model->rules()[12]['label']); ?></th>
                <th rowspan="2" class="text-center"><?=form_label($model->rules()[13]['label']); ?></th>
                <th rowspan="2" class="text-center"><?=form_label($model->rules()[14]['label']); ?></th>
                <th rowspan="2" class="text-center">CATATAN KAJARI</th>
                <th rowspan="2" class="text-center">#</th>
            </tr>
            <tr>
                <th class="text-center"><?=form_label($model->rules()[5]['label']); ?></th>
                <th class="text-center"><?=form_label($model->rules()[6]['label']); ?></th>
                <th class="text-center"><?=form_label($model->rules()[7]['label']); ?></th> 
            </tr>
        </thead>
        <tbody>
            <?php
            // echo json_encode($dataDatun);
            if($dataDatun) :
                $id=1;
                foreach($dataDatun as $row) {
                    echo '<tr>
                        <td>'.$id.'.</td>
                        <td>'.$row->kegiatan.'</td>
                        <td>'.$row->pemohon.'</td>
                        <td>'.$row->jenis_perkara.'</td>
                        <td>'.$row->skk.'</td>
                        <td>'.$row->kasus_posisi.'</td>
                        <td>'.$row->dok_sp1.'</td>
                        <td>'.$row->dok_telaah.'</td>
                        <td>'.$row->dok_sp2.'</td>
                        <td>'.$row->tahap.'</td>
                        <td>'.$row->laporan_kegiatan.'</td>
                        <td>'.$row->uang_selamat.'</td>
                        <td>'.$row->uang_dipulihkan.'</td>
                        <td>'.$row->petunjuk_kajari.'</td>
                        <td>'.$row->saran_kasi.'</td>
                        <td>'.$row->keterangan.'</td>
                        <td>-</td>
                        '. get_header_table_admin($row, $userdata) . '
                    </tr>';

                    $id++;
                }
            endif;
            ?>
        </tbody>
    </table>
</div>

<?php include_once('_modal_datun.php'); ?>
<?php include_once('_modal_note.php'); ?>