<div class="table-responsive">
    <table id="example1" class="table table-striped table-bordered" style="width:100%">
        <thead>
            <!-- <tr>
                <th>NO</th>
                <th>NO P16/ TGL/NAMA JAKSA</th>
                <th>INSTANSI ASAL</th>
                <th>NAMA TSK/TDKW/TPDANA</th>
                <th>PASAL DISANGKA, DIDAKWA, DITUNTUT, TERBUKTI</th>
                <th>JENIS PERKARA/ PERMA-SALAHAN</th>
                <th>TAHAP I</th>
                <th>P-18 /P-19 /P-21</th>
                <th>TAHAP II & P-16A NO/TGL/NAMA JAKSA</th>
                <th>LIMPAH PN</th>
                <th>PUTUS PN</th>
                <th>BANDING</th>
                <th>KASASI</th>
                <th>EKSEKUSI</th>
                <th>GRASI</th>
                <th>PK</th>
                <th>PEKATING</th>
                <th>KET.</th>
                <th>CATATAN KAJARI</th>
                <th>TINDAK LANJUT</th>
                <th>DOKUMEN</th>
                <?=(!isUserStaff($userdata)) ? '<th>#</th>' : ''; ?>
            </tr> -->
            <?=get_header_table_custom($model, ['pulbaket_no', 'penyelidik_no', 'jenis_module'], '<th>CATATAN KAJARI</th>
            <th>TINDAK LANJUT</th>
            <th>DOKUMEN</th>
            <th>#</th>');?>
        </thead>
        <tbody>
            <?php
            if($dataPidum) :
                $id=1;
                foreach($dataPidum as $row) {
                  $dokUrl = ($row->dokumen) ? '<a href="'.base_url('Pidum/download/') . $row->dokumen.'" class="btn btn-link btn-block">Dokumen</a>' : '#';

                  echo '<tr>
                      <td>'.$id.'</td>
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
                      <td>'.$row->pekating_pn.'</td>
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