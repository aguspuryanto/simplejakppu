<div class="msg" style="display:none;"> <?php echo @$this->session->flashdata('msg'); ?>
</div>

<!-- DataTales Example -->
<div class="card shadow mb-4">
  <div class="card-header py-3">
    <h6 class="mt-2 font-weight-bold text-primary float-left"><?=@$judul; ?></h6>    
    <div class="float-right">
      <button type="button" class="btn btn-info" data-toggle="modal" data-target="#myModalInkracth"><i class="glyphicon glyphicon-plus"></i> Tambah Data</button>
    </div>
  </div>
  <div class="card-body">
    <?php include_once('_list_bbkelola.php'); ?>
  </div>
</div>