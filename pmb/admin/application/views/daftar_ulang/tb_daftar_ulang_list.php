
<h5><h1 class="page-header"><?php echo $title ?></h1></h5>
<div class="row" style="margin-bottom: 10px">
    <div class="col-md-6">
        <?php echo anchor(site_url('daftar_ulang/create'),'Create', 'class="btn btn-primary"'); ?>
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
		<th>Kode Daftar Ulang</th>
		<th>Kode Ujian</th>
		<th>C Nim</th>
		<th>No Telp</th>
		<th>Kode Ayah</th>
		<th>Kode Ibu</th>
		<th>Tgl Masuk</th>
		<th>Kode Wilayah</th>
		<th>Kode Status Awal</th>
		<th>Kode Status Mhs</th>
		<th>File Ijasah</th>
		<th>Action</th>
            </tr><?php
        foreach ($daftar_ulang_data as $daftar_ulang)
        {
            ?>
            <tr>
			<td width="80px"><?php echo ++$start ?></td>
			<td><?php echo $daftar_ulang->kode_daftar_ulang ?></td>
			<td><?php echo $daftar_ulang->kode_ujian ?></td>
			<td><?php echo $daftar_ulang->c_nim ?></td>
			<td><?php echo $daftar_ulang->no_telp ?></td>
			<td><?php echo $daftar_ulang->kode_ayah ?></td>
			<td><?php echo $daftar_ulang->kode_ibu ?></td>
			<td><?php echo $daftar_ulang->tgl_masuk ?></td>
			<td><?php echo $daftar_ulang->kode_wilayah ?></td>
			<td><?php echo $daftar_ulang->kode_status_awal ?></td>
			<td><?php echo $daftar_ulang->kode_status_mhs ?></td>
			<td><?php echo $daftar_ulang->file_ijasah ?></td>
			<td style="text-align:center" width="200px">
				<?php 
				echo anchor(site_url('daftar_ulang/read/'.$daftar_ulang->id_daftar_ulang),'Read'); 
				echo ' | '; 
				echo anchor(site_url('daftar_ulang/update/'.$daftar_ulang->id_daftar_ulang),'Update'); 
				echo ' | '; 
				echo anchor(site_url('daftar_ulang/delete/'.$daftar_ulang->id_daftar_ulang),'Delete','onclick="javasciprt: return confirm(\'Are You Sure ?\')"'); 
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
		<?php echo anchor(site_url('daftar_ulang/excel'), 'Excel', 'class="btn btn-primary"'); ?>
	    </div>
    <div class="col-md-6  text-right">
        <?php echo $pagination ?>
    </div>
</div>