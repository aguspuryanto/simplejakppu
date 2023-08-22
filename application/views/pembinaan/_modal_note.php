<!-- Modal -->
<div id="myModalNote" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Catatan Kajari</h4>
      </div>
      <div class="modal-body">
        <?=form_open('', array('id' => 'formNote', 'role' => 'form'));?>

            <div class="form-group">
                <?=form_textarea('kajari_note', '', array('class' => 'form-control', 'id' => 'input-kajari_note', 'rows' => '4', 'cols' => '20'));?>
                <div id="error"></div>
            </div>

            <?=form_hidden('id', ''); ?>

            <button type="submit" class="btn btn-primary" id="formNote">Simpan Data</button>
            <button type="reset" class="btn btn-default">Kosongkan Data</button>
        <?=form_close();?>
      </div>
    </div>

  </div>
</div>

<!-- Modal -->
<div id="myModalTinjut" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Tindak Lanjut</h4>
      </div>
      <div class="modal-body">
        <?=form_open('', array('id' => 'formTinjut', 'role' => 'form'));?>

            <div class="form-group">
                <?=form_textarea('tindak_lanjut', '', array('class' => 'form-control', 'id' => 'input-tindak_lanjut', 'rows' => '4', 'cols' => '20'));?>
                <div id="error"></div>
            </div>

            <?=form_hidden('id', ''); ?>

            <button type="submit" class="btn btn-primary" id="formTinjut">Simpan Data</button>
            <button type="reset" class="btn btn-default">Kosongkan Data</button>
        <?=form_close();?>
      </div>
    </div>

  </div>
</div>

<!-- Modal -->
<div id="myModalDokumen" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Dokumen</h4>
      </div>
      <div class="modal-body">
        <?=form_open_multipart('', array('id' => 'formDokumen', 'role' => 'form'));?>

            <div class="form-group">
                <input type="file" name="dokumen" id="input-dokumen" class="form-control" />
                <div id="error"></div>
            </div>

            <?=form_hidden('id', ''); ?>

            <button type="submit" class="btn btn-primary" id="formDokumen">Simpan Data</button>
            <!-- <button type="reset" class="btn btn-default">Kosongkan Data</button> -->
        <?=form_close();?>
      </div>
    </div>

  </div>
</div>

<script type="text/javascript">
$( document ).ready(function() {
  // Tindak Lanjut Id
  var formTinjut = $('#formTinjut');
  $(document).on('click', '.btnTinjut', function (e) {
      e.preventDefault();
      var dataId = $(this).attr("data-id");
      // console.log(dataId, '_dataId');
      $(formTinjut).find('input[name=id]').val(dataId);

      $.get("<?=$Urldetail; ?>/" + dataId, function(data, status){
          console.log(data.data, "data");
          $(formTinjut).find('#input-tindak_lanjut').val(data.data.tindak_lanjut);
      });        
  });

  // Tindak Lanjut Submit
  $('form#formTinjut').submit(function (e) {
      e.preventDefault();

      $.ajax({
          type: "POST",
          url: "<?=$Urltinjut; ?>", 
          data: $(formTinjut).serialize(),
          dataType: "json",  
          beforeSend : function(xhr, opts){
              $(formTinjut).text('Loading...').prop("disabled", true);
          },
          success: function(data){
              console.log(data, "data");
              if(data.success) {
                  $('#myModalTinjut').modal('hide'); 
                  setTimeout(function(){
                      window.location.reload();
                  }, 1000);
              }
          }
      });
  });

  // Unggah Dokumen
  var formDokumen = $('#formDokumen');
  $(document).on('click', '.btnDokumen', function (e) {
      e.preventDefault();
      var dataId = $(this).attr("data-id");
      // console.log(dataId, '_dataId');
      $(formDokumen).find('input[name=id]').val(dataId);
  });

  $('form#formDokumen').submit(function (e) {
      e.preventDefault();

      var fd = new FormData();
      var files = $(formDokumen).find('#input-dokumen')[0].files[0];
      fd.append('file',files);

      $.ajax({
          type: "POST",
          url: "<?=$Urldokumen; ?>", 
          // data: fd,
          data:new FormData(this),
          contentType: false,
          processData: false,
          cache: false,
          async: false,
          beforeSend : function(xhr, opts){
              // $(formDokumen).text('Loading...').prop("disabled", true);
          },
          success: function(data){
              console.log(data, "data");
              if(data.success) {
                  $('#myModalDokumen').modal('hide'); 
                  setTimeout(function(){
                      window.location.reload();
                  }, 1000);
              } else {
                  $('<p class="text-danger">' + data.message + '</p>').insertBefore('#formDokumen');
              }
          }
      });
  });
});
</script>