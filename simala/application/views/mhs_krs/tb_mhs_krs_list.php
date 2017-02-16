<div class="container-fluid">
  <div class="page-header" style="margin-top: 50px;">
    <div class="row" style="margin-bottom: 10px">
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
  <div class="row">
    <div class="col-md-10">
      <table class="table table-bordered table-striped" id="krstable">
        <thead>
            <tr>
                <th width="80px">No</th>
                <th>NIM</th>
                <th>Nama Mahasiswa</th>
                <!-- <th>Kode Pembayaran</th>
                <th>Nama Kurikulum</th> -->
                <th>Periode</th>
                <th>BAAK</th>
                <th>Keuangan</th>
                <th>Action</th>
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
                <!-- <td><?php echo  $key->kode_pembayaran ?></td>
                <td><?php echo  $key->nm_kurikulum ?></td> -->
                <td><?php echo  $key->ta ?></td>
                <td><?php echo  $key->status_ambil ?></td>
                <td><?php echo  $key->status_cek ?></td>
                <td style="text-align:center" width="200px">
                  <a href='<?php echo site_url('mhs_krs/read/'.$key->id_krs) ?>'><i class='fa fa-eye'></i></a> |
                  <a href='<?php echo site_url('mhs_krs/update/'.$key->id_krs) ?>'><i class='fa fa-pencil-square-o'></i></a> |
                  <a href='<?php echo site_url('mhs_krs/delete/'.$key->id_krs) ?>' onclick='javasciprt: return confirm("Are You Sure ?")'><i class='fa fa-trash-o'></i></a>
                  |
                  <a href='<?php echo site_url('mhs_krs/konfirmasi/'.$key->id_krs.'/'.$key->nim) ?>' onclick='javasciprt: return confirm("Konfirmasi ?")'><i class='fa fa-newspaper-o'></i></a>
                </td>
              </tr>
            <?php
          }
        ?>
        </tbody>
      </table>
    </div>
    <div class="col-md-2">
      <div class="col-md-12">
        <form class="for" action="" method="post" id='filter_form' role="form">
          <div class="form-group">
            <label for="">Kategori</label>
            <select class="form-control" name="kat_filter" id="kat_filter">
              <option value="">--- Pilih Filter ---</option>
              <option value="nim">NIM</option>
              <option value="nama">Nama Mahasiswa</option>
              <option value="ta">Periode</option>
              <option value="kd_prodi">Kode Prodi</option>
              <option value="nm_prodi">Nama Prodi</option>
              <option value="status_ambil">Status Ambil (T/Y)</option>
            </select>
          </div>
          <div class="form-group">
            <label for="">Nama Filter</label>
            <input type="text" name="nm_filter" class="form-control" value="" id="nm_filter">
          </div>
        </form>
        <div class="form-action">
          <button type="button" name="" id="btn_filter" class="btn btn-warning btn-block">Filter</button>
        </div>
      </div>
      <div class="col-md-12"><br>
        <?php echo anchor(site_url('mhs_krs/create'), 'Create', 'class="btn btn-primary btn-block"'); ?>
        <?php echo anchor(site_url('mhs_krs/excel'), 'Excel', 'class="btn btn-primary btn-block"'); ?>
        <?php echo anchor(site_url('mhs_krs/word'), 'Word', 'class="btn btn-primary btn-block"'); ?>
      </div>
    </div>
  </div>
</div>
