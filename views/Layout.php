<!DOCTYPE html>
<html lang="en">
<head>
<title>Phone Shop</title>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="description" content="Colo Shop Template">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" type="text/css" href="assets/styles/bootstrap4/bootstrap.min.css">
<link href="assets/plugins/font-awesome-4.7.0/css/font-awesome.min.css" rel="stylesheet" type="text/css">
<link rel="stylesheet" type="text/css" href="assets/plugins/OwlCarousel2-2.2.1/owl.carousel.css">
<link rel="stylesheet" type="text/css" href="assets/plugins/OwlCarousel2-2.2.1/owl.theme.default.css">
<link rel="stylesheet" type="text/css" href="assets/plugins/OwlCarousel2-2.2.1/animate.css">
<link rel="stylesheet" type="text/css" href="assets/styles/main_styles.css">
<link rel="stylesheet" type="text/css" href="assets/styles/responsive.css">
<?php if(isset($_SESSION["success"])):?>
	<script>
		function thongbao() {
		window.alert("<?php echo $_SESSION["success"];?>");
		}
	</script>
<?php endif;?>
</head>
<body class="h-100" style="background-image:url(assets/images/bg_1.png);bottom:0;" <?php if(isset($_SESSION["success"])) {echo 'onload="thongbao()"';unset($_SESSION["success"]);}?>>

