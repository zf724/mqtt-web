<?php
include 'messageheader.php';

echo <<<END

    <div class="container-fluid">
      <div class="row-fluid">
        <div class="span2">
          <div class="well sidebar-nav">
            <ul class="nav nav-list">
              <li><a href="messagelist.php">消息列表</a></li>
              <li class="active"><a href="hostedit.php">主机信息</a></li>
            </ul>
          </div><!--/.well -->
        </div><!--/span-->
        <div class="span10">

END;

$host=$port=$client=$user=$password=$error= "";

if (isset($_POST['host']))
{
    $host = sanitizeString ( $_POST ['host'] );
    $port = sanitizeString ( $_POST ['port'] );
    $client = sanitizeString ( $_POST ['client'] );
    $user = sanitizeString ( $_POST ['user'] );
    $password = sanitizeString ( $_POST ['password'] );


    if ($host == "" || $port == "" || $client == ""||$user == "")
        $error = "存在字段不能为空";
    else {
        queryMysql("TRUNCATE TABLE host");
        queryMysql("INSERT INTO host(host,port,client,user,password) VALUES('$host', '$port','$client','$user','$password')");
        $error = "主机修改成功";
    }
}
else
{
    $result = queryMysql("SELECT host,port,client,user,password FROM host WHERE id=1");
    if (mysqli_num_rows($result))
    {
        $row  = mysqli_fetch_row($result);
        $host = stripslashes($row[0]);
        $port = stripslashes($row[1]);
        $client =  stripslashes($row[2]);
        $user=  stripslashes($row[3]);
        $password= stripslashes($row[4]);
    }
    else $error = "无默认主机信息！";

}


echo <<<END
<div class="well">
<form class="form-horizontal" action='hostedit.php' method="POST">
  <fieldset>
    <div id="legend">
      <legend class="">主机信息</legend>
    </div>
    <div class="control-group">
      <!-- host -->
      <label class="control-label"  for="host">主机</label>
      <div class="controls">
        <input type="text" id="host" name="host" value="$host" placeholder="" class="input-xlarge" >
        <p class="help-block"></p>
      </div>
    </div>

     <div class="control-group">
      <!-- port -->
      <label class="control-label"  for="port">端口</label>
      <div class="controls">
        <input type="number" min="1" max="65535" id="port" name="port" value="$port" placeholder="" class="input-xlarge" >
        <p class="help-block"></p>
      </div>
    </div>
    
    <div class="control-group">
      <!-- client -->
      <label class="control-label"  for="client">客户ID</label>
      <div class="controls">
        <input type="text" id="client" name="client" value="$client" placeholder="" class="input-xlarge" >
        <p class="help-block"></p>
      </div>
    </div>
    
    <div class="control-group">
      <!-- user -->
      <label class="control-label"  for="user">账号</label>
      <div class="controls">
        <input type="text" id="user" name="user" value="$user" placeholder="" class="input-xlarge" >
        <p class="help-block"></p>
      </div>
    </div>
    
    <div class="control-group">
      <!-- password -->
      <label class="control-label"  for="password">密码</label>
      <div class="controls">
        <input type="password" id="password" name="password" value="$password" placeholder="" class="input-xlarge" >
        <p class="help-block"></p>
      </div>
    </div>
		
    <div class="control-group">
      <!-- Button -->
      <div class="controls">
        <button type="submit" class="btn btn-primary">更  新</button> &nbsp;&nbsp;
        <span class='error'>$error</span> 
      </div>
    </div>
  </fieldset>
</form>
</div>

END;

include 'bottom.php';
?>