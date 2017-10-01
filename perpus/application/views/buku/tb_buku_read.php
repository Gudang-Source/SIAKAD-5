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
        <h2 style="margin-top:0px">Tb_buku Read</h2>
        <table class="table">
	    <tr><td>Id Rak</td><td><?php echo $id_rak; ?></td></tr>
	    <tr><td>Id Penerbit</td><td><?php echo $id_penerbit; ?></td></tr>
	    <tr><td>Nm Buku</td><td><?php echo $nm_buku; ?></td></tr>
	    <tr><td>Thn Terbit</td><td><?php echo $thn_terbit; ?></td></tr>
	    <tr><td>Nm Penulis</td><td><?php echo $nm_penulis; ?></td></tr>
	    <tr><td></td><td><a href="<?php echo site_url('buku') ?>" class="btn btn-default">Cancel</a></td></tr>
	</table>
        </body>
</html>