
<?php $uri = $this->uri->segment(2); ?>
<div class="col-md-12">
  <div class="widget-title"> <span class="icon"><i class="icon-th"></i></span>
    <h5><h1 class="page-header"><?php echo $title ?></h1></h5>
  </div>
  <div class="col-md-8">

  <form action="<?php echo $action; ?>" method="post" class="form-horizontal">
	    <div class="form-group">
            <label class="form-label" for="varchar">Kode Ibu <?php echo form_error('kode_ibu') ?></label>
            <input type="text" class="form-control" name="kode_ibu" id="kode_ibu" placeholder="Kode Ibu" value="<?php echo $kode_ibu; ?>" />
        </div>
<?php
                if($uri == 'create'){
                  ?>
	<div class="form-group">
                          <label class="form-label" for="kode_cmhs">Kode Cmhs <?php echo form_error('kode_cmhs') ?></label>
                          <select class="form-control" rows="3" name="kode_cmhs" id="kode_cmhs" value="<?php echo $kode_cmhs ?>"><?php echo $kode_cmhs; ?>
                            <option value=""> Mohon Pilih Salah Satu</option>
                            <?php
                            foreach($tb_cmhs as $key){
                              ?>
                              <option value="<?php echo $key->kode_cmhs ?>"><?php echo $key->kode_cmhs ?></option>
                              <?php
                            }
                            ?>
                          </select>
                      </div>  <?php
                }
                else{
                  ?>
	    <div class="form-group">
                          <label class="form-label" for="varchar">Kode Cmhs <?php echo form_error('kode_cmhs') ?></label>
                          <input type="text" class="form-control" name="kode_cmhs" id="kode_cmhs" placeholder="Kode Cmhs" value="<?php echo $kode_cmhs; ?>" />
                      </div>  <?php
                }
                ?>
	    <div class="form-group">
            <label class="form-label" for="varchar">Nm Ibu <?php echo form_error('nm_ibu') ?></label>
            <input type="text" class="form-control" name="nm_ibu" id="nm_ibu" placeholder="Nm Ibu" value="<?php echo $nm_ibu; ?>" />
        </div>
<?php
                if($uri == 'create'){
                  ?>
	<div class="form-group">
                          <label class="form-label" for="kode_pekerjaan">Kode Pekerjaan <?php echo form_error('kode_pekerjaan') ?></label>
                          <select class="form-control" rows="3" name="kode_pekerjaan" id="kode_pekerjaan" value="<?php echo $kode_pekerjaan ?>"><?php echo $kode_pekerjaan; ?>
                            <option value=""> Mohon Pilih Salah Satu</option>
                            <?php
                            foreach($tb_pekerjaan as $key){
                              ?>
                              <option value="<?php echo $key->kode_pekerjaan ?>"><?php echo $key->kode_pekerjaan ?></option>
                              <?php
                            }
                            ?>
                          </select>
                      </div>  <?php
                }
                else{
                  ?>
	    <div class="form-group">
                          <label class="form-label" for="varchar">Kode Pekerjaan <?php echo form_error('kode_pekerjaan') ?></label>
                          <input type="text" class="form-control" name="kode_pekerjaan" id="kode_pekerjaan" placeholder="Kode Pekerjaan" value="<?php echo $kode_pekerjaan; ?>" />
                      </div>  <?php
                }
                ?>
<?php
                if($uri == 'create'){
                  ?>
	<div class="form-group">
                          <label class="form-label" for="kode_penghasilan">Kode Penghasilan <?php echo form_error('kode_penghasilan') ?></label>
                          <select class="form-control" rows="3" name="kode_penghasilan" id="kode_penghasilan" value="<?php echo $kode_penghasilan ?>"><?php echo $kode_penghasilan; ?>
                            <option value=""> Mohon Pilih Salah Satu</option>
                            <?php
                            foreach($tb_penghasilan as $key){
                              ?>
                              <option value="<?php echo $key->kode_penghasilan ?>"><?php echo $key->kode_penghasilan ?></option>
                              <?php
                            }
                            ?>
                          </select>
                      </div>  <?php
                }
                else{
                  ?>
	    <div class="form-group">
                          <label class="form-label" for="varchar">Kode Penghasilan <?php echo form_error('kode_penghasilan') ?></label>
                          <input type="text" class="form-control" name="kode_penghasilan" id="kode_penghasilan" placeholder="Kode Penghasilan" value="<?php echo $kode_penghasilan; ?>" />
                      </div>  <?php
                }
                ?>
	    <div class="form-actions"><input type="hidden" name="id_ibu" value="<?php echo $id_ibu; ?>" /> 
	    <button type="submit" class="btn btn-primary"><?php echo $button ?></button> 
	    <a href="<?php echo site_url('ibu') ?>" class="btn btn-default">Cancel</a>
	</div>
</form>
</div><div class="col-md-4"><h3>panduan</h3><hr /></div>
</div>