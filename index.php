<?php
	
	header("content-type:text/html;charset=utf-8");
    include "mysql.func.php";
    session_start();
    $link = conn("127.0.0.1", "test123", "test123", "test123");
    $user = $_POST["name"];
    $pwd = $_POST["password"];
    if($user!="" && $pwd!=""){

        $row = select($link, "admin","*","userName ='$user' and password ='$pwd' ");
        
        if($row){
            // 登录 成功   保存 用户信息
            $_SESSION["userinfo"] = $row[0];
             
           
           echo "<script>";
             echo "alert('登录成功，点击进入后台管理!');";
             echo "location.href='admin.php';";
              echo "</script>";
           
        }else{
           echo "<script>";
             echo "alert('账号或者密码有误！');";
             echo "location.href='index.php';";
              echo "</script>";
        }

    }
   
    if($_SESSION["userinfo"]){
        echo "<script>";
        echo "location.href='admin.php';";
         echo "</script>";
    }
    
    ?>

<!-- create table admin(
id int unsigned  primary key auto_increment,
userName char(50) unique not null,
password char(50) not null
); -->

<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="renderer" content="webkit">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>欢迎登录</title>
    <meta name="robots" content="noindex, nofollow">
    <link rel="stylesheet" href="https://blog.xiaohuwei.cn/svip/css/normalize.css?v=17.10.30">
<link rel="stylesheet" href="https://blog.xiaohuwei.cn/svip/css/grid.css?v=17.10.30">
<link rel="stylesheet" href="https://blog.xiaohuwei.cn/svip/css/style.css?v=17.10.30">
        <link rel="stylesheet" href="https://blog.xiaohuwei.cn/svip/Apex/css/nucleo.css" type="text/css">
    <link rel="stylesheet" href="https://blog.xiaohuwei.cn/svip/Apex/css/all.min.css" type="text/css">
    <!-- Page plugins -->
    <link rel="stylesheet" href="https://blog.xiaohuwei.cn/svip/Apex/css/fullcalendar.min.css">
    <link rel="stylesheet" href="https://blog.xiaohuwei.cn/svip/Apex/css/sweetalert2.min.css">
    <link rel="stylesheet" href="https://blog.xiaohuwei.cn/svip/Apex/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="https://blog.xiaohuwei.cn/svip/Apex/css/argon.min.css?v=1.0.0" type="text/css">
    <link rel="stylesheet" href="https://blog.xiaohuwei.cn/svip/Apex/css/admin-css.css" type="text/css">

</head>
<body>


<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Start your development with a Dashboard for Bootstrap 4.">
    <meta name="author" content="Creative Tim">
</head>

<body class="bg-default">
<!-- Main content -->
<div class="main-content">
    <!-- Header -->
    <div class="header bg-gradient-primary py-7 py-lg-8 pt-lg-9">
        <div class="container">
            <div class="header-body text-center mb-7">
                <div class="row justify-content-center">
                    <div class="col-xl-5 col-lg-6 col-md-8 px-5">
                        <h1 class="text-white">数据管理中心</h1>
                        <p class="text-lead text-white"><span id="jinrishici-sentence">名可名，非常名。</span>
<script src="https://sdk.jinrishici.com/v2/browser/jinrishici.js" charset="utf-8"></script>
</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="separator separator-bottom separator-skew zindex-100">
            <svg x="0" y="0" viewBox="0 0 2560 100" preserveAspectRatio="none" version="1.1" xmlns="http://www.w3.org/2000/svg">
                <polygon class="fill-default" points="2560 0 2560 100 0 100"></polygon>
            </svg>
        </div>
    </div>
    <!-- Page content -->
    <div class="container mt--8 pb-5">
        <div class="row justify-content-center">
            <div class="col-lg-5 col-md-7">
                <div class="card bg-secondary border-0 mb-0">
                    <div class="card-header bg-transparent pb-5">
                        <div class="text-muted text-center mt-2 mb-3"><small>肖虎威开发的后台管理系统</small></div>

                    </div>
                    <div class="card-body px-lg-5 py-lg-5">
                        <form action="index.php" method="post" name="login" role="form">
                            <div class="form-group mb-3">
                                <div class="input-group input-group-merge input-group-alternative">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">账号</span>
                                    </div>
                                    <input type="text" id="name" name="name" value="" placeholder="用户名" class="form-control" autofocus />
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="input-group input-group-merge input-group-alternative">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">密码</span>
                                    </div>
                                    <input type="password" id="password" name="password" class="form-control" placeholder="密码" />
                                </div>
                            </div>
                            <div class="custom-control custom-control-alternative custom-checkbox">
                                <input class="custom-control-input checkbox" name="remember" id=" customCheckLogin" type="checkbox" value="1">
                                <label class="custom-control-label" for=" customCheckLogin">
                                    <span class="text-muted">下次自动登录</span>
                                </label>
                            </div>
                            <div class="text-center">
                                <button type="submit" class="btn btn-primary my-4">登录</button>
                                <input type="hidden" name="referer" value="https://blog.xiaohuwei.cn/svip/" />
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Footer -->
<footer class="py-5" id="footer-main">
    <div class="container">
        <div class="row align-items-center justify-content-xl-between">
            <div class="col-xl-6">
                <div class="copyright text-center text-xl-left text-muted">
                    Copyright ©  2019 xiaohuwei.cn Limited All Rights Reserved.
                    <a href="http://www.xiaohuwei.cn/" class="font-weight-bold ml-1" target="_blank"> 肖虎威</a>
                </div>
            </div>

        </div>
    </div>
</footer>
</body>
</html>
</body>

</html>


