<div class="page-head">
  <div class="page-title">

      <h1>Portal
          <small>Where next?</small>
      </h1>
  </div>
</div>

<div class="row">
  <div class="col-md-8 col-sm-8">

    <div class="portlet light">
      <div class="portlet-title">
        <div class="caption">
          <span class="caption-subject bold uppercase">My Duties</span>
          <span class="caption-helper">to book on or not to book on, 'tis the question...</span>
        </div>
      </div>
      <div class="portlet-body">
        <table class="table table-striped table-bordered table-advance table-hover">
          <thead>
            <th>Day</th>
            <th>Callsign</th>
            <th>Role</th>
            <th>Vehicle</th>
            <th>Action</th>
          </thead>
          <tbody>
            <?php getMyDuties(); ?>
          </tbody>
        </table>
      </div>
    </div>

  </div>
  <div class="col-md-4 col-sm-4">

    <div class="portlet light">
      <div class="portlet-title">
        <div class="caption">
          <span class="caption-subject bold uppercase">Links</span>
          <span class="caption-helper">What do you need next?</span>
        </div>
      </div>
      <div class="portlet-body">

        <div class="row">
          <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <a class="dashboard-stat dashboard-stat-v2 blue" href="mdt.php">
              <div class="visual" style="padding-top: 0px; margin-bottom: 15px;">
                <i class="fa fa-desktop"></i>
              </div>
              <div class="details">
                <div class="number">
                  <b>MDT</b>
                </div>
                <div class="desc"><i></i>Mobile Data Terminal</div>
              </div>
            </a>
          </div>
        </div>
        <br>
        <div class="row">
          <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <a class="dashboard-stat dashboard-stat-v2 yellow-gold" href="cad.php">
              <div class="visual" style="padding-top: 0px; margin-bottom: 15px;">
                <i class="fa fa-map-marker"></i>
              </div>
              <div class="details">
                <div class="number">
                  <b>CAD</b>
                </div>
                <div class="desc"><i></i>Computer Aided Dispatch</div>
              </div>
            </a>
          </div>
        </div>
        <br>
        <?php

        $rank = getShortRank();

        if (in_array($_SESSION["UserID"], $bypass)) {

          $rank = "COMM";

        }

        if (in_array($rank, $tase)) {

          echo '
          <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
              <a class="dashboard-stat dashboard-stat-v2 purple" href="tase">
                <div class="visual" style="padding-top: 0px; margin-bottom: 15px;">
                  <i class="fa fa-eye"></i>
                </div>
                <div class="details">
                  <div class="number">
                    <b>TASE</b>
                  </div>
                  <div class="desc"><i></i>The All Seeing Eye</div>
                </div>
              </a>
            </div>
          </div>
          <br>
          ';

        }

         ?>
        <div class="row">
          <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <a class="dashboard-stat dashboard-stat-v2 red" href="index.php?logout">
              <div class="visual" style="padding-top: 0px; margin-bottom: 15px;">
                <i class="fa fa-sign-out"></i>
              </div>
              <div class="details">
                <div class="number">
                  <b>Logout</b>
                </div>
                <div class="desc"><i></i>Adios!</div>
              </div>
            </a>
          </div>
        </div>

      </div>
    </div>

  </div>
</div>

<script>
function popup_bookshift(day) {

  var url = "popup_bookshift.php?day="+day;
	var w = 300;
  var h = 250;
  var left = Number((screen.width/2)-(w/2));
  var tops = Number((screen.height/2)-(h/2));
  window.open(url, '_blank', 'toolbar=no, scrollbars=no, resizable=yes, titlebar=no, width='+w+', height='+h+', top='+tops+', left='+left);

}

function popup_editshift(day) {

  var url = "popup_editshift.php?day="+day;
	var w = 300;
  var h = 250;
  var left = Number((screen.width/2)-(w/2));
  var tops = Number((screen.height/2)-(h/2));
  window.open(url, '_blank', 'toolbar=no, scrollbars=no, resizable=yes, titlebar=no, width='+w+', height='+h+', top='+tops+', left='+left);

}
</script>
