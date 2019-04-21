<?php
	header("content-type:text/html;charset=utf-8");
    include "mysql.func.php";
    $link = conn("127.0.0.1", "test123", "test123", "test123");
    $arr = query($link, "select * from class");
    echo json_encode($arr);