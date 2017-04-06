<div class="col-md-12">
  <div class="widget-title"> <span class="icon"><i class="icon-th"></i></span>
    <h5><h1 class="page-header"><?php echo $title ?></h1></h5>
  </div>
  <div class="col-md-8">
  <form action="<?php echo $action; ?>" method="post" class="form-horizontal">
    <div class="form-group">
      <label class="form-label" for="varchar">Kode Ujian <?php echo form_error('kode_ujian') ?></label>
      <input type="text" class="form-control" name="kode_ujian" id="kode_ujian" placeholder="Kode Ujian" value="<?php echo $kode_ujian; ?>" readonly/>
    </div>
  </form>
</div><div class="col-md-4"><h3>panduan</h3><hr /></div>
</div>
