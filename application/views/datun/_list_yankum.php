<div class="table-responsive">
    <table id="example1" class="table table-striped table-bordered" style="width:100%">
        <thead>
            <tr>
                <th>NO</th>
                <th>SURAT PERMOHONAN/ SKK</th>
                <th>KEGIATAN</th>
                <th>PENGGUGAT/ PEMOHON/PELAWAN</th>
                <th>TERGUGAT/ TERMOHON/TERLAWAN</th>
                <th>SEKSI</th>
                <th>SP/SK TIM JPN</th>
                <th>POSISI KASUS</th>
                <th>TAHAP</th>
                <th>KET.</th>
            </tr>
            <!-- <tr>
                <th>Penggugat/ Pemohon/Pelawan</th>
                <th>Tergugat/ Termohon/Terlawan</th>
            </tr> -->
        </thead>
        <tbody>
            <?php
            // echo json_encode($dataDatun);
            if($dataDatun) :
                foreach($dataDatun as $row) {
                    echo '<tr>
                        <td>'.$row->id.'</td>
                        <td>'.$row->skk.'</td>
                        <td>'.$row->kegiatan.'</td>
                        <td>'.$row->penggugat.'</td>
                        <td>'.$row->tergugat.'</td>
                        <td>'.$row->seksi.'</td>
                        <td>'.$row->sk_tim.'</td>
                        <td>'.$row->posisi_kasus.'</td>
                        <td>'.$row->tahap.'</td>
                        <td>'.$row->keterangan.'</td>
                    </tr>';
                }
            endif;
            ?>
        </tbody>
    </table>
</div>

<!-- Modal -->
<div id="myModalPerkara" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Tambah Data</h4>
      </div>
      <div class="modal-body">        
        <?=form_open('Datun/datun_add', array('id' => 'form', 'role' => 'form'));?>
            <div class="form-group">
                <label><?=form_label($model->rules()[8]['label']); ?></label>
                <?=form_input('periode', '', array('class' => 'form-control', 'id' => 'input-periode'));?>
                <div id="error"></div>
            </div>
            <div class="form-group">
                <label><?=form_label($model->rules()[0]['label']); ?></label>
                <?=form_input('skk', '', array('class' => 'form-control', 'id' => 'input-skk'));?>
                <div id="error"></div>
            </div>
            <div class="form-group">
                <label><?=form_label($model->rules()[1]['label']); ?></label>
                <?=form_input('kegiatan', '', array('class' => 'form-control', 'id' => 'input-kegiatan'));?>
                <div id="error"></div>
            </div>
            <div class="form-group">
                <label><?=form_label($model->rules()[2]['label']); ?></label>
                <?=form_input('penggugat', '', array('class' => 'form-control', 'id' => 'input-penggugat'));?>
                <div id="error"></div>
            </div>
            <div class="form-group">
                <label><?=form_label($model->rules()[3]['label']); ?></label>
                <?=form_input('tergugat', '', array('class' => 'form-control', 'id' => 'input-tergugat'));?>
                <div id="error"></div>
            </div>
            <div class="form-group">
                <label><?=form_label($model->rules()[4]['label']); ?></label>
                <?=form_input('seksi', '', array('class' => 'form-control', 'id' => 'input-seksi'));?>
                <div id="error"></div>
            </div>
            <div class="form-group">
                <label><?=form_label($model->rules()[5]['label']); ?></label>
                <?=form_input('sk_tim', '', array('class' => 'form-control', 'id' => 'input-sk_tim'));?>
                <div id="error"></div>
            </div>
            <div class="form-group">
                <label><?=form_label($model->rules()[6]['label']); ?></label>
                <?=form_input('posisi_kasus', '', array('class' => 'form-control', 'id' => 'input-posisi_kasus'));?>
                <div id="error"></div>
            </div>
            <div class="form-group">
                <label><?=form_label($model->rules()[7]['label']); ?></label>
                <?=form_input('tahap', '', array('class' => 'form-control', 'id' => 'input-tahap'));?>
                <div id="error"></div>
            </div>
            <div class="form-group">
                <label><?=form_label($model->rules()[9]['label']); ?></label>
                <?=form_input('description', '', array('class' => 'form-control', 'id' => 'input-description'));?>
                <div id="error"></div>
            </div>
            <button type="submit" class="btn btn-primary" id="form-submit">Simpan Data</button>
            <button type="reset" class="btn btn-default">Kosongkan Data</button>
        <?=form_close();?>
      </div>
    </div>

  </div>
</div>

<script type="text/javascript">
$( document ).ready(function() {
    $.fn.datepicker.defaults.format = "dd/mm/yyyy";
    $("#input-periode").datepicker({
        viewMode: "months", 
        minViewMode: "months",
        format: 'MM-yyyy',
    });
    $('#error').html(" ");

    $('#form-submit').on('click', function (e) {
        e.preventDefault();

        $.ajax({
            type: "POST",
            url: "<?=site_url('Datun/datun_add');?>", 
            data: $("#form").serialize(),
            dataType: "json",  
            success: function(data){
                console.log(data, "data");
                if(data.success == true){
                    setTimeout(function(){
                        window.location.reload();
                    }, 3000);
                } else {
                    $.each(data, function(key, value) {
                        $('#input-' + key).addClass('is-invalid');
                        $('#input-' + key).parents('.form-group').find('#error').html(value);
                    });
                }
            }
        });
    });

    $('#form input').on('keyup', function () { 
        $(this).removeClass('is-invalid').addClass('is-valid');
        $(this).parents('.form-group').find('#error').html(" ");
    });

});
</script>