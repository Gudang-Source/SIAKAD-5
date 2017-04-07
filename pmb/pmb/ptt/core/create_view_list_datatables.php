<?php

$string = "
<div class=\"row-fluid\">
  <div class=\"col-md-4\">
      <h5><h1 class=\"page-header\"><?php echo \$title ?></h1></h5>
  </div>
  <div class=\"col-md-4 text-center\">
      <div id=\"message\">
          <?php echo \$this->session->userdata('message') <> '' ? \$this->session->userdata('message') : ''; ?>
      </div>
  </div>
  <div class=\"col-md-4 text-right\">
      <?php echo anchor(site_url('".$c_url."/create'), 'Create', 'class=\"btn btn-primary\"'); ?>";
      if ($export_excel == '1') {
          $string .= "\n\t\t<?php echo anchor(site_url('".$c_url."/excel'), 'Excel', 'class=\"btn btn-primary\"'); ?>";
      }
      if ($export_word == '1') {
          $string .= "\n\t\t<?php echo anchor(site_url('".$c_url."/word'), 'Word', 'class=\"btn btn-primary\"'); ?>";
      }
      if ($export_pdf == '1') {
          $string .= "\n\t\t<?php echo anchor(site_url('".$c_url."/pdf'), 'PDF', 'class=\"btn btn-primary\"'); ?>";
      }
      $string .= "\n\t
  </div>
</div>
<div class=\"row-fluid\">
  <div class=\"col-md-12\">
    <div class=\"col-md-12\"> <span class=\"icon\"><i class=\"icon-th\"></i></span>
      <h5>".ucfirst($table_name)."</h5>
    </div>
    <div class=\"col-md-12\">
      <table class=\"table table-bordered table-striped data-table\" id=\"\">
        <thead>
            <tr>
              <th>No</th>";
              foreach ($non_pk as $row) {
                  $string .= "\n\t\t    <th>" . label($row['column_name']) . "</th>";
              }
              $string .= "\n\t\t
              <th>Action</th>
            </tr>
        </thead>";
        $string .= "\n\t
        <tbody>
            <?php
            \$start = 0;
            foreach ($" . $c_url . "_data as \$$c_url)
            {
                ?>
                <tr>";

                $string .= "\n\t\t    <td><?php echo ++\$start ?></td>";

                foreach ($non_pk as $row) {
                    $string .= "\n\t\t    <td><?php echo $" . $c_url ."->". $row['column_name'] . " ?></td>";
                }

                $string .= "\n\t\t    <td style=\"text-align:center\" width=\"200px\">"
                        . "\n\t\t\t<?php "
                        . "\n\t\t\techo anchor(site_url('".$c_url."/read/'.$".$c_url."->".$pk."),'Read'); "
                        . "\n\t\t\techo ' | '; "
                        . "\n\t\t\techo anchor(site_url('".$c_url."/update/'.$".$c_url."->".$pk."),'Update'); "
                        . "\n\t\t\techo ' | '; "
                        . "\n\t\t\techo anchor(site_url('".$c_url."/delete/'.$".$c_url."->".$pk."),'Delete','onclick=\"javasciprt: return confirm(\\'Are You Sure ?\\')\"'); "
                        . "\n\t\t\t?>"
                        . "\n\t\t    </td>";

                $string .=  "\n\t
                </tr>
          <?php
      }
      ?>
        </tbody>
      </table>
    </div>
  </div>
  </div>
</div>";
$hasil_view_list = createFile($string, $target."views/" . $c_url . "/" . $v_list_file);

?>