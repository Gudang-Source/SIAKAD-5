<div class="container-fluid">
  <div class="page-header" style="margin-top: 50px;">
    <div class="row">
      <div class="col-md-12">
        <div class="col-md-4">
              <h3><?php echo $title_page; ?></h3>
        </div>
        <div class="col-md-4 text-center">
            <div style="margin-top: 4px"  id="message">
                <?php echo $this->session->userdata('message') <> '' ? $this->session->userdata('message') : ''; ?>
            </div>
        </div>
        <div class="col-md-4 text-right">
            <!-- <?php echo anchor(site_url('mahasiswa/create'), 'Create', 'class="btn btn-primary"'); ?> -->
        		<?php echo anchor(site_url('mahasiswa/excel'), 'Excel', 'class="btn btn-primary"'); ?>
        		<!-- <?php echo anchor(site_url('mahasiswa/word'), 'Word', 'class="btn btn-primary"'); ?> -->
        </div>
      </div>
    </div>
  </div>
  <div class="row">
    <div class="col-md-12">
      <div class="col-md-8">
        <table class="table">
            <tr><td>Nm Mhs</td><td><?php echo $nm_mhs; ?></td></tr>
            <tr><td>Tpt Lhr</td><td><?php echo $tpt_lhr; ?></td></tr>
            <tr><td>Tgl Lahir</td><td><?php echo $tgl_lahir; ?></td></tr>
            <tr><td>Jenkel</td><td><?php echo $jenkel; ?></td></tr>
            <tr><td>Agama</td><td><?php echo $agama; ?></td></tr>
            <tr><td>Kelurahan</td><td><?php echo $kelurahan; ?></td></tr>
            <tr><td>Wilayah</td><td><?php echo $wilayah; ?></td></tr>
            <tr><td>Nm Ibu</td><td><?php echo $nm_ibu; ?></td></tr>
            <tr><td>Kd Prodi</td><td><?php echo $kd_prodi; ?></td></tr>
            <tr><td>Tgl Masuk</td><td><?php echo $tgl_masuk; ?></td></tr>
            <tr><td>Smt Masuk</td><td><?php echo $smt_masuk; ?></td></tr>
            <tr><td>Status Mhs</td><td><?php echo $status_mhs; ?></td></tr>
            <tr><td>Status Awal</td><td><?php echo $status_awal; ?></td></tr>
            <tr><td>Email</td><td><?php echo $email; ?></td></tr>
            <tr><td></td><td><a href="<?php echo site_url('mahasiswa') ?>" class="btn btn-default">Cancel</a></td></tr>
        </ta
      </div>
      <div class="col-md-4">

      </div>
    </div>
  </div>
</div>
