<?php
	header("content-type:text/html;charset=utf-8");
    include "mysql.func.php";
    $link = conn("127.0.0.1", "test123", "test123", "test123");
    $sid = $_POST["sid"];
    $re = query($link,"select * from stus where sid=$sid");
    echo json_encode($re);