<div class="super_container container h-100">
	<!-- Header -->
	
	<header class="header trans_300">
		<div class="main_nav_container">
			<div class="container">
				<div class="row">
					<div class="col-lg-12 text-right">
						<div class="logo_container col-2 col-lg-3 float-left">
							<a href="index.php">Phone<span>shop</span></a>
						</div>
						<div class="col-lg-9 col-10 float-right">
							<nav class="navbar row "> 
								<from method="post" class="col-lg-8 col-1 float-left" action="" onchange="search()">
									<div class="navbar-search input-group  input-group-lg">
										<input type="text" class="form-control" id="searchbox" placeholder="Nhập tên điện thoại cần tìm..." name="search">
										<div class="input-group-append" >
											<a id="btnsearch">
											<input type="submit" value="Tìm kiếm" class="btn btn-outline-primary btn-lg"></a>
										</div>
									</div>
								</from>
								<script>
									function search(){
										var x=document.getElementById("searchbox").value;
										x='index.php?controller=products&action=btnsearch&search='+x;
										document.getElementById("btnsearch").setAttribute("href", x); 
									}
								</script>
								<div class="col-lg-4 col-1">
									<ul class="navbar_user navbar-search">
										<li class="account">
											<div class="top_nav_right">
												<ul class="top_nav_menu">

													<!--  My Account -->

													<li class="account">
														<a href="#"><i class="fa fa-user" aria-hidden="true"></i></a>
														<ul class="account_selection" style="width: 120px;">
                                                        <?php if(isset($_SESSION['customer_id'])):?>
															<li style="width: 120px;line-height: 20px;color:#FF6347;"><p class="font-italic main_color m-0" >Xin chào:</p>
																<a href="index.php?controller=customers&action=update&id=<?php echo $_SESSION['customer_id'];?>">
																	<!--<i class="fa fa-user"></i> <span>Tài khoản</span> -->
																	<span><?php if(!empty($_SESSION['customer_name'])) echo $_SESSION['customer_name']; else echo $_SESSION['customer_phone'];?></span>
																</a>
															</li>
															<li style="width: 120px;">
																<a href="index.php?controller=orders">
																	<span>Lịch sử giao dịch</span>
																</a>
															</li>
															<li style="width: 120px;">
																<a href="index.php?controller=login&action=logout">
																	<i class="fa fa-sign-out"></i> <span>Đăng xuất</span>
																</a>
															</li>
                                                        <?php else:?>
															<li><a href="index.php?controller=login&action=login"><i class="fa fa-sign-in" aria-hidden="true"></i>Đăng nhập</a></li>
															<li><a href="index.php?controller=customers&action=register"><i class="fa fa-user-plus" aria-hidden="true"></i>Đăng kí</a></li>
                                                        <?php endif;?>
														</ul>
													</li>
												</ul>
											</div>
										</li>
										<li class="checkout">
											<a href="index.php?controller=carts">
												<i class="fa fa-shopping-cart" aria-hidden="true"></i>
												<?php if(!empty($_SESSION["countcart"])):?>
													<span id="checkout_items" class="checkout_items">
														<?php echo $_SESSION["countcart"];?>
													</span>
												<?php endif;?>
											</a>
										</li>
									</ul>
								</div>
								<div class="hamburger_container col-6 float-right">
									<i class="fa fa-bars" aria-hidden="true"></i>
								</div>
							</nav>
						</div>
					</div>
				</div>
			</div>
		</div>

	</header>

	<div class="fs_menu_overlay"></div>
	<div class="hamburger_menu">
		<div class="hamburger_close"><i class="fa fa-times" aria-hidden="true"></i></div>
		<div class="hamburger_menu_content text-right">
			<ul class="menu_top_nav">
				<li class="menu_item has-children">
					<a href="#">
						Tài khoản
						<i class="fa fa-angle-down"></i>
					</a>
					<ul class="menu_selection">
					<?php if(isset($_SESSION['customer_id'])):?>
							<li>
								<a href="index.php?controller=customers&action=update&id=<?php echo $_SESSION['customer_id'];?>">
									<span><p class="font-italic main_color m-0" >
										<?php if(!empty($_SESSION['customer_name'])) echo $_SESSION['customer_name']; else echo $_SESSION['customer_phone'];?></p> 
									</span>
								</a>
							</li>
							<li>
								<a href="index.php?controller=orders">
									<span>Lịch sử giao dịch</span>
								</a>
							</li>
							<li>
								<a href="index.php?controller=login&action=logout">
									<i class="fa fa-sign-out"></i> <span>  Đăng xuất</span>
								</a>
							</li>
						<?php else:?>
							<li><a href="index.php?controller=login&action=login"><i class="fa fa-sign-in" aria-hidden="true"></i>  Đăng nhập</a></li>
							<li><a href="index.php?controller=customers&action=register"><i class="fa fa-user-plus" aria-hidden="true"></i>  Đăng kí</a></li>
						<?php endif;?>
					</ul>
				</li>
				<li class="menu_item"><a href="index.php">Trang chủ</a></li>
				<li class="menu_item"><a href="index.php?controller=carts">Giỏ hàng 
					<?php if(!empty($_SESSION["countcart"])):?>
						<div class="hamburger_menu_checkout float-right">
							<span id="checkout_items" class="checkout_items">
								<?php echo $_SESSION["countcart"];?>
							</span>
						</div>
					<?php endif;?></a>
				</li>
				<li class="menu_item"><a href="index.php?controller=news">Tin tức</a></li>
				<li class="menu_item"><a href="#">Giới thiệu</a></li>
				<li class="menu_item">
					<div class="input-group">
					  <input type="search" class="form-control rounded" placeholder="Nhập tên điện thoại cần tìm..." aria-label="Search" aria-describedby="search-addon" />
					  <button type="button" class="btn btn-outline-primary">Tìm</button>
					</div>
				
				</li>
			</ul>
		</div>
	</div>
	<!-- Main content -->
    <section style="margin-top: 100px;">
        <?php echo $this->view; ?>
    </section>
    <!-- /.content -->
	<div class="bottom-0">
	<!-- Newsletter -->

		<div class="newsletter mt-5 container">
			<div class="row">
				<div class="col-lg-6">
					<div class="newsletter_text d-flex flex-column justify-content-center align-items-lg-start align-items-md-center text-center">
						<h4>Nhận tin tức</h4>
						<p>Theo dõi tin tức mới nhất của chúng tôi</p>
					</div>
				</div>
				<div class="col-lg-6">
					<form action="post">
						<div class="newsletter_form d-flex flex-md-row flex-column flex-xs-column align-items-center justify-content-lg-end justify-content-center">
							<input id="newsletter_email" type="email" placeholder="Email của bạn" required="required" data-error="Valid email is required.">
							<button id="newsletter_submit" type="submit" class="newsletter_submit_btn trans_300" value="Submit">subscribe</button>
						</div>
					</form>
				</div>
			</div>
		</div>
		<!-- Footer -->

		<footer class="footer">
			<div class="container p-0 bg-white">
				<div class="row p-2">
					<div class="col-lg-6">
						<div class="footer_nav_container d-flex flex-sm-row flex-column align-items-center justify-content-lg-start justify-content-center text-center">
							<ul class="footer_nav">
								<li><a href="index.php">Trang chủ</a></li>
								<li><a href="index.php?controller=products">Sản phẩm</a></li>
								<li><a href="index.php?controller=news">Tin tức</a></li>
								<li><a href="index.php?controller=home&action=aboutus">Giới thiệu</a></li>
							</ul>
						</div>
					</div>
					<div class="col-lg-6">
						<div class="footer_social d-flex flex-row align-items-center justify-content-lg-end justify-content-center">
							<ul>
								<li><a href="#"><i class="fa fa-facebook" aria-hidden="true"></i></a></li>
								<li><a href="#"><i class="fa fa-twitter" aria-hidden="true"></i></a></li>
								<li><a href="#"><i class="fa fa-instagram" aria-hidden="true"></i></a></li>
								<li><a href="#"><i class="fa fa-skype" aria-hidden="true"></i></a></li>
								<li><a href="#"><i class="fa fa-pinterest" aria-hidden="true"></i></a></li>
							</ul>
						</div>
					</div>
				</div>
				<div class="row p-2">
					<div class="col-lg-4 ">
						Tư vấn mua hàng (miễn phí)
						<h3 class="text-danger">1800xxxx</h3>
					</div>
					<div class="col-lg-4 ">
						Hỗ trợ kĩ thuật
						<h3 class="text-danger">1800xxxx</h3>
					</div>
					<div class="col-lg-4 ">
						Góp ý, khiếu nại (8h-21h)
						<h3 class="text-danger">1800xxxx</h3>
					</div>
				</div>
				<div class="newsletter">
					<div class="row col-lg-12">
						<div class="footer_nav_container">
							<div class="cr"> © 2022 - 2023 Công Ty DCT / Địa chỉ: 123 Đồng Lạc, Nam Sách, Hải Dương. Điện thoại: 0395 290 402.
								 Email: thenova@gmail.com<br/> Chịu trách nhiệm nội dung: <a href="#">TheNova</a></div>
						</div>
					</div>
				</div>
			</div>
		</footer>
	</div>
