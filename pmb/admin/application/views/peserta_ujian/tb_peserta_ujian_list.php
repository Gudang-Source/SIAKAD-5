
<h5><h1 class="page-header"><?php echo $title ?></h1></h5>
<div class="row" style="margin-bottom: 10px">
    <div class="col-md-6">
        <?php echo anchor(site_url('peserta_ujian/create'),'Create', 'class="btn btn-primary"'); ?>
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
		<th>Kode Ujian</th>
		<th>Kode Cmhs</th>
		<th>Kode Ruangan</th>
		<th>N Wawancara</th>
		<th>N Psikotes</th>
		<th>N Bhs</th>
		<th>N Umum</th>
		<th>Status Ujian</th>
		<th>Action</th>
            </tr><?php
        foreach ($peserta_ujian_data as $peserta_ujian)
        {
            ?>
            <tr>
			<td width="80px"><?php echo ++$start ?></td>
			<td><?php echo $peserta_ujian->kode_ujian ?></td>
			<td><?php echo $peserta_ujian->kode_cmhs ?></td>
			<td><?php echo $peserta_ujian->kode_ruangan ?></td>
			<td><?php echo $peserta_ujian->n_wawancara ?></td>
			<td><?php echo $peserta_ujian->n_psikotes ?></td>
			<td><?php echo $peserta_ujian->n_bhs ?></td>
			<td><?php echo $peserta_ujian->n_umum ?></td>
			<td><?php echo $peserta_ujian->status_ujian ?></td>
			<td style="text-align:center" width="200px">
				<?php 
				echo anchor(site_url('peserta_ujian/read/'.$peserta_ujian->id_ujian),'Read'); 
				echo ' | '; 
				echo anchor(site_url('peserta_ujian/update/'.$peserta_ujian->id_ujian),'Update'); 
				echo ' | '; 
				echo anchor(site_url('peserta_ujian/delete/'.$peserta_ujian->id_ujian),'Delete','onclick="javasciprt: return confirm(\'Are You Sure ?\')"'); 
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
		<?php echo anchor(site_url('peserta_ujian/excel'), 'Excel', 'class="btn btn-primary"'); ?>
	    </div>
    <div class="col-md-6  text-right">
        <?php echo $pagination ?>
    </div>
</div>