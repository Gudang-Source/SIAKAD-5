
<h5><h1 class="page-header"><?php echo $title ?></h1></h5>
<div class="row" style="margin-bottom: 10px">
    <div class="col-md-6">
        <?php echo anchor(site_url('cmhs/create'),'Create', 'class="btn btn-primary"'); ?>
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
		<th>Kode Cmhs</th>
		<th>Kode Pendaftar</th>
		<th>No Ktp</th>
		<th>Kode Agama</th>
		<th>Tpt Lhr</th>
		<th>Tgl Lhr</th>
		<th>Jenkel</th>
		<th>Alamat</th>
		<th>Asal Sekolah</th>
		<th>Email</th>
		<th>Kode Prodi</th>
		<th>File Foto</th>
		<th>Status Ujian</th>
		<th>Action</th>
            </tr><?php
        foreach ($cmhs_data as $cmhs)
        {
            ?>
            <tr>
			<td width="80px"><?php echo ++$start ?></td>
			<td><?php echo $cmhs->kode_cmhs ?></td>
			<td><?php echo $cmhs->kode_pendaftar ?></td>
			<td><?php echo $cmhs->no_ktp ?></td>
			<td><?php echo $cmhs->kode_agama ?></td>
			<td><?php echo $cmhs->tpt_lhr ?></td>
			<td><?php echo $cmhs->tgl_lhr ?></td>
			<td><?php echo $cmhs->jenkel ?></td>
			<td><?php echo $cmhs->alamat ?></td>
			<td><?php echo $cmhs->asal_sekolah ?></td>
			<td><?php echo $cmhs->email ?></td>
			<td><?php echo $cmhs->kode_prodi ?></td>
			<td><?php echo $cmhs->file_foto ?></td>
			<td><?php echo $cmhs->status_ujian ?></td>
			<td style="text-align:center" width="200px">
				<?php 
				echo anchor(site_url('cmhs/read/'.$cmhs->id_mhs),'Read'); 
				echo ' | '; 
				echo anchor(site_url('cmhs/update/'.$cmhs->id_mhs),'Update'); 
				echo ' | '; 
				echo anchor(site_url('cmhs/delete/'.$cmhs->id_mhs),'Delete','onclick="javasciprt: return confirm(\'Are You Sure ?\')"'); 
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
		<?php echo anchor(site_url('cmhs/excel'), 'Excel', 'class="btn btn-primary"'); ?>
	    </div>
    <div class="col-md-6  text-right">
        <?php echo $pagination ?>
    </div>
</div>