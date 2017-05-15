<script type="text/javascript">
  $('.datepicker').datepicker({
      format: 'yyyy-mm-dd',
      changeYear: true

  });

  $("#btnAddIbu").click(function(){
    $('#addIbu').modal('show');
  });

  $("#btnAddAyah").click(function(){
    $('#addAyah').modal('show');
  });

  $("#btnSearchAyah1").click(function(){
    var kode_cmhs = $("#kode_cmhs_1").val();
    $.ajax({
        url: top_url+"/ajax/cek_kode_ayah",
        beforeSend: function() {
          $('#loader').show();
        },
        complete: function(){
           $('#loader').hide();
        },
        success: function(result){
          var obj = JSON.parse(result);
          if (obj.result==0) {
            var a=eval(obj.result)+1;
            $("#kode_ayah_1").val(kode_cmhs+".01."+a);
          }
          else {
            var a=eval(obj.id_ayah)+1;
            $("#kode_ayah_1").val(kode_cmhs+".01."+a);
          }
      }
    });
  });

  $("#unggahAyah").click(function() {
    $("#formAyah").submit(function(e)
    {
      var postData = $("#formAyah").serializeArray();
      var formURL = $(this).attr("action");
      $.ajax(
      {
          url : formURL,
          type: "POST",
          data : postData,
          success:function(data, textStatus, jqXHR)
          {
            var obj = JSON.parse(data);
            $("#kode_ayah").val(obj.kode_ayah);
            $('#addAyah').modal('hide');
          },
          error: function(jqXHR, textStatus, errorThrown)
          {
              console.log(errorThrown);
          }
      });
      e.preventDefault(); //STOP default action
    });
  });


  $("#btnSearchIbu1").click(function(){
    var kode_cmhs = $("#kode_cmhs_2").val();
    $.ajax({
        url: top_url+"/ajax/cek_kode_ibu",
        beforeSend: function() {
          $('#loader').show();
        },
        complete: function(){
           $('#loader').hide();
        },
        success: function(result){
          var obj = JSON.parse(result);
          if (obj.result==0) {
            var a=eval(obj.result)+1;
            $("#kode_ibu_1").val(kode_cmhs+".01."+a);
          }
          else {
            var a=eval(obj.id_ibu)+1;
            $("#kode_ibu_1").val(kode_cmhs+".01."+a);
          }
      }
    });
  });

$("#unggahIbu").click(function() {
    $("#formIbu").submit(function(e)
    {
      var postData = $("#formIbu").serializeArray();
      var formURL = $(this).attr("action");
      $.ajax(
      {
          url : formURL,
          type: "POST",
          data : postData,
          success:function(data, textStatus, jqXHR)
          {
            var obj = JSON.parse(data);
            $("#kode_ibu").val(obj.kode_ibu);
            $('#addIbu').modal('hide');
          },
          error: function(jqXHR, textStatus, errorThrown)
          {
              console.log(errorThrown);
          }
      });
      e.preventDefault(); //STOP default action
    });
  });

</script>
