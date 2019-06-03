
<?php

session_start();
	    // 非法请求验证 
	    header("content-type:text/html;charset=utf-8");
	      if(!$_SESSION["userinfo"]){
	      	     	 echo "<script>";
	  echo "alert('非法请求，请先登录!!!');";
	  echo "location.href='index.php';";
	   echo "</script>";
			             
						    exit();      
	      }

?>

<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<title>管理系统</title>
		<link href="//netdna.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
		<link rel="stylesheet" href="https://cdn.bootcss.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
	</head>
	<style>
tr,th{
		text-align: center;
		height: 20px;

	}
	.vip{
		height: 500px;
	}
.form-control{
	width:300px;
	display: inline-block;
}
#xixi{
	font-size:20px; 
	color: green;
}
.haha{
	margin-top: 10px;
}
.custom-select{
	width:150px;
	margin-top: -5px;
}
.btn-outline-warning,.btn-outline-success{
	margin-top:-5px; 
}

	</style>

	<body>
		
		 <div id="" class="container">
				<center class="haha">
						
						<span id="xixi">选择搜索类型：</span>	
						 <select name="type" id="inputGroupSelect01" class="custom-select">
							 <option value="sname">学生姓名</option>
							 <option value="cname">班级</option>
						 </select>
						 <input type="text" name="keyword"  class="form-control" placeholder="请输入关键字"/>
						 <button class="btn btn-outline-warning" id="btn1"><span class="fa fa-search"></span> 开始搜索</button>
						 <a href="add.html">
						<button class="btn btn-outline-success " id="btn2"><span class="fa fa-check-square-o"></span> 新增数据</button>
						</a>
						
					</center>
					<form action="del.php" method="post">
		 	  <table style="margin-top:20px;" border="" class="table table-bordered table-hover table-striped" cellspacing="" cellpadding="">
		 	  	<tr>
		 	  		
		 	  		<th class='bg-success'>
		 	  			<input type="checkbox" id="all" value=""  />
		 	  		</th>
		 	  		<th class='bg-success'>学号</th>
		 	  		<th class='bg-success'>性别</th>
		 	  		<th class='bg-success'>姓名</th>
		 	  		<th class='bg-success'>班级</th>
		 	  		<th class='bg-success'>分数</th>
		 	  		<th class='bg-success'>操作</th>
		 	  		
		 	  	</tr>
		 	  	 	<tr class="end">
		 	  		<td colspan="7" align="center">
		 	  			当前第<span id="cpage" class="text-info">1</span>页
		 	  			共<span id="tpage" class="text-danger">?</span>页
						   <input type="submit" id="" value="删除选中" class="btn btn-outline-success" />   
						   <button type="button" id="first" class="btn btn-outline-success"><span class="fa fa-undo"></span> 首页</button>
		 	  			<button type="button" id="prev" class="btn btn-outline-success "><span class="fa fa-arrow-left"></span> 上一页</button>
		 	  			<button type="button" id="next" class="btn btn-outline-success ">下一页 <span class="fa fa-arrow-right"></span> </button>
		 	  			<button type="button" id="total" class="btn btn-outline-success "><span class="fa fa-github-alt"></span> 尾页</button>
		 	  		</td>
		 	  	</tr>
			   </table>
			   </form>
				 	<div class="vip">


					 </div>
		 	
		 </div>
		
	</body>
	<script src="https://text.xiaohuwei.cn/weather/jquery-1.12.4.min.js"></script>
	<script type="text/javascript">
