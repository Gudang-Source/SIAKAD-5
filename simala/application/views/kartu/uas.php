<style>
th,td,p,div,b ... {
  margin:0;
  padding:0;
}
html{
  margin-top: 30px;
  margin-left: 10px;
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
.qrcode{
  padding-left: 330px;
}
</style>
<table width="100%" style="font-size:10;">
  <tbody>
    <tr>
      <td width="150px">Nama Mahasiswa </td>
      <td width="5px">:</td>
      <td> <?php echo $mhs->nm_mhs ?></td>
      <td rowspan="3" class="qrcode">
        <img src="<?php echo $qr ?>" alt="no_image" />
      </td>
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

    </tr>
  </tbody>
</table>
<table class="laporan" style="font-size:8;">
  <thead>
    <tr>
      <th>No.</th>
      <th>Kode MK</th>
      <th>Nama MK</th>
      <th>SKS</th>
      <th>Dosen Pengampu</th>
      <th>Dosen Pengawas</th>
      <th>Paraf</th>
    </tr>
  </thead>
  <tbody>
    <?php $no=1; ?>
    <?php foreach ($data_krs as $key ): ?>
      <tr>
        <td align="center"><?php echo $no++ ?></td>
        <td><?php echo $key->id_matkul ?></td>
        <td><?php echo $key->nm_mk ?></td>
        <td align="center"><?php echo $key->sks ?></td>
        <td><?php echo $key->nm_dosen ?></td>
        <td></td>
        <td></td>
      </tr>
    <?php endforeach; ?>
  </tbody>
</table>
<br><br>
<table class="ttd_laporan" style="font-size:10;">
  <tbody>
    <tr>
      <td colspan="4" width="60%"></td>
      <td>Palu, 07 Januari 2017</td>
    </tr>
    <tr>
      <td colspan="4"></td>
      <td>Ketua Panitia UAS</td>
    </tr>
    <tr>
      <td colspan="4"></td>
      <td><br></td>
    </tr>
    <tr>
      <td colspan="4"></td>
      <td><br></td>
    </tr>
    <tr>
      <td colspan="4"></td>
      <td><b><u>Mohammad Andika, S.Sos,. M.Ap</u></b></td>
    </tr>
    <tr>
      <td colspan="4"></td>
      <td><b>NIK. 140 201 031</b></td>
    </tr>
  </tbody>
</table>
