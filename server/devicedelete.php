<?php
include 'functions.php';

$name =$error= "";

if(isset($_GET['name']))
{
	$name = sanitizeString ( $_GET['name'] );

	if ($name == "") {
		$error = "姓名为空！";
	} else {
		$query = "DELETE from accounts WHERE name = '$name'";

		if (queryMysql($query) == true) {
            $error = "删除成功！";
		} else {
            $error = "删除失败！";
		}

		redirect('devicelist.php');
	}
}

?>