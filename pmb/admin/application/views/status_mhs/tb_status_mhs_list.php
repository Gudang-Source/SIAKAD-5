
<h5><h1 class="page-header"><?php echo $title ?></h1></h5>
<div class="row" style="margin-bottom: 10px">
    <div class="col-md-6">
        <?php echo anchor(site_url('status_mhs/create'),'Create', 'class="btn btn-primary"'); ?>
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
		<th>Kode Status Mhs</th>
		<th>Nm Status Mhs</th>
		<th>Action</th>
            </tr><?php
        foreach ($status_mhs_data as $status_mhs)
        {
            ?>
            <tr>
			<td width="80px"><?php echo ++$start ?></td>
			<td><?php echo $status_mhs->kode_status_mhs ?></td>
			<td><?php echo $status_mhs->nm_status_mhs ?></td>
			<td style="text-align:center" width="200px">
				<?php 
				echo anchor(site_url('status_mhs/read/'.$status_mhs->id_status_mhs),'Read'); 
				echo ' | '; 
				echo anchor(site_url('status_mhs/update/'.$status_mhs->id_status_mhs),'Update'); 
				echo ' | '; 
				echo anchor(site_url('status_mhs/delete/'.$status_mhs->id_status_mhs),'Delete','onclick="javasciprt: return confirm(\'Are You Sure ?\')"'); 
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