<?php
require_once("./config.php");

function test_input($data){
	$data = str_replace("'","\"","$data");
	$data = trim($data);
	$data = stripslashes($data);
	$data = htmlspecialchars($data);
	return $data;
}

if(!(isset($_POST["name"])&&isset($_POST["studentid"])&&isset($_POST["major"])&&isset($_POST["class"])&&isset($_POST["phone"])&&isset($_POST["info"]))) {
    echo '<meta http-equiv="refresh" content="0;url=./index.html">';
    exit();
}

$Name = test_input($_POST["name"]);
$Studentid = test_input($_POST["studentid"]);
$Major = test_input($_POST["major"]);
$Class = test_input($_POST["class"]);
$Phone = test_input($_POST["phone"]);
$Info = test_input($_POST["info"]);
$IP = $_SERVER['REMOTE_ADDR'];
date_default_timezone_set("Asia/Shanghai");
$Time = date("Y-m-d H:i:s");

$Err = "";
if(empty($Name))
    $Err = "请输入姓名";

if($Err == ""&&empty($Studentid))
    $Err = "请输入学号";
else if($Err == ""&&!ctype_digit($Studentid))
    $Err = "请输入正确的学号";

if($Err == ""&&!isset($_POST["gender"]))
    $Err = "请选择性别";
if($Err == "") {
    $Gender = test_input($_POST["gender"]);
    if($Gender != "男"&&$Gender != "女")
        $Err = "请选择正确的性别";
}

if($Err == ""&&empty($Major))
    $Err = "请输入专业";

if($Err == ""&&empty($Class))
    $Err = "请输入班级";

if($Err == ""&&empty($Phone))
    $Err = "请输入联系电话";
else if($Err == ""&&!ctype_digit($Phone))
    $Err = "请输入正确的联系电话";

if($Err == ""&&empty($Info))
    $Err = "请输入自我介绍";

if($Err != "") {
    echo '<script>alert("'.$Err.'");window.history.back(-1);</script>';
    exit();
}

$con = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);
if(!$con) {
    echo '<script>alert("出错啦！错误码：0x2333333");window.history.back(-1);</script>';
}

$StudentidResult = mysqli_query($con, "select count(id) from singer where studentid='$Studentid'");
if(mysqli_fetch_array($StudentidResult)[0]) {
    echo '<script>alert("该学号已报名");window.history.back(-1);</script>';
    mysqli_close($con);
    exit();
}

$res = mysqli_query($con, "insert into singer (name, studentid, gender, major, class, phone, info, ip, time) values ('$Name', '$Studentid', '$Gender', '$Major', '$Class', '$Phone', '$Info', '$IP', '$Time')");

if($res) {
    echo '<script>alert("恭喜您已成功报名");window.location.href="./index.html";</script>';
}
else {
    echo '<script>alert("出错啦！错误码：0x233334");window.history.back(-1);</script>';
}

mysqli_close($con);
?>
