<style>
th,td,p,div,b ... {margin:0;padding:0}
html{
  margin-top: 40px ;
  margin-left: 10px;
  margin-right: 10px;
  margin-bottom: 5px;
}

table.laporan {
  border-collapse: collapse;
  width: 100%;
}
table.laporan td,
table.laporan th {
  border: 1px solid black;
  padding: 5px;
}
table.identitas td,
table.identitas th{
  font-size: 8;
}

table.batas td,
table.batas th{
  font-size: 10;
}
</style>
<p>
  <center><b><u>Kartu Tanda Mahasiswa</u></b></center>
</p>
<table width="100%" class="identitas">
  <tbody>
    <tr>
      <td width="10px">Nama</td>
      <td width="2px">:</td>
      <td> <?php echo $mhs->nm_mhs ?></td>
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
    <tr>
      <td><img src="<?php echo $qr ?>" alt="" /></td>
      <td></td>
      <td></td>
    </tr>
  </tbody>
</table>
<table class="batas">
  <tr>
    <td><b>Berlaku Hingga</b></td>
    <td><b>:</b></td>
    <td><b></b></td>
  </tr>
</table>
