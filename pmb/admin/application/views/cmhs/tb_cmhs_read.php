<h5>
  <h1 class="page-header"><?php echo $title ?></h1>
</h5>
<table class="table">
  <tr>
    <td>Kode Cmhs</td>
    <td><?php echo $kode_cmhs; ?></td>
  </tr>
  <tr>
    <td>Kode Formulir</td>
    <td><?php echo $kode_formulir; ?></td>
  </tr>
  <tr>
    <td>No Ktp</td>
    <td><?php echo $no_ktp; ?></td>
  </tr>
  <tr><td>Agama</td><td><?php echo $nm_agama; ?></td></tr>
  <tr><td>Tpt Lhr</td><td><?php echo $tpt_lhr; ?></td></tr>
  <tr><td>Tgl Lhr</td><td><?php echo $tgl_lhr; ?></td></tr>
  <tr><td>Jenkel</td><td><?php echo $jenkel; ?></td></tr>
  <tr><td>Alamat</td><td><?php echo $alamat; ?></td></tr>
  <tr><td>Asal Sekolah</td><td><?php echo $asal_sekolah; ?></td></tr>
  <tr><td>Email</td><td><?php echo $email; ?></td></tr>
  <tr><td>Kode Prodi</td><td><?php echo $kode_prodi; ?></td></tr>
  <tr><td>File Foto</td><td><?php echo $file_foto; ?></td></tr>
  <tr><td>Status Ujian</td><td><?php echo $status_ujian; ?></td></tr>
  <tr><td></td><td><a href="<?php echo site_url('cmhs') ?>" class="btn btn-default">Cancel</a></td></tr>
</table>
