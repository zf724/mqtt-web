<?php
include 'reportheader.php';

echo <<<END

    <div class="container-fluid">
      <div class="row-fluid">
        <div class="span2">
          <div class="well sidebar-nav">
            <ul class="nav nav-list">
              <li class="active"><a href="reportlist.php">报表管理</a></li>
            </ul>
          </div><!--/.well -->
        </div><!--/span-->
        <div class="span10">	
<div id='canvasDiv'>
    <script type="text/javascript" src="javascript/ichart.1.2.1.min.js"></script>
    <script type="text/javascript" src="javascript/report.js"></script>
</div>

END;

include 'bottom.php';
?>