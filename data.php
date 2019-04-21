<?php
	
	header("content-type:text/html;charset=utf-8");
    include "mysql.func.php";
    
	$start = $_POST["start"];
	$pageSize = $_POST["pageSize"];   
	$key = $_POST["key"];
	$type = $_POST["type"];  
	$link = conn("127.0.0.1", "test123", "test123", "test123");
	if($key==""){
		$arr = query($link, "select * from stus s join class c on c.cid= s.cid order by sid desc limit $start,$pageSize");
	  	$total = select($link, "stus" ,"count(1) sum");  //[0=>[sum=>xx]]
	 	$arr["total"] = $total[0]["sum"]; 
	 	echo json_encode($arr);
	}else {
		$arr = query($link, "select * from stus,class where $type like '%$key%' and stus.cid=class.cid order by sid asc limit $start,$pageSize");
		$total= query($link, "select count(1) sum from stus,class where $type like '%$key%' and stus.cid=class.cid");
	 	$arr["total"] = $total[0]["sum"]; 
	 	echo json_encode($arr);
	}
	