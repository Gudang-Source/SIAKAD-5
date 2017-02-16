<script type="text/javascript">
    $(document).ready(function () {
        $("#mytable").dataTable();
        $("#btn_filter").click(function(){
            var kat_filter = $("#kat_filter").val();
            var nm_filter = $("#nm_filter").val();
            $('#filter_form').attr('action', top_url+"Mahasiswa/index/"+kat_filter+"/"+nm_filter).submit();
        });
    });
</script>
