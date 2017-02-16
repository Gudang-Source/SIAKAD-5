<script type="text/javascript">
    $(document).ready(function () {
        $(".table").dataTable();
    });
    $("#btn_filter").click(function(){
          var kat_filter = $("#kat_filter").val();
          var nm_filter = $("#nm_filter").val();
          $('#filter_form').attr('action', top_url+"Mhs_krs/index/"+kat_filter+"/"+nm_filter).submit();
        });
</script>
