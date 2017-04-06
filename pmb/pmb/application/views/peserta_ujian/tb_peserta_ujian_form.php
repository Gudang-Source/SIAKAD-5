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
    <div class="form-group">
      <label class="form-label" for="varchar">Kode Cmhs <?php echo form_error('kode_cmhs') ?></label>
      <input type="text" class="form-control" name="kode_cmhs" id="kode_cmhs" placeholder="Kode Cmhs" value="<?php echo $kode_cmhs; ?>" readonly/>
    </div>
    <div class="form-group">
      <label class="form-label" for="varchar">Kode Ruangan <?php echo form_error('kode_ruangan') ?></label>
      <input type="text" class="form-control" name="kode_ruangan" id="kode_ruangan" placeholder="Kode Ruangan" value="<?php echo $kode_ruangan; ?>" readonly/>
    </div>
    <div class="form-actions"><input type="hidden" name="id_ujian" value="<?php echo $id_ujian; ?>" />
      <button type="submit" class="btn btn-success"><?php echo $button ?></button>
      <a href="<?php echo site_url('peserta_ujian') ?>" class="btn btn-danger">Cancel</a>
    </div>
  </form>
</div><div class="col-md-4"><h3>panduan</h3><hr /></div>
</div>
