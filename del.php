<?php
	header("content-type:text/html;charset=utf-8");
    include "mysql.func.php";
    $link = conn("127.0.0.1", "test123", "test123", "test123");
    $sid = $_REQUEST["sid"];
    if(is_array($sid)){
	  	
		$sid = join(",", $sid);
		  
	  }
    $re = del($link, "stus", "sid in($sid)");;
    if($re>0){
        echo "<script>";
        echo "alert('操作成功！')";
        echo "</script>";
        header("location:index.html");
    }else {
        echo "<script>";
        echo "alert('操作失败！')";
        echo "</script>";
        header("location:index.html");
    }
    