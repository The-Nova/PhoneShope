<?php 
	include "models/CartsModel.php";
	class CartsController extends Controller{
		use CartsModel;
		public function index(){
			//goi ham de lay du lieu
			$data = $this->modelRead();
			$address=$this->modelGetAddress();
			//load view
			$this->loadView("CartsView.php",["data"=>$data,"address"=>$address]);
		}

		//createPost
		public function createCartPost(){
			if(isset($_SESSION["customer_id"])){
				$this->modelCreateCart();
				$_SESSION["countcart"]=$this->modelTotal();
				header("location:index.php?controller=carts");
			}else{
				$_SESSION["success"]="Bạn cần đăng nhập để mua hàng";
				$url=$_SESSION['url'];
				header("location:$url");
			}
		}

		//plus
		public function plus(){
			$id = isset($_GET["id"])&&is_numeric($_GET["id"])?$_GET["id"]:0;
			$this->modelPlus($id);
			header("location:index.php?controller=carts");
		}

		//minus
		public function minus(){
			$id = isset($_GET["id"])&&is_numeric($_GET["id"])?$_GET["id"]:0;
			$this->modelMinus($id);
			header("location:index.php?controller=carts");
		}

		//delete
		public function delete(){
			$id = isset($_GET["id"])&&is_numeric($_GET["id"])?$_GET["id"]:0;
			$this->modelDelete($id);
			$_SESSION["countcart"]=$this->modelTotal();
			//quay tro lai mvc users
			header("location:index.php?controller=carts");
		}
	}
 ?>