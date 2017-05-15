<h5><h1 class="page-header"><?php echo $title ?></h1></h5>
<table class="table">
  <tr>
    <td>Kode Daftar Ulang</td>
    <td><?php echo $kode_daftar_ulang; ?></td>
  </tr>
  <tr>
    <td>Nomor Ujian</td>
    <td><?php echo $kode_ujian; ?></td>
  </tr>
  <tr>
    <td>NIM</td>
    <td><?php echo $c_nim; ?></td>
  </tr>
  <tr>
    <td>No Telp</td>
    <td><?php echo $no_telp; ?></td>
  </tr>
  <tr>
    <td>Kode Ayah</td>
    <td><?php echo $kode_ayah; ?></td>
  </tr>
  <tr>
    <td>Kode Ibu</td>
    <td><?php echo $kode_ibu; ?></td>
  </tr>
  <tr>
    <td>Tgl Masuk</td>
    <td><?php echo $tgl_masuk; ?></td>
  </tr>
  <tr>
    <td>Kode Wilayah</td>
    <td><?php echo $kode_wilayah; ?></td>
  </tr>
  <tr>
    <td>Kode Status Awal</td>
    <td><?php echo $kode_status_awal; ?></td>
  </tr>
  <tr>
    <td>Kode Status Mhs</td>
    <td><?php echo $kode_status_mhs; ?></td>
  </tr>
  <tr>
    <td>File Ijasah</td>
    <td><?php echo $file_ijasah; ?></td>
  </tr>
  <tr>
    <td>
      <?php if ($status_sync=='N'): ?>
        <a href="<?php echo site_url('daftar_ulang/') ?>" class="btn btn-success btn-block">Sinkronisasi</a>
      <?php else: ?>
        <a href="#" class="btn btn-success btn-block">Telah Di Sinkronisasi</a>
      <?php endif; ?>
    </td>
    <td>
      <a href="<?php echo site_url('daftar_ulang/update/'.$id_daftar_ulang) ?>" class="btn btn-danger btn-block">Update</a>
    </td>
  </tr>
</table>
