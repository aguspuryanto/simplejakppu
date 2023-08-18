<div class="msg" style="display:none;">
  <?php echo @$this->session->flashdata('msg'); ?>
</div>

<div class="panel panel-default">
  <div class="panel-body m0">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h4 class="pull-left">DATA REALISASI ANGGARAN</h4>
                <div class="pull-right">
                    <button type="button" class="btn btn-info" data-toggle="modal" data-target="#myModalPerkara"><i class="glyphicon glyphicon-plus"></i> Tambah Data</button>
                </div>
                <div class="clearfix"></div>
            </div>
            <div class="panel-body">
                <?php include_once('_list_realisasi.php'); ?>
            </div>
        </div>    
  </div>
</div>

<script type="text/javascript">
$( document ).ready(function() {
    $(".datepicker").datepicker();
    $('#error').html(" ");

    $('#example1').DataTable({
        info: false,
        ordering: false,
        paging: false,
        searching: false,
        footerCallback: function (row, data, start, end, display) {
            let api = this.api();
    
            // Remove the formatting to get integer data for summation
            let intVal = function (i) {
                return typeof i === 'string' ? i.replace(/[\$,]/g, '') * 1 : typeof i === 'number' ? i : 0;
            };
    
            // Total over all pages
            // total = api.column(2).data().reduce((a, b) => intVal(a) + intVal(b), 0);
    
            // Total over this page
            paguTotal = api.column(2, { page: 'current' }).data().reduce((a, b) => intVal(a) + intVal(b), 0);

            // periodelaluTotal = api.column(3, { page: 'current' }).data().reduce((a, b) => intVal(a) + intVal(b), 0);

            // periodeiniTotal = api.column(4, { page: 'current' }).data().reduce((a, b) => intVal(a) + intVal(b), 0);
            
            periodeTotal = api.column(5, { page: 'current' }).data().reduce((a, b) => intVal(a) + intVal(b), 0);

            // presentaseTotal = api.column(6, { page: 'current' }).data().reduce((a, b) => parseFloat(a) + parseFloat(b), 0);

            // sisaTotal = api.column(7, { page: 'current' }).data().reduce((a, b) => intVal(a) + intVal(b), 0);
    
            // Update footer
            // api.column(2).footer().innerHTML = paguTotal;
            // api.column(3).footer().innerHTML = periodelaluTotal;
            // api.column(4).footer().innerHTML = periodeiniTotal;
            // api.column(5).footer().innerHTML = periodeTotal;
            // api.column(6).footer().innerHTML = presentaseTotal;
            // api.column(7).footer().innerHTML = sisaTotal;

            // Sum each of 4 columns, beginning with col[0]:
            for(var i=2; i<=7; i++) {
                let sum = api.column(i, { page: 'current' }).data().reduce((a, b) => intVal(a) + intVal(b), 0);
                $(api.column(i).footer()).html(sum.toLocaleString());
            }

            // api.column(6).footer().innerHTML = (presentaseTotal/8).toFixed(2);
            api.column(6).footer().innerHTML = (periodeTotal/paguTotal*100).toFixed(2) + '%';
        }
    });

    $('#input-periode_total').on('change', function(e) {
        var periodeTotal = $(this).val().replace(/[^\d]+/g,'');
        var paguTotal = $('#input-pagu').val().replace(/[^\d]+/g,'');
        
        let presentaseTotal = (periodeTotal/paguTotal*100).toFixed(2) + '%';
        $('#input-periode_persen').val(presentaseTotal);

        let rupiahFormat = (paguTotal-periodeTotal).toString().replace(/\B(?=(\d{3})+(?!\d))/g, '.');
        $('#input-sisa_anggaran').val(rupiahFormat);
    });

    $('#form-submit').on('click', function (e) {
        e.preventDefault();

        $.ajax({
            type: "POST",
            url: "<?=site_url('Pembinaan/realisasi_add');?>", 
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