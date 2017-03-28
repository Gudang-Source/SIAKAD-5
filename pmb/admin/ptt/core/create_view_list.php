<?php

$string = "
<h5><h1 class=\"page-header\"><?php echo \$title ?></h1></h5>
<div class=\"row\" style=\"margin-bottom: 10px\">
    <div class=\"col-md-6\">
        <?php echo anchor(site_url('".$c_url."/create'),'Create', 'class=\"btn btn-primary\"'); ?>
    </div>
    <div class=\"col-md-6 text-center\">
        <div style=\"margin-top: 8px\" id=\"message\">
            <?php echo \$this->session->userdata('message') <> '' ? \$this->session->userdata('message') : ''; ?>
        </div>
    </div>
</div>
<div class=\"row\" style=\"margin-bottom: 10px\">
  <table class=\"table table-bordered\">
      <tr>
          <th>No</th>";
        foreach ($non_pk as $row) {
        $string .= "\n\t\t<th>" . label($row['column_name']) . "</th>";
        }
        $string .= "\n\t\t<th>Action</th>
            </tr>";
        $string .= "<?php
        foreach ($" . $c_url . "_data as \$$c_url)
        {
            ?>
            <tr>";

        $string .= "\n\t\t\t<td width=\"80px\"><?php echo ++\$start ?></td>";
        foreach ($non_pk as $row) {
        $string .= "\n\t\t\t<td><?php echo $" . $c_url ."->". $row['column_name'] . " ?></td>";
        }


        $string .= "\n\t\t\t<td style=\"text-align:center\" width=\"200px\">"
        . "\n\t\t\t\t<?php "
        . "\n\t\t\t\techo anchor(site_url('".$c_url."/read/'.$".$c_url."->".$pk."),'Read'); "
        . "\n\t\t\t\techo ' | '; "
        . "\n\t\t\t\techo anchor(site_url('".$c_url."/update/'.$".$c_url."->".$pk."),'Update'); "
        . "\n\t\t\t\techo ' | '; "
        . "\n\t\t\t\techo anchor(site_url('".$c_url."/delete/'.$".$c_url."->".$pk."),'Delete','onclick=\"javasciprt: return confirm(\\'Are You Sure ?\\')\"'); "
        . "\n\t\t\t\t?>"
        . "\n\t\t\t</td>";

        $string .=  "\n\t\t</tr>
                <?php
            }
            ?>
  </table>
</div>
<div class=\"row\">
    <div class=\"col-md-6 \">
        <a href=\"#\" class=\"btn btn-primary\">Total Record : <?php echo \$total_rows ?></a>";
if ($export_excel == '1') {
$string .= "\n\t\t<?php echo anchor(site_url('".$c_url."/excel'), 'Excel', 'class=\"btn btn-primary\"'); ?>";
}
if ($export_word == '1') {
$string .= "\n\t\t<?php echo anchor(site_url('".$c_url."/word'), 'Word', 'class=\"btn btn-primary\"'); ?>";
}
if ($export_pdf == '1') {
$string .= "\n\t\t<?php echo anchor(site_url('".$c_url."/pdf'), 'PDF', 'class=\"btn btn-primary\"'); ?>";
}
$string .= "\n\t    </div>
    <div class=\"col-md-6  text-right\">
        <?php echo \$pagination ?>
    </div>
</div>";


$hasil_view_list = createFile($string, $target."views/" . $c_url . "/" . $v_list_file);

?>
