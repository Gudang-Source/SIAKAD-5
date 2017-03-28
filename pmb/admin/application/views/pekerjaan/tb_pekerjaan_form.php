
<?php $uri = $this->uri->segment(2); ?>
<div class="col-md-12">
  <div class="widget-title"> <span class="icon"><i class="icon-th"></i></span>
    <h5><h1 class="page-header"><?php echo $title ?></h1></h5>
  </div>
  <div class="col-md-8">

  <form action="<?php echo $action; ?>" method="post" class="form-horizontal">
	    <div class="form-group">
            <label class="form-label" for="varchar">Kode Pekerjaan <?php echo form_error('kode_pekerjaan') ?></label>
            <input type="text" class="form-control" name="kode_pekerjaan" id="kode_pekerjaan" placeholder="Kode Pekerjaan" value="<?php echo $kode_pekerjaan; ?>" />
        </div>
	    <div class="form-group">
            <label class="form-label" for="varchar">Nm Pekerjaan <?php echo form_error('nm_pekerjaan') ?></label>
            <input type="text" class="form-control" name="nm_pekerjaan" id="nm_pekerjaan" placeholder="Nm Pekerjaan" value="<?php echo $nm_pekerjaan; ?>" />
        </div>
	    <div class="form-actions"><input type="hidden" name="id_pekerjaan" value="<?php echo $id_pekerjaan; ?>" /> 
	    <button type="submit" class="btn btn-primary"><?php echo $button ?></button> 
	    <a href="<?php echo site_url('pekerjaan') ?>" class="btn btn-default">Cancel</a>
	</div>
</form>
</div><div class="col-md-4"><h3>panduan</h3><hr /></div>
</div>