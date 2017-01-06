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
      <div class="col-md-8">
        <b>Data Profil Diri Anda</b><hr>
        <table class="table">
            <tr>
              <td>NIM</td>
              <td width="5px">:</td>
              <td><?php echo $this->session->userdata('nim'); ?></td>
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
      <div class="col-md-4">
        <b>Menu Lainnya</b><hr>
        <div class="col-md-12">
          <div class="panel-group" id="panel-994761">
      				<div class="panel panel-default">
      					<div class="panel-heading">
      						 <a class="panel-title collapsed btn btn-default btn-block" data-toggle="collapse" data-parent="#panel-994761" href="#panel-element-404020">Surat Keterangan Kuliah</a>
      					</div>
      					<div id="panel-element-404020" class="panel-collapse collapse in">
      						<div class="panel-body">
                    <div class="col-md-6">
                      <div class="panel panel-primary">
                          <div class="panel-heading">
                              <div class="row">
                                  <div class="col-xs-3">
                                      <i class="fa fa-users fa-5x"></i>
                                  </div>
                                  <div class="col-xs-9 text-right">
                                      <div class="huge">Surat Keterangan</div>
                                      <div>Aktif Kuliah</div>
                                  </div>
                              </div>
                          </div>
                          <a href="<?php echo site_url('mahasiswa/ket_kuliah/'.$nim) ?>" onclick='javasciprt: return confirm("Are You Sure ?")' target="_blank">
                              <div class="panel-footer">
                                  <span class="pull-left">Cetak</span>
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
                                      <i class="fa fa-mortar-board fa-5x"></i>
                                  </div>
                                  <div class="col-xs-9 text-right">
                                      <div class="huge">Surat Keterangan</div>
                                      <div>Status Mahasiswa</div>
                                  </div>
                              </div>
                          </div>
                          <a href="<?php echo site_url('mahasiswa/ket_mhs/'.$nim) ?>" onclick='javasciprt: return confirm("Are You Sure ?")' target="_blank">
                              <div class="panel-footer">
                                  <span class="pull-left">Cetak</span>
                                  <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                  <div class="clearfix"></div>
                              </div>
                          </a>
                      </div>
                    </div>
      						</div>
      					</div>
      				</div>
      				<div class="panel panel-default">
      					<div class="panel-heading">
      						 <a class="panel-title collapsed btn btn-default btn-block" data-toggle="collapse" data-parent="#panel-994761" href="#panel-element-234738">Surat Akademik</a>
      					</div>
      					<div id="panel-element-234738" class="panel-collapse collapse">
      						<div class="panel-body">
      							<div class="col-md-6">
                      <div class="panel panel-warning">
                          <div class="panel-heading">
                              <div class="row">
                                  <div class="col-xs-3">
                                      <i class="fa  fa-list-ul fa-5x"></i>
                                  </div>
                                  <div class="col-xs-9 text-right">
                                      <div class="huge">Surat Keterangan</div>
                                      <div>Pindah</div>
                                  </div>
                              </div>
                          </div>
                          <a href="#">
                              <div class="panel-footer">
                                  <span class="pull-left">Cetak</span>
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
                                      <i class="fa fa-bar-chart-o fa-5x"></i>
                                  </div>
                                  <div class="col-xs-9 text-right">
                                      <div class="huge">Surat Pengajuan</div>
                                      <div>Penelitian</div>
                                  </div>
                              </div>
                          </div>
                          <a href="#">
                              <div class="panel-footer">
                                  <span class="pull-left">Cetak</span>
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
        </div>
      </div>
    </div>
  </div>
</div>
