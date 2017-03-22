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
    <div class="col-md-10">
      <table class="table table-bordered table-striped" id="mytable">
          <thead>
              <tr>
                  <th width="80px">No</th>
                  <th>NIM</th>
                  <th>Nama Mahasiswa</th>
                  <th>Kode MK</th>
                  <th>Mata Kuliah</th>
                  <th>Periode</th>
                  <th>Nama Kelas</th>
                  <th>Nilai Angka</th>
                  <th>Nilai Huruf</th>
                  <th>Action</th>
              </tr>
          </thead>
          <tbody>
          <?php
          $start = 0;
          foreach ($nilai_data as $nilai)
          {
              ?>
              <tr>
                  <td><?php echo ++$start ?></td>
                  <td><?php echo $nilai->nim ?></td>
                  <td><?php echo $nilai->nm_mhs ?></td>
                  <td><?php echo $nilai->kode_mk ?></td>
                  <td><?php echo $nilai->nm_mk ?></td>
                  <td><?php echo $nilai->ta ?></td>
                  <td><?php echo $nilai->nm_kelas?></td>
                  <td><?php echo $nilai->nilai_angka ?></td>
                  <td><?php echo $nilai->nilai_huruf ?></td>
                  <td style="text-align:center" width="200px">
                    <a href='<?php echo site_url('nilai/read/'.$nilai->id_nilai) ?>'><i class='fa fa-eye'></i></a> |
                    <a href='<?php echo site_url('nilai/update/'.$nilai->id_nilai) ?>'><i class='fa fa-pencil-square-o'></i></a> |
                    <a href='<?php echo site_url('nilai/delete/'.$nilai->id_nilai) ?>' onclick='javasciprt: return confirm("Are You Sure ?")'><i class='fa fa-trash-o'></i></a>
                  </td>
                </tr>
              <?php
          }
          ?>
          </tbody>
      </table>
    </div>
    <div class="col-md-2">
      <div class="col-md-12">
        <form class="for" action="" method="post" id='filter_form' role="form">
          <div class="form-group">
            <label for="">Kategori</label>
            <select class="form-control" name="kat_filter" id="kat_filter">
              <option value="">--- Pilih Filter ---</option>
              <option value="nim">NIM</option>
              <option value="nama">Nama Mahasiswa</option>
              <option value="ta">Periode</option>
              <option value="kd_prodi">Kode Prodi</option>
              <option value="nm_prodi">Nama Prodi</option>
            </select>
          </div>
          <div class="form-group">
            <label for="">Nama Filter</label>
            <input type="text" name="nm_filter" class="form-control" value="" id="nm_filter">
          </div>
        </form>
        <div class="form-action">
          <button type="button" name="" id="btn_filter" class="btn btn-warning btn-block">Filter</button>
        </div>
      </div>
      <div class="col-md-12"><br>
        <?php echo anchor(site_url('nilai/create'), 'Create', 'class="btn btn-primary btn-block"'); ?>
        <?php echo anchor(site_url('nilai/excel'), 'Excel', 'class="btn btn-primary btn-block"'); ?>
        <?php echo anchor(site_url('nilai/word'), 'Word', 'class="btn btn-primary btn-block"'); ?>
      </div>
    </div>

    <div class="col-md-8">
      <div class="col-md-6">
        <h3>Transkrip Nilai Sementara</h3><hr>
        <form class="" action="nilai/transkrip_nilai" method="post">
          <div class="form-group">
            <label for="">NIM</label>
            <input type="text" class="form-control" name="nim_tr" id="nim_tr" value="" placeholder="Masukan NIM" value="" />
          </div>
          <div class="form-group">
            <button type="submit" name="" class="btn btn-primary" > <i class="fa fa-pencil-square-o"></i> Buat Transkrip Nilai</button>
          </div>
        </form>
      </div>
      <div class="col-md-6">
        <h3>Kartu Hasil Studi</h3><hr>
        <form class="" action="" method="post">
          <div class="form-group">
            <label for="">NIM</label>
            <input type="text" class="form-control" name="nim_tr" id="nim_tr" value="" placeholder="Masukan NIM" value="" />
          </div>
          <div class="form-group">
            <label for="">Tahun Akademik</label>
            <input type="text" class="form-control" name="ta_khs" id="ta_khs" value="" placeholder="T A" value="" />
          </div>
          <div class="form-group">
            <button type="submit" name="" class="btn btn-primary" > <i class="fa fa-pencil-square-o"></i> Buat KHS</button>
          </div>
        </form>
      </div>
    </div>
    <div class="col-md-4">
      <h3>Panduan Pengisian</h3><hr>
    </div>
  </div>
</div>
