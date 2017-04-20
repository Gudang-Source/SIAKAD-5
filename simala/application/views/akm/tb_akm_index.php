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
        <b>Menghitung Aktifitas MHS</b><hr>
        <table class="table table-bordered table-stripped" id="tb1">
          <thead>
            <tr>
              <th>No.</th>
              <th>NIM</th>
              <th>Jur.</th>
              <th>Ang.</th>
              <th>SKS</th>
              <th>IPK</th>
              <th>N x K</th>
            </tr>
          </thead>
          <tbody>
            <?php $no=1 ?>
            <?php foreach ($data_akm as $key): ?>
              <tr>
                <td><?php echo $no++ ?></td>
                <td><?php echo $key->nim ?></td>
                <?php if ($key->id_prodi==55201): ?>
                  <td><span class="label label-danger">TI</span></td>
                <?php else: ?>
                  <td><span class="label label-warning">SI</span></td>
                <?php endif; ?>
                <td><?php echo substr($key->angkatan, 0,4) ?></td>
                <td><?php echo $key->total_sks ?></td>
                <td><?php echo $key->ipk_s ?></td>
                <td><?php echo $key->total_n_k ?></td>
              </tr>
            <?php endforeach; ?>
          </tbody>
        </table>
        <p><small><em>* Data Valid Hanya Angkatan 2016 | Untuk Membandingkan Perhatikan Jumlah KHS (Meskipun IPK Tinggi Jika Jumlah SKS Kecil Maka Urutan Ada Di Posisi Bawah)</em></small></p>
      </div>
      <div class="col-md-2">

      </div>
    </div>
  </div>
</div>
