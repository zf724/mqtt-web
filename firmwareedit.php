<?php
include 'firmwareheader.php';

echo <<<END

    <div class="container-fluid">
      <div class="row-fluid">
        <div class="span2">
          <div class="well sidebar-nav">
            <ul class="nav nav-list">
              <li class="active"><a href="firmwarelist.php">固件列表</a></li>
            </ul>
          </div><!--/.well -->
        </div><!--/span-->
        <div class="span10">
END;

$version = $url = $enabled = $error= "";

if (isset($_POST['version']))
{
    $version = sanitizeString ( $_POST ['version'] );
    $enabled = sanitizeString ( $_POST ['enabled'] );

    if ($version == "" || $enabled == ""){
        $error = "存在字段不能为空";
    }else if ((($_FILES["file"]["type"] == "application/octet-stream"))
        && ($_FILES["file"]["size"] < $firmwaremaxsize))
    {
        if ($_FILES["file"]["error"] > 0)
        {
            $error = "上传错误: " . $_FILES["file"]["error"] . "<br />";
        }
        else
        {
            //echo "Upload: " . $_FILES["file"]["name"] . "<br />";
            //echo "Type: " . $_FILES["file"]["type"] . "<br />";
            //echo "Size: " . ($_FILES["file"]["size"] / 1024) . " Kb<br />";
            //echo "Temp file: " . $_FILES["file"]["tmp_name"] . "<br />";
            if (file_exists("../firmware/" . $_FILES["file"]["name"]))
            {
                $error = $_FILES["file"]["name"] . "文件已存在";
            }
            else
            {
                move_uploaded_file($_FILES["file"]["tmp_name"], "../firmware/" . $_FILES["file"]["name"]);

                $url= 'http://' . $_SERVER['HTTP_HOST'] . '/firmware/' . $_FILES["file"]["name"];
                if ($enabled == '1'){
                    queryMysql ( "UPDATE firmware SET enabled=0 WHERE enabled=1" );
                }
                queryMysql ( "UPDATE firmware set version = '$version',url = '$url',enabled='$enabled' where version = '$version' " );
                $error = "固件修改成功";
            }
        }
    }
    else
    {
        $error = "文件不符合规范";
    }
    //redirect('userlist.php');
}
else if(isset($_GET['version'])) {
    $version = sanitizeString ( $_GET['version'] );

    if ($version == "") {
        $error = "版本号为空！";
    } else {
        $query = " select version, url, enabled from firmware where version = '$version'";

        $result = queryMysql($query);
        if (mysqli_num_rows($result))
        {
            $row  = mysqli_fetch_row($result);
            $version = stripslashes($row[0]);
            $url = stripslashes($row[1]);
            $enabled = stripslashes($row[2]);
        }
        else $error = "查询不到该版本！";
    }
}
		
echo <<<END
<div class="well">
<form class="form-horizontal" action='firmwareedit.php' method="POST" enctype="multipart/form-data" >
  <fieldset>
    <div id="legend">
      <legend class="">修改固件</legend>
    </div>
    <div class="control-group">
      <!-- Username -->
      <label class="control-label"  for="version">固件版本</label>
      <div class="controls">
        <input type="text" id="version" name="version" value="$version" placeholder="" class="input-xlarge" >
        <p class="help-block"></p>
      </div>
    </div>
    
    <div class="control-group">
      <!-- Url -->
      <label class="control-label" for="url">固件路径</label>
      <div class="controls">
        <input type="file" id="file" name="file" required >
        <p class="help-block"></p>
      </div>
    </div>

    <div class="control-group">
		  <label class="control-label" for="status" >状态</label>
          <div class="controls">
            <select id="enabled" name="enabled" class="input-xlarge">
              <option value="1">启用</option>
              <option value="0">停用</option>
            </select>
          </div>
	</div>
		
    <div class="control-group">
      <!-- Button -->
      <div class="controls">
        <button type="submit" class="btn btn-primary">保  存</button> &nbsp;&nbsp;
        <a class="btn" href='firmwarelist.php'>返 回</a>
        <span class='error'>$error</span> 
      </div>
    </div>
  </fieldset>
</form>
</div>

END;

include 'bottom.php';
?>