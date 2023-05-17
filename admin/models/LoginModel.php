<?php 
	trait LoginModel{
		public function modelLogin(){
			$email = $_POST["email"];
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
			$query = $conn->query("select id,email,name,password,role from users where email='$email'");
			if($query->rowCount() > 0){
				$record = $query->fetch();
				if($record->password == $password){
					$_SESSION["id"] = $record->id;
					$_SESSION["email"] = $email;
					$_SESSION["role"] = $record->role;
					$_SESSION["name"] = $record->name;
					header("location:index.php");
				}else {
					//mat khau nhap sai
					$_SESSION["error"] = "Sai mật khẩu";
					header("location:index.php?controller=login");
				}
			}else{
				//sai email dang nhap
				$_SESSION["error"] ="Tài khoản không tồn tại";
				header("location:index.php?controller=login");
			}	
		}
	}
 ?>