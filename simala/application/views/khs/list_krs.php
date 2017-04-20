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
    <div class="col-md-2">

    </div>
    <div class="col-md-4">

    </div>
    <div class="col-md-6">
      <table class="table table-stripped" id="tb1">
        <thead>
          <tr>
            <th>No.</th>
            <th>NIM</th>
            <th>SKS</th>
            <th>IPK</th>
            <th>N x K</th>
          </tr>
        </thead>
        <tbody>
          <?php $no=1 ?>
          <?php foreach ($data_akm as $key): ?>
            <tr>
              <td><?php echo $no++ ?></td>
              <td><?php echo $key->nim ?></td>
              <td><?php echo $key->total_sks ?></td>
              <td><?php echo $key->ipk_s ?></td>
              <td><?php echo $key->total_n_k ?></td>
            </tr>
          <?php endforeach; ?>
        </tbody>
      </table>
      <p><small><em>* Data Valid Hanya Angkatan 2016 | Untuk Membandingkan Perhatikan Jumlah KHS (Meskipun IPK Tinggi Jika Jumlah SKS Kecil Maka Urutan Ada Di Posisi Bawah)</em></small></p>
    </div>
  </div>
  <div class="row">
    <div class="col-md-12">
      <table class="table table-bordered table-striped" id="krstable">
        <thead>
            <tr>
                <th>No</th>
                <th>NIM</th>
                <th>Nama Mahasiswa</th>
                <th>Kode Pembayaran</th>
                <th>Nama Kurikulum</th>
                <th>Periode</th>
                <th>Ambil</th>
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
                <td><?php echo  $key->kode_pembayaran ?></td>
                <td><?php echo  $key->nm_kurikulum ?></td>
                <?php if (($key->ta == $this->session->userdata('ta'))): ?>
                <td><span class="label label-success"><?php echo  $key->ta ?></span></td>
                <?php else: ?>
                <td><span class="label label-danger"><?php echo  $key->ta ?></span></td>
                <?php endif; ?>
                <td><?php echo  $key->status_ambil ?></td>
                <td style="text-align:center" width="200px">
                  <a href="<?php echo site_url('khs/proses_khs/'.$key->nim.'/'.$key->ta.'/'.$key->id_krs) ?>"><i class='fa fa-gears'> </i></a> |
                  <a href="<?php echo site_url('khs/khsCetak/'.$key->nim.'/'.$key->ta.'/'.$key->id_krs) ?>"><i class='fa fa-gears'></i> Cetak</a>
                </td>
              </tr>
            <?php
          }
        ?>
        </tbody>
      </table>
    </div>
  </div>
</div>
