<!doctype html>
<html>
    <head>
        <title>harviacode.com - codeigniter crud generator</title>
        <link rel="stylesheet" href="<?php echo base_url('assets/bootstrap/css/bootstrap.min.css') ?>"/>
        <style>
            body{
                padding: 15px;
            }
        </style>
    </head>
    <body>
        <h2 style="margin-top:0px">Tb_nilai_trans Read</h2>
        <table class="table">
	    <tr><td>Id Mhs Trans</td><td><?php echo $id_mhs_trans; ?></td></tr>
	    <tr><td>Id Mk</td><td><?php echo $id_mk; ?></td></tr>
	    <tr><td>Kode Mk Asal</td><td><?php echo $kode_mk_asal; ?></td></tr>
	    <tr><td>Nm Mk Asal</td><td><?php echo $nm_mk_asal; ?></td></tr>
	    <tr><td>Sks Asal</td><td><?php echo $sks_asal; ?></td></tr>
	    <tr><td>Sks Diakui</td><td><?php echo $sks_diakui; ?></td></tr>
	    <tr><td>Nilai Huruf Asal</td><td><?php echo $nilai_huruf_asal; ?></td></tr>
	    <tr><td>Nilai Huruf Diakui</td><td><?php echo $nilai_huruf_diakui; ?></td></tr>
	    <tr><td>Nilai Angka Diakui</td><td><?php echo $nilai_angka_diakui; ?></td></tr>
	    <tr><td></td><td><a href="<?php echo site_url('nilai_trans') ?>" class="btn btn-default">Cancel</a></td></tr>
	</table>
        </body>
</html>