
<?php $uri = $this->uri->segment(2); ?>
<div class="col-md-12">
  <div class="widget-title"> <span class="icon"><i class="icon-th"></i></span>
    <h5><h1 class="page-header"><?php echo $title ?></h1></h5>
  </div>
  <div class="col-md-8">

  <form action="<?php echo $action; ?>" method="post" class="form-horizontal">
	    <div class="form-group">
            <label class="form-label" for="varchar">Kode Agama <?php echo form_error('kode_agama') ?></label>
            <input type="text" class="form-control" name="kode_agama" id="kode_agama" placeholder="Kode Agama" value="<?php echo $kode_agama; ?>" />
        </div>
	    <div class="form-group">
            <label class="form-label" for="varchar">Nm Agama <?php echo form_error('nm_agama') ?></label>
            <input type="text" class="form-control" name="nm_agama" id="nm_agama" placeholder="Nm Agama" value="<?php echo $nm_agama; ?>" />
        </div>
	    <div class="form-actions"><input type="hidden" name="id_agama" value="<?php echo $id_agama; ?>" /> 
	    <button type="submit" class="btn btn-primary"><?php echo $button ?></button> 
	    <a href="<?php echo site_url('agama') ?>" class="btn btn-default">Cancel</a>
	</div>
</form>
</div><div class="col-md-4"><h3>panduan</h3><hr /></div>
</div>