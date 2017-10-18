<?php
$con = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);
if(!$con) {
    echo '<script>alert("出错啦！错误码：0x2333333");window.history.back(-1);</script>';
}

if(file_exists(dirname(__FILE__).'/singer.xls'))
    unlink(dirname(__FILE__).'/singer.xls');
$res = mysqli_query($con, "select studentid, name, gender, major, class, phone, info into outfile '".dirname(__FILE__)."/singer.xls' from singer");

if(!$res) {
    echo '<script>alert("'.mysqli_error($con).'");window.location.href="./index.html"</script>';
}

echo '<meta http-equiv="refresh" content="0;url=./singer.xls">';
echo '文件已经开始下载，<a href="./console.php">点击此处</a>返回控制台。';
?>
