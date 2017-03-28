
<?php $uri = $this->uri->segment(2); ?>
<div class="col-md-12">
  <div class="widget-title"> <span class="icon"><i class="icon-th"></i></span>
    <h5><h1 class="page-header"><?php echo $title ?></h1></h5>
  </div>
  <div class="col-md-8">

  <form action="<?php echo $action; ?>" method="post" class="form-horizontal">
	    <div class="form-group">
            <label class="form-label" for="varchar">Kode Mhs Wali <?php echo form_error('kode_mhs_wali') ?></label>
            <input type="text" class="form-control" name="kode_mhs_wali" id="kode_mhs_wali" placeholder="Kode Mhs Wali" value="<?php echo $kode_mhs_wali; ?>" />
        </div>
	    <div class="form-group">
            <label class="form-label" for="varchar">Kode Cmhs <?php echo form_error('kode_cmhs') ?></label>
            <input type="text" class="form-control" name="kode_cmhs" id="kode_cmhs" placeholder="Kode Cmhs" value="<?php echo $kode_cmhs; ?>" />
        </div>
	    <div class="form-group">
            <label class="form-label" for="varchar">Nm Wali <?php echo form_error('nm_wali') ?></label>
            <input type="text" class="form-control" name="nm_wali" id="nm_wali" placeholder="Nm Wali" value="<?php echo $nm_wali; ?>" />
        </div>
<?php
                if($uri == 'create'){
                  ?>
	<div class="form-group">
                          <label class="form-label" for="kode_hubungan">Kode Hubungan <?php echo form_error('kode_hubungan') ?></label>
                          <select class="form-control" rows="3" name="kode_hubungan" id="kode_hubungan" value="<?php echo $kode_hubungan ?>"><?php echo $kode_hubungan; ?>
                            <option value=""> Mohon Pilih Salah Satu</option>
                            <?php
                            foreach($tb_hubungan as $key){
                              ?>
                              <option value="<?php echo $key->kode_hubungan ?>"><?php echo $key->kode_hubungan ?></option>
                              <?php
                            }
                            ?>
                          </select>
                      </div>  <?php
                }
                else{
                  ?>
	    <div class="form-group">
                          <label class="form-label" for="varchar">Kode Hubungan <?php echo form_error('kode_hubungan') ?></label>
                          <input type="text" class="form-control" name="kode_hubungan" id="kode_hubungan" placeholder="Kode Hubungan" value="<?php echo $kode_hubungan; ?>" />
                      </div>  <?php
                }
                ?>
	    <div class="form-actions"><input type="hidden" name="id_mhs_wali" value="<?php echo $id_mhs_wali; ?>" /> 
	    <button type="submit" class="btn btn-primary"><?php echo $button ?></button> 
	    <a href="<?php echo site_url('mhs_wali') ?>" class="btn btn-default">Cancel</a>
	</div>
</form>
</div><div class="col-md-4"><h3>panduan</h3><hr /></div>
</div>