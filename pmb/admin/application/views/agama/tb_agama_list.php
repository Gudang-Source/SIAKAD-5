
<h5><h1 class="page-header"><?php echo $title ?></h1></h5>
<div class="row" style="margin-bottom: 10px">
    <div class="col-md-6">
        <?php echo anchor(site_url('agama/create'),'Create', 'class="btn btn-primary"'); ?>
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
		<th>Kode Agama</th>
		<th>Nm Agama</th>
		<th>Action</th>
            </tr><?php
        foreach ($agama_data as $agama)
        {
            ?>
            <tr>
			<td width="80px"><?php echo ++$start ?></td>
			<td><?php echo $agama->kode_agama ?></td>
			<td><?php echo $agama->nm_agama ?></td>
			<td style="text-align:center" width="200px">
				<?php 
				echo anchor(site_url('agama/read/'.$agama->id_agama),'Read'); 
				echo ' | '; 
				echo anchor(site_url('agama/update/'.$agama->id_agama),'Update'); 
				echo ' | '; 
				echo anchor(site_url('agama/delete/'.$agama->id_agama),'Delete','onclick="javasciprt: return confirm(\'Are You Sure ?\')"'); 
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