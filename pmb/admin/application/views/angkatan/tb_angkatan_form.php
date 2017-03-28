
<?php $uri = $this->uri->segment(2); ?>
<div class="col-md-12">
  <div class="widget-title"> <span class="icon"><i class="icon-th"></i></span>
    <h5><h1 class="page-header"><?php echo $title ?></h1></h5>
  </div>
  <div class="col-md-8">

  <form action="<?php echo $action; ?>" method="post" class="form-horizontal">
	    <div class="form-group">
            <label class="form-label" for="int">Kode Angkatan <?php echo form_error('kode_angkatan') ?></label>
            <input type="text" class="form-control" name="kode_angkatan" id="kode_angkatan" placeholder="Kode Angkatan" value="<?php echo $kode_angkatan; ?>" />
        </div>
	    <div class="form-group">
            <label class="form-label" for="varchar">Thn Akademik <?php echo form_error('thn_akademik') ?></label>
            <input type="text" class="form-control" name="thn_akademik" id="thn_akademik" placeholder="Thn Akademik" value="<?php echo $thn_akademik; ?>" />
        </div>
	    <div class="form-group">
            <label class="form-label" for="varchar">Tahun <?php echo form_error('tahun') ?></label>
            <input type="text" class="form-control" name="tahun" id="tahun" placeholder="Tahun" value="<?php echo $tahun; ?>" />
        </div>
	<div class="form-group">
              <label class="form-label" for="status_aktif">Status Aktif <?php echo form_error('status_aktif') ?></label>
              <select class="form-control" rows="3" name="status_aktif" id="status_aktif"><?php echo $status_aktif; ?>
                <option value=""> Mohon Pilih Salah Satu</option> <!-- tolong edit -->
                <option value="Y">Ya</option>
                <option value="N">No</option>
                </select>
          </div>
	    <div class="form-actions"><input type="hidden" name="id_angkatan" value="<?php echo $id_angkatan; ?>" /> 
	    <button type="submit" class="btn btn-primary"><?php echo $button ?></button> 
	    <a href="<?php echo site_url('angkatan') ?>" class="btn btn-default">Cancel</a>
	</div>
</form>
</div><div class="col-md-4"><h3>panduan</h3><hr /></div>
</div>