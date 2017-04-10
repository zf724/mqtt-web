<?php
include '../server/functions.php';

//检测连接
if ($link->connect_error) {
    die("连接失败：" . $link->connect_error);
}

$sql = "SELECT name,password,phone,birthday,weight,height FROM accounts WHERE name='" . $_GET["name"] . "' AND password='" . $_GET["password"] . "'";

$result = $link->query($sql);

if ($row = mysqli_fetch_array($result)) {
    $arr = array('result' => 1, 'phone' => $row['phone'], 'birthday' => $row['birthday'],'weight' => $row['weight'], 'height' => $row['height']);
    echo json_encode($arr);
} else {
    $arr = array('result' => 0);
    echo json_encode($arr);
}
$link->close();
?>
