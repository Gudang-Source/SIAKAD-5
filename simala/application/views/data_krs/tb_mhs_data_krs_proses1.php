<div class="container-fluid">
  <div class="page-header" style="margin-top: 50px;">
    <div class="row" style="margin-bottom: 10px">
      <div class="col-md-12">
        <div class="col-md-6">
          <h3>
            <?php
            echo $title_page;
            ?>
          </h3>
        </div>
        <div class="col-md-6 text-center">

        </div>
      </div>
    </div>
  </div>
  <div class="row">
    <div class="col-md-3">
      <strong>Biodata Mahasiswa</strong><hr>
      <table>
        <tr>
          <td><label for="">Nama Mahasiswa</label></td>
          <td>: </td>
          <td>
            <?php echo $data_mhs_aktif->nm_mhs ?>
          </td>
        </tr>
        <tr>
          <td><label for="">Angkatan</label></td>
          <td>: </td>
          <td>
            <?php echo $data_mhs_aktif->smt_masuk ?>
          </td>
        </tr>

        <tr>
          <td><label for="">Periode</label></td>
          <td>: </td>
          <td>
            <?php echo $ta ?>
          </td>
        </tr>
      </table>
    </div>
    <div class="col-md-9">
      <b>Daftar Beli Mata Kuliah Periode Berjalan</b><hr>
      <table class="table_data table table-bordered table-striped">
          <thead>
              <tr>
                  <th>No</th>
                  <th>Kode MK</th>
                  <th>Mata Kuliah</th>
                  <th>Kelas</th>
                  <th>SKS</th>
                  <th>Action</th>
              </tr>
          </thead>

          <tbody>
          <?php
          $start = 0;
          $total_sks=0;
          foreach ($data_krs_data as $data_krs)
          {
              $total_sks += $data_krs->sks;
              ?>
              <tr>
              <td><?php echo ++$start ?></td>
              <td><?php echo $data_krs->id_matkul ?></td>
              <td><?php echo $data_krs->nm_mk ?></td>
              <td><?php echo $data_krs->nm_kelas ?></td>
              <td><?php echo $data_krs->sks ?></td>
              <td style="text-align:center">
                <a href='<?php echo site_url('data_krs/delete/'.$data_krs->id_data_krs.'/'.$ta.'/'.$kode_prodi) ?>' onclick=''><i class='fa fa-trash-o'></i></a>
              </td>
             </tr>
              <?php
          }
          ?>
          </tbody>
          <tfoot>
              <tr>
                <th colspan="5"><center>TOTAL SATUAN KREDIT YANG DIAMBIL</center></th>
                <th><?php echo $total_sks ?></th>
              </tr>
          </tfoot>
      </table>
      <div class="col-md-12">
        <hr>
      </div>
    </div>
  </div>
  <div class="row">
    <div class="col-md-12">
      <div class="col-md-4">
        <b>Filter Daftar Belanja Mata Kuliah</b><hr>
        <form class="form" action="<?php echo site_url('data_krs/proses_krs/'.$nim.'/'.$ta.'/'.$id_krs.'/'.$id_kurikulum.'/'.$kode_prodi) ?>" method="post">
          <div class="form-group">
            <label for="">Kelas</label>
            <select class="form-control" name="filter_kelas" id="filter_kelas" ></select>
          </div>
          <div class="form-group">
            <center><button type="submit" class="btn btn-warning btn-block"  name="">Filter</button></center>
          </div>
        </form>
        <div id="message">
            <?php echo $this->session->userdata('message') <> '' ? $this->session->userdata('message') : ''; ?>
        </div>

        <p>
          <b>Catatan Mahasiswa Mengulang Mata Kuliah</b><hr>
          <strong>Mohon maaf atas ketidak nyamanan ini</strong><br>
          Hingga Saat ini sistem masih dikembangkan untuk kenyamanan anda <br>
          Untuk Mahasiswa yang mengulang harap ikut aturan berikut ini. <br>
          <ol>
            <li>Ingatlah Dimana Kelas Anda Sewaktu Mengambil mata kuliah bersangkutan</li>
            <li>Harap Mencentang Chekbox Ulang (jangan melepas centang baru)</li>
          </ol>
          Terima Kasih Atas Perhatiannya <br>
          Best Regard,<br><br><br>
          Admin
        </p>
      </div>
      <div class="col-md-8">
        <b>Beli Mata Kuliah Tersisa <?php echo 24 - $total_sks; ?> SKS Lagi</b>
        <form action="<?php echo site_url('data_krs/add_baru') ?>" method="post">
          <table class="table table-bordered table-striped" data-page-length='25' id="tbKrs">
            <thead>
              <tr>
                <th>No.</th>
                <th>Mata Kuliah</th>
                <th>Kelas</th>
                <th>Ambil</th>
                <th>SKS</th>
              </tr>
            </thead>
            <tbody>
              <?php
              $no=1;
              ?>
              <?php foreach ($krs_data as $key => $value): ?>
                <div class="form-group">
                  <tr>
                    <td width="40px"><?php echo $no++ ?></td>
                    <td><?php echo $value['nm_mk'] ?></td>
                    <td><?php echo $value['nm_kelas'] ?></td>
                    <td align="center">
                      <?php if ($value['status_pesan']==true): ?>
                        <input type='checkbox' name='item[]' value="<?php echo $value['id_kelas'] ?>" checked readOnly> Baru | <input type='checkbox' name='ulang[]' value="<?php echo $value['id_kelas'] ?>"> Ulang
                      <?php else: ?>
                        <input type='checkbox' name='item[]' value="<?php echo $value['id_kelas'] ?>"> Baru
                      <?php endif; ?>

                    </td>
                    <td>
                      <?php echo $value['sks'] ?>
                    </td>
                  </tr>
                </div>
              <?php endforeach; ?>
            </tbody>
          </table>
          <input type="text" class="form-control hide" name="id_krs" id="id_krs" value="<?php echo $id_krs ?>" />
          <input type="text" class="form-control hide" name="id_kurikulum" id="id_kurikulum" value="<?php echo $id_kurikulum ?>" />
          <input type="text" class="form-control hide" name="kode_prodi" id="id_kurikulum" value="<?php echo $kode_prodi ?>" />
          <input type="text" class="form-control hide" name="ta" id="id_kurikulum" value="<?php echo $ta ?>" />
          <input type="text" class="form-control hide" name="nim" id="id_kurikulum" value="<?php echo $nim ?>" />
          <button type="submit" class="btn btn-primary btn-block" onclick='javasciprt: return confirm("Dengan Mengunggah Kartu Rencan STUDI Anda Berarti Anda Telah Memberikan Data Yang Valid Dan Jika Suatu Hari Saya Terbukti Memberikan Data Yang Tidak Benar Maka Saya Bersedia Untuk Menyelesaikan dengan baik")'>Upload Kartu Rencana Studi</button>
        </form>
      </div>
    </div>
  </div>
</div>
