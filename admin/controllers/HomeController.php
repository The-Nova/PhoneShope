<?php 
	//load file model
	include "models/HomeModel.php";
	class HomeController extends Controller{
		//ham tao - check login
		public function __construct(){
			$this->authentication();
		}
		use HomeModel;
		//liet ke so ban ghi
		public function index(){
			//huy error
			unset($_SESSION["error"]);
			//lay danh sach cac ban ghi
			$databil = $this->modelstatusBill();
			$dataBestSale=$this->modelBestseller();
			//goi view, truyen du lieu ra view
			$this->loadView("HomeView.php",["databil"=>$databil,"dataBestSale"=>$dataBestSale]);
		}

		public function printReport(){
			$this->handle();
			header('localtion:index.php');
		}
	}
 ?>