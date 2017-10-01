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
        <h2 style="margin-top:0px">Tb_rak <?php echo $button ?></h2>
        <form action="<?php echo $action; ?>" method="post">
	    <div class="form-group">
            <label for="int">Id Kategori <?php echo form_error('id_kategori') ?></label>
            <input type="text" class="form-control" name="id_kategori" id="id_kategori" placeholder="Id Kategori" value="<?php echo $id_kategori; ?>" />
        </div>
	    <div class="form-group">
            <label for="varchar">Nm Rak <?php echo form_error('nm_rak') ?></label>
            <input type="text" class="form-control" name="nm_rak" id="nm_rak" placeholder="Nm Rak" value="<?php echo $nm_rak; ?>" />
        </div>
	    <input type="hidden" name="id_rak" value="<?php echo $id_rak; ?>" /> 
	    <button type="submit" class="btn btn-primary"><?php echo $button ?></button> 
	    <a href="<?php echo site_url('rak') ?>" class="btn btn-default">Cancel</a>
	</form>
    </body>
</html>