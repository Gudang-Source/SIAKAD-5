<div class="container-fluid">
  <div class="page-header" style="margin-top: 50px;">
    <div class="row" style="margin-bottom: 10px">
      <div class="col-md-4">
          <h3><?php echo $title_page; ?></h3>
      </div>
      <div class="col-md-4">
        <div id="message">
            <?php echo $this->session->userdata('message') <> '' ? $this->session->userdata('message') : ''; ?>
        </div>
      </div>
    </div>
  </div>
  <div class="row">
    <div class="col-md-10">
      <table class="table table-bordered table-striped" id="mytable">
        <thead>
          <tr>
            <th>No</th>
            <th>NIM</th>
            <th>Id Mk</th>
            <th>Nama MK Now</th>
            <th>Kode Mk Asal</th>
            <th>Nm Mk Asal</th>
            <th>Action</th>
          </tr>
        </thead>
        <tbody>
          <?php
          $start = 0;
          foreach ($nilai_trans_data as $nilai_trans)
          {
          ?>
          <tr>
            <td><?php echo ++$start ?></td>
            <td><?php echo $nilai_trans->nim ?></td>
            <td><?php echo $nilai_trans->id_mk ?></td>
            <td><?php echo $nilai_trans->nm_mk_now ?></td>
            <td><?php echo $nilai_trans->kode_mk_asal ?></td>
            <td><?php echo $nilai_trans->nm_mk_asal ?></td>
            <td style="text-align:center" width="200px">
            <?php
              echo anchor(site_url('nilai_trans/read/'.$nilai_trans->id_nilai_trans),'Read');
              echo ' | ';
              echo anchor(site_url('nilai_trans/update/'.$nilai_trans->id_nilai_trans),'Update');
              echo ' | ';
              echo anchor(site_url('nilai_trans/delete/'.$nilai_trans->id_nilai_trans),'Delete','onclick="javasciprt: return confirm(\'Are You Sure ?\')"');
            ?>
            </td>
          </tr>
          <?php
          }
          ?>
          </tbody>
        </table>
        <hr>
    </div>
    <div class="col-md-2">
      <div class="col-md-12">
        <?php echo anchor(site_url('nilai_trans/create'), 'Create', 'class="btn btn-primary btn-block"'); ?>
        <?php echo anchor(site_url('nilai_trans/excel'), 'Excel', 'class="btn btn-primary btn-block"'); ?>
      </div>
    </div>
    <div class="col-md-12">
      <div class="col-md-8">
        <b>Cetak Konversi Mahasiwa</b><hr>
        <form class="form" action="nilai_trans/excelone" method="post">
          <div class="form-group">
            <label for="">Masukan Nomor Induk Mahasiswa</label>
            <input type="text" class="form-control" name="nim" value="">
          </div>
          <button type="submit" class="btn btn-success btn-block" name="button">Cetak Konversi</button>
        </form>
      </div>
      <div class="col-md-4">

      </div>
    </div>
  </div>
</div>
