
<h5><h1 class="page-header"><?php echo $title ?></h1></h5>
<div class="row" style="margin-bottom: 10px">
    <div class="col-md-6">
        <?php echo anchor(site_url('mhs_wali/create'),'Create', 'class="btn btn-primary"'); ?>
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
		<th>Kode Mhs Wali</th>
		<th>Kode Cmhs</th>
		<th>Nm Wali</th>
		<th>Kode Hubungan</th>
		<th>Action</th>
            </tr><?php
        foreach ($mhs_wali_data as $mhs_wali)
        {
            ?>
            <tr>
			<td width="80px"><?php echo ++$start ?></td>
			<td><?php echo $mhs_wali->kode_mhs_wali ?></td>
			<td><?php echo $mhs_wali->kode_cmhs ?></td>
			<td><?php echo $mhs_wali->nm_wali ?></td>
			<td><?php echo $mhs_wali->kode_hubungan ?></td>
			<td style="text-align:center" width="200px">
				<?php 
				echo anchor(site_url('mhs_wali/read/'.$mhs_wali->id_mhs_wali),'Read'); 
				echo ' | '; 
				echo anchor(site_url('mhs_wali/update/'.$mhs_wali->id_mhs_wali),'Update'); 
				echo ' | '; 
				echo anchor(site_url('mhs_wali/delete/'.$mhs_wali->id_mhs_wali),'Delete','onclick="javasciprt: return confirm(\'Are You Sure ?\')"'); 
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
		<?php echo anchor(site_url('mhs_wali/excel'), 'Excel', 'class="btn btn-primary"'); ?>
	    </div>
    <div class="col-md-6  text-right">
        <?php echo $pagination ?>
    </div>
</div>