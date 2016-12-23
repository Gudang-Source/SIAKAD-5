<style>
th,td,p,div,b ... {margin:0;padding:0}
html{margin:50px 50px}

table.laporan {
  border-collapse: collapse;
  width: 100%;
}
table.laporan td,
table.laporan th {
  border: 1px solid black;
  padding: 5px;
}
</style>
<table width="100%">
  <tbody>
    <tr>
      <td width="150px">Nama Mahasiswa </td>
      <td width="5px">:</td>
      <td> <?php echo $mhs->nm_mhs ?></td>
      <td width="100px">Tanggal </td>
      <td width="5px">:</td>
      <td> <?php echo date('D-M-Y') ?></td>
    </tr>
    <tr>
      <td>NIM </td>
      <td>:</td>
      <td> <?php echo $mhs->nim ?></td>
    </tr>
    <tr>
      <td>Jurusan</td>
      <td>:</td>
      <td> <?php echo $mhs->nm_prodi ?></td>
    </tr>
  </tbody>
</table>

<img src="<?php echo $qr ?>" alt="" /> 
