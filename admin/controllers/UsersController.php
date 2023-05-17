<?php 
	//load file model
	include "models/UsersModel.php";
	class UsersController extends Controller{
		//ke thua class UsersModel
		use UsersModel;
		//liet ke so ban ghi
		public function index(){
			//huy error
			unset($_SESSION["error"]);
			//quy dinh so ban ghi mot trang
			$recordPerPage = 10;
			//tinh so trang
			//ham ceil la ham lay tran. VD: ceil(2.1) = 3
			$numPage = ceil($this->modelTotal()/$recordPerPage);
			//lay danh sach cac ban ghi co phan trang
			$data = $this->modelRead($recordPerPage);
			//goi view, truyen du lieu ra view
			$this->loadView("UsersView.php",["data"=>$data,"numPage"=>$numPage]);
		}
		//update
		public function update(){
			$id = isset($_GET["id"])&&is_numeric($_GET["id"])?$_GET["id"]:0;
			//tao bien action de xuat vao thuoc tinh action cua the form
			$action = "index.php?controller=users&action=updatePost&id=$id";
			$record = $this->modelGetRecord($id);
			//goi view
			$this->loadView("UsersForm.php",["record"=>$record,"action"=>$action]);
		}
		//update - POST
		public function updatePost(){
			$id = isset($_GET["id"])&&is_numeric($_GET["id"])?$_GET["id"]:0;
			$this->modelUpdate($id);
			//quay tro lai mvc users
			header("location:index.php?controller=users");
		}
		//create
		public function create(){
			//tao bien action de xuat vao thuoc tinh action cua the form
			$action = "index.php?controller=users&action=createPost";
			//goi view
			$this->loadView("UsersForm.php",["action"=>$action]);	
		}
		//crete POST
		public function createPost(){
			if(!$this->modelCheckEmail()){
				$_SESSION["error"]="Email đã tồn tại";
				header("location:index.php?controller=users&action=create");
			}else {
				//huy error
				unset($_SESSION["error"]);
				$this->modelCreate();
				//quay tro lai mvc users
				header("location:index.php?controller=users");
			}	
		}
		//delete
		public function delete(){
			$id = isset($_GET["id"])&&is_numeric($_GET["id"])?$_GET["id"]:0;
			$this->modelDelete($id);
			//quay tro lai mvc users
			header("location:index.php?controller=users");
		}
	}
 ?>