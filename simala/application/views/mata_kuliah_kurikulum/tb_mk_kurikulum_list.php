<div class="container-fluid">
  <div class="page-header" style="margin-top: 50px;">
    <div class="row" style="margin-bottom: 10px">
        <div class="col-md-4">
            <h3><?php echo $title_page; ?></h3>
        </div>
        <div class="col-md-4 text-center">
            <div style="margin-top: 4px"  id="message">
                <?php echo $this->session->userdata('message') <> '' ? $this->session->userdata('message') : ''; ?>
            </div>
        </div>
        <div class="col-md-4 text-right">

        </div>
    </div>
  </div>
  <div class="row">
    <div class="col-md-4">
      <strong>Keterangan</strong><hr>
      <table>
        <tr>
          <td><label for="">Nama Kurikulum</label></td>
          <td>:</td>
          <td>
            <span class="label label-success"><?php echo $mata_kur_row->nm_kurikulum ?></span>
          </td>
        </tr>
        <tr>
          <td><label for="">Program Studi</label></td>
          <td>:</td>
          <td>
            <label for=""><?php echo $mata_kur_row->nm_prodi ?></label>
          </td>
        </tr>
        <tr>
          <td><label for="">Periode</label></td>
          <td>:</td>
          <td>
            <label for=""><?php echo $mata_kur_row->ta ?></label>
          </td>
        </tr>
      </table>
    </div>
    <div class="col-md-4">
      <strong>Duplikasi Kurikulum</strong><hr>
      <div class="col-md-6">
        <div class="panel panel-danger">
        <div class="panel-heading">
          <div class="row">
              <div class="col-xs-3">
                  <i class="fa fa-list-ul fa-3x"></i>
              </div>
              <div class="col-xs-9 text-right">
                  <div class="huge">0</div>
                  <div>Copy Kurikulum</div>
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
                  <div>Mata Kuliah</div>
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
    <div class="col-md-4">
      <strong>Masukan Soal Ujian</strong><hr>
      <div class="col-md-6">
        <div class="panel panel-primary">
        <div class="panel-heading">
          <div class="row">
              <div class="col-xs-3">
                  <i class="fa fa-gears fa-3x"></i>
              </div>
              <div class="col-xs-9 text-right">
                  <div class="huge">0</div>
                  <div>UTS</div>
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
        <div class="panel panel-success">
        <div class="panel-heading">
          <div class="row">
              <div class="col-xs-3">
                  <i class="fa fa-gears fa-3x"></i>
              </div>
              <div class="col-xs-9 text-right">
                  <div class="huge">0</div>
                  <div>UAS</div>
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
  <div class="row">
    <div class="col-md-10">
      <hr>
      <table class="table table-bordered table-striped">
          <thead>
              <tr>
                  <th width="80px">No</th>
                  <th>Kode Mk</th>
                  <th>Mata Kuliah</th>
                  <th>SKS</th>
                  <th>Silabus</th>
                  <th>Modul</th>
                  <th>Action</th>
              </tr>
          </thead>
           <tbody>
          <?php
          $start = 0;
          foreach ($mata_kuliah_kurikulum_data as $mata_kuliah_kurikulum)
          {
              ?>
              <tr>
                  <td><?php echo ++$start ?></td>
                  <td><?php echo $mata_kuliah_kurikulum->kode_mk ?></td>
                  <td><?php echo $mata_kuliah_kurikulum->nm_mk ?></td>
                  <td><?php echo $mata_kuliah_kurikulum->sks ?></td>
                  <td><?php echo $mata_kuliah_kurikulum->silabus ?></td>
                  <td><?php echo $mata_kuliah_kurikulum->modul ?></td>
                  <td style="text-align:center" width="100px">
                    <a href='<?php echo site_url('mata_kuliah_kurikulum/update/'.$mata_kuliah_kurikulum->id_kur_mk) ?>'><i class='fa fa-pencil-square-o'></i></a> |
                    <a href='<?php echo site_url('mata_kuliah_kurikulum/delete/'.$mata_kuliah_kurikulum->id_kur_mk) ?>' onclick='javasciprt: return confirm("Are You Sure ?")'><i class='fa fa-trash-o'></i></a>
                  </td>
                </tr>
              <?php
          }
          ?>
          </tbody>
      </table>
    </div>
    <div class="col-md-2">
      <?php echo anchor(site_url('mata_kuliah_kurikulum/create'), 'Create', 'class="btn btn-primary btn-block"'); ?>
      <?php echo anchor(site_url('mata_kuliah_kurikulum/excel'), 'Excel', 'class="btn btn-primary btn-block"'); ?>
      <?php echo anchor(site_url('mata_kuliah_kurikulum/word'), 'Word', 'class="btn btn-primary btn-block"'); ?>
    </div>
  </div>
  <div class="row">
    <div class="col-md-12">

    </div>
  </div>
</div>
