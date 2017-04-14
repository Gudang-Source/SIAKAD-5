<script type="text/javascript">
    $(document).ready(function () {
        // $("#krstable").dataTable();
        $(".table").dataTable({
          "lengthMenu": [[25, 50, -1], [25, 50, "All"]]
        });
        $('#filter_kelas').select2({
          placeholder: "Masukan Kata Kunci Kelas Nama",
          //minimumInputLength: 1,
          ajax: {
            url: top_url+'data_krs/getKelasMataKuliah/<?php echo $ta."/".$kode_prodi ?>',
            type: "POST",
            dataType: 'json',
            delay: 20,
            data: function (cari) {
              return {
                q: cari.term,
                page: 20
              };
            },
            processResults: function (data) {
              return {
                results: $.map(data, function(obj) {
                  return {
                    id: obj.nm_kelas,
      				text: obj.nm_kelas+" | "+obj.ta
                  };
                })
              };
            },
            cache: true
          }
        });
    });
</script>
