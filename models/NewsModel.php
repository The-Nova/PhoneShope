<?php 
	trait NewsModel{
		//lay danh sach cac ban ghi, co phan trang
		public function modelRead($recordPerPage){			
			//lay bien page truyen tu url
			$page = isset($_GET["page"])&&is_numeric($_GET["page"])&&$_GET["page"]>0 ? $_GET["page"]-1 : 0;
			//lay tu ban ghi nao
			$from = $page * $recordPerPage;
			//---
			//lay bien ket noi
			$conn = Connection::getInstance();
			if($from==1){
				$query = $conn->query("select * from news where hot=1 desc limit $from,$recordPerPage");
			} else {
				$query = $conn->query("select * from news order by id desc limit $from,$recordPerPage");
			}
			//lay tat ca ket qua tra ve
			$result = $query->fetchAll();
			//---
			return $result;
		}

        //ham lay tin tuc
        public function modelReadNews(){
            //lay bien ket noi
			$conn = Connection::getInstance();
            $query = $conn->query("select news.id,news.name,news.photo,news.createdate,users.name as createdby 
            FROM news,users WHERE news.createdby=users.id order by createdate desc limit 6");
            //lay ket qua tra ve
            $result = $query->fetchAll();
            return $result;
        }

        //ham lay tin tuc
        public function modelHotNews(){
            //lay bien ket noi
			$conn = Connection::getInstance();
            $query = $conn->query("select news.id,news.name,news.photo,news.createdate,users.name as createdby 
            FROM news,users WHERE news.createdby=users.id and news.hot=1 order by createdate desc limit 10");
            //lay ket qua tra ve
            $result = $query->fetchAll();
            return $result;
        }

		
		//ham tinh tong so ban ghi
		public function modelTotal(){
			//lay bien ket noi
			$conn = Connection::getInstance();
			$query = $conn->query("select id from news");
			//ham rowCount: dem so ket qua tra ve
			return $query->rowCount();
		}
		
		//lay mot ban ghi tuong ung voi id truyen vao
		public function modelGetRecord($id){
			//lay bien ket noi
			$conn = Connection::getInstance();
			$query = $conn->query("select * from news where id=$id");
			//tra ve mot ban ghi
			return $query->fetch();
		}
		
		//lay mot ban ghi user tuong ung voi id truyen vao
		public function modelGetcreatedby($id){
			//lay bien ket noi
			$conn = Connection::getInstance();
			$query = $conn->query("select name from users where id=$id");
			//tra ve mot ban ghi
			$result = $query->fetch();
            return $result;
		}
	}
 ?>