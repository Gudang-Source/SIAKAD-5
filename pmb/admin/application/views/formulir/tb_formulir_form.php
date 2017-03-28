
<?php $uri = $this->uri->segment(2); ?>
<div class="col-md-12">
  <div class="widget-title"> <span class="icon"><i class="icon-th"></i></span>
    <h5><h1 class="page-header"><?php echo $title ?></h1></h5>
  </div>
  <div class="col-md-8">

  <form action="<?php echo $action; ?>" method="post" class="form-horizontal">
	    <div class="form-group">
            <label class="form-label" for="varchar">Kode Formulir <?php echo form_error('kode_formulir') ?></label>
            <input type="text" class="form-control" name="kode_formulir" id="kode_formulir" placeholder="Kode Formulir" value="<?php echo $kode_formulir; ?>" />
        </div>
	    <div class="form-group">
            <label class="form-label" for="varchar">Username <?php echo form_error('username') ?></label>
            <input type="text" class="form-control" name="username" id="username" placeholder="Username" value="<?php echo $username; ?>" />
        </div>
	    <div class="form-group">
            <label class="form-label" for="varchar">Password <?php echo form_error('password') ?></label>
            <input type="text" class="form-control" name="password" id="password" placeholder="Password" value="<?php echo $password; ?>" />
        </div>
	<div class="form-group">
            <label class="form-label" for="nm_pendaftar">Nm Pendaftar <?php echo form_error('nm_pendaftar') ?></label>
            <textarea class="form-control" rows="3" name="nm_pendaftar" id="nm_pendaftar" placeholder="Nm Pendaftar"><?php echo $nm_pendaftar; ?></textarea>
        </div>
<?php
                if($uri == 'create'){
                  ?>
	<div class="form-group">
                          <label class="form-label" for="kode_pegawai">Kode Pegawai <?php echo form_error('kode_pegawai') ?></label>
                          <select class="form-control" rows="3" name="kode_pegawai" id="kode_pegawai" value="<?php echo $kode_pegawai ?>"><?php echo $kode_pegawai; ?>
                            <option value=""> Mohon Pilih Salah Satu</option>
                            <?php
                            foreach($tb_pegawai as $key){
                              ?>
                              <option value="<?php echo $key->kode_pegawai ?>"><?php echo $key->nm_pegawai ?></option>
                              <?php
                            }
                            ?>
                          </select>
                      </div>  <?php
                }
                else{
                  ?>
	    <div class="form-group">
                          <label class="form-label" for="varchar">Kode Pegawai <?php echo form_error('kode_pegawai') ?></label>
                          <input type="text" class="form-control" name="kode_pegawai" id="kode_pegawai" placeholder="Kode Pegawai" value="<?php echo $kode_pegawai; ?>" />
                      </div>  <?php
                }
                ?>
<?php
                if($uri == 'create'){
                  ?>
	<div class="form-group">
                          <label class="form-label" for="kode_angkatan">Kode Angkatan <?php echo form_error('kode_angkatan') ?></label>
                          <select class="form-control" rows="3" name="kode_angkatan" id="kode_angkatan" value="<?php echo $kode_angkatan ?>"><?php echo $kode_angkatan; ?>
                            <option value=""> Mohon Pilih Salah Satu</option>
                            <?php
                            foreach($tb_angkatan as $key){
                              ?>
                              <option value="<?php echo $key->kode_angkatan ?>"><?php echo $key->thn_akademik ?></option>
                              <?php
                            }
                            ?>
                          </select>
                      </div>  <?php
                }
                else{
                  ?>
	    <div class="form-group">
                          <label class="form-label" for="int">Kode Angkatan <?php echo form_error('kode_angkatan') ?></label>
                          <input type="text" class="form-control" name="kode_angkatan" id="kode_angkatan" placeholder="Kode Angkatan" value="<?php echo $kode_angkatan; ?>"/>
                      </div>  <?php
                }
                ?>
	    <div class="form-group">
            <label class="form-label" for="int">Biaya <?php echo form_error('biaya') ?></label>
            <input type="text" class="form-control" name="biaya" id="biaya" placeholder="Biaya" value="<?php echo $biaya; ?>" />
        </div>
	    <div class="form-actions"><input type="hidden" name="id_formulir" value="<?php echo $id_formulir; ?>" />
	    <button type="submit" class="btn btn-primary"><?php echo $button ?></button>
	    <a href="<?php echo site_url('formulir') ?>" class="btn btn-default">Cancel</a>
	</div>
</form>
</div><div class="col-md-4"><h3>panduan</h3><hr /></div>
</div>
