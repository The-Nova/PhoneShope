<?php
    trait CustomersModel{
        public function modelUpdate($id){
			$id = isset($_GET["id"])&&is_numeric($_GET["id"])?$_GET["id"]:0;
			$name = $_POST["name"];
			$password = $_POST["password"];
            $address=$_POST["address"];
			$phone=$_POST["phone"];
            $cmt=$_POST["cmt"];
            $lastupdate= date("y-m-d");
			//ma hoa password
			$password = md5($password);
			//update cot name
			//lay bien ket noi
			$conn = Connection::getInstance();
			$query = $conn->prepare("update customers set name=:_name,address=:_address,phone=:_phone,cmt=:_cmt,lastupdate=:_lastupdate where id=:_id");
			$query->execute([":_name"=>$name,":_id"=>$id,":_address"=>$address,":_phone"=>$phone,":_cmt"=>$cmt,":_lastupdate"=>$lastupdate]);
			//neu password khong rong thi update password
			if($password != ""){
				$query = $conn->prepare("update customers set password=:_password where id=:_id");
				$query->execute([":_password"=>$password,":_id"=>$id]);
			}
		}
		public function modelCreate(){
			$email = $_POST["email"];
			$password = $_POST["password"];
			$phone=$_POST["phone"];
			$createdate = date("y-m-d");
            $lastupdate= date("y-m-d");
			//ma hoa password
			$password = md5($password);
			//update cot name
			//lay bien ket noi
			$conn = Connection::getInstance();
			$query = $conn->prepare("insert into customers set  email=:_email, password=:_password,phone=:_phone,createdate=:_createdate,lastupdate=:_lastupdate");
			$query->execute([":_email"=>$email,":_password"=>$password,":_phone"=>$phone,":_createdate"=>$createdate,":_lastupdate"=>$lastupdate]);
		}
        //lay mot ban ghi tuong ung voi id truyen vao
		public function modelGetRecord($id){
			//lay bien ket noi
			$conn = Connection::getInstance();
			$query = $conn->query("select * from customers where id=$id");
			//tra ve mot ban ghi
			return $query->fetch();
		}

        //check email
		public function modelCheckEmail(){
			$email = $_POST["email"];
			//lay bien ket noi
			$conn = Connection::getInstance();
			$query = $conn->query("select * from customers where email='$email'");
			if($query->rowCount() == 0){
				return true;
			}else {
				return false;
			}		
		}

		//check email
		public function modelCheckPhone(){
			$phone = $_POST["phone"];
			//lay bien ket noi
			$conn = Connection::getInstance();
			$query = $conn->query("select * from customers where phone='$phone'");
			if($query->rowCount() == 0){
				return true;
			}else {
				return false;
			}		
		}

    }
?>