
<?php $uri = $this->uri->segment(2); ?>
<div class="col-md-12">
  <div class="widget-title"> <span class="icon"><i class="icon-th"></i></span>
    <h5><h1 class="page-header"><?php echo $title ?></h1></h5>
  </div>
  <div class="col-md-8">

  <form action="<?php echo $action; ?>" method="post" class="form-horizontal">
	    <div class="form-group">
            <label class="form-label" for="varchar">Kode Cmhs <?php echo form_error('kode_cmhs') ?></label>
            <input type="text" class="form-control" name="kode_cmhs" id="kode_cmhs" placeholder="Kode Cmhs" value="<?php echo $kode_cmhs; ?>" />
        </div>
<?php
                if($uri == 'create'){
                  ?>
	<div class="form-group">
                          <label class="form-label" for="kode_formulir">Kode Formulir <?php echo form_error('kode_formulir') ?></label>
                          <select class="form-control" rows="3" name="kode_formulir" id="kode_formulir" value="<?php echo $kode_formulir ?>"><?php echo $kode_formulir; ?>
                            <option value=""> Mohon Pilih Salah Satu</option>
                            <?php
                            foreach($tb_formulir as $key){
                              ?>
                              <option value="<?php echo $key->kode_formulir ?>"><?php echo $key->kode_formulir ?></option>
                              <?php
                            }
                            ?>
                          </select>
                      </div>  <?php
                }
                else{
                  ?>
	    <div class="form-group">
                          <label class="form-label" for="varchar">Kode Formulir <?php echo form_error('kode_formulir') ?></label>
                          <input type="text" class="form-control" name="kode_formulir" id="kode_formulir" placeholder="Kode Formulir" value="<?php echo $kode_formulir; ?>" />
                      </div>  <?php
                }
                ?>
	    <div class="form-group">
            <label class="form-label" for="varchar">No Ktp <?php echo form_error('no_ktp') ?></label>
            <input type="text" class="form-control" name="no_ktp" id="no_ktp" placeholder="No Ktp" value="<?php echo $no_ktp; ?>" />
        </div>
<?php
                if($uri == 'create'){
                  ?>
	<div class="form-group">
                          <label class="form-label" for="kode_agama">Kode Agama <?php echo form_error('kode_agama') ?></label>
                          <select class="form-control" rows="3" name="kode_agama" id="kode_agama" value="<?php echo $kode_agama ?>"><?php echo $kode_agama; ?>
                            <option value=""> Mohon Pilih Salah Satu</option>
                            <?php
                            foreach($tb_agama as $key){
                              ?>
                              <option value="<?php echo $key->kode_agama ?>"><?php echo $key->kode_agama ?></option>
                              <?php
                            }
                            ?>
                          </select>
                      </div>  <?php
                }
                else{
                  ?>
	    <div class="form-group">
                          <label class="form-label" for="varchar">Kode Agama <?php echo form_error('kode_agama') ?></label>
                          <input type="text" class="form-control" name="kode_agama" id="kode_agama" placeholder="Kode Agama" value="<?php echo $kode_agama; ?>" />
                      </div>  <?php
                }
                ?>
	<div class="form-group">
            <label class="form-label" for="tpt_lhr">Tpt Lhr <?php echo form_error('tpt_lhr') ?></label>
            <textarea class="form-control" rows="3" name="tpt_lhr" id="tpt_lhr" placeholder="Tpt Lhr"><?php echo $tpt_lhr; ?></textarea>
        </div>
	    <div class="form-group">
            <label class="form-label" for="date">Tgl Lhr <?php echo form_error('tgl_lhr') ?></label>
            <input type="text" class="form-control" name="tgl_lhr" id="tgl_lhr" placeholder="Tgl Lhr" value="<?php echo $tgl_lhr; ?>" />
        </div>
	<div class="form-group">
              <label class="form-label" for="jenkel">Jenkel <?php echo form_error('jenkel') ?></label>
              <select class="form-control" rows="3" name="jenkel" id="jenkel"><?php echo $jenkel; ?>
                <option value=""> Mohon Pilih Salah Satu</option> <!-- tolong edit -->
                <option value="Y">Ya</option>
                <option value="N">No</option>
                </select>
          </div>
	<div class="form-group">
            <label class="form-label" for="alamat">Alamat <?php echo form_error('alamat') ?></label>
            <textarea class="form-control" rows="3" name="alamat" id="alamat" placeholder="Alamat"><?php echo $alamat; ?></textarea>
        </div>
	<div class="form-group">
            <label class="form-label" for="asal_sekolah">Asal Sekolah <?php echo form_error('asal_sekolah') ?></label>
            <textarea class="form-control" rows="3" name="asal_sekolah" id="asal_sekolah" placeholder="Asal Sekolah"><?php echo $asal_sekolah; ?></textarea>
        </div>
	<div class="form-group">
            <label class="form-label" for="email">Email <?php echo form_error('email') ?></label>
            <textarea class="form-control" rows="3" name="email" id="email" placeholder="Email"><?php echo $email; ?></textarea>
        </div>
<?php
                if($uri == 'create'){
                  ?>
	<div class="form-group">
                          <label class="form-label" for="kode_prodi">Kode Prodi <?php echo form_error('kode_prodi') ?></label>
                          <select class="form-control" rows="3" name="kode_prodi" id="kode_prodi" value="<?php echo $kode_prodi ?>"><?php echo $kode_prodi; ?>
                            <option value=""> Mohon Pilih Salah Satu</option>
                            <?php
                            foreach($tb_prodi as $key){
                              ?>
                              <option value="<?php echo $key->kode_prodi ?>"><?php echo $key->kode_prodi ?></option>
                              <?php
                            }
                            ?>
                          </select>
                      </div>  <?php
                }
                else{
                  ?>
	    <div class="form-group">
                          <label class="form-label" for="int">Kode Prodi <?php echo form_error('kode_prodi') ?></label>
                          <input type="text" class="form-control" name="kode_prodi" id="kode_prodi" placeholder="Kode Prodi" value="<?php echo $kode_prodi; ?>"/>
                      </div>  <?php
                }
                ?>
	    <div class="form-group">
            <label class="form-label" for="varchar">File Foto <?php echo form_error('file_foto') ?></label>
            <input type="text" class="form-control" name="file_foto" id="file_foto" placeholder="File Foto" value="<?php echo $file_foto; ?>" />
        </div>
	<div class="form-group">
              <label class="form-label" for="status_ujian">Status Ujian <?php echo form_error('status_ujian') ?></label>
              <select class="form-control" rows="3" name="status_ujian" id="status_ujian"><?php echo $status_ujian; ?>
                <option value=""> Mohon Pilih Salah Satu</option> <!-- tolong edit -->
                <option value="Y">Ya</option>
                <option value="N">No</option>
                </select>
          </div>
	    <div class="form-actions"><input type="hidden" name="id_mhs" value="<?php echo $id_mhs; ?>" /> 
	    <button type="submit" class="btn btn-primary"><?php echo $button ?></button> 
	    <a href="<?php echo site_url('cmhs') ?>" class="btn btn-default">Cancel</a>
	</div>
</form>
</div><div class="col-md-4"><h3>panduan</h3><hr /></div>
</div>