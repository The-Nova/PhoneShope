<?php
    trait FeedbacksModel{

        //lay danh sach cac ban ghi, co phan trang
		public function modelRead($recordPerPage){			
			//lay bien page truyen tu url
			$page = isset($_GET["page"])&&is_numeric($_GET["page"])&&$_GET["page"]>0 ? $_GET["page"]-1 : 0;
			//lay tu ban ghi nao
			$from = $page * $recordPerPage;
			//lay bien ket noi
			$conn = Connection::getInstance();
			$query = $conn->query("select DISTINCT * from feedbacks order by createdate desc limit $from,$recordPerPage");
			//lay tat ca ket qua tra ve
			$result = $query->fetchAll();
			return $result;
		}

        //ham tinh tong so ban ghi
		public function modelTotal(){
			//lay bien ket noi
			$conn = Connection::getInstance();
			$query = $conn->query("select DISTINCT id from feedbacks");
			//ham rowCount: dem so ket qua tra ve
			return $query->rowCount();
		}

		//lay danh sach cac ban ghi, co phan trang tim kiem
		public function modelReadSearch($recordPerPage){			
			//lay bien page truyen tu url
			$page = isset($_GET["page"])&&is_numeric($_GET["page"])&&$_GET["page"]>0 ? $_GET["page"]-1 : 0;
			//lay tu ban ghi nao
			$from = $page * $recordPerPage;
			if(!empty($_REQUEST['search'])){
				$keyword = $_REQUEST['search'];
			}else{
				$keyword="";
			}
			//lay bien ket noi
			$conn = Connection::getInstance();
			$query = $conn->query("select * from feedbacks where name like '%$keyword%' or email like '%$keyword%' order by createdate desc limit $from,$recordPerPage ");
			//lay tat ca ket qua tra ve
			$result = $query->fetchAll();
			return $result;
		}

		//lay danh sach cac ban ghi, co phan trang loc theo ngay
		public function modelReadFillter($recordPerPage){			
			//lay bien page truyen tu url
			$page = isset($_GET["page"])&&is_numeric($_GET["page"])&&$_GET["page"]>0 ? $_GET["page"]-1 : 0;
			//lay tu ban ghi nao
			$from = $page * $recordPerPage;
			if(!empty($_REQUEST['filter'])){
				$datefil = $_REQUEST['filter'];
			}else{
				$datefil=date("20y-m-d");
			};
			//lay bien ket noi
			$conn = Connection::getInstance();
			$query = $conn->query("select * from feedbacks where createdate = '$datefil' order by createdate desc limit $from, $recordPerPage");
			//lay tat ca ket qua tra ve
			$result = $query->fetchAll();
			return $result;
		}
		
		//ham tinh tong so ban ghi products dang tim
		public function modelTotalSearch(){
			//lay bien ket noi
			$conn = Connection::getInstance();
			if(!empty($_REQUEST['search'])){
				$keyword = $_REQUEST['search'];
			}else{
				$keyword="";
			}
			$query = $conn->query("select * from feedbacks where name like '%$keyword%' or email like '%$keyword%' ");
			//ham rowCount: dem so ket qua tra ve
			return $query->rowCount();
		}

		//ham tinh tong so ban ghi products dang tim
		public function modelTotalFilterDate(){
			//lay bien ket noi
			$conn = Connection::getInstance();
			if(!empty($_REQUEST['filter'])){
				$datefil = $_REQUEST['filter'];
			}else{
				$datefil=date("20y-m-d");
			};
			$query = $conn->query("select * from feedbacks where createdate = '$datefil' ");
			//ham rowCount: dem so ket qua tra ve
			return $query->rowCount();
		}

        //xac nhan da giao hang
		public function modelSeen($id){
			//---
			$conn = Connection::getInstance();
			$conn->query("update feedbacks set seen = 1 where id = $id");
		}

         //xoa ban ghi
        public function modelDelete($id){
            //lay bien ket noi
            $conn = Connection::getInstance();
            $conn->query("delete from feedbacks where id=$id");
        }
    }
?>