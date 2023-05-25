<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Phone Shop</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.7 -->
    <link rel="stylesheet" href="../assets/admin/layout1/css/bootstrap.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="../assets/admin/layout1/css/font-awesome.min.css">
    <link rel="stylesheet" href="../assets/admin/layout1/css/AdminLTE.min.css">
    <!-- AdminLTE Skins. Choose a skin from the css/skins
         folder instead of downloading all of them to reduce the load. -->
    <link rel="stylesheet" href="../assets/admin/layout1/css/_all-skins.min.css">
    <!-- Google Font -->
    <link rel="stylesheet"
          href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
    <!-- load file ckeditor.js vao day de hien thi editor o text area -->
    <script type="text/javascript" src="../assets/ckeditor/ckeditor.js"></script>
</head>
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">
<?php
  if (!isset($_COOKIE['admin'])) {
  echo "<script> location.href='index.php?controller=login&action=logout'; </script>";   
  }
  setcookie('admin', 'abc', time()+600);
?>
    <header class="main-header" style="position: fixed;width:100%;">
        <!-- Logo -->
        <a href="index.php" class="logo position-fixed" >
            <!-- mini logo for sidebar mini 50x50 pixels -->
            <span class="logo-mini"><b>P</b>hone</span>
            <!-- logo for regular state and mobile devices -->
            <span class="logo-lg"><b>Phone Shop</b></span>
        </a>
        <!-- Header Navbar: style can be found in header.less -->
        <nav class="navbar navbar-static-top">
            <!-- Sidebar toggle button-->
            <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
                <span class="sr-only">Toggle navigation</span>
            </a>

            <div class="navbar-custom-menu hidden-lg">
                <ul class="nav navbar-nav">
                    <!-- User Account: style can be found in dropdown.less -->
                    <li class="dropdown user user-menu">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                            <img src="../assets/admin/layout1/images/user2.jpg" class="user-image" alt="User Image">
                            <span class="hidden-xs"><?php echo $_SESSION["name"] ?></span>
                        </a>
                        <ul class="dropdown-menu">
                            <!-- User image -->
                            <li class="user-header">
                                <img src="../assets/admin/layout1/images/user2.jpg" class="img-circle" alt="User Image">

                                <p>
                                    <?php echo $_SESSION["name"] ?>
                                    <small>Web developer</small>
                                </p>
                            </li>
                            <!-- Menu Footer-->
                            <li class="user-footer">
                                <div class="pull-left">
                                    <a href="index.php?controller=users&action=update&id=<?php echo $_SESSION["id"]; ?>" class="btn btn-default btn-flat">Profile</a>
                                </div>
                                <div class="pull-right">
                                    <a href="index.php?controller=login&action=logout" class="btn btn-default btn-flat">Sign out</a>
                                </div>
                            </li>
                        </ul>
                    </li>
                </ul>
            </div>
        </nav>
    </header>
    <!-- Left side column. contains the logo and sidebar -->
    <aside class="main-sidebar" style="position: fixed;">
        <!-- sidebar: style can be found in sidebar.less -->
        <section class="sidebar">
            <!-- Sidebar user panel -->
            <div class="user-panel hidden-xs">
                <div class="pull-left image">
                    <img src="../assets/admin/layout1/images/user2.jpg" class="img-circle" alt="User Image">
                </div>
                <div class="pull-left info">
                    <a href="index.php?controller=users&action=update&id=<?php echo $_SESSION["id"]; ?>">
                        <h4 style="margin-top:0px;"><?php echo $_SESSION["name"] ?></h4>
                        <i class="fa fa-circle text-success"></i>
                         Online
                    </a>
                </div>
            </div>
            <!-- sidebar menu: : style can be found in sidebar.less -->
            <ul class="sidebar-menu" data-widget="tree">
                <li class="header hidden-xs"><?php echo $_SESSION["email"] ?></li>
                <?php if($_SESSION["role"]== 1):?>
                <li>
                    <a href="index.php?controller=users">
                        <i class="fa fa-user-circle-o"></i> <span>Quản lý user</span>
                    </a>
                </li>
                <li>
                    <a href="index.php?controller=statistic">
                        <i class="fa fa-line-chart"></i> <span>Thống kê</span>
                    </a>
                </li>
                <?php endif;?>
                <?php if($_SESSION["role"]== 1||$_SESSION["role"]== 2):?>
                <li>
                    <a href="index.php?controller=customers">
                        <i class="fa fa-users"></i> <span>Quản lý Khách hàng</span>
                    </a>
                </li>
                <li>
                    <a href="index.php?controller=orders">
                        <i class="fa fa-list"></i> <span>Đơn hàng</span>
                    </a>
                </li>
                <li>
                    <a href="index.php?controller=rating">
                        <i class="fa fa-comments"></i> <span>Đánh giá sản phẩm</span>
                    </a>
                </li>
                <li>
                    <a href="index.php?controller=feedbacks">
                        <i class="fa fa-comment"></i> <span>Góp ý</span>
                    </a>
                </li>
                <?php endif;?>
                <?php if($_SESSION["role"]== 1||$_SESSION["role"]== 3):?>
                <li>
                    <a href="index.php?controller=categories">
                        <i class="fa fa-list-ol"></i> <span>Danh mục sản phẩm</span>
                    </a>
                </li>
                <li>
                    <a href="index.php?controller=products">
                        <i class="fa fa-list-alt"></i> <span>Sản phẩm</span>
                    </a>
                </li>
                <li>
                    <a href="index.php?controller=news">
                        <i class="fa fa-newspaper-o"></i> <span>Tin tức</span>
                    </a>
                </li>
                <?php endif;?>
                <li>
                    <a href="index.php?controller=login&action=logout">
                        <i class="fa fa-sign-out"></i> <span>Đăng xuất</span>
                    </a>
                </li>
            </ul>
        </section>
        <!-- /.sidebar -->
    </aside>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper" style="margin-top: 50px;">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
            <?php if($_SESSION["role"]== 1):?>Admin<?php endif;?>
                <small>Control panel</small>
            </h1>
            <ol class="breadcrumb">
                <li> 
                <p id="demo"></p>
                    <script>
                        var countDownDate = <?php echo time()+600 ?> * 1000;
                        var now = <?php echo time() ?> * 1000;
                        // Update the count down every 1 second
                        var x = setInterval(function() {
                            // Get todays date and time
                            now = now + 1000;

                            // Find the distance between now an the count down date
                            var distance = countDownDate - now;

                            // Time calculations for days, hours, minutes and seconds
                            var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
                            var seconds = Math.floor((distance % (1000 * 60)) / 1000);

                            // Output the result in an element with id="demo"
                            document.getElementById("demo").innerHTML ="<i class='fa fa-dashboard'></i>Phiên làm việc còn lại " 
                            + minutes + "m " + seconds + "s ";

                            // If the count down is over, write some text 
                            if (distance < 0) {
                                clearInterval(x);
                                document.getElementById("demo").innerHTML = "Phiên làm việc đã hết hạn";
                                document.getElementById("report").innerHTML = "";
                            }
                        }, 1000);
                    </script>
                </li>
            </ol>
        </section>

        <!-- Main content -->
        <section class="content container-fluid">
            <?php echo $this->view; ?>
        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
    <footer class="main-footer">
        <div class="pull-right hidden-xs">
            <b>Version</b> 3.1.0
        </div>
        <strong>Copyright &copy; by TheNova <a href="https://adminlte.io">Admin</a>.</strong> All rights
        reserved.
    </footer>
    <!-- Add the sidebar's background. This div must be placed
         immediately after the control sidebar -->
    <div class="control-sidebar-bg"></div>
</div>
<!-- ./wrapper -->

<!-- jQuery 3 -->
<script src="../assets/admin/layout1/js/jquery.min.js"></script>
<!-- jQuery UI 1.11.4 -->
<script src="../assets/admin/layout1/js/jquery-ui.min.js"></script>
<!-- Bootstrap 3.3.7 -->
<script src="../assets/admin/layout1/js/bootstrap.min.js"></script>
<!-- AdminLTE App -->
<script src="../assets/admin/layout1/js/adminlte.min.js"></script>
<!-- chart -->
<script src="../assets/admin/layout1/js/chart.min.js"></script>
</body>
</html>
