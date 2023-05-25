<?php 
	//load file model
	include "models/CustomersModel.php";
	class CustomersController extends Controller{
		//ke thua class CustomersModel
		use CustomersModel;
		//liet ke so ban ghi
		public function index(){
			//quy dinh so ban ghi mot trang
			$recordPerPage = 20;
			//tinh so trang
			//ham ceil la ham lay tran. VD: ceil(2.1) = 3
			$numPage = ceil($this->modelTotal()/$recordPerPage);
			//lay danh sach cac ban ghi co phan trang
			$data = $this->modelRead($recordPerPage);
			//goi view, truyen du lieu ra view
			$this->loadView("CustomersView.php",["data"=>$data,"numPage"=>$numPage]);
		}
		//update
		public function viewdetail(){
			$id = isset($_GET["id"])&&is_numeric($_GET["id"])?$_GET["id"]:0;
			//tao bien action de xuat vao thuoc tinh action cua the form
			$action = "index.php?controller=Customers&action=updatePost&id=$id";
			$record = $this->modelGetRecord($id);
			//goi view
			$this->loadView("CustomersDetail.php",["record"=>$record,"action"=>$action]);
		}
		//update - POST
		public function updatePost(){
			$id = isset($_GET["id"])&&is_numeric($_GET["id"])?$_GET["id"]:0;
			$this->modelUpdate($id);
			//quay tro lai mvc Customers
			header("location:index.php?controller=Customers");
		}
		//delete
		public function delete(){
			$id = isset($_GET["id"])&&is_numeric($_GET["id"])?$_GET["id"]:0;
			$this->modelDelete($id);
			//quay tro lai mvc Customers
			header("location:index.php?controller=Customers");
		}
		//danh sach cac product dang tim
		public function btnSearch(){
			//quy dinh so ban ghi mot trang
			$recordPerPage = 20;
			//lay danh sach cac ban ghi co phan trang
			$data = $this->modelReadSearch($recordPerPage);
			//tinh so trang
			//ham ceil la ham lay tran. VD: ceil(2.1) = 3
			$numPage = ceil($this->modelTotalSearch()/$recordPerPage);
			//goi view, truyen du lieu ra view
			$this->loadView("CustomersView.php",["data"=>$data,"numPage"=>$numPage]);
		}
		//danh sach cac product dang loc theo ngay
		public function btnFilterDate(){
			//quy dinh so ban ghi mot trang
			$recordPerPage = 20;
			//lay danh sach cac ban ghi co phan trang
			$data = $this->modelReadFillter($recordPerPage);
			//tinh so trang
			//ham ceil la ham lay tran. VD: ceil(2.1) = 3
			$numPage = ceil($this->modelTotalFilterDate()/$recordPerPage);
			//goi view, truyen du lieu ra view
			$this->loadView("CustomersView.php",["data"=>$data,"numPage"=>$numPage]);
		}
	}
 ?>