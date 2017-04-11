<?php
include 'messageheader.php';

echo <<<END

    <div class="container-fluid">
      <div class="row-fluid">
        <div class="span2">
          <div class="well sidebar-nav">
            <ul class="nav nav-list">
              <li class="active"><a href="firmwarelist.php">消息列表</a></li>
              <li><a href="hostedit.php">主机信息</a></li>
            </ul>
          </div><!--/.well -->
        </div><!--/span-->
        <div class="span10">
END;
require("mqtt.php");

$topic=$content=$error="";

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

if (isset ( $_POST ['content'] ))
 {
     $topic = sanitizeString ( $_POST ['topic'] );
     $content = sanitizeString ( $_POST ['content'] );

     if ($topic == "" || $content == ""){
         $error = "存在字段不能为空";
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
             $mqtt = new phpMQTT($host, $port, $client); //Change client name to something unique

             if ($mqtt->connect(true, null, $user, $password)) {
                 $mqtt->publish($topic, $content, 0);
                 $mqtt->close();
                 queryMysql ( "INSERT INTO message(topic, content) VALUES('$topic','$content') " );
                 $error = "发送消息成功";
                 redirect('messagelist.php');
             }else $error = "发送消息失败";
         }
         else $error = "无默认主机信息！";
     }
}
		
echo <<<END
<div class="well">
<form class="form-horizontal" action='messageadd.php' enctype="multipart/form-data" method="post" >
  <fieldset>
    <div id="legend">
      <legend class="">新增消息</legend>
    </div>
    <div class="control-group">
      <!-- topic -->
      <label class="control-label"  for="topic">主题</label>
      <div class="controls">
        <input type="text" id="topic" name="topic" value="notify" placeholder="" class="input-xlarge" >
        <p class="help-block">请输入订阅主题</p>
      </div>
    </div>

   <div class="control-group">
      <!-- content -->
      <label class="control-label"  for="content">内容</label>
	  <div class="controls">
        <textarea rows="10" cols="80" class="" id="content" name="content" placeholder="" > </textarea>
		<p class="help-block">请输入消息内容</p>
      </div>
    </div>
		
    <div class="control-group">
      <!-- Button -->
      <div class="controls">
        <button type="submit" class="btn btn-primary">发  送</button> &nbsp;&nbsp;
        <a class="btn" href='messagelist.php'>返 回</a>
        <span class='error'>$error</span> 
      </div>
    </div>
  </fieldset>
</form>
</div>

END;

include 'bottom.php';
?>