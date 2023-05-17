<?php 
	//load file model
	include "models/ProductsModel.php";
	class ProductsController extends Controller{
		
		use ProductsModel;
		//liet ke so ban ghi
		public function index(){
			//huy error
			unset($_SESSION["error"]);
			$action="index.php?controller=products";
			//$action=$_SERVER['REQUEST_URI'];
			//lay danh sach cac ban ghi
			$dataCategories = $this->modelReadCategories();
			$dataProducts = $this->modelProductsByOption();
			$dataBestSeller=$this->modelBestseller();
			$dataSubCategories=$this->modelReadSubCategories();
			$dataColor=$this->modelGetColor();
			//goi view, truyen du lieu ra view
			$this->loadView("ListProductView.php",["dataCategories"=>$dataCategories,"dataProducts"=>$dataProducts,
			"dataBestSeller"=>$dataBestSeller,"dataSubCategories"=>$dataSubCategories,"dataColor"=>$dataColor,"action"=>$action]);
		}

		//danh sach san pham theo danh muc
		public function listByCategory(){
			$category_name= $_GET["category_name"];
			$dataProducts=$this->modelProductsByOption();
			$dataCategories = $this->modelReadCategories();
			$dataSubCategories=$this->modelReadSubCategories();
			$dataColor=$this->modelGetColor();
			$action="index.php?controller=products&action=listbycategory&category_name=$category_name";
			//goi view, truyen du lieu ra view
			$this->loadView("ListProductView.php",["dataCategories"=>$dataCategories,"dataProducts"=>$dataProducts,
			"dataSubCategories"=>$dataSubCategories,"dataColor"=>$dataColor,"action"=>$action]);
		}

		//danh sach san pham dang giam gia
		public function listSale(){
			$dataProducts=$this->modelProductsSale();
			$dataCategories = $this->modelReadCategories();
			$dataColor=$this->modelGetColor();
			//goi view, truyen du lieu ra view
			$this->loadView("ListProductView.php",["dataCategories"=>$dataCategories,"dataProducts"=>$dataProducts,
			"dataColor"=>$dataColor]);
		}

		//danh sach cac product dang tim
		public function btnSearch(){
			//quy dinh so ban ghi mot trang
			$recordPerPage = 20;
			//lay danh sach cac ban ghi co phan trang
			$dataProducts = $this->modelReadSearch($recordPerPage);
			$dataCategories = $this->modelReadCategories();
			$dataColor=$this->modelGetColor();
			//tinh so trang
			//ham ceil la ham lay tran. VD: ceil(2.1) = 3
			$numPage = ceil($this->modelTotalSearch()/$recordPerPage);
			//goi view, truyen du lieu ra view
			$this->loadView("ListProductView.php",["dataProducts"=>$dataProducts,"dataCategories"=>$dataCategories,
			"dataColor"=>$dataColor,"numPage"=>$numPage]);
		}

		//danh sach san pham theo danh muc
		public function productDetail(){
			$product_id= $_GET["id"];
			$dataProducts=$this->modelProducts();
			$this->modelUpdateView($product_id);
			$star=$this->modelGetRating($product_id);
			$dataTypes=$this->modelGetTypes($product_id);
			$dataRating=$this->modelFilterRating($product_id);
			$countRating=$this->modelTotalFilterRating($product_id);
			$action="index.php?controller=products&action=productDetail&id=$product_id";
			//goi view, truyen du lieu ra view
			$this->loadView("ProductDetail.php",["dataProducts"=>$dataProducts,"star"=>$star,"dataTypes"=>$dataTypes,
			"countRating"=>$countRating,"dataRating"=>$dataRating,"action"=>$action]);
		}

		public function createRatingPost(){
			$product_id= $_GET["id"];
			$this->modelCreateRating();
			$action="index.php?controller=products&action=productDetail&id=$product_id";
			header("location:$action");
		}

	}
 ?>