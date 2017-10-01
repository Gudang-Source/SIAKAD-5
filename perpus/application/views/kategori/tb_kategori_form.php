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
        <h2 style="margin-top:0px">Tb_kategori <?php echo $button ?></h2>
        <form action="<?php echo $action; ?>" method="post">
	    <div class="form-group">
            <label for="varchar">Nm Kategori <?php echo form_error('nm_kategori') ?></label>
            <input type="text" class="form-control" name="nm_kategori" id="nm_kategori" placeholder="Nm Kategori" value="<?php echo $nm_kategori; ?>" />
        </div>
	    <input type="hidden" name="id_kategori" value="<?php echo $id_kategori; ?>" /> 
	    <button type="submit" class="btn btn-primary"><?php echo $button ?></button> 
	    <a href="<?php echo site_url('kategori') ?>" class="btn btn-default">Cancel</a>
	</form>
    </body>
</html>