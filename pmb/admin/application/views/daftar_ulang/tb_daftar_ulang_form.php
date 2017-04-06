
<?php $uri = $this->uri->segment(2); ?>
<div class="col-md-12">
  <div class="widget-title"> <span class="icon"><i class="icon-th"></i></span>
    <h5><h1 class="page-header"><?php echo $title ?></h1></h5>
  </div>
  <div class="col-md-8">

  <form action="<?php echo $action; ?>" method="post" class="form-horizontal">
	    <div class="form-group">
            <label class="form-label" for="varchar">Kode Daftar Ulang <?php echo form_error('kode_daftar_ulang') ?></label>
            <input type="text" class="form-control" name="kode_daftar_ulang" id="kode_daftar_ulang" placeholder="Kode Daftar Ulang" value="<?php echo $kode_daftar_ulang; ?>" />
        </div>
<?php
                if($uri == 'create'){
                  ?>
	<div class="form-group">
                          <label class="form-label" for="kode_ujian">Kode Ujian <?php echo form_error('kode_ujian') ?></label>
                          <select class="form-control" rows="3" name="kode_ujian" id="kode_ujian" value="<?php echo $kode_ujian ?>"><?php echo $kode_ujian; ?>
                            <option value=""> Mohon Pilih Salah Satu</option>
                            <?php
                            foreach($tb_peserta_ujian as $key){
                              ?>
                              <option value="<?php echo $key->kode_ujian ?>"><?php echo $key->kode_ujian ?></option>
                              <?php
                            }
                            ?>
                          </select>
                      </div>  <?php
                }
                else{
                  ?>
	    <div class="form-group">
                          <label class="form-label" for="varchar">Kode Ujian <?php echo form_error('kode_ujian') ?></label>
                          <input type="text" class="form-control" name="kode_ujian" id="kode_ujian" placeholder="Kode Ujian" value="<?php echo $kode_ujian; ?>" />
                      </div>  <?php
                }
                ?>
	    <div class="form-group">
            <label class="form-label" for="int">C Nim <?php echo form_error('c_nim') ?></label>
            <input type="text" class="form-control" name="c_nim" id="c_nim" placeholder="C Nim" value="<?php echo $c_nim; ?>" />
        </div>
	    <div class="form-group">
            <label class="form-label" for="varchar">No Telp <?php echo form_error('no_telp') ?></label>
            <input type="text" class="form-control" name="no_telp" id="no_telp" placeholder="No Telp" value="<?php echo $no_telp; ?>" />
        </div>
<?php
                if($uri == 'create'){
                  ?>
	<div class="form-group">
                          <label class="form-label" for="kode_ayah">Kode Ayah <?php echo form_error('kode_ayah') ?></label>
                          <select class="form-control" rows="3" name="kode_ayah" id="kode_ayah" value="<?php echo $kode_ayah ?>"><?php echo $kode_ayah; ?>
                            <option value=""> Mohon Pilih Salah Satu</option>
                            <?php
                            foreach($tb_ayah as $key){
                              ?>
                              <option value="<?php echo $key->kode_ayah ?>"><?php echo $key->kode_ayah ?></option>
                              <?php
                            }
                            ?>
                          </select>
                      </div>  <?php
                }
                else{
                  ?>
	    <div class="form-group">
                          <label class="form-label" for="varchar">Kode Ayah <?php echo form_error('kode_ayah') ?></label>
                          <input type="text" class="form-control" name="kode_ayah" id="kode_ayah" placeholder="Kode Ayah" value="<?php echo $kode_ayah; ?>" />
                      </div>  <?php
                }
                ?>
<?php
                if($uri == 'create'){
                  ?>
	<div class="form-group">
                          <label class="form-label" for="kode_ibu">Kode Ibu <?php echo form_error('kode_ibu') ?></label>
                          <select class="form-control" rows="3" name="kode_ibu" id="kode_ibu" value="<?php echo $kode_ibu ?>"><?php echo $kode_ibu; ?>
                            <option value=""> Mohon Pilih Salah Satu</option>
                            <?php
                            foreach($tb_ibu as $key){
                              ?>
                              <option value="<?php echo $key->kode_ibu ?>"><?php echo $key->kode_ibu ?></option>
                              <?php
                            }
                            ?>
                          </select>
                      </div>  <?php
                }
                else{
                  ?>
	    <div class="form-group">
                          <label class="form-label" for="varchar">Kode Ibu <?php echo form_error('kode_ibu') ?></label>
                          <input type="text" class="form-control" name="kode_ibu" id="kode_ibu" placeholder="Kode Ibu" value="<?php echo $kode_ibu; ?>" />
                      </div>  <?php
                }
                ?>
	    <div class="form-group">
            <label class="form-label" for="datetime">Tgl Masuk <?php echo form_error('tgl_masuk') ?></label>
            <input type="text" class="form-control" name="tgl_masuk" id="tgl_masuk" placeholder="Tgl Masuk" value="<?php echo $tgl_masuk; ?>" />
        </div>
