<!DOCTYPE html>
<html>
<head>
	<title>Login</title>
	<meta charset="utf-8">
	<link rel="stylesheet" type="text/css" href="../assets/admin/layout1/css/bootstrap.min.css">
</head>
<body>
<?php
  setcookie('admin', 'abc', time()+600);
?>
<div class="container" style="margin-top:40px;">
	<div class="row">
		<div class="col-md-6 col-md-offset-3 mt-6">
			<h2>Trang quản trị của PHONESHOPE</h2>
			<div class="panel panel-primary">
				<div class="panel-heading">Login</div>
				<div class="panel-body">
					<form method="post" action="index.php?controller=login&action=login">
					<div class="row" style="margin-top:15px;">
						<div class="col-md-2">Email</div>
						<div class="col-md-9"><input type="email" name="email" required class="form-control"></div>
					</div>
					<div class="row" style="margin-top:15px;">
						<div class="col-md-2">Password</div>
						<div class="col-md-9"><input type="password" name="password" required class="form-control"></div>
					</div>
					<div class="row" style="margin-top:15px;">
						<div class="col-md-2"></div>
						<div class="col-md-9 text-danger">
							<?php 
							if(isset($_SESSION["error"]) && !empty($_SESSION['error'])) echo $_SESSION["error"]; ?>
						</div>
					</div>
					<div class="row" style="margin-top:15px;">
						<div class="col-md-2"></div>
						<div class="col-md-9"><input type="submit" value="Login" class="btn btn-primary"> <input type="reset" value="Reset" class="btn btn-danger"></div>
					</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>
</body>
</html>