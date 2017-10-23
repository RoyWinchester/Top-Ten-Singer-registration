<?php
require_once("./config.php");

$con = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);
if(!$con) {
    echo '<script>alert("出错啦！错误码：0x2333333");window.history.back(-1);</script>';
}

$NumallResult = mysqli_query($con, "select count(id) from singer");
$NumallnanhuResult = mysqli_query($con, "select count(id) from singer where campus='南湖'");
$NumboyResult = mysqli_query($con, "select count(id) from singer where gender='男'");
$NumboynanhuResult = mysqli_query($con, "select count(id) from singer where gender='男' and campus='南湖'");
$Num1Result = mysqli_query($con, "select count(id) from singer where studentid like '".$Grade1."%'");
$Num1nanhuResult = mysqli_query($con, "select count(id) from singer where studentid like '".$Grade1."%' and campus='南湖'");
$Num2Result = mysqli_query($con, "select count(id) from singer where studentid like '".($Grade1-1)."%'");
$Num2nanhuResult = mysqli_query($con, "select count(id) from singer where studentid like '".($Grade1-1)."%' and campus='南湖'");
$Num3Result = mysqli_query($con, "select count(id) from singer where studentid like '".($Grade1-2)."%'");
$Num3nanhuResult = mysqli_query($con, "select count(id) from singer where studentid like '".($Grade1-2)."%' and campus='南湖'");
$Num4Result = mysqli_query($con, "select count(id) from singer where studentid like '".($Grade1-3)."%'");
$Num4nanhuResult = mysqli_query($con, "select count(id) from singer where studentid like '".($Grade1-3)."%' and campus='南湖'");

$Numall = mysqli_fetch_array($NumallResult)[0];
$Numallnanhu = mysqli_fetch_array($NumallnanhuResult)[0];
$Numallhunnan = $Numall - $Numallnanhu;
$Numboy = mysqli_fetch_array($NumboyResult)[0];
$Numboynanhu = mysqli_fetch_array($NumboynanhuResult)[0];
$Numboyhunnan = $Numboy - $Numboynanhu;
$Numgirl = $Numall - $Numboy;
$Numgirlnanhu = $Numallnanhu - $Numboynanhu;
$Numgirlhunnan = $Numgirl - $Numgirlnanhu;
$Num1 = mysqli_fetch_array($Num1Result)[0];
$Num1nanhu = mysqli_fetch_array($Num1nanhuResult)[0];
$Num1hunnan = $Num1 - $Num1nanhu;
$Num2 = mysqli_fetch_array($Num2Result)[0];
$Num2nanhu = mysqli_fetch_array($Num2nanhuResult)[0];
$Num2hunnan = $Num2 - $Num2nanhu;
$Num3 = mysqli_fetch_array($Num3Result)[0];
$Num3nanhu = mysqli_fetch_array($Num3nanhuResult)[0];
$Num3hunnan = $Num3 - $Num3nanhu;
$Num4 = mysqli_fetch_array($Num4Result)[0];
$Num4nanhu = mysqli_fetch_array($Num4nanhuResult)[0];
$Num4hunnan = $Num4 - $Num4nanhu;
$Num5 = $Numall - $Num1 - $Num2 - $Num3 - $Num4;
$Num5nanhu = $Numallnanhu - $Num1nanhu - $Num2nanhu - $Num3nanhu - $Num4nanhu;
$Num5hunnan = $Num5 - $Num5nanhu;

echo '
总报名人数：'.$Numall.'  南湖：'.$Numallnanhu.'  浑南：'.$Numallhunnan.'<br/>
男：'.$Numboy.'  南湖：'.$Numboynanhu.'  浑南：'.$Numboyhunnan.'<br/>
女：'.$Numgirl.'  南湖：'.$Numgirlnanhu.'  浑南：'.$Numgirlhunnan.'<br/>
大一：'.$Num1.'  南湖：'.$Num1nanhu.'  浑南：'.$Num1hunnan.'<br/>
大二：'.$Num2.'  南湖：'.$Num2nanhu.'  浑南：'.$Num2hunnan.'<br/>
大三：'.$Num3.'  南湖：'.$Num3nanhu.'  浑南：'.$Num3hunnan.'<br/>
大四：'.$Num4.'  南湖：'.$Num4nanhu.'  浑南：'.$Num4hunnan.'<br/>
其它：'.$Num5.'  南湖：'.$Num5nanhu.'  浑南：'.$Num5hunnan.'<br/><br/>
<a href="./index.html">返回主页</a><br/><br/>
<a href="./download.php?campus=all">下载总名单</a><br/><br/>
<a href="./download.php?campus=nanhu">下载南湖名单</a><br/><br/>
<a href="./download.php?campus=hunnan">下载浑南名单</a><br/><br/>';

mysqli_close($con);
?>
