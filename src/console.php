<?php
require_once("./config.php");

$con = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);
if(!$con) {
    echo '<script>alert("出错啦！错误码：0x2333333");window.history.back(-1);</script>';
}

$NumallResult = mysqli_query($con, "select count(id) from singer");
$NumboyResult = mysqli_query($con, "select count(id) from singer where gender='男'");
$Num1Result = mysqli_query($con, "select count(id) from singer where studentid like '".$Grade1."%'");
$Num2Result = mysqli_query($con, "select count(id) from singer where studentid like '".($Grade1-1)."%'");
$Num3Result = mysqli_query($con, "select count(id) from singer where studentid like '".($Grade1-2)."%'");
$Num4Result = mysqli_query($con, "select count(id) from singer where studentid like '".($Grade1-3)."%'");

$Numall = mysqli_fetch_array($NumallResult)[0];
$Numboy = mysqli_fetch_array($NumboyResult)[0];
$Numgirl = $Numall - $Numboy;
$Num1 = mysqli_fetch_array($Num1Result)[0];
$Num2 = mysqli_fetch_array($Num2Result)[0];
$Num3 = mysqli_fetch_array($Num3Result)[0];
$Num4 = mysqli_fetch_array($Num4Result)[0];
$Num5 = $Numall - $Num1 - $Num2 - $Num3 - $Num4;

echo '
总报名人数：'.$Numall.'<br/>
男：'.$Numboy.'<br/>
女：'.$Numgirl.'<br/>
大一：'.$Num1.'<br/>
大二：'.$Num2.'<br/>
大三：'.$Num3.'<br/>
大四：'.$Num4.'<br/>
其它：'.$Num5.'<br/><br/>
<a href="./index.html">返回主页</a><br/><br/>
<a href="./download.php">下载名单</a>';

mysqli_close($con);
?>
