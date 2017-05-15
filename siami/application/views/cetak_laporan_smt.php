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
      <td width="150px">Jenis Bayar </td>
      <td width="5px">:</td>
      <td> <?php echo $jenis_bayar ?></td>
      <td width="100px">Tahun </td>
      <td width="5px">:</td>
      <td> <?php echo $tahun ?></td>
    </tr>
    <tr>
      <td>Periode </td>
      <td>:</td>
      <td> <?php echo $ta ?></td>
      <td>Jurusan</td>
      <td>:</td>
      <td> <?php echo $jurusan ?></td>
    </tr>
  </tbody>
</table>
<br>
<table border="1px" width="100%" class="laporan">
  <thead>
    <tr>
      <th width='40px'>No</th>
      <th>NIM</th>
      <th>Nama</th>
      <th>Tanggal Bayar</th>
      <th>Status</th>
      <th>Bayar</th>
    </tr>
  </thead>
  <tbody>
    <!-- <?php echo json_encode($data_laporan) ?> -->
    <?php
    $no=1;
     ?>
    <?php foreach ($data_laporan as $key): ?>
    <tr>
      <td><?php echo $no++ ?></td>
      <td><?php echo $key->nim ?></td>
      <td><?php echo $key->nama ?></td>
      <td><?php echo $key->tgl_byr ?></td>
      <td><?php echo $key->statusbayar ?></td>
      <td><?php echo $key->jumlah_bayar ?></td>
      <?php
      $total += $key->jumlah_bayar;
       ?>
    </tr>
    <?php endforeach; ?>
  </tbody>
  <tfoot>
    <tr>
      <th colspan="5">Total</th>
      <th><?php echo $total ?></th>
    </tr>
  </tfoot>
</table>
<br>
<table class="" width="100%">
  <tbody>
    <tr>
      <td colspan="4" width="60%"></td>
      <?php $t=time();?>
      <td>Palu, <?php echo date("Y-m-d",$t) ?></td>
    </tr>
    <tr>
      <td colspan="4"></td>
      <td>Bendahara</td>
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
      <td><br></td>
    </tr>
    <tr>
      <td colspan="4"></td>
      <td><u>Herlinawati Ridwan, S.Kom</u></td>
    </tr>
    <tr>
      <td colspan="4"></td>
      <td>NIK. 140 201 000</td>
    </tr>
  </tbody>
</table>
