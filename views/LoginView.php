<!DOCTYPE html>
<html lang="en">
<head>
<title>Phone Shop</title>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" type="text/css" href="assets/styles/bootstrap4/bootstrap.min.css">
<link rel="stylesheet" type="text/css" href="assets/styles/main_styles.css">
<link rel="stylesheet" type="text/css" href="assets/styles/responsive.css">
</head>
<body style="background-image:url(assets/images/bg_1.png)">
<section class="vh-100 gradient-custom">
  <div class="container py-5 h-100">
    <div class="row d-flex justify-content-center align-items-center h-100">
      <div class="col-12 col-md-8 col-lg-6 col-xl-5">
        <div class="card bg-white text-dark" style="border-radius: 1rem; ">
          <div class="card-body p-5 text-center">
			<form method="post" action="index.php?controller=login&action=login">
				<div class="mb-md-5 mt-md-4 pb-3">

				<h2 class="fw-bold mb-2 text-uppercase"><a href="index.php"><span style="color: #fe4c50;">Phone</span><span style="color: black;">Shope</span></a></h2>
				<p class="text-white-50 mb-3">Điền thông tin để đăng nhập hệ thống!</p>
				<div class="row mb-2">
					<div class="col text-danger text-left">
						<?php if(isset($_SESSION["error"]) && !empty($_SESSION["error"])) echo $_SESSION["error"]; ?>
					</div>
				</div>
				<div class="form-outline form-white mb-4">
					<input type="text" name="email" class="form-control form-control-lg" placeholder="Email hoặc số điện thoại" required/>
				</div>

				<div class="form-outline form-white mb-4">
					<input type="password" name="password" class="form-control form-control-lg" placeholder="Password" required/>
				</div>
				
				<p class="small mb-3 pb-lg-2"><a class="text-white-50" href="#!">Quên mật khẩu</a></p>

				<button class="btn btn-outline-dark btn-lg px-5" type="submit">Đăng nhập</button>
				</div>

				<div>
				<p class="mb-0">Bạn không có tài khoản? <a href="index.php?controller=customers&action=register" class="text-white-50 fw-bold">Đăng kí ngay</a>
				</p>
				</div>
			</form>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
</body>