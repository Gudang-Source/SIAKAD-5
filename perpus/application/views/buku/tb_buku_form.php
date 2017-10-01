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
        <h2 style="margin-top:0px">Tb_buku <?php echo $button ?></h2>
        <form action="<?php echo $action; ?>" method="post">
	    <div class="form-group">
            <label for="int">Id Rak <?php echo form_error('id_rak') ?></label>
            <input type="text" class="form-control" name="id_rak" id="id_rak" placeholder="Id Rak" value="<?php echo $id_rak; ?>" />
        </div>
	    <div class="form-group">
            <label for="int">Id Penerbit <?php echo form_error('id_penerbit') ?></label>
            <input type="text" class="form-control" name="id_penerbit" id="id_penerbit" placeholder="Id Penerbit" value="<?php echo $id_penerbit; ?>" />
        </div>
	    <div class="form-group">
            <label for="varchar">Nm Buku <?php echo form_error('nm_buku') ?></label>
            <input type="text" class="form-control" name="nm_buku" id="nm_buku" placeholder="Nm Buku" value="<?php echo $nm_buku; ?>" />
        </div>
	    <div class="form-group">
            <label for="date">Thn Terbit <?php echo form_error('thn_terbit') ?></label>
            <input type="text" class="form-control" name="thn_terbit" id="thn_terbit" placeholder="Thn Terbit" value="<?php echo $thn_terbit; ?>" />
        </div>
	    <div class="form-group">
            <label for="varchar">Nm Penulis <?php echo form_error('nm_penulis') ?></label>
            <input type="text" class="form-control" name="nm_penulis" id="nm_penulis" placeholder="Nm Penulis" value="<?php echo $nm_penulis; ?>" />
        </div>
	    <input type="hidden" name="id_buku" value="<?php echo $id_buku; ?>" /> 
	    <button type="submit" class="btn btn-primary"><?php echo $button ?></button> 
	    <a href="<?php echo site_url('buku') ?>" class="btn btn-default">Cancel</a>
	</form>
    </body>
</html>