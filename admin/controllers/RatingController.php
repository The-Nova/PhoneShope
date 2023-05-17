<?php 
	//load file model
	include "models/RatingModel.php";
	class RatingController extends Controller{
		//ham tao - check login
		public function __construct(){
			$this->authentication();
		}
		use RatingModel;
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
			$this->loadView("RatingView.php",["data"=>$data,"numPage"=>$numPage]);
		}

        public function detail(){
            //lay id
			$id = isset($_GET["product_id"])&&is_numeric($_GET["product_id"])?$_GET["product_id"]:0;
			//quy dinh so ban ghi mot trang
			$recordPerPage = 10;
			//tinh so trang
			//ham ceil la ham lay tran. VD: ceil(2.1) = 3
			$numPage = ceil($this->modelTotalDetail($id)/$recordPerPage);
			//lay danh sach cac ban ghi co phan trang
			$data = $this->modelReadDetail($id,$recordPerPage);
			//goi view, truyen du lieu ra view
			$this->loadView("ListRatingDetail.php",["data"=>$data,"numPage"=>$numPage]);
		}

        //liet ke so ban ghi
		public function filterStar(){
            $star=isset($_GET["opRating"])&&is_numeric($_GET["opRating"])?$_GET["opRating"]:0;
			//quy dinh so ban ghi mot trang
			$recordPerPage = 10;
			//tinh so trang
			//ham ceil la ham lay tran. VD: ceil(2.1) = 3
			$numPage = ceil($this->modelTotalStar($star)/$recordPerPage);
			//lay danh sach cac ban ghi co phan trang
			$data = $this->modelReadStar($star,$recordPerPage);
			//goi view, truyen du lieu ra view
			$this->loadView("RatingView.php",["data"=>$data,"numPage"=>$numPage]);
		}

        //delete
		public function delete(){
			$id = isset($_GET["id"])&&is_numeric($_GET["id"])?$_GET["id"]:0;
			$this->modelDelete($id);
            $product_id = $_SESSION['product_id'];
			//quay tro lai mvc products
			header("location:index.php?controller=rating&action=detail&product_id=$product_id");
		}
	}
 ?>