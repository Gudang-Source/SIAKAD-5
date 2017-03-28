<script type="text/javascript">
  $('.datepicker').datepicker({
      format: 'yyyy-mm-dd',
      startDate: '-3d'
  });

  // (function () {
  //   'use strict';
  //
  //   var qr = new QCodeDecoder();
  //
  //   if (!(qr.isCanvasSupported() && qr.hasGetUserMedia())) {
  //     alert('Your browser doesn\'t match the required specs.');
  //     throw new Error('Canvas and getUserMedia are required');
  //   }
  //
  //   var video = document.querySelector('video');
  //   qr.decodeFromCamera(video, resultHandler);
  //   function resultHandler (err, result) {
  //     if (err)
  //       return err.message;
  //       if (result != '') {
  //         window.location.assign(result);
  //       }
  //   }
  // })();
</script>
