<?php
include 'firmwareheader.php';

echo <<<END

    <div class="container-fluid">
      <div class="row-fluid">
        <div class="span2">
          <div class="well sidebar-nav">
            <ul class="nav nav-list">
              <li class="nav-header">固件管理</li>
            </ul>
          </div><!--/.well -->
        </div><!--/span-->
        <div class="span10">

END;
    redirect('firmwarelist.php');
echo <<<END

		<div class="well">
		<h3>固件管理正在建设中……</h3>
		</div>

END;

include 'bottom.php';
?>