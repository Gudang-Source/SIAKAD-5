
<h5><h1 class="page-header"><?php echo $title ?></h1></h5>
<div class="row" style="margin-bottom: 10px">
    <div class="col-md-6">
        <?php echo anchor(site_url('status_awal/create'),'Create', 'class="btn btn-primary"'); ?>
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
		<th>Kode Status Awal</th>
		<th>Nm Status Awal</th>
		<th>Action</th>
            </tr><?php
        foreach ($status_awal_data as $status_awal)
        {
            ?>
            <tr>
			<td width="80px"><?php echo ++$start ?></td>
			<td><?php echo $status_awal->kode_status_awal ?></td>
			<td><?php echo $status_awal->nm_status_awal ?></td>
			<td style="text-align:center" width="200px">
				<?php 
				echo anchor(site_url('status_awal/read/'.$status_awal->id_status),'Read'); 
				echo ' | '; 
				echo anchor(site_url('status_awal/update/'.$status_awal->id_status),'Update'); 
				echo ' | '; 
				echo anchor(site_url('status_awal/delete/'.$status_awal->id_status),'Delete','onclick="javasciprt: return confirm(\'Are You Sure ?\')"'); 
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