<h5><h1 class="page-header"><?php echo $title ?></h1></h5>
<table class="table">
    <tr><td>Kode Ujian</td><td><?php echo $kode_ujian; ?></td></tr>
    <tr><td>Kode Cmhs</td><td><?php echo $kode_cmhs; ?></td></tr>
    <tr><td>Kode Ruangan</td><td><?php echo $kode_ruangan; ?></td></tr>
    <tr><td>Status Ujian</td><td><?php echo $status_ujian; ?></td></tr>
    <tr>
        <td><a href="<?php echo site_url('peserta_ujian/kartu_ujian') ?>" class="btn btn-success btn-block">Proses Kartu Ujian</a></td>
        <td>
        	<a href="<?php echo site_url('beranda') ?>" class="btn btn-danger btn-block">Cancel</a>
        </td>
    </tr>
</table>
