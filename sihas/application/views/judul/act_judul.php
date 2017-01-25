<div class="container-fluid">
  <div class="page-header" style="margin-top: 50px;">
    <div class="row">
      <div class="col-md-12">
        <h3><?php echo $title_page; ?></h3>
      </div>

    </div>
  </div>
  <div class="row">
    <div class="col-md-12">
      <table class="table table-bordered table-striped" id="">
          <thead>
              <tr>
                  <th width="80px">No</th>
                  <th>Nama Mahasiswa</th>
                  <th>Judul</th>
                  <th>Nama Pembimbing 1</th>
                  <th>Nama Pembimbing 2</th>
              </tr>
          </thead>
      <tbody>
          <?php
          $start = 0;
          foreach ($judul as $proposal)
          {
              ?>
              <tr>
                <td><?php echo ++$start ?></td>
                <td><?php echo $proposal->nim ?></td>
                <td><?php echo $proposal->judul ?></td>
                <td><?php echo $proposal->pembimbing_1 ?></td>
                <td><?php echo $proposal->pembimbing_2 ?></td>
              </tr>
          <?php
          }
          ?>
          </tbody>
      </table>
    </div>
  </div>
</div>
