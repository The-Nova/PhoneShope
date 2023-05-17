<?php 
	class Controller{
		//bien luu noi dung cua file doc vao
		public $view = NULL;
		//bien luu duong dan file layout
		public $layoutPath = NULL;
		//ham load file de hien thi len trang
		public function loadView($fileName,$data = NULL){
			if(file_exists("views/$fileName")){
				if($data != NULL)
					extract($data);
				//doc noi dung cua $fileName de nem du lieu vao bien $this->view
				ob_start();
					include "views/$fileName";
					$this->view = ob_get_contents();
				ob_get_clean();
			}
			//neu gia tri cua bien $this->layoutPath khong rong thi load file nay ra
			if($this->layoutPath != NULL)
				include "views/$this->layoutPath";
			else
				echo $this->view;
		}
		//xac thuc viec dang nhap
		public function authentication(){
			if(isset($_SESSION["email"]) == false)
				header("location:index.php?controller=login");
		}
	}
 ?>