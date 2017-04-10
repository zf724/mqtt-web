<?php

$default = "http://" . $_SERVER['SERVER_NAME'];

echo <<<END
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>页面不存在</title>
</head>
<body>
<script type="text/javascript"
        src="http://www.qq.com/404/search_children.js"
        charset="utf-8"
        homePageUrl=$default
        homePageName="回到主页"></script>
</body>
</html>
END;

?>