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
    <div class="col-md-5">
      <strong>Data Kurikulum Jurusan SI</strong><hr>
      <table class="table table-bordered table-striped" id="krstable">
        <thead>
            <tr>
                <th>No</th>
                <th>Periode</th>
                <!-- <th>Kode Pembayaran</th> -->
                <th>Nama Kurikulum</th>
                <th>Kode Prodi</th>
                <th><center>Action</center></th>
            </tr>
        </thead>
        <tbody>
        <?php
          $start=0;
          foreach ($data_mhs_krs_periode_si as $key) {
            ?>
              <tr>
                <td><?php echo ++$start ?></td>
                <td><?php echo  $key->ta ?></td>
                <!-- <td><?php echo  $key->kode_pembayaran ?></td> -->
                <td><?php echo  $key->nm_kurikulum ?></td>
                <td><?php echo  $key->kd_prodi ?></td>
                <td style="text-align:center">
                  <a href="<?php echo site_url('mata_kuliah_kurikulum/periodemk/'.$key->ta.'/'.$key->kd_prodi) ?>"><i class='fa fa-gears'> </i></a>
              </tr>
            <?php
          }
        ?>
        </tbody>
      </table>
    </div>
    <div class="col-md-5">
      <strong>Data Kurikulum Jurusan TI</strong><hr>
      <table class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>No</th>
                <th>Periode</th>
                <!-- <th>Kode Pembayaran</th> -->
                <th>Nama Kurikulum</th>
                <th>Kode Prodi</th>
                <th><center>Action</center></th>
            </tr>
        </thead>
        <tbody>
        <?php
          $start=0;
          foreach ($data_mhs_krs_periode_ti as $key) {
            ?>
              <tr>
                <td><?php echo ++$start ?></td>
                <td><?php echo  $key->ta ?></td>
                <!-- <td><?php echo  $key->kode_pembayaran ?></td> -->
                <td><?php echo  $key->nm_kurikulum ?></td>
                <td><?php echo  $key->kd_prodi ?></td>
                <td style="text-align:center">
                  <a href="<?php echo site_url('mata_kuliah_kurikulum/periodemk/'.$key->ta.'/'.$key->kd_prodi) ?>"><i class='fa fa-gears'> </i></a>
              </tr>
            <?php
          }
        ?>
        </tbody>
      </table>
    </div>
    <div class="col-md-2">
      <div class="col-md-12"><br>
        <!-- <?php echo anchor(site_url('data_krs/create'), 'Tambah KRS', 'class="btn btn-primary btn-block"'); ?> -->
        <?php echo anchor(site_url('data_krs/excel'), 'Import Excel', 'class="btn btn-primary btn-block"'); ?>
        <?php echo anchor(site_url('data_krs/word'), 'Import Word', 'class="btn btn-primary btn-block"'); ?>
      </div>
    </div>
  </div>
</div>
