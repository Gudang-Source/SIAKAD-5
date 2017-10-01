<div class="container-fluid">
  <div class="page-header" style="margin-top: 50px;">
    <div class="row" style="margin-bottom: 10px">
        <div class="col-md-8">
            <h3><?php echo $title_page; ?></h3>
        </div>
        <div class="col-md-4 text-right">
          <form class="" action="" method="post">
          </form>
          <?php echo form_error('nilai_angka') ?>
          <!-- <?php echo form_error('nilai_index') ?>
          <?php echo form_error('nilai_huruf') ?> -->
        </div>
    </div>
  </div>
  <div class="row">
    <strong>Keterangan : </strong><hr>
    <div class="col-md-4">
      <table class="table table-striped">
        <tbody>
          <tr>
            <td>Nama Kelas : </td>
            <td><?php echo $data_kelas->nm_kelas ?></td>
          </tr>
          <tr>
            <td>Mata Kuliah : </td>
            <td><?php echo $data_kelas->nm_mk ?></td>
          </tr>
          <tr>
            <td>Nama Dosen : </td>
            <td><?php echo $data_kelas->nm_dosen ?></td>
          </tr>
          <tr>
            <td>Periode : </td>
            <td><?php echo $data_kelas->ta ?></td>
          </tr>
          <tr>
            <td>Jurusan : </td>
            <td><?php echo $data_kelas->nm_prodi ?></td>
          </tr>
        </tbody>
      </table>
    </div>
    <div class="col-md-8">
      <p><?php echo $this->session->userdata('message') <> '' ? $this->session->userdata('message') : ''; ?></p>
    </div>
  </div>
  <div class="row">
    <strong>Masukan Data Nilai </strong><hr>
    <div class="col-md-12">
      <form action="<?php echo site_url('kelas_dosen/new_add') ?>" method="post">
        <div class="form-group">
          <input id="" type="text" class="form-control input-sm hide" placeholder="" name="id_kelas" id="" value="<?php echo $id_kelas ?>" readonly>
        </div>
        <table class="table table-bordered table-striped" id="krsIsiTabelNilai">
            <thead>
                <tr>
                  <th width="40px">No</th>
                  <th width="100px">NIM</th>
                  <th>Nama Mahasiswa</th>
                  <th>Komplain</th>
                  <!-- <th>Nama Mata Kuliah</th> -->
                  <!-- <th>Nama Kelas</th> -->
                  <th>Periode</th>
                  <!-- <th>Kode Prodi</th> -->
                  <!-- <th>Nama Prodi</th> -->
                  <th>Nilai : Angka|Index</th>
                </tr>
            </thead>
            <tbody>
            <?php
            $start = 0;
            foreach ($data_krs as $key)
            {
                ?>
                <tr>
                  <td><?php echo ++$start ?></td>
                  <td><?php echo $key->nim ?></td>
                  <td><?php echo $key->nm_mhs ?></td>

                  <td>
                    <?php if ($key->status_komplain=='Y'): ?>
                      <span class="label label-danger"> Telah Dikomplain</span>
                    <?php else: ?>
                      <span class="label label-success"> Belum Ada Komplain</span>
                    <?php endif; ?>
                  </td>
                  <!-- <td><?php echo $key->nm_mk ?></td> -->
                  <!-- <td><?php echo $key->nm_kelas ?></td> -->
                  <td><?php echo $key->ta ?></td>
                  <!-- <td><?php echo $key->id_prodi ?></td> -->
                  <!-- <td><?php echo $key->nm_prodi ?></td> -->
                  <td style="text-align:center" width="300px">
                    <?php
                      if ($key->status_nilai=="N") {
                        ?>
                        <div class="form-group">
                          <div class="col-md-6">
                            <input type="text" class="form-control input-sm" placeholder="" name="nilai_angka[]" id="">
                            <input id="" type="text" class="form-control input-sm hide" placeholder="" name="id_data_krs[]" id="" value="<?php echo $key->id_data_krs ?>" readonly>
                          </div>
                          <div class="col-md-6">
                            <select class="form-control input-sm" name="nilai_index[]">
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
                              <option value="-1">TUNDA</option>
                            </select>
                          </div>
                        </div>
                        <?php
                      }
                      elseif ($key->status_komplain=='Y' AND $key->status_nilai=="Y") {
                        ?>
                        <div class="form-group">
                          <div class="col-md-6">
                            <input type="text" class="form-control input-sm" placeholder="" name="nilai_angka[]" id="">
                            <input id="" type="text" class="form-control input-sm hide" placeholder="" name="id_data_krs[]" id="" value="<?php echo $key->id_data_krs ?>" readonly>
                          </div>
                          <div class="col-md-6">
                            <select class="form-control input-sm" name="nilai_index[]">
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
                              <option value="-1">TUNDA</option>
                            </select>
                          </div>
                        </div>
                        <?php
                      }

                      else {
                        ?>
                          <a href="<?php echo site_url('kelas_dosen/cetak_bap_edit/'.$key->id_kelas.'/'.$key->nim) ?>" target="_blank"><i class='fa fa-pencil-square-o'></i></a>
                        <?php
                      }

                    ?>
                  </td>
                </tr>
                <?php
            }
            ?>
            </tbody>
        </table>
        <div class="form-group">
          <button type="submit" name="" class="btn btn-primary btn-block">Upload</button>
        </div>
      </form>
    </div>
  </div>
  <div class="row">
    <div class="col-md-4">
      <a href='<?php echo site_url('kelas_dosen/cetak_dpna/'.$data_kelas) ?>' class="btn btn-success btn-block" target="_blank"><i class='fa fa-newspaper-o'></i> Cetak DPNA</a>
    </div>
    <div class="col-md-4">
      <a href='<?php echo site_url('#') ?>' class="btn btn-warning btn-block"><i class='fa fa-newspaper-o'></i> Import Excel</a>
    </div>
    <div class="col-md-4">
      <a href='<?php echo site_url('#') ?>' class="btn btn-danger btn-block"><i class='fa fa-newspaper-o'></i> Import Word</a>
    </div>
  </div>
</div>
