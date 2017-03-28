
<?php $uri = $this->uri->segment(2); ?>
<div class="col-md-12">
  <div class="widget-title"> <span class="icon"><i class="icon-th"></i></span>
    <h5><h1 class="page-header"><?php echo $title ?></h1></h5>
  </div>
  <div class="col-md-8">

  <form action="<?php echo $action; ?>" method="post" class="form-horizontal">
	    <div class="form-group">
            <label class="form-label" for="varchar">Kode Wilayah <?php echo form_error('kode_wilayah') ?></label>
            <input type="text" class="form-control" name="kode_wilayah" id="kode_wilayah" placeholder="Kode Wilayah" value="<?php echo $kode_wilayah; ?>" />
        </div>
	<div class="form-group">
            <label class="form-label" for="nm_wilayah">Nm Wilayah <?php echo form_error('nm_wilayah') ?></label>
            <textarea class="form-control" rows="3" name="nm_wilayah" id="nm_wilayah" placeholder="Nm Wilayah"><?php echo $nm_wilayah; ?></textarea>
        </div>
	    <div class="form-actions"><input type="hidden" name="id_wilayah" value="<?php echo $id_wilayah; ?>" /> 
	    <button type="submit" class="btn btn-primary"><?php echo $button ?></button> 
	    <a href="<?php echo site_url('wilayah') ?>" class="btn btn-default">Cancel</a>
	</div>
</form>
</div><div class="col-md-4"><h3>panduan</h3><hr /></div>
</div>