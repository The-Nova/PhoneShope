<?php 
	//load file model
	include "models/HomeModel.php";
	class HomeController extends Controller{
		
		use HomeModel;
		//liet ke so ban ghi
		public function index(){
			//huy error
			unset($_SESSION["error"]);
			//lay danh sach cac ban ghi
			$dataCategories = $this->modelReadCategories();
			$dataProducts = $this->modelReadProducts();
			$dataBestSeller=$this->modelBestseller();
			$dataNews=$this->modelReadNews();
			$hotNews=$this->modelHotNews();
			$dataSubCategories=$this->modelReadSubCategories();
			//goi view, truyen du lieu ra view
			$this->loadView("HomeView.php",["dataCategories"=>$dataCategories,"dataProducts"=>$dataProducts,"hotNews"=>$hotNews,
			"dataBestSeller"=>$dataBestSeller,"dataNews"=>$dataNews,"dataSubCategories"=>$dataSubCategories]);
		}

		public function aboutUs(){
			$this->loadView("AboutUs.php");
		}
	}
 ?>