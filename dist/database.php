<?php
require_once("./config.php");

$con = mysqli_connect($dbhost, $dbuser, $dbpass);
if(!$con) {
    die('Could not connect to database: '.mysqli_connect_error());
}

mysqli_query($con, 'create database '.$dbname);
mysqli_select_db($con, $dbname);

/* 数据表结构
 * id: 由选手报名次序决定的唯一id
 * name: 姓名
 * studentid: 学号
 * gender: 性别（值：男，女）
 * campus: 校区（值：南湖， 浑南）
 * college: 学院（自己填写）
 * major: 专业（自己填写）
 * class: 班级（自己填写）
 * phone: 手机号
 * qq：QQ号
 * wechat: 微信号
 * email: 邮箱地址
 * song: 报名歌曲
 * singerid: 参赛编号
 * ip: 报名IP地址
 * time: 报名时间
 */

mysqli_query($con, 'create table singer(
                    id int not null auto_increment,
                    name varchar(30) not null,
                    studentid varchar(30) not null unique,
                    gender varchar(30) not null,
                    campus varchar(30) not null,
                    college varchar(30) not null,
                    major varchar(30) not null,
                    class varchar(30) not null,
                    phone varchar(30) not null,
                    qq varchar(30) not null,
                    wechat varchar(30) not null,
                    email varchar(30) not null,
                    song varchar(300) not null,
                    singerid varchar(30) not null,
                    ip varchar(30) not null,
                    time datetime not null,
                    primary key (id))');

mysqli_close($con);
?>
