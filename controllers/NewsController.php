<?php 
	//load file model
	include "models/NewsModel.php";
	class NewsController extends Controller{
		//ke thua class NewsModel
		use NewsModel;
		//liet ke so ban ghi
		public function index(){
			$inHome=0;
			//quy dinh so ban ghi mot trang
			$recordPerPage = 20;
			//tinh so trang
			//ham ceil la ham lay tran. VD: ceil(2.1) = 3
			$numPage = ceil($this->modelTotal()/$recordPerPage);
			//lay danh sach cac ban ghi co phan trang
			$dataNews=$this->modelReadNews();
			//goi view, truyen du lieu ra view
			$this->loadView("NewsView.php",["dataNews"=>$dataNews,"numPage"=>$numPage]);
		}
		
		//detail
		public function newsDetail(){
			$id = isset($_GET["id"])&&is_numeric($_GET["id"])?$_GET["id"]:0;
			$record = $this->modelGetRecord($id);
			$created = $this->modelGetcreatedby($record->createdby);
			$dataNews=$this->modelReadNews();
			//goi view, truyen du lieu ra view
			$this->loadView("NewsDetailView.php",["record"=>$record,"created"=>$created,"dataNews"=>$dataNews]);
		}
	}
 ?>