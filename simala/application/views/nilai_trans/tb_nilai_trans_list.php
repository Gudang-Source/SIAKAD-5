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
                <h2 style="margin-top:0px">Tb_nilai_trans List</h2>
            </div>
            <div class="col-md-4 text-center">
                <div style="margin-top: 4px"  id="message">
                    <?php echo $this->session->userdata('message') <> '' ? $this->session->userdata('message') : ''; ?>
                </div>
            </div>
            <div class="col-md-4 text-right">
                <?php echo anchor(site_url('nilai_trans/create'), 'Create', 'class="btn btn-primary"'); ?>
		<?php echo anchor(site_url('nilai_trans/excel'), 'Excel', 'class="btn btn-primary"'); ?>
	    </div>
        </div>
        <table class="table table-bordered table-striped" id="mytable">
            <thead>
                <tr>
                    <th width="80px">No</th>
		    <th>Id Mhs Trans</th>
		    <th>Id Mk</th>
		    <th>Kode Mk Asal</th>
		    <th>Nm Mk Asal</th>
		    <th>Sks Asal</th>
		    <th>Sks Diakui</th>
		    <th>Nilai Huruf Asal</th>
		    <th>Nilai Huruf Diakui</th>
		    <th>Nilai Angka Diakui</th>
		    <th>Action</th>
                </tr>
            </thead>
	    <tbody>
            <?php
            $start = 0;
            foreach ($nilai_trans_data as $nilai_trans)
            {
                ?>
                <tr>
		    <td><?php echo ++$start ?></td>
		    <td><?php echo $nilai_trans->id_mhs_trans ?></td>
		    <td><?php echo $nilai_trans->id_mk ?></td>
		    <td><?php echo $nilai_trans->kode_mk_asal ?></td>
		    <td><?php echo $nilai_trans->nm_mk_asal ?></td>
		    <td><?php echo $nilai_trans->sks_asal ?></td>
		    <td><?php echo $nilai_trans->sks_diakui ?></td>
		    <td><?php echo $nilai_trans->nilai_huruf_asal ?></td>
		    <td><?php echo $nilai_trans->nilai_huruf_diakui ?></td>
		    <td><?php echo $nilai_trans->nilai_angka_diakui ?></td>
		    <td style="text-align:center" width="200px">
			<?php 
			echo anchor(site_url('nilai_trans/read/'.$nilai_trans->id_nilai_trans),'Read'); 
			echo ' | '; 
			echo anchor(site_url('nilai_trans/update/'.$nilai_trans->id_nilai_trans),'Update'); 
			echo ' | '; 
			echo anchor(site_url('nilai_trans/delete/'.$nilai_trans->id_nilai_trans),'Delete','onclick="javasciprt: return confirm(\'Are You Sure ?\')"'); 
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