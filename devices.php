<?php
include 'deviceheader.php';

echo <<<END

    <div class="container-fluid">
      <div class="row-fluid">
        <div class="span2">
          <div class="well sidebar-nav">
            <ul class="nav nav-list">
              <li class="active">主机列表</li>
            </ul>
          </div><!--/.well -->
        </div><!--/span-->
        <div class="span10">

END;
    redirect('devicelist.php');
echo <<<END

		<div class="well">
		<h3>主机状态正在建设中……</h3>
		</div>

END;

include 'bottom.php';
?>