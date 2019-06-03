<?php
// php 操作mysql增删改查 

   //链接数据库
   
      function conn($host,$user,$password,$database,$charset="utf8"){
      	$link = mysqli_connect($host, $user, $password, $database);
	    	mysqli_set_charset($link, $charset);
        return $link;
      }

  // 查询 
  
  
  function select($link,$tbName,$cols="*",$where="",$group="",$order="",$limit=""){
	  // 传递 条件
	  if($where != ""){
		$where = " where ".$where;
	  }
	    if($group != ""){
		$group = " group by ".$group;
	  }
	      if($order != ""){
		$order = " order by ".$order;
	  }
	      if($limit != ""){
		$limit = " limit ".$limit;
	  }
	  // 组装select 语句
	 $sql = "select $cols from $tbName $where $group $order $limit";
	
	  $result =  mysqli_query($link, $sql);
	  if($result === flase){
	  	exit("查询语句有误!!!");
	  }else{
		   $arr = mysqli_fetch_all($result,MYSQLI_ASSOC);
	  }
	     mysqli_free_result($result);
		 return $arr;  // 返回数据
  }

  // 删除
  function del($link,$tbName,$where){
  	//组装sql语句 
  	if($where == null){
  		$sql = "truncate $tbName";
  	}else{
  			$sql = "delete from $tbName  where $where";
  	}
	//echo $sql;
	  mysqli_query($link, $sql);
	  return  mysqli_affected_rows($link);
  }

  // 新增
  function add($link,$tbname,$arr){
     $keys = array_keys($arr);  // [name,sex,cid]
     $cols = join(",", $keys);
     $vals = array_values($arr);  // [memeda,男] 
	  $values = "'".join("','", $vals)."'";
  	$sql = "insert $tbname($cols) value ($values)";
	 //echo $sql;
	  mysqli_query($link, $sql);
	  return mysqli_affected_rows($link);
  }
  //修改
  function save($link,$tbname,$arr,$where){
		   $str ="";
		  foreach($arr as $k=>$v){
			$str .= $k."='".$v."',";
		  }
		 $str =  trim($str,",");
		if($where !=null){
			$where = " where ".$where;
		}
  	 $sql = "update $tbname set $str $where";
	  mysqli_query($link, $sql);
	  return  mysqli_affected_rows($link); 
  }
  //  query  所有复杂语句
  
    function query($link,$sql){
		
		$arr = ["select","update","delete","insert"];
		// 过滤空格
		  $sql= trim($sql);  // trim(str,",")
		  $type= substr($sql, 0,6);
		  if(in_array($type, $arr)){
			    if($type == "select"){
			    	// 查询
			    	// @  错误抑制符
			    	@ $result = mysqli_query($link, $sql);  // false  obj
			    	if($result === false){
						exit("查询语句拼写有误!!!");
			    	}else{
				 	@ $arr =	mysqli_fetch_all($result,MYSQLI_ASSOC);
					return $arr;
			    	}
			    }else{
			    	// 增删改
			    	$re= mysqli_query($link, $sql); // true false
			    	if($re === false){
						exit("语句拼写有误!!");
			    	}else{
						 return mysqli_affected_rows($link);
			    	}
			    }
		  }else{
		  	
			 exit("sql语句非法!!!");
		  }
    }
  
  //query("xx","     select  iofhvoewhw * from xxx");
