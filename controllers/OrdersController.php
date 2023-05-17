<?php 
if(isset($_SESSION['customer_id'])){
	include "models/OrdersModel.php";
	class OrdersController extends Controller{
		use OrdersModel;
		public function index(){
			//goi ham de lay du lieu
			$data = $this->modelReadOrders();
            $dataDetail=$this->modelReadDetail();
			//load view
			$this->loadView("OrdersView.php",["data"=>$data,"dataDetail"=>$dataDetail]);
		}

		//createPost
		public function buyProducts(){
			$this->modelCreateOrder();
			header("location:index.php?controller=orders");
		}


	}
}else{
	trait OrdersModel{}
	class OrdersController extends Controller{
		public function index(){
			//load view
			$this->loadView("ErorrPage.php");
		}
	}
}
 ?>