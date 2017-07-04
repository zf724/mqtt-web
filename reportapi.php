<?php
session_start ();
include 'functions.php';

if (isset($_SESSION['user']))
{
    $result = queryMysql(" select name, password, phone, birthday, weight, height from accounts ORDER BY id asc ");

    $data = array();//保存数据
    while ($row = mysqli_fetch_assoc($result)) {
        $data[] = $row;
    }
//对数据进行相应的操作
    echo  json_encode($data);
}

?>