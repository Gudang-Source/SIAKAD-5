<?php
  $picu = $this->uri->segment(2);
 ?>
<div class="container-fluid">
  <div class="page-header" style="margin-top: 50px;">
    <div class="row">
      <div class="col-md-12">
        <h3><?php echo $title_page; ?></h3>
      </div>
    </div>
  </div>
  <div class="row">
    <div class="col-md-12">
      <form action="<?php echo $action; ?>" method="post" role="form">
        <div class="form-group">
          <label for="int">Id Mhs Trans <?php echo form_error('id_mhs_trans') ?></label>
          <?php if ($picu=="create"): ?>
            <select class="form-control select2" name="id_mhs_trans" id="id_mhs_trans"></select>
          <?php else: ?>
            <input type="text" class="form-control" name="id_mhs_trans" id="id_mhs_trans" placeholder="Id Mhs Trans" value="<?php echo $id_mhs_trans; ?>" />
          <?php endif; ?>
        </div>
        <div class="form-group">
          <label for="varchar">Id Mk <?php echo form_error('id_mk') ?></label>
          <?php if ($picu=="create"): ?>
            <select class="form-control" name="id_mk" id="id_mk"></select>
          <?php else: ?>
            <input type="text" class="form-control" name="id_mk" id="id_mk" placeholder="Id Mk" value="<?php echo $id_mk; ?>" />
          <?php endif; ?>
        </div>
        <div class="form-group">
            <label for="varchar">Kode Mk Asal <?php echo form_error('kode_mk_asal') ?></label>
            <input type="text" class="form-control" name="kode_mk_asal" id="kode_mk_asal" placeholder="Kode Mk Asal" value="<?php echo $kode_mk_asal; ?>" />
        </div>
        <div class="form-group">
            <label for="nm_mk_asal">Nm Mk Asal <?php echo form_error('nm_mk_asal') ?></label>
            <textarea class="form-control" rows="3" name="nm_mk_asal" id="nm_mk_asal" placeholder="Nm Mk Asal"><?php echo $nm_mk_asal; ?></textarea>
        </div>
        <div class="form-group">
            <label for="int">Sks Asal <?php echo form_error('sks_asal') ?></label>
            <input type="text" class="form-control" name="sks_asal" id="sks_asal" placeholder="Sks Asal" value="<?php echo $sks_asal; ?>" />
        </div>
        <div class="form-group">
            <label for="int">Sks Diakui <?php echo form_error('sks_diakui') ?></label>
            <input type="text" class="form-control" name="sks_diakui" id="sks_diakui" placeholder="Sks Diakui" value="<?php echo $sks_diakui; ?>" />
        </div>
        <div class="form-group">
            <label for="varchar">Nilai Huruf Asal <?php echo form_error('nilai_huruf_asal') ?></label>
            <input type="text" class="form-control" name="nilai_huruf_asal" id="nilai_huruf_asal" placeholder="Nilai Huruf Asal" value="<?php echo $nilai_huruf_asal; ?>" />
        </div>
        <div class="form-group">
            <label for="varchar">Nilai Huruf Diakui <?php echo form_error('nilai_huruf_diakui') ?></label>
            <input type="text" class="form-control" name="nilai_huruf_diakui" id="nilai_huruf_diakui" placeholder="Nilai Huruf Diakui" value="<?php echo $nilai_huruf_diakui; ?>" />
        </div>
        <div class="form-group">
            <label for="int">Nilai Angka Diakui <?php echo form_error('nilai_angka_diakui') ?></label>
            <input type="text" class="form-control" name="nilai_angka_diakui" id="nilai_angka_diakui" placeholder="Nilai Angka Diakui" value="<?php echo $nilai_angka_diakui; ?>" />
        </div>
        <input type="hidden" name="id_nilai_trans" value="<?php echo $id_nilai_trans; ?>" />
        <button type="submit" class="btn btn-primary"><?php echo $button ?></button>
        <a href="<?php echo site_url('nilai_trans') ?>" class="btn btn-default">Cancel</a>
      </form>
    </div>
  </div>
</div>
