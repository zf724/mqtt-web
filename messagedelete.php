<?php
include 'functions.php';

$name =$error= "";

if(isset($_GET['id']))
{
	$id = sanitizeString ( $_GET['id'] );

	if ($id == "") {
		$error = "未选中消息！";
	} else {
        $query = " SELECT content from message WHERE id = '$id'";
        $result = queryMysql($query);
        if ($row = mysqli_fetch_assoc($result)) {
            $query = "DELETE from message WHERE id = '$id'";

            if (queryMysql($query) == true) {
                $error = "删除成功！";
            } else {
                $error = "删除失败！";
            }
        }else{
            $error = "删除失败！";
        }

		redirect('messagelist.php');
	}
}

?>