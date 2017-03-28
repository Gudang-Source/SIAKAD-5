
<h5><h1 class="page-header"><?php echo $title ?></h1></h5>
<div class="row" style="margin-bottom: 10px">
    <div class="col-md-6">
        <?php echo anchor(site_url('ayah/create'),'Create', 'class="btn btn-primary"'); ?>
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
		<th>Kode Ayah</th>
		<th>Kode Cmhs</th>
		<th>Nm Ayah</th>
		<th>Kode Pekerjaan</th>
		<th>Kode Penghasilan</th>
		<th>Action</th>
            </tr><?php
        foreach ($ayah_data as $ayah)
        {
            ?>
            <tr>
			<td width="80px"><?php echo ++$start ?></td>
			<td><?php echo $ayah->kode_ayah ?></td>
			<td><?php echo $ayah->kode_cmhs ?></td>
			<td><?php echo $ayah->nm_ayah ?></td>
			<td><?php echo $ayah->kode_pekerjaan ?></td>
			<td><?php echo $ayah->kode_penghasilan ?></td>
			<td style="text-align:center" width="200px">
				<?php 
				echo anchor(site_url('ayah/read/'.$ayah->id_ayah),'Read'); 
				echo ' | '; 
				echo anchor(site_url('ayah/update/'.$ayah->id_ayah),'Update'); 
				echo ' | '; 
				echo anchor(site_url('ayah/delete/'.$ayah->id_ayah),'Delete','onclick="javasciprt: return confirm(\'Are You Sure ?\')"'); 
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