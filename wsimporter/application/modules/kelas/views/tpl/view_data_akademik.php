<div class="container-fluid">
	<div class="page-header" style="margin-top: 50px;">
		<div class="row">
			<div class="col-lg-12">
				<h3><?php echo $title_page; ?></h3>
				<small><?php echo $ket_page;?></small>
			</div>
		</div>
	</div>
	<div class="row">
		<div class="col-lg-6">
			<b>Jurusan Teknik Informatika</b><hr>
			<table class="table table-hover table-striped table-bordered dt_data_u" id="">
					<thead>
						<tr>
							<th width="10px;">#</th>
							<th>NIM</th>
							<th>Nama Mahasiswa</th>
							<th>Action</th>
						</tr>
					</thead>
					<tfoot>
						<tr>
							<th width="10px;">#</th>
							<th>NIM</th>
							<th>Nama Mahasiswa</th>
							<th>Action</th>
						</tr>
					</tfoot>
					<tbody>
						<?php $no=1; ?>
						<?php foreach ($data_mhs_ti as $key ): ?>
							<tr>
								<td><?php echo $no++; ?></td>
								<td><?php echo $key->nim ?></td>
								<td><?php echo $key->nm_mhs ?></td>
								<td>
									<a href="<?php echo base_url('kelas/view_data_krs/'.$key->nim.'/'.$key->ta) ?>" class="btn btn-xs btn-success"><i class="fa fa-credit-card" aria-hidden="true"></i> KRS</a>
									<a href="<?php echo base_url('kelas/data_nilai_akademik/'.$key->nim.'/'.$key->ta) ?>" class="btn btn-xs btn-primary"><i class="fa fa-credit-card" aria-hidden="true"></i> Nilai</a>
									<a href="#" class="btn btn-xs btn-danger"><i class="fa fa-gears" aria-hidden="true"></i></a>
								</td>
							</tr>
						<?php endforeach; ?>
					</tbody>
				</table>
		</div>
		<div class="col-lg-6">
			<b>Jurusan Sistem Informasi</b><hr>
			<table class="table table-hover table-striped table-bordered dt_data_u" id="">
					<thead>
						<tr>
							<th width="10px;">#</th>
							<th>NIM</th>
							<th>Nama Mahasiswa</th>
							<th>Action</th>
						</tr>
					</thead>
					<tfoot>
						<tr>
							<th width="10px;">#</th>
							<th>NIM</th>
							<th>Nama Mahasiswa</th>
							<th>Action</th>
						</tr>
					</tfoot>
					<tbody>
						<?php $no=1; ?>
						<?php foreach ($data_mhs_si as $key ): ?>
							<tr>
								<td><?php echo $no++; ?></td>
								<td><?php echo $key->nim ?></td>
								<td><?php echo $key->nm_mhs ?></td>
								<td>
									<a href="<?php echo base_url('kelas/view_data_krs/'.$key->nim.'/'.$key->ta) ?>" class="btn btn-xs btn-success"><i class="fa fa-credit-card" aria-hidden="true"></i> KRS</a>
									<a href="<?php echo base_url('kelas/data_nilai_akademik/'.$key->nim.'/'.$key->ta) ?>" class="btn btn-xs btn-primary"><i class="fa fa-credit-card" aria-hidden="true"></i> Nilai</a>
									<a href="#" class="btn btn-xs btn-danger"><i class="fa fa-gears" aria-hidden="true"></i></a>
								</td>
							</tr>
						<?php endforeach; ?>
					</tbody>
				</table>
		</div>
	</div>
</div>
