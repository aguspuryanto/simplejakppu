<div class="table-responsive">
    <table id="example1" class="table table-striped table-bordered display" style="width:100%">
        <thead>
            <tr>
                <th>NO</th>
                <th>KODE | NAMA KEGIATAN</th>
                <th>PAGU</th>
                <th>S/D PERIODE LALU</th>
                <th>PERIODE INI</th>
                <th>TOTAL S/D PERIODE</th>
                <th>PRESENTASE</th>
                <th>SISA ANGGARAN</th>
            </tr>
            <!-- <tr>
                <th>Penggugat/ Pemohon/Pelawan</th>
                <th>Tergugat/ Termohon/Terlawan</th>
            </tr> -->
        </thead>
        <tbody>
            <?php
            // echo json_encode($dataRealisasi);
            if($dataRealisasi) :
                $id=1;
                foreach($dataRealisasi as $row) {
                    echo '<tr>
                        <td>'.$id.'</td>
                        <td>'.$row->kode_nama_kegiatan.'</td>
                        <td>'.number_format($row->pagu, 0).'</td>
                        <td>'.number_format($row->periode_lalu, 0).'</td>
                        <td>'.number_format($row->periode_lalu, 0).'</td>
                        <td>'.number_format($row->periode_total, 0).'</td>
                        <td>'.$row->periode_persen.'%</td>
                        <td>'.number_format($row->sisa_anggaran, 0).'</td>
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
            </tr>
        </tfoot>
    </table>
</div>

<?php include_once('_modal_realisasi.php'); ?>

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