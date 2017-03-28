
<?php $uri = $this->uri->segment(2); ?>
<div class="col-md-12">
  <div class="widget-title"> <span class="icon"><i class="icon-th"></i></span>
    <h5><h1 class="page-header"><?php echo $title ?></h1></h5>
  </div>
  <div class="col-md-8">

  <form action="<?php echo $action; ?>" method="post" class="form-horizontal">
	    <div class="form-group">
            <label class="form-label" for="varchar">Kode Hubungan <?php echo form_error('kode_hubungan') ?></label>
            <input type="text" class="form-control" name="kode_hubungan" id="kode_hubungan" placeholder="Kode Hubungan" value="<?php echo $kode_hubungan; ?>" />
        </div>
	<div class="form-group">
            <label class="form-label" for="nm_hubungan">Nm Hubungan <?php echo form_error('nm_hubungan') ?></label>
            <textarea class="form-control" rows="3" name="nm_hubungan" id="nm_hubungan" placeholder="Nm Hubungan"><?php echo $nm_hubungan; ?></textarea>
        </div>
	    <div class="form-actions"><input type="hidden" name="id_hubungan" value="<?php echo $id_hubungan; ?>" /> 
	    <button type="submit" class="btn btn-primary"><?php echo $button ?></button> 
	    <a href="<?php echo site_url('hubungan') ?>" class="btn btn-default">Cancel</a>
	</div>
</form>
</div><div class="col-md-4"><h3>panduan</h3><hr /></div>
</div>