//初始加载 无条件显示 封一个函数吧
var start = 0;
var ye = 1;
var endye = 0;
var zs = 0;
var key;
var type;
function svip(start,pageSize='10',key="",type=null){
	$.post("data.php",{start,pageSize,key,type},(res)=>{
					res = JSON.parse(res);
					zs = res.total; 
					if(zs==0){
							alert("抱歉，没有您的查询结果！");
							window.location.href="index.html";
					}else{
					endye = Math.ceil(res.total/10);
					times = endye;
					$("#tpage").html(endye);
					delete res.total;
					$(".nihao").remove();
					for(i in res){
					var str = `<tr class='nihao'>
		 	  		<th>
		 	  		<input type="checkbox" name="sid[]" value="${res[i].sid}" />
		 	  		</th>
		 	  		<th >${res[i].sid}</th>
		 	  		<th>${res[i].sex}</th>
		 	  		<th>${res[i].sname}</th>
		 	  		<th>${res[i].cname}</th>
		 	  		<th>${res[i].score}</th>
		 	  		<th><a href="javascript:void(0)" class="btn btn-danger btn-sm" onclick="del(${res[i].sid})">删除</a>&nbsp;&nbsp;&nbsp;
		 	  			<a href="change.html?sid=${res[i].sid}" class="btn btn-success btn-sm">修改</a></th>
		 	  	    </tr>`;
					 $(".end").before(str);

					}
					//定义多选
			 document.getElementById("all").onclick=function(){
				
			 var id = document.getElementsByName("sid[]");
			 
			 if(this.checked){
					for(k in id){
							id[k].checked = true;
					}
			 }else{
					for(k in id){
							id[k].checked = false;
					}
			 }

	  }


			}
	})
	
}
svip(start);
//初始加载结束了哦

//下一页功能实现
$("#next").click(()=>{
	
				if(ye>=endye){
					ye=endye;
					start=start;
				}else{
					start+=10;
					ye++;
				}
				$("#cpage").html(ye);
			
				svip(start,pageSize='10',key,type);
})
//上一页功能
$("#prev").click(()=>{
				if(start<=0){
					start=0;
					ye=1;
				}else{
					start-=10;
					ye--;
				}
				svip(start,pageSize='10',key,type);
				$("#cpage").html(ye);
})
//定义首页功能
$("#first").click(()=>{
			ye=1;
		$("#cpage").html(ye);
			start=0;
		svip(start,pageSize='10',key,type);
})
//定义尾页

$("#total").click(()=>{
ye=endye;
$("#cpage").html(ye);
start=(endye-1)*10;
svip(start,pageSize='10',key,type);
})

//下拉加载开始啦
var flag = true;
var  times = 0; // 触发10 
var  currentTime =0;
$(window).scroll(function(){
var offHeight = document.documentElement.offsetHeight
var cHeight = document.documentElement.clientHeight
var  stop =  document.documentElement.scrollTop || document.body.scrollTop
var sBottom = offHeight-cHeight-stop;

// 滚动条 距离底部 小于 90 触发


if(sBottom <0.5 && currentTime<times){
ye++;
$("#cpage").html(ye);
if(ye>=endye){
	ye=endye;
	$("#cpage").html(ye);
}
start+=10;
if(flag){
//console.log(sBottom)
currentTime++;
if(currentTime>=times){
	alert("到底了！")
}
$.post("data.php",{start,pageSize:'10',key,type},(res)=>{
res = JSON.parse(res);
delete res.total;
for(i in res){
var str = `<tr class='nihao'>
		 	  		<th>
		 	  		<input type="checkbox" name="sid[]" value="${res[i].sid}" />
		 	  		</th>
		 	  		<th >${res[i].sid}</th>
		 	  		<th>${res[i].sex}</th>
		 	  		<th>${res[i].sname}</th>
		 	  		<th>${res[i].cname}</th>
		 	  		<th>${res[i].score}</th>
		 	  		<th><a href="javascript:void(0)" class="btn btn-danger btn-sm" onclick="del(${res[i].sid})">删除</a>&nbsp;&nbsp;&nbsp;
		 	  			<a href="change.html?sid=${res[i].sid}" class="btn btn-success btn-sm">修改</a></th>
		 	  	    </tr>`;
$(".end").before(str);
}


})
}
flag=false;
}else{
flag =true;
}



})
//搜索按钮
$("#btn1").click(()=>{
 	key = $(".form-control").val();
	type = $(".custom-select").val();
	if(!key){
		alert("请输入关键字");
	}
	ye=1;
	start=0;
	$("#cpage").html(ye);
	svip(start,pageSize='10',key,type);
})
//删除函数
var del=(sid)=>{
	$.get("del.php",{sid},(res)=>{
		if(res=="删除成功"){
			alert("成功！");
			svip(start,pageSize='10',key,type);
		}else{
			alert("失败！");
		}
	})
}

	</script>
</html>
