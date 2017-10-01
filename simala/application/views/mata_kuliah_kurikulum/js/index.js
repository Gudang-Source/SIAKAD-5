<script type="text/javascript">
    $(document).ready(function () {
        $(".table").dataTable();

        $('#id_kurikulum').select2({
          placeholder: "Masukan Kata Kunci Kurikulum Nama | Periode| Kode Prodi",
          //minimumInputLength: 1,
          ajax: {
            url: top_url+'mata_kuliah_kurikulum/getKurikulum',
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
                    id: obj.id_kurikulum,
      							text: obj.nm_kurikulum+" | "+obj.ta+" | "+obj.kd_prodi
                  };
                })
              };
            },
            cache: true
          }
        });

        $('#kode_mk').select2({
          placeholder: "Masukan Kata Kunci kode_mk | Nama MK ",
          //minimumInputLength: 1,
          ajax: {
            url: top_url+'mata_kuliah_kurikulum/get_mata_kuliah',
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
                    id: obj.kode_mk,
      				text:obj.kode_mk+" | "+obj.nm_mk
                  };
                })
              };
            },
            cache: true
          }
        });
    });
</script>
