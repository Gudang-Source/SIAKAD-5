<div class="container-fluid">
  <div class="page-header" style="margin-top: 50px;">
    <div class="row">
      <div class="col-md-12">
        <h3><?php echo $title_page; ?></h3>
      </div>
    </div>
  </div>
  <div class="row">
    <div class="col-md-12">
      <div class="col-md-6">
        <b>Data Profil Diri Anda</b><hr>
        <table class="table">
            <tr>
              <td>NIM</td>
              <td width="5px">:</td>
              <td><?php echo $nim; ?></td>
            </tr>
            <tr>
              <td>Nama Lengkap</td>
              <td width="5px">:</td>
              <td><?php echo $nm_mhs; ?></td>
            </tr>
            <tr>
              <td>Tpt Lhr</td>
              <td>:</td>
              <td><?php echo $tpt_lhr; ?></td>
            </tr>
            <tr>
              <td>Tgl Lahir</td>
              <td>:</td>
              <td><?php echo $tgl_lahir; ?></td>
            </tr>
            <tr>
              <td>Jenkel</td>
              <td>:</td>
              <td><?php echo $jenkel; ?></td>
            </tr>
            <tr>
              <td>Agama</td>
              <td>:</td>
              <td><?php echo $agama; ?></td>
            </tr>
            <tr>
              <td>Alamat</td>
              <td>:</td>
              <td><?php echo $kelurahan; ?></td>
            </tr>
            <tr>
              <td>Wilayah</td>
              <td>:</td>
              <td><?php echo $wilayah; ?></td>
            </tr>
            <tr>
              <td>Nama Prodi</td>
              <td>:</td>
              <td><?php echo $nm_prodi; ?></td>
            </tr>
            <tr>
              <td>Tgl Masuk</td>
              <td>:</td>
              <td><?php echo $tgl_masuk; ?></td>
            </tr>
            <tr>
              <td>Smt Masuk</td>
              <td>:</td>
              <td><?php echo $smt_masuk; ?></td>
            </tr>
            <tr>
              <td>Status Mhs</td>
              <td>:</td>
              <td><?php echo $status_mhs; ?></td>
            </tr>
            <tr>
              <td>Status Awal</td>
              <td>:</td>
              <td><?php echo $status_awal; ?></td>
            </tr>
            <tr>
              <td>Email</td>
              <td>:</td>
              <td><?php echo $email; ?></td>
            </tr>
            <tr>
              <td>Foto</td>
              <td>:</td>
              <td>
                <img width="106" height="141px" src="" alt="Proses" />
              </td>
            </tr>
            <tr>
              <td><a href="<?php echo site_url('mahasiswa/update/'.$nim) ?>" class="btn btn-success btn-block"> Ubah Data</a></td>
              <td></td>
              <td>
                <a href="<?php echo site_url('mahasiswa') ?>" class="btn btn-default btn-block">Cancel</a>
              </td>
            </tr>
        </table>
      </div>
      <div class="col-md-6">
        <strong>Aktifitas Mahasiswa</strong><hr>
        <table class="table table-bordered table-striped mytable">
          <thead>
            <tr>
              <th>No.</th>
              <th>Periode</th>
              <th>Semester</th>
              <th>MK</th>
              <th>SKS</th>
              <th>Status Mahasiswa</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody>
            <?php $no=1 ?>
            <?php foreach ($aktifitas as $key => $value): ?>
              <?php if (!$value['cek']): ?>

              <?php else: ?>
                <tr class='clickable-row' data-href='#'>
                  <td><?php echo $no++ ?></td>
                  <td><?php echo $value["periode"] ?></td>
                  <td>
                    <?php if (substr($value["periode"], 4) == 1): ?>
                      Ganjil
                    <?php else: ?>
                      Genap
                    <?php endif; ?>
                  </td>
                  <td><?php echo $value["jumlah_mk"] ?></td>
                  <td><?php echo $value["total_sks"] ?></td>
                  <td style="text-align:center">
                    <?php if ($value['status'] == 'aktif'): ?>
                      <span class="label label-success">Aktif </span>
                    <?php else: ?>
                      <span class="label label-danger">Non Aktif (Proses)</span>
                    <?php endif; ?>
                  </td>
                  <td>
                    <a href='<?php echo site_url('') ?>' class="btn btn-xs btn-primary"><i class='fa fa-eye'></i> KRS</a>
                  </td>
                </tr>
              <?php endif; ?>
            <?php endforeach; ?>
          </tbody>
        </table>
        <strong>Menu Lainnya</strong><hr>
        <!-- <div class="col-md-12">
          <div class="panel panel-default">
  					<div class="panel-heading">
  						 <a class="panel-title btn btn-default btn-block collapsed" data-toggle="collapse" data-parent="#panel-994761" href="#panel-element-404020" aria-expanded="false"><strong>AKM</strong></a>
  					</div>
  					<div id="panel-element-404020" class="panel-collapse collapse" aria-expanded="false" style="height: 0px;">
  						<div class="panel-body">
                <?php echo json_encode($aktifitas); ?>

  						</div>
  					</div>
  				</div>
          <div class="panel panel-default">
  					<div class="panel-heading">
  						 <a class="panel-title btn btn-default btn-block collapsed" data-toggle="collapse" data-parent="#panel-994761" href="#panel-element-234738" aria-expanded="false">OK</a>
  					</div>
  					<div id="panel-element-234738" class="panel-collapse collapse" aria-expanded="false" style="height: 0px;">
  						<div class="panel-body">
                oke
  						</div>
  					</div>
  				</div>

          <div class="panel panel-default">
  					<div class="panel-heading">
  						 <a class="panel-title btn btn-default btn-block collapsed" data-toggle="collapse" data-parent="#panel-994761" href="#panel-element-234739" aria-expanded="false">Akademik</a>
  					</div>
  					<div id="panel-element-234739" class="panel-collapse collapse" aria-expanded="false" style="height: 0px;">
  						<div class="panel-body">
                oke
  						</div>
  					</div>
  				</div>
        </div> -->

        <div class="col-md-6">
          <div class="panel panel-danger">
          <div class="panel-heading">
            <div class="row">
                <div class="col-xs-3">
                    <i class="fa fa-list-ul fa-3x"></i>
                </div>
                <div class="col-xs-9 text-right">
                    <div class="huge">0</div>
                    <div>KRS</div>
                </div>
            </div>
          </div>
          <a href="<?php echo site_url('kurikulum') ?>">
            <div class="panel-footer">
                <span class="pull-left">View Details</span>
                <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                <div class="clearfix"></div>
            </div>
          </a>
          </div>
        </div>
        <div class="col-md-6">
          <div class="panel panel-warning">
          <div class="panel-heading">
            <div class="row">
                <div class="col-xs-3">
                    <i class="fa fa-mortar-board fa-3x"></i>
                </div>
                <div class="col-xs-9 text-right">
                    <div class="huge">0</div>
                    <div>KHS</div>
                </div>
            </div>
          </div>
          <a href="<?php echo site_url('mata_kuliah') ?>">
            <div class="panel-footer">
                <span class="pull-left">View Details</span>
                <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                <div class="clearfix"></div>
            </div>
          </a>
          </div>
        </div>
        <div class="col-md-6">
          <div class="panel panel-danger">
          <div class="panel-heading">
            <div class="row">
                <div class="col-xs-3">
                    <i class="fa fa-list-ul fa-3x"></i>
                </div>
                <div class="col-xs-9 text-right">
                    <div class="huge">0</div>
                    <div>KRS</div>
                </div>
            </div>
          </div>
          <a href="<?php echo site_url('kurikulum') ?>">
            <div class="panel-footer">
                <span class="pull-left">View Details</span>
                <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                <div class="clearfix"></div>
            </div>
          </a>
          </div>
        </div>
        <div class="col-md-6">
          <div class="panel panel-warning">
          <div class="panel-heading">
            <div class="row">
                <div class="col-xs-3">
                    <i class="fa fa-mortar-board fa-3x"></i>
                </div>
                <div class="col-xs-9 text-right">
                    <div class="huge">0</div>
                    <div>KHS</div>
                </div>
            </div>
          </div>
          <a href="<?php echo site_url('mata_kuliah') ?>">
            <div class="panel-footer">
                <span class="pull-left">View Details</span>
                <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                <div class="clearfix"></div>
            </div>
          </a>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
