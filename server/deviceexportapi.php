<?php
session_start ();
include 'functions.php';
include_once("excel/reader.php");

if (isset($_SESSION['user']))
{

    $result = queryMysql('SELECT * FROM accounts');
    $str = "姓名\t密码\t电话\t生日\t体重\t身高\n";
    $str = iconv('utf-8', 'gb2312', $str);
    while ($row = mysqli_fetch_array($result)) {
        $name = iconv('utf-8', 'gb2312', $row['name']);
        $str .= $name . "\t" . $row['password'] . "\t" . $row['phone'] . "\t" . $row['birthday'] . "\t" . $row['weight'] . "\t" . $row['height'] . "\t\n";
    }
    $filename = '设备信息' . date('Ymd') . '.xls';
    exportExcel($filename, $str);
}

function exportExcel($filename, $content)
{
    header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
    header("Content-Type: application/vnd.ms-execl");
    header("Content-Type: application/force-download");
    header("Content-Type: application/download");
    header("Content-Disposition: attachment; filename=" . $filename);
    header("Content-Transfer-Encoding: binary");
    header("Pragma: no-cache");
    header("Expires: 0");

    echo $content;
}

?>