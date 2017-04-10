<?php // Example 21-1: functions.php

if($_SERVER["SERVER_NAME"] == "bracelet.oqsmart.com.cn"){
    $dbhost  = 'mysql.hostinger.com.hk';
    $dbname  = 'u121377160_root';
    $dbuser  = 'u121377160_root';
    $dbpass  = 'rGZ9t4hMAF';
    $dbfile = '../firmware/manage.sql';
    $ad = "<a href='http://api.hostinger.com.hk/redir/21005134' target='_blank'> 
            <img src='http://www.hostinger.com.hk/banners/cn/hostinger-80x15-powered-1.gif' alt='虚拟主机' align='right' border='0' width='80' height='15' />
        </a>";
} else{
    $dbhost  = '127.0.0.1';
    $dbname  = 'bracelet';
    $dbuser  = 'root';
    $dbpass  = 'root';
    $dbfile = '../firmware/manage.sql';
    $ad = "";
}

$appname = "后台管理系统";
$firmwaremaxsize = 2000000;
$maxitemonepage = 20;
$maxshowpage = 4;

if(file_exists($dbfile)) {
    //读取文件内容
    $_mysqli = mysqli_connect($dbhost, $dbuser, $dbpass) or die(mysqli_connect_errno());
    $_mysqli->query("CREATE DATABASE IF NOT EXISTS $dbname DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;");
    $_mysqli->query("USE $dbname");
    $_sql = file_get_contents($dbfile);
    $_arr = explode(';', $_sql);
//执行sql语句
    foreach ($_arr as $_value) {
        $_mysqli->query($_value.';');
    }
    $_mysqli->close();
    $_mysqli = null;
    unlink($dbfile);
}

$link = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname)or die(mysqli_connect_errno());

function createTable($name, $query)
{
    queryMysql("CREATE TABLE IF NOT EXISTS $name($query)");
    echo "Table '$name' created or already exists.<br />";
}

function queryMysql($query)
{
    global $link;
    $result = mysqli_query($link, $query) or die(mysqli_error($link));
    return $result;
}

function destroySession()
{
    $_SESSION=array();
    
    if (session_id() != "" || isset($_COOKIE[session_name()]))
        setcookie(session_name(), '', time()-2592000, '/');

    session_destroy();
}

function sanitizeString($var)
{
    global $link;
    $var = strip_tags($var);
    $var = htmlentities($var);
    $var = stripslashes($var);
    return mysqli_real_escape_string($link, $var);
}

function redirect($url)
{
	echo "<script type=text/javascript>window.location.href='$url';</script>";
}


?>
