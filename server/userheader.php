<?php
session_start ();
include 'functions.php';

echo <<<END

<!DOCTYPE html>
<html lang="en">
  <head>
    <title>后台管理系统</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">

    <!-- Le styles -->
    <link href="bootstrap/css/bootstrap.css" rel="stylesheet" type="text/css" />
    <style type="text/css">
      body {
        padding-top: 60px;
        padding-bottom: 40px;
      }
      .sidebar-nav {
        padding: 9px 0;
      }
	  
	  .error{
	  color: Red;
	  font-size: 16px;
	  }
    </style>
    
    <link href="bootstrap/css/bootstrap-responsive.css" rel="stylesheet" type="text/css" />

    <!-- HTML5 shim, for IE6-8 support of HTML5 elements -->
    <!--[if lt IE 9]>
      <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->
	
<script>
  $(function () { $("input,select,textarea").not("[type=submit]").jqBootstrapValidation(); } );
</script>
		
  </head>

  <body>

END;


if (isset($_SESSION['user']))
{
	$user     = $_SESSION['user'];
	$loggedin = TRUE;
}
else $loggedin = FALSE;

if ($loggedin)
{
	echo  <<<END

	    <div class="navbar  navbar-fixed-top">
      <div class="navbar-inner">
        <div class="container-fluid">
          <a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </a>
          <a class="brand" href="users.php">后台管理系统</a>
          <div class="nav-collapse collapse">
<!--            <p class="navbar-text pull-right">
              欢迎您， <a href="#" class="navbar-link">管理员</a>
            </p>-->
             <ul class="nav">
            <li class='active'><a href='users.php'>用户管理</a></li>
            <li><a href='firmwares.php'>固件管理</a></li>
            <li><a href='devices.php'>设备管理</a></li>
            <li><a href='reports.php'>统计管理</a></li>
            </ul>
             <div class="pull-right">
                <ul class="nav pull-right">
                    <li class="dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown">欢迎您，$user<b class="caret"></b></a>
                        <ul class="dropdown-menu">
                            <li><a href="/user/preferences"><i class="icon-cog"></i> 个人设置</a></li>
                            <li><a href="/help/support"><i class="icon-envelope"></i> 意见反馈</a></li>
                            <li class="divider"></li>
                            <li><a href="logout.php"><i class="icon-off"></i> 退出</a></li>
                        </ul>
                    </li>
                </ul>
             </div>
          </div><!--/.nav-collapse -->
        </div>
      </div>
    </div>
	
END;
	
}
else
{
	//die("您未登陆到系统，请重试！");
	redirect('login.php');
}

?>