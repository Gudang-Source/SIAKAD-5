<div class="container-fluid">
  <div class="page-header" style="margin-top: 50px;">
    <div class="row">
      <div class="col-md-12">
        <div class="col-md-8">
            <h2 style=""><?php echo $title_page; ?></h2>
        </div>
        <div class="col-md-4 text-center">
            <div style="margin-top: 4px"  id="message">
                <?php echo $this->session->userdata('message') <> '' ? $this->session->userdata('message') : ''; ?>
            </div>
        </div>
      </div>
    </div>
  </div>
  <div class="row">
    <div class="col-md-12">
      <table class="table table-bordered table-striped" id="mytable">
          <thead>
              <tr>
                  <th>No</th>
                  <th>NIM</th>
                  <th>Nama Mahasiswa</th>
                  <th>Action</th>
              </tr>
          </thead>
          <tbody>
          <?php
          $start = 0;
          foreach ($mhs_wali_data as $mhs_wali)
          {
              ?>
              <tr>
                  <td><?php echo ++$start ?></td>
                  <td><?php echo $mhs_wali->id_mhs ?></td>
                  <td><?php echo $mhs_wali->nm_mhs ?></td>
                  <td style="text-align:center" width="200px">
                    <a href="<?php echo site_url('mhs_wali/periodedata/'.$mhs_wali->id_mhs.'/'.$mhs_wali->kd_prodi) ?>" class="btn btn-xs btn-danger" onclick="javasciprt: return confirm('Are You Sure ?')"><i class='fa fa-gears'> Proses</i></a>
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
