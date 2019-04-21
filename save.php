<?php
	header("content-type:text/html;charset=utf-8");
    include "mysql.func.php";
    $link = conn("127.0.0.1", "test123", "test123", "test123");
    $sid = $_POST["sid"];
    $sex = $_POST["sex"];
    $sname = $_POST["sname"];
    $score = $_POST["score"];
    $cid = $_POST["cid"];
    $re = query($link,"update stus set cid='$cid',sname='$sname',sex='$sex',score='$score' where sid=$sid");
    if($re>0){
        echo "1";
    }else {
        echo "0";
    }