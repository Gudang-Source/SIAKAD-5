<script type="text/javascript">
    $(document).ready(function () {
      $("#mytable").dataTable();
        $("#krstable").dataTable();
        $('#id_kelas').select2({
          placeholder: "Masukan Kata Kunci Nama Kelas | kode MK | Nama MK | Periode | Jurusan",
          //minimumInputLength: 1,
          ajax: {
            url: top_url+'data_krs/getKelas',
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
                    id: obj.id_kelas,
      							text: "Kelas : "+obj.nm_kelas+" | "+obj.id_matkul+" | "+obj.nm_mk+" | "+obj.ta+" | "+obj.nm_prodi
                  };
                })
              };
            },
            cache: true
          }
        });

        $('#id_krs').select2({
          placeholder: "Masukan Kata Kunci NIM | Nama | Periode",
          //minimumInputLength: 1,
          ajax: {
            url: top_url+'data_krs/getMhsKrs',
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
                    id: obj.id_krs,
      				text: obj.id_mhs+ " | " +obj.nm_mhs+" | "+obj.ta
                  };
                })
              };
            },
            cache: true
          }
        });

        $("#btn_filter").click(function(){
            var kat_filter = $("#kat_filter").val();
            var nm_filter = $("#nm_filter").val();
            $('#filter_form').attr('action', top_url+"data_krs/index/"+kat_filter+"/"+nm_filter).submit();
        });

        $.get(top_url+"data_krs/graphRasio/<?php echo $periode.'/'.$kode_prodi ?>", function(data, status){
            var obj = JSON.parse(data);
            var mhs=[];
            var smt_masuk = [];
            $.each( obj, function( key, value ) {
                mhs.push(value['mahasiswa_aktif']);
                smt = value['smt_masuk'];
                smt_masuk.push(smt.substr(0,4));
            });

            var lineChartData = {
      				labels : smt_masuk,
      				datasets : [
      					{
      						label: "Mahasiswa Aktif",
      						fillColor : "rgba(48, 164, 255, 0.2)",
      						strokeColor : "rgba(48, 164, 255, 1)",
      						pointColor : "rgba(48, 164, 255, 1)",
      						pointStrokeColor : "#fff",
      						pointHighlightFill : "#fff",
      						pointHighlightStroke : "rgba(48, 164, 255, 1)",
      						data : mhs
                        }
      				]
      			}

          var temp1 = document.getElementById("chart2").getContext("2d");
      		var myLine1 = new Chart(temp1).Line(lineChartData, {
      			responsive: true
      		});
        });
    });
</script>
