
<?php $uri = $this->uri->segment(2); ?>
<div class="col-md-12">
  <div class="widget-title"> <span class="icon"><i class="icon-th"></i></span>
    <h5><h1 class="page-header"><?php echo $title ?></h1></h5>
  </div>
  <div class="col-md-8">

  <form action="<?php echo $action; ?>" method="post" class="form-horizontal">
	    <div class="form-group">
            <label class="form-label" for="int">Kode Prodi <?php echo form_error('kode_prodi') ?></label>
            <input type="text" class="form-control" name="kode_prodi" id="kode_prodi" placeholder="Kode Prodi" value="<?php echo $kode_prodi; ?>" />
        </div>
	    <div class="form-group">
            <label class="form-label" for="varchar">Nm Prodi <?php echo form_error('nm_prodi') ?></label>
            <input type="text" class="form-control" name="nm_prodi" id="nm_prodi" placeholder="Nm Prodi" value="<?php echo $nm_prodi; ?>" />
        </div>
	    <div class="form-actions"><input type="hidden" name="id_prodi" value="<?php echo $id_prodi; ?>" /> 
	    <button type="submit" class="btn btn-primary"><?php echo $button ?></button> 
	    <a href="<?php echo site_url('prodi') ?>" class="btn btn-default">Cancel</a>
	</div>
</form>
</div><div class="col-md-4"><h3>panduan</h3><hr /></div>
</div>