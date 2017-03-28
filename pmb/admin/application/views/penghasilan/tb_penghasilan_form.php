
<?php $uri = $this->uri->segment(2); ?>
<div class="col-md-12">
  <div class="widget-title"> <span class="icon"><i class="icon-th"></i></span>
    <h5><h1 class="page-header"><?php echo $title ?></h1></h5>
  </div>
  <div class="col-md-8">

  <form action="<?php echo $action; ?>" method="post" class="form-horizontal">
	    <div class="form-group">
            <label class="form-label" for="varchar">Kode Penghasilan <?php echo form_error('kode_penghasilan') ?></label>
            <input type="text" class="form-control" name="kode_penghasilan" id="kode_penghasilan" placeholder="Kode Penghasilan" value="<?php echo $kode_penghasilan; ?>" />
        </div>
	    <div class="form-group">
            <label class="form-label" for="varchar">Penghasilan <?php echo form_error('penghasilan') ?></label>
            <input type="text" class="form-control" name="penghasilan" id="penghasilan" placeholder="Penghasilan" value="<?php echo $penghasilan; ?>" />
        </div>
	    <div class="form-actions"><input type="hidden" name="id_penghasilan" value="<?php echo $id_penghasilan; ?>" /> 
	    <button type="submit" class="btn btn-primary"><?php echo $button ?></button> 
	    <a href="<?php echo site_url('penghasilan') ?>" class="btn btn-default">Cancel</a>
	</div>
</form>
</div><div class="col-md-4"><h3>panduan</h3><hr /></div>
</div>