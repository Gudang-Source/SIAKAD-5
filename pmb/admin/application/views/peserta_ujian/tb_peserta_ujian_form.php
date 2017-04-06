
<?php $uri = $this->uri->segment(2); ?>
<div class="col-md-12">
  <div class="widget-title"> <span class="icon"><i class="icon-th"></i></span>
    <h5><h1 class="page-header"><?php echo $title ?></h1></h5>
  </div>
  <div class="col-md-8">

  <form action="<?php echo $action; ?>" method="post" class="form-horizontal">
	    <div class="form-group">
            <label class="form-label" for="varchar">Kode Ujian <?php echo form_error('kode_ujian') ?></label>
            <input type="text" class="form-control" name="kode_ujian" id="kode_ujian" placeholder="Kode Ujian" value="<?php echo $kode_ujian; ?>" />
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
<?php
                if($uri == 'create'){
                  ?>
	<div class="form-group">
                          <label class="form-label" for="kode_ruangan">Kode Ruangan <?php echo form_error('kode_ruangan') ?></label>
                          <select class="form-control" rows="3" name="kode_ruangan" id="kode_ruangan" value="<?php echo $kode_ruangan ?>"><?php echo $kode_ruangan; ?>
                            <option value=""> Mohon Pilih Salah Satu</option>
                            <?php
                            foreach($tb_ruangan as $key){
                              ?>
                              <option value="<?php echo $key->kode_ruangan ?>"><?php echo $key->kode_ruangan ?></option>
                              <?php
                            }
                            ?>
                          </select>
                      </div>  <?php
                }
                else{
                  ?>
	    <div class="form-group">
                          <label class="form-label" for="varchar">Kode Ruangan <?php echo form_error('kode_ruangan') ?></label>
                          <input type="text" class="form-control" name="kode_ruangan" id="kode_ruangan" placeholder="Kode Ruangan" value="<?php echo $kode_ruangan; ?>" />
                      </div>  <?php
                }
                ?>
	    <div class="form-group">
            <label class="form-label" for="varchar">N Wawancara <?php echo form_error('n_wawancara') ?></label>
            <input type="text" class="form-control" name="n_wawancara" id="n_wawancara" placeholder="N Wawancara" value="<?php echo $n_wawancara; ?>" />
        </div>
	    <div class="form-group">
            <label class="form-label" for="varchar">N Psikotes <?php echo form_error('n_psikotes') ?></label>
            <input type="text" class="form-control" name="n_psikotes" id="n_psikotes" placeholder="N Psikotes" value="<?php echo $n_psikotes; ?>" />
        </div>
	    <div class="form-group">
            <label class="form-label" for="varchar">N Bhs <?php echo form_error('n_bhs') ?></label>
            <input type="text" class="form-control" name="n_bhs" id="n_bhs" placeholder="N Bhs" value="<?php echo $n_bhs; ?>" />
        </div>
	    <div class="form-group">
            <label class="form-label" for="varchar">N Umum <?php echo form_error('n_umum') ?></label>
            <input type="text" class="form-control" name="n_umum" id="n_umum" placeholder="N Umum" value="<?php echo $n_umum; ?>" />
        </div>
	<div class="form-group">
              <label class="form-label" for="status_ujian">Status Ujian <?php echo form_error('status_ujian') ?></label>
              <select class="form-control" rows="3" name="status_ujian" id="status_ujian"><?php echo $status_ujian; ?>
                <option value=""> Mohon Pilih Salah Satu</option> <!-- tolong edit -->
                <option value="Y">Ya</option>
                <option value="N">No</option>
                </select>
          </div>
	    <div class="form-actions"><input type="hidden" name="id_ujian" value="<?php echo $id_ujian; ?>" /> 
	    <button type="submit" class="btn btn-primary"><?php echo $button ?></button> 
	    <a href="<?php echo site_url('peserta_ujian') ?>" class="btn btn-default">Cancel</a>
	</div>
</form>
</div><div class="col-md-4"><h3>panduan</h3><hr /></div>
</div>