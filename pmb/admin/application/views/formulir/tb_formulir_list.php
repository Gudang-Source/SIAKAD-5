
<h5><h1 class="page-header"><?php echo $title ?></h1></h5>
<div class="row" style="margin-bottom: 10px">
    <div class="col-md-6">
        <?php echo anchor(site_url('formulir/create'),'Create', 'class="btn btn-primary"'); ?>
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
		<th>Kode Formulir</th>
		<th>Username</th>
		<th>Password</th>
		<th>Nm Pendaftar</th>
		<th>Kode Pegawai</th>
		<th>Kode Angkatan</th>
		<th>Biaya</th>
		<th>Action</th>
            </tr><?php
        foreach ($formulir_data as $formulir)
        {
            ?>
            <tr>
			<td width="80px"><?php echo ++$start ?></td>
			<td><?php echo $formulir->kode_formulir ?></td>
			<td><?php echo $formulir->username ?></td>
			<td><?php echo $formulir->password ?></td>
			<td><?php echo $formulir->nm_pendaftar ?></td>
			<td><?php echo $formulir->kode_pegawai ?></td>
			<td><?php echo $formulir->kode_angkatan ?></td>
			<td><?php echo $formulir->biaya ?></td>
			<td style="text-align:center" width="200px">
				<?php 
				echo anchor(site_url('formulir/read/'.$formulir->id_formulir),'Read'); 
				echo ' | '; 
				echo anchor(site_url('formulir/update/'.$formulir->id_formulir),'Update'); 
				echo ' | '; 
				echo anchor(site_url('formulir/delete/'.$formulir->id_formulir),'Delete','onclick="javasciprt: return confirm(\'Are You Sure ?\')"'); 
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
		<?php echo anchor(site_url('formulir/excel'), 'Excel', 'class="btn btn-primary"'); ?>
	    </div>
    <div class="col-md-6  text-right">
        <?php echo $pagination ?>
    </div>
</div>