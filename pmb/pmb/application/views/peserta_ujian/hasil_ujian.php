<div class="col-md-12">
  <div class="widget-title"> <span class="icon"><i class="icon-th"></i></span>
    <h5><h1 class="page-header"><?php echo $title ?></h1></h5>
  </div>
  <div class="col-md-12">
    <center><h3><b>PENGUMUMAN</b></h3></center>
    <p>Berdasarkan Surat Keputusan Ketua STMIK Adhi Guna Nomor xx/xx/xx/xx/xx/xx/</p>
    <hr>
    <table class="table">
      <tbody>
        <tr>
          <td>Nilai Wawancara</td>
          <td>:</td>
          <td><?php echo $n_wawancara ?></td>
        </tr>
        <tr>
          <td>Nilai Umum</td>
          <td>:</td>
          <td><?php echo $n_umum ?></td>
        </tr>
        <tr>
          <td>Nilai Psikotes</td>
          <td>:</td>
          <td><?php echo $n_psikotes ?></td>
        </tr>
        <tr>
          <td colspan="1">Total</td>
          <td>:</td>
          <td><?php echo $n_psikotes+$n_umum+$n_wawancara ?></td>
        </tr>
        <tr>
          <td colspan="1">Rata-rata</td>
          <td>:</td>
          <td>
            <?php if (($n_psikotes+$n_umum+$n_wawancara)/3): ?>
              <span class="label label-success"><?php echo ($n_psikotes+$n_umum+$n_wawancara)/3 ?></span>
            <?php else: ?>
              <span class="label label-danger"><?php echo ($n_psikotes+$n_umum+$n_wawancara)/3 ?></span>
            <?php endif; ?>
          </td>
        </tr>
        <tr>
          <?php if ($status_ujian=='L'): ?>
            <td colspan="3">
              <center>
                <h3>
                  <span class="label label-success">SELAMAT ANDA LULUS</span>
                </h3>
              </center>
              <hr />
              <div class="col-md-12">
                <b>A. Catatan : </b>
                <p>
                  <ol>
                    <li>
                      Bagi Calon Mahasiswa Yang Dinyatakan Lulus Wajib Melakukan Pendaftaran Ulang <a href="<?php echo site_url('daftar_ulang') ?>"> Disini</a>, Lengkapi seluruh data anda dengan baik dan benar agar resiko kesalahan dan kekurangan data pada bagian Sistem Akademik Dapat Diminimalisir
                    </li>
                    <li>Bagi Calon Mahasiswa Yang Ingin Pindah Jurusan Agar Segera Menghubungi PANITIA</li>
                  </ol>
                </p>
                <hr>
                <b>B. Pemberitahuan : </b>
                <p>
                  <ol>
                    <li>Untuk Melakukan <b><i>Sinkronisasi (Aktif Sebagai Mahasiswa STMIK Adhi Guna)</i></b> Calon Mahasiswa diwajibkan membayar <b><i>Rp. 1.000.000-,</i></b> Dari Total Pembayaran Semester Hingga Tanggal <b>2 Agustus 2017</b>, Sisa uang Pembayaran SPP dapat diangsur sampai tanggal <b>xx Oktober 2017</b>.
                    </li>
                    <li>
                      Pembayaran Dana Pembangunan Dapat Diangsur Hingga Tanggal <b>xx Oktober 2017</b>.
                    </li>
                  </ol>
                </p>
                <hr>
                <b>C. Tata Cara Pembayaran SPP Bagi Calon Mahasiswa</b>
                <p>
                  <ol>
                    <li>Mengambil SLIP Pembayaran SPP Dibagian Keuangan (Bendahara)</li>
                    <li>Pembayaran Dapat Dilakukan Di Seluruh Bank BRI dengan Menyerahkan SLIP Pembayaran Pada Teller</li>
                    <li>Lakukan Registrasi Pembayaran Dibagian Keuangan (Bendahara) Dengan Membawa SLIP Pembayaran Yang Sudah Di Validasi Oleh Bank</li>
                    <li>Anda Akan Diberikan Nomor TOKEN, Simpan Nomor Token Untuk Di Masukan Pada Proses Sinkronisasi </li>
                    <li>Melakukan Pendaftaran Ulang Sesuai Dengan Catatan, Jika Telah Melakukan Pendaftaran Ulang Tekan Tombol Sinkronisasi (Jika Sinkronisasi Sukses Maka Tombol Akan Berubah Menjadi Merah), Anda Akan Diminta Untuk Memasukan TOKEN (Isi Dengan Benar)</li>
                    <li>Melakukan Verifikasi Sinkronisasi SIAKAD Dibagian BAAK dengan membawa SLIP Pembayaran Yang Telah Terigistrasi Bagian Keuangan (Agar NIM dan Kartu Mahasiswa Dapat Diaktifkan)</li>
                    <li>Jika Proses Verifikasi Selesai Anda Akan Diberikan AKUN,Password Dan Periode. Silahkan Login Di Sistem Hasil Analisa Studi Anda</li>
                  </ol>
                </p>
                <hr>
                <b>D. Pelaksanaan Program Pengenalan Perguruan Tinggi (P3T)</b>
                <p>
                  <ol>
                    <li>
                      Pendaftaran P3T di Mulai Pada tanggal <b>1 September 2017</b> s/d <b>7 September 2017</b>
                    </li>
                    <li>Pendaftaran Dapat Dilakukan Di Sekretariat Badan Eksekutif Mahasiswa (BEM)</li>
                    <li>
                      Biaya Pendaftaran P3T Sebesar <b><i>Rp. 50.000,-</i></b>
                    </li>
                    <li>P3T Dilaksanakan Pada Tanggal <b>8 September 2017</b> s/d <b>11 September 2017</b></li>
                  </ol>
                </p>
              </div>
            </td>
          <?php else: ?>
            <td colspan="3">
              <center>
                <h3>
                  <span class="label label-danger">MAAF ANDA TIDAK LULUS</span>
                </h3>
              </center>
              <hr />
              <div class="col-md-12">

              </div>
            </td>
          <?php endif; ?>
        </tr>
      </tbody>
    </table>
  </div>
</div>
