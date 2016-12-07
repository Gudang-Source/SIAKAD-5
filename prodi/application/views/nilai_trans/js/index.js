<script type="text/javascript">
    $(document).ready(function () {
        $(".table").dataTable();
        $('#id_mhs_trans').select2({
          placeholder: "Masukan Kata Kunci NIM | Nama |",
          //minimumInputLength: 1,
          ajax: {
            url: top_url+'nilai_trans/get_mhs_trans',
            type: "POST",
            dataType: 'json',
            delay: 20,
            data: function (cari) {
              console.log(cari);
              return {
                q: cari.term,
                page: 20
              };
            },
            processResults: function (data) {
              return {
                results: $.map(data, function(obj) {
                  return {
                    id: obj.id_trans,
      							text: obj.nim+ " | " +obj.nm_mhs
                  };
                })
              };
            },
            cache: true
          }
        });

        $('#id_mk').select2({
          placeholder: "Masukan Kata Kunci Nama MK | Semester",
          //minimumInputLength: 1,
          ajax: {
            url: top_url+'nilai_trans/get_mata_kuliah',
            type: "POST",
            dataType: 'json',
            delay: 20,
            data: function (cari) {
              console.log(cari);
              return {
                q: cari.term,
                page: 20
              };
            },
            processResults: function (data) {
              return {
                results: $.map(data, function(obj) {
                  return {
                    id: obj.id_mk,
      							text: obj.nm_mk+ " | " +obj.smt
                  };
                })
              };
            },
            cache: true
          }
        });
    });
</script>
