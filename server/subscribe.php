<?php
session_start ();
require("mqtt.php");
include 'functions.php';

if (isset($_SESSION['user']))
{
    $user     = $_SESSION['user'];
    $loggedin = TRUE;
}
else $loggedin = FALSE;

if ($loggedin)
{
    $result = queryMysql("SELECT host,port,client,user,password FROM host WHERE id=1");

    if (mysqli_num_rows($result)) {
        $row = mysqli_fetch_row($result);
        $host = stripslashes($row[0]);
        $port = stripslashes($row[1]);
        $client = stripslashes($row[2]);
        $user = stripslashes($row[3]);
        $password = stripslashes($row[4]);
    }

    $mqtt = new phpMQTT($host, $port, $client); //Change client name to something unique

    if (!$mqtt->connect(true, null, $user, $password)) {
        exit(1);
    }

    $topics['$SYS/#'] = array("qos" => 0, "function" => "procmsg");
    $mqtt->subscribe($topics, 0);

    //while ($mqtt->proc());
    $mqtt->proc();
    $mqtt->close();

    function procmsg($topic, $content)
    {
        $arr = array('topic' => $topic, 'content' => $content);
        echo json_encode($arr);
    }
}else {
    $arr = array('topic' => 'error', 'content' => 'Login first!');
    echo json_encode($arr);
}


?>
