<?php
include 'messageheader.php';

echo <<<END

    <div class="container-fluid">
      <div class="row-fluid">
        <div class="span2">
          <div class="well sidebar-nav">
            <ul class="nav nav-list">
              <li class="nav-header">消息列表</li>
              <li class="nav-header">主机信息</li>
            </ul>
          </div><!--/.well -->
        </div><!--/span-->
        <div class="span10">

END;
    redirect('messagelist.php');
echo <<<END

		<div class="well">
		<h3>消息管理正在建设中……</h3>
		</div>

END;

include 'bottom.php';
?>