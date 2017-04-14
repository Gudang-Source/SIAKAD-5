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
    <div class="col-md-12">
      <b>Daftar Beli Mata Kuliah Periode Berjalan</b><hr>
      <?php
        if ($status_tutup==false && $status_buka==true) {
          ?>
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
                    <a href='<?php echo site_url('krs/delete/'.$data_krs->id_data_krs.'/'.$this->uri->segment(5).'/'.$id_kurikulum) ?>' onclick=''><i class='fa fa-trash-o'></i></a>
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
          <?php
        }
        else if ($status_tutup==false && $status_buka_1==true) {
          ?>
          <div class="well text-center">
            <div class="center text-large innerAll">
              <i class="fa fa-5x fa-chain-broken text-danger"></i>
            </div>
            <h1 class="strong innerTB "></h1>
            <h1 class="strong innerTB  ">Perhatian!</h1>
            <h2 class="innerB  fa fa-exclamation-triangle fa-3x "> Pembelian KRS Secara Online Tidak Tersedia.</h2>
            <br>
            <br>
            <div class="strong text-danger">
                <h4><p>Masa <b>Belanja Matakuliah Online</b> pada periode <b> <?php echo $this->session->userdata('ta') ?></b></p>
                <p>bisa di lakukan pada tanggal <b> <?php echo $tgl_buka ?> s/d <?php echo $tgl_tutup ?></b></p>
                <p>dan</p>
                <p>Masa <b>Ubah Belanja Matakuliah Online</b> pada periode <b><?php echo $this->session->userdata('ta') ?></b>
                </p><p>bisa di lakukan pada tanggal <b> <?php echo $tgl_buka ?> s/d <?php echo $tgl_tutup ?></b></p>
                </h4>
            </div>
          </div>
          <?php
        }
        else if ($status_tutup==false && $status_buka==false) {
          ?>
          <div class="well text-center">
            <div class="center text-large innerAll">
              <i class="fa fa-5x fa-chain-broken text-danger "></i>
            </div>
            <h1 class="strong innerTB "></h1>
            <h1 class="strong innerTB  ">Perhatian!</h1>
            <h2 class="fa fa-exclamation-triangle fa-3x innerB"> Halaman Tidak Tersedia.</h2>
            <br>
            <br>
            <div class="strong text-danger">
                <h4><p>Masa <b>Belanja Matakuliah Online</b> pada periode <b> <?php echo $this->session->userdata('ta') ?></b></p>
                <p>bisa di lakukan pada tanggal <b> <?php echo $tgl_buka ?> s/d <?php echo $tgl_tutup ?></b></p>
                <p>dan</p>
                <p>Masa <b>Ubah Belanja Matakuliah Online</b> pada periode <b> <?php echo $this->session->userdata('ta') ?> </b>
                </p><p>bisa di lakukan pada tanggal <b> <?php echo $tgl_buka ?> s/d <?php echo $tgl_tutup ?></b></p>
                </h4>
            </div>
          </div>
          <?php
        }
        else {
          ?>

          <?php
        }
      ?>
    </div>
    <div class="col-md-12">
      <hr>
    </div>
    <div class="col-md-4">
      <b>Filter Daftar Belanja Mata Kuliah</b><hr>
      <form class="form" action="<?php echo site_url('krs/proses_krs/'.$nim.'/'.$ta.'/'.$id_krs.'/'.$id_kurikulum) ?>" method="post">
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
      <?php if ($total_sks>=0 && $total_sks<=24 && $total_sks<=23 && $status_tutup==false && $status_buka==true): ?>
        <form action="<?php echo site_url('krs/add_baru') ?>" method="post">
          <table class="table table-bordered table-striped" data-page-length='25'>
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
                        <input type='checkbox' name='item[]' value="<?php echo $value['id_kelas'] ?>" checked readonly="true"> Baru | <input type='checkbox' name='ulang[]' value="<?php echo $value['id_kelas'] ?>"> Ulang
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
          <button type="submit" class="btn btn-primary btn-block" onclick='javasciprt: return confirm("Dengan Mengunggah Kartu Rencan STUDI Anda Berarti Anda Telah Memberikan Data Yang Valid Dan Jika Suatu Hari Saya Terbukti Memberikan Data Yang Tidak Benar Maka Saya Bersedia Untuk Menyelesaikan dengan baik")'>Upload Kartu Rencana Studi</button>
        </form>
      <?php else: ?>
        <div class="col-md-12">
          <div class="well text-center">
            <div class="center text-large innerAll">
              <i class="fa fa-5x fa-chain-broken text-danger "></i>
            </div>
            <h1 class="strong innerTB "></h1>
            <h1 class="strong innerTB  ">Perhatian!</h1>
            <h2 class="fa fa-exclamation-triangle fa-3x innerB"> Menu Tidak Tersedia.</h2>
            <br>
            <br>
            <div class="strong text-danger">
                <h4><p>Belanja <b> Matakuliah Online</b> pada periode <b> <?php echo $this->session->userdata('ta') ?></b></p>
                <p>Telah <b>Mencukupi Batas Maksimal Yang Telah Di Tawarkan Atau Telah Melewati Batas Pengisian</b></p>
                </h4>
            </div>
          </div>
        </div>
      <?php endif; ?>
    </div>
  </div>
</div>
