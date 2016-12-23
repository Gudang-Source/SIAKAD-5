<style>
video {
    width: 100%;
    height: auto;
}
</style>
<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">
  <div class="row">
    <div class="col-lg-12">
      <h1 class="page-header"><?php echo $title ?></h1>
    </div>
  </div><!--/.row-->

  <div class="row">
    <div class="col-xs-12 col-md-6 col-lg-3">
      <div class="panel panel-blue panel-widget ">
        <div class="row no-padding">
          <a href="http://stmikadhiguna.ac.id" target="_blank">
            <div class="col-sm-3 col-lg-5 widget-left">
              <svg class="glyph stroked bag"><use xlink:href="#stroked-bag"></use></svg>
            </div>
            <div class="col-sm-9 col-lg-7 widget-right">
              <div class="large">WEBSITE</div>
              <div class="text-muted">stmikadhiguna.ac.id</div>
            </div>
          </a>
        </div>
      </div>
    </div>
    <div class="col-xs-12 col-md-6 col-lg-3">
      <div class="panel panel-orange panel-widget">
        <div class="row no-padding">
          <a href="http://10.10.10.4/">
            <div class="col-sm-3 col-lg-5 widget-left">
              <svg class="glyph stroked empty-message"><use xlink:href="#stroked-empty-message"></use></svg>
            </div>
            <div class="col-sm-9 col-lg-7 widget-right">
              <div class="large">SIAKAD</div>
              <div class="text-muted">Sistem Akademik</div>
            </div>
          </a>
        </div>
      </div>
    </div>
    <div class="col-xs-12 col-md-6 col-lg-3">
      <div class="panel panel-teal panel-widget">
        <div class="row no-padding">
          <a href="http://scele.stmikadhiguna.ac.id">
            <div class="col-sm-3 col-lg-5 widget-left">
              <svg class="glyph stroked male-user"><use xlink:href="#stroked-male-user"></use></svg>
            </div>
            <div class="col-sm-9 col-lg-7 widget-right">
              <div class="large">SCELE</div>
              <div class="text-muted">E-Learning</div>
            </div>
          </a>
        </div>
      </div>
    </div>
    <div class="col-xs-12 col-md-6 col-lg-3">
      <div class="panel panel-red panel-widget">
        <div class="row no-padding">
          <a href="#">
            <div class="col-sm-3 col-lg-5 widget-left">
              <svg class="glyph stroked app-window-with-content"><use xlink:href="#stroked-app-window-with-content"></use></svg>
            </div>
            <div class="col-sm-9 col-lg-7 widget-right">
              <div class="large">Perpustakaan</div>
              <div class="text-muted">Digital Reader</div>
            </div>
          </a>
        </div>
      </div>
    </div>
  </div><!--/.row-->

  <div class="row">
    <div class="col-xs-6 col-md-3">
      <div class="panel panel-default">
        <div class="panel-body easypiechart-panel">
          <h4>Pengambilan KRS</h4>
          <div class="easypiechart" id="easypiechart-blue" data-percent="92" ><span class="percent">92%</span>
          </div>
        </div>
      </div>
    </div>
    <div class="col-xs-6 col-md-3">
      <div class="panel panel-default">
        <div class="panel-body easypiechart-panel">
          <h4>Tagihan Pembayaran</h4>
          <div class="easypiechart" id="easypiechart-orange" data-percent="65" ><span class="percent">65%</span>
          </div>
        </div>
      </div>
    </div>
    <div class="col-xs-6 col-md-3">
      <div class="panel panel-default">
        <div class="panel-body easypiechart-panel">
          <h4>Validasi KRS</h4>
          <div class="easypiechart" id="easypiechart-teal" data-percent="56" ><span class="percent">56%</span>
          </div>
        </div>
      </div>
    </div>
    <div class="col-xs-6 col-md-3">
      <div class="panel panel-default">
        <div class="panel-body easypiechart-panel">

        </div>
      </div>
    </div>
  </div><!--/.row-->

  <div class="row">
    <div class="col-md-8">
      <div class="panel panel-default chat">
        <div class="panel-heading" id="accordion"><svg class="glyph stroked two-messages"><use xlink:href="#stroked-two-messages"></use></svg> Pengumuman</div>
        <div class="panel-body">
          <ul>
            <?php
            $i=1;
            foreach ($pengumuman as $key) {
              if ($key->author == 'BAAK') {
                $img='baak';
              }
              elseif ($key->author == 'Prodi') {
                $img = 'prodi';
              }
              elseif ($key->author == 'Admin') {
                $img = 'admin';
              }
              else {
                $img = 'pengumuman';
              }
              $i++;
              if ($i % 2 == 0) {
                ?>
                <li class="left clearfix">
                  <span class="chat-img pull-left">
                    <img src="<?php echo base_url("assets/img/").$img.".png" ?>" alt="Pengumuman" class="img-circle" />
                  </span>
                  <div class="chat-body clearfix">
                    <div class="header">
                      <strong class="primary-font"><?php echo $key->judul ?></strong> <small class="text-muted"><?php echo $key->tanggal ?></small>
                    </div>
                    <p>
                      <?php echo $key->tentang ?>
                    </p>
                  </div>
                </li>
                <?php
              }
              else {
                ?>
                <li class="right clearfix">
                  <span class="chat-img pull-right">
                    <img src="<?php echo base_url("assets/img/").$img.".png" ?>" alt="User Avatar" class="img-circle" />
                  </span>
                  <div class="chat-body clearfix">
                    <div class="header">
                      <strong class="pull-left primary-font"><?php echo $key->judul ?></strong> <small class="text-muted"><?php echo $key->tanggal ?></small>
                    </div>
                    <p>
                      <?php echo $key->tentang ?>
                    </p>
                  </div>
                </li>
                <?php
              }
            }
            ?>
          </ul>
        </div>
        <div class="panel-footer">
          <b>Pengumuan Kampus</b>
        </div>
      </div>

    </div><!--/.col-->

    <div class="col-md-4">
      <div class="panel panel-blue">
        <div class="panel-heading dark-overlay"><svg class="glyph stroked clipboard-with-paper"><use xlink:href="#stroked-clipboard-with-paper"></use></svg>Baca Kode Batang</div>
        <div class="panel-body">
          <div class="col-md-12">
            <div class="thumbnail">
              <div class="caption">
                <video autoplay></video>
              </div>
            </div>
          </div>
        </div>
        <div class="panel-footer">

        </div>
      </div>
    </div><!--/.col-->
  </div><!--/.row-->
</div>	<!--/.main-->
