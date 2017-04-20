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
        <strong>Keterangan</strong>
        <table class="table table-striped">
          <tr>
            <td><label for="">NIM</label></td>
            <td>:</td>
            <td><?php echo $data_mhs->nim ?></td>
          </tr>
          <tr>
            <td><label for="">Nama Mahasiswa</label></td>
            <td>:</td>
            <td><?php echo $data_mhs->nama ?></td>
          </tr>
        </table>
      </div>
      <div class="col-md-4">

      </div>
      <div class="col-md-4">

      </div>
    </div>
  </div>
  <hr>
  <div class="row">
    <div class="col-md-12">
      <table class="table table-bordered table-striped tablex" id="krstable">
        <thead>
            <tr>
                <th>No</th>
                <th>Kurikulum</th>
                <th>Periode</th>
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
                <td><?php echo  $key->nm_kurikulum ?></td>
                <td><?php echo  $key->ta ?></td>
                <td style="text-align:center">
                  <a href="<?php echo site_url('') ?>" class="btn btn-xs btn-warning"><i class='fa fa-search'> </i></a>
                  |
                  <a href="<?php echo site_url('') ?>" class="btn btn-xs btn-success"><i class='fa fa-archive'></i></a>
                  |
                  <?php if ($key->status_buka == 'Y'): ?>
                    <a href="<?php echo site_url('mhs_wali/buka_periode_krs/'.$key->id_krs.'/'.$key->nim.'/'.$key->kd_prodi) ?>" class="btn btn-xs btn-success" onclick="javasciprt: return confirm('Anda Membuka KRS Mahasiswa Harap Menyertakan Lampiran Surat Pembukaan Mahasiswa Terkait')"><i class='fa fa-lock'></i></a>
                  <?php else: ?>
                    <a href="<?php echo site_url('mhs_wali/buka_periode_krs/'.$key->id_krs.'/'.$key->nim.'/'.$key->kd_prodi) ?>" class="btn btn-xs btn-danger" onclick="javasciprt: return confirm('Anda Membuka KRS Mahasiswa Harap Menyertakan Lampiran Surat Pembukaan Mahasiswa Terkait')"><i class='fa fa-lock'></i></a>
                  <?php endif; ?>

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
