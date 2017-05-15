<?php $uri = $this->uri->segment(2); ?>
<div class="col-md-12">
  <div class="widget-title"> <span class="icon"><i class="icon-th"></i></span>
    <h5><h1 class="page-header"><?php echo $title ?></h1></h5>
  </div>
  <div class="col-md-8">

  <form action="<?php echo $action; ?>" method="post" class="form-horizontal">
	    <div class="form-group">
            <label class="form-label" for="varchar">Kode Daftar Ulang <?php echo form_error('kode_daftar_ulang') ?></label>
            <input type="text" class="form-control" name="kode_daftar_ulang" id="kode_daftar_ulang" placeholder="Kode Daftar Ulang" value="<?php echo $kode_daftar_ulang; ?>" readonly required/>
        </div>
	    <div class="form-group">
            <label class="form-label" for="varchar">Kode Ujian <?php echo form_error('kode_ujian') ?></label>
            <input type="text" class="form-control" name="kode_ujian" id="kode_ujian" placeholder="Kode Ujian" value="<?php echo $kode_ujian; ?>" readonly required/>
        </div>
	    <div class="form-group">
            <label class="form-label" for="int">C Nim <?php echo form_error('c_nim') ?></label>
            <input type="text" class="form-control" name="c_nim" id="c_nim" placeholder="C Nim" value="<?php echo $c_nim; ?>" readonly required/>
        </div>
	    <div class="form-group">
            <label class="form-label" for="varchar">No Telp <?php echo form_error('no_telp') ?></label>
            <input type="text" class="form-control" name="no_telp" id="no_telp" placeholder="No Telp" value="<?php echo $no_telp; ?>" required/>
        </div>
      <?php
      if($kode_ayah == ''){
      ?>
      <div class="form-group">
        <label class="form-label" for="varchar">Kode Ayah <?php echo form_error('kode_ayah') ?></label>
        <div class="input-group">
					<input type="text" class="form-control" name="kode_ayah" id="kode_ayah" placeholder="Kode Ayah" value="" readonly="" required/>
					<span class="input-group-btn">
						<a class="btn btn-primary btn-md" id="btnAddAyah">Add</a>
					</span>
				</div>
      </div>
      <?php
      }
      else{
      ?>
      <div class="form-group">
        <label class="form-label" for="varchar">Kode Ayah <?php echo form_error('kode_ayah') ?></label>
        <div class="input-group">
          <input type="text" class="form-control" name="kode_ayah" id="kode_ayah" placeholder="Kode Ayah" value="<?php echo $kode_ayah; ?>" readonly required/>
          <span class="input-group-btn">
            <a class="btn btn-primary btn-md" id="btnSearchAyah">Search</a>
          </span>
        </div>
      </div>
      <?php
      }
      ?>

      <?php
      if($kode_ibu == ""){
      ?>
      <div class="form-group">
        <label class="form-label" for="varchar">Kode Ibu <?php echo form_error('kode_ibu') ?></label>
        <div class="input-group">
					<input type="text" class="form-control" name="kode_ibu" id="kode_ibu" placeholder="Kode Ibu" value="" readonly required/>
					<span class="input-group-btn">
						<a class="btn btn-primary btn-md" id="btnAddIbu">Add</a>
					</span>
				</div>
      </div>
      <?php
      }
      else{
      ?>
      <div class="form-group">
        <label class="form-label" for="varchar">Kode Ibu <?php echo form_error('kode_ibu') ?></label>
        <div class="input-group">
          <input type="text" class="form-control" name="kode_ibu" id="kode_ibu" placeholder="Kode Ibu" value="<?php echo $kode_ibu; ?>" readonly required/>
          <span class="input-group-btn">
            <a class="btn btn-primary btn-md" id="btnSearchIbu">Search</a>
          </span>
        </div>
      </div>
      <?php
      }
      ?>
      <!-- <div class="form-group">
        <label class="form-label" for="datetime">Tgl Masuk <?php echo form_error('tgl_masuk') ?></label>
        <input type="text" class="form-control" name="tgl_masuk" id="tgl_masuk" placeholder="Tgl Masuk" value="<?php echo $tgl_masuk; ?>" />
      </div> -->
      <?php
      if($uri != 'update'){
      ?>
      <div class="form-group">
        <label class="form-label" for="kode_wilayah">Kode Wilayah <?php echo form_error('kode_wilayah') ?></label>
        <select class="form-control" rows="3" name="kode_wilayah" id="kode_wilayah" value="<?php echo $kode_wilayah ?>" required>
          <option value=""> Mohon Pilih Salah Satu</option>
          <?php
          foreach($tb_wilayah as $key){
            ?>
            <option value="<?php echo $key->kode_wilayah ?>"><?php echo $key->kode_wilayah ?> | <?php echo $key->nm_wilayah ?></option>
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
      if($uri != 'update'){
      ?>
      <div class="form-group">
        <label class="form-label" for="kode_status_awal">Kode Status Awal <?php echo form_error('kode_status_awal') ?></label>
        <select class="form-control" rows="3" name="kode_status_awal" id="kode_status_awal" value="<?php echo $kode_status_awal ?>"><?php echo $kode_status_awal; ?>
          <option value=""> Mohon Pilih Salah Satu</option>
          <?php
          foreach($tb_status_awal as $key){
            ?>
            <option value="<?php echo $key->kode_status_awal ?>"><?php echo $key->kode_status_awal ?> | <?php echo $key->nm_status_awal ?></option>
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
      <!-- <div class="form-group">
        <label class="form-label" for="int">File Ijasah <?php echo form_error('file_ijasah') ?></label>
        <input type="text" class="form-control" name="file_ijasah" id="file_ijasah" placeholder="File Ijasah" value="<?php echo $file_ijasah; ?>" />
      </div> -->
      <div class="form-actions"><input type="hidden" name="id_daftar_ulang" value="<?php echo $id_daftar_ulang; ?>" />
        <button type="submit" class="btn btn-success"><?php echo $button ?></button>
      </div>
</form>
</div><div class="col-md-4"><h3>panduan</h3><hr /></div>
</div>

<div class="modal fade" id="addAyah" data-backdrop="static" data-keyboard="false" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">

				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">
					×
				</button>
				<h4 class="modal-title" id="myModalLabel">
					Masukan Data Ayah Anda
				</h4>
			</div>
			<div class="modal-body">
				<form role="form" class="" action="<?php echo site_url("daftar_ulang/create_ayah") ?>" method="post" class="form-horizontal" id="formAyah">
          <div class="form-group">
						<label class="control-label" for="name">Kode Mahasiswa</label>
						<input name="kode_cmhs_1" id="kode_cmhs_1" type="text" class="form-control" class="form-control" value="<?php echo $kode_cmhs ?>" required="" readonly>
					</div>
          <div class="form-group">
						<label class="control-label" for="name">Nama Ayah</label>
						<input name="nm_ayah" type="text" class="form-control" placeholder="Nama Ayah" class="form-control" required="">
					</div>
          <div class="form-group">
            <label class="form-label" for="varchar">Kode Ayah</label>
            <div class="input-group">
    					<input type="text" class="form-control" name="kode_ayah_1" id="kode_ayah_1" value="" required readonly/>
    					<span class="input-group-btn">
    						<a class="btn btn-primary btn-md" id="btnSearchAyah1">Search</a>
    					</span>
    				</div>
          </div>
          <div class="form-group">
            <label class="control-label">Pekerjaan</label>
            <select class="form-control" name="kode_peker_ayah" required>
              <option value="">------- Pilih Salah Satu -------</option>
              <?php foreach ($tb_pekerjaan as $key): ?>
                <option value="<?php echo $key->kode_pekerjaan ?>"><?php echo $key->kode_pekerjaan ?> | <?php echo $key->nm_pekerjaan ?></option>
              <?php endforeach; ?>
            </select>
          </div>

          <div class="form-group">
            <label class="control-label">Penghasilan</label>
            <select class="form-control" name="kode_penghasilan_ayah" required>
              <option value="">------- Pilih Salah Satu -------</option>
              <?php foreach ($tb_penghasilan as $key): ?>
                <option value="<?php echo $key->kode_penghasilan ?>"><?php echo $key->kode_penghasilan ?> | <?php echo $key->penghasilan ?></option>
              <?php endforeach; ?>
            </select>
          </div>

          <div class="form-group">
						<label class="control-label" for="name">Tempat Lahir</label>
						<input name="tpt_lhr_ayah" type="text" class="form-control" class="form-control" required="">
					</div>

          <div class="form-group">
						<label class="control-label" for="name">Tanggal Lahir</label>
						<input id="name" name="tgl_lahir_ayah" type="text" class="form-control datepicker" class="form-control" required="">
					</div>
          <div class="form-group">
            <button id="unggahAyah" class="btn btn-success btn-block" type="submit">Save</button>
          </div>
				</form>
			</div>
		</div>

	</div>
</div>

<div class="modal fade" id="addIbu" data-backdrop="static" data-keyboard="false" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">

				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">
					×
				</button>
				<h4 class="modal-title" id="myModalLabel">
					Masukan Data Ibu Anda
				</h4>
			</div>
			<div class="modal-body">
        <form role="form" id="formIbu" class="form" action="<?php echo site_url("daftar_ulang/create_ibu") ?>" method="post" class="form">
          <div class="form-group">
						<label class="control-label" for="name">Kode Mahasiswa</label>
						<input name="kode_cmhs_2" id="kode_cmhs_2" type="text" class="form-control" class="form-control" value="<?php echo $kode_cmhs ?>" required="" readonly>
					</div>
          <div class="form-group">
						<label class="control-label" for="name">Nama Ibu</label>
						<input name="nm_ibu" type="text" class="form-control" placeholder="Nama ibu" class="form-control" required="">
					</div>
          <div class="form-group">
            <label class="form-label" for="varchar">Kode Ibu</label>
            <div class="input-group">
    					<input type="text" class="form-control" name="kode_ibu_1" id="kode_ibu_1" value="" readonly required/>
    					<span class="input-group-btn">
    						<a class="btn btn-primary btn-md" id="btnSearchIbu1">Search</a>
    					</span>
    				</div>
          </div>
          <div class="form-group">
            <label class="control-label">Pekerjaan</label>
            <select class="form-control" name="kode_peker_ibu" required>
              <option value="">------- Pilih Salah Satu -------</option>
              <?php foreach ($tb_pekerjaan as $key): ?>
                <option value="<?php echo $key->kode_pekerjaan ?>"><?php echo $key->kode_pekerjaan ?> | <?php echo $key->nm_pekerjaan ?></option>
              <?php endforeach; ?>
            </select>
          </div>

          <div class="form-group">
            <label class="control-label">Penghasilan</label>
            <select class="form-control" name="kode_penghasilan_ibu" required>
              <option value="">------- Pilih Salah Satu -------</option>
              <?php foreach ($tb_penghasilan as $key): ?>
                <option value="<?php echo $key->kode_penghasilan ?>"><?php echo $key->kode_penghasilan ?> | <?php echo $key->penghasilan ?></option>
              <?php endforeach; ?>
            </select>
          </div>

          <div class="form-group">
						<label class="control-label" for="name">Tempat Lahir</label>
						<input name="tpt_lhr_ibu" type="text" class="form-control" class="form-control" required="">
					</div>

          <div class="form-group">
						<label class="control-label" for="name">Tanggal Lahir</label>
						<input id="name" name="tgl_lahir_ibu" type="text" class="form-control datepicker" class="form-control" required="">
					</div>

          <div class="form-group">
            <button type="submit" id="unggahIbu" class="btn btn-success btn-block">Save</button>
          </div>
				</form>
			</div>
			<!-- <div class="modal-footer">

				<button type="button" class="btn btn-default" data-dismiss="modal">
					Close
				</button>

			</div> -->
		</div>

	</div>
</div>
