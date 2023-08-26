<div class="msg" style="display:none;">
  <?php echo @$this->session->flashdata('msg'); ?>
</div>

<div class="panel panel-default">
    <div class="panel-heading">
        <h4 class="pull-left">DATA PERKARA</h4>
        <div class="pull-right">
            <button type="button" class="btn btn-info" data-toggle="modal" data-target="#myModalPerkara"><i class="glyphicon glyphicon-plus"></i> Tambah Data</button>
        </div>
        <div class="clearfix"></div>
    </div>
    <div class="panel-body m0">
        <?php
        $Urladd = base_url('Datun/datun_add');
        $Urldetail = base_url('Datun/datun_detail');
        $Urlnote = base_url('Datun/datun_note');
        $Urlremove = base_url('Datun/datun_remove');
        $Urltinjut = base_url('Datun/datun_tinjut');
        $Urldokumen = base_url('Datun/datun_dokumen');
        ?>
        <?php include_once('_list_bankum.php'); ?>
    </div>
</div>


<script>
$(document).ready(function () {
    $('#example1').DataTable();

    $('#form').find('select#kategori').on('change', function(e) {
        e.preventDefault();
        var valueId = $(this).val(); //$(this).find(":selected").val();
        console.log(valueId, '_valueId');

        if(valueId) {
            $.get("<?=site_url('Datun/datun_kegiatan');?>/" + valueId, function(data, status){
                console.log(data, "data");
                // $('#form').find('#kegiatan option').remove().end();
                // $('#form').find('#kegiatan').append(data);
                $('#kegiatan').find('option').remove().end().append(data);
            });
        }
    });
});
</script>