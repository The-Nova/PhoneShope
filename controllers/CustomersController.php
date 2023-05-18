<?php 
	//load file model
	include "models/CustomersModel.php";
	class CustomersController extends Controller{
		
		use CustomersModel;
		//update
		public function update(){
			$id = isset($_GET["id"])&&is_numeric($_GET["id"])?$_GET["id"]:0;
			//tao bien action de xuat vao thuoc tinh action cua the form
			$action = "index.php?controller=customers&action=updatePost&id=$id";
			$record = $this->modelGetRecord($id);
			//goi view
			$this->loadView("Account.php",["record"=>$record,"action"=>$action]);
		}
		//update - POST
		public function updatePost(){
			$id = isset($_GET["id"])&&is_numeric($_GET["id"])?$_GET["id"]:0;
			$this->modelUpdate($id);
			$_SESSION["message"]= " Cập nhật tài khoản thành công! ";
			//quay tro lai mvc users
			header("location:index.php?controller=home");
		}
		//create
		public function register(){
			//tao bien action de xuat vao thuoc tinh action cua the form
			$action = "index.php?controller=customers&action=createPost";
			//goi view
			$this->loadView("Register.php",["action"=>$action]);	
		}
		//crete POST
		public function createPost(){
			if(!$this->modelCheckEmail()){
				$_SESSION["error"]="Email đã tồn tại";
				header("location:index.php?controller=customers&action=register");
			}elseif(!$this->modelCheckPhone()){
				$_SESSION["error"]="Số điện thoại đã tồn tại";
				header("location:index.php?controller=customers&action=register");
			}else{
				//huy error
				unset($_SESSION["error"]);
				$this->modelCreate();
				$_SESSION["message"]= " Đăng kí thành công! ";
				//quay tro lai mvc home
				header("location:index.php?controller=home");
			}	
		}
	}
 ?>