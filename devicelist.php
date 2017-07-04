<?php
include 'deviceheader.php';

echo <<<END

    <div class="container-fluid">
      <div class="row-fluid">
        <div class="span2">
          <div class="well sidebar-nav">
            <ul class="nav nav-list">
              <li class="active"><a href="devicelist.php">主机列表</a></li>
            </ul>
          </div><!--/.well -->
        </div><!--/span-->
        <div class="span10">

		<div class="well">
            <table class="table">
              <thead>
                <tr>
                  <th>名称</th>
                  <th>状态</th>
                  <th style="width: 36px;"></th>
                </tr>
              </thead>
              <tbody>
END;

$result = queryMysql("SELECT host,port,client,user,password FROM host WHERE id=1");

if (mysqli_num_rows($result)) {
    $row = mysqli_fetch_row($result);
    $host = stripslashes($row[0]);
    $port = stripslashes($row[1]);
    $client = stripslashes($row[2]);
    $user = stripslashes($row[3]);
    $password = stripslashes($row[4]);
}

$infos = array(
    array ("软件版本号", "\$SYS/broker/version"),
    array ("软件build的详细时间","\$SYS/broker/timestamp"),
    array ("启动时长", "\$SYS/broker/uptime"),
    array ("有效和无效连接、注册到服务器上的总数", "\$SYS/broker/clients/total"),
    array ("当前非激活的客户端数量", "\$SYS/broker/clients/inactive"),
    array ("注册到服务器上的持久连接（clean seesion为假)但当前断开的客户端数量", "\$SYS/broker/clients/disconnected"),
    array ("当前活动的客户端数量", "\$SYS/broker/clients/active"),
    array ("当前连接的客户端数量", "\$SYS/broker/clients/connected"),
    array ("超过有效期被断开连接的客户端数量", "\$SYS/broker/clients/expired"),
    array ("服务器同一时间连接的最大客户端数量", "\$SYS/broker/clients/maximum"),
    array ("服务器存储的消息的总数，包括保留消息和持久连接客户端的消息队列中的消息数", "\$SYS/broker/messages/stored"),
    array ("自服务器启动以来接收的所有类型的消息总数", "\$SYS/broker/messages/received"),
    array ("自服务器启动以来发送的所有类型的消息总数", "\$SYS/broker/messages/sent"),
    array ("等待确认的Qos>0的消息的数量", "\$SYS/broker/messages/inflight"),
    array ("服务器订阅主题总数", "\$SYS/broker/subscriptions/count"),
    array ("服务器保留的消息总数", "\$SYS/broker/retained messages/count"),
    array ("正在使用的堆内存大小", "\$SYS/broker/heap/current"),
    array ("使用的最大堆内存", "\$SYS/broker/heap/maximum"),
    array ("由于inflight/queuing限制而直接丢弃的消息的总数", "\$SYS/broker/publish/messages/dropped"),
    array ("自服务器启动以来接收的发布消息的总数", "\$SYS/broker/publish/messages/received"),
    array ("自服务器启动以来发送的发布消息的总数", "\$SYS/broker/publish/messages/sent"),
    array ("收到字节", "\$SYS/broker/publish/bytes/received"),
    array ("发送字节", "\$SYS/broker/publish/bytes/sent"),
    array ("服务器桥接,1表示连接激活，0表示连接没有激活", "\$SYS/broker/connection"),
    array ("自服务器启动以来共接收的字节数", "\$SYS/broker/bytes/received"),
    array ("自服务器启动以来共发送的字节数", "\$SYS/broker/bytes/sent"),
    array ("1分钟内服务器接收到的所有类型消息的平均数", "\$SYS/broker/load/messages/received/1min"),
    array ("5分钟内服务器接收到的所有类型消息的平均数", "\$SYS/broker/load/messages/received/5min"),
    array ("15分钟内服务器接收到的所有类型消息的平均数", "\$SYS/broker/load/messages/received/15min"),
    array ("1分钟内服务器接发送的所有类型消息的平均数", "\$SYS/broker/load/messages/sent/1min"),
    array ("5分钟内服务器接发送的所有类型消息的平均数", "\$SYS/broker/load/messages/sent/5min"),
    array ("15分钟内服务器接发送的所有类型消息的平均数", "\$SYS/broker/load/messages/sent/15min"),
    array ("1分钟内服务器接收数据的平均字节数", "\$SYS/broker/load/bytes/received/1min"),
    array ("5分钟内服务器接收数据的平均字节数", "\$SYS/broker/load/bytes/received/5min"),
    array ("15分钟服务器接收数据的平均字节数", "\$SYS/broker/load/bytes/received/15min"),
    array ("1分钟内服务器发送数据的平均字节数", "\$SYS/broker/load/bytes/sent/1min"),
    array ("5分钟内服务器发送数据的平均字节数", "\$SYS/broker/load/bytes/sent/5min"),
    array ("15分钟服务器发送数据的平均字节数", "\$SYS/broker/load/bytes/sent/15min"),
    array ("1分钟内服务器丢弃的消息的平均数", "\$SYS/broker/load/publish/dropped/1min"),
    array ("5分钟内服务器丢弃的消息的平均数", "\$SYS/broker/load/publish/dropped/5min"),
    array ("15分钟服务器丢弃的消息的平均数", "\$SYS/broker/load/publish/dropped/15min"),
    array ("1分钟内服务器接收的发布消息的平均数", "\$SYS/broker/load/publish/received/1min"),
    array ("5分钟内服务器接收的发布消息的平均数", "\$SYS/broker/load/publish/received/5min"),
    array ("15分钟服务器接收的发布消息的平均数", "\$SYS/broker/load/publish/received/15min"),
    array ("1分钟内服务器发送的发布消息的平均数", "\$SYS/broker/load/publish/sent/1min"),
    array ("5分钟内服务器发送的发布消息的平均数", "\$SYS/broker/load/publish/sent/5min"),
    array ("15分钟服务器发送的发布消息的平均数", "\$SYS/broker/load/publish/sent/15min"),
    array ("1分钟内服务器打开的socket连接的平均数", "\$SYS/broker/load/sockets/1min"),
    array ("5分钟内服务器打开的socket连接的平均数", "\$SYS/broker/load/sockets/5min"),
    array ("15分钟服务器打开的socket连接的平均数", "\$SYS/broker/load/sockets/15min"),
    array ("1分钟服务器接收到的connections包的平均数", "\$SYS/broker/load/connections/1min"),
    array ("5分钟内服务器接收到的connections包的平均数", "\$SYS/broker/load/connections/5min"),
    array ("15分钟内服务器接收到的connections包的平均数", "\$SYS/broker/load/connections/15min")
);
foreach ($infos as $info){
    echo "<tr>";
    echo "<td>$info[0]</td>";
    echo "<td id='$info[1]'></td>";
    echo "</tr>";
}

