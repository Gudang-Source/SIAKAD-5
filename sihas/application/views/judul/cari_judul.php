<div class="container-fluid">
  <div class="page-header" style="margin-top: 50px;">
    <div class="row">
      <div class="col-md-12">
        <h3><?php echo $title_page; ?></h3>
      </div>

    </div>
  </div>
  <div class="row">
    <div class="col-md-12">
      <div class="col-md-3"></div>
      <div class="col-md-6">
        <form class="" action="<?php echo site_url('index/cariJudulAct') ?>" method="post" class="form">
          <div class="form-group">
            <label for="">Masukan Kata Kunci Judul Anda</label>
            <input class="form-control" type="text" name="judul" value="">
          </div>
          <div class="form-group">
            <button type="submit" name="button" class="btn btn-success pull-right">Cari Judul</button>
          </div>
        </form>
      </div>
      <div class="col-md-3"></div>
    </div>
  </div>
</div>
