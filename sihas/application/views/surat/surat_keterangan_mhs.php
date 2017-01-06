<img class="kop" height="128px" src="<?php echo base_url('assets/img/kop.png') ?>" alt="" />.
<p style="text-align=:center">
  <center>
    <?php
    $array_bulan = array(1=>"I","II","III", "IV", "V","VI","VII","VIII","IX","X", "XI","XII");
    $array_bulan_huruf = array(1=>"Januari","Februari","Maret", "April", "Mei","Juni","Juli","Agustus","September","Oktober", "November","Desember");
    $bulan = $array_bulan[date('n')];
    ?>
    <b><u>SURAT KETERANGAN STATUS MAHASISWA</u></b><br>
    <b>Nomor : </b> .............../J.3111.01/KM.515/<?php echo $bulan ?>/<?php echo date("Y"); ?>
  </center>
</p>
<p>

</p>
<br>
<br>

<p>
  Ketua Sekolah Tinggi Manajemen Informatika dan Komputer Adhi Guna menyatakan dengan sebenar-benarnya bahwa :
</p>
<br>
<br>
<?php
$angkatan_ = substr($angkatan,0,4);
 ?>
 <table class="id_laporan">
   <tbody>
     <tr>
       <td width="200px">Nama Mahasiswa</td>
       <td width="20px">:</td>
       <td> <?php echo $nm_mhs ?></td>
     </tr>
     <tr>
       <td>NIM </td>
       <td>:</td>
       <td> <?php echo $nim ?></td>
     </tr>
     <tr>
       <td>TTL </td>
       <td>:</td>
       <td><?php echo $ttl ?></td>
     </tr>
     <tr>
       <td>Jurusan/Program Studi </td>
       <td>:</td>
       <td><?php echo $nm_prodi ?></td>
     </tr>
     <tr>
       <td>Angkatan </td>
       <td>:</td>
       <td><?php echo $angkatan_ ?></td>
     </tr>
   </tbody>
 </table>
 <br>
 <br>
 <?php
 $tahun = substr($ta,0,4);
 $akad = substr($ta,4,1);
 $prodi = strtolower($nm_prodi);
 $prodi = explode(" ",$prodi);
 $prodi_1 = ucfirst($prodi[0]);
 $prodi_2 = ucfirst($prodi[1]);
 if ($akad="1") {
   $smt = "Ganjil";
 }
 else {
   $smt="Genap";
 }

  ?>
 <p align="justify">
   Adalah benar mahasiswa Program Sarjana Strata 1 (S1) dan telah teregistrasi di Semester <?php echo $smt ?> Tahun Akademik <?php echo $tahun ?>/<?php echo $tahun+1 ?> pada Sekolah Tinggi Manajemen Informatika dan Komputer (STMIK) Adhi Guna.
 </p>
 <br>
 <br>
 <br>
 <table class="ttd_laporan">
   <tbody>
     <tr>
       <td colspan="4" width="60%"></td>
       <?php
        $bulan_hur= $array_bulan_huruf[date("n")];
        ?>
       <td>Palu, <?php echo date('d') ?> <?php echo $bulan_hur ?> <?php echo date("Y") ?></td>
     </tr>
     <tr>
       <td colspan="4"></td>
       <td>a.n Ketua STMIK Adhi Guna</td>
     </tr>
     <tr>
       <td colspan="4"></td>
       <td>Ketua Program Studi <?php echo $prodi_1." ".$prodi_2 ?></td>
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
       <td><br></td>
     </tr>
     <tr>
       <td colspan="4"></td>
       <td><b><u><?php echo $ket_prodi ?></u></b></td>
     </tr>
     <tr>
       <td colspan="4"></td>
       <td><b>NIK. 140 201 0..</b></td>
     </tr>
   </tbody>
 </table>
