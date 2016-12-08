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
          <a href="#">
            <div class="col-sm-3 col-lg-5 widget-left">
              <svg class="glyph stroked bag"><use xlink:href="#stroked-bag"></use></svg>
            </div>
            <div class="col-sm-9 col-lg-7 widget-right">
              <div class="large">120</div>
              <div class="text-muted">Mahasiswa</div>
            </div>
          </a>
        </div>
      </div>
    </div>
    <div class="col-xs-12 col-md-6 col-lg-3">
      <div class="panel panel-orange panel-widget">
        <div class="row no-padding">
          <a href="#">
            <div class="col-sm-3 col-lg-5 widget-left">
              <svg class="glyph stroked empty-message"><use xlink:href="#stroked-empty-message"></use></svg>
            </div>
            <div class="col-sm-9 col-lg-7 widget-right">
              <div class="large">52</div>
              <div class="text-muted">Alumni</div>
            </div>
          </a>
        </div>
      </div>
    </div>
    <div class="col-xs-12 col-md-6 col-lg-3">
      <div class="panel panel-teal panel-widget">
        <div class="row no-padding">
          <a href="#">
            <div class="col-sm-3 col-lg-5 widget-left">
              <svg class="glyph stroked male-user"><use xlink:href="#stroked-male-user"></use></svg>
            </div>
            <div class="col-sm-9 col-lg-7 widget-right">
              <div class="large">24</div>
              <div class="text-muted">Dosen</div>
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
              <div class="large">25.2k</div>
              <div class="text-muted">Kariawan</div>
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
          <h4>Visitors</h4>
          <div class="easypiechart" id="easypiechart-red" data-percent="27" ><span class="percent">27%</span>
          </div>
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
              $i++;
              if ($i % 2 == 0) {
                ?>
                <li class="left clearfix">
                  <span class="chat-img pull-left">
                    <img src="http://placehold.it/80/30a5ff/fff" alt="User Avatar" class="img-circle" />
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
                    <img src="http://placehold.it/80/dde0e6/5f6468" alt="User Avatar" class="img-circle" />
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
        <div class="panel-heading dark-overlay"><svg class="glyph stroked clipboard-with-paper"><use xlink:href="#stroked-clipboard-with-paper"></use></svg>SISTEM INFORMASI KAMPUS</div>
        <div class="panel-body">
          <ul class="todo-list">
            <li class="todo-list-item">
              <div class="">
                <a href="#" class="btn btn-success btn-block">Website STMIK Adhi Guna</a>
              </div>
            </li>
            <li class="todo-list-item">
              <div class="">
                <a href="#" class="btn btn-success btn-block">Website STMIK Adhi Guna</a>
              </div>
            </li>
            <li class="todo-list-item">
              <div class="">
                <a href="#" class="btn btn-success btn-block">Website STMIK Adhi Guna</a>
              </div>
            </li>
            <li class="todo-list-item">
              <div class="">
                <a href="#" class="btn btn-success btn-block">Website STMIK Adhi Guna</a>
              </div>
            </li>
            <li class="todo-list-item">
              <div class="">
                <a href="#" class="btn btn-success btn-block">Website STMIK Adhi Guna</a>
              </div>
            </li>
          </ul>
        </div>
        <div class="panel-footer">

        </div>
      </div>

    </div><!--/.col-->
  </div><!--/.row-->
</div>	<!--/.main-->
