<div class="container-fluid">
  <div class="page-header" style="margin-top: 50px;">
    <div class="row" style="margin-bottom: 10px">
      <div class="col-md-12">
        <div class="col-md-4">
          <h3><?php echo $title_page; ?></h3>
        </div>
        <div class="col-md-4 text-center">
            <div style="margin-top: 4px"  id="message">
                <?php echo $this->session->userdata('message') <> '' ? $this->session->userdata('message') : ''; ?>
            </div>
        </div>
        <div class="col-md-4 text-right">

        </div>
      </div>
    </div>
  </div>
  <div class="row">
    <div class="col-md-12">
      <div class="col-md-4">
        <table>
          <tr>
            <td><label for="">Nama Kurikulum</label></td>
            <td>:</td>
            <td>
              <label for="">
              <?php if ($data_periode->status == 1): ?>
                <span class="label label-success"><?php echo $data_periode->nm_kurikulum ?></span>
              <?php else: ?>
                  <span class="label label-danger"><?php echo $data_periode->nm_kurikulum ?></span>
              <?php endif; ?>
              </label>
            </td>
          </tr>
          <tr>
            <td><label for="">Periode</label></td>
            <td>:</td>
            <td>
              <?php if ($data_periode->status == 1): ?>
                <span class="label label-success"><?php echo $data_periode->ta ?></span>
              <?php else: ?>
                  <span class="label label-danger"><?php echo $data_periode->ta ?></span>
              <?php endif; ?>
            </td>
          </tr>

          <tr>
            <td><label for="">Jumlah Ambil</label></td>
            <td>:</td>
            <td>
              <?php if ($data_periode->status == 1): ?>
                <span class="label label-success"><?php echo $count_mhs_krs ?> SKS Dari Total Mahasiswa Aktif</span>
              <?php else: ?>
                  <span class="label label-danger"><?php echo $count_mhs_krs ?> SKS Dari Total Mahasiswa Aktif</span>
              <?php endif; ?>
            </td>
          </tr>
        </table>
      </div>
      <div class="col-md-4">
        <?php echo anchor(site_url('data_krs/create'), 'Tambah KRS', 'class="btn btn-success btn-block"'); ?>
        <?php echo anchor(site_url('data_krs/excel'), 'Import Excel', 'class="btn btn-primary btn-block"'); ?>
      </div>
      <div class="col-md-4">
        <?php echo anchor(site_url('data_krs/word'), 'Import Word', 'class="btn btn-warning btn-block"'); ?>
        <?php echo anchor(site_url('data_krs'), 'Kembali', 'class="btn btn-danger btn-block"'); ?>
      </div>
    </div>
  </div>
  <hr>
  <div class="row">
    <div class="col-md-8">
      <table class="table table-bordered table-striped" id="krstable">
        <thead>
            <tr>
                <th>No</th>
                <th>NIM</th>
                <th>Nama Mahasiswa</th>
                <!-- <th>Kode Pembayaran</th> -->
                <th>BAAK</th>
                <th>Kartu Ujian</th>
                <th><center>Action</center></th>
            </tr>
        </thead>
        <tbody>
        <?php
          $start=0;
          foreach ($data_mhs_krs as $key) {
            ?>
              <tr>
                <td><?php echo ++$start ?></td>
                <td><?php echo  $key->nim ?></td>
                <td><?php echo  $key->nama ?></td>
                <!-- <td><?php echo  $key->kode_pembayaran ?></td> -->
                <td><?php echo  $key->status_ambil ?></td>
                <td>
                  <a href="<?php echo site_url('data_krs/cetak_uts/'.$key->nim.'/'.$key->ta.'/'.$key->id_krs) ?>" onclick='javasciprt: return confirm("Are You Sure ?")' target="_blank"><i class='fa fa-archive'> UTS</i></a> |
                  <a href="<?php echo site_url('data_krs/cetak_uas/'.$key->nim.'/'.$key->ta.'/'.$key->id_krs) ?>" onclick='javasciprt: return confirm("Are You Sure ?")' target="_blank"><i class='fa fa-archive'> UAS</i></a>
                </td>
                <td style="text-align:center" width="200px">
                  <a href="<?php echo site_url('data_krs/konfirmasi/'.$key->nim.'/'.$key->kode_pembayaran) ?>"><i class='fa fa-pencil-square-o'></i></a> |
                  <a href="<?php echo site_url('data_krs/proses_krs/'.$key->nim.'/'.$key->ta) ?>"><i class='fa fa-gears'> </i></a>
                  |
                  <a href="<?php echo site_url('data_krs/cetak_krs/'.$key->nim.'/'.$key->ta.'/'.$key->id_krs) ?>"><i class='fa fa-archive'> Cetak Krs </i></a>
                </td>
              </tr>
            <?php
          }
        ?>
        </tbody>
      </table>
    </div>
    <div class="col-md-4">
      <table class="table table-bordered table-striped">
        <thead>
          <tr>
            <th>No</th>
            <th>Mahasiswa Aktif</th>
            <th>Angkatan</th>
          </tr>
        </thead>
        <tbody>
          <?php $mn=1 ?>
          <?php foreach ($rasio_mhs as $key): ?>
            <tr>
              <td><?php echo $mn++ ?></td>
              <td><?php echo $key->mahasiswa_aktif ?></td>
              <td><?php echo substr($key->smt_masuk,0,4) ?></td>
            </tr>
          <?php endforeach; ?>
        </tbody>
      </table>
      <div class="canvas-wrapper">
        <canvas class="main-chart2" id="chart2" height="200" width="600"></canvas>
      </div>
      <div class="col-md-12">
        <!-- <form class="for" action="" method="post" id='filter_form' role="form">
          <div class="form-group">
            <label for="">Kategori</label>
            <select class="form-control" name="kat_filter" id="kat_filter">
              <option value="">--- Pilih Filter ---</option>
              <option value="nim">NIM</option>
              <option value="nama">Nama Mahasiswa</option>
              <option value="ta">Periode</option>
              <option value="kd_prodi">Kode Prodi</option>
              <option value="nm_prodi">Nama Prodi</option>
            </select>
          </div>
          <div class="form-group">
            <label for="">Nama Filter</label>
            <input type="text" name="nm_filter" class="form-control" value="" id="nm_filter">
          </div>
        </form> -->
        <!-- <div class="form-action">
          <button type="button" name="" id="btn_filter" class="btn btn-warning btn-block">Filter</button>
        </div> -->
      </div>
    </div>
  </div>
</div>
