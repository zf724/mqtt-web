<?php
include 'reportheader.php';

echo <<<END

    <div class="container-fluid">
      <div class="row-fluid">
        <div class="span2">
          <div class="well sidebar-nav">
            <ul class="nav nav-list">
              <li class="nav-header">报表管理</li>
            </ul>
          </div><!--/.well -->
        </div><!--/span-->
        <div class="span10">

END;
    redirect('reportlist.php');
echo <<<END

		<div class="well">
		<h3>报表管理正在建设中……</h3>
		</div>

END;

include 'bottom.php';
?>