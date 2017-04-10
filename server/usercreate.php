<?php
include 'userheader.php';

echo <<<END

    <div class="container-fluid">
      <div class="row-fluid">
        <div class="span2">
          <div class="well sidebar-nav">
            <ul class="nav nav-list">
              <li class="nav-header">用户管理</li>
              <li class="active"><a href="usercreate.php">新建用户</a></li>
              <li><a href="userlist.php">用户列表</a></li>
            </ul>
          </div><!--/.well -->
        </div><!--/span-->
        <div class="span10">
END;

$username = $password = $email = $stauts=$remark=$error= "";

if (isset ( $_POST ['username'] ) && isset ( $_POST ['password']))
 {
	$username = sanitizeString ( $_POST ['username'] );
	$password = sanitizeString ( $_POST ['password'] );
	$email = sanitizeString ( $_POST ['email'] );
	$status = sanitizeString ( $_POST ['status'] );
	$remark = sanitizeString ( $_POST ['remark'] );
	
	if ($username == "" || $password == "" || $status == "")
		$error = "存在字段不能为空";
	else {
		if (mysqli_num_rows ( queryMysql ( "SELECT * FROM user
		      WHERE account='$username'" ) ))
			$error = "名称已经存在";
		else {
			queryMysql ( "INSERT INTO user(account,password,email,status,remark) VALUES('$username', '$password','$email','$status','$remark')" );
			$error = "用户创建成功";
			redirect('userlist.php');
		}
	}
}
		
		
echo <<<END
<div class="well">
<form class="form-horizontal" action='usercreate.php' method="POST">
  <fieldset>
    <div id="legend">
      <legend class="">创建用户</legend>
    </div>
    <div class="control-group">
      <!-- Username -->
      <label class="control-label"  for="username">姓名</label>
      <div class="controls">
        <input type="text" id="username" name="username" value="$username" placeholder="" class="input-xlarge"  required>
        <p class="help-block">请输入用户姓名</p>
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
      <!-- E-mail -->
      <label class="control-label" for="email">邮箱</label>
      <div class="controls">
        <input id="email" name="email" value="$email" placeholder="" class="input-xlarge" type="email">
        <p class="help-block">请输入邮箱</p>
      </div>
    </div>

    <div class="control-group">
		  <label class="control-label" for="status" >状态</label>
          <div class="controls">
            <select id="status" name="status" class="input-xlarge">
              <option value="1">启用</option>
              <option value="0">停用</option>
            </select>
          </div>
	</div>
		
   <div class="control-group">
      <!-- remark -->
      <label class="control-label"  for="remark">备注</label>
	  <div class="controls">
        <textarea rows="4" class="" id="remark" name="remark" value="$remark" placeholder="" > </textarea>
		<p class="help-block">请输入备注信息</p>
      </div>
    </div>
		
    <div class="control-group">
      <!-- Button -->
      <div class="controls">
        <button type="submit" class="btn btn-primary">保  存</button> &nbsp;&nbsp;
        <a class="btn" href='userlist.php'>返 回</a>
        <span class='error'>$error</span> 
      </div>
    </div>
  </fieldset>
</form>
</div>

END;

include 'bottom.php';
?>