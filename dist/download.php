<?php
require_once("./config.php");

if(!isset($_GET["campus"])) {
    echo '<meta http-equiv="refresh" content="0;url=./index.html">';
    exit();
}

$con = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);
if(!$con) {
    echo '<script>alert("出错啦！错误码：0x2333333");window.history.back(-1);</script>';
}

if(file_exists(dirname(__FILE__).'/csv/singer.csv'))
    unlink(dirname(__FILE__).'/csv/singer.csv');

if($_GET["campus"] == "nanhu")
    $res = mysqli_query($con, "select singerid, studentid, name, gender, college, major, class, phone, qq, wechat, song from singer where campus='南湖' into outfile '".dirname(__FILE__)."/csv/singer.csv' character set gbk fields terminated by ',' enclosed by '\"' lines terminated by '\r\n'");
else if($_GET["campus"] == "hunnan")
    $res = mysqli_query($con, "select singerid, studentid, name, gender, college, major, class, phone, qq, wechat, song from singer where campus='浑南' into outfile '".dirname(__FILE__)."/csv/singer.csv' character set gbk fields terminated by ',' enclosed by '\"' lines terminated by '\r\n'");
else
    $res = mysqli_query($con, "select singerid, studentid, name, gender, college, major, class, phone, qq, wechat, song from singer into outfile '".dirname(__FILE__)."/csv/singer.csv' character set gbk fields terminated by ',' enclosed by '\"' lines terminated by '\r\n'");

if(!$res) {
    echo '<script>alert("'.mysqli_error($con).'");window.location.href="./index.html"</script>';
}

echo '<a href="./console.php">返回控制台</a><br/><br/>
<a href="./csv/singer.csv" download="singer.csv">下载名单</a>';
mysqli_close($con);
?>