</div>
		<div class=" float-right " style=" z-index:2;position: fixed;right:5px;bottom: 50px;" data-toggle="modal" data-target="#dialog1">
			<img style="width: 120px;" src="assets/images/feedback_logo.jpg">
		</div>
<div class="modal fade" id="dialog1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
        <div class="p-3 float-right"><i class="fa fa-times float-right" data-dismiss="modal" aria-hidden="true"></i></div>
            <div class="modal-header p-0">
				<div class="container text-center h-100">
					<h4 class="text-white-50 mb-5">Góp ý, khiếu nại</h4>
				</div>
			</div>
            
            <div class="modal-body pt-0">
				<form id="review_form" method="post" class="mt-3"
				action="index.php?controller=feedbacks&action=createFeedbacks"> 
				<div>
					<h5>Thông tin cá nhân</h5>
					<input id="review_name" class="form_input input_name" type="text" name="name" placeholder="Name*" required="required" 
					value="<?php echo isset($_SESSION['customer_name'])?$_SESSION['customer_name']:'';?>">
					<input id="review_email" class="form_input input_email" type="email" name="email"  placeholder="Email*" required="required" 
					value="<?php echo isset($_SESSION['customer_email'])?$_SESSION['customer_email']:'';?>">
				</div>
				<div>
					<h5>Góp ý của bạn:</h5>
					
					<textarea  id="content" class="input_review" name="content"  placeholder="Nội dung" rows="4" required data-error="Please, leave us a review."></textarea>
				</div>
				<div class="text-left text-sm-right">
					<button   type="submit" class="red_button review_submit_btn trans_300" >Gửi</button>
				</div>
				</form>
            </div>
            
        </div>
    </div>
</div>
<script src="assets/js/jquery-3.2.1.min.js"></script>
<script src="assets/styles/bootstrap4/popper.js"></script>
<script src="assets/styles/bootstrap4/bootstrap.min.js"></script>
<script src="assets/plugins/Isotope/isotope.pkgd.min.js"></script>
<script src="assets/plugins/OwlCarousel2-2.2.1/owl.carousel.js"></script>
<script src="assets/plugins/easing/easing.js"></script>
<script src="assets/js/custom.js"></script>
<script src="assets/js/products_carts.js"></script>
</body>

</html>
