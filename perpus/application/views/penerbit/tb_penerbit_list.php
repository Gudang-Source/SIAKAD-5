<div class="row">
  <div class="col-md-10">
    <table class="table table-bordered table-striped" id="mytable">
        <thead>
            <tr>
                <th width="80px">No</th>
    <th>Nm Penerbit</th>
    <th>Alamat</th>
    <th>Action</th>
            </tr>
        </thead>
  <tbody>
        <?php
        $start = 0;
        foreach ($penerbit_data as $penerbit)
        {
            ?>
            <tr>
    <td><?php echo ++$start ?></td>
    <td><?php echo $penerbit->nm_penerbit ?></td>
    <td><?php echo $penerbit->alamat ?></td>
    <td style="text-align:center" width="200px">
  <?php
  echo anchor(site_url('penerbit/read/'.$penerbit->id_penerbit),'Read');
  echo ' | ';
  echo anchor(site_url('penerbit/update/'.$penerbit->id_penerbit),'Update');
  echo ' | ';
  echo anchor(site_url('penerbit/delete/'.$penerbit->id_penerbit),'Delete','onclick="javasciprt: return confirm(\'Are You Sure ?\')"');
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
      <?php echo anchor(site_url('penerbit/create'), 'Create', 'class="btn btn-primary btn-block"'); ?>
      <?php echo anchor(site_url('penerbit/excel'), 'Excel', 'class="btn btn-primary btn-block"'); ?>
    </div>
  </div>
</div>
