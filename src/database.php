<?php
require_once("./config.php");

$con = mysqli_connect($dbhost, $dbuser, $dbpass);
if(!$con) {
    die('Could not connect to database: '.mysqli_connect_error());
}

mysqli_query($con, 'create database '.$dbname);
mysqli_select_db($con, $dbname);

mysqli_query($con, 'create table singer(
                    id int not null auto_increment,
                    name varchar(30) not null,
                    studentid varchar(30) not null unique,
                    gender varchar(30) not null,
                    major varchar(30) not null,
                    class varchar(30) not null,
                    phone varchar(30) not null,
                    info varchar(3000) not null,
                    ip varchar(30) not null,
                    time datetime not null,
                    primary key (id))');

mysqli_close($con);
?>
