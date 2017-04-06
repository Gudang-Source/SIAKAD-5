
        <h5><h1 class="page-header"><?php echo $title ?></h1></h5>
        <table class="table">
	    <tr><td>Kode Ujian</td><td><?php echo $kode_ujian; ?></td></tr>
	    <tr><td>Kode Cmhs</td><td><?php echo $kode_cmhs; ?></td></tr>
	    <tr><td>Kode Ruangan</td><td><?php echo $kode_ruangan; ?></td></tr>
	    <tr><td>N Wawancara</td><td><?php echo $n_wawancara; ?></td></tr>
	    <tr><td>N Psikotes</td><td><?php echo $n_psikotes; ?></td></tr>
	    <tr><td>N Bhs</td><td><?php echo $n_bhs; ?></td></tr>
	    <tr><td>N Umum</td><td><?php echo $n_umum; ?></td></tr>
	    <tr><td>Status Ujian</td><td><?php echo $status_ujian; ?></td></tr>
	    <tr><td></td><td><a href="<?php echo site_url('peserta_ujian') ?>" class="btn btn-default">Cancel</a></td></tr>
	</table>