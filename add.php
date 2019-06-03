<?php
	header("content-type:text/html;charset=utf-8");
    include "mysql.func.php";
    $link = conn("127.0.0.1", "test123", "test123", "test123");
    $re = add($link,"stus",$_POST);
    if($re>0){
        echo "1";
    }else {
        echo "0";
    }