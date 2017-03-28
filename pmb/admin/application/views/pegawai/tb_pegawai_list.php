
<h5><h1 class="page-header"><?php echo $title ?></h1></h5>
<div class="row" style="margin-bottom: 10px">
    <div class="col-md-6">
        <?php echo anchor(site_url('pegawai/create'),'Create', 'class="btn btn-primary"'); ?>
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
		<th>Kode Pegawai</th>
		<th>Nm Pegawai</th>
		<th>Action</th>
            </tr><?php
        foreach ($pegawai_data as $pegawai)
        {
            ?>
            <tr>
			<td width="80px"><?php echo ++$start ?></td>
			<td><?php echo $pegawai->kode_pegawai ?></td>
			<td><?php echo $pegawai->nm_pegawai ?></td>
			<td style="text-align:center" width="200px">
				<?php 
				echo anchor(site_url('pegawai/read/'.$pegawai->id_pegawai),'Read'); 
				echo ' | '; 
				echo anchor(site_url('pegawai/update/'.$pegawai->id_pegawai),'Update'); 
				echo ' | '; 
				echo anchor(site_url('pegawai/delete/'.$pegawai->id_pegawai),'Delete','onclick="javasciprt: return confirm(\'Are You Sure ?\')"'); 
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