<?php
require_once("./config.php");

$con = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);
if(!$con) {
    echo '<script>alert("出错啦！错误码：0x2333333");window.history.back(-1);</script>';
}

if(file_exists(dirname(__FILE__).'/singer.csv'))
    unlink(dirname(__FILE__).'/singer.csv');

$res = mysqli_query($con, "select studentid, name, gender, college, major, class, phone, qq, wechat, song from singer into outfile '".dirname(__FILE__)."/singer.csv' character set gbk fields terminated by ',' enclosed by '\"' lines terminated by '\r\n'");

if(!$res) {
    echo '<script>alert("'.mysqli_error($con).'");window.location.href="./index.html"</script>';
}

echo '<a href="./console.php">返回控制台</a><br/><br/>
<a href="./singer.csv" download="singer.csv">下载名单</a>';
?>
