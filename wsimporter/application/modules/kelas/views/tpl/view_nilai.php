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
		<div class="col-md-12">
			<div class="alert alert-warning" role="alert" style="display:none;" ><!-- style="display:none;"-->
				<div class="loading"></div>
				<div class="isi"></div>
			</div>
		</div>
		<div class="col-lg-4">
			<b>Identitas</b><hr>
			<table class="table table-striped">
				<tr>
					<td>NIM</td>
					<td>:</td>
					<td><?php echo $data_mhs->nim ?></td>
				</tr>
				<tr>
					<td>Nama</td>
					<td>:</td>
					<td><?php echo $data_mhs->nm_mhs ?> </td>
				</tr>
				<tr>
					<td>Angkatan</td>
					<td>:</td>
					<td><?php echo $data_mhs->smt_masuk ?> </td>
				</tr>
			</table>
			<b>Status Sycnron</b>
			<hr>
			<table class="table table-striped">
				<tr>
					<td>Berhasil</td>
					<td>:</td>
					<td><?php echo $berhasil ?> Dari <?php echo $jumlah_data ?></td>
				</tr>
				<tr>
					<td>Gagal</td>
					<td>:</td>
					<td><?php echo $gagal ?> Dari <?php echo $jumlah_data ?></td>
				</tr>
			</table>
			<b>Menu</b><hr>
			<input type="text" class="hide" id="nim_c" value="<?php echo $nim ?>">
			<a href="#" class="btn btn-block btn-success" id="btnSync"><i class="fa fa-send"></i> Sync All</a>
			<a href="<?php echo base_url('kelas/view_data/'.$nim.'/'.$ta) ?>" class="btn btn-block btn-primary"><i class="fa fa-home"></i> Back</a>
		</div>
		<div class="col-lg-8">
			<table class="table table-hover table-striped table-bordered" id="data_mhs_nilai">
					<thead>
						<tr>
							<th width="10px;">#</th>
							<th>Kode MK</th>
							<th>Mata Kuliah</th>
							<th>Kelas</th>
							<th>Nilai Angka</th>
							<th>Nilai Huruf</th>
							<th class="hide">ID Nilai</th>
						</tr>
					</thead>
					<tfoot>
						<tr>
							<th width="10px;">#</th>
							<th>Kode MK</th>
							<th>Mata Kuliah</th>
							<th>Kelas</th>
							<th>Nilai Angka</th>
							<th>Nilai Huruf</th>
							<th class="hide">ID Nilai</th>
						</tr>
					</tfoot>
					<tbody>
						<?php $no=1;  ?>
						<?php foreach ($data_mhs_nilai as $key ): ?>
							<tr>
								<td><?php echo $no++; ?></td>
								<td><?php echo $key->kode_mk ?></td>
								<td><?php echo $key->nm_mk ?></td>
								<td><?php echo $key->nm_kelas ?></td>
								<td><?php echo $key->nilai_angka ?></td>
								<td><?php echo $key->nilai_huruf ?></td>
								<th class="hide"><?php echo $key->id_nilai ?></th>
							</tr>
						<?php endforeach; ?>
					</tbody>
				</table>
		</div>
	</div>
</div>