<?php
                if($uri == 'create'){
                  ?>
	<div class="form-group">
                          <label class="form-label" for="kode_wilayah">Kode Wilayah <?php echo form_error('kode_wilayah') ?></label>
                          <select class="form-control" rows="3" name="kode_wilayah" id="kode_wilayah" value="<?php echo $kode_wilayah ?>"><?php echo $kode_wilayah; ?>
                            <option value=""> Mohon Pilih Salah Satu</option>
                            <?php
                            foreach($tb_wilayah as $key){
                              ?>
                              <option value="<?php echo $key->kode_wilayah ?>"><?php echo $key->kode_wilayah ?></option>
                              <?php
                            }
                            ?>
                          </select>
                      </div>  <?php
                }
                else{
                  ?>
	    <div class="form-group">
                          <label class="form-label" for="varchar">Kode Wilayah <?php echo form_error('kode_wilayah') ?></label>
                          <input type="text" class="form-control" name="kode_wilayah" id="kode_wilayah" placeholder="Kode Wilayah" value="<?php echo $kode_wilayah; ?>" />
                      </div>  <?php
                }
                ?>
<?php
                if($uri == 'create'){
                  ?>
	<div class="form-group">
                          <label class="form-label" for="kode_status_awal">Kode Status Awal <?php echo form_error('kode_status_awal') ?></label>
                          <select class="form-control" rows="3" name="kode_status_awal" id="kode_status_awal" value="<?php echo $kode_status_awal ?>"><?php echo $kode_status_awal; ?>
                            <option value=""> Mohon Pilih Salah Satu</option>
                            <?php
                            foreach($tb_status_awal as $key){
                              ?>
                              <option value="<?php echo $key->kode_status_awal ?>"><?php echo $key->kode_status_awal ?></option>
                              <?php
                            }
                            ?>
                          </select>
                      </div>  <?php
                }
                else{
                  ?>
	    <div class="form-group">
                          <label class="form-label" for="varchar">Kode Status Awal <?php echo form_error('kode_status_awal') ?></label>
                          <input type="text" class="form-control" name="kode_status_awal" id="kode_status_awal" placeholder="Kode Status Awal" value="<?php echo $kode_status_awal; ?>" />
                      </div>  <?php
                }
                ?>
<?php
                if($uri == 'create'){
                  ?>
	<div class="form-group">
                          <label class="form-label" for="kode_status_mhs">Kode Status Mhs <?php echo form_error('kode_status_mhs') ?></label>
                          <select class="form-control" rows="3" name="kode_status_mhs" id="kode_status_mhs" value="<?php echo $kode_status_mhs ?>"><?php echo $kode_status_mhs; ?>
                            <option value=""> Mohon Pilih Salah Satu</option>
                            <?php
                            foreach($tb_status_mhs as $key){
                              ?>
                              <option value="<?php echo $key->kode_status_mhs ?>"><?php echo $key->kode_status_mhs ?></option>
                              <?php
                            }
                            ?>
                          </select>
                      </div>  <?php
                }
                else{
                  ?>
	    <div class="form-group">
                          <label class="form-label" for="varchar">Kode Status Mhs <?php echo form_error('kode_status_mhs') ?></label>
                          <input type="text" class="form-control" name="kode_status_mhs" id="kode_status_mhs" placeholder="Kode Status Mhs" value="<?php echo $kode_status_mhs; ?>" />
                      </div>  <?php
                }
                ?>
	    <div class="form-group">
            <label class="form-label" for="int">File Ijasah <?php echo form_error('file_ijasah') ?></label>
            <input type="text" class="form-control" name="file_ijasah" id="file_ijasah" placeholder="File Ijasah" value="<?php echo $file_ijasah; ?>" />
        </div>
	    <div class="form-actions"><input type="hidden" name="id_daftar_ulang" value="<?php echo $id_daftar_ulang; ?>" /> 
	    <button type="submit" class="btn btn-primary"><?php echo $button ?></button> 
	    <a href="<?php echo site_url('daftar_ulang') ?>" class="btn btn-default">Cancel</a>
	</div>
</form>
</div><div class="col-md-4"><h3>panduan</h3><hr /></div>
</div>