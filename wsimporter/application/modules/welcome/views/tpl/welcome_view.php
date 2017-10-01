<!--div class="container-fluid">
	<div class="row">
		<div class="col-lg-12">
			<h1 class="page-header"><?php echo $title_page; ?></h1>
		</div>
	</div>
</div-->

<div class="container-fluid">
	<div class="page-header" style="margin-top: 50px;" >
		<div class="row">
			<div class="col-md-12">
				<h4><?php echo $title_page; ?></h4><hr>
			</div>
		</div>
		<div class="row">
			<div class="col-md-12">
				<table class="table table-hover table-striped table-bordered" id="dt_data_u">
					<thead>
						<tr>
							<th>No.</th>
							<th>Tahun</th>
							<th>Kurikulum</th>
							<th>Kode Prodi</th>
							<th>Action</th>
						</tr>
					</thead>
					<tbody>
						<?php $no=1; ?>
						<?php foreach ($data_krs as $key): ?>
							<tr>
								<td><?php echo $no++ ?></td>
								<td><?php echo $key->ta ?></td>
								<td><?php echo $key->nm_kurikulum ?></td>
								<td><?php echo $key->kd_prodi ?></td>
								<td>
									<?php if ($key->status == 1): ?>
										<a href="<?php echo site_url('kelas/view_data/'.$key->ta) ?>" class="btn btn-xs btn-success"> <i class="fa fa-user"></i> Mahasiswa</a>
										<a href="<?php echo site_url('kelas/view_data/'.$key->ta) ?>" class="btn btn-xs btn-success"> <i class="fa fa-bank"></i> Kelas</a>
									<?php else: ?>
										<a href="#" class="btn btn-xs btn-primary"> <i class="fa fa-user"></i> Mahasiswa</a>
										<a href="#" class="btn btn-xs btn-primary"> <i class="fa fa-bank"></i> Kelas</a>
									<?php endif; ?>
								</td>
							</tr>
						<?php endforeach; ?>
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>
