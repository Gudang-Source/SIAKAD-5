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
    <div class="col-md-12">
      <div class="col-md-10">
        <table class="table table-bordered table-striped" id="mytable">
            <thead>
                <tr>
                    <th>No</th>
                    <!-- <th>NIM</th>
                    <th>Nama Mahasiswa</th> -->
                    <th>Kode MK</th>
                    <th>SKS</th>
                    <th>Mata Kuliah</th>
                    <th>Periode</th>
                    <th>Nama Kelas</th>
                    <th>Nilai Index</th>
                    <th>Nilai Angka</th>
                    <th>Nilai Huruf</th>
                    <th>Analisis</th>
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
                    <!-- <td><?php echo $nilai->nim ?></td>
                    <td><?php echo $nilai->nm_mhs ?></td> -->
                    <td><?php echo $nilai->kode_mk ?></td>
                    <td><?php echo $nilai->sks ?></td>
                    <td><?php echo $nilai->nm_mk ?></td>
                    <td><?php echo $nilai->ta ?></td>
                    <td><?php echo $nilai->nm_kelas?></td>
                    <td><?php echo $nilai->nilai_index?></td>
                    <td><?php echo $nilai->nilai_angka ?></td>
                    <td><?php echo $nilai->nilai_huruf ?></td>
                    <td>
                      <?php
                      if (($nilai->nilai_index >= 3.5 && $nilai->nilai_index <= 4)) {
                        ?>
                        <span class="label label-success">Great</span>
                        <?php
                      }
                      elseif ($nilai->nilai_index >= 2.75 && $nilai->nilai_index <= 3.0) {
                        ?>
                          <span class="label label-default">Ok</span>
                        <?php
                      }
                      elseif ($nilai->nilai_index >= 1.0 && $nilai->nilai_index <= 2.5) {
                        ?>
                          <span class="label label-warning">Warning</span>
                        <?php
                      }
                      else {
                        ?>
                        <span class="label label-danger">Error</span>
                        <?php
                      }

                      ?>
                    </td>
                  </tr>
                <?php
            }
            ?>
            </tbody>
        </table>
      </div>
      <div class="col-md-2">
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
    </div>
    <div class="col-md-8">
      <h3>Transkrip Nilai Sementara</h3><hr>
      <form class="" action="nilai/transkrip_nilai" method="post">
        <div class="form-group">
          <label for="">NIM</label>
          <input type="text" class="form-control" name="nim_tr" id="nim_tr" value="<?php echo $this->session->userdata('nim'); ?>" placeholder="Masukan NIM" value="" />
        </div>
        <div class="form-group">
          <button type="submit" name="" class="btn btn-success pull-right" > <i class="fa fa-pencil-square-o"></i> Buat Transkrip Nilai</button>
        </div>
      </form>
    </div>
    <div class="col-md-4">
      <h3>Panduan Pengisian</h3><hr>
    </div>
  </div>
</div>
