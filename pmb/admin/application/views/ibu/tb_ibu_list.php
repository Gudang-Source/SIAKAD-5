
<h5><h1 class="page-header"><?php echo $title ?></h1></h5>
<div class="row" style="margin-bottom: 10px">
    <div class="col-md-6">
        <?php echo anchor(site_url('ibu/create'),'Create', 'class="btn btn-primary"'); ?>
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
		<th>Kode Ibu</th>
		<th>Kode Cmhs</th>
		<th>Nm Ibu</th>
		<th>Kode Pekerjaan</th>
		<th>Kode Penghasilan</th>
		<th>Action</th>
            </tr><?php
        foreach ($ibu_data as $ibu)
        {
            ?>
            <tr>
			<td width="80px"><?php echo ++$start ?></td>
			<td><?php echo $ibu->kode_ibu ?></td>
			<td><?php echo $ibu->kode_cmhs ?></td>
			<td><?php echo $ibu->nm_ibu ?></td>
			<td><?php echo $ibu->kode_pekerjaan ?></td>
			<td><?php echo $ibu->kode_penghasilan ?></td>
			<td style="text-align:center" width="200px">
				<?php 
				echo anchor(site_url('ibu/read/'.$ibu->id_ibu),'Read'); 
				echo ' | '; 
				echo anchor(site_url('ibu/update/'.$ibu->id_ibu),'Update'); 
				echo ' | '; 
				echo anchor(site_url('ibu/delete/'.$ibu->id_ibu),'Delete','onclick="javasciprt: return confirm(\'Are You Sure ?\')"'); 
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
		<?php echo anchor(site_url('ibu/excel'), 'Excel', 'class="btn btn-primary"'); ?>
	    </div>
    <div class="col-md-6  text-right">
        <?php echo $pagination ?>
    </div>
</div>