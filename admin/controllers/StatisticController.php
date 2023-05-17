<?php 
	//load file model
	include "models/StatisticModel.php";
	class StatisticController extends Controller{
		//ham tao - check login
		public function __construct(){
			$this->authentication();
		}
		use StatisticModel;
		//liet ke so ban ghi
		public function index(){
			//huy error
			unset($_SESSION["error"]);
			$dataYears=$this->modelGetYears($this->optionTableStatistic());
			//goi view, truyen du lieu ra view
			$this->loadView("StatisticView.php",["dataYears"=>$dataYears]);
		}
	}
 ?>