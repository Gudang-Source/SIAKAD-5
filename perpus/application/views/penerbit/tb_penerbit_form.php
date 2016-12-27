<div class="row">
  <div class="col-md-10">
    <form action="<?php echo $action; ?>" method="post">
      <div class="form-group">
            <label for="varchar">Nm Penerbit <?php echo form_error('nm_penerbit') ?></label>
            <input type="text" class="form-control" name="nm_penerbit" id="nm_penerbit" placeholder="Nm Penerbit" value="<?php echo $nm_penerbit; ?>" />
        </div>
      <div class="form-group">
            <label for="alamat">Alamat <?php echo form_error('alamat') ?></label>
            <textarea class="form-control" rows="3" name="alamat" id="alamat" placeholder="Alamat"><?php echo $alamat; ?></textarea>
        </div>
      <input type="hidden" name="id_penerbit" value="<?php echo $id_penerbit; ?>" />
      <button type="submit" class="btn btn-primary"><?php echo $button ?></button>
      <a href="<?php echo site_url('penerbit') ?>" class="btn btn-default">Cancel</a>
    </form>
  </div>
  <div class="col-md-2">
    <h3>Panduan</h3>
    <p>
      Tes
    </p>
  </div>
</div>
