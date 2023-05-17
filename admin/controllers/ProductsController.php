<?php 
	//load file model
	include "models/ProductsModel.php";
	class ProductsController extends Controller{
		//ke thua class ProductsModel
		use ProductsModel;
		//liet ke so ban ghi
		public function index(){
			//quy dinh so ban ghi mot trang
			$recordPerPage = 10;
			//tinh so trang
			//ham ceil la ham lay tran. VD: ceil(2.1) = 3
			$numPage = ceil($this->modelTotal()/$recordPerPage);
			//lay danh sach cac ban ghi co phan trang
			$data = $this->modelRead($recordPerPage);
			//goi view, truyen du lieu ra view
			$this->loadView("ProductsView.php",["data"=>$data,"numPage"=>$numPage]);
		}

		//liet ke so ban ghi
		public function listTypes(){
			//lay id
			$id = isset($_GET["id"])&&is_numeric($_GET["id"])?$_GET["id"]:0;
			//lay danh sach cac ban ghi
			$data = $this->modelReadTypes($id);
			//goi view, truyen du lieu ra view
			$this->loadView("ListProductTypes.php",["data"=>$data]);
		}

		//update
		public function update(){
			$id = isset($_GET["id"])&&is_numeric($_GET["id"])?$_GET["id"]:0;
			//tao bien action de xuat vao thuoc tinh action cua the form
			$action = "index.php?controller=products&action=updatePost&id=$id";
			$record = $this->modelGetRecord($id);
			//goi view
			$this->loadView("ProductsForm.php",["record"=>$record,"action"=>$action]);
		}

		//updateTypes
		public function updateTypes(){
			$id = isset($_GET["id"])&&is_numeric($_GET["id"])?$_GET["id"]:0;
			//tao bien action de xuat vao thuoc tinh action cua the form
			$action = "index.php?controller=products&action=updateTypesPost&id=$id";
			$record = $this->modelGetTypes($id);
			//goi view
			$this->loadView("ProductTypesForm.php",["record"=>$record,"action"=>$action]);
		}
		//update - POST
		public function updatePost(){
			$id = isset($_GET["id"])&&is_numeric($_GET["id"])?$_GET["id"]:0;
			$this->modelUpdate($id);
			//quay tro lai mvc products
			header("location:index.php?controller=products");
		}

		//updateTypes - POST
		public function updateTypesPost(){
			$id = isset($_GET["id"])&&is_numeric($_GET["id"])?$_GET["id"]:0;
			$this->modelUpdateTypes($id);
			$product_id=$this->modelGetTypes($id)->product_id;
			//quay tro lai mvc product types
			header("location:index.php?controller=products&action=listTypes&id=$product_id");
		}
		//create
		public function create(){
			//tao bien action de xuat vao thuoc tinh action cua the form
			$action = "index.php?controller=products&action=createPost";
			//goi view
			$this->loadView("ProductsForm.php",["action"=>$action]);		
		}

		//create
		public function createTypes(){
			//tao bien action de xuat vao thuoc tinh action cua the form
			$action = "index.php?controller=products&action=createTypesPost";
			//goi view
			$this->loadView("ProductTypesForm.php",["action"=>$action]);		
		} 

		//crete POST
		public function createPost(){
			if(!$this->modelCheckName()){
				$_SESSION["error"]="Sản phẩm đã tồn tại";
				header("location:index.php?controller=products&action=create");
			}else {
				//huy error
				unset($_SESSION["error"]);
				$this->modelCreate();
				//quay tro lai mvc products
				header("location:index.php?controller=products");
			}	
		}
		//createTypes
		public function createTypesPost(){
			if(!$this->modelCheckType()){
				$_SESSION["error"]="Đặc điểm bị trùng";
				$product_id = $_SESSION['product_id'];
				header("location:index.php?controller=products&action=createTypes&product_id=$product_id");
			}else {
				//huy error
				unset($_SESSION["error"]);
				$this->modelCreateTypes();
				$product_id = $_SESSION['product_id'];
				//$product_id=$this->modelGetTypes($id)->product_id;
				//quay tro lai mvc product types
				header("location:index.php?controller=products&action=listTypes&id=$product_id");
			}
		}
		//delete
		public function delete(){
			$id = isset($_GET["id"])&&is_numeric($_GET["id"])?$_GET["id"]:0;
			$this->modelDelete($id);
			//quay tro lai mvc products
			header("location:index.php?controller=products");
		}

		//deleteTypes
		public function deleteTypes(){
			$id = isset($_GET["id"])&&is_numeric($_GET["id"])?$_GET["id"]:0;
			$this->modelDeleteTypes($id);
			$product_id = $_SESSION['product_id'];
			//quay tro lai mvc products
			header("location:index.php?controller=products&action=listTypes&id=$product_id");
		} 
		//danh sach cac product dang hot
		public function btnHot(){
			//quy dinh so ban ghi mot trang
			$recordPerPage = 10;
			//tinh so trang
			//ham ceil la ham lay tran. VD: ceil(2.1) = 3
			$numPage = ceil($this->modelTotalHot()/$recordPerPage);
			//lay danh sach cac ban ghi co phan trang
			$data = $this->modelReadStatus($recordPerPage);
			//goi view, truyen du lieu ra view
			$this->loadView("ProductsView.php",["data"=>$data,"numPage"=>$numPage]);
		}
		//danh sach cac product dang tim
		public function btnSearch(){
			//quy dinh so ban ghi mot trang
			$recordPerPage = 10;
			//lay danh sach cac ban ghi co phan trang
			$data = $this->modelReadSearch($recordPerPage);
			//tinh so trang
			//ham ceil la ham lay tran. VD: ceil(2.1) = 3
			$numPage = ceil($this->modelTotalSearch()/$recordPerPage);
			//goi view, truyen du lieu ra view
			$this->loadView("ProductsView.php",["data"=>$data,"numPage"=>$numPage]);
		}
		//danh sach cac product dang loc theo ngay
		public function btnFilterDate(){
			//quy dinh so ban ghi mot trang
			$recordPerPage = 10;
			//lay danh sach cac ban ghi co phan trang
			$data = $this->modelReadFillter($recordPerPage);
			//tinh so trang
			//ham ceil la ham lay tran. VD: ceil(2.1) = 3
			$numPage = ceil($this->modelTotalFilterDate()/$recordPerPage);
			//goi view, truyen du lieu ra view
			$this->loadView("ProductsView.php",["data"=>$data,"numPage"=>$numPage]);
		}
	}
 ?>