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
      <form action="<?php echo $action; ?>" method="post">
        <div class="form-group">
          <label for="int">Id Krs <?php echo form_error('id_krs') ?></label>
          <select type="text" class="form-control" name="id_krs" id="id_krs"> </select>
        </div>
        <div class="form-group">
          <label for="int">Nilai Angka <?php echo form_error('nilai_angka') ?></label>
          <input type="text" class="form-control select2" name="nilai_angka" id="nilai_angka" placeholder="Nilai Angka" value="<?php echo $nilai_angka; ?>" />
        </div>
        <div class="form-group">
          <label for="enum">Nilai Index <?php echo form_error('nilai_index') ?></label>
          <select type="text" class="form-control" name="nilai_index" id="nilai_index" required>
            <option value="">---------------------</option>
            <option value="4">A</option>
            <option value="3.75">A-</option>
            <option value="3.5">B+</option>
            <option value="3.0">B</option>
            <option value="2.75">B-</option>
            <option value="2.5">C+</option>
            <option value="2.0">C</option>
            <option value="1.75">C-</option>
            <option value="1.0">D</option>
            <option value="0">E</option>
            <option value="0">TUNDA</option>
          </select>
        </div>
        <div class="form-group">
          <!-- <label for="varchar">Nilai Huruf <?php echo form_error('nilai_huruf') ?></label>
          <input type="text" class="form-control" name="nilai_huruf" id="nilai_huruf" placeholder="Nilai Huruf" value="<?php echo $nilai_huruf; ?>" /> -->
          <select type="text" class="form-control" name="nilai_huruf" id="nilai_huruf" required>
            <option value="">---------------------</option>
            <option value="A">A</option>
            <option value="A-">A-</option>
            <option value="B+">B+</option>
            <option value="B">B</option>
            <option value="B-">B-</option>
            <option value="C+">C+</option>
            <option value="C">C</option>
            <option value="C-">C-</option>
            <option value="D">D</option>
            <option value="E">E</option>
            <option value="T">TUNDA</option>
          </select>
        </div>
        <input type="hidden" name="id_nilai" value="<?php echo $id_nilai; ?>" />
        <button type="submit" class="btn btn-primary"><?php echo $button ?></button>
        <a href="<?php echo site_url('nilai') ?>" class="btn btn-default">Cancel</a>
       </form>
    </div>
  </div>
</div>
