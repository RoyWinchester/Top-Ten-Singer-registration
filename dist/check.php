<?php
require_once("./config.php");

function test_input($data){
	$data = str_replace("'","\"","$data");
	$data = trim($data);
	$data = stripslashes($data);
	$data = htmlspecialchars($data);
	return $data;
}

if(!(isset($_POST["name"])&&isset($_POST["studentid"])&&isset($_POST["college"])&&isset($_POST["major"])&&isset($_POST["class"])&&isset($_POST["phone"])&&isset($_POST["qq"])&&isset($_POST["wechat"])&&isset($_POST["song"]))) {
    echo '<meta http-equiv="refresh" content="0;url=./index.html">';
    exit();
}

$Name = test_input($_POST["name"]);
$Studentid = test_input($_POST["studentid"]);
$College = test_input($_POST["college"]);
$Major = test_input($_POST["major"]);
$Class = test_input($_POST["class"]);
$Phone = test_input($_POST["phone"]);
$QQ = test_input($_POST["qq"]);
$Wechat = test_input($_POST["wechat"]);
$Song = test_input($_POST["song"]);
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

if($Err == ""&&empty($College))
    $Err = "请输入学院";

if($Err == ""&&empty($Major))
    $Err = "请输入专业";

if($Err == ""&&empty($Class))
    $Err = "请输入班级";

if($Err == ""&&empty($Phone))
    $Err = "请输入联系电话";
else if($Err == ""&&!ctype_digit($Phone))
    $Err = "请输入正确的联系电话";

if($Err == ""&&empty($QQ))
    $Err = "请输入QQ号";
else if($Err == ""&&!ctype_digit($QQ))
    $Err = "请输入正确的QQ号";

if($Err == ""&&empty($Wechat))
    $Err = "请输入微信";

if($Err == ""&&empty($Song))
    $Err = "请输入歌曲名称";

echo '<script>alert("'.var_dump($_FILES["photo"]).'");</script>';
if($Err == ""&&$_FILES["photo"]["error"] != 4) {
    if($_FILES["photo"]["type"] != NULL&&$_FILES["photo"]["type"] != "image/jpg"&&$_FILES["photo"]["type"] != "image/jpeg"&&$_FILES["photo"]["type"] != "image/png")
        $Err = "请选择正确的照片";
    else if($_FILES["photo"]["error"] == 1$_FILES["photo"]["size"] > 8000000)
        $Err = "文件过大";
    else if($_FILES["photo"]["error"] != 0)
        $Err = "文件上传失败";
}

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

if($_FILES["photo"]["error"] == 0)
    move_uploaded_file($_FILES["photo"]["tmp_name"], '../photos/'.$Studentid.'.'.explode("/", $_FILES["photo"]["type"], 2)[1]);

$res = mysqli_query($con, "insert into singer (name, studentid, gender, college, major, class, phone, qq, wechat, song, ip, time) values ('$Name', '$Studentid', '$Gender', '$College', '$Major', '$Class', '$Phone', '$QQ', '$Wechat', '$Song', '$IP', '$Time')");

if($res) {
    echo '<script>alert("恭喜您已成功报名");window.location.href="./index.html";</script>';
}
else {
    echo '<script>alert("出错啦！错误码：0x233334");window.history.back(-1);</script>';
}

mysqli_close($con);
?>
