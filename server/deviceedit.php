<?php
include 'deviceheader.php';

echo <<<END

    <div class="container-fluid">
      <div class="row-fluid">
        <div class="span2">
          <div class="well sidebar-nav">
            <ul class="nav nav-list">
              <li class="active"><a href="devicelist.php">设备列表</a></li>
            </ul>
          </div><!--/.well -->
        </div><!--/span-->
        <div class="span10">
END;

$name = $password = $phone = $birthday = $weight = $height = $error = "";

if (isset($_POST['name']))
 {
	$name = sanitizeString ( $_POST ['name'] );
	$password = sanitizeString ( $_POST ['password'] );
	$phone = sanitizeString ( $_POST ['phone'] );
	$birthday = sanitizeString ( $_POST ['birthday'] );
	$weight = sanitizeString ( $_POST ['weight'] );
	$height = sanitizeString ( $_POST ['height'] );
	
	
	if ($name == "" || $password == "" || $phone == "")
		$error = "存在字段不能为空";
	else {
		queryMysql ( "UPDATE accounts set name = '$name',password = '$password',phone='$phone',birthday='$birthday',weight ='$weight',height= '$height' where name='$name' " );
		$error = "用户修改成功";
			//redirect('userlist.php');
	}
}
else
{
	if(isset($_GET['name']))
	{
		$name = sanitizeString ( $_GET['name'] );
	
		if ($name == "") {
			$error = "姓名为空！";
		} else {
			$query = " select name, password, phone, birthday, weight, height from accounts where name = '$name'";
	
			$result = queryMysql($query);
			if (mysqli_num_rows($result))
			{
				$row  = mysqli_fetch_row($result);
				$name = stripslashes($row[0]);
				$password = stripslashes($row[1]);
				$phone =  stripslashes($row[2]);
                $birthday =  stripslashes($row[3]);
				$weight = stripslashes($row[4]);
                $height = stripslashes($row[4]);
			}
			else $error = "查询不到该用户！";
	
		}
	}
}
		
		
echo <<<END
<div class="well">
<form class="form-horizontal" action='deviceedit.php' method="POST">
  <fieldset>
    <div id="legend">
      <legend class="">修改设备信息</legend>
    </div>
    <div class="control-group">
      <!-- Name -->
      <label class="control-label"  for="name">用户名</label>
      <div class="controls">
        <input type="text" id="name" name="name" value="$name" placeholder="" class="input-xlarge" disabled>
        <p class="help-block"></p>
      </div>
    </div>
 
    <div class="control-group">
      <!-- Password-->
      <label class="control-label" for="password">密码</label>
      <div class="controls">
        <input type="password" id="password" name="password" value="$password" placeholder="" class="input-xlarge" required>
        <p class="help-block">请输入密码</p>
      </div>
    </div>
 
	<div class="control-group">
      <!-- Phone -->
      <label class="control-label" for="phone">电话</label>
      <div class="controls">
        <input id="phone" name="phone" value="$phone" placeholder="" class="input-xlarge" type="number">
      </div>
    </div>

	<div class="control-group">
      <!-- Birthday -->
      <label class="control-label" for="birthday">生日</label>
      <div class="controls">
        <input id="birthday" name="birthday" value="$birthday" placeholder="" class="input-xlarge" type="date">
      </div>
    </div>
    
    <div class="control-group">
      <!-- Weight -->
      <label class="control-label" for="weight">体重</label>
      <div class="controls">
        <input id="weight" name="weight" value="$weight" placeholder="" class="input-xlarge" type="text">
      </div>
    </div>
    
    <div class="control-group">
      <!-- Height -->
      <label class="control-label" for="height">身高</label>
      <div class="controls">
        <input id="height" name="height" value="$height" placeholder="" class="input-xlarge" type="text">
      </div>
    </div>
		
    <div class="control-group">
      <!-- Button -->
      <div class="controls">
        <button type="submit" class="btn btn-primary">保  存</button> &nbsp;&nbsp;
        <a class="btn" href='devicelist.php'>返 回</a>
        <span class='error'>$error</span> 
      </div>
    </div>
  </fieldset>
</form>
</div>

END;

include 'bottom.php';
?>