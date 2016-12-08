<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">
  <div class="row">
    <div class="col-lg-12 panel panel-widget">
      <h1 class="page-header"><?php echo $title ?></h1>
    </div>
  </div><!--/.row-->
  <div class="row">
    <div class="col-md-12">
      <div class="panel panel-default">
        <div class="panel-heading">
          <b>Jadwal Hari Ini</b>
        </div>
        <div class="panel-boddy">
          <table class="table table-bordered table-striped">
            <thead>
              <tr>
                <th>Hari</th>
                <th>Jam</th>
                <th>Kode Mata Kuliah</th>
                <th>Nama Mata Kuliah</th>
                <th>Kelas</th>
                <th>Ruangan</th>
              </tr>
            </thead>
            <tbody>
              <?php foreach ($jadwal as $key): ?>
              <tr>
                <td><?php echo $key->nm_hari ?></td>
                <td><?php echo $key->nm_jam ?></td>
                <td><?php echo $key->kode_mk ?></td>
                <td><?php echo $key->nm_mk ?></td>
                <td><?php echo $key->nm_kelas ?></td>
                <td><?php echo $key->nm_ruangan ?></td>
              </tr>
              <?php endforeach; ?>
            </tbody>
          </table>
        </div>
        <div class="panel-footer">

        </div>
      </div>
    </div>
  </div><!--/.row-->
  <div class="row">
    <div class="col-md-12">
      <div class="panel panel-default">
        <div class="panel-heading">
          <b>Jadwal Lengkap Periode 20161</b>
        </div>
        <div class="panel-boddy">
          <table class="table table-bordered table-striped">
            <thead>
              <tr>
                <th>Hari</th>
                <th>Jam</th>
                <th>Kode Mata Kuliah</th>
                <th>Nama Mata Kuliah</th>
                <th>Kelas</th>
                <th>Ruangan</th>
              </tr>
            </thead>
            <tbody>
              <?php foreach ($jadwal as $key): ?>
              <tr>
                <td><?php echo $key->nm_hari ?></td>
                <td><?php echo $key->nm_jam ?></td>
                <td><?php echo $key->kode_mk ?></td>
                <td><?php echo $key->nm_mk ?></td>
                <td><?php echo $key->nm_kelas ?></td>
                <td><?php echo $key->nm_ruangan ?></td>
              </tr>
              <?php endforeach; ?>
            </tbody>
          </table>
        </div>
        <div class="panel-footer">

        </div>
      </div>
    </div>
  </div><!--/.row-->
</div>	<!--/.main-->
