<div class="row">
  <div class="col-md-10">
    <table class="table table-bordered table-striped" id="mytable">
      <thead>
        <tr>
          <th width="80px">No</th>
          <th>Id Buku</th>
          <th>Tgl Pjm</th>
          <th>Lama Pjm</th>
          <th>Tgl Kembali</th>
          <th>Id Mhs</th>
          <th>Status Pjm</th>
          <th>Action</th>
        </tr>
      </thead>
      <tbody>
      <?php
      $start = 0;
      foreach ($pinjam_data as $pinjam)
      {
          ?>
          <tr>
            <td><?php echo ++$start ?></td>
            <td><?php echo $pinjam->id_buku ?></td>
            <td><?php echo $pinjam->tgl_pjm ?></td>
            <td><?php echo $pinjam->lama_pjm ?></td>
            <td><?php echo $pinjam->tgl_kembali ?></td>
            <td><?php echo $pinjam->id_mhs ?></td>
            <td><?php echo $pinjam->status_pjm ?></td>
            <td style="text-align:center" width="200px">
            <?php
            echo anchor(site_url('pinjam/read/'.$pinjam->id_pinjam),'Read');
            echo ' | ';
            echo anchor(site_url('pinjam/update/'.$pinjam->id_pinjam),'Update');
            echo ' | ';
            echo anchor(site_url('pinjam/delete/'.$pinjam->id_pinjam),'Delete','onclick="javasciprt: return confirm(\'Are You Sure ?\')"');
            ?>
            </td>
          </tr>
          <?php
      }
      ?>
      </tbody>
    </table>
  </div>
  <div class="col-md-2">
    <div class="col-md-12 text-center">
      <div class="well">
        <div id="message">
            <?php echo $this->session->userdata('message') <> '' ? $this->session->userdata('message') : ''; ?>
        </div>
      </div>
    </div>
    <br>
    <div class="col-md-12">
      <?php echo anchor(site_url('pinjam/create'), 'Create', 'class="btn btn-primary"'); ?>
      <?php echo anchor(site_url('pinjam/excel'), 'Excel', 'class="btn btn-primary"'); ?>
    </div>
  </div>
</div>
