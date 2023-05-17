<?php 
	//load file model
	include "models/FeedbacksModel.php";
	class FeedbacksController extends Controller{
		//ham tao - check login
		public function __construct(){
			$this->authentication();
		}
		use FeedbacksModel;
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
			$this->loadView("FeedbacksView.php",["data"=>$data,"numPage"=>$numPage]);
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
			$this->loadView("FeedbacksView.php",["data"=>$data,"numPage"=>$numPage]);
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
			$this->loadView("FeedbacksView.php",["data"=>$data,"numPage"=>$numPage]);
		}

        //xac nhan da xem
		public function watched(){
			$id = isset($_GET["id"]) ? $_GET["id"] : 0;
			//goi ham tu model de thuc hien
			$this->modelSeen($id);
			//di chuyen den trang danh sach cac ban ghi
			echo "<script>location.href='index.php?controller=feedbacks';</script>";
		}	

        //delete
		public function delete(){
			$id = isset($_GET["id"])&&is_numeric($_GET["id"])?$_GET["id"]:0;
			$this->modelDelete($id);
			//quay tro lai mvc products
			header("location:index.php?controller=feedbacks");
		}
	}
 ?>