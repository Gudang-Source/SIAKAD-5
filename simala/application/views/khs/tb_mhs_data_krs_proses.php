<div class="container-fluid">
  <div class="page-header" style="margin-top: 50px;">
    <div class="row" style="margin-bottom: 10px">
      <div class="col-md-12">
        <div class="col-md-6">
          <h3>
            <?php
            echo $title_page;
            ?>
          </h3>
        </div>
        <div class="col-md-6 text-center">
            <div style="margin-top: 4px"  id="message">
                <?php echo $this->session->userdata('message') <> '' ? $this->session->userdata('message') : ''; ?>
            </div>
        </div>
      </div>
    </div>
  </div>
  <div class="row">
    <div class="col-md-12">
      <div class="col-md-10">
        <b>Transkrip Nilai Periode Berjalan</b><hr>
        <table class="table table-bordered table-striped" id="mytable">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Kode MK</th>
                    <th>Mata Kuliah</th>
                    <th>Nilai Angka</th>
                    <th>Nilai Huruf</th>
                    <th>Nilai Index</th>
                    <th>Kredit</th>
                    <th>N x K</th>
                </tr>
            </thead>

            <tbody>
            <?php
            $start = 0;
            $t_nk = 0;
            $t_sks =0;
            foreach ($data_krs_data as $data_krs)
            {
                $n_k = $data_krs->nilai_index * $data_krs->sks;
                ?>
                <tr>
                  <td><?php echo ++$start ?></td>
                  <td><?php echo $data_krs->kode_mk ?></td>
                  <td><?php echo $data_krs->nm_mk ?></td>
                  <td><?php echo $data_krs->nilai_angka ?></td>
                  <td><?php echo $data_krs->nilai_huruf ?></td>
                  <td><?php echo $data_krs->nilai_index ?></td>
                  <td><?php echo $data_krs->sks ?></td>
                  <td><?php echo $n_k ?></td>
                </tr>
                <?php
                $t_nk = $t_nk+ $n_k;
                $t_sks = $t_sks+ $data_krs->sks;
            }
            $ipk = $t_nk/$t_sks;
            ?>
            </tbody>
            <tfoot>
                <tr>
                  <th colspan="6"><center>Jumlah</center></th>
                  <th><?php echo $t_sks ?></th>
                  <th><?php echo $t_nk ?></th>
                </tr>
                <tr>
                  <th colspan="7"><center>Indeks Prestasi Sementara</center></th>
                  <th><?php echo number_format($ipk,2) ?></th>
                </tr>
            </tfoot>
        </table>
      </div>
      <div class="col-md-2">
        <div class="col-md-12">
          <b>Cetak KHS Periode Ini</b><hr>
          <a href="<?php echo site_url('khs/transkrip_nilai/'.$nim.'/'.$ta) ?>" class="btn btn-primary btn-block" target="_blank">Cetak</a>
        </div>
      </div>
    </div>
  </div>
</div>
