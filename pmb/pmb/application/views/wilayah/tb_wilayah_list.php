<h5><h1 class="page-header"><?php echo $title ?></h1></h5>
<div class="row" style="margin-bottom: 10px">
    <div class="col-md-6">
        <!-- <?php echo anchor(site_url('wilayah/create'),'Create', 'class="btn btn-primary"'); ?> -->
    </div>
    <div class="col-md-6 text-center">
        <div style="margin-top: 8px" id="message">
            <?php echo $this->session->userdata('message') <> '' ? $this->session->userdata('message') : ''; ?>
        </div>
    </div>
</div>
<div class="row" style="margin-bottom: 10px">
  <table class="table table-bordered">
      <tr>
          <th>No</th>
		<th>Kode Wilayah</th>
		<th>Nm Wilayah</th>
		<th>Action</th>
            </tr><?php
        foreach ($wilayah_data as $wilayah)
        {
            ?>
            <tr>
			<td width="80px"><?php echo ++$start ?></td>
			<td><?php echo $wilayah->kode_wilayah ?></td>
			<td><?php echo $wilayah->nm_wilayah ?></td>
			<td style="text-align:center" width="200px">
				<?php
				echo anchor(site_url('wilayah/read/'.$wilayah->id_wilayah),'Read');
				echo ' | ';
				echo anchor(site_url('wilayah/update/'.$wilayah->id_wilayah),'Update');
				echo ' | ';
				echo anchor(site_url('wilayah/delete/'.$wilayah->id_wilayah),'Delete','onclick="javasciprt: return confirm(\'Are You Sure ?\')"');
				?>
			</td>
		</tr>
                <?php
            }
            ?>
  </table>
</div>
<div class="row">
    <div class="col-md-6 ">
        <a href="#" class="btn btn-primary">Total Record : <?php echo $total_rows ?></a>
	    </div>
    <div class="col-md-6  text-right">
        <?php echo $pagination ?>
    </div>
</div>
