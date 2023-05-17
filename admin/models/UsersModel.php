<?php 
	trait UsersModel{
		//lay danh sach cac ban ghi, co phan trang
		public function modelRead($recordPerPage){			
			//lay bien page truyen tu url
			$page = isset($_GET["page"])&&is_numeric($_GET["page"])&&$_GET["page"]>0 ? $_GET["page"]-1 : 0;
			//lay tu ban ghi nao
			$from = $page * $recordPerPage;
			//---
			//lay bien ket noi
			$conn = Connection::getInstance();
			$query = $conn->query("select * from users order by id desc limit $from,$recordPerPage");
			//lay tat ca ket qua tra ve
			$result = $query->fetchAll();
			//---
			return $result;
		}
		//ham tinh tong so ban ghi
		public function modelTotal(){
			//lay bien ket noi
			$conn = Connection::getInstance();
			$query = $conn->query("select id from users");
			//ham rowCount: dem so ket qua tra ve
			return $query->rowCount();
		}
		//lay mot ban ghi tuong ung voi id truyen vao
		public function modelGetRecord($id){
			//lay bien ket noi
			$conn = Connection::getInstance();
			$query = $conn->query("select * from users where id=$id");
			//tra ve mot ban ghi
			return $query->fetch();
		}
		public function modelUpdate($id){
			$id = isset($_GET["id"])&&is_numeric($_GET["id"])?$_GET["id"]:0;
			$name = $_POST["name"];
			$password = $_POST["password"];
			$role = $_POST["role"];
			//ma hoa password
			$password = md5($password);
			//update cot name
			//lay bien ket noi
			$conn = Connection::getInstance();
			$query = $conn->prepare("update users set name=:_name, role=:_role where id=:_id");
			$query->execute([":_name"=>$name,":_id"=>$id,":_role"=>$role]);
			//neu password khong rong thi update password
			if($password != ""){
				$query = $conn->prepare("update users set password=:_password where id=:_id");
				$query->execute([":_password"=>$password,":_id"=>$id]);
			}
		}
		public function modelCreate(){
			$name = $_POST["name"];
			$email = $_POST["email"];
			$password = $_POST["password"];
			$role = $_POST["role"];
			if($role==0){
				$role=2;
			}
			$createdate = date("y-m-d");
			//ma hoa password
			$password = md5($password);
			//update cot name
			//lay bien ket noi
			$conn = Connection::getInstance();
			$query = $conn->prepare("insert into users set name=:_name, email=:_email, password=:_password, role=:_role,createdate=:_createdate");
			$query->execute([":_name"=>$name,":_email"=>$email,":_password"=>$password,":_role"=>$role,":_createdate"=>$createdate]);
		
		}
		//xoa ban ghi
		public function modelDelete($id){
			//lay bien ket noi
			$conn = Connection::getInstance();
			$conn->query("delete from users where id=$id");
		}

		//check email
		public function modelCheckEmail(){
			$email = $_POST["email"];
			//lay bien ket noi
			$conn = Connection::getInstance();
			$query = $conn->query("select * from users where email='$email'");
			if($query->rowCount() == 0){
				return true;
			}else {
				return false;
			}		
		}
	}
 ?>