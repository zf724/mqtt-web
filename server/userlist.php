<?php
include 'userheader.php';

echo <<<END

    <div class="container-fluid">
      <div class="row-fluid">
        <div class="span2">
          <div class="well sidebar-nav">
            <ul class="nav nav-list">
              <li class="nav-header">用户管理</li>
              <li class="active"><a href="userlist.php">用户列表</a></li>
            </ul>
          </div><!--/.well -->
        </div><!--/span-->
        <div class="span10">

<div class="btn-toolbar">
    <a class="btn btn-primary" href="usercreate.php">增  加</a>
<!--
    <button class="btn">导 入</button>
    <button class="btn">导出</button>
-->
</div>
END;

echo <<<END
		
<div class="well">
    <table class="table">
      <thead>
        <tr>
          <th>用户名</th>
          <th>备注</th>
		  <th>邮件</th>
          <th>状态</th>
          <th style="width: 36px;"></th>
        </tr>
      </thead>
      <tbody>
END;

$counts = mysqli_num_rows(queryMysql('SELECT * FROM user'));

if ((isset($_GET['offset']) == false) || $_GET['offset'] < 0){
    $offset = 0;
}else if ($_GET['offset'] + 1 > ceil($counts / $maxitemonepage)){
    $offset = ceil($counts / $maxitemonepage) - 1;
}else{
    $offset = $_GET['offset'];
}
$result = queryMysql(" select account,remark,email,status from user ORDER BY account asc LIMIT " . $offset * $maxitemonepage . ", $maxitemonepage");
$num = mysqli_num_rows($result);

for ($j = 0; $j < $num; ++$j) {
    $row = mysqli_fetch_row($result);

    echo <<<END
       <tr>
          <td>$row[0]</td>
          <td>$row[1]</td>
          <td>$row[2]</td>
          <td>$row[3]</td>
          <td>
              <a href="useredit.php?account=$row[0]"><i class="icon-pencil"></i></a>            
              <a href="javascript:void(0)" onclick="ConfirmDel('$row[0]')"><i class="icon-remove"></i></a>
          </td>
        </tr>
END;

}


echo <<<END

      </tbody>
    </table>
</div>

END;

if (ceil($counts / $maxitemonepage) > 1){
    echo "<div class='pagination'>";
    echo "<ul>";

echo "<li><a href='userlist.php?offset=" . ($offset-1) . "'>Prev</a></li>";

$first = floor($offset / $maxshowpage) * $maxshowpage;

for ($i = 0; $i < $maxshowpage && $i + $first < ceil($counts / $maxitemonepage) ; $i++){
    if (($i + $first) == $offset){
        echo "<li class='active'><a href='userlist.php?offset=" . ($i + $first) . "'>" . ($i + $first+1) . "</a></li>";
    }else {
        echo "<li><a href='userlist.php?offset=" . ($i + $first) . "'>" . ($i + $first+1) . "</a></li>";
    }
}

echo "<li><a href='userlist.php?offset=" . ($offset+1) . "'>Next</a></li>";

    echo "</ul>";
    echo "</div>";
}
echo <<<END

<div class="modal small hide fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
        <h3 id="myModalLabel">确认</h3>
    </div>
    <div class="modal-body">
        <p class="error-text">您确认删除这个用户吗?</p>
    </div>
    <div class="modal-footer">
        <button class="btn" data-dismiss="modal" aria-hidden="true">取消</button>
        <button class="btn btn-danger" data-dismiss="modal" onclick="deleteItem()">删除</button>
    </div>
</div>
<script>
    function ConfirmDel(item){
		$('#myModal').val(item);
		$('#myModal').modal('show');
	}
	function deleteItem(){
	    location.href = "userdelete.php?account=" + $('#myModal').val();
	}
</script>

END;

include 'bottom.php';
?>