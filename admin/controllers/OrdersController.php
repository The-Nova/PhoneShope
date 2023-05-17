<?php 
	include "models/OrdersModel.php";
	class OrdersController extends Controller{
		use OrdersModel;
		public function index(){
			//quy dinh so ban ghi tren mot trang
			$recordPerPage = 25;
			//tinh so trang
			$numPage = ceil($this->modelTotal()/$recordPerPage);
			//goi ham de lay du lieu
			$listRecord = $this->modelRead($recordPerPage);
			//load view
			$this->loadView("OrdersView.php",["listRecord"=>$listRecord,"numPage"=>$numPage]);
		}

		//xac nhan da giao hang
		public function delivery(){
			$id = isset($_GET["id"]) ? $_GET["id"] : 0;
			//goi ham tu model de thuc hien
			$this->modelDelivery($id);
			//di chuyen den trang danh sach cac ban ghi
			echo "<script>location.href='index.php?controller=orders';</script>";
		}	

		//chi tiet don hang
		public function detail(){
			$id = isset($_GET["id"]) ? $_GET["id"] : 0;
			//goi ham tu model de thuc hien
			$data = $this->modelListOrderDetails($id);
			//load view
			$this->loadView("OrderDetailView.php",["data"=>$data,"id"=>$id]);
		}

		//danh sach cac product dang tim
		public function btnSearch(){
			//quy dinh so ban ghi mot trang
			$recordPerPage = 10;
			//lay danh sach cac ban ghi co phan trang
			$listRecord = $this->modelReadSearch($recordPerPage);
			//tinh so trang
			//ham ceil la ham lay tran. VD: ceil(2.1) = 3
			$numPage = ceil($this->modelTotalSearch()/$recordPerPage);
			//goi view, truyen du lieu ra view
			$this->loadView("OrdersView.php",["listRecord"=>$listRecord,"numPage"=>$numPage]);
		}

		//danh sach cac product dang loc theo ngay
		public function btnFilterDate(){
			//quy dinh so ban ghi mot trang
			$recordPerPage = 10;
			//lay danh sach cac ban ghi co phan trang
			$listRecord = $this->modelReadFillter($recordPerPage);
			//tinh so trang
			//ham ceil la ham lay tran. VD: ceil(2.1) = 3
			$numPage = ceil($this->modelTotalFilterDate()/$recordPerPage);
			//goi view, truyen du lieu ra view
			$this->loadView("OrdersView.php",["listRecord"=>$listRecord,"numPage"=>$numPage]);
		}
		
		//danh sach cac product dang loc theo ngay
		public function btnStatus(){
			//quy dinh so ban ghi mot trang
			$recordPerPage = 10;
			//lay danh sach cac ban ghi co phan trang
			$listRecord = $this->modelReadStatus($recordPerPage);
			//tinh so trang
			//ham ceil la ham lay tran. VD: ceil(2.1) = 3
			$numPage = ceil($this->modelTotalStatus()/$recordPerPage);
			//goi view, truyen du lieu ra view
			$this->loadView("OrdersView.php",["listRecord"=>$listRecord,"numPage"=>$numPage]);
		}
	}
 ?>