echo <<<END
              </tbody>
            </table>
		</div>
		
        <script src="bootstrap/js/jquery.js" type="text/javascript"></script>
        <script src="javascript/mqttws31.js"></script>
        <script>//<![CDATA[
        $(document).ready(function(){
        
          if( !window.WebSocket) {
            $("#host-status").html("\
                <h1>Get a new Web Browser!</h1>\
                <p>\
                Your browser does not support WebSockets. This example will not work properly.<br>\
                Please use a Web Browser with WebSockets support (WebKit or Google Chrome).\
                </p>\
            ");
          } else {
            
            var client, destination;
        
            var host = "$host";    
            var port = "$port";
            var clientId = "$client";
            var user = "$user";
            var password = "$password";
            
            destination = "\$SYS/#";

            client = new Messaging.Client(host, Number(port), clientId);
            
            client.onConnect = onConnect;
            
            client.onMessageArrived = onMessageArrived;
            client.onConnectionLost = onConnectionLost;            
            
            client.connect({
                userName:user, 
                password:password, 
                onSuccess:onConnect, 
                onFailure:onFailure
            }); 

        
            // the client is notified when it is connected to the server.
            function onConnect(frame) {
              debug("connected to MQTT");
              client.subscribe(destination);
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
            
            function onFailure(failure) {
              debug("failure");
              debug(failure.errorMessage);
            }  
        
            function onMessageArrived(message) {
              try {
                document.getElementById(message.destinationName).innerHTML=message.payloadString;
              } catch(err) {
                console.log(message.destinationName + ":" + message.payloadString);
              }
            }
        
            function onConnectionLost(responseObject) {
              if (responseObject.errorCode !== 0) {
                debug(client.clientId + ": " + responseObject.errorCode);
              }
            }
            
            
          }
        });    
    //]]></script>
END;

include 'bottom.php';
?>