<?php 
	trait LoginModel{
		public function modelLogin(){
			$name = $_POST["email"];
			//ham mysql_escape_string su dung de loai bo mot so ky tu dac biet (lien quan den loi sql injection)
			//VD: ky tu ' se tro thanh \'
			//$email = mysql_escape_string($email);
			$password = $_POST["password"];	
			//$password = mysql_escape_string($password);		
			//ma hoa password
			$password = md5($password);
			//echo $password;
			//lay bien ket noi csdl
			$conn = Connection::getInstance();
			//chuan bi cau truy van			
			$query = $conn->query("select id,email,name,phone,password from customers where email='$name' or phone='$name'");
			if($query->rowCount() > 0){
				$record = $query->fetch();
				if($record->password == $password){
					$_SESSION["customer_id"] = $record->id;
					$_SESSION["customer_email"] = $record->email;
					$_SESSION["customer_name"] = $record->name;
					$_SESSION["customer_phone"] = $record->phone;
					//lay bien ket noi csdl
					$conn = Connection::getInstance();
					//chuan bi cau truy van			
					$querycart = $conn->query("select id from carts where customer_id=$record->id");
					$_SESSION["countcart"] = $querycart->rowCount();
					$url=isset($_SESSION['url'])?$_SESSION['url']:'index.php';
					header("location:$url");
					unset($_SESSION['url']);
				}else {
					//mat khau nhap sai
					$_SESSION["error"] = "*Sai mật khẩu*";
					header("location:index.php?controller=login");
				}
			}else{
				if(isset($name)){
					//sai email dang nhap
					$_SESSION["error"] ="*Tài khoản không tồn tại*";
					header("location:index.php?controller=login");
				}
				header("location:index.php?controller=login");
			}	
		}
	}
 ?>