
<?php $uri = $this->uri->segment(2); ?>
<div class="col-md-12">
  <div class="widget-title"> <span class="icon"><i class="icon-th"></i></span>
    <h5><h1 class="page-header"><?php echo $title ?></h1></h5>
  </div>
  <div class="col-md-8">

  <form action="<?php echo $action; ?>" method="post" class="form-horizontal">
	    <div class="form-group">
            <label class="form-label" for="varchar">Kode Ruangan <?php echo form_error('kode_ruangan') ?></label>
            <input type="text" class="form-control" name="kode_ruangan" id="kode_ruangan" placeholder="Kode Ruangan" value="<?php echo $kode_ruangan; ?>" />
        </div>
	    <div class="form-group">
            <label class="form-label" for="varchar">Nm Ruangan <?php echo form_error('nm_ruangan') ?></label>
            <input type="text" class="form-control" name="nm_ruangan" id="nm_ruangan" placeholder="Nm Ruangan" value="<?php echo $nm_ruangan; ?>" />
        </div>
	    <div class="form-actions"><input type="hidden" name="id_ruangan" value="<?php echo $id_ruangan; ?>" /> 
	    <button type="submit" class="btn btn-primary"><?php echo $button ?></button> 
	    <a href="<?php echo site_url('ruangan') ?>" class="btn btn-default">Cancel</a>
	</div>
</form>
</div><div class="col-md-4"><h3>panduan</h3><hr /></div>
</div>