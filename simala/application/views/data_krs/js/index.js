<script type="text/javascript">
    $(document).ready(function () {
        $("#krstable").dataTable();
        $("#krstable1").dataTable();

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
