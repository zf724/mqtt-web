<?php
include 'functions.php';

$username =$error= "";

if(isset($_GET['account']))
{
	$username = sanitizeString ( $_GET['account'] );

	if ($username == "") {
		$error = "姓名为空！";
	} else {
		$query = "DELETE from user WHERE account = '$username'";

		if (queryMysql($query) == true) {
            $error = "删除成功！";
		} else {
            $error = "删除失败！";
		}

		redirect('userlist.php');
	}
}

?>