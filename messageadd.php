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

    if(isset($_POST['error'])) {
        $error = "主题内容字段不能为空";
    }else if (isset($_POST['topic'])){
        $topic = sanitizeString($_POST['topic']);
        $content = sanitizeString($_POST['content']);

        queryMysql ( "INSERT INTO message(topic, content) VALUES('$topic','$content') " );
        $error = "发送消息成功";
        redirect('messagelist.php');
    }
}else $error = "无默认主机信息！";

echo <<<END
<div class="well">
<form class="form-horizontal" id="send-message" enctype="multipart/form-data" method="post" >
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
        <textarea rows="10" cols="80" class="" id="content" name="content" placeholder="" ></textarea>
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

<script src="bootstrap/js/jquery.js" type="text/javascript"></script>
<script src="javascript/mqttws31.js"></script>
<script>//<![CDATA[
$(document).ready(function(){

  if( !window.WebSocket) {
    $("#send-message").html("\
        <h1>Get a new Web Browser!</h1>\
        <p>\
        Your browser does not support WebSockets. This example will not work properly.<br>\
        Please use a Web Browser with WebSockets support (WebKit or Google Chrome).\
        </p>\
    ");
  } else {
    
    var client;

    var host = "$host";    
    var port = "$port";
    var clientId = "$client";
    var user = "$user";
    var password = "$password";
    var cleanSession = false;

    client = new Messaging.Client(host, Number(port), clientId);
    
    client.onConnect = onConnect;
    
    client.onMessageArrived = onMessageArrived;
    client.onConnectionLost = onConnectionLost;            
    
    client.connect({
        userName:user, 
        password:password, 
        cleanSession:cleanSession,
        onSuccess:onConnect, 
        onFailure:onFailure
    }); 


    // the client is notified when it is connected to the server.
    function onConnect(frame) {
      debug("connected to MQTT");
    };  

    // this allows to display debug logs directly on the web page
    var debug = function(str) {
      console.log(str);
    };  

    window.addEventListener("beforeunload", function(event){
      client.disconnect();
      $("#host-status").html("")
      debug("disconnect client");
      return false;
    });
    
    $('#send-message').submit(function() {
      var text = $('#content').val();
      var destination = $("#topic").val();
      if (text && destination) {
        client.subscribe(destination);
        message = new Messaging.Message(text);
        message.destinationName = destination;
        message.qos = 2;
        message.retained = true;
        client.send(message);
        sentPost("messageadd.php", {topic:destination, content:text});
      }else{
        sentPost("messageadd.php", {error:1});
      }
      return false;
    });
    
    function onFailure(failure) {
      debug("failure");
      debug(failure.errorMessage);
    }  

    function onMessageArrived(message) {
        console.log(message.destinationName + ":" + message.payloadString);
    }

    function onConnectionLost(responseObject) {
      if (responseObject.errorCode !== 0) {
        debug(client.clientId + ": " + responseObject.errorCode);
      }
    }
    
    function sentPost(URL, PARAMS) {
        var temp = document.createElement("form");
        temp.action = URL;
        temp.method = "post";
        temp.style.display = "none";
        for (var x in PARAMS) {
            var opt = document.createElement("textarea");
            opt.name = x;
            opt.value = PARAMS[x];
            // alert(opt.name)
            temp.appendChild(opt);
        }
        document.body.appendChild(temp);
        temp.submit();
        return temp;
    }
  }
});    
//]]></script>

END;

include 'bottom.php';
?>