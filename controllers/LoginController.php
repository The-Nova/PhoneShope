<?php 
	//load file model
	include "models/LoginModel.php";
	class LoginController extends Controller{
		//ke thuc class LoginModel
		use LoginModel;
		public function index(){
			if(isset($_SESSION["customer_id"])) {
				header("location:index.php");
			}else{
				$this->loadView("LoginView.php");
			}
		}
		public function login(){
			//goi ham modelLogin tu class LoginModel
			if(isset($_SESSION["customer_id"])) {
				header("location:index.php");
			}else{
				$this->modelLogin();
			}
		}
		//dang xuat
		public function logout(){
			//huy bien session
			//unset($_SESSION["email"]);
			session_destroy();
			header("location:index.php");
		}
	}
 ?>