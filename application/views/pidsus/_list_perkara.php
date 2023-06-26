<div class="table-responsive">
    <table id="example1" class="table table-striped table-bordered" style="width:100%">
        <thead>
            <tr>
                <th>NO</th>
                <th>NO PULBAKET/ TGL/NAMA JAKSA</th>
                <th>NO PENYELIDIKAN/ TGL/NAMA JAKSA</th>
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
            </tr>
        </thead>
        <tbody></tbody>
    </table>
</div>

<?php include_once('_modal_perkara.php'); ?>

<script type="text/javascript">
$( document ).ready(function() {
    $('#error').html(" ");

    $('#form-submit').on('click', function (e) {
        e.preventDefault();

        $.ajax({
            type: "POST",
            url: "<?php echo site_url('papan-kontrol/pidsus_add');?>", 
            data: $("#form").serialize(),
            dataType: "json",  
            success: function(data){
                console.log(data, "data");
                if(data.success == true){
                    window.location.reload();
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