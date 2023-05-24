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

		//mua san pham
		public function buyProducts(){
			if($this->checkQuantity()){
				$this->modelCreateOrder();
				$_SESSION["message"]="Mua hàng thành công! Nhân viên sẽ liên lạc trong vòng 10 phút";
			}else{
				$_SESSION["message"]="Mua hàng thất bại! Số lượng trong kho không đủ!";
			}
			header("location:index.php?controller=orders");
		}

		//huy hoa don san pham
		public function cancel(){
			$id=isset($_GET["id"])?$_GET["id"]:0;
			$this->modelCancel($id);
			$_SESSION['message']="Hủy hóa đơn thành công";
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