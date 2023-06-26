<div class="msg" style="display:none;">
  <?php echo @$this->session->flashdata('msg'); ?>
</div>

<div class="panel panel-default">
  <div class="panel-body m0">

        <ul class="nav nav-tabs">
            <li class="active"><a data-toggle="tab" href="#home">PENANGANAN PERKARA</a></li>
            <li><a data-toggle="tab" href="#menu1">PENAHANAN</a></li>
            <li><a data-toggle="tab" href="#menu2">PNBP</a></li>
        </ul>

        <div class="tab-content">
            <div id="home" class="tab-pane fade in active">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <div class="text-right">
                            <button type="button" class="btn btn-info" data-toggle="modal" data-target="#myModalPerkara"><i class="glyphicon glyphicon-plus"></i> Tambah Data</button>
                        </div>
                    </div>
                    <div class="panel-body">
                        <?php include_once('_list_perkara.php'); ?>
                    </div>
                </div>
            </div>
            <div id="menu1" class="tab-pane fade">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <div class="text-right">
                            <button type="button" class="btn btn-info" data-toggle="modal" data-target="#myModalTahan"><i class="glyphicon glyphicon-plus"></i> Tambah Data</button>
                        </div>
                    </div>
                    <div class="panel-body">
                        <?php include_once('_list_tahan.php'); ?>
                    </div>
                </div>
            </div>
            <div id="menu2" class="tab-pane fade">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <div class="text-right">
                            <button type="button" class="btn btn-info" data-toggle="modal" data-target="#myModalPnbp"><i class="glyphicon glyphicon-plus"></i> Tambah Data</button>
                        </div>
                    </div>
                    <div class="panel-body">
                        <?php include_once('_list_pnbp.php'); ?>
                    </div>
                </div>
            </div>
        </div>
    
  </div>
</div>


<script>
$(document).ready(function () {
    $('#example1').DataTable();
});
</script>