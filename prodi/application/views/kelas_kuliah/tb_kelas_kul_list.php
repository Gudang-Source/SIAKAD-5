<class="container-fluid">
  <div class="page-header" style="margin-top: 50px;">
    <div class="row" style="margin-bottom: 10px">
        <div class="col-md-8">
            <h3><?php echo $title_page; ?></h3>
        </div>
        <div class="col-md-4 text-center">
            <div style="margin-top: 4px"  id="message">
                <?php echo $this->session->userdata('message') <> '' ? $this->session->userdata('message') : ''; ?>
            </div>
        </div>
    </div>
  </div>
  <div class="row">
    <div class="col-md-12">
      <div class="col-md-6">
        <h3>Semua Kelas Kuliah</h3><hr>
        <table class="table table-bordered table-striped" id="mytable">
            <thead>
                <tr>
                  <th>Kelas</th>
                  <th>Prodi</th>
                  <th>Kode MK</th>
                  <th>Nama Mata Kuliah</th>
                  <th>TA</th>
                  <th>Action</th>
                </tr>
            </thead>
            <tbody>
            <?php
            $start = 0;
            foreach ($kelas_kuliah_data as $kelas_kuliah)
            {
                ?>
                <tr>
                  <td><?php echo $kelas_kuliah->nm_kelas ?></td>
                  <td><?php echo $kelas_kuliah->id_prodi ?></td>
                  <td><?php echo $kelas_kuliah->kode_mk ?></td>
                  <td><?php echo $kelas_kuliah->nm_mk ?></td>
                  <td><?php echo $kelas_kuliah->ta ?></td>
                  <td style="text-align:center">
                    <a href='<?php echo site_url('kelas_kuliah/read/'.$kelas_kuliah->id_kelas) ?>'><i class='fa fa-eye'></i></a> |
                    <a href='<?php echo site_url('kelas_kuliah/update/'.$kelas_kuliah->id_kelas) ?>'><i class='fa fa-pencil-square-o'></i></a> |
                    <a href='<?php echo site_url('kelas_kuliah/delete/'.$kelas_kuliah->id_kelas) ?>' onclick='javasciprt: return confirm("Are You Sure ?")'><i class='fa fa-trash-o'></i></a>
                  </td>
                </tr>
              <?php
            }
            ?>
            </tbody>
        </table>
      </div>
      <div class="col-md-6">
        <h3>Kelas Kuliah Per Kurikulum</h3><hr>
        <div class="col-md-12">
          <table class="table table-bordered table-striped" id="kurTable">
              <thead>
                  <tr>
                      <th width="80px">No</th>
                      <th>Nama Kurikulum</th>
                      <th>Periode</th>
                      <th>Kode Prodi</th>
                      <th>Status</th>
                      <th>Action</th>
                  </tr>
              </thead>
               <tbody>
              <?php
              $start = 0;
              foreach ($kurikulum_data as $kurikulum)
              {
                  ?>
                  <tr>
                    <td><?php echo ++$start ?></td>
                    <td><?php echo $kurikulum->nm_kurikulum ?></td>
                    <td><?php echo $kurikulum->ta ?></td>
                    <td><?php echo $kurikulum->kd_prodi ?></td>
                    <td><?php echo $kurikulum->status ?></td>
                    <td style="text-align:center">
                      <a href='<?php echo site_url('kelas_kuliah/get_kelas/'.$kurikulum->id_kurikulum) ?>'><i class='fa fa-gears'></i></a>
                    </td>
                  </tr>
                  <?php
              }
              ?>
              </tbody>
          </table>
        </div>
        <div class="col-md-12">
          <div class="col-md-4"><a href="<?php echo site_url('kelas_kuliah/create') ?>" class="btn btn-primary btn-block">Tambah Kelas</a></div>
          <div class="col-md-4"><a href="<?php echo  site_url('kelas_kuliah/excel') ?>" class="btn btn-primary btn-block">Export Excel</a></div>
          <div class="col-md-4"><a href="<?php echo site_url('kelas_kuliah/word') ?>" class="btn btn-primary btn-block"> Export Word</a></div>
        </div>
      </div>
    </div>
  </div>
</div>
