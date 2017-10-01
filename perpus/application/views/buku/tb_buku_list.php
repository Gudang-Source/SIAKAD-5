<!doctype html>
<html>
    <head>
        <title>harviacode.com - codeigniter crud generator</title>
        <link rel="stylesheet" href="<?php echo base_url('assets/bootstrap/css/bootstrap.min.css') ?>"/>
        <link rel="stylesheet" href="<?php echo base_url('assets/datatables/dataTables.bootstrap.css') ?>"/>
        <style>
            body{
                padding: 15px;
            }
        </style>
    </head>
    <body>
        <div class="row" style="margin-bottom: 10px">
            <div class="col-md-4">
                <h2 style="margin-top:0px">Tb_buku List</h2>
            </div>
            <div class="col-md-4 text-center">
                <div style="margin-top: 4px"  id="message">
                    <?php echo $this->session->userdata('message') <> '' ? $this->session->userdata('message') : ''; ?>
                </div>
            </div>
            <div class="col-md-4 text-right">
                <?php echo anchor(site_url('buku/create'), 'Create', 'class="btn btn-primary"'); ?>
		<?php echo anchor(site_url('buku/excel'), 'Excel', 'class="btn btn-primary"'); ?>
	    </div>
        </div>
        <table class="table table-bordered table-striped" id="mytable">
            <thead>
                <tr>
                    <th width="80px">No</th>
		    <th>Id Rak</th>
		    <th>Id Penerbit</th>
		    <th>Nm Buku</th>
		    <th>Thn Terbit</th>
		    <th>Nm Penulis</th>
		    <th>Action</th>
                </tr>
            </thead>
	    <tbody>
            <?php
            $start = 0;
            foreach ($buku_data as $buku)
            {
                ?>
                <tr>
		    <td><?php echo ++$start ?></td>
		    <td><?php echo $buku->id_rak ?></td>
		    <td><?php echo $buku->id_penerbit ?></td>
		    <td><?php echo $buku->nm_buku ?></td>
		    <td><?php echo $buku->thn_terbit ?></td>
		    <td><?php echo $buku->nm_penulis ?></td>
		    <td style="text-align:center" width="200px">
			<?php 
			echo anchor(site_url('buku/read/'.$buku->id_buku),'Read'); 
			echo ' | '; 
			echo anchor(site_url('buku/update/'.$buku->id_buku),'Update'); 
			echo ' | '; 
			echo anchor(site_url('buku/delete/'.$buku->id_buku),'Delete','onclick="javasciprt: return confirm(\'Are You Sure ?\')"'); 
			?>
		    </td>
	        </tr>
                <?php
            }
            ?>
            </tbody>
        </table>
        <script src="<?php echo base_url('assets/js/jquery-1.11.2.min.js') ?>"></script>
        <script src="<?php echo base_url('assets/datatables/jquery.dataTables.js') ?>"></script>
        <script src="<?php echo base_url('assets/datatables/dataTables.bootstrap.js') ?>"></script>
        <script type="text/javascript">
            $(document).ready(function () {
                $("#mytable").dataTable();
            });
        </script>
    </body>
</